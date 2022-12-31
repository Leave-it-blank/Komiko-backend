<template>
  <ReaderLayout>
    <Head>
      <title>{{ ctitle }} - {{ $page.props.sitedata.site_name }}</title>
      <meta
        name="description"
        :content="
          cdesc + 'Comic Pages for' + ctitle + 'Vol' + c_vol_no + 'Chapter' + c_chap_no
        "
      />
      <meta name="next" :content="nextChapter" />
      <meta name="previous" :content="previousChapter" />

      <meta
        name="image"
        v-for="page in props.pages"
        :content="page.thumb[0].responsive"
      />
      <meta property="og:type" content="website" />
      <meta property="og:title" :content="ctitle" />
      <meta property="og:description" :content="cdesc" />
      <meta
        property="og:image"
        v-for="page in props.pages"
        :content="page.thumb[0].responsive"
      />
      <meta property="og:url" :content="route().current()" />
      <meta name="twitter:title" :content="ctitle" />
      <meta name="twitter:description" :content="cdesc" />
      <meta
        name="twitter:image"
        v-for="page in props.pages"
        :content="page.thumb[0].responsive"
      />

      <meta property="twitter:url" :content="route().current()" />
    </Head>
    <div class="container mx-auto max-w-6xl pt-10 px-1">
      <div class="flex justify-between py-3 px-2 items-center">
        <div class="text-xl md:text-2xl">{{ ctitle }}</div>
        <div class="vol p-3 md:text-xl">
          <div>Vol {{ c_vol_no }}</div>
          <div>Chapter {{ c_chap_no }}</div>
        </div>
      </div>
      <div
        class="grid grid-cols-3 p-4 mb-10 mt-3 font-catamaran gap-2 bg-neutral-200 dark:bg-neutral-900 dark:text-gray-200 rounded-md text-sm"
      >
        <div
          class="px-5 py-4 rounded-md bg-purple-500 text-gray-900 dark:text-gray-200 justify-self-start"
        >
          <Link :href="previousChapter" v-if="previousChapter !== null" class=" ">
            Previous Chapter
          </Link>
          <button v-else>No Previous Chapter</button>
        </div>

        <Link
          :href="home"
          class="px-5 py-4 rounded-md bg-purple-500 text-gray-900 dark:text-gray-200 justify-self-center items-center self-center"
        >
          Home
        </Link>
        <div
          class="px-5 py-4 rounded-md bg-purple-500 text-gray-900 dark:text-gray-200 justify-self-end"
        >
          <Link :href="nextChapter" v-if="nextChapter !== null" class=" ">
            Next Chapter
          </Link>
          <button v-else>No Next Chapter</button>
        </div>
      </div>
      <div
        v-html="props.ads_reader.ads_reader_above_content"
        class="flex flex-col my-2"
      ></div>
      <div class="min-h-screen">
        <div v-for="(page, index) in props.pages" v-if="props.crawler_detected">
          <div
            class="select-none w-full"
            v-html="page.thumb[0].responsive"
            :alt="page.thumb[0].alt"
          ></div>
          <div
            v-if="index === 3"
            v-html="props.ads_reader.ads_reader_inside_content"
            class="flex flex-col my-2"
          ></div>
        </div>
      </div>
      <div class="pb-10"></div>
      <div
        class="grid grid-cols-3 p-4 mt-3 font-catamaran gap-2 bg-neutral-200 dark:bg-neutral-900 dark:text-gray-200 rounded-md text-sm"
      >
        <div
          class="px-5 py-4 rounded-md bg-purple-500 text-gray-900 dark:text-gray-200 justify-self-start"
        >
          <Link :href="previousChapter" v-if="previousChapter !== null" class=" ">
            Previous Chapter
          </Link>
          <button v-else>No Previous Chapter</button>
        </div>

        <Link
          :href="home"
          class="px-5 py-4 rounded-md bg-purple-500 text-gray-900 dark:text-gray-200 justify-self-center"
        >
          Home
        </Link>
        <div
          class="px-5 py-4 rounded-md bg-purple-500 text-gray-900 dark:text-gray-200 justify-self-end"
        >
          <Link :href="nextChapter" v-if="nextChapter !== null" class=" ">
            Next Chapter
          </Link>
          <button v-else>No Next Chapter</button>
        </div>
      </div>
      <div
        v-html="props.ads_reader.ads_reader_below_content"
        class="flex flex-col my-2"
      ></div>
      <div class="py-10 container flex flex-col">
        <h3
          class="text-xl font-roboto p-1 w-full font-bold text-gray-900 dark:text-gray-100 text-start"
        >
          {{ "Comment Section" }}
        </h3>
        <div class="py-3"></div>
        <button
          id="disq_load"
          v-on:click="loaddisq()"
          class="p-2 bg-purple-500 text-white rounded-lg center"
        >
          Click to View Comment
        </button>
        <div
          v-on:click="loaddisq()"
          id="disqus_thread"
          class="dark:text-purple-400 px-2"
        ></div>
      </div>
    </div>
  </ReaderLayout>
</template>

<script setup>
import { Head, Link } from "@inertiajs/inertia-vue3";
import ReaderLayout from "@/Layouts/ReaderLayout.vue";
import { usePage } from "@inertiajs/inertia-vue3";
const props = defineProps({
  chapter: {
    type: Object,
    default: null,
  },
  ctitle: {
    type: String,
    default: null,
  },
  cdesc: {
    type: String,
    default: null,
  },
  c_vol_no: {
    type: Number,
    default: null,
  },
  home: {
    type: String,
    default: null,
  },
  c_chap_no: {
    type: Number,
    default: null,
  },
  previousChapter: {
    type: String,
    default: null,
  },
  nextChapter: {
    type: String,
    default: null,
  },
  pages: {
    type: Object,
    default: null,
  },
  ads_reader: {
    type: Object,
    default: null,
  },
  crawler_detected: {
    type: Boolean,
    default: null,
  },

  errors: Object,
});

function loaddisq() {
  document.getElementById("disq_load").style.display = "none";
  var disqus_config = function () {
    this.page.url = route().current(); // Replace PAGE_URL with your page's canonical URL variable
    this.page.identifier = usePage().props.value.comic.titleSlug; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
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
