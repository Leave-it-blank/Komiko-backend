<template>
  <h1
    class="mx-8 my-3 pb-2 text-2xl capitalize font-catamaran font-bold text-left line-clamp-3 ml-2"
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
          class="py-2 px-4 bg-purple-500 rounded-md m-3 w-32"
          v-on:click="bookmark()"
        >
          {{ bookmark_data.status }}
        </button>
        <Link :href="props.comic.first_ch_url">
          <button class="py-2 px-4 bg-lime-700 rounded-md m-3 w-44">
            Read First Chapter
          </button>
        </Link>
      </div>
    </div>
  </div>

  <div
    class="sm:px-10 px-3 my-2 mx-auto sm:mb-5 bg-neutral-200 dark:bg-neutral-900 py-5 rounded-lg min-w-fit"
  >
    <h2 class="flex flex-wrap">
      <span
        class="px-4 m-1 py-2 bg-gradient-to-r from-purple-400 to-purple-600 rounded-xl text-white font-bold font-catamaran text-sm capitalize"
        v-for="tag in props.comic.tags"
      >
        {{ tag.name }}</span
      >
    </h2>
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
      <div v-for="(vol, index) in props.comic.volumes">
        <div
          v-if="index === 1"
          v-html="props.ads_comic.ads_inside_content"
          class="flex flex-col my-2"
        ></div>
        <h4 class="my-1">{{ "Volume " + vol.number }}</h4>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3">
          <div v-for="(ch, ind) in vol.chapters">
            <Link
              :href="
                route(ch.url, {
                  comic: props.comic.titleSlug,
                  volume: vol.number,
                  chapter: ch.number,
                })
              "
            >
              <div
                class="col-span-1 flex flex-row justify-start items-center p-3 rounded-md bg-gray-100 dark:bg-black gap-2 hover:bg-purple-500 hover:text-white dark:hover:bg-purple-600 cursor-pointer"
              >
                <div
                  class="image select-none first-letter:rounded-xl shrink-0"
                  v-html="props.comic.chapterthumb[0].responsive"
                  :alt="props.comic.titleSlug"
                ></div>
                <div class="flex flex-wrap justify-evenly items-center">
                  <div>{{ "Chapter " + ch.number + " : " }}</div>
                  <div class="text-sm dark:text-gray-300 ml-2">
                    {{ ch.name }}
                  </div>
                </div>
              </div>
            </Link>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { Link } from "@inertiajs/inertia-vue3";
import { computed, reactive } from "vue";
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
const bookmark_data = reactive({ status: Bookmark_details() });

function Bookmark_details() {
  let bookmarks = new Map(JSON.parse(localStorage.getItem("bookmarks")));
  if (bookmarks.has(props.comic.id)) {
    return "Bookmarked";
  } else {
    return "Bookmark";
  }
}

const create_comic_bookmark = () => {
  let comic_bookmark = [];
  comic_bookmark.push(props.comic.title);
  comic_bookmark.push(props.comic.thumb);
  comic_bookmark.push(props.comic.viewUrl);
  comic_bookmark.push(props.comic.updated_at);
  return comic_bookmark;
};

const bookmark = () => {
  let bookmarks = new Map(JSON.parse(localStorage.getItem("bookmarks")));
  console.log(bookmarks.has(props.comic.id));

  if (bookmarks.has(props.comic.id)) {
    bookmarks.delete(props.comic.id);
    console.log("removed bookmark");
  } else {
    const comic_detail = create_comic_bookmark();
    bookmarks.set(props.comic.id, comic_detail);
    console.log("added bookmark");
    //console.log(bookmarks);
  }

  localStorage.setItem("bookmarks", JSON.stringify([...bookmarks]));
  bookmark_data.status = Bookmark_details();
  console.log("bookmarking function");
};
</script>

<style scoped>
.active {
  background-color: rgb(64, 53, 0);
}
</style>
