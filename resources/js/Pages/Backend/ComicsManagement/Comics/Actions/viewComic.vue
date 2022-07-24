<script setup>
import AppLayout from '@/Layouts/App.vue';
import { Inertia } from '@inertiajs/inertia'
import { Head } from '@inertiajs/inertia-vue3'
import { ref, reactive } from 'vue'
import { mdiAccount, mdiAccountMultiple, mdiAccountCircle, mdiMail , mdiMonitorCellphone} from '@mdi/js'
import SectionMain from '@/components/backend/SectionMain.vue'
import NotificationBar from '@/components/backend/NotificationBar.vue'
import CardBox from '@/components/backend/CardBox.vue'
import SectionTitleBar from '@/components/backend/SectionTitleBar.vue'
import SectionHeroBar from '@/components/backend/SectionHeroBar.vue'
import CreateVolumeModal from '@/components/backend/CreateVolumeModal.vue'
import VolumesTable from '@/components/backend/VolumesTable.vue';
import BaseButtons from '@/components/backend/BaseButtons.vue';
import DividerHorizontal from '@/components/backend/DividerHorizontal.vue'
import BaseButton from '@/components/backend/BaseButton.vue';
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
    type: Object,

  }

})

const isModalActive = ref(false)
const titleStack = ref(['Dashboard', 'Comic', props.comic.title])
</script>

<template>

  <AppLayout>

    <Head :title="props.comic.title" />
    <SectionTitleBar :title-stack="titleStack" />
    <SectionMain>

      <CreateVolumeModal hasCancel v-model="isModalActive"   buttonLabel="Create" :comicId="props.comic.id" :errors="props.errors"
        title="Create Volume" :icon="mdiAccountCircle" :volumeCount="props.volumes.length" />


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
