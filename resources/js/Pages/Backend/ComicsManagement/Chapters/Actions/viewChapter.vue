<script setup>
import AppLayout from "@/Layouts/App.vue";
import { Inertia } from "@inertiajs/inertia";
import { Head } from "@inertiajs/inertia-vue3";
import { ref, reactive } from "vue";
import {
  mdiAccount,
  mdiAccountMultiple,
  mdiAccountCircle,
  mdiMail,
} from "@mdi/js";
import SectionMain from "@/components/backend/SectionMain.vue";
import NotificationBar from "@/components/backend/NotificationBar.vue";
import CardBox from "@/components/backend/CardBox.vue";
import SectionTitleBar from "@/components/backend/SectionTitleBar.vue";
import SectionHeroBar from "@/components/backend/SectionHeroBar.vue";
import UploadChapterModal from "@/components/backend/UploadChapterModal.vue";
import PagesTable from "@/components/backend/PagesTable.vue";
import BaseButtons from "@/components/backend/BaseButtons.vue";
import DividerHorizontal from "@/components/backend/DividerHorizontal.vue";
import BaseButton from "@/components/backend/BaseButton.vue";
import Uploader from "@/components/backend/UploaderPage.vue";
const props = defineProps({
  chapter: {
    type: Object,
    default: null,
  },
  pages: {
    type: Array,
    default: null,
  },
  crftoken: {
    type: String,
  },
  errors: {
    type: Object,
  },
});
console.log(props.pages);
//console.log(props.comic)
const isModalActive = ref(false);
const titleStack = ref([
  props.chapter.comic_title,
  "Volume " + String(props.chapter.volume_number),
  "Chapter " + String(props.chapter.number),
]);
</script>

<template>
  <AppLayout>
    <Head :title="props.chapter.name" />
    <SectionTitleBar
      :title-stack="titleStack"
      routeName="comics_management.volume.view"
      :routeId="props.chapter.volume_id"
    />
    <SectionMain>
      <UploadChapterModal
        hasCancel
        v-model="isModalActive"
        :chapterId="props.chapter.id"
        :errors="props.errors"
        :icon="mdiAccountCircle"
        :crftoken="props.crftoken"
      />

      <div class="flex justify-between">
        <BaseButton label="Upload" @click="isModalActive = true" color="info" />
        <BaseButton
          label="Purge Chapter"
          onclick="return confirm('Are you sure you want to purge this chapter?')"
          :href="route('comics_management.chapter.purge', props.chapter.id)"
          color="danger"
        />
      </div>

      <DividerHorizontal />
      <CardBox class="mb-6 px-5" title="Pages" :icon="mdiAccountMultiple" has-table>
        <div v-if="props.pages">
          <PagesTable checkable :pages="props.pages" />
        </div>
      </CardBox>
      <SectionHeroBar>{{ titleStack[2] }}</SectionHeroBar>
    </SectionMain>
  </AppLayout>
</template>
