<template>
  <AppLayout>
    <Head title="Carousels" />
    <SectionTitleBar :title-stack="titleStack" routeName="dashboard" />
    <SectionMain>
      <BaseButton
        label=" Create Carousel"
        routeName="comic.management.carousel.create"
        color="info"
      />
      <DividerHorizontal />
      <CardBox
        class="mb-6"
        title="Carousels"
        :icon="mdiAccountMultiple"
        has-table
      >
        <div v-if="props.carousels">
          <CarouselsTable :carousels="props.carousels"></CarouselsTable>
        </div>
      </CardBox>
    </SectionMain>
  </AppLayout>
</template>

<script setup>
import AppLayout from "@/Layouts/App.vue";
import { Inertia } from "@inertiajs/inertia";
import { Head } from "@inertiajs/inertia-vue3";
import { ref, reactive, computed } from "vue";
import { useForm } from "@inertiajs/inertia-vue3";
import { useSiteStore } from "@/stores/site";
import { useMainStore } from "@/stores/main";
import CarouselsTable from "@/components/backend/CarouselsTable.vue";
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

import BaseButtons from "@/components/backend/BaseButtons.vue";
import DividerHorizontal from "@/components/backend/DividerHorizontal.vue";
import BaseButton from "@/components/backend/BaseButton.vue";
const props = defineProps({
  carousels: {
    type: Object,
    default: null,
  },
  errors: {
    type: Object,
  },
});

const titleStack = ref(["Dashboard", "Carousels"]);
</script>
