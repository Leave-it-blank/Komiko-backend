<template>
  <ReaderLayout>
    <Head>
      <title>{{ "Bookmarks - " + $page.props.sitedata.site_name }}</title>

      <meta
        name="description"
        content="Bookmarks: List of all the comics you can enjoy on our website including your most favorite manga, manhua and manwha."
      />

      <meta property="og:type" content="website" />
      <meta
        property="og:title"
        :content="'Bookmarks - ' + $page.props.sitedata.site_name"
      />
      <meta
        property="og:description"
        content="Bookmarks: List of all the comics you can enjoy on our website including your most favorite manga, manhua and manwha."
      />
      <!-- <meta property="og:image" content="LINK TO THE IMAGE FILE" /> -->
      <meta property="og:url" :content="$page.props.sitedata.site_url + '/bookmarks'" />

      <meta
        name="twitter:title"
        :content="'Bookmarks - ' + $page.props.sitedata.site_name"
      />
      <meta
        name="twitter:description"
        content="Bookmarks: List of all the comics you can enjoy on our website including your most favorite manga, manhua and manwha."
      />
      <!-- <meta name="twitter:image" content="LINK TO IMAGE" /> -->

      <meta
        property="twitter:url"
        :content="$page.props.sitedata.site_url + '/bookmarks'"
      />
    </Head>
    <div class="max-w-screen-xl py-10 w-full md:mx-auto">
      <div class="flex mt-5">
        <div class="w-full">
          <div class="flex flex-col my-2">
            <div class="sm:mx-10">
              <h1
                class="text-3xl px-2 pt-10 pb-2 font-roboto font-bold capitalize dark:text-white"
              >
                bookmarks
              </h1>

              <div
                class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5 pb-2 gap-2 md:gap-4 mx-auto justify-center sm:justify-start overflow-clip w-full"
              >
                <div
                  v-for="comic in bookmarks"
                  :key="comic[0]"
                  class="m-2 grow flex justify-center"
                >
                  <Link :href="comic[1][2]">
                    <div class="px-2 py-1 h-content bg-transparent">
                      <div class="flex flex-shrink rounded-md">
                        <div class="flex flex-col rounded-md">
                          <div class="relative">
                            <div
                              class="select-none mx-auto flex flex-1 justify-center rounded-xl sm:h-72 w-full sm:w-48"
                              v-html="comic[1][1][0].responsive"
                              :alt="comic[1][1][0].alt"
                            ></div>
                          </div>
                          <div class="justify-end flex-none">
                            <div
                              class="flex flex-col font-roboto py-4 px-4 md:px-1 text-zinc-500 sm:w-48"
                            >

                                <div
                                  class="min-h-5 w-full text-md text-left select-none cursor-pointer flex-none flex-0 dark:text-white    hover:text-purple-400 dark:hover:text-purple-500 font-bold"
                                >
                                  {{ comic[1][0] }}

                              </div>

                                <div
                                  class="  min-h-3 w-full text-sm font-medium text-left select-none cursor-pointer flex-none line-clamp-2 md:line-clamp-1 flex-0"
                                >
                                  {{ dateshow(comic[1][3]) }}

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

const bookmarks = new Map(JSON.parse(localStorage.getItem("bookmarks")));
function dateshow(value) {
  return moment(value).fromNow(); // here u modify data
}
</script>
