<script setup>
import { computed } from 'vue'
import { useMainStore } from '@/stores/main'
import { mdiMenu } from '@mdi/js'
import AsideMenuList from '@/components/backend/AsideMenuList.vue'
import NavBarItem from '@/components/backend/NavBarItem.vue'
import BaseIcon from '@/components/backend/BaseIcon.vue'
import { Link } from '@inertiajs/inertia-vue3'

defineProps({
  menu: {
    type: Array,
    default: () => []
  }
})

const mainStore = useMainStore()

const asideStyle = computed(() => mainStore.asideStyle)

const asideBrandStyle = computed(() => mainStore.asideBrandStyle)

const asideMenuCloseLgStyle = computed(() => mainStore.asideMenuCloseLgStyle)

const asideMenuLabelStyle = computed(() => mainStore.asideMenuLabelStyle)

const isFullScreen = computed(() => mainStore.isFullScreen)

const isAsideMobileExpanded = computed(() => mainStore.isAsideMobileExpanded)

const isAsideLgActive = computed(() => mainStore.isAsideLgActive)

const asideLgClose = () => {
  mainStore.asideLgToggle(false)
}

const menuClick = () => {
  //
}
</script>

<template>
  <aside
    v-show="!isFullScreen"
    id="aside"
    class="w-60 fixed top-0 z-40 h-screen transition-position lg:left-0 overflow-y-auto
    dark:border-r dark:border-gray-800 dark:bg-gray-900/70 lg:dark:bg-gray-900 xl:dark:bg-gray-900/70"
    :class="[ asideStyle, isAsideMobileExpanded ? 'left-0' : '-left-60', isAsideLgActive ? 'block' : 'lg:hidden xl:block' ]"
  >
    <div
      class="flex flex-row w-full flex-1 h-14 items-center dark:bg-transparent"
      :class="[ asideBrandStyle ]"
    >
      <NavBarItem
        type="hidden lg:flex xl:hidden"
        :active-color="asideMenuCloseLgStyle"
        active
        @click="asideLgClose"
      >
        <BaseIcon
          :path="mdiMenu"
          class="cursor-pointer"
          size="24"
        />
      </NavBarItem>

      <div class="flex-1 px-3 ">
        <a  :href="route('reader.homepage.view')">
         <span> {{$page.props.sitedata.site_name}}</span>
        </a>

      </div>
    </div>
    <div>
      <template v-for="(menuGroup, index) in menu">
        <p
          v-if="typeof menuGroup === 'string'"
          :key="`a-${index}`"
          class="p-3 text-xs uppercase"
          :class="[ asideMenuLabelStyle ]"
        >
          {{ menuGroup    }}
        </p>
        <AsideMenuList
          v-else
          :key="`b-${index}`"
          :menu="menuGroup"
          @menu-click="menuClick"
        />
      </template>
    </div>
  </aside>
</template>
