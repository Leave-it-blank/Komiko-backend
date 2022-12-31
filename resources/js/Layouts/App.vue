<script setup>
import { computed } from "vue";
import { mdiMonitorCellphone } from "@mdi/js";
import { useMainStore } from "@/stores/main";
import menu from "@/menu.js";
import NavBar from "@/components/backend/NavBar.vue";
import AsideMenu from "@/components/backend/AsideMenu.vue";
import FooterBar from "@/components/backend/FooterBar.vue";
import OverlayLayer from "@/components/backend/OverlayLayer.vue";
import NotificationBar from "@/components/backend/NotificationBar.vue";
import { Head } from "@inertiajs/inertia-vue3";
import { darkModeKey, styleKey } from "@/config.js";
const mainStore = useMainStore();
defineProps({
  title: String,
});
mainStore.fullScreenToggle(false);
/* mainStore.setUser({
  name: 'John Doe',
  email: 'john@example.com',
  avatar: 'https://avatars.dicebear.com/api/avataaars/example.svg?options[top][]=shortHair&options[accessoriesChance]=93'
}) */
/* App style */
mainStore.setStyle("basic");
const isAsideLgActive = computed(() => mainStore.isAsideLgActive);

const overlayClick = () => {
  mainStore.asideLgToggle(false);
};
</script>

<template>
  <NavBar />
  <AsideMenu :menu="menu" />
  <div v-if="false" class="text-white bg-blue-500 m-2 p-6 rounded-md">
    {{ $page.props.sitedata }}
  </div>
  <div v-if="$page.props.flash.message" class="rounded-md m-2">
    <NotificationBar color="info" :icon="mdiMonitorCellphone">
      {{ $page.props.flash.message }}
    </NotificationBar>
  </div>
  <div v-if="$page.props.flash.error" class="rounded-md m-2">
    <NotificationBar color="danger" :icon="mdiMonitorCellphone">
      {{ $page.props.flash.error }}
    </NotificationBar>
  </div>

  <slot />
  <FooterBar />
  <OverlayLayer v-show="isAsideLgActive" z-index="z-30" @overlay-click="overlayClick" />
</template>
