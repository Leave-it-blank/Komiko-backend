<template>
  <ReaderLayout>
    <div class="container mx-auto max-w-6xl pt-10 px-1">
      <div class="flex justify-between py-3 px-2 items-center">
        <div class="text-xl md:text-2xl">{{ ctitle }}</div>
        <div class="vol p-3 md:text-xl">
          <div>Vol {{ c_vol_no }}</div>
          <div>Chapter {{ c_chap_no }}</div>
        </div>
      </div>
      <div
        class="grid grid-cols-3 p-4 mb-10 mt-3 font-catamaran gap-2 bg-neutral-200 dark:bg-neutral-900 dark:text-gray-200 rounded-md text-sm"
      >
        <div
          class="px-5 py-4 rounded-md bg-white dark:bg-black text-gray-900 dark:text-gray-200 justify-self-start"
        >
          <Link
            :href="previousChapter"
            v-if="previousChapter !== null"
            class=" "
          >
            Previous Chapter
          </Link>
          <button v-else>No Previous Chapter</button>
        </div>

        <Link
          :href="home"
          class="px-5 py-4 rounded-md bg-white dark:bg-black text-gray-900 dark:text-gray-200 justify-self-center"
        >
          Home
        </Link>
        <div
          class="px-5 py-4 rounded-md bg-white dark:bg-black text-gray-900 dark:text-gray-200 justify-self-end"
        >
          <Link :href="nextChapter" v-if="nextChapter !== null" class=" ">
            Next Chapter
          </Link>
          <button v-else>No Next Chapter</button>
        </div>
      </div>
      <div class="min-h-screen">
        <div v-for="page in props.pages">
          <div
            class="select-none w-full"
            v-html="page.thumb[0].responsive"
            :alt="page.thumb[0].alt"
          ></div>
        </div>
      </div>
      <div class="pb-10"></div>
      <div
        class="grid grid-cols-3 p-4 mt-3 font-catamaran gap-2 bg-neutral-200 dark:bg-neutral-900 dark:text-gray-200 rounded-md text-sm"
      >
        <div
          class="px-5 py-4 rounded-md bg-white dark:bg-black text-gray-900 dark:text-gray-200 justify-self-start"
        >
          <Link
            :href="previousChapter"
            v-if="previousChapter !== null"
            class=" "
          >
            Previous Chapter
          </Link>
          <button v-else>No Previous Chapter</button>
        </div>

        <Link
          :href="home"
          class="px-5 py-4 rounded-md bg-white dark:bg-black text-gray-900 dark:text-gray-200 justify-self-center"
        >
          Home
        </Link>
        <div
          class="px-5 py-4 rounded-md bg-white dark:bg-black text-gray-900 dark:text-gray-200 justify-self-end"
        >
          <Link :href="nextChapter" v-if="nextChapter !== null" class=" ">
            Next Chapter
          </Link>
          <button v-else>No Next Chapter</button>
        </div>
      </div>
      <div class="pb-10"></div>
    </div>
  </ReaderLayout>
</template>

<script setup>
import { Head, Link } from "@inertiajs/inertia-vue3";
import { computed, ref, onMounted } from "vue";
import { useComicStore } from "@/stores/comic";
import ReaderLayout from "@/Layouts/ReaderLayout.vue";

const props = defineProps({
  chapter: {
    type: Object,
    default: null,
  },
  ctitle: {
    type: String,
    default: null,
  },
  c_vol_no: {
    type: Number,
    default: null,
  },
  home: {
    type: String,
    default: null,
  },
  c_chap_no: {
    type: Number,
    default: null,
  },
  previousChapter: {
    type: String,
    default: null,
  },
  nextChapter: {
    type: String,
    default: null,
  },
  pages: {
    type: Object,
    default: null,
  },

  errors: Object,
});
</script>
