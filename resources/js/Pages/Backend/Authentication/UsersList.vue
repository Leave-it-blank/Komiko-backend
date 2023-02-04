<template>
  <AppLayout>
    <Head title="Users List" />
    <SectionTitleBar :title-stack="titleStack" />
    <SectionMain>
      <!--     <NotificationBar
      color="info"
      :icon="mdiMonitorCellphone"
    >
      <b>Responsive table.</b> Collapses on mobile
    </NotificationBar> -->
      <CardBox class="mb-6 px-5" title="Users" :icon="mdiAccountMultiple" has-table
        ><div v-if="props.users">
          <UsersListTable checkable :users="props.users" />
        </div>
      </CardBox>
      <SectionHeroBar>Users</SectionHeroBar>
    </SectionMain>
  </AppLayout>
</template>

<script setup>
import AppLayout from "@/Layouts/App.vue";
import { Head } from "@inertiajs/inertia-vue3";
import { ref } from "vue";
import {
  mdiMonitorCellphone,
  mdiAccountMultiple,
  mdiTableBorder,
  mdiTableOff,
} from "@mdi/js";
import SectionMain from "@/components/backend/SectionMain.vue";
import NotificationBar from "@/components/backend/NotificationBar.vue";
import UsersListTable from "@/components/backend/UsersListTable.vue";
import CardBox from "@/components/backend/CardBox.vue";
import SectionTitleBar from "@/components/backend/SectionTitleBar.vue";
import SectionHeroBar from "@/components/backend/SectionHeroBar.vue";

import SectionTitleBarSub from "@/components/backend/SectionTitleBarSub.vue";
const props = defineProps({
  users: {
    type: Array,
    default: null,
  },
});

const titleStack = ref(["Dashboard", "Users"]);
</script>
