<template>
  <ReaderLayout>
    <Head>
      <title>{{props.comic.title}} - {{ $page.props.sitedata.site_name }}</title>
      <meta
        name="description"
        :content='props.comic.description'
      />


    </Head>
    <div class="max-w-screen-2xl py-10 w-full min-h-screen mx-auto">
      <div class="flex flex-col xl:flex-row justify-evenly sm:mx-10 gap-2">
        <div class="xl:w-8/12 w-full  rounded-lg mx-auto">
          <ComicProfile :comic="props.comic" />
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
                <div class="flex flex-row justify-between ">
                   <p class="px-2">type:</p>
                  <p>{{props.comic.type}}</p>
                  </div>
                  <div class=" flex flex-row justify-between">
                    <p class="px-2">Author: </p>
                  <p>{{props.comic.author}}</p>
                  </div>
                  <div class="flex flex-row justify-between ">
                   <p class="px-2">Artist:</p>
                  <p>{{props.comic.artist}}</p>
                  </div>
                  <div class="flex flex-row justify-between ">
                   <p class="px-2">Last Updated:</p>
                  <p>{{  dateshow(props.comic.updated_at)}}</p>
                  </div>
                  <div class="flex flex-row justify-between ">
                   <p class="px-2">Created:</p>
                  <p>{{ dateshow2(props.comic.created_at)}}</p>
                  </div>
                  <div class="flex flex-row justify-between ">
                   <p class="px-2">Mature:</p>
                  <p class=" ">{{isMature}}</p>
                  </div>
                  <div class="flex flex-row justify-between ">
                   <p class="px-2">Locked:</p>
                  <p>{{isLocked }}</p>
                  </div>
                  <div class="flex flex-row justify-between ">
                   <p class="px-2">publisher:</p>
                  <p>{{props.comic.publisher }}</p>
                  </div>
               </div>
             </p>

          </div>
          <div
            class="flex flex-col md:flex-col justify-center sm:justify-evenly gap-3 my-2 mx-auto sm:mb-5 bg-neutral-200 dark:bg-neutral-900 py-5 md:px-24 px-2 xl:px-5 rounded-lg min-w-fit"
          >

          <!-- here we will put description inside box -->
            <h3 class="text-xl font-roboto p-1   w-full text-justify max-w-md xl:mx-auto font-bold text-gray-900 dark:text-gray-100">
              {{ "Comment Section" }}
              </h3>
              <div class="py-3"></div>
                   <div  id="disqus_thread" class=" dark:text-purple-400 "></div>
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
