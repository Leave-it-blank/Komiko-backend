<script setup>
import { useMainStore } from '@/stores/main'
import { useForm, Head, Link } from '@inertiajs/inertia-vue3'
import { computed } from 'vue'
import SectionFullScreen from '@/components/backend/SectionFullScreen.vue'
import CardBox from '@/components/backend/CardBox.vue'
import FormField from '@/components/backend/FormField.vue'
import DividerHorizontal from '@/components/backend/DividerHorizontal.vue'
import BaseButton from '@/components/backend/BaseButton.vue'
import FormValidationErrors from '@/components/backend/FormValidationErrors.vue'
import NotificationBarInCard from '@/components/backend/NotificationBarInCard.vue'
import BaseLevel from '@/components/backend/BaseLevel.vue'

const props = defineProps({
  status: {
    type: String,
    default: null
  }
})

const form = useForm()

useMainStore().fullScreenToggle(true)

const verificationLinkSent = computed(() => props.status === 'verification-link-sent')

const submit = () => {
  form.post(route('verification.send'))
}
</script>

<template>
  <Head title="Email Verification" />

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
        v-if="verificationLinkSent"
        color="info"
      >
        A new verification link has been sent to the email address you provided during registration.
      </NotificationBarInCard>

      <FormField>
        <div class="mb-4 text-sm text-gray-600">
          Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another.
        </div>
      </FormField>

      <DividerHorizontal />

      <BaseLevel>
        <BaseButton
          type="submit"
          color="info"
          label="Resend Verification Email"
          :class="{ 'opacity-25': form.processing }"
          :disabled="form.processing"
        />
        <Link
          :href="route('logout')"
          method="post"
          as="button"
        >
          Logout
        </Link>
      </BaseLevel>
    </CardBox>
  </SectionFullScreen>
</template>
