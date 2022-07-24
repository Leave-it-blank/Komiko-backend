<template>
  <Carousel   :wrap-around="true"    :autoplay="4200" :touchDrag="false" :mouseDrag="false">
    <Slide v-for="(xCarousel, slide) in props.carousels " :key="slide">
     <div class="carousel__item"><img class=" select-none selector h-full w-full" :src="xCarousel.img" /></div>

    </Slide>

    <template #addons>
            <Navigation />
      <Pagination />

    </template>
  </Carousel>
</template>
<script setup>
const props = defineProps({
  carousels: {
    type: Object,
    default: null
  }
})

</script>
<script >
import { defineComponent } from 'vue'
import { Carousel,Navigation, Pagination, Slide } from 'vue3-carousel';
import 'vue3-carousel/dist/carousel.css';


export default defineComponent({
  name: 'Autoplay',
  components: {
    Carousel,
    Slide,
    Pagination,
    Navigation
  },
});
</script>
