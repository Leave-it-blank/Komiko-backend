<template>
  <Carousel :breakpoints="breakpoints" :wrapAround="true" :autoplay="3200" :touchDrag="false" :mouseDrag="false">
    <Slide v-for="slide in 10" :key="slide">
      <div class="carousel__item"><img class=" h-72 select-none " src="http://127.0.0.1:8000/storage/1/95e1796b-6df9-49da-a138-3c719fac9284.png" /></div>

    </Slide>

    <template #addons>
      <Navigation />

    </template>
  </Carousel>
</template>

<script >
import { defineComponent } from 'vue';
import { Carousel, Navigation, Slide,Pagination } from 'vue3-carousel';

import 'vue3-carousel/dist/carousel.css';

export default defineComponent({
  name: 'Autoplay',
  components: {
    Carousel,
    Slide,
    Navigation,

  },
   data: () => ({
    // carousel settings https://i.ibb.co/BNmpmgc/Untitled-1.jpg

    // breakpoints are mobile first
    // any settings not specified will fallback to the carousel settings
    breakpoints: {
      // 700px and up
      700: {
        itemsToShow: 2.95,
        snapAlign: 'center',
      },
      // 1024 and up
      1024: {
        itemsToShow: 3.2,
        snapAlign: 'center',
      },
      1300: {
        itemsToShow: 3.9,
        snapAlign: 'center',
      },
      1600: {
        itemsToShow: 4.9,
        snapAlign: 'center',
      },
      1800: {
        itemsToShow: 5.9,
        snapAlign: 'center',
      },
       2400: {
        itemsToShow: 6.9,
        snapAlign: 'center',
      },
     },
  }),
});
</script>

<style scoped>
.carousel__slide > .carousel__item {
  transform: scale(1);
  opacity: 0.5;
  transition: 0.5s;
}
.carousel__slide--visible > .carousel__item {
  opacity: 1;
  transform: rotateY(0);
}
.carousel__slide--next > .carousel__item {
  transform: scale(0.9) translate(-10px);
}
.carousel__slide--prev > .carousel__item {
  transform: scale(0.9) translate(10px);
}
.carousel__slide--active > .carousel__item {
  transform: scale(1.1);
}
.selector {

    -webkit-user-drag: none;
    user-select: none;
    -moz-user-select: none;
    -webkit-user-select: none;
    -ms-user-select: none;
}
</style>
