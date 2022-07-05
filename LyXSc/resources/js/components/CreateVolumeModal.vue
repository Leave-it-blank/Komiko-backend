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
  volumeCount: {
    type: Number,
    default: 0
  },
  errors: Object,
})
let count = parseInt( props.volumeCount) +1;
console.log(props.errors);
const volumeForm = useForm({
  name: 'Volume ' + String(count),
  number: parseInt(count),
})
const emit = defineEmits(['update:modelValue', 'cancel', 'confirm', 'refreshtable'])

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
  Inertia.post(url, volumeForm, {
    onSuccess: (page) => {  emit('refreshtable') },
  })
 //this.$parent.$emit('refreshtable');
  confirmCancel('confirm');

  //console.log(props.errors);
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
        <FormField label="Name" :help="props.errors.name">
          <FormControl v-model="volumeForm.name" :icon="mdiAccount" name="name" required autocomplete="Name" />
        </FormField>
        <FormField label="Vol-Number" :help="props.errors.number">
          <FormControl v-model="volumeForm.number" :icon="mdiMail" type="Number" name="number" required
            autocomplete="Number" />
        </FormField>

      </div>

      <DividerHorizontal />

      <BaseButtons>
        <BaseButton :label="buttonLabel" :color="button" type="submit" />
        <BaseButton v-if="hasCancel" label="Cancel" :color="button" outline @click="cancel" />
      </BaseButtons>
    </CardBox>
  </OverlayLayer>
</template>
