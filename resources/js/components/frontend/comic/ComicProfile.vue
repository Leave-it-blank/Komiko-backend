<template>
  <div class="flex flex-row justify-evenly mx-10 my-2 sm:my-10">
    <div class="image2">
      <div class="relative">
      <div
        class="image select-none mx-auto rounded-xl h-72 w-48"
        v-html="props.comic.thumb[0].responsive"
        :alt="props.comic.titleSlug"
      ></div>
            <div
              class="absolute bottom-0 left-0 right-0 px-4 py-2 bg-gradient-to-t from-black via-gray-600 to-transparent opacity-80"
            >

                <div
                  class="text-lg font-semibold mt-2 font-roboto capitalize text-gray-100 text-center select-none cursor-pointer flex-none line-clamp-2 md:line-clamp-2 flex-0"
                >
                  {{ comic.type }}
                </div>

            </div>
      </div>
    </div>
    <div class=""></div>
  </div>
</template>

<script setup>
import { Head } from "@inertiajs/inertia-vue3";
import { computed, ref, onMounted } from "vue";
import { useComicStore } from "@/stores/comic";
import ReaderLayout from "@/Layouts/ReaderLayout.vue";


const props = defineProps({
  comic: {
    type: Object,
    default: null,
  },

  errors: Object,
});
</script>
