<template>
<div class="mx-auto sm:mx-10">


  <div class="text-3xl px-2 pt-10 pb-2 font-roboto font-bold capitalize dark:text-white">

           Latest
           </div>
           <div class="flex flex-row flex-wrap justify-center sm:justify-between">
              <div v-for="comic in comics">

    <div class="flex px-2 py-1 h-96 dark:bg-black">
      <div class="flex-none rounded-md">
        <div class="flex flex-col rounded-md  ">
          <div class="relative">
            <div
              class="image select-none mx-auto rounded-xl h-72 w-48"
              v-html="comic.thumb[0].responsive"
              :alt="comic.thumb[0].alt"
            ></div>
            <div
              class="absolute bottom-0 left-0 right-0 px-4 py-2 bg-gradient-to-t from-black via-gray-600 to-transparent opacity-80"
            >
              <Link :href="route(comic.viewUrl, comic.titleslug)">
                <div
                  class="text-lg font-semibold mt-2 font-roboto capitalize text-gray-100 text-center select-none cursor-pointer flex-none line-clamp-2 md:line-clamp-2 flex-0"
                >
                  {{ comic.title }}
                </div>
              </Link>
            </div>
          </div>
          <div class="justify-end flex-none">
            <div class="flex flex-col font-roboto py-4 px-1 text-zinc-400">
              <div class="h-5 w-full">
                <div
                  v-if="comic.chapter_count !== 0"
                  class="text-sm mb-1 font-medium text-left select-none cursor-pointer flex-none line-clamp-2 md:line-clamp-1 flex-0"
                >
                  {{ comic.chapter_count + " chapters" }}
                </div>
              </div>
              <div class="min-h-3 w-full">
                <div
                  class="text-sm font-medium text-left select-none cursor-pointer flex-none line-clamp-2 md:line-clamp-1 flex-0"
                >
                  {{ dateshow(comic.updatedAt) }}
                </div>
              </div>

              <div
                class="text-md font-extrabold text-lime-600 mt-1 uppercase text-left select-none cursor-pointer flex-none line-clamp-2 md:line-clamp-1 flex-0"
              >
                <span class="">
                  <BaseIcon :path="mdiBookOpenVariant" />
                </span>
                {{ "  " + comic.choice }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
    </div></div>

</template>
<script setup>
import moment from "moment";
import { Head, Link } from "@inertiajs/inertia-vue3";
import { mdiBookOpenVariant } from "@mdi/js";
import BaseIcon from "../../backend/BaseIcon.vue";
const props = defineProps({
  comics: {
    type: Object,
    default: null,
  },
});

function dateshow(value) {
  return moment(value).fromNow(); // here u modify data
}
</script>
<style scoped>

</style>
