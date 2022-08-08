<template>
  <ReaderLayout>
    <div class="max-w-screen-2xl py-10 w-full h-screen mx-auto">
      <div class="flex flex-col xl:flex-row justify-evenly sm:mx-10 gap-2">
        <div class="xl:w-8/12 s rounded-lg mx-auto">
          <ComicProfile :comic="props.comic" />
        </div>
        <div class="rounded-lg h-screen xl:w-4/12 xl:ml-10 mx-auto">
          <div
            class="flex flex-col md:flex-row justify-center sm:justify-evenly gap-10 my-2 mx-auto sm:mb-5 bg-neutral-900 py-5 md:px-24 px-2 xl:px-5 rounded-lg min-w-fit"
          ></div>
        </div>
      </div>
    </div>
  </ReaderLayout>
</template>

<script setup>
import { Head } from "@inertiajs/inertia-vue3";
import { computed, ref, onMounted } from "vue";
import { useComicStore } from "@/stores/comic";
import ReaderLayout from "@/Layouts/ReaderLayout.vue";
import ComicProfile from "@/components/frontend/comic/ComicProfile.vue";

const props = defineProps({
  comic: {
    type: Object,
    default: null,
  },

  errors: Object,
});
</script>
