<template>
<ReaderLayout>
<div class="container  mx-auto my-10 flex flex-col justify-center">


 <div class="   mx-auto p-4 select-none" >
 <ComicCarousel/>
 </div>
 <div class="  my-5 flex sm:flex-row flex-wrap   sm:space-x-4 justify-center">


  <div class="bg-zinc-800 sm:p-3 rounded-md flex-none  md:w-3/5">
    <div class="mx-auto p-4 select-none" >
     <Carousel/>
     </div>


    <div class="  pr-2">
      <div class=" px-3 text-3xl   text-white">
       {{ 'New Release'}}
      </div>
    <div class="  flex py-2 items-center">

         <div class=" flex-grow border-t border-gray-400 text-2xl   ">
         </div>
      </div>

   <div class="flex flex-col  sm:flex-row flex-wrap justify-center " >


    <div v-for="comic in props.comics"   >

        <ComicCard  :comic="comic"/>

    </div>

    </div>
    </div>

  </div>
<div class="bg-red-500 h-screen w-full md:w-1/5 sm:flex-none rounded-md p-2 my-5 sm:my-0">

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
import  Carousel from '@/components/Carousel.vue'
const props = defineProps({ comics: {
    type: Object,
    default: null
  }} )
</script>
