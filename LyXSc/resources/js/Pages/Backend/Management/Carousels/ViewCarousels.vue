<template>
<AppLayout>


        <Head title="Carousels" />
    <SectionTitleBar :title-stack="titleStack" routeName="dashboard"  />
        <SectionMain>

     <BaseButton label=" Create Carousel" routeName="comic.management.carousel.create" color="info" />
            <DividerHorizontal />
 <CardBox
      class="mb-6"
      title="Carousels"
      :icon="mdiAccountMultiple"
      has-table
    >
    <div  v-if="props.carousels">
           <CarouselsTable :carousels="props.carousels"></CarouselsTable>
 </div>
 </CardBox>

  </SectionMain>
</AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/App.vue';
import { Inertia } from '@inertiajs/inertia'
import { Head } from '@inertiajs/inertia-vue3'
import { ref, reactive, computed } from 'vue'
import { useForm } from '@inertiajs/inertia-vue3'
import { useSiteStore } from '@/stores/site'
import { useMainStore } from '@/stores/main'
import CarouselsTable  from '@/components/CarouselsTable.vue'
import { mdiMonitorCellphone, mdiAccountMultiple, mdiTableBorder, mdiTableOff } from '@mdi/js'
import SectionMain from '@/components/SectionMain.vue'
import NotificationBar from '@/components/NotificationBar.vue'
import CardBox from '@/components/CardBox.vue'
import SectionTitleBar from '@/components/SectionTitleBar.vue'
import SectionHeroBar from '@/components/SectionHeroBar.vue'

import BaseButtons from '@/components/BaseButtons.vue';
import DividerHorizontal from '@/components/DividerHorizontal.vue'
import BaseButton from '@/components/BaseButton.vue';
const props = defineProps({
  carousels: {
    type: Object,
    default: null
  },
  errors: {
    type: Object
  }
})



const titleStack = ref(['Dashboard', 'Carousels'])
</script>
