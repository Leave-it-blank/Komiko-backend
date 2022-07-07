<script setup>
import AppLayout from '@/Layouts/App.vue';
import { Inertia } from '@inertiajs/inertia'
import { Head } from '@inertiajs/inertia-vue3'
import { ref, reactive } from 'vue'
import { mdiAccount, mdiAccountMultiple, mdiAccountCircle, mdiMail } from '@mdi/js'
import SectionMain from '@/components/SectionMain.vue'
import NotificationBar from '@/components/NotificationBar.vue'
import CardBox from '@/components/CardBox.vue'
import SectionTitleBar from '@/components/SectionTitleBar.vue'
import SectionHeroBar from '@/components/SectionHeroBar.vue'
import UploadChapterModal from '@/components/UploadChapterModal.vue'
import PagesTable from '@/components/PagesTable.vue';
import BaseButtons from '@/components/BaseButtons.vue';
import DividerHorizontal from '@/components/DividerHorizontal.vue'
import BaseButton from '@/components/BaseButton.vue';
import Uploader from '@/components/UploaderPage.vue';
const props = defineProps({
  chapter: {
    type: Object,
    default: null
  },
  pages: {
    type: Array,
    default: null
  },
    crftoken: {
    type: String,
  },
  errors: {
    type: Object,

  }

})
//console.log(props.comic)
const isModalActive = ref(false)
const titleStack = ref([props.chapter.comic_title, 'Volume '+ String(props.chapter.volume_number) , 'Chapter ' + String(props.chapter.number)])
</script>

<template>

  <AppLayout>

    <Head :title="props.chapter.name" />
    <SectionTitleBar :title-stack="titleStack"  routeName="comics_management.volume.view"  :routeId="props.chapter.volume_id"/>
    <SectionMain>

      <UploadChapterModal hasCancel v-model="isModalActive"   :chapterId="props.chapter.id" :errors="props.errors"
       :icon="mdiAccountCircle" :crftoken="props.crftoken"  />


      <BaseButton label="Upload" @click="isModalActive = true" color="warning" />
      <DividerHorizontal />
      <CardBox class="mb-6" title="Pages" :icon="mdiAccountMultiple" has-table>
        <div v-if="props.pages">
          <PagesTable checkable :pages="props.pages" />
        </div>

      </CardBox>
      <SectionHeroBar>{{ titleStack[2] }}</SectionHeroBar>
    </SectionMain>
  </AppLayout>
</template>
