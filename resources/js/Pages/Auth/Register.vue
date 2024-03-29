<script setup>
import { useMainStore } from "@/stores/main";
import { useForm, usePage, Head } from "@inertiajs/inertia-vue3";
import { computed } from "vue";
import { mdiAccount, mdiEmail, mdiFormTextboxPassword } from "@mdi/js";
import SectionFullScreen from "@/components/backend/SectionFullScreen.vue";
import CardBox from "@/components/backend/CardBox.vue";
import FormCheckRadioPicker from "@/components/backend/FormCheckRadioPicker.vue";
import FormField from "@/components/backend/FormField.vue";
import FormControl from "@/components/backend/FormControl.vue";
import DividerHorizontal from "@/components/backend/DividerHorizontal.vue";
import BaseButton from "@/components/backend/BaseButton.vue";
import BaseButtons from "@/components/backend/BaseButtons.vue";
import FormValidationErrors from "@/components/backend/FormValidationErrors.vue";
import ReaderLayout from "@/Layouts/ReaderLayout.vue";

const form = useForm({
  name: "",
  email: "",
  password: "",
  password_confirmation: "",
  terms: [],
});

useMainStore().fullScreenToggle(true);

const hasTermsAndPrivacyPolicyFeature = computed(
  () => usePage().props.value.jetstream.hasTermsAndPrivacyPolicyFeature
);

const submit = () => {
  form
    .transform((data) => ({
      ...data,
      terms: form.terms && form.terms.length,
    }))
    .post(route("register"), {
      onFinish: () => form.reset("password", "password_confirmation"),
    });
};
</script>

<template>
  <ReaderLayout>
    <Head :title="'Register - ' + $page.props.sitedata.site_name" />
    <SectionFullScreen v-slot="{ cardClass, cardRounded }" >
      <CardBox
        :class="cardClass"
        class="my-24"
        :rounded="cardRounded"
        form
        @submit.prevent="submit"
      >
        <FormValidationErrors />

        <FormField label="Name" label-for="name" help="Please enter your name">
          <FormControl
            v-model="form.name"
            id="name"
            :icon="mdiAccount"
            autocomplete="name"
            type="text"
            required
          />
        </FormField>

        <FormField
          label="Email"
          label-for="email"
          help="Please enter your email"
        >
          <FormControl
            v-model="form.email"
            id="email"
            :icon="mdiEmail"
            autocomplete="email"
            type="email"
            required
          />
        </FormField>

        <FormField
          label="Password"
          label-for="password"
          help="Please enter new password"
        >
          <FormControl
            v-model="form.password"
            id="password"
            :icon="mdiFormTextboxPassword"
            type="password"
            autocomplete="new-password"
            required
          />
        </FormField>

        <FormField
          label="Confirm Password"
          label-for="password_confirmation"
          help="Please confirm your password"
        >
          <FormControl
            v-model="form.password_confirmation"
            id="password_confirmation"
            :icon="mdiFormTextboxPassword"
            type="password"
            autocomplete="new-password"
            required
          />
        </FormField>

        <FormCheckRadioPicker
          v-if="hasTermsAndPrivacyPolicyFeature"
          v-model="form.terms"
          name="remember"
          :options="{ agree: 'I agree to the Terms' }"
        />

        <DividerHorizontal />

        <BaseButtons>
          <BaseButton
            type="submit"
            color="info"
            label="Register"
            :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing"
          />
          <BaseButton route-name="login" color="info" outline label="Login" />
        </BaseButtons>
      </CardBox> </SectionFullScreen
  ></ReaderLayout>
</template>
