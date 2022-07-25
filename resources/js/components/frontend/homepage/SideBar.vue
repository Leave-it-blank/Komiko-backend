<template>
  <div>
    <div
      class="text-4xl mt-5 mb-1 p-5 mx-2 font-roboto font-bold capitalize dark:text-white flex justify-center align-middle bg-yellow-500 rounded-md"
    >
      Join our Discord
    </div>
    <div
      class="text-4xl mb-5 mt-1 p-5 mx-2 font-roboto font-bold capitalize dark:text-white flex justify-center align-middle bg-yellow-500 rounded-md"
    >
      Join our Patreon
    </div>

    <div
      class="text-3xl px-2 pt-10 pb-2 font-roboto font-bold capitalize dark:text-white"
    >
      More to Explore
    </div>
    <div class="flex flex-col">
      <div v-for="tag in props.tags"
        class="bg-neutral-900 w-full py-6 px-10 m-2 rounded-lg hover:bg-neutral-800 flex flex-row justify-between align-middle text-neutral-300 cursor-pointer select-none"
      >
      <div class="flex flex-row  text-2xl">
          <div class="text-4xl mx-2 px-3">
          []
          </div>
         <div class="mt-1">
         {{tag.name}}
         </div>
      </div>

          <div class=" text-3xl text-gray-200 font-extrabold  justify-self-end">
           >
          </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { mdiBookOpenVariant } from "@mdi/js";
import BaseIcon from "../../backend/BaseIcon.vue";
const props = defineProps({
tags: {
    type: Object,
    default: null,
  },

  });
</script>
