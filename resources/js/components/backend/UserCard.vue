<script setup>
import { computed, ref } from 'vue'
import { useMainStore } from '@/stores/main'
import { mdiCheckDecagram } from '@mdi/js'
import BaseLevel from '@/components/backend/BaseLevel.vue'
import UserAvatar from '@/components/backend/UserAvatar.vue'
import CardBox from '@/components/backend/CardBox.vue'
import FormCheckRadioPicker from '@/components/backend/FormCheckRadioPicker.vue'
import PillTag from '@/components/backend/PillTag.vue'

const mainStore = useMainStore()
const prop = defineProps({
  checkable: Boolean,
  userName: {
    type: String,
    default: null
  }
});

const userSwitchVal = ref([])
</script>

<template>
  <CardBox rounded="">
    <BaseLevel type="justify-around lg:justify-center">
      <UserAvatar class="lg:mx-12" />
      <div class="space-y-3 text-center md:text-left lg:mx-12">
        <div class="flex justify-center md:block">
          <FormCheckRadioPicker
            v-model="userSwitchVal"
            name="sample-switch"
            type="switch"
            :options="{ one: 'Notifications' }"
          />
        </div>
        <h1 class="text-2xl">
          Howdy, <b>{{ prop.userName }}</b>!
        </h1>
        <p>Last login <b>12 mins ago</b> from <b>127.0.0.1</b></p>
        <div class="flex justify-center md:block">
          <PillTag
            text="Verified"
            type="info"
            :icon="mdiCheckDecagram"
          />
        </div>
      </div>
    </BaseLevel>
  </CardBox>
</template>
