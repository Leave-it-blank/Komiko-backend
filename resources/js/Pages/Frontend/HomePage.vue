<template>
  <ReaderLayout>

    <Head>
      <title>{{ $page.props.sitedata.site_name }}</title>
      <meta name="description" content="webcomics: HomePage" />
    </Head>
   <div  class="max-w-screen-2xl py-10   w-full h-screen mx-auto">
        <div v-if="props.carousels" class="rounded-lg">
          <CarouselCard :carousels="props.carousels" />
        </div>
        <div  class="flex mt-10">
           <div class="bg-blue-500 h-screen w-full 2xl:w-2/3 mx-5">
           <div class="flex flex-col">

           <div class="text-3xl px-2 pt-10 pb-2 font-roboto font-bold capitalize dark:text-white">
           Hot Updates
           </div>
           <div class="flex flex-row">
              <div v-for="comic in props.comics">
            <HotUpdates :comic="comic" />

           </div>
           </div>



           </div>



           </div>
           <div class=" h-screen 2xl:w-1/3 mx-5 hidden 2xl:block">

           <div class="text-4xl  mt-5 mb-1 p-5 mx-2 font-roboto font-bold capitalize dark:text-white flex justify-center align-middle bg-yellow-500 rounded-md">
                   Join our Discord
           </div>
                <div class="text-4xl  mb-5 mt-1 p-5 mx-2 font-roboto font-bold capitalize dark:text-white flex justify-center align-middle bg-yellow-500 rounded-md">
                   Join our Patreon
           </div>

           <div class="text-3xl px-2 pt-10 pb-2 font-roboto font-bold capitalize dark:text-white">
           More to Explore
           </div>
           <div class="flex flex-row">

           <div class="bg-neutral-900 w-full h-20 m-2 rounded-lg hover:bg-neutral-800">
           </div>

           </div>

           </div>
        </div>

    </div>

  </ReaderLayout>

</template>

<script setup>
import { Head } from '@inertiajs/inertia-vue3'
import { computed, ref, onMounted } from 'vue'
import { useComicStore } from '@/stores/comic'
import ReaderLayout from '@/Layouts/ReaderLayout.vue'
import ComicCard from "@/components/frontend/ComicCard.vue";
import ComicRecommended from "@/components/frontend/ComicRecommended.vue";
import CarouselCard from '../../components/frontend/carousel/CarouselCard.vue';
import HotUpdates from '../../components/frontend/homepage/HotUpdates.vue';
 const props = defineProps({
  comics: {
    type: Object,
    default: null
  },
  recommended: {
    type: Object,
    default: null
  },
  carousels: {
    type: Object,
    default: null
  },
})
console.log(props.carousels)
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
