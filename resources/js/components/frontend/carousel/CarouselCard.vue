<template>
  <div class="relative">
  <swiper
    :pagination="{
      dynamicBullets: true,
    }"
    :navigation="true"
    :modules="modules"
    class="mySwiper rounded-md text-yellow-500"

  >
    <swiper-slide v-for="item in  carousels" :key="item.position">
        <Link :href="item.url" >
            <div class="image select-none  rounded-xl " v-html="item.img[0].responsive" :alt="item.img[0].alt"></div>
</Link>
            </swiper-slide>

  </swiper>
  </div>
</template>


<script>
// Import Swiper Vue.js components
import { Swiper, SwiperSlide } from "swiper/vue";
import { Link } from '@inertiajs/inertia-vue3';
// Import Swiper styles
import "swiper/css";
import "swiper/css/pagination";
import "swiper/css/navigation";
// import required modules
import { Pagination, Navigation } from "swiper";

export default {
  props: {
   carousels: {
    type: Object,
    default: null
  },
  },
  components: {
    Swiper,
    SwiperSlide,
    Link
  },
  setup() {
    return {
      modules: [Pagination, Navigation],
    };
  },
};
</script>

  <style scoped>
  .swiper {
  width: 100%;
  height: 100%;


}

.swiper-slide {

  text-align: center;
  font-size: 58px;



  /* Center slide text vertically */
  display: -webkit-box;
  display: -ms-flexbox;
  display: -webkit-flex;
  display: flex;
  -webkit-box-pack: center;
  -ms-flex-pack: center;
  -webkit-justify-content: center;
  justify-content: center;
  -webkit-box-align: center;
  -ms-flex-align: center;
  -webkit-align-items: center;
  align-items: center;
}

.swiper-slide img {
  display: inline;
  width: 100%;
  height: 100%;
  min-height: 150px;
  max-height: 350px;
  object-fit: fill;
}
@media only screen and (min-width: 768px) {
  .swiper-slide img {
  object-fit: contain;
}
}

    /*loadin*/
    @-webkit-keyframes loading-7{
      0%{margin-bottom:0}
      50%{margin-bottom:20px;}
      100%{margin-bottom:0px;}
    }
    .loadingDot .loading-7 i {
      display: inline-block;
      margin-left: 5px;
      background: #333;
      width: 16px;
      height: 16px;
      border-radius: 50%;
    }
    .loadingDot i:nth-child(1) {
      -webkit-animation: loading-7 .7s ease-in 0s loopedSlides;
      animation: loading-7 .7s ease-in 0s loopedSlides;
    }
    .loadingDot i:nth-child(2) {
      -webkit-animation: loading-7 .7s ease-in 0.15s loopedSlides;
    }
    .loadingDot i:nth-child(3) {
      -webkit-animation: loading-7 .7s ease-in 0.3s loopedSlides;
    }
    .loadingDot i:nth-child(4) {
      -webkit-animation: loading-7 .7s ease-in 0.45s loopedSlides;
    }
  </style>

