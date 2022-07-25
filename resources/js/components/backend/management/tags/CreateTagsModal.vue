<script setup>
import { computed } from "vue";
import { useForm } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
import { mdiAccount, mdiClose } from "@mdi/js";
import BaseButton from "@/components/backend/BaseButton.vue";
import BaseButtons from "@/components/backend/BaseButtons.vue";
import CardBox from "@/components/backend/CardBox.vue";
import DividerHorizontal from "@/components/backend/DividerHorizontal.vue";
import OverlayLayer from "@/components/backend/OverlayLayer.vue";
import FormField from "@/components/backend/FormField.vue";
import FormControl from "@/components/backend/FormControl.vue";
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

  errors: Object,
});

const tagForm = useForm({
  name: "Action",
  svg: "",
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

function submit() {
  tagForm.clearErrors();
  let url = route("comic.management.tags.store");
  Inertia.post(url, tagForm, {
    onSuccess: (page) => {
      let urltwo = route("admin.management.tags");
      Inertia.visit(urltwo, { only: ["tags"] });
    },
  });

  confirmCancel("confirm");
}

const confirm = () => confirmCancel("confirm");

const cancel = () => confirmCancel("cancel");
</script>

<template>
  <OverlayLayer v-show="value" @overlay-click="cancel">
    <CardBox
      v-show="value"
      :title="title"
      class="shadow-lg w-full max-h-modal md:w-3/5 lg:w-2/5 z-50"
      rounded="rounded-lg"
      :header-icon="mdiClose"
      modal
      form
      @submit.prevent="submit"
      enctype="multipart/form-data"
      @header-icon-click="cancel"
    >
      <div class="space-y-3">
        <h1 v-if="largeTitle" class="text-2xl">
          {{ largeTitle }}
        </h1>
        <FormField label="Name" :help="props.errors.name">
          <FormControl
            v-model="tagForm.name"
            :icon="mdiAccount"
            name="name"
            required
            autocomplete="Name"
          />
        </FormField>
        <div class="py-2 my-3">
          <input type="file" @input="tagForm.svg = $event.target.files[0]" />
          <progress
            v-if="tagForm.progress"
            :value="tagForm.progress.percentage"
            max="100"
          >
            {{ tagForm.progress.percentage }}%
          </progress>
        </div>

        <div v-if="errors.svg" class="p-1 text-sm text-red-300">
          {{ errors.svg }}
        </div>
      </div>

      <DividerHorizontal />

      <BaseButtons>
        <BaseButton
          :label="buttonLabel"
          :color="button"
          type="submit"
          :disabled="tagForm.processing"
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
