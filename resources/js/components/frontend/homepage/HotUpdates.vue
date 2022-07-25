<template>

  <div>
    <div class="  flex px-2 py-1">
      <div class="bg-zinc-900 flex-none rounded-md  ">
        <div class="flex flex-col  rounded-md ">

          <div class=" ">

             <div class="image select-none  mx-auto  rounded-xl  w-48" v-html="props.comic.thumb[0].responsive"    :alt="props.comic.thumb[0].alt" ></div>

          </div>
          <div class=" justify-end ml-2 flex-none">
            <div class=" flex flex-row">
            <Link :href="route(props.comic.viewUrl, props.comic.titleslug)">
             <div
                class="text-xl  mt-2  capitalize text-white hover:text-red-500  text-left select-none cursor-pointer flex-none  line-clamp-2 md:line-clamp-1  flex-0">
                {{ props.comic.title }}
              </div>
            </Link>

               <div
                class="text-xl  mt-2  capitalize text-white hover:text-red-500  text-left select-none cursor-pointer flex-none  line-clamp-2 md:line-clamp-1  flex-0">
                {{ props.comic.title }}
              </div>



            </div>

          </div>

        </div>

      </div>
    </div>

  </div>

</template>
<script setup>
import moment from 'moment'
import { Head, Link } from '@inertiajs/inertia-vue3';
const props = defineProps({
  comic: {
    type: Object,
    default: null
  }
})
console.log(props.comic)
function dateshow(value) {
    return moment(value).fromNow() // here u modify data
}

</script>
