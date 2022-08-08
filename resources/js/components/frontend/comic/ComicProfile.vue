<template>
  <div
    class="mx-8 my-3 pb-3 text-3xl capitalize font-roboto font-semibold text-center line-clamp-2"
  >
    {{ comic.title }}
  </div>
  <div
    class="flex flex-col md:flex-row justify-center sm:justify-evenly gap-10 my-2 mx-auto sm:mb-5 bg-neutral-900 py-5 md:px-24 px-2 xl:px-5 rounded-lg min-w-fit"
  >
    <div class="image2 mx-auto md:ml-8 xl:mx-auto">
      <div class="relative w-48">
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

    <div class="max-w-md min-w-fit w-full mx-auto md:mr-8 xl:mx-auto md:px-4">
      <div class="p-2 flex flex-row justify-center gap-2">
        <button
          @click="toggle = !toggle"
          class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded-lg"
          :class="{ active: toggle === true }"
        >
          Information
        </button>
      </div>
      <div
        class="bg-black xl:p-5 p-3 mt-5 text-gray-300 w-full xl:w-96 rounded-lg pb-4"
        style="min-width: 15em; min-height: 5em"
      >
        <div
          v-if="toggle"
          class="text-xl font-roboto font-light w-full text-justify max-w-md mx-auto"
        >
          <h3 class="px-4 pt-2">{{ "Views: " + comic.author }}</h3>
          <h3 class="px-4 pt-2">{{ "Created On: " + dateshow2(comic.created_at) }}</h3>
          <h3 class="px-4 pt-2">{{ "Last Updated: " + dateshow(comic.updated_at) }}</h3>
        </div>

        <div
          v-if="!toggle"
          class="text-xl font-roboto font-light w-full text-justify max-w-md mx-auto"
        >
          <span>
            <h3 class="px-4 pt-2">{{ "Author: " + comic.author }}</h3>
            <h3 class="px-4 pt-2">{{ "Publisher: " + comic.publisher }}</h3>
            <h3 class="px-4 pt-2">{{ "Artist: " + comic.artist }}</h3>
          </span>
        </div>
      </div>
    </div>
  </div>

  <div
    class="sm:px-10 px-3 my-2 mx-auto sm:mb-5 bg-neutral-900 py-5 rounded-lg min-w-fit"
  >
    <h3 class="flex flex-wrap">
      <span
        class="px-4 m-1 py-2 bg-gradient-to-r from-red-400 to-lime-500 rounded-xl text-white"
        v-for="tag in props.comic.tags"
      >
        {{ tag.name }}</span
      >
      <span
        class="px-4 m-1 py-2 bg-gradient-to-r from-red-400 to-lime-500 rounded-xl text-white"
        v-for="tag in props.comic.tags"
      >
        {{ tag.name }}</span
      >
      <span
        class="px-4 m-1 py-2 bg-gradient-to-r from-red-400 to-lime-500 rounded-xl text-white"
        v-for="tag in props.comic.tags"
      >
        {{ tag.name }}</span
      >
      <span
        class="px-4 m-1 py-2 bg-gradient-to-r from-red-400 to-lime-500 rounded-xl text-white"
        v-for="tag in props.comic.tags"
      >
        {{ tag.name }}</span
      >
      <span
        class="px-4 m-1 py-2 bg-gradient-to-r from-red-400 to-lime-500 rounded-xl text-white"
        v-for="tag in props.comic.tags"
      >
        {{ tag.name }}</span
      >
      <span
        class="px-4 m-1 py-2 bg-gradient-to-r from-red-400 to-lime-500 rounded-xl text-white"
        v-for="tag in props.comic.tags"
      >
        {{ tag.name }}</span
      >
      <span
        class="px-4 m-1 py-2 bg-gradient-to-r from-red-400 to-lime-500 rounded-xl text-white"
        v-for="tag in props.comic.tags"
      >
        {{ tag.name }}</span
      >
      <span
        class="px-4 m-1 py-2 bg-gradient-to-r from-red-400 to-lime-500 rounded-xl text-white"
        v-for="tag in props.comic.tags"
      >
        {{ tag.name }}</span
      >
    </h3>
  </div>

  <div
    class="sm:px-10 px-3 my-2 mx-auto sm:mb-10 bg-neutral-900 py-5 rounded-lg min-w-fit"
  >
    <h1 class="mb-3 mx-1 sm:mx-2 text-yellow-500 text-lg">Description:</h1>
    <div class="mx-2 sm:mx-4 text- text-gray-400">
      <div v-if="!showmore">
        <p class="line-clamp-2">{{ comic.description + " " }}</p>
        <span class="text-gray-200 cursor-pointer" @click="showmore = !showmore"
          >Show more</span
        >
      </div>
      <div v-if="showmore">
        <p>{{ comic.description + " " }}</p>
        <span class="text-gray-200 cursor-pointer" @click="showmore = !showmore"
          >Show Less</span
        >
      </div>
    </div>
  </div>

  <div
    class="sm:px-10 px-3 my-2 mx-auto sm:mb-10 bg-neutral-900 py-5 rounded-lg min-w-fit"
  >
    <h1 class="mb-3 mx-1 sm:mx-2 text-yellow-500 text-lg">Chapters:</h1>

    <div class="flex flex-col mx-2">
      <div
        class="flex flex-col justify-between bg-black p-2 rounded-md my-2 pl-3"
        v-for="volume in props.comic.volumes"
      >
        <div class="my-1">Volume {{ " " + volume.number }}</div>
        <div v-for="chapter in volume.chapters">
          <div class="flex flex-row justify-between my-2 items-center">
            <div>
              <div
                class="image select-none first-letter:rounded-xl"
                v-html="props.comic.chapterthumb[0].responsive"
                :alt="props.comic.titleSlug"
              ></div>
            </div>
            <div
              class="dark:text-gray-400 text-md uppercase font-roboto font-semibold flex text-center pr-3"
            >
              {{ "Chapter " + chapter.number + ": " + chapter.name }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { Head } from "@inertiajs/inertia-vue3";
import { computed, ref, onMounted } from "vue";
import { useComicStore } from "@/stores/comic";
import ReaderLayout from "@/Layouts/ReaderLayout.vue";
import moment from "moment";
const props = defineProps({
  comic: {
    type: Object,
    default: null,
  },

  errors: Object,
});

function dateshow(value) {
  return moment(value).fromNow(); // here u modify data
}

function dateshow2(value) {
  return moment(value).format("MMM Do YY"); // here u modify data
}
console.log(props.comic);
console.log(props.comic.tags);
const showmore = ref(false);
const toggle = ref(false);
</script>
<style scoped>
.active {
  background-color: rgb(64, 53, 0);
}
</style>
