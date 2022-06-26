<script setup>
import { ref, computed } from 'vue'
import { Link } from '@inertiajs/inertia-vue3'
import { useMainStore } from '@/stores/main'
import { mdiMinus, mdiPlus } from '@mdi/js'
import BaseIcon from '@/components/BaseIcon.vue'
import AsideMenuList from '@/components/AsideMenuList.vue'

const props = defineProps({
  item: {
    type: Object,
    required: true
  },
  isSubmenuList: Boolean
})

const emit = defineEmits(['menu-click'])

const mainStore = useMainStore()

const asideMenuItemStyle = computed(() => mainStore.asideMenuItemStyle)

const asideMenuItemActiveStyle = computed(() => mainStore.asideMenuItemActiveStyle)

const asideMenuItemInactiveStyle = computed(() => mainStore.asideMenuItemInactiveStyle)

const asideSubmenuListStyle = computed(() => mainStore.asideSubmenuListStyle)

const isDropdownActive = ref(false)

const componentIs = computed(() => props.item.route ? Link : 'a')

const hasDropdown = computed(() => !!props.item.menu)

const dropdownIcon = computed(() => isDropdownActive.value ? mdiMinus : mdiPlus)


const itemHref = computed(() => props.item.route ? route(props.item.route) : props.item.href)

const itemTarget = computed(() => props.item.target ? props.item.target : null)

const activeInactiveStyle = computed(
  () => props.item.route && route().current(props.item.route)
    ? asideMenuItemActiveStyle.value
    : asideMenuItemInactiveStyle.value
)
const menuClick = event => {
  emit('menu-click', event, props.item)

  if (hasDropdown.value) {
    isDropdownActive.value = !isDropdownActive.value
  }
}
</script>

<template>
  <li>
    <component
      :is="componentIs"


      :href="itemHref"
      :target="itemTarget"
      class="flex cursor-pointer dark:hover:bg-gray-700/50"
      :class="[ asideMenuItemStyle, isSubmenuList ? 'p-3 text-sm' : 'py-2' ]"
      @click="menuClick"
    >
      <BaseIcon
        v-if="item.icon"
        :path="item.icon"
        class="flex-none"
       :class="activeInactiveStyle"
        w="w-12"
      />
      <span
        class="grow"
       :class="activeInactiveStyle"
      >{{ item.label }}</span>
      <BaseIcon
        v-if="hasDropdown"
        :path="dropdownIcon"
        class="flex-none"
       :class="activeInactiveStyle"
        w="w-12"
      />
    </component>
    <AsideMenuList
      v-if="hasDropdown"
      :menu="item.menu"
      :class="[ asideSubmenuListStyle, isDropdownActive ? 'block dark:bg-gray-800/50' : 'hidden' ]"
      is-submenu-list
    />
  </li>
</template>
