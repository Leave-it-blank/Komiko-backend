<script setup>
import ReaderNavBar from "@/components/frontend/navigation/ReaderNavBar.vue";
import ReaderFooter from "../components/frontend/navigation/ReaderFooter.vue";
import { usePage } from "@inertiajs/inertia-vue3";
import { useReaderStore } from "@/stores/reader";
const mainStore = useReaderStore();
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
