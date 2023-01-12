<template>
  <ReaderLayout>
    <Head>
      <title>{{props.comic.title}} - {{ $page.props.sitedata.site_name }}</title>
      <meta
        name="description"
        :content='props.comic.description'
      />
      <meta name="image" :content="props.comic.chapterthumb[0].responsive" />
      <meta property="og:type" content="website" />

      <meta
        property="og:title"
        :content="props.comic.title"
      />
      <meta
        property="og:description"
        :content="props.comic.description"
      />
      <meta property="og:image" :content="props.comic.chapterthumb[0].responsive" />
      <meta
        property="og:url"
        :content="route().current()"
      />


      <meta name="twitter:title" :content="props.comic.title" />
    <meta name="twitter:description" :content="props.comic.description" />
    <meta name="twitter:image" :content="props.comic.chapterthumb[0].responsive" />


      <meta
        property="twitter:url"
        :content="route().current()"
      />

    </Head>
    <div class="max-w-screen-2xl py-10 w-full min-h-screen mx-auto">
      <div class="flex flex-col xl:flex-row justify-evenly sm:mx-10 gap-2">
        <div class="xl:w-8/12 w-full  rounded-lg mx-auto">
          <ComicProfile :comic="props.comic" :ads_comic="ads_comic"/>

          <div
            class="flex flex-col md:flex-col justify-center sm:justify-evenly gap-3 my-2 mx-auto  bg-neutral-200 dark:bg-neutral-900 py-5   rounded-lg min-w-fit px-5 sm:px-10"
          >

          <!-- here we will put description inside box -->
            <h3 class="text-xl font-roboto p-1   w-full text-left max-w-md   font-bold text-gray-900 dark:text-gray-100">
              {{ "Comment Section" }}
              </h3>
              <div class="py-3"></div>
                   <div  id="disqus_thread" class=" dark:text-purple-400 "></div>
       </div>
        </div>
        <div class="rounded-lg w-full  xl:w-4/12 xl:ml-10 mx-auto">
          <div
            class="flex flex-col md:flex-col justify-center sm:justify-evenly gap-3 my-2 mx-auto sm:mb-5 bg-neutral-200 dark:bg-neutral-900 py-5 md:px-24 px-2 xl:px-5 rounded-lg min-w-fit"
          >

          <!-- here we will put description inside box -->
            <h3 class="text-xl font-roboto p-1   w-full text-justify max-w-md xl:mx-auto font-bold text-gray-900 dark:text-gray-100">
              {{ "Description" }}
              </h3>

             <p class="font-catamaran text-justify p-2 sm:mx-auto text-gray-800 dark:text-gray-400  ">
              {{ props.comic.description }}
             </p>
             <h3 class="text-xl font-roboto p-1 font-bold w-full text-justify max-w-md xl:mx-auto text-gray-900 dark:text-gray-100">
                Source
             </h3>
             <p>
               <div class=" flex flex-col justify-center p-3 mx-2 capitalize text-gray-800 dark:text-gray-400">

                  <div class=" flex flex-row justify-between">
                    <p class="px-2">Author: </p>
                  <p class="text-white">{{props.comic.author}}</p>
                  </div>
                  <div class="flex flex-row justify-between ">
                   <p class="px-2">Artist:</p>
                   <p class="text-white">{{props.comic.artist}}</p>
                  </div>
                  <div class="flex flex-row justify-between ">
                   <p class="px-2">Last Updated:</p>
                   <p class="text-white">{{  dateshow(props.comic.updated_at)}}</p>
                  </div>
                  <div class="flex flex-row justify-between ">
                   <p class="px-2">Created:</p>
                   <p class="text-white">{{ dateshow2(props.comic.created_at)}}</p>
                  </div>
                  <div class="flex flex-row justify-between ">
                   <p class="px-2">Mature:</p>
                   <p class="text-white">{{isMature}}</p>
                  </div>
                  <div class="flex flex-row justify-between ">
                   <p class="px-2">Locked:</p>
                   <p class="text-white">{{isLocked }}</p>
                  </div>
                  <div class="flex flex-row justify-between ">
                   <p class="px-2">publisher:</p>
                   <p class="text-white">{{props.comic.publisher }}</p>
                  </div>
               </div>
             </p>

          </div>
          <div v-html="props.ads_comic.ads_above_comment" class="flex flex-col my-2 mb-5"></div>
          <div
            class="flex flex-col md:flex-col justify-center sm:justify-evenly gap-3 my-2 mx-auto sm:mb-5 bg-neutral-200 dark:bg-neutral-900 py-5 md:px-24 px-2 xl:px-5 rounded-lg min-w-fit"
          >

          <!-- here we will put description inside box -->
            <h3 class="text-xl font-roboto p-1   w-full text-justify max-w-md xl:mx-auto font-bold text-gray-900 dark:text-gray-100">
              {{ "Recommended" }}
              </h3>
              <div class="py-3"></div>
                   <div class="grid overflow-hidden grid-cols-3 grid-rows-1 gap-4 text-white   ">
