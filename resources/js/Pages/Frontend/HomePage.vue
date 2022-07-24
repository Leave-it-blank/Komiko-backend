<template>
  <ReaderLayout>

    <Head>
      <title>{{ $page.props.sitedata.site_name }}</title>
      <meta name="description" content="webcomics: HomePage" />
    </Head>
  <div  class="max-w-screen-2xl py-10 bg-blue-400 w-full h-screen mx-auto">
        <div v-if="props.carousels" class="rounded-lg">
          <CarouselCard :carousels="props.carousels" />
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
console.log(props.recommended)
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
