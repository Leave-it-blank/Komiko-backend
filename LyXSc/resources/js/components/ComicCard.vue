<template>

<div>
  <div class="h-full flex  px-2 py-1">
      <div class="bg-zinc-900 flex-none rounded-md ">
    <div class="flex flex-row  rounded-md">

      <div class="justify-start  flex-none">
        <img class="w-24 p-2 mx-auto rounded-md " :src="props.comic.thumb" />
      </div>
      <div class=" justify-end px-3 ml-2 flex-none">
        <div class=" flex flex-col">
          <div
            class="text-xl  mt-2  capitalize text-white hover:text-red-500  text-left select-none cursor-pointer flex-none  line-clamp-2 md:line-clamp-1  flex-0">
            {{ props.comic.title }}
          </div>
          <div class="flex  flex-0 items-center md:mt-2 flex-none bg-zinc-900 ">
            <div
              class="  chapters flex-none text-gray-500  text-xs   p-2 capitalize   cursor-pointer select-none  ">
              <div class="flex  justify-between  hover:text-gray-300   my-1">
                <div class="flex   mr-10  ">
                  <div class="line-clamp-1 mr-1">
                    chapter
                  </div>
                  <div>
                    1
                  </div>
                </div>
                <div class=" line-clamp-1 ">
                  1 Month Ago
                </div>

              </div>
              <div class="flex  justify-between hover:text-gray-300 my-1">
                <div class="flex   mr-10  ">
                  <div class="line-clamp-1 mr-1">
                    chapter
                  </div>
                  <div>
                    2
                  </div>
                </div>
                <div class=" line-clamp-1 ">
                  2 Month Ago
                </div>

              </div>
              <div class="flex  justify-between hover:text-gray-300  my-1 ">
                <div class="flex   mr-10  ">
                  <div class="line-clamp-1 mr-1">
                    chapter
                  </div>
                  <div>
                    3
                  </div>
                </div>
                <div class=" line-clamp-1 ">
                  3 Month Ago
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

const props = defineProps({
  comic: {
    type: Object,
    default: null
  }
})

</script>
