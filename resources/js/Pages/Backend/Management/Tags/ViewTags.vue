<template>
  <AppLayout>
    <Head title="Tags" />
    <SectionTitleBar :title-stack="titleStack" routeName="dashboard" />
    <SectionMain>
      <CreateTagsModal
        hasCancel
        v-model="isModalActive"
        buttonLabel="Create"
        :errors="props.errors"
        title="Create Tag"
        :icon="mdiTrashCan"
      />
      <BaseButton
        label="Create Tag"
        @click="isModalActive = true"
        color="info"
      />
      <DividerHorizontal />
      <CardBox
        class="mb-6 px-5"
        title="tags"
        :icon="mdiAccountMultiple"
        has-table
      >
        <div v-if="props.tags">
          <TagsTable :tags="props.tags"></TagsTable>
        </div>
      </CardBox>
    </SectionMain>
  </AppLayout>
</template>

<script setup>
import AppLayout from "@/Layouts/App.vue";
import { Head } from "@inertiajs/inertia-vue3";
import { ref } from "vue";
import { mdiAccountMultiple, mdiTrashCan } from "@mdi/js";
import TagsTable from "@/components/backend/management/tags/TagsTable.vue";
import SectionMain from "@/components/backend/SectionMain.vue";
import CardBox from "@/components/backend/CardBox.vue";
import SectionTitleBar from "@/components/backend/SectionTitleBar.vue";
import CreateTagsModal from "@/components/backend/management/tags/CreateTagsModal.vue";
import DividerHorizontal from "@/components/backend/DividerHorizontal.vue";
import BaseButton from "@/components/backend/BaseButton.vue";
const props = defineProps({
  tags: {
    type: Object,
    default: null,
  },
  errors: {
    type: Object,
  },
});
const isModalActive = ref(false);
const titleStack = ref(["Dashboard", "Tags"]);
</script>
