<template>

  <BaseButton label="Upload" @click="uploadFile" color="warning" />




</template>
<script setup>
import BaseButton from '@/components/backend/BaseButton.vue';
import { useForm } from '@inertiajs/inertia-vue3'
import { Inertia } from '@inertiajs/inertia';
import DragDrop from '@uppy/drag-drop'
const props = defineProps({
  chapterId: {
    type: Number,
    default: null
  },

  errors: Object,
})
const chapterForm = useForm({
  images: '',
})
function submit() {

  chapterForm.clearErrors()
  let url = route('comics_management.chapter.upload', props.chapterId,
  )
  Inertia.post(url, chapterForm, {
    onSuccess: (page) => {
      let urltwo = route('comics_management.chapter.view', props.chapterId);
      Inertia.visit(urltwo, { only: ['chapters'], })
    },
  })

}

uppy.use(DragDrop, {
  target: null,
  width: '100%',
  height: '100%',
  note: null,
  locale: {},
})

</script>
