<template>
  <ReaderLayout>
    <Head>
      <title>HomePage - {{ $page.props.sitedata.site_name }}</title>
      <meta
        name="description"
        content="comics: HomePage, A place to read manga, manhua and manwha for free of cost."
      />
      <meta property="og:type" content="website" />
      <meta property="og:title" content="HomePage, where you can read comics for free." />
      <meta
        property="og:description"
        content="comics: HomePage, A place to read manga, manhua and manwha for free of cost."
      />
      <!-- <meta property="og:image" content="LINK TO THE IMAGE FILE" /> -->
      <meta property="og:url" :content="$page.props.sitedata.site_url" />

      <meta
        name="twitter:title"
        content="HomePage, where you can read comics for free."
      />
      <meta
        name="twitter:description"
        content="webcomics: HomePage, A place to read manga, manhua and manwha for free of cost."
      />
    </Head>
    <div class="max-w-screen-xl py-10 w-full md:mx-auto">
      <div v-if="$page.props.sitedata.carousel">
        <div v-if="props.carousels" class="rounded-lg">
          <CarouselCard :carousels="props.carousels" />
        </div>
      </div>

      <div class="flex mt-5">
        <div class="w-full">
          <div class="flex flex-col my-2">
            <LatestUpdates :comics="props.latest" />
          </div>
          <div v-html="props.ads_home.above_rec" class="flex flex-col my-2"></div>
          <div class="flex flex-col my-2">
            <HotUpdates :comics="props.recommended" />
          </div>
          <div v-html="props.ads_home.below_rec" class="flex flex-col my-2"></div>
          <div class="py-10 container flex flex-col mx-auto px-2 sm:px-10">
            <h1
              class="text-3xl px-2 pt-10 pb-2 font-roboto font-bold capitalize dark:text-white"
            >
              {{ "Comment Section" }}
            </h1>
            <div class="py-3">
              <button
                id="disq_load"
                v-on:click="loaddisq()"
                class="p-2 bg-purple-500 text-white rounded-lg center w-full"
              >
                Click to View Comment
              </button>
              <div
                v-on:click="loaddisq()"
                id="disqus_thread"
                class="dark:text-purple-400 px-2 w-full"
              ></div>
            </div>
          </div>
        </div>
        <!-- <div class="2xl:w-1/3 mx-5">
          <SideBar :tags="props.tags" />
        </div> -->
      </div>
    </div>
  </ReaderLayout>
</template>

<script setup>
import { Head } from "@inertiajs/inertia-vue3";
import ReaderLayout from "@/Layouts/ReaderLayout.vue";
import { usePage } from "@inertiajs/inertia-vue3";
import CarouselCard from "../../components/frontend/carousel/CarouselCard.vue";

import HotUpdates from "../../components/frontend/homepage/HotUpdates.vue";
import LatestUpdates from "../../components/frontend/homepage/LatestUpdates.vue";
const props = defineProps({
  latest: {
    type: Object,
    default: null,
  },
  recommended: {
    type: Object,
    default: null,
  },
  carousels: {
    type: Object,
    default: null,
  },
  tags: {
    type: Object,
    default: null,
  },
  ads_home: {
    type: Object,
    default: null,
  },
});

function loaddisq() {
  document.getElementById("disq_load").style.display = "none";
  var disqus_config = function () {
    this.page.url = route().current(); // Replace PAGE_URL with your page's canonical URL variable
    this.page.identifier = "HomePage"; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
  };
  var disqus_shortname = usePage().props.value.sitedata.disqus_shortname;
  (function () {
    // DON'T EDIT BELOW THIS LINE
    var d = document,
      s = d.createElement("script");
    s.src = "https://" + disqus_shortname + ".disqus.com/embed.js";
    s.setAttribute("data-timestamp", +new Date());
    (d.head || d.body).appendChild(s);
  })();
}
</script>
