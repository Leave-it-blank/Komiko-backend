<template>
  <AppLayout>
    <Head title="Advertisements" />
    <SectionTitleBar :title-stack="titleStack" routeName="dashboard" />
    <SectionMain>
      <DividerHorizontal />

      <div v-if="props.advertisements">
        <div>
          <div class="container p-2 md:mx-auto md:m-3">
            <div class="w-full md:px-10">
              <div
                class="flex flex-col w-full min-w-0 mb-6 break-words border-2 rounded bg-zinc-100 dark:bg-gray-900"
              >
                <div class="px-4 py-3 mb-0 border-0 rounded-t">
                  <div class="flex flex-wrap items-center">
                    <div class="flex-1 flex-grow w-full max-w-full px-4">
                      <h3
                        class="text-gray-900 dark:text-white font-bold font-catamaran"
                      >
                        Advertisement List
                      </h3>
                    </div>
                  </div>
                </div>

                <div class="block w-full overflow-x-auto md:px-4">
                  <table class="items-center w-full border-collapse mb-4">
                    <thead>
                      <tr
                        class="border border-b border-l-0 border-r-0 border-gray-600 dark:border-gray-100 border-solid"
                      >
                        <th
                          class="px-6 py-3 text-xs font-semibold text-left uppercase align-middle whitespace-nowrap"
                        >
                          Status
                        </th>
                        <th
                          class="px-6 py-3 text-xs font-semibold text-left uppercase align-middle whitespace-nowrap"
                        >
                          Advertisement
                        </th>
                        <th
                          class="px-6 py-3 text-xs font-semibold text-left uppercase align-middle whitespace-nowrap"
                        >
                          Active until~
                        </th>
                        <th
                          class="px-6 py-3 text-xs font-semibold text-left uppercase align-middle whitespace-nowrap"
                        >
                          Action
                        </th>
                      </tr>
                    </thead>

                    <tbody v-for="ads in props.advertisements">
                      <tr style=" background-color: transparent; !important ">
                        <th
                          class="p-4 px-6 text-xs text-left align-middle border-t-0 border-l-0 border-r-0 whitespace-nowrap"
                        >
                          <button
                            @click="enable_advt(ads.id)"
                            class="px-4 py-2 font-bold bg-gray-800 text-white rounded-lg hover:bg-blue-700"
                          >
                            {{ ads.is_enabled ? "Enabled" : "Disabled" }}
                          </button>
                        </th>
                        <th
                          class="p-4 px-6 text-xs text-left text-gray-700 align-middle border-t-0 border-l-0 border-r-0 dark:text-gray-200 whitespace-nowrap"
                        >
                          {{ ads.name }}
                        </th>

                        <td
                          class="p-4 px-6 text-xs align-middle border-t-0 border-l-0 border-r-0 whitespace-nowrap"
                        >
                          <i class="mr-4 fas fa-arrow-up text-emerald-500"></i>
                          {{ dateshow(ads.expires_at) }}
                        </td>
                        <td
                          class="px-6 text-xs align-middle border-t-0 border-l-0 border-r-0 whitespace-nowrap"
                        >
                          <BaseButton
                            color="info"
                            small
                            routeName="site.management.advertisements.edit"
                            :routeTo="ads.id"
                            class="px-5 py-2 bg-gray-800 text-white rounded-md"
                            label="Edit"
                          >
                          </BaseButton>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </SectionMain>
  </AppLayout>
</template>

<script setup>
import moment from "moment";
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
  advertisements: {
    type: Object,
    default: null,
  },
  errors: {
    type: Object,
  },
});

function dateshow(value) {
  return moment(value).format("YYYY-MM-DD"); // here u modify data
}
function enable_advt($advert) {
  let url = route("site.management.advertisements.status.update", $advert);
  Inertia.get(url);
  /*
    {
      onSuccess: () => {
        let urltwo = route('site.management.advertisements.view');
        Inertia.visit(urltwo, { only: ['advertisements'], })
      },
    } */
}

const titleStack = ref(["Dashboard", "Advertisements"]);
</script>
