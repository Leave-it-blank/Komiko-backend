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
  tags: {
    type: Array,
    default: null,
  },
  countries: {
    type: Array,
    default: null,
  },
  publishers: {
    type: Array,
    default: null,
  },
  authors: {
    type: Array,
    default: null,
  },
  artists: {
    type: Array,
    default: null,
  },
  errors: Object,
});
const comicForm = useForm({
  title: "",
  desc: "",
  isHidden: false,
  isMature: false,
  isLocked: false,
  tags: [],
  author: props.authors[0].id,
  artist: props.artists[0].id,
  publisher: props.publishers[0].id,
  country: props.countries[0].id,
  thumb: "",
  status: "ongoing",
  choice: "new",
  type: "manga",
});
function submit() {
  comicForm.clearErrors();
  console.log(comicForm);
  let url = route("comics_management.comics.store");
  comicForm.post(url);
}
const titleStack = ref(["Dashboard", "Comics", "Create Comic"]);
</script>

<template>
  <AppLayout>
    <Head title="Comics" />
    <SectionTitleBar :title-stack="titleStack" />

    <SectionMain>
      <div>
        <div class="container p-1 mx-auto text-white md:p-5">
          <form @submit.prevent="submit" enctype="multipart/form-data">
            <div
              class="p-1 mt-5 bg-gray-800 rounded-md border shadow-sm md:p-5 dark:bg-gray-900"
            >
              <div class="grid grid-cols-2 p-3">
                <div class="pr-3">
                  <div>
                    <label class="pb-2" for="title">Title</label>
                  </div>
                  <input
                    v-model.lazy="comicForm.title"
                    class="block w-full px-3 py-2 mt-1 border border-gray-400 rounded-md text-black"
                    type="text"
                    name="name"
                    placeholder="Solo Login"
                  />

                  <div v-if="errors.title" class="p-1 text-sm text-red-300">
                    {{ errors.title }}
                  </div>
                </div>

                <div class="pl-3">
                  <div>
                    <label class="pb-2 mb-2" for="description">Description</label>
                  </div>
                  <textarea
                    v-model.lazy="comicForm.desc"
                    rows="3"
                    class="w-full border border-gray-400 text-black rounded-md"
                    placeholder="a short description..."
                  ></textarea>

                  <div v-if="errors.desc" class="p-1 text-sm text-red-300">
                    {{ errors.desc }}
                  </div>
                </div>
              </div>

              <div class="grid grid-cols-8 gap-3 mb-4 p-3">
                <div class="col-span-8 sm:col-span-4 xl:col-span-2">
                  <label class="block text-sm font-medium pb-2">Visibility</label>
                  <select
                    v-model.lazy="comicForm.isHidden"
                    name="is_enabled"
                    autocomplete="country-name"
                    class="rounded-md bg-transparent text-gray-300 w-full"
                  >
                    <option class="p-2 m-2 bg-gray-800" :value="true">Hidden</option>
                    <option class="p-2 m-2 bg-gray-800" :value="false">Visible</option>
                  </select>
                  <div v-if="errors.isHidden" class="p-1 text-sm text-red-300">
                    {{ errors.isHidden }}
                  </div>
                </div>
                <div class="col-span-8 sm:col-span-4 xl:col-span-2">
                  <label class="block text-sm font-medium pb-2">Avail</label>
                  <select
                    v-model.lazy="comicForm.isLocked"
                    name="is_enabled"
                    autocomplete="country-name"
                    class="rounded-md bg-transparent text-gray-300 w-full"
                  >
                    <option class="p-2 m-2 bg-gray-800" :value="true">Locked</option>
                    <option class="p-2 m-2 bg-gray-800" :value="false">Open</option>
                  </select>
                  <div v-if="errors.isLocked" class="p-1 text-sm text-red-300">
                    {{ errors.isLocked }}
                  </div>
                </div>
                <div class="col-span-8 sm:col-span-4 xl:col-span-2">
                  <label class="block text-sm font-medium pb-2">Nsfw</label>
                  <select
                    v-model.lazy="comicForm.isMature"
                    name="is_enabled"
                    autocomplete="country-name"
                    class="rounded-md bg-transparent text-gray-300 w-full"
                  >
                    <option class="p-2 m-2 bg-gray-800" :value="true">Yes</option>
                    <option class="p-2 m-2 bg-gray-800" :value="false">No</option>
                  </select>

                  <div v-if="errors.isMature" class="p-1 text-sm text-red-300">
                    {{ errors.isMature }}
                  </div>
                </div>
                <!--                 <div class="col-span-8 sm:col-span-4 xl:col-span-2">
                  <label class="block text-sm font-medium pb-2 ">Categories</label>
                  <select id="select" name="tag" autocomplete="country-name" v-model="comicForm.tags"
                    class="block  px-3 py-2 mt-1 mr-3 w-full bg-transparent rounded-md border shadow-sm dark:text-gray-400   focus:outline-none focus:ring-primary-lighter  sm:text-sm">

                    <option class="p-2 m-2 bg-gray-800" v-for="tag in props.tags" :value="tag.id"> {{ tag.name }}</option>

                  </select>
                </div>
 -->
              </div>
              <DividerHorizontal />

              <div class="grid grid-cols-8 gap-3 mb-4 p-3">
                <div class="col-span-8 sm:col-span-4 xl:col-span-2">
                  <label class="block text-sm font-medium pb-2">Status</label>
                  <select
                    v-model.lazy="comicForm.status"
                    name="is_enabled"
                    class="rounded-md bg-transparent text-gray-300 w-full"
                  >
                    <option class="p-2 m-2 bg-gray-800" :value="'ongoing'">
                      Ongoing
                    </option>
                    <option class="p-2 m-2 bg-gray-800" :value="'hiatus'">Hiatus</option>
                    <option class="p-2 m-2 bg-gray-800" :value="'dropped'">
                      Dropped
                    </option>
                    <option class="p-2 m-2 bg-gray-800" :value="'completed'">
                      Completed
                    </option>
                  </select>
                  <div v-if="errors.status" class="p-1 text-sm text-red-300">
                    {{ errors.status }}
                  </div>
                </div>
                <div class="col-span-8 sm:col-span-4 xl:col-span-2">
                  <label class="block text-sm font-medium pb-2"> Type</label>
                  <select
                    v-model.lazy="comicForm.type"
                    name="is_enabled"
                    class="rounded-md bg-transparent text-gray-300 w-full"
                  >
                    <option class="p-2 m-2 bg-gray-800" :value="'manga'">Manga</option>
                    <option class="p-2 m-2 bg-gray-800" :value="'manwha'">Manwha</option>
                    <option class="p-2 m-2 bg-gray-800" :value="'manhua'">Manhua</option>
                    <option class="p-2 m-2 bg-gray-800" :value="'ru manga'">
                      Ru Manga
                    </option>
                  </select>
                  <div v-if="errors.type" class="p-1 text-sm text-red-300">
                    {{ errors.type }}
                  </div>
                </div>
                <div class="col-span-8 sm:col-span-4 xl:col-span-2">
                  <label class="block text-sm font-medium pb-2">Editor Choice</label>
                  <select
                    v-model.lazy="comicForm.choice"
                    name="is_enabled"
                    autocomplete="choice"
                    class="rounded-md bg-transparent text-gray-300 w-full"
                  >
                    <option class="p-2 m-2 bg-gray-800" :value="'hot'">Hot</option>
                    <option class="p-2 m-2 bg-gray-800" :value="'new'">New</option>
                    <option class="p-2 m-2 bg-gray-800" :value="'recommended'">
                      Recommended
                    </option>
                    <option class="p-2 m-2 bg-gray-800" :value="'latest'">Latest</option>
                    <option class="p-2 m-2 bg-gray-800" :value="'best'">Best</option>
                    <option class="p-2 m-2 bg-gray-800" :value="'top'">Top</option>
                    <option class="p-2 m-2 bg-gray-800" :value="'editor\'s choice'">
                      Editor's Choice
                    </option>
                  </select>

                  <div v-if="errors.choice" class="p-1 text-sm text-red-300">
                    {{ errors.choice }}
                  </div>
                </div>
              </div>
              <DividerHorizontal />
              <div class="grid grid-cols-8 gap-3 mb-4 p-3">
                <div class="col-span-8 sm:col-span-4 xl:col-span-2">
                  <label class="block text-sm font-medium pb-2">Author</label>
                  <select
                    v-model.number="comicForm.author"
                    vname="is_enabled"
                    autocomplete="country-name"
                    class="rounded-md bg-transparent text-gray-300 w-full"
                  >
                    <option
                      class="p-2 m-2 bg-gray-800"
                      v-for="author in props.authors"
                      :value="author.id"
                    >
                      {{ author.name }}
                    </option>
                  </select>

                  <div v-if="errors.author" class="p-1 text-sm text-red-300">
                    {{ errors.author }}
                  </div>
                </div>
                <div class="col-span-8 sm:col-span-4 xl:col-span-2">
                  <label class="block text-sm font-medium pb-2">Artist</label>
                  <select
                    v-model.number="comicForm.artist"
                    name="is_enabled"
                    autocomplete="country-name"
                    class="rounded-md bg-transparent text-gray-300 w-full"
                  >
                    <option
                      class="p-2 m-2 bg-gray-800"
                      v-for="artist in props.artists"
                      :value="artist.id"
                    >
                      {{ artist.name }}
                    </option>
                  </select>

                  <div v-if="errors.artist" class="p-1 text-sm text-red-300">
                    {{ errors.artist }}
                  </div>
                </div>
                <div class="col-span-8 sm:col-span-4 xl:col-span-2">
                  <label class="block text-sm font-medium pb-2">Publisher</label>

                  <select
                    v-model.number="comicForm.publisher"
                    name="is_enabled"
                    autocomplete="country-name"
                    class="rounded-md bg-transparent text-gray-300 w-full"
                  >
                    <option
                      class="p-2 m-2 bg-gray-800"
                      v-for="publisher in props.publishers"
                      :value="publisher.id"
                    >
                      {{ publisher.name }}
                    </option>
                  </select>

                  <div v-if="errors.publisher" class="p-1 text-sm text-red-300">
                    {{ errors.publisher }}
                  </div>
                </div>
                <div class="col-span-8 sm:col-span-4 xl:col-span-2">
                  <label class="block text-sm font-medium pb-2">Country</label>
                  <select
                    v-model="comicForm.country"
                    name="is_enabled"
                    autocomplete="country-name"
                    class="rounded-md bg-transparent text-gray-300 w-full"
                  >
                    <option
                      class="p-2 m-2 bg-gray-800"
                      v-for="country in countries"
                      :value="country.id"
                    >
                      {{ country.name }}
                    </option>
                  </select>

                  <div v-if="errors.country" class="p-1 text-sm text-red-300">
                    {{ errors.country }}
                  </div>
                </div>
              </div>
              <DividerHorizontal />

              <div class="flex flex-wrap mb-4 p-3">
                <div class="w-full px-3 rounded-md p-3 mb-3 border border-gray-400">
                  <label
                    class="block capitalize tracking-wide text-primary-darker dark:text-white text-md font-bold mb-2"
                    for="grid-password"
                  >
                    Current Tags {{ comicForm.tags }}
                  </label>
                  <div class="grid grid-cols-1 md:grid-cols-2 text-left">
                    <div class="col-span-1" v-for="tag in props.tags">
                      <input
                        class="rounded-xl"
                        type="checkbox"
                        v-model="comicForm.tags"
                        name="comicForm.tags[]"
                        :value="tag.id"
                        required
                      />
                      <label class="capitalize p-2">{{ tag.name }} </label>
                    </div>
                  </div>
                </div>

                <DividerHorizontal />

                <div>
                  <div class="grid grid-cols-2">
                    <div class="col-span-2 p-2 m-2 md:p-4 md:col-span-1">
                      <div class="font-medium capitalize text-md">Thumbnail</div>
                      <div class="text-xs text-gray-500">
                        The thumbnail is used on the homepage and other areas of the
                        website for advertising. It is also used on embedded links when
                        sharing.
                      </div>
                      <div class="py-2 my-3">
                        <input
                          type="file"
                          @input="comicForm.thumb = $event.target.files[0]"
                          class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-violet-50 file:text-violet-700 hover:file:bg-violet-100"
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
                      class="col-span-2 p-2 m-2 my-3 rounded-md border md:p-4 md:col-span-1"
                    >
                      <div class="mx-1">Thumbnail Requirements</div>
                      <div class="mx-2 text-xs text-gray-500">
                        For performance reasons, the thumbnail is limited to the
                        following:
                      </div>
                      <div>
                        <ul class="pl-4 text-xs text-gray-500">
                          <li>Minimum: 230 x 300 (pixels).</li>
                          <li>Maximum: 450 x 650 (pixels).</li>
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
