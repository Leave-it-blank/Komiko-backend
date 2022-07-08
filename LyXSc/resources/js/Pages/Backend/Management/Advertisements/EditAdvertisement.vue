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
import moment from 'moment'
const props = defineProps({
  advertisement: {
    type: Object,
    default: null
  },
  errors: Object,

})
let status = 'Update'

const adsForm = useForm({

  is_enabled: props.advertisement.is_enabled,
  code: props.advertisement.code,
  expires_at: dateshow(props.advertisement.expires_at),
  name: props.advertisement.name

})
function dateshow(value) {
    return moment(value).format('YYYY-MM-DD'); // here u modify data
}

function submit() {

  adsForm.clearErrors()
  console.log(adsForm);
  let url = route('site.management.advertisements.edit.store', props.advertisement.id)
  adsForm.post(url )

}
const titleStack = ref(['Dashboard', 'Advertisement', 'Edit Advert'])

</script>

<template>


  <AppLayout>

    <Head title="Edit Advertisement" />
    <SectionTitleBar :title-stack="titleStack" routeName="site.management.advertisements.view" />

    <SectionMain>
      <div>

        <div class="container p-1 mx-auto text-gray-800  dark:text-white md:p-10">
          <div class="flex justify-between">
            <div class=" mx-1 my-2 ">

              <BaseButton label=" Edit Advert" active color="info" />
            </div>
            <div class="mx-1 my-2 ">

              <BaseButton label="Go Back" routeName="site.management.advertisements.view" color="info" />
            </div>
          </div>
          <form @submit.prevent="submit" enctype="multipart/form-data">
            <div class="p-1 mt-5 bg-white rounded-md border shadow-sm md:p-5 dark:bg-gray-900/70  border-light">


              <div class="px-2 py-5 border rounded-md md:px-10 bg-zinc-100 dark:bg-gray-900  border-gray-500">
                <div class="grid grid-cols-6 gap-6">
                  <div class="col-span-6 sm:col-span-3 xl:col-span-2">
                    <label for="Advertisement Name"
                      class="block text-sm font-medium text-black dark:text-blue-500">Advertisement Name:</label>
                    <input type="text" name="name" disabled  v-model="adsForm.name"
                      class="block w-full mt-1 rounded-md shadow-sm dark:bg-zinc-900 focus:ring-indigo-500 focus:border-gray-300 sm:text-sm border-gray-200">
                  </div>
                  <div class="col-span-6 sm:col-span-3 xl:col-span-2">
                    <label  class="block text-sm font-medium text-black dark:text-blue-500">Expires
                      on</label>

                    <input
                      class="block w-full mt-1 rounded-md shadow-sm dark:text-white dark:bg-zinc-900 focus:ring-indigo-500 focus:border-gray-300 sm:text-sm border-gray-200"
                     v-model="adsForm.expires_at" type="date" id="Expires" name="Expires at">
                  </div>

                  <div class="col-span-6 sm:col-span-3 xl:col-span-2">
                    <label class="block text-sm font-medium text-black dark:text-blue-500">Status</label>
                    <select  v-model="adsForm.is_enabled" name="is_enabled"
                      class="block w-full px-3 py-2 mt-1 mr-3 bg-white border rounded-md shadow-sm dark:bg-zinc-900 border-gray-200 focus:outline-none focus:ring-primary-lighter focus:border-gray-300 sm:text-sm">
                      <option :value="true" selected>Enabled</option>
                      <option :value="false">Disabled</option>
                    </select>
                  </div>
                </div>
                <div class="py-3">
                  <label for="code" class="block text-sm font-medium text-black dark:text-blue-500">Html & js</label>
                  <textarea  v-model="adsForm.code" name="code" rows="15"
                    class="block w-full mt-1 border rounded-md shadow-sm dark:bg-zinc-900 focus:ring-primary-lighter focus:border-gray-300 sm:text-sm border-gray-200"> </textarea>
                  <div class="py-2 text-xs text-gray-600 dark:text-gray-400 ">The code provided by your advertisement
                    provider that will be used to display advertisements on the frontend. </div>

                   <div v-if="props.errors.code" class="text-red-500 muted"> {{ props.errors.code }} </div>
                   <div v-if="props.errors.expires_at" class="text-red-500 muted"> {{ props.errors.expires_at }} </div>
                   <div v-if="props.errors.is_enabled" class="text-red-500 muted"> {{ props.errors.is_enabled }} </div>
                </div>

                <div class="flex justify-end mx-3 my-5">
                  <BaseButton type="submit" color="info" :label="status" :disabled="adsForm.processing" />
                </div>
              </div>
     </div>
          </form>
        </div>

      </div>
    </SectionMain>
  </AppLayout>

</template>
