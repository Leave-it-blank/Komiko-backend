<script setup>
import { computed } from "vue";
import { useMainStore } from "@/stores/main";
import BaseLevel from "@/components/backend/BaseLevel.vue";

const mainStore = useMainStore();

const year = computed(() => new Date().getFullYear());

const isFooterBarVisible = computed(() => !mainStore.isFullScreen);
</script>

<template>
  <footer
    v-show="isFooterBarVisible"
    class="bg-white py-2 px-6 dark:bg-gray-900/70"
  >
    <BaseLevel>
      <div class="text-center md:text-left">
        <b
          >&copy; {{ year }}, <a href="#" target="_blank">2022@Mimo</a> -
          BLaaS</b
        >
      </div>
      <div class="md:py-2">
        <a href="#"> TOP </a>
      </div>
    </BaseLevel>
  </footer>
</template>
