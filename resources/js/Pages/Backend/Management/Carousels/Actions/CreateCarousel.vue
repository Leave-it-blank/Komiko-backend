<script setup>
import AppLayout from "@/Layouts/App.vue";
import { Head } from "@inertiajs/inertia-vue3";
import { ref, reactive } from "vue";
import {
  mdiMonitorCellphone,
  mdiAccountMultiple,
  mdiTableBorder,
  mdiTableOff,
} from "@mdi/js";
import SectionMain from "@/components/backend/SectionMain.vue";
import NotificationBar from "@/components/backend/NotificationBar.vue";
import CardBox from "@/components/backend/CardBox.vue";
import SectionTitleBar from "@/components/backend/SectionTitleBar.vue";
import SectionHeroBar from "@/components/backend/SectionHeroBar.vue";
import ComicsTable from "@/components/backend/ComicsTable.vue";
import { useForm } from "@inertiajs/inertia-vue3";
import DividerHorizontal from "@/components/backend/DividerHorizontal.vue";
import BaseButton from "@/components/backend/BaseButton.vue";

const props = defineProps({
  errors: Object,
});
const comicForm = useForm({
  name: "",
  position: 1,
  url: "",
  is_enabled: false,
  thumb: "",
});
function submit() {
  comicForm.clearErrors();
  //console.log(comicForm);
  let url = route("comic.management.carousel.store");
  comicForm.post(url);
}
const titleStack = ref(["Dashboard", "Comics", "Create Carousel"]);
</script>

<template>
  <AppLayout>
    <Head title="Carousels" />
    <SectionTitleBar :title-stack="titleStack" routeName="admin.management.carousel" />

    <SectionMain>
      <div>
        <div class="container p-1 mx-auto text-white md:p-10">
          <form @submit.prevent="submit" enctype="multipart/form-data">
            <div
              class="p-1 mt-5 bg-gray-800 rounded-md border shadow-sm md:p-5 dark:bg-gray-900 border-light"
            >
              <div class="grid grid-cols-2 p-3">
                <div class="pr-3">
                  <div>
                    <label for="name">Name</label>
                  </div>
                  <input
                    v-model.lazy="comicForm.name"
                    class="block w-full px-3 py-2 mt-1 border border-gray-400 rounded-md text-black"
                    type="text"
                    name="name"
                    placeholder="Solo Login"
                  />

                  <div v-if="errors.name" class="p-1 text-sm text-red-300">
                    {{ errors.name }}
                  </div>
                </div>
                <div class="pr-3">
                  <div>
                    <label for="name">URL</label>
                  </div>
                  <input
                    v-model.lazy="comicForm.url"
                    class="block w-full px-3 py-2 mt-1 border border-gray-400 rounded-md text-black"
                    type="text"
                    name="url"
                    placeholder="https://scans.com/series/32"
                  />

                  <div v-if="errors.url" class="p-1 text-sm text-red-300">
                    {{ errors.url }}
                  </div>
                </div>
              </div>

              <div class="grid grid-cols-8 gap-3 mb-4 p-3">
                <div class="col-span-8 sm:col-span-4 xl:col-span-2">
                  <label class="block text-sm font-medium pb-2">Visibility</label>
                  <select
                    v-model.lazy="comicForm.position"
                    name="is_enabled"
                    autocomplete="country-name"
                    class="rounded-md bg-transparent text-gray-300 w-full"
                  >
                    <option class="p-2 m-2 bg-gray-800" :value="1">First</option>
                    <option class="p-2 m-2 bg-gray-800" :value="2">Second</option>
                    <option class="p-2 m-2 bg-gray-800" :value="3">Third</option>
                    <option class="p-2 m-2 bg-gray-800" :value="4">Fourth</option>
                    <option class="p-2 m-2 bg-gray-800" :value="5">Fifth</option>
                  </select>
                  <div v-if="errors.position" class="p-1 text-sm text-red-300">
                    {{ errors.position }}
                  </div>
                </div>
                <div class="col-span-8 sm:col-span-4 xl:col-span-2">
                  <label class="block text-sm font-medium pb-2">Enable</label>
                  <select
                    v-model.lazy="comicForm.is_enabled"
                    name="is_enabled"
                    autocomplete="country-name"
                    class="rounded-md bg-transparent text-gray-300 w-full"
                  >
                    <option class="p-2 m-2 bg-gray-800" :value="true">Enable</option>
                    <option class="p-2 m-2 bg-gray-800" :value="false">Disable</option>
                  </select>
                </div>
              </div>
              <DividerHorizontal />

              <div>
                <div>
                  <div class="grid grid-cols-2">
                    <div class="col-span-2 p-2 m-2 md:p-4 md:col-span-1">
                      <div class="font-medium capitalize text-md">Thumbnail</div>
                      <div class="text-xs text-gray-500">
                        The Carousel Image is used on the homepage and other areas of the
                        website for advertising comic.
                      </div>
                      <div class="py-2 my-3">
                        <input
                          type="file"
                          @input="comicForm.thumb = $event.target.files[0]"
                        />
                        <progress
                          v-if="comicForm.progress"
                          :value="comicForm.progress.percentage"
                          max="100"
                        >
                          {{ comicForm.progress.percentage }}%
                        </progress>
                      </div>

                      <div v-if="errors.thumb" class="p-1 text-sm text-red-300">
                        {{ errors.thumb }}
                      </div>
                    </div>
                    <div
                      class="col-span-2 p-2 m-2 my-3 rounded-md border border-primary-dark dark:border-primary-light md:p-4 md:col-span-1"
                    >
                      <div class="mx-1">Thumbnail Requirements</div>
                      <div class="mx-2 text-xs text-gray-500">
                        For performance reasons, the thumbnail is limited to the
                        following:
                      </div>
                      <div>
                        <ul class="pl-4 text-xs text-gray-500">
                          <li>Minimum: 300 x 1180 (pixels).</li>
                          <li>Maximum: 320 x 1180(pixels).</li>
                          <li>Must be a <code>.png</code> or <code>.jpg</code>.</li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="flex justify-end mx-3 my-5">
                <BaseButton
                  type="submit"
                  color="info"
                  label="Create"
                  :disabled="comicForm.processing"
                />
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
