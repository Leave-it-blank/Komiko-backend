<script setup>
import { computed } from 'vue'
import { ref, reactive } from 'vue'
import { useForm } from '@inertiajs/inertia-vue3'
import { Inertia } from '@inertiajs/inertia';
import { mdiAccount, mdiClose, mdiAccountCircle, mdiMail } from '@mdi/js'
import BaseButton from '@/components/backend/BaseButton.vue'
import BaseButtons from '@/components/backend/BaseButtons.vue'
import CardBox from '@/components/backend/CardBox.vue'
import DividerHorizontal from '@/components/backend/DividerHorizontal.vue'
import OverlayLayer from '@/components/backend/OverlayLayer.vue'
import FormField from '@/components/backend/FormField.vue'
import FormControl from '@/components/backend/FormControl.vue'
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
  volumeId: {
    type: Number,
    default: null
  },
  chapterCount: {
    type: Number,
    default: 0
  },
  errors: Object,
})
let count = parseInt(props.chapterCount) + 1;
console.log(props.errors);
const chapterForm = useForm({
  name: 'Chapter ' + String(count),
  number: parseInt(count),
  isLocked: false,
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
  chapterForm.clearErrors()
  let url = route('comics_management.chapter.store', props.volumeId,
  )
  Inertia.post(url, chapterForm, {
    onSuccess: (page) => {
      let urltwo = route('comics_management.volume.view', props.volumeId);
      Inertia.visit(urltwo, { only: ['chapters'], })
    },
  })
  // this.$forceUpdate()
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
          <FormControl v-model="chapterForm.name" :icon="mdiAccount" name="name" required autocomplete="Name" />
        </FormField>
        <FormField label="Number" :help="props.errors.number">
          <FormControl v-model="chapterForm.number" :icon="mdiMail" type="Number" name="number" required
            autocomplete="Number" />
        </FormField>
        <FormField label="Lock the chapter?" :help="props.errors.isLocked">

          <div class="flex ">
                 <input type="radio" id="one" :value="true" v-model="chapterForm.isLocked" class="my-1"/>
          <label for="one"  class="mx-2">Yes</label>

          <input type="radio" id="two" :value="false" v-model="chapterForm.isLocked" class="my-1" />
          <label for="two" class="mx-2">No</label>
          </div>
        </FormField>

      </div>

      <DividerHorizontal />

      <BaseButtons>
        <BaseButton :label="buttonLabel" :color="button" type="submit" :disabled="chapterForm.processing"/>
        <BaseButton v-if="hasCancel" label="Cancel" :color="button" outline @click="cancel" />
      </BaseButtons>
    </CardBox>
  </OverlayLayer>
</template>
