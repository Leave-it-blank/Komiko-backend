<script setup>
import { useMainStore } from "@/stores/main";
import { useForm, Head, Link } from "@inertiajs/inertia-vue3";
import { mdiAccount, mdiAsterisk } from "@mdi/js";
import SectionFullScreen from "@/components/backend/SectionFullScreen.vue";
import CardBox from "@/components/backend/CardBox.vue";
import FormCheckRadioPicker from "@/components/backend/FormCheckRadioPicker.vue";
import FormField from "@/components/backend/FormField.vue";
import FormControl from "@/components/backend/FormControl.vue";
import DividerHorizontal from "@/components/backend/DividerHorizontal.vue";
import BaseButton from "@/components/backend/BaseButton.vue";
import BaseButtons from "@/components/backend/BaseButtons.vue";
import FormValidationErrors from "@/components/backend/FormValidationErrors.vue";
import NotificationBarInCard from "@/components/backend/NotificationBarInCard.vue";
import BaseLevel from "@/components/backend/BaseLevel.vue";
import ReaderLayout from "@/Layouts/ReaderLayout.vue";

const props = defineProps({
  canResetPassword: Boolean,
  status: {
    type: String,
    default: null,
  },
});

const form = useForm({
  email: "",
  password: "",
  remember: [],
});

useMainStore().fullScreenToggle(true);

const submit = () => {
  form
    .transform((data) => ({
      ...data,
      remember: form.remember && form.remember.length ? "on" : "",
    }))
    .post(route("login"), {
      onFinish: () => form.reset("password"),
    });
};
</script>

<template>
  <ReaderLayout>
    <Head :title="'Login - ' + $page.props.sitedata.site_name" />

    <SectionFullScreen v-slot="{ cardClass, cardRounded }" bg="login">
      <CardBox
        :class="cardClass"
        :rounded="cardRounded"
        form
        @submit.prevent="submit"
      >
        <FormValidationErrors />

        <NotificationBarInCard v-if="status" color="info">
          {{ status }}
        </NotificationBarInCard>

        <FormField
          label="Email"
          label-for="email"
          help="Please enter your email"
        >
          <FormControl
            v-model="form.email"
            :icon="mdiAccount"
            id="email"
            autocomplete="email"
            type="email"
            required
          />
        </FormField>

        <FormField
          label="Password"
          label-for="password"
          help="Please enter your password"
        >
          <FormControl
            v-model="form.password"
            :icon="mdiAsterisk"
            type="password"
            id="password"
            autocomplete="current-password"
            required
          />
        </FormField>

        <FormCheckRadioPicker
          v-model="form.remember"
          name="remember"
          :options="{ remember: 'Remember' }"
        />

        <DividerHorizontal />

        <BaseLevel>
          <BaseButtons>
            <BaseButton
              type="submit"
              color="info"
              label="Login"
              :class="{ 'opacity-25': form.processing }"
              :disabled="form.processing"
            />
            <BaseButton
              v-if="canResetPassword"
              route-name="password.request"
              color="info"
              outline
              label="Remind"
            />
          </BaseButtons>
          <Link :href="route('register')"> Register </Link>
        </BaseLevel>
      </CardBox>
    </SectionFullScreen>
  </ReaderLayout>
</template>
