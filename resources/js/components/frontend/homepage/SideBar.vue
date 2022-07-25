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
      <div v-for="tag in props.tags">
        <Link :href="route('reader.tag.view',  tag.tagCode)">
          <div
            class="bg-neutral-900 w-full py-3 px-10 m-2 rounded-lg hover:bg-neutral-800 flex flex-row justify-between align-middle text-neutral-300 cursor-pointer select-none"
          >
            <div class="flex flex-row text-2xl">
              <div class="pr-3">
                <img width="72" :src="tag.svg" />
              </div>
              <div
                class="mt-5 ml-6 capitalize font-normal font-roboto text-gray-400"
              >
                {{ tag.name }}
              </div>
            </div>

            <div class="mt-4 text-3xl text-gray-400 font-thin justify-self-end">
              >
            </div>
          </div>
        </Link>
      </div>
    </div>
  </div>
</template>

<script setup>
import { mdiBookOpenVariant } from "@mdi/js";
import BaseIcon from "@/components/backend/BaseIcon.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";

const props = defineProps({
  tags: {
    type: Object,
    default: null,
  },
});
</script>
