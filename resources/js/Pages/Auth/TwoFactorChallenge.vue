<script setup>
import { useMainStore } from '@/stores/main'
import { useForm, Head } from '@inertiajs/inertia-vue3'
import { nextTick, ref } from 'vue'
import SectionFullScreen from '@/components/backend/SectionFullScreen.vue'
import CardBox from '@/components/backend/CardBox.vue'
import FormControl from '@/components/backend/FormControl.vue'
import FormField from '@/components/backend/FormField.vue'
import DividerHorizontal from '@/components/backend/DividerHorizontal.vue'
import BaseButton from '@/components/backend/BaseButton.vue'
import FormValidationErrors from '@/components/backend/FormValidationErrors.vue'
import BaseLevel from '@/components/backend/BaseLevel.vue'

useMainStore().fullScreenToggle(true)

const recovery = ref(false);

const form = useForm({
  code: '',
  recovery_code: ''
})

const recoveryCodeInput = ref(null)
const codeInput = ref(null)

const toggleRecovery = async () => {
  recovery.value ^= true

  await nextTick()

  if (recovery.value) {
    recoveryCodeInput.value?.focus()
    form.code = ''
  } else {
    codeInput.value?.focus()
    form.recovery_code = ''
  }
}

const submit = () => {
  form.post(route('two-factor.login'))
}
</script>

<template>
  <Head title="Two-factor Confirmation" />

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

      <FormField>
        <div class="mb-4 text-sm text-gray-600">
          <template v-if="! recovery">
            Please confirm access to your account by entering the authentication code provided by your authenticator application.
          </template>

          <template v-else>
            Please confirm access to your account by entering one of your emergency recovery codes.
          </template>
        </div>
      </FormField>

      <FormField
        v-if="!recovery"
        label="Code"
        label-for="code"
        help="Please enter one-time code"
      >
        <FormControl
          id="code"
          @set-ref="codeInput = $event"
          v-model="form.code"
          type="text"
          inputmode="numeric"
          autofocus
          autocomplete="one-time-code"
        />
      </FormField>

      <FormField
        v-else
        label="Recovery Code"
        label-for="recovery_code"
        help="Please enter recovery code"
      >
        <FormControl
          id="recovery_code"
          @set-ref="recoveryCodeInput = $event"
          v-model="form.recovery_code"
          type="text"
          class="mt-1 block w-full"
          autocomplete="one-time-code"
        />
      </FormField>

      <DividerHorizontal />

      <BaseLevel>
        <BaseButton
          type="submit"
          color="info"
          label="Log in"
          :class="{ 'opacity-25': form.processing }"
          :disabled="form.processing"
        />
        <button @click.prevent="toggleRecovery">
          <template v-if="!recovery">
            Use a recovery code
          </template>

          <template v-else>
            Use an authentication code
          </template>
        </button>
      </BaseLevel>
    </CardBox>
  </SectionFullScreen>
</template>
