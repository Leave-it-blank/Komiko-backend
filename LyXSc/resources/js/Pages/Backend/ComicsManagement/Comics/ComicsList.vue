<script setup>
import AppLayout from '@/Layouts/App.vue';
import { Head } from '@inertiajs/inertia-vue3'
import { ref } from 'vue'
import { mdiMonitorCellphone, mdiAccountMultiple, mdiTableBorder, mdiTableOff } from '@mdi/js'
import SectionMain from '@/components/SectionMain.vue'
import NotificationBar from '@/components/NotificationBar.vue'
import CardBox from '@/components/CardBox.vue'
import SectionTitleBar from '@/components/SectionTitleBar.vue'
import SectionHeroBar from '@/components/SectionHeroBar.vue'
import ComicsTable from '@/components/ComicsTable.vue';
import BaseButtons from '@/components/BaseButtons.vue';
import DividerHorizontal from '@/components/DividerHorizontal.vue'
import BaseButton from '@/components/BaseButton.vue';
const props = defineProps({
  comics: {
    type: Array,
    default: null
  }
})

const titleStack = ref(['Dashboard', 'Comics'])
</script>

<template>

  <AppLayout>

    <Head title="Comics" />
    <SectionTitleBar :title-stack="titleStack" />
        <SectionMain>

     <BaseButton label=" Create Comic" routeName="comics_management.comics.create" color="info" />
            <DividerHorizontal />
 <CardBox
      class="mb-6"
      title="Comics"
      :icon="mdiAccountMultiple"
      has-table
    ><div  v-if="props.comics">
       <ComicsTable checkable :comics="props.comics" /></div>
    </CardBox>
<SectionHeroBar>Comics</SectionHeroBar>
        </SectionMain>
  </AppLayout>
</template>
