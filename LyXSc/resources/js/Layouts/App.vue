<script setup>
import { computed } from 'vue'

import { useMainStore } from '@/stores/main'
import menu from '@/menu.js'
import NavBar from '@/components/NavBar.vue'
import AsideMenu from '@/components/AsideMenu.vue'
import FooterBar from '@/components/FooterBar.vue'
import OverlayLayer from '@/components/OverlayLayer.vue'

const mainStore = useMainStore()
defineProps({
  title: String,
});
mainStore.fullScreenToggle(false)
/* mainStore.setUser({
  name: 'John Doe',
  email: 'john@example.com',
  avatar: 'https://avatars.dicebear.com/api/avataaars/example.svg?options[top][]=shortHair&options[accessoriesChance]=93'
}) */

const isAsideLgActive = computed(() => mainStore.isAsideLgActive)

const overlayClick = () => {
  mainStore.asideLgToggle(false)
}
</script>

<template>
  <NavBar />
  <AsideMenu :menu="menu" />
        <div v-if="false" class="text-white bg-blue-500 m-2 p-6 rounded-md">
         {{ $page.props.sitedata }}
        </div>
       <div v-if="$page.props.flash.message" class="text-white bg-blue-500 m-2 p-6 rounded-md">
         {{ $page.props.flash.message }}
        </div>
    <div v-if="$page.props.flash.error" class="text-white bg-red-500 m-2 p-6 rounded-md">
         {{ $page.props.flash.error }}
     </div>
  <slot />
  <FooterBar />
  <OverlayLayer v-show="isAsideLgActive" z-index="z-30" @overlay-click="overlayClick" />
</template>
