<template>
<ReaderLayout>
  <div class="flex flex-row justify-center">

    <div  >
      <img class="w-60 h-72" :src="props.comic.thumb">
</div>
  </div>


</ReaderLayout>

</template>

<script setup>

import { Head } from '@inertiajs/inertia-vue3'
import { computed, ref, onMounted } from 'vue'
import { useComicStore } from '@/stores/comic'
import ComicCarousel from '@/components/frontend/ComicCarousel.vue'
import ReaderLayout from '@/Layouts/ReaderLayout.vue'


const props = defineProps({
  comic: {
    type: Object,
    default: null
  },

  errors: Object,
})
</script>
