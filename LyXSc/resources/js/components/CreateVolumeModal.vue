<script setup>
import { computed } from 'vue'
import { ref, reactive } from 'vue'
import { useForm } from '@inertiajs/inertia-vue3'
import { Inertia } from '@inertiajs/inertia';
import { mdiAccount, mdiClose, mdiAccountCircle, mdiMail } from '@mdi/js'
import BaseButton from '@/components/BaseButton.vue'
import BaseButtons from '@/components/BaseButtons.vue'
import CardBox from '@/components/CardBox.vue'
import DividerHorizontal from '@/components/DividerHorizontal.vue'
import OverlayLayer from '@/components/OverlayLayer.vue'
import FormField from '@/components/FormField.vue'
import FormControl from '@/components/FormControl.vue'
const props = defineProps({
  title: {
    type: String,
    default: null
  },
  largeTitle: {
    type: String,
    default: null
  },
  button: {
    type: String,
    default: 'info'
  },
  buttonLabel: {
    type: String,
    default: 'Done'
  },
  hasCancel: Boolean,
  modelValue: {
    type: [String, Number, Boolean],
    default: null
  },
  comicId: {
    type: Number,
    default: null
  },
   errors: Object,
})
console.log(props.errors);
const volumeForm = useForm({
  name: '',
  number: 0,
})
const emit = defineEmits(['update:modelValue', 'cancel', 'confirm'])

const value = computed({
  get: () => props.modelValue,
  set: value => emit('update:modelValue', value)
})

const confirmCancel = mode => {
  value.value = false
  emit(mode)
}

function submit() {
  //mainStore.setUser(profileForm)
    volumeForm.clearErrors()
  let url = route('comics_management.volume.create.store', props.comicId,
  )
  Inertia.post(url, volumeForm)
   ///volumeForm.reset()
}

const confirm = () => confirmCancel('confirm')

const cancel = () => confirmCancel('cancel')
</script>

<template>
  <OverlayLayer v-show="value" @overlay-click="cancel">
    <CardBox v-show="value" :title="title" class="shadow-lg w-full max-h-modal md:w-3/5 lg:w-2/5 z-50"
      rounded="rounded-lg" :header-icon="mdiClose" modal form @submit.prevent="submit" enctype="multipart/form-data"
      @header-icon-click="cancel">
      <div class="space-y-3">
        <h1 v-if="largeTitle" class="text-2xl">
          {{ largeTitle }}
        </h1>
        <FormField label="Name"  :help="errors">
          <FormControl v-model="volumeForm.name" :icon="mdiAccount" name="Name" required autocomplete="Name" />
        </FormField>
        <FormField label="Vol-Number"  :help="errors">
          <FormControl v-model="volumeForm.number" :icon="mdiMail" type="Number" name="Number" required
            autocomplete="Number" />
        </FormField>

      </div>

      <DividerHorizontal />

      <BaseButtons>
        <BaseButton :label="buttonLabel" :color="button" type="submit" @click="confirm" />
        <BaseButton v-if="hasCancel" label="Cancel" :color="button" outline @click="cancel" />
      </BaseButtons>
    </CardBox>
  </OverlayLayer>
</template>
