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
import { Dashboard } from "@uppy/vue";

import "@uppy/core/dist/style.css";
import "@uppy/dashboard/dist/style.css";
import "@uppy/webcam/dist/style.css";
import "@uppy/image-editor/dist/style.css";

import Uppy from "@uppy/core";
import Webcam from "@uppy/webcam";
import XHRUpload from "@uppy/xhr-upload";
import ImageEditor from "@uppy/image-editor";
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
  chapterId: {
    type: Number,
    default: null
  },

  errors: Object,
})

const chapterForm = useForm({
  images: '',
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
  let url = route('comics_management.chapter.upload', props.chapterId,
  )
  Inertia.post(url, chapterForm, {
    onSuccess: (page) => {
      let urltwo = route('comics_management.chapter.view', props.chapterId);
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


const uppy = new Uppy({
  metaFields: [
    { id: "name", name: "Name", placeholder: "file name" },
    {
      id: "caption",
      name: "Caption",
      placeholder: "describe what the image is about",
    },
  ],
});
let url = route('comics_management.chapter.upload', props.chapterId);

uppy.use(XHRUpload, {
  endpoint: url,
  fieldName: "file",
});
uppy.use(ImageEditor, {
  quality: 0.7,
});
function beforeUnmount() {
    this.uppy.close();
  }
data:() =>{
    return {
      uppy,
    };
}

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
        <div id="uppyApp">
  <dashboard
      ref="dash"
      :uppy="uppy"
      :plugins="[ 'ImageEditor']"
    />
        </div>

      </div>

      <DividerHorizontal />

      <BaseButtons>
        <BaseButton :label="buttonLabel" :color="button" type="submit" />
        <BaseButton v-if="hasCancel" label="Cancel" :color="button" outline @click="cancel" />
      </BaseButtons>
    </CardBox>
  </OverlayLayer>
</template>
