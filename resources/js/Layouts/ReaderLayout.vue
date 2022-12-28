<script setup>
import { ref } from "vue";
import { Inertia } from "@inertiajs/inertia";
import { Head, Link } from "@inertiajs/inertia-vue3";
import JetApplicationMark from "@/Jetstream/ApplicationMark.vue";
import JetBanner from "@/Jetstream/Banner.vue";
import JetDropdown from "@/Jetstream/Dropdown.vue";
import JetDropdownLink from "@/Jetstream/DropdownLink.vue";
import JetNavLink from "@/Jetstream/NavLink.vue";
import JetResponsiveNavLink from "@/Jetstream/ResponsiveNavLink.vue";
import ReaderNavBar from "@/components/frontend/navigation/ReaderNavBar.vue";
import ReaderFooter from "../components/frontend/navigation/ReaderFooter.vue";
import { usePage } from "@inertiajs/inertia-vue3";
import { useMainStore } from "@/stores/main";
import { darkModeKey, styleKey } from "@/config.js";
const showingNavigationDropdown = ref(false);
const mainStore = useMainStore();
mainStore.setStyle("reader");

const ads_global_1 = usePage().props.value.ads_global.below_rec;
const ads_global_2 = usePage().props.value.ads_global.above_rec;
</script>

<template>
  <!-- Page Content -->
  <main class="relative">
    <div class="w-full h-full min-h-screen">
      <ReaderNavBar />
      <div v-html="ads_global_1" id="ads_global_nav"></div>

      <slot />
    </div>
    <div v-html="ads_global_2" id="ads_global_nav"></div>
    <ReaderFooter />
  </main>
</template>
