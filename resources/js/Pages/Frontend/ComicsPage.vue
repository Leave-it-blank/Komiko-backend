<template>
  <ReaderLayout>
    <Head>
      <title>{{ "Comics - " + $page.props.sitedata.site_name }}</title>

      <meta
        name="description"
        content="comics: List of all the comics you can enjoy on our website including your most favorite manga, manhua and manwha."
      />

      <meta property="og:type" content="website" />
      <meta property="og:title" :content="'Comics - ' + $page.props.sitedata.site_name" />
      <meta
        property="og:description"
        content="comics: List of all the comics you can enjoy on our website including your most favorite manga, manhua and manwha."
      />
      <!-- <meta property="og:image" content="LINK TO THE IMAGE FILE" /> -->
      <meta property="og:url" :content="$page.props.sitedata.site_url + '/comics'" />

      <meta
        name="twitter:title"
        :content="'Comics - ' + $page.props.sitedata.site_name"
      />
      <meta
        name="twitter:description"
        content="comics: List of all the comics you can enjoy on our website including your most favorite manga, manhua and manwha."
      />
      <!-- <meta name="twitter:image" content="LINK TO IMAGE" /> -->

      <meta property="twitter:url" :content="$page.props.sitedata.site_url + '/comics'" />
    </Head>
    <div class="max-w-screen-xl py-10 w-full md:mx-auto">
      <div class="flex mt-5">
        <div class="w-full">
          <div class="flex flex-col my-2">
            <div class="sm:mx-10">
              <h1
                class="text-3xl px-2 pt-10 pb-2 font-roboto font-bold capitalize dark:text-white"
              >
                Comics
              </h1>

              <div
                class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5 pb-2 gap-2 md:gap-4 mx-auto justify-center sm:justify-start overflow-clip w-full"
              >
                <div
                  v-for="comic in props.comics.data"
                  :key="comic.id"
                  class="m-2 grow flex justify-center"
                >
                  <Link :href="comic.viewUrl">
                    <div class="px-2 py-1 h-content bg-transparent">
                      <div class="flex flex-shrink rounded-md">
                        <div class="flex flex-col rounded-md">
                          <div class="relative">
                            <div
                              class="select-none mx-auto flex flex-1 justify-center rounded-xl sm:h-72 sm:w-48"
                              v-html="comic.thumb[0].responsive"
                              :alt="comic.thumb[0].alt"
                            ></div>

                            <div v-if="comic.chapters_count !== 0">

                              <div class="absolute bottom-0 left-0 right-0 px-4 py-2 flex justify-start md:justify-center">
                                <div
                                class="shrink-1  py-1 opacity-80 text-lg md:text-sm font-semibold mt-2 font-roboto capitalize text-purple-500  text-center select-none cursor-pointer flex-none flex-0 truncate border-purple-500  border-2 bg-white rounded-md w-fit px-3"
                    >
                                <p>  {{ comic.chapters_count + " Chapters " }} </p>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="justify-end flex-none">
                            <div
                              class="flex flex-col font-roboto py-4 px-4 md:px-1 text-zinc-500 sm:w-48"
                            >

                                <div
                                  class="min-h-5   text-xl md:text-md    text-left select-none cursor-pointer flex-none flex-0 dark:text-white      w-full hover:text-purple-400 dark:hover:text-purple-500 font-bold"
                                >
                                  {{ comic.title }}

                              </div>

                                <div
                                  class=" min-h-3 w-full text-sm font-medium text-left select-none cursor-pointer flex-none line-clamp-2 md:line-clamp-1 flex-0"
                                >
                                  {{ dateshow(comic.updated_at) }}

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
