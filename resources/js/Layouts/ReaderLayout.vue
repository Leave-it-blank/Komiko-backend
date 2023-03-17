<script setup>
 
import { usePage } from "@inertiajs/inertia-vue3";
import { useReaderStore } from "@/stores/reader";
import { onMounted } from "vue";

const mainStore = useReaderStore();
mainStore.setStyle("reader");
 
</script>

<template>
  <!-- Page Content -->
  <main class="relative">
    <div class="w-full h-full min-h-screen">
      
      <div
        id="ads_global_nav_1"
        class="w-full max-w-screen-2xl h-20 mx-auto  mt-6"
      >
        <div class="sm:mx-10">
   
        </div>
      </div>

      <slot />
    </div>
 
  </main>
</template>
