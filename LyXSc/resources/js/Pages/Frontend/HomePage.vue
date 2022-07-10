<template>
  <ReaderLayout>
    <Head>
  <title>{{$page.props.sitedata.site_name}}</title>
  <meta name="description" content="webcomics: HomePage" />
</Head>
    <div class="container  mx-auto my-1 sm:my-10 flex flex-col justify-center">


      <div class="   mx-auto  select-none">

      </div>
      <div class="  my-5 flex sm:flex-row flex-wrap  xl:space-x-4 justify-center  ">


        <div class="bg-neutral-200 dark:bg-zinc-800  w-full sm:p-3  rounded-md pb-3 mb-2 xl:mb-0  max-w-3xl">
          <div class="mx-auto p-4 select-none">
            <Carousel  :carousels="props.carousels"/>
          </div>


          <div class="pr-2">
            <div class=" px-3 text-xl text-purple-400 font-semibold  dark:text-white">
              {{ 'Latest' }}
            </div>
            <div class="  flex py-2 items-center">

              <div class=" flex-grow border-t border-gray-400 text-2xl   ">
              </div>
            </div>

            <div class="flex  flex-row flex-wrap justify-center md:justify-between md:p-4">


              <div v-for="comic in props.comics">

                <ComicCard :comic="comic" />

              </div>

            </div>
          </div>

        </div>
        <div
          class="bg-neutral-200 dark:bg-zinc-800   w-full max-w-3xl  xl:max-w-sm xl:flex-none rounded-md xl:px-2  pt-2">

       <div class="pr-2 pt-2">
            <div class=" px-3 text-xl font-semibold text-purple-400  dark:text-white">
              {{ 'Recommended' }}
            </div>
            <div class="  flex py-2 items-center">

              <div class=" flex-grow border-t border-gray-400 text-2xl sm::p-4  ">
              </div>
            </div>
            <div    class="sm:px-3">
              <div class="flex  flex-row flex-wrap justify-center md:justify-between md:p-4  ">


              <div v-for="comic in props.recommended">

                <ComicCard :comic="comic" />

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

import { Head } from '@inertiajs/inertia-vue3'
import { computed, ref, onMounted } from 'vue'
import { useComicStore } from '@/stores/comic'
import ComicCarousel from '@/components/ComicCarousel.vue'
import ReaderLayout from '@/Layouts/ReaderLayout.vue'
import ComicCard from "@/components/ComicCard.vue";
import Carousel from '@/components/Carousel.vue'
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
</script>
