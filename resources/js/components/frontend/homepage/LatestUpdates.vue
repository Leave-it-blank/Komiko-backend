<template>
  <div class="sm:mx-10">
    <div
      class="text-3xl px-2 pt-10 pb-2 font-roboto font-bold capitalize dark:text-white"
    >
      Latest
    </div>

    <div
      class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5 pb-2 gap-2 md:gap-4 mx-auto justify-center sm:justify-start overflow-clip w-full"
      style="min-height: 10rem"
    >
      <div v-for="comic in comics" class="m-2 grow flex justify-center">
        <div class="px-2 py-1 h-content bg-transparent dark:bg-black w-content">
          <div class="flex flex-shrink rounded-md">
            <div class="flex flex-col rounded-md">
              <Link :href="comic.cviewUrl">
                <div class="relative">
                  <div
                    class="select-none mx-auto flex flex-1 rounded-xl sm:h-72 sm:w-48"
                    v-html="comic.thumb[0].responsive"
                    :alt="comic.thumb[0].alt"
                  ></div>
                  <div
                    class="absolute top-5 left-0 right-0 text-md font-bold font-catamaran text-purple-500 bg-gray-200 opacity-70 mt-1 uppercase text-left select-none cursor-pointer flex-none line-clamp-2 md:line-clamp-1 flex-0"
                  >
                    <span class="">
                      <BaseIcon :path="mdiBookOpenVariant" />
                    </span>
                    {{ "  " + comic.choice }}
                  </div>
                  <div
                    class="absolute bottom-0 left-0 right-0 px-4 py-2 bg-gradient-to-t from-black via-gray-600 to-transparent opacity-80"
                  >
                    <div
                      class="text-lg font-semibold mt-2 font-roboto capitalize text-gray-100 dark:text-white text-center select-none cursor-pointer flex-none flex-0 truncate"
                    >
                      {{
                        "vol " + comic.vnumber + " chapters " + comic.cnumber
                      }}
                    </div>
                  </div>
                </div>
              </Link>
              <div class="justify-end flex-none">
                <div
                  class="flex flex-col font-roboto py-4 px-4 md:px-1 text-zinc-500"
                >
                  <Link :href="comic.viewUrl">
                    <div class="h-5 w-full">
                      <div
                        class="text-md mb-2 font-medium text-left select-none cursor-pointer flex-none pb-2 dark:text-white flex-0 truncate w-44"
                      >
                        {{ comic.title }}
                      </div>
                    </div>
                  </Link>
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
      </div>
    </div>
  </div>
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
<style scoped></style>
