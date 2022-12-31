<script setup>
import { computed, ref } from "vue";
import { useMainStore } from "@/stores/main";
import {
  mdiEye,
  mdiTrashCan,
  mdiAccountEdit,
  mdiAttachmentPlus,
  mdiCircleEditOutline,
} from "@mdi/js";
import DeleteItemsModal from "@/components/backend/DeleteItemsModal.vue";
import TableCheckboxCell from "@/components/backend/TableCheckboxCell.vue";
import BaseLevel from "@/components/backend/BaseLevel.vue";
import BaseButtons from "@/components/backend/BaseButtons.vue";
import BaseButton from "@/components/backend/BaseButton.vue";
import UserAvatar from "@/components/backend/UserAvatar.vue";
import moment from "moment";
import SearchTable from "@/components/backend/SearchTable.vue";

const prop = defineProps({
  checkable: Boolean,
  chapters: {
    type: Array,
    default: null,
  },
});
function dateshow(value) {
  return moment(value).fromNow(); // here u modify data
}

const mainStore = useMainStore();

const lightBorderStyle = computed(() => mainStore.lightBorderStyle);

const lightBgStyle = computed(() => mainStore.lightBgStyle);

const tableTrStyle = computed(() => mainStore.tableTrStyle);

const tableTrOddStyle = computed(() => mainStore.tableTrOddStyle);

const darkMode = computed(() => mainStore.darkMode);

mainStore.clients = prop.chapters;

const items = computed(() => mainStore.clients);

let dataChapter = computed(() => mainStore.itemId);
const isModalActive = ref(false);
const isModalDangerActive = ref(false);

const perPage = ref(10);

const currentPage = ref(0);

const checkedRows = ref([]);

const itemsPaginated = computed(() =>
  items.value.slice(
    perPage.value * currentPage.value,
    perPage.value * (currentPage.value + 1)
  )
);

const numPages = computed(() => Math.ceil(items.value.length / perPage.value));

const currentPageHuman = computed(() => currentPage.value + 1);

const pagesList = computed(() => {
  const pagesList = [];

  for (let i = 0; i < numPages.value; i++) {
    pagesList.push(i);
  }

  return pagesList;
});

const remove = (arr, cb) => {
  const newArr = [];

  arr.forEach((item) => {
    if (!cb(item)) {
      newArr.push(item);
    }
  });

  return newArr;
};

const checked = (isChecked, client) => {
  if (isChecked) {
    checkedRows.value.push(client);
  } else {
    checkedRows.value = remove(checkedRows.value, (row) => row.id === client.id);
  }
};
</script>

<template>
  <div class="mb-3 xl:w-96">
    <SearchTable
      :searchArray="prop.chapters"
      Search
      searchIndexName="number"
      :searchComic="true"
    />
  </div>

  <DeleteItemsModal
    v-model="isModalActive"
    title="Do you really wanna delete the chapter?"
    button="danger"
    buttonLabel="Delete"
    hasCancel
    itemName="chapter"
    :itemId="dataChapter"
  >
    You are About to delete chapter number {{ dataChapter }} permanently. Warning: [Action
    can't be rolled back]
  </DeleteItemsModal>

  <div
    v-if="checkedRows.length"
    class="bg-opacity-50 p-3 dark:bg-gray-800"
    :class="lightBgStyle"
  >
    <span
      v-for="checkedRow in checkedRows"
      :key="checkedRow.id"
      class="inline-block px-2 py-1 rounded-sm mr-2 text-sm dark:bg-gray-700"
      :class="lightBgStyle"
    >
      {{ checkedRow.title }}
    </span>
  </div>
  <table>
    <thead>
      <tr>
        <th v-if="prop.checkable" />

        <th>Name</th>
        <th>Number</th>
        <th>Locked?</th>
        <th>views</th>
        <th>Last Updated</th>
        <th>Created</th>
        <th />
      </tr>
    </thead>
    <tbody>
      <tr
        v-for="(client, index) in itemsPaginated"
        :key="client.id"
        :class="[tableTrStyle, index % 2 === 0 ? tableTrOddStyle : '']"
      >
        <TableCheckboxCell v-if="prop.checkable" @checked="checked($event, client)" />

        <td data-label="Name">
          {{ client.name }}
        </td>
        <td data-label="number">
          {{ client.number }}
        </td>
        <td data-label="isLocked?">
          {{ client.isLocked ? "Locked" : "Open" }}
        </td>
        <td data-label="views">
          {{ client.views }}
        </td>
        <td data-label="Updated">
          <small class="text-gray-500 dark:text-gray-400" :title="client.updatedAt">{{
            dateshow(client.updatedAt)
          }}</small>
        </td>
        <td data-label="Created">
          <small class="text-gray-500 dark:text-gray-400" :title="client.createdAt">{{
            client.createdAt
          }}</small>
        </td>
        <td class="actions-cell">
          <BaseButtons type="justify-start lg:justify-end" no-wrap>
            <BaseButton
              color="info"
              :icon="mdiAttachmentPlus"
              small
              :routeName="client.viewUrl"
              :routeTo="client.id"
            />

            <BaseButton
              color="danger"
              :icon="mdiTrashCan"
              small
              v-on:click="(mainStore.itemId = client.id), (isModalActive = true)"
            />
          </BaseButtons>
        </td>
      </tr>
    </tbody>
  </table>
  <div :class="lightBorderStyle" class="p-3 lg:px-6 border-t dark:border-gray-800">
    <BaseLevel>
      <BaseButtons>
        <BaseButton
          v-for="page in pagesList"
          :key="page"
          :active="page === currentPage"
          :label="page + 1"
          :outline="darkMode"
          small
          @click="currentPage = page"
        />
      </BaseButtons>
      <small>Page {{ currentPageHuman }} of {{ numPages }}</small>
    </BaseLevel>
  </div>
</template>
