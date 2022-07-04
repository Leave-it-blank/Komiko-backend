<script setup>
import AppLayout from '@/Layouts/App.vue';
import { Head } from '@inertiajs/inertia-vue3'
import { ref, reactive } from 'vue'
import { mdiAccount, mdiAccountMultiple, mdiAccountCircle, mdiMail } from '@mdi/js'
import SectionMain from '@/components/SectionMain.vue'
import NotificationBar from '@/components/NotificationBar.vue'
import CardBox from '@/components/CardBox.vue'
import SectionTitleBar from '@/components/SectionTitleBar.vue'
import SectionHeroBar from '@/components/SectionHeroBar.vue'
import CreateVolumeModal from '@/components/CreateVolumeModal.vue'
import VolumesTable from '@/components/VolumesTable.vue';
import BaseButtons from '@/components/BaseButtons.vue';
import DividerHorizontal from '@/components/DividerHorizontal.vue'
import BaseButton from '@/components/BaseButton.vue';
const props = defineProps({
  comic: {
    type: Object,
    default: null
  },
  volumes: {
    type: Array,
    default: null
  },
  errors: {
    default: null
  }
})

console.log(props.comic)
const isModalActive = ref(false)
const titleStack = ref(['Dashboard', 'Comic', props.comic.title])
</script>

<template>

  <AppLayout>

    <Head :title="props.comic.title" />
    <SectionTitleBar :title-stack="titleStack" />
    <SectionMain>

      <CreateVolumeModal hasCancel v-model="isModalActive"   buttonLabel="Create" :comicId="props.comic.id"
        title="Create Volume" :icon="mdiAccountCircle" />


      <BaseButton label="Create Volume" @click="isModalActive = true" color="info" />
      <DividerHorizontal />
      <CardBox class="mb-6" title="Volumes" :icon="mdiAccountMultiple" has-table>
        <div v-if="props.volumes">
          <VolumesTable checkable :volumes="props.volumes" />
        </div>

      </CardBox>
      <SectionHeroBar>{{ titleStack[2] }}</SectionHeroBar>
    </SectionMain>
  </AppLayout>
</template>
