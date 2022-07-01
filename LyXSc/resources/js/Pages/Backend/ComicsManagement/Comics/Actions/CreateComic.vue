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
  tags: {
    type: Array,
    default: null
  },
  countries: {
    type: Array,
    default: null
  },
  publishers: {
    type: Array,
    default: null
  },
  authors: {
    type: Array,
    default: null
  },
  artists: {
    type: Array,
    default: null
  },
  errors: Object,

})
const comicForm = useForm({
  title: '',
  desc: '',
  isHidden: false,
  isMature: false,
  isLocked: false,
  tags: [],
  author: props.authors[0].id,
  artist: props.artists[0].id,
  publisher: props.publishers[0].id,
  country: props.countries[0].id,
  thumb: '',

})
function submit() {

  comicForm.clearErrors()
  console.log(comicForm);
  let url = route('comics_management.comics.store')
  comicForm.post(url)

}
const titleStack = ref(['Dashboard', 'Comics', 'Create Comic'])

</script>

<template>


  <AppLayout>

    <Head title="Comics" />
    <SectionTitleBar :title-stack="titleStack" />

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
                    <label class="text-primary-dark  dark:text-primary-light" for="title">Title</label>
                  </div>
                  <input v-model.lazy="comicForm.title"
                    class="w-full bg-transparent rounded-md border-primary-dark dark:border-primary-light focus:border-primary-lighter"
                    type="text" name="name" placeholder="Solo Login">

                  <div v-if="errors.title" class="p-1 text-sm text-red-300">{{ errors.title }} </div>

                </div>

                <div class="pl-3">
                  <div><label class="text-primary-dark  dark:text-primary-light" for="description">Description</label>
                  </div>
                  <textarea v-model.lazy="comicForm.desc" rows="3"
                    class="w-full bg-transparent rounded-md border-primary-dark dark:border-primary-light focus:border-primary-lighter"
                    placeholder="a short description..."></textarea>

                  <div v-if="errors.desc" class="p-1 text-sm text-red-300">{{ errors.desc }} </div>

                </div>
              </div>

              <div class="grid grid-cols-8 gap-3 my-4">
                <div class="col-span-8 sm:col-span-4 xl:col-span-2">
                  <label class="block text-sm font-medium text-primary-dark dark:text-primary-light">Visibility</label>
                  <select v-model.lazy="comicForm.isHidden" name="is_enabled" autocomplete="country-name"
                    class="block px-3 py-2 mt-1 mr-3 w-full bg-transparent rounded-md border shadow-sm dark:text-gray-400 border-primary-dark dark:border-primary-light focus:outline-none focus:ring-primary-lighter focus:border-primary-lighter sm:text-sm">

                    <option :value="true">Hidden</option>
                    <option :value="false">Visible</option>
                  </select>
                  <div v-if="errors.isHidden" class="p-1 text-sm text-red-300">{{ errors.isHidden }} </div>

                </div>
                <div class="col-span-8 sm:col-span-4 xl:col-span-2">
                  <label class="block text-sm font-medium text-primary-dark dark:text-primary-light">Status</label>
                  <select v-model.lazy="comicForm.isLocked" name="is_enabled" autocomplete="country-name"
                    class="block px-3 py-2 mt-1 mr-3 w-full bg-transparent rounded-md border shadow-sm dark:text-gray-400 border-primary-dark dark:border-primary-light focus:outline-none focus:ring-primary-lighter focus:border-primary-lighter sm:text-sm">

                    <option :value="true">Locked</option>
                    <option :value="false">Open</option>
                  </select>
                  <div v-if="errors.isLocked" class="p-1 text-sm text-red-300">{{ errors.isLocked }} </div>
                </div>
                <div class="col-span-8 sm:col-span-4 xl:col-span-2">
                  <label class="block text-sm font-medium text-primary-dark dark:text-primary-light">Nsfw</label>
                  <select v-model.lazy="comicForm.isMature" name="is_enabled" autocomplete="country-name"
                    class="block px-3 py-2 mt-1 mr-3 w-full bg-transparent rounded-md border shadow-sm dark:text-gray-400 border-primary-dark dark:border-primary-light focus:outline-none focus:ring-primary-lighter focus:border-primary-lighter sm:text-sm">
                    <option :value="true">Yes</option>
                    <option :value="false">No</option>
                  </select>

                  <div v-if="errors.isMature" class="p-1 text-sm text-red-300">{{ errors.isMature }} </div>

                </div>
                <!--                 <div class="col-span-8 sm:col-span-4 xl:col-span-2">
                  <label class="block text-sm font-medium text-primary-dark dark:text-primary-light">Categories</label>
                  <select id="select" name="tag" autocomplete="country-name" v-model="comicForm.tags"
                    class="block  px-3 py-2 mt-1 mr-3 w-full bg-transparent rounded-md border shadow-sm dark:text-gray-400 border-primary-dark dark:border-primary-light focus:outline-none focus:ring-primary-lighter focus:border-primary-lighter sm:text-sm">

                    <option v-for="tag in props.tags" :value="tag.id"> {{ tag.name }}</option>

                  </select>
                </div>
 -->
              </div>
              <DividerHorizontal />
              <div class="grid grid-cols-8 gap-3 my-4">
                <div class="col-span-8 sm:col-span-4 xl:col-span-2">
                  <label class="block text-sm font-medium text-primary-dark dark:text-primary-light">Author</label>
                  <select v-model.number="comicForm.author" vname="is_enabled" autocomplete="country-name"
                    class="block px-3 py-2 mt-1 mr-3 w-full bg-transparent rounded-md border shadow-sm dark:text-gray-400 border-primary-dark dark:border-primary-light focus:outline-none focus:ring-primary-lighter focus:border-primary-lighter sm:text-sm">
                    <option v-for="author in props.authors" :value="author.id">{{ author.name }}</option>
                  </select>

                  <div v-if="errors.author" class="p-1 text-sm text-red-300">{{ errors.author }} </div>

                </div>
                <div class="col-span-8 sm:col-span-4 xl:col-span-2">
                  <label class="block text-sm font-medium text-primary-dark dark:text-primary-light">Artist</label>
                  <select v-model.number="comicForm.artist" name="is_enabled" autocomplete="country-name"
                    class="block px-3 py-2 mt-1 mr-3 w-full bg-transparent rounded-md border shadow-sm dark:text-gray-400 border-primary-dark dark:border-primary-light focus:outline-none focus:ring-primary-lighter focus:border-primary-lighter sm:text-sm">

                    <option v-for="artist in props.artists" :value="artist.id">{{ artist.name }}</option>

                  </select>

                  <div v-if="errors.artist" class="p-1 text-sm text-red-300">{{ errors.artist }} </div>

                </div>
                <div class="col-span-8 sm:col-span-4 xl:col-span-2">
                  <label class="block text-sm font-medium text-primary-dark dark:text-primary-light">Publisher</label>

                  <select v-model.number="comicForm.publisher" name="is_enabled" autocomplete="country-name"
                    class="block px-3 py-2 mt-1 mr-3 w-full bg-transparent rounded-md border shadow-sm dark:text-gray-400 border-primary-dark dark:border-primary-light focus:outline-none focus:ring-primary-lighter focus:border-primary-lighter sm:text-sm">

                    <option v-for="publisher in props.publishers" :value="publisher.id">{{ publisher.name }}</option>

                  </select>

                  <div v-if="errors.publisher" class="p-1 text-sm text-red-300">{{ errors.publisher }} </div>
                </div>
                <div class="col-span-8 sm:col-span-4 xl:col-span-2">
                  <label class="block text-sm font-medium text-primary-dark dark:text-primary-light">Country</label>
                  <select v-model="comicForm.country" name="is_enabled" autocomplete="country-name"
                    class="block px-3 py-2 mt-1 mr-3 w-full bg-transparent rounded-md border shadow-sm dark:text-gray-400 border-primary-dark dark:border-primary-light focus:outline-none focus:ring-primary-lighter focus:border-primary-lighter sm:text-sm">

                    <option v-for="country in countries" :value="country.id">{{ country.name }} </option>


                  </select>

                  <div v-if="errors.country" class="p-1 text-sm text-red-300">{{ errors.country }} </div>

                </div>

              </div>
              <DividerHorizontal />

              <div class="flex flex-wrap mb-6">
                <div class="w-full px-3  rounded-md p-3 mb-3 border border-gray-400">
                  <label
                    class="block capitalize tracking-wide text-primary-darker dark:text-white text-md font-bold mb-2"
                    for="grid-password">
                    Current Tags {{ comicForm.tags }}
                  </label>
                  <div class="grid grid-cols-1 md:grid-cols-2 text-left">


                    <div class="col-span-1" v-for="tag in props.tags">
                      <input class="rounded-xl" type="checkbox" v-model="comicForm.tags"
                        name="comicForm.tags[]" :value="tag.id">
                      <label class="capitalize">{{ tag.name }} </label>
                    </div>

                  </div>
                </div>



                <DividerHorizontal />

                <div>

                  <div class="grid grid-cols-2">
                    <div class="col-span-2 p-2 m-2 md:p-4 md:col-span-1">
                      <div class="font-medium capitalize text-md text-primary-dark dark:text-primary-light"> Thumbnail
                      </div>
                      <div class="text-xs text-gray-500">The thumbnail is used on the homepage and other areas of
                        the website for advertising. It is also used on embedded links when sharing.
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
                            Minimum: 230 x 300 (pixels).
                          </li>
                          <li>
                            Maximum: 450 x 650 (pixels).
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
                  <BaseButton type="submit" color="info" label="Create" :disabled="comicForm.processing" />
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
