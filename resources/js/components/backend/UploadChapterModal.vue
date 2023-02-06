<script setup>
import { computed } from "vue";
import { Inertia } from "@inertiajs/inertia";
import OverlayLayer from "@/components/backend/OverlayLayer.vue";
import { Dashboard } from "@uppy/vue";

import "@uppy/core/dist/style.css";
import "@uppy/dashboard/dist/style.css";
import "@uppy/image-editor/dist/style.css";

import Uppy from "@uppy/core";
import XHRUpload from "@uppy/xhr-upload";
import ImageEditor from "@uppy/image-editor";
const props = defineProps({
  title: {
    type: String,
    default: null,
  },
  largeTitle: {
    type: String,
    default: null,
  },
  button: {
    type: String,
    default: "info",
  },
  buttonLabel: {
    type: String,
    default: "Done",
  },
  hasCancel: Boolean,
  modelValue: {
    type: [String, Number, Boolean],
    default: null,
  },
  chapterId: {
    type: Number,
    default: null,
  },
  crftoken: {
    type: String,
  },
  errors: Object,
});

const emit = defineEmits([
  "update:modelValue",
  "cancel",
  "confirm",
  "refreshtable",
]);

const value = computed({
  get: () => props.modelValue,
  set: (value) => emit("update:modelValue", value),
});

const confirmCancel = (mode) => {
  value.value = false;
  emit(mode);
};

const confirm = () => confirmCancel("confirm");

const cancel = () => confirmCancel("cancel");

const uppy = new Uppy({
  logger: Uppy.debugLogger,
  //autoProceed: true,
  debug: false,
  restrictions: {
    maxFileSize: 40000000, // 40 MB
    minNumberOfFiles: 1,
    maxNumberOfFiles: 120,
    allowedFileTypes: ["image/jpeg", "image/png", "image/gif"],
  },
});
let url = route("comics_management.chapter.upload.store", props.chapterId);

uppy.use(ImageEditor, {
  quality: 0.7,
});
uppy.use(XHRUpload, {
  endpoint: url,
  method: "post",
  formData: true,
  Return: value,
  timeout: 0,
  limit: 5,
  headers: {
    "X-CSRF-Token": props.crftoken,
  },
});
uppy.on("file-added", (file) => {
  // Do something'
  // console.log(file);
  console.log("FILE ADDED");
});

uppy.on("upload-error", (file, error, response) => {
  // Do something'
  console.log(response);
  console.log(error);
  // console.log(file);
  if(response.status === 413){
    console.log("FILE TOO BIG");
  }

  if (error.isNetworkError) {
    // Let your users know that file upload could have failed
    // due to firewall or ISP issues
    console.log("alertUserAboutPossibleFirewallOrISPIssues");
  } else {
    console.log(
      "FILE UPLOAD ERROR, not a network error. Prob related to file size"
    );
  }
  uppy.off("complete");
});

uppy.on("complete", (result) => {
  if (result.failed.length === 0) {
    let urltwo = route("comics_management.chapter.view", props.chapterId);
    Inertia.visit(urltwo, { only: ["pages"] });
    console.log(result);
    console.log("FILE UPLOAD SUCCESS");
  }
});

// uppy.on("upload-success", (result) => {
//   uppy.once("complete", (result) => {
//     let urltwo = route("comics_management.chapter.view", props.chapterId);
//     Inertia.visit(urltwo, { only: ["pages"] });
//     console.log(result);
//     console.log("FILE UPLOAD SUCCESS");
//   });
// });
</script>

<template>
  <OverlayLayer v-show="value" @overlay-click="cancel">
    <div class="space-y-3">
      <h1 v-if="largeTitle" class="text-2xl">
        {{ largeTitle }}
      </h1>
      <div id="uppyApp">
        <dashboard ref="dash" :uppy="uppy" :plugins="['ImageEditor']" />
      </div>
    </div>
  </OverlayLayer>
</template>
