<script setup>

import AppLayout from '@/Layouts/App.vue';
import { Head } from '@inertiajs/inertia-vue3'
import { ref, reactive } from 'vue'
import { mdiMonitorCellphone, mdiAccountMultiple, mdiTableBorder, mdiTableOff } from '@mdi/js'
import SectionMain from '@/components/SectionMain.vue'
import NotificationBar from '@/components/NotificationBar.vue'
import CardBox from '@/components/CardBox.vue'
import SectionTitleBar from '@/components/SectionTitleBar.vue'
import SectionHeroBar from '@/components/SectionHeroBar.vue'
import ComicsTable from '@/components/ComicsTable.vue';
import { useForm } from '@inertiajs/inertia-vue3'
import DividerHorizontal from '@/components/DividerHorizontal.vue'
import BaseButton from '@/components/BaseButton.vue';

const props = defineProps({

carousel:{
  type: Object,
  default: null
},
  errors: Object,

})
const comicForm = useForm({
  name: props.carousel.name,
  position: props.carousel.position,
  url: props.carousel.url,
  is_enabled: props.carousel.is_enabled,
  thumb: '',

})
function submit() {

  comicForm.clearErrors()
  //console.log(comicForm);
  let url = route('comic.management.carousel.store.update', props.carousel.id)
  comicForm.post(url)

}
const titleStack = ref(['Dashboard', 'Comics', 'Create Carousel'])

</script>

<template>


  <AppLayout>

    <Head title="Carousels" />
    <SectionTitleBar :title-stack="titleStack" routeName="admin.management.carousel"/>

    <SectionMain>
      <div>

        <div class="container p-1 mx-auto text-gray-800  dark:text-white md:p-10">
          <div class="flex justify-between">
            <div class=" mx-1 my-2 ">

              <BaseButton label=" Create Comic" active color="info" />
            </div>
            <div class="mx-1 my-2 ">

              <BaseButton label="Go Back" routeName="comics_management.comics" color="info" />
            </div>
          </div>
          <form @submit.prevent="submit" enctype="multipart/form-data">
            <div class="p-1 mt-5 bg-white rounded-md border shadow-sm md:p-5 dark:bg-gray-900/70  border-light">
              <div class="grid grid-cols-2 p-3">
                <div class="pr-3">
                  <div>
                    <label class="text-primary-dark  dark:text-primary-light" for="name">Name</label>
                  </div>
                  <input v-model.lazy="comicForm.name"
                    class="w-full bg-transparent rounded-md border-primary-dark dark:border-primary-light focus:border-primary-lighter"
                    type="text" name="name" placeholder="Solo Login">

                  <div v-if="errors.name" class="p-1 text-sm text-red-300">{{ errors.name }} </div>

                </div>
                <div class="pr-3">
                  <div>
                    <label class="text-primary-dark  dark:text-primary-light" for="name">URL</label>
                  </div>
                  <input v-model.lazy="comicForm.url"
                    class="w-full bg-transparent rounded-md border-primary-dark dark:border-primary-light focus:border-primary-lighter"
                    type="text" name="url" placeholder="https://scans.com/series/32">

                  <div v-if="errors.url" class="p-1 text-sm text-red-300">{{ errors.url }} </div>

                </div>
              </div>

              <div class="grid grid-cols-8 gap-3 my-4">
                <div class="col-span-8 sm:col-span-4 xl:col-span-2">
                  <label class="block text-sm font-medium text-primary-dark dark:text-primary-light">Visibility</label>
                  <select v-model.lazy="comicForm.position" name="is_enabled" autocomplete="country-name"
                    class="block px-3 py-2 mt-1 mr-3 w-full bg-transparent rounded-md border shadow-sm dark:text-gray-400 border-primary-dark dark:border-primary-light focus:outline-none focus:ring-primary-lighter focus:border-primary-lighter sm:text-sm">

                    <option :value="1">First</option>
                    <option :value="2">Second</option>
                     <option :value="3">Third</option>
                      <option :value="4">Fourth</option>
                       <option :value="5">Fifth</option>
                  </select>
                  <div v-if="errors.position" class="p-1 text-sm text-red-300">{{ errors.position }} </div>

                </div>
                <div class="col-span-8 sm:col-span-4 xl:col-span-2">
                  <label class="block text-sm font-medium text-primary-dark dark:text-primary-light">Enable</label>
                  <select v-model.lazy="comicForm.is_enabled" name="is_enabled" autocomplete="country-name"
                    class="block px-3 py-2 mt-1 mr-3 w-full bg-transparent rounded-md border shadow-sm dark:text-gray-400 border-primary-dark dark:border-primary-light focus:outline-none focus:ring-primary-lighter focus:border-primary-lighter sm:text-sm">

                    <option :value="true">Enable</option>
                    <option :value="false">Disable</option>
                  </select>

                </div>

              </div>
              <DividerHorizontal />

                <div>


                <div>

                  <div class="grid grid-cols-2">
                    <div class="col-span-2 p-2 m-2 md:p-4 md:col-span-1">
                      <div class="font-medium capitalize text-md text-primary-dark dark:text-primary-light"> Thumbnail
                      </div>
                      <div class="text-xs text-gray-500">The Carousel Image is used on the homepage and other areas of
                        the website for advertising comic.
                      </div>
                      <div class="py-2 my-3">

                        <input type="file" @input="comicForm.thumb = $event.target.files[0]" />
                        <progress v-if="comicForm.progress" :value="comicForm.progress.percentage" max="100">
                          {{ comicForm.progress.percentage }}%
                        </progress>


                      </div>

                      <div v-if="errors.thumb" class="p-1 text-sm text-red-300">{{ errors.thumb }} </div>
                    </div>
                    <div
                      class="col-span-2 p-2 m-2 my-3 rounded-md border border-primary-dark dark:border-primary-light md:p-4 md:col-span-1">
                      <div class="mx-1 text-primary-dark dark:text-primary-light ">Thumbnail Requirements</div>
                      <div class="mx-2 text-xs  text-gray-500">For performance reasons, the thumbnail is limited to
                        the following:
                      </div>
                      <div>
                        <ul class="pl-4 text-xs text-gray-500">
                          <li>
                            Minimum: 450 x 1180 (pixels).
                          </li>
                          <li>
                            Maximum: 500 x  1180(pixels).
                          </li>
                          <li>
                            Must be a <code>.png</code> or <code>.jpg</code>.
                          </li>
                        </ul>

                      </div>
                    </div>
                  </div>
                </div>
              </div>


              <div class="flex justify-end mx-3 my-5">
                <BaseButton type="submit" color="info" label="Update" :disabled="comicForm.processing" />
              </div>
            </div>

          </form>
        </div>

      </div>
    </SectionMain>
  </AppLayout>

</template>
 <style scoped>
 .svg-icon {
   width: 1em;
   height: 1em;
 }

 .svg-icon path,
 .svg-icon polygon,
 .svg-icon rect {
   fill: #333;
 }

 .svg-icon circle {
   stroke: #4691f6;
   stroke-width: 1;
 }
 </style>