<div class=" row-span-1 dark:bg-darkMode rounded-md">
<a :href="$page.props.sitedata.discord_invite" target="_blank" class="transition inline-flex items-center justify-center rounded w-full border border-transparent bg-neutral-850 p-6 text-white shadow-sm hover:bg-purple-500 focus:outline-none focus:ring-0">
<svg class="svg-inline--fa fa-discord h-8 w-8" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="discord" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" data-fa-i2svg=""><path fill="currentColor" d="M524.531,69.836a1.5,1.5,0,0,0-.764-.7A485.065,485.065,0,0,0,404.081,32.03a1.816,1.816,0,0,0-1.923.91,337.461,337.461,0,0,0-14.9,30.6,447.848,447.848,0,0,0-134.426,0,309.541,309.541,0,0,0-15.135-30.6,1.89,1.89,0,0,0-1.924-.91A483.689,483.689,0,0,0,116.085,69.137a1.712,1.712,0,0,0-.788.676C39.068,183.651,18.186,294.69,28.43,404.354a2.016,2.016,0,0,0,.765,1.375A487.666,487.666,0,0,0,176.02,479.918a1.9,1.9,0,0,0,2.063-.676A348.2,348.2,0,0,0,208.12,430.4a1.86,1.86,0,0,0-1.019-2.588,321.173,321.173,0,0,1-45.868-21.853,1.885,1.885,0,0,1-.185-3.126c3.082-2.309,6.166-4.711,9.109-7.137a1.819,1.819,0,0,1,1.9-.256c96.229,43.917,200.41,43.917,295.5,0a1.812,1.812,0,0,1,1.924.233c2.944,2.426,6.027,4.851,9.132,7.16a1.884,1.884,0,0,1-.162,3.126,301.407,301.407,0,0,1-45.89,21.83,1.875,1.875,0,0,0-1,2.611,391.055,391.055,0,0,0,30.014,48.815,1.864,1.864,0,0,0,2.063.7A486.048,486.048,0,0,0,610.7,405.729a1.882,1.882,0,0,0,.765-1.352C623.729,277.594,590.933,167.465,524.531,69.836ZM222.491,337.58c-28.972,0-52.844-26.587-52.844-59.239S193.056,219.1,222.491,219.1c29.665,0,53.306,26.82,52.843,59.239C275.334,310.993,251.924,337.58,222.491,337.58Zm195.38,0c-28.971,0-52.843-26.587-52.843-59.239S388.437,219.1,417.871,219.1c29.667,0,53.307,26.82,52.844,59.239C470.715,310.993,447.538,337.58,417.871,337.58Z"></path></svg><!-- <i class="fa-brands fa-discord h-8 w-8"></i> Font Awesome fontawesome.com -->
 </a>
