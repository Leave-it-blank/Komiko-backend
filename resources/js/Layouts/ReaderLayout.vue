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
const showingNavigationDropdown = ref(false);

const logout = () => {
  Inertia.post(route("logout"));
};

console.log(usePage().props.ads_global);
</script>

<template>
  <div class="relative">
    <!-- Page Content -->
    <div class="relative">
      <ReaderNavBar />
    </div>
    <div id="ads_global_nav"></div>
    <main>
      <div class="dark:bg-black w-full h-full min-h-screen">
        <slot />
      </div>
    </main>
    <ReaderFooter />
  </div>
</template>
