<script setup>
import { useMainStore } from '@/stores/main'
import { useForm, Head, Link } from '@inertiajs/inertia-vue3'
import { mdiEmail } from '@mdi/js'
import SectionFullScreen from '@/components/backend/SectionFullScreen.vue'
import CardBox from '@/components/backend/CardBox.vue'
import FormField from '@/components/backend/FormField.vue'
import FormControl from '@/components/backend/FormControl.vue'
import DividerHorizontal from '@/components/backend/DividerHorizontal.vue'
import BaseButton from '@/components/backend/BaseButton.vue'
import FormValidationErrors from '@/components/backend/FormValidationErrors.vue'
import NotificationBarInCard from '@/components/backend/NotificationBarInCard.vue'
import BaseLevel from '@/components/backend/BaseLevel.vue'

defineProps({
  status: {
    type: String,
    default: null
  }
})

const form = useForm({
  email: ''
})

useMainStore().fullScreenToggle(true)

const submit = () => {
  form.post(route('password.email'))
}
</script>

<template>
  <Head title="Forgot Password" />

  <SectionFullScreen
    v-slot="{ cardClass, cardRounded }"
    bg="login"
  >
    <CardBox
      :class="cardClass"
      :rounded="cardRounded"
      form
      @submit.prevent="submit"
    >
      <FormValidationErrors />

      <NotificationBarInCard
        v-if="status"
        color="info"
      >
        {{ status }}
      </NotificationBarInCard>

      <FormField>
        <div class="mb-4 text-sm text-gray-600">
          Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.
        </div>
      </FormField>

      <FormField
        label="Email"
        help="Please enter your email"
      >
        <FormControl
          v-model="form.email"
          :icon="mdiEmail"
          autocomplete="email"
          type="email"
          required
        />
      </FormField>

      <DividerHorizontal />

      <BaseLevel>
        <BaseButton
          type="submit"
          color="info"
          label="Email link"
          :class="{ 'opacity-25': form.processing }"
          :disabled="form.processing"
        />
        <Link
          :href="route('login')"
        >
          Back to login
        </Link>
      </BaseLevel>
    </CardBox>
  </SectionFullScreen>
</template>
