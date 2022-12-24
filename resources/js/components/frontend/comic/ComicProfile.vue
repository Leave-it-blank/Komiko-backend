<template>
  <h1
    class="mx-8 my-3 pb-2 text-2xl capitalize font-catamaran font-bold text-right line-clamp-3"
  >
    {{ comic.title }}
  </h1>
  <div
    class="flex flex-col md:flex-row justify-center sm:justify-evenly gap-10 my-2 mx-auto sm:mb-5 bg-neutral-200 dark:bg-neutral-900 py-5 md:px-24 px-2 xl:px-5 rounded-lg min-w-fit"
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

    <div
      class="max-w-md min-w-fit w-full mx-auto md:mr-8 xl:mx-auto md:px-4 relative gap-3 h-16 md:h-auto"
    >
      <div
        id="ads_comic_profile"
        v-html="props.ads_comic.ads_below_title"
        class="hidden md:block"
      ></div>
      <div class="absolute bottom-0 flex justify-around w-full text-white">
        <button
          class="py-2 px-4 bg-purple-500 rounded-md m-3"
          onclick="alert('functionality yet to be added')"
        >
          Bookmark
        </button>
        <Link :href="props.comic.first_ch_url">
          <button class="py-2 px-4 bg-lime-700 rounded-md m-3">Read First Chapter</button>
        </Link>
      </div>
    </div>
  </div>

  <div
    class="sm:px-10 px-3 my-2 mx-auto sm:mb-5 bg-neutral-200 dark:bg-neutral-900 py-5 rounded-lg min-w-fit"
  >
    <h3 class="flex flex-wrap">
      <span
        class="px-4 m-1 py-2 bg-gradient-to-r from-purple-400 to-purple-600 rounded-xl text-white font-bold font-catamaran text-sm capitalize"
        v-for="tag in props.comic.tags"
      >
        {{ tag.name }}</span
      >
    </h3>
  </div>

  <div id="ads-comic-middle" class="px-3 mb-2 sm:mb-5 mx-auto rounded-lg min-w-fit">
    <div v-html="props.ads_comic.ads_below_desc" class="flex flex-col my-2"></div>
  </div>

  <div
    class="sm:px-10 px-3 my-2 mx-auto sm:mb-5 bg-neutral-200 dark:bg-neutral-900 py-5 rounded-lg min-w-fit"
  >
    <h3 class="text-xl font-roboto p-1 w-full text-justify max-w-md font-bold">
      {{ "Content" }}
    </h3>

    <div class="flex flex-col mx-2">
      <div
        class="flex flex-col justify-between p-2 rounded-md my-2 pl-3 border border-zinc-100 dark:border-zinc-800"
        v-for="(volume, index) in props.comic.volumes"
      >
        <h4 class="my-1">Volume {{ " " + volume.number }}</h4>

        <div v-for="(chapter, index) in volume.chapters">
          <div
            v-if="index === 5"
            v-html="props.ads_comic.ads_inside_content"
            class="flex flex-col my-2"
          ></div>
          <Link
            :href="
              route(chapter.url, {
                comic: props.comic.titleSlug,
                volume: volume.number,
                chapter: chapter.number,
              })
            "
          >
            <div
              class="flex flex-row justify-between my-2 items-center cursor-pointer dark:text-gray-400 bg-white dark:bg-black p-3 rounded-md"
            >
              <div class=" ">
                <div
                  class="image select-none first-letter:rounded-xl"
                  v-html="props.comic.chapterthumb[0].responsive"
                  :alt="props.comic.titleSlug"
                ></div>
              </div>
              <div
                class="text-md captalize font-catamaran flex text-center pr-3 text-sm sm:text-md md:text-lg 2xl:text-xl"
              >
                {{ "Chapter " + chapter.number + ": " + chapter.name }}
              </div>
            </div>
          </Link>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { Link } from "@inertiajs/inertia-vue3";
const props = defineProps({
  comic: {
    type: Object,
    default: null,
  },
  ads_comic: {
    type: Object,
    default: null,
  },

  errors: Object,
});
</script>
<style scoped>
.active {
  background-color: rgb(64, 53, 0);
}
</style>
