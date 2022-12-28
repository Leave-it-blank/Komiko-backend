<template>
  <div class="sm:mx-10">
    <h1 class="text-3xl px-2 pt-10 pb-2 font-roboto font-bold capitalize dark:text-white">
      Hot recommended
    </h1>

    <div
      class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5 pb-2 gap-2 md:gap-4 mx-auto justify-center sm:justify-start overflow-clip w-full"
      style="min-height: 10rem"
    >
      <div v-for="comic in comics" class="m-2 grow flex justify-center">
        <Link :href="comic.viewUrl">
          <div class="px-2 py-1 h-content bg-transparent">
            <div class="flex flex-shrink rounded-md">
              <div class="flex flex-col rounded-md">
                <div class="relative">
                  <div
                    class="select-none mx-auto flex flex-1 rounded-xl sm:h-72 sm:w-48"
                    v-html="comic.thumb[0].responsive"
                    :alt="comic.thumb[0].alt"
                  ></div>
                  <div
                    class="absolute top-1 left-1 right-0 text-md md:text-sm font-bold font-catamaran w-fit pr-2 max-w-2/3 ml-1 md:ml-0 text-gray-100 bg-purple-300 dark:bg-purple-500 opacity-95 mt-1 capitalize text-left select-none cursor-pointer flex items-center flex-0 rounded-md"
                  >
                    <span class="text-2xl text-orange-100 animate-pulse">
                      <BaseIcon :path="mdiChiliHot" />
                    </span>
                    <div class="mt-1">{{ "  " + comic.choice }}</div>
                  </div>

                  <div v-if="comic.chapter_count !== 0 && comic.volume_count !== 1">
                    <div
                      class="absolute bottom-0 left-0 right-0 px-4 bg-gradient-to-t from-transparent via-purple-500 to-transparent opacity-25 py-5 blur-xl"
                    ></div>
                    <div class="absolute bottom-0 left-0 right-0 px-4 py-2">
                      <div
                        class="text-lg font-semibold mt-2 font-roboto capitalize text-gray-100 dark:text-white text-center select-none cursor-pointer flex-none flex-0 truncate"
                      >
                        {{ comic.chapter_count + " Chapters " }}
                      </div>
                    </div>
                  </div>
                </div>
                <div class="justify-end flex-none">
                  <div class="flex flex-col font-roboto py-4 px-4 md:px-1 text-zinc-600">
                    <div class="h-5 w-full">
                      <div
                        class="text-md mb-2 text-left select-none cursor-pointer text-zinc-900 flex-none flex-0 dark:text-white pb-2 truncate w-44 hover:text-purple-400 dark:hover:text-purple-500 font-bold"
                      >
                        {{ comic.title }}
                      </div>
                    </div>
                    <div class="min-h-3 w-full">
                      <div
                        class="text-sm font-medium text-left select-none cursor-pointer flex-none line-clamp-2 md:line-clamp-1 flex-0"
                      >
                        {{ dateshow(comic.updatedAt) }}
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </Link>
      </div>
    </div>
  </div>
</template>
<script setup>
import moment from "moment";
import { Head, Link } from "@inertiajs/inertia-vue3";
import { mdiChiliHot } from "@mdi/js";
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
<style scoped></style>
