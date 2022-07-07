<script setup>
import { computed } from 'vue'
import { mdiClose } from '@mdi/js'
import BaseButton from '@/components/BaseButton.vue'
import BaseButtons from '@/components/BaseButtons.vue'
import CardBox from '@/components/CardBox.vue'
import DividerHorizontal from '@/components/DividerHorizontal.vue'
import OverlayLayer from '@/components/OverlayLayer.vue'
import { Inertia } from '@inertiajs/inertia';
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
  itemId: {
    type: Number,
    default: null
  },
  itemName: {
    type: String,
    default: 'chapter'
  },
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
  let routedata = 'comics_management.' + props.itemName + '.delete';
  //console.log(props.itemId)
  let url = route(routedata, props.itemId )
  //console.log(url)
  Inertia.get(url, {
    onSuccess: (page) => {
      Inertia.reload({ only: [props.itemName + 's'] })

    },
  })
  // this.$forceUpdate()
  confirmCancel('confirm');

  //console.log(props.errors);
  ///volumeForm.reset()
}

const cancel = () => confirmCancel('cancel')
</script>

<template>
  <OverlayLayer
    v-show="value"
    @overlay-click="cancel"
  >
    <CardBox
      v-show="value"
      :title="title"
      class="shadow-lg w-full max-h-modal md:w-3/5 lg:w-2/5 z-50"
      rounded="rounded-lg"
      :header-icon="mdiClose"
      modal
      @header-icon-click="cancel"
    >
      <div class="space-y-3">
        <h1
          v-if="largeTitle"
          class="text-2xl"
        >
          {{ largeTitle }}
        </h1>
        <slot />
      </div>

      <DividerHorizontal />

      <BaseButtons>
        <BaseButton
          :label="buttonLabel"
          :color="button"
          @click="submit"
        />
        <BaseButton
          v-if="hasCancel"
          label="Cancel"
          :color="button"
          outline
          @click="cancel"
        />
      </BaseButtons>
    </CardBox>
  </OverlayLayer>
</template>
