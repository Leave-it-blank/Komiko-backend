<template>
  <ReaderLayout>
    <Head>
      <title>{{ "Comics - " + $page.props.sitedata.site_name }}</title>

      <meta name="description" content="webcomics: ComicsPage" />
    </Head>
    <div class="max-w-screen-xl py-10 w-full md:mx-auto">
      <div class="flex mt-5">
        <div class="w-full">
          <div class="flex flex-col my-2">
            <div class="sm:mx-10">
              <div
                class="text-3xl px-2 pt-10 pb-2 font-roboto font-bold capitalize dark:text-white"
              >
                Comics
              </div>

              <div
                class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5 pb-2 gap-2 md:gap-4 mx-auto justify-center sm:justify-start overflow-clip w-full"
              >
                <div
                  v-for="comic in props.comics.data"
                  :key="comic.id"
                  class="m-2 grow flex justify-center"
                >
                  <Link :href="comic.viewUrl">
                    <div
                      class="px-2 py-1 h-content bg-transparent dark:bg-black"
                    >
                      <div class="flex flex-shrink rounded-md">
                        <div class="flex flex-col rounded-md">
                          <div class="relative">
                            <div
                              class="select-none mx-auto flex flex-1 rounded-xl sm:h-72 sm:w-48"
                              v-html="comic.thumb[0].responsive"
                              :alt="comic.thumb[0].alt"
                            ></div>

                            <div
                              class="absolute bottom-0 left-0 right-0 px-4 py-2 bg-gradient-to-t from-black via-gray-600 to-transparent opacity-80"
                            >
                              <div
                                v-if="
                                  comic.chapters_count !== 0 &&
                                  comic.volume_count !== 1
                                "
                                class="text-lg font-semibold mt-2 font-roboto capitalize text-gray-100 text-center select-none cursor-pointer flex-none line-clamp-2 md:line-clamp-2 flex-0 stroke-purple-900 stroke-1"
                              >
                                {{ comic.chapters_count + " Chapters " }}
                              </div>
                              <div
                                v-if="comic.volume_count === 1"
                                class="text-lg font-semibold mt-2 font-roboto capitalize text-gray-100 text-center select-none cursor-pointer flex-none line-clamp-2 md:line-clamp-2 flex-0 stroke-purple-900 stroke-1"
                              >
                                {{ "Preview" }}
                              </div>
                            </div>
                          </div>
                          <div class="justify-end flex-none">
                            <div
                              class="flex flex-col font-roboto py-4 px-4 md:px-1 text-zinc-500"
                            >
                              <div class="h-5 w-full">
                                <div
                                  class="text-md mb-2 font-medium text-left select-none cursor-pointer flex-none flex-0 dark:text-white pb-2 truncate w-44"
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
              <div class="mx-auto flex justify-center md:justify-start">
                <pagination :links="props.comics.links" />
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </ReaderLayout>
</template>

<script setup>
import ReaderLayout from "@/Layouts/ReaderLayout.vue";
import moment from "moment";
import { Head, Link } from "@inertiajs/inertia-vue3";
import { mdiBookOpenVariant } from "@mdi/js";
import BaseIcon from "@/components/backend/BaseIcon.vue";
import Pagination from "@/components/frontend/navigation/pagination.vue";
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
<style>
.comicChapter {
  /* width: 320px; */
  height: 189px;
}
.divchapter {
  width: auto;
  height: 35px;
  border: solid 2px #686868;
  border-radius: 10px;
  align-items: center;
  margin: 10px;
  padding: 5px;
}

.divchapter:hover {
  border-color: #e5e7eb;
}

.comicImg {
  width: 150px;
  height: 100%;
}

.ImgContent {
  /* width: 130px; */
  height: 189px;
}

.SZqc3 {
  margin-top: auto;
  z-index: 4;
}

.R82hs {
  display: grid;
  grid-template-columns: 18% 82%;
}
.__33XQb {
  border-radius: 8px;
  overflow: hidden;
}

.Q9Bsa {
  border-radius: 8px 8px 0 0;
  cursor: pointer;
  display: inline-block;
  position: relative;
}
</style>
