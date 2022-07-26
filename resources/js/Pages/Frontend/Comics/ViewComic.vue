<template>
<ReaderLayout>
  <div class="max-w-screen-2xl py-10 w-full h-screen mx-auto">
    <div class="flex flex-col xl:flex-row justify-evenly mx-10 gap-2">
      <div class="bg-neutral-900 h-screen xl:w-8/12 rounded-lg">
         <ComicProfile :comic="props.comic" />

       </div>
       <div class="bg-neutral-900 rounded-lg h-screen xl:w-4/12 xl:ml-10">


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
import ComicProfile from "@/components/frontend/comic/ComicProfile.vue"

const props = defineProps({
  comic: {
    type: Object,
    default: null
  },

  errors: Object,
})
</script>
