<template>
  <div class="sm:mx-10">
    <h1 class="text-3xl px-2 pt-10 pb-2 font-roboto font-bold capitalize dark:text-white">
      Latest
    </h1>

    <div
      class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5 pb-2 gap-2 md:gap-4 mx-auto justify-center sm:justify-start overflow-clip w-full"
      style="min-height: 10rem"
    >
      <div v-for="comic in comics" class="m-2 grow flex justify-center">
        <div class="px-2 py-1 h-content bg-transparent w-content">
          <div class="flex flex-shrink rounded-md">
            <div class="flex flex-col rounded-md">
              <Link :href="comic.cviewUrl">
                <div class="relative backdrop:bg-yellow-400">
                  <div
                    class="select-none mx-auto flex flex-1 rounded-xl sm:h-72 sm:w-48"
                    v-html="comic.thumb[0].responsive"
                    :alt="comic.thumb[0].alt"
                  ></div>
                  <div
                    class="absolute top-1 left-1 right-0 text-md md:text-sm font-bold font-catamaran w-fit pr-2 max-w-2/3 ml-1 md:ml-0 text-gray-100 bg-purple-300 dark:bg-purple-500 opacity-95 mt-1 capitalize text-left select-none cursor-pointer flex items-center flex-0 rounded-md"
                  >
                    <span class="text-2xl text-orange-100 animate-pulse">
                      <BaseIcon :path="mdiFire" />
                    </span>
                    <div class="mt-1">{{ "  " + comic.choice }}</div>
                  </div>

                  <div class="absolute bottom-0 left-0 right-0 px-4 py-2 flex justify-start md:justify-center">
                    <div
                      class=" shrink-1 py-1 opacity-90 text-lg md:text-sm font-semibold mt-2 font-roboto capitalize text-gray-100 dark:text-white text-center select-none cursor-pointer   bg-purple-500 rounded-md w-fit px-3"
                    >
                     <p >{{ "vol " + comic.vnumber + " chapters " + comic.cnumber }}  </p>
                    </div>
                  </div>
                </div>
              </Link>
              <div class="justify-end flex-none">
                <div class="flex flex-col font-roboto py-4 px-4 md:px-1 text-zinc-600 sm:w-48">
                  <Link :href="comic.viewUrl" class=" min-h-5 text-xl md:text-md   text-left select-none cursor-pointer text-zinc-900 flex-none  dark:text-white flex-0  w-full hover:text-purple-400 dark:hover:text-purple-500 font-bold">
                        {{ comic.title }}
                  </Link>
                    <div
                      class="min-h-3 w-full text-sm font-medium text-left select-none cursor-pointer flex-none line-clamp-2 md:line-clamp-1 flex-0"
                    >
                      {{ dateshow(comic.updatedAt) }}

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script setup>
import moment from "moment";
import { Head, Link } from "@inertiajs/inertia-vue3";
import { mdiFire } from "@mdi/js";
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
