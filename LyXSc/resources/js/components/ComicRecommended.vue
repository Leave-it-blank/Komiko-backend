<template>

  <div>
    <div class="h-56 flex px-2 py-1">
      <div class="bg-zinc-900 flex-none rounded-md comicChapter">
        <div class="flex flex-row  rounded-md ">

          <div class="justify-start ImgContent R82hs">
            <img height="80" class="SZqc3" src="https://inkr.com/svg/trending-rank-number/1.svg" alt=""/>
            <div class="Q9Bsa __33XQb">
              <img class="w-28 pr-2 mx-auto rounded-md comicImg" :src="props.comic.thumb" />
            </div>
          </div>
          <div class=" justify-end ml-2 flex-none">
            <div class=" flex flex-col">
            <Link :href="route(props.comic.viewUrl, props.comic.titleslug)">
              <div
                class="text-xl  mt-2  capitalize text-white hover:text-red-500  text-left select-none cursor-pointer flex-none  line-clamp-2 md:line-clamp-1  flex-0">
                {{ props.comic.title }}
              </div>
            </Link>


              <div class="flex flex-0 items-center md:mt-2 flex-none bg-zinc-900" >
                <div
                  class="chapters flex-none text-gray-500 text-xs capitalize cursor-pointer select-none">

                  <div v-for="volume in props.comic.volumes">
                    <div v-for="(chapter, index) in volume.chapters" >
                      <div  class="flex justify-between  hover:text-gray-300 divchapter">
                        <div class="flex mr-1 text-zinc-500 font-bold hover:text-gray-300 ">
                          <div class="line-clamp-1 ml-2">
                            chapter {{ chapter.number }}
                          </div>
                          <div class=" line-clamp-1 ml-4">
                            {{dateshow(chapter.updated_at)}}
                          </div>
                        </div>
                      </div>
                    </div>

                  </div>
                </div>
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

function dateshow(value) {
    return moment(value).fromNow() // here u modify data
}

</script>
