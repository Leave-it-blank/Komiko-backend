<script setup>
import { computed, ref  } from 'vue'
import { useMainStore } from '@/stores/main'
import { mdiEye, mdiTrashCan , mdiAccountEdit} from '@mdi/js'
import CardBoxModal from '@/components/CardBoxModal.vue'
import TableCheckboxCell from '@/components/TableCheckboxCell.vue'
import BaseLevel from '@/components/BaseLevel.vue'
import BaseButtons from '@/components/BaseButtons.vue'
import BaseButton from '@/components/BaseButton.vue'
import UserAvatar from '@/components/UserAvatar.vue'
import moment from 'moment'
import SearchTable from './SearchTable.vue'

const prop = defineProps({
  checkable: Boolean,
  comics: {
    type: Array,
    default: null
  }
});
function dateshow(value) {
    return moment(value).fromNow() // here u modify data
}

const mainStore = useMainStore()

const lightBorderStyle = computed(() => mainStore.lightBorderStyle)

const lightBgStyle = computed(() => mainStore.lightBgStyle)

const tableTrStyle = computed(() => mainStore.tableTrStyle)

const tableTrOddStyle = computed(() => mainStore.tableTrOddStyle)

const darkMode = computed(() => mainStore.darkMode)

mainStore.clients = prop.comics;

const items = computed(() => mainStore.clients)

const isModalActive = ref(false)

const isModalDangerActive = ref(false)

const perPage = ref(10)

const currentPage = ref(0)

const checkedRows = ref([])

const itemsPaginated = computed(
  () => items.value.slice(perPage.value * currentPage.value, perPage.value * (currentPage.value + 1))
)

const numPages = computed(() => Math.ceil(items.value.length / perPage.value))

const currentPageHuman = computed(() => currentPage.value + 1)

const pagesList = computed(() => {
  const pagesList = []

  for (let i = 0; i < numPages.value; i++) {
    pagesList.push(i)
  }

  return pagesList
})

const remove = (arr, cb) => {
  const newArr = []

  arr.forEach(item => {
    if (!cb(item)) {
      newArr.push(item)
    }
  })

  return newArr
}

const checked = (isChecked, client) => {
  if (isChecked) {
    checkedRows.value.push(client)
  } else {
    checkedRows.value = remove(checkedRows.value, row => row.id === client.id)
  }
}

</script>

<template>

  <div class="mb-3 xl:w-96">
   <SearchTable :searchArray="prop.comics" Search searchIndexName='title'/>
  </div>

  <CardBoxModal
    v-model="isModalActive"
    title="Sample modal"
  >
    <p>Lorem ipsum dolor sit amet <b>adipiscing elit</b></p>
    <p>This is sample modal</p>
  </CardBoxModal>

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
      {{ checkedRow.name }}
    </span>
  </div>
  <table>
    <thead>
      <tr>
        <th v-if="prop.checkable" />
        <th />
        <th>Name</th>
        <th>email</th>
        <th >Roles</th>
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
        <TableCheckboxCell
          v-if="prop.checkable"
          @checked="checked($event, client)"
        />
        <td class="image-cell">
          <UserAvatar
            :username="client.name"
            class="image"
          />
        </td>
        <td data-label="Name">
          {{ client.name }}
        </td>
        <td data-label="email">
          {{ client.email }}
        </td>
        <td data-label="currentRoles">
          <div>
          <span v-for="roles in client.currentRoles"  class="mx-auto">
             {{ roles }},
          </span>
          </div>


        </td>
        <td data-label="Updated">
          <small
            class="text-gray-500 dark:text-gray-400"
            :title="client.updatedAt"
          >{{ dateshow(client.updatedAt)  }}</small>
        </td>
        <td data-label="Created">
          <small
            class="text-gray-500 dark:text-gray-400"
            :title="client.createdAt"
          >{{ dateshow(client.createdAt)  }}</small>
        </td>
        <td class="actions-cell">
          <BaseButtons
            type="justify-start lg:justify-end"
            no-wrap
          >
            <BaseButton
              color="info"
              :icon="mdiEye"
              small
              @click="isModalActive = true"
            />
             <BaseButton
              color="warning"
              :icon="mdiAccountEdit"
              small
             :routeName="client.editUrl"
             :routeTo = "client.id"
            />

          </BaseButtons>
        </td>

      </tr>
    </tbody>
  </table>
  <div
    :class="lightBorderStyle"
    class="p-3 lg:px-6 border-t dark:border-gray-800"
  >
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
