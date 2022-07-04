<script setup>

import AppLayout from '@/Layouts/App.vue';
import { Head } from '@inertiajs/inertia-vue3'
import { ref, reactive } from 'vue'
import { computed, watch } from 'vue'
import { useMainStore } from '@/stores/main'
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
import SearchDropdown from 'search-dropdown-vue';

const props = defineProps({
  comics: {
    type: Array,
    default: null
  },

  errors: Object,

})

let selected_comic = reactive(props.comics)

const onSelectedOption = (payload) => selected_comic = payload;

const mainStore = useMainStore()

const chapterForm = useForm({
  ch_number: 0,
  ch_name: '',
  vol_number: 0,
  vol_name: '',
  ch_isLocked: false,
})

function submit() {
  console.log(selected_comic);
  chapterForm.clearErrors()
  //console.log(chapterForm);
  let url_chap = route('comics_management.chapter.store', Tcomic.id)
  chapterForm.post(url_chap)

}
const titleStack = ref(['Comics', 'Chapters', 'Upload Chapter'])

</script>

<template>


  <AppLayout>

    <Head title="Upload Chapter" />
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
              <div class="w-full p-3">
                <label class="text-gray-900  dark:text-gray-200" for="Comic">Select Comic</label>

                <div class="pr-3">
                  <SearchDropdown class="w-full" :options="props.comics" v-on:selected="onSelectedOption">
                  </SearchDropdown>
                </div>
              </div>
              <DividerHorizontal />
              <div class="grid grid-cols-8 gap-3 my-4">

              </div>
              <DividerHorizontal />
              <div class="grid grid-cols-8 gap-3 my-4">

              </div>
              <DividerHorizontal />




              <div class="flex justify-end mx-3 my-5">
                <BaseButton type="submit" color="info" label="Create"   />
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
