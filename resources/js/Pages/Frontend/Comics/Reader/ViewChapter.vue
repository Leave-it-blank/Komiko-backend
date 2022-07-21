<template>
<ReaderLayout>
  <div class="flex flex-row justify-center">

    <div  >
    {{props.chapter.number}}
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


const props = defineProps({
  chapter: {
    type: Object,
    default: null
  },
  pages: {
    type: Object,
    default: null
  },


  errors: Object,
})
</script>
