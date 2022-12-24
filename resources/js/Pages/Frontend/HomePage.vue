<template>
  <ReaderLayout>
    <Head>
      <title>HomePage - {{ $page.props.sitedata.site_name }}</title>
      <meta
        name="description"
        content="webcomics: HomePage, A place to read manga, manhua and manwha for free of cost."
      />


    </Head>
    <div class="max-w-screen-xl py-10 w-full md:mx-auto">
      <div v-if="props.carousels" class="rounded-lg">
        <CarouselCard :carousels="props.carousels" />
      </div>
      <div class="flex mt-5">
        <div class="w-full">
          <div class="flex flex-col my-2">
            <LatestUpdates :comics="props.latest" />
          </div>
          <div class="flex flex-col my-2">
            <HotUpdates :comics="props.recommended" />
          </div>
        </div>
        <!-- <div class="2xl:w-1/3 mx-5">
          <SideBar :tags="props.tags" />
        </div> -->
      </div>
    </div>
  </ReaderLayout>
</template>

<script setup>
import { Head } from "@inertiajs/inertia-vue3";
import ReaderLayout from "@/Layouts/ReaderLayout.vue";
import ComicCard from "@/components/frontend/ComicCard.vue";
import ComicRecommended from "@/components/frontend/ComicRecommended.vue";
import CarouselCard from "../../components/frontend/carousel/CarouselCard.vue";
import SideBar from "../../components/frontend/homepage/SideBar.vue";
import HotUpdates from "../../components/frontend/homepage/HotUpdates.vue";
import LatestUpdates from "../../components/frontend/homepage/LatestUpdates.vue";
const props = defineProps({
  latest: {
    type: Object,
    default: null,
  },
  recommended: {
    type: Object,
    default: null,
  },
  carousels: {
    type: Object,
    default: null,
  },
  tags: {
    type: Object,
    default: null,
  },
});
console.log(props.latest);
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
