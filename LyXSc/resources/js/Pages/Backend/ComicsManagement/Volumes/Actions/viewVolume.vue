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
import CreateChapterModal from '@/components/CreateChapterModal.vue'
import ChapterTable from '@/components/ChapterTable.vue';
import BaseButtons from '@/components/BaseButtons.vue';
import DividerHorizontal from '@/components/DividerHorizontal.vue'
import BaseButton from '@/components/BaseButton.vue';
const props = defineProps({
  volume: {
    type: Object,
    default: null
  },
  chapters: {
    type: Array,
    default: null
  },
  errors: {
    type: Object,

  }

})
//console.log(props.comic)
const isModalActive = ref(false)
const titleStack = ref([props.volume.comic_title, 'Volume '+ String(props.volume.number) , 'Chapters'])
</script>

<template>

  <AppLayout>

    <Head :title="props.volume.name" />
    <SectionTitleBar :title-stack="titleStack" />
    <SectionMain>
     <CreateChapterModal hasCancel v-model="isModalActive"   buttonLabel="Create" :volumeId="props.volume.id" :errors="props.errors"
        title="Create Chapter" :icon="mdiAccountCircle" :chapterCount="props.chapters.length" />

      <BaseButton label="Create Chapter" @click="isModalActive = true" color="info" />
      <DividerHorizontal />
      <CardBox class="mb-6" title="Volumes" :icon="mdiAccountMultiple" has-table>
        <div v-if="props.chapters">
          <ChapterTable checkable :chapters="props.chapters" />
        </div>

      </CardBox>
      <SectionHeroBar>{{ titleStack[2] }}</SectionHeroBar>
    </SectionMain>
  </AppLayout>
</template>
