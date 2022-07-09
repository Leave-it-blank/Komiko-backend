<script setup>
import { Head } from '@inertiajs/inertia-vue3'
import App from '@/Layouts/App.vue'
import { computed, ref, onMounted } from 'vue'
import { useMainStore } from '@/stores/main'
import {
  mdiAccountMultiple,
  mdiCartOutline,
  mdiChartTimelineVariant,
  mdiFinance,
  mdiMonitorCellphone,
  mdiReload,
  mdiGithub,
  mdiChartPie
} from '@mdi/js'
import * as chartConfig from '@/components/Charts/chart.config.js'
import LineChart from '@/components/Charts/LineChart.vue'
import SectionMain from '@/components/SectionMain.vue'
import SectionTitleBar from '@/components/SectionTitleBar.vue'
import SectionHeroBar from '@/components/SectionHeroBar.vue'
import CardBoxWidget from '@/components/CardBoxWidget.vue'
import CardBox from '@/components/CardBox.vue'
import TableSampleClients from '@/components/TableSampleClients.vue'
import NotificationBar from '@/components/NotificationBar.vue'
import BaseButton from '@/components/BaseButton.vue'
import CardBoxTransaction from '@/components/CardBoxTransaction.vue'
import CardBoxClient from '@/components/CardBoxClient.vue'
import SectionTitleBarSub from '@/components/SectionTitleBarSub.vue'

const titleStack = ref(['Admin', 'Dashboard'])

const chartData = ref(null)

const fillChartData = () => {
  chartData.value = chartConfig.sampleChartData()

}

onMounted(() => {
  fillChartData()
})
const props = defineProps({
  stats: {
    type: Object,
    default: null
  }
})
const mainStore = useMainStore()

const darkMode = computed(() => mainStore.darkMode)
</script>

<template>
<Head title="Dashboard" />
<app>

  <SectionTitleBar :title-stack="titleStack" />
  <SectionHeroBar>Performance Stats </SectionHeroBar>
  <SectionMain>

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3 mb-6">
      <CardBoxWidget
        trend="12%"
        trend-type="up"
        color="text-emerald-500"
        :icon="mdiAccountMultiple"
        :number="props.stats.usercount"
        label="Users"
      />
      <CardBoxWidget
        trend="12%"
        trend-type="up"
        color="text-blue-500"
       :icon="mdiChartTimelineVariant"
        :number="props.stats.comicviewcount"

        label="Comics Views"
      />
      <CardBoxWidget
        trend="Overflow"
        trend-type="up"
        color="text-green-500"
        :icon="mdiChartTimelineVariant"
        :number="props.stats.chapterviewcount"

        label="Chapters Views"
      />
    </div>


    <SectionTitleBarSub
      :icon="mdiChartPie"
      title="Trends overview"
    />

    <CardBox
      title="Performance"
      :icon="mdiFinance"
      :header-icon="mdiReload"
      class="mb-6"
      @header-icon-click="fillChartData"
    >
      <div v-if="chartData">
        <line-chart
          :data="chartData"
          class="h-96"
        />
      </div>
    </CardBox>


  </SectionMain>
  </app>
</template>
