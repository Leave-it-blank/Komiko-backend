<script setup>
import ReaderNavBar from "@/components/frontend/navigation/ReaderNavBar.vue";
import ReaderFooter from "../components/frontend/navigation/ReaderFooter.vue";
import { usePage } from "@inertiajs/inertia-vue3";
import { useReaderStore } from "@/stores/reader";
const mainStore = useReaderStore();
mainStore.setStyle("reader");

const ads_global_1 = usePage().props.value.ads_global.below_rec;
const ads_global_2 = usePage().props.value.ads_global.above_rec;
    document.addEventListener("DOMContentLoaded", function () {
      const b = document.querySelector("#ads_global_nav_1");
      b.insertAdjacentHTML("afterbegin", ads_global_1);
        const a = document.querySelector("#ads_global_nav_2");
      a.insertAdjacentHTML("afterbegin", ads_global_2);
    });

</script>

<template>
  <!-- Page Content -->
  <main class="relative">
    <div class="w-full h-full min-h-screen">
      <ReaderNavBar />
      <s   id="ads_global_nav_1"></div>

      <slot />
    </div>
    <div   id="ads_global_nav_2"></div>
    <ReaderFooter />
  </main>
</template>
