<template>
  <AppLayout>

    <Head title="Welcome" />
    <SectionTitleBar :title-stack="titleStack" />
    <SectionHeroBar>Users</SectionHeroBar>

    <SectionMain>
      <!--     <NotificationBar
      color="info"
      :icon="mdiMonitorCellphone"
    >
      <b>Responsive table.</b> Collapses on mobile
    </NotificationBar> -->
    <CardBox
      class="mb-6"
      title="Users"
      :icon="mdiAccountMultiple"
      has-table
    >
       <UsersListTable checkable :users="props.users" />
    </CardBox>

    </SectionMain>

  </AppLayout>
</template>


<script setup>
import AppLayout from '@/Layouts/App.vue';
import { Head } from '@inertiajs/inertia-vue3'
import { ref } from 'vue'
import { mdiMonitorCellphone, mdiAccountMultiple, mdiTableBorder, mdiTableOff } from '@mdi/js'
import SectionMain from '@/components/SectionMain.vue'
import NotificationBar from '@/components/NotificationBar.vue'
import UsersListTable from '@/components/UsersListTable.vue'
import CardBox from '@/components/CardBox.vue'
import SectionTitleBar from '@/components/SectionTitleBar.vue'
import SectionHeroBar from '@/components/SectionHeroBar.vue'

import SectionTitleBarSub from '@/components/SectionTitleBarSub.vue'
const props = defineProps({
  users: {
    type: Array,
    default: null
  }
})

const titleStack = ref(['Dashboard', 'Users'])
</script>