</div>
<div class=" row-span-1 dark:bg-darkMode rounded-md">
<a :href="$page.props.sitedata.paypal" target="_blank" class="transition inline-flex items-center justify-center rounded w-full border border-transparent bg-neutral-850 p-6 text-white shadow-sm hover:bg-purple-500 focus:outline-none focus:ring-0">
<svg class="svg-inline--fa fa-paypal h-8 w-8" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="paypal" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" data-fa-i2svg=""><path fill="currentColor" d="M111.4 295.9c-3.5 19.2-17.4 108.7-21.5 134-.3 1.8-1 2.5-3 2.5H12.3c-7.6 0-13.1-6.6-12.1-13.9L58.8 46.6c1.5-9.6 10.1-16.9 20-16.9 152.3 0 165.1-3.7 204 11.4 60.1 23.3 65.6 79.5 44 140.3-21.5 62.6-72.5 89.5-140.1 90.3-43.4.7-69.5-7-75.3 24.2zM357.1 152c-1.8-1.3-2.5-1.8-3 1.3-2 11.4-5.1 22.5-8.8 33.6-39.9 113.8-150.5 103.9-204.5 103.9-6.1 0-10.1 3.3-10.9 9.4-22.6 140.4-27.1 169.7-27.1 169.7-1 7.1 3.5 12.9 10.6 12.9h63.5c8.6 0 15.7-6.3 17.4-14.9.7-5.4-1.1 6.1 14.4-91.3 4.6-22 14.3-19.7 29.3-19.7 71 0 126.4-28.8 142.9-112.3 6.5-34.8 4.6-71.4-23.8-92.6z"></path></svg><!-- <i class="fa-brands fa-paypal h-8 w-8"></i> Font Awesome fontawesome.com -->
</a>
</div>
<div class=" row-span-1 dark:bg-darkMode rounded-md">
<a :href="$page.props.sitedata.patreon" target="_blank" class="transition inline-flex items-center justify-center content-center rounded w-full border border-transparent bg-neutral-850 p-6 text-white shadow-sm hover:bg-purple-500 focus:outline-none focus:ring-0">
  <svg class="svg-inline--fa fa-square-patreon h-8 w-8 text-white  "  enable-background="new 0 0 32 32" viewBox="0 0 32 32"><path fill="#ffe6e2" d="m26 32h-20c-3.314 0-6-2.686-6-6v-20c0-3.314 2.686-6 6-6h20c3.314 0 6 2.686 6 6v20c0 3.314-2.686 6-6 6z"/><path fill="#fd907e" d="m8 8.333h2.813v15.333h-2.813z"/><path fill="#fc573b" d="m18.256 8.333c-3.178 0-5.763 2.582-5.763 5.755 0 3.166 2.585 5.74 5.763 5.74 3.169 0 5.744-2.577 5.744-5.74 0-3.172-2.575-5.755-5.744-5.755z"/></svg>
</a>
</div>
</div>
          </div>
        </div>

      </div>

    </div>
  </ReaderLayout>
</template>

<script setup>
import { Head } from "@inertiajs/inertia-vue3";
import { computed, ref, onMounted } from "vue";
import ReaderLayout from "@/Layouts/ReaderLayout.vue";
import ComicProfile from "@/components/frontend/comic/ComicProfile.vue";
import moment from "moment";
import { usePage } from '@inertiajs/inertia-vue3'
function dateshow(value) {
  return moment(value).fromNow(); // here u modify data
}

function dateshow2(value) {
  return moment(value).format("MMM Do YY"); // here u modify data
}
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

const isMature = computed(() => {
    if(props.comic.isMature == 1){
        return "Ayo";
    }else {
      return "Neh";
    }
});
const isLocked = computed(() => {
    if(props.comic.isLocked == 1){
        return "Ayo";
    }else {
      return "Neh";
    }
});
//console.log(usePage().props.value.sitedata.site_name)
onMounted(() => {


  var disqus_config = function () {
    this.page.url = route().current();  // Replace PAGE_URL with your page's canonical URL variable
    this.page.identifier = usePage().props.value.comic.titleSlug; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
    };
  var disqus_shortname = usePage().props.value.sitedata.disqus_shortname;
    (function() { // DON'T EDIT BELOW THIS LINE
    var d = document, s = d.createElement('script');
    s.src = 'https://'+disqus_shortname+'.disqus.com/embed.js';
    s.setAttribute('data-timestamp', +new Date());
    (d.head || d.body).appendChild(s);
    })();

});

</script>
