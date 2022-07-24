<template>
  <AppLayout>

    <Head title="Edit User" />
    <SectionTitleBar :title-stack="titleStack" routeName="authentication.users" />

    <UserCard :userName="mainStore.userDataName" />

    <SectionMain>
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <CardBox title="Edit Profile" :icon="mdiAccountCircle" form @submit.prevent="submitProfile">

          <FormField label="Name" :help="errors.name">
            <FormControl v-model="profileForm.name" :icon="mdiAccount" name="username" required
              autocomplete="username" />
          </FormField>
          <FormField label="E-mail" :help="errors.email">
            <FormControl v-model="profileForm.email" :icon="mdiMail" type="email" name="email" required
              autocomplete="email" />
          </FormField>

          <DividerHorizontal />

          <BaseButtons>
            <BaseButton color="info" type="submit" label="Submit" />
          </BaseButtons>
        </CardBox>

        <CardBox title="Change Password" :icon="mdiLock" form @submit.prevent="submitPass">
          <DividerHorizontal />

          <FormField label="New password" :help="errors.password">
            <FormControl v-model="passwordForm.password" :icon="mdiFormTextboxPassword" name="password" type="password"
              required autocomplete="new-password" />
          </FormField>

          <FormField label="Confirm password" :help="passwordForm.error">
            <FormControl v-model="passwordForm.password_confirmation" :icon="mdiFormTextboxPassword"
              name="password_confirmation" type="password" required autocomplete="new-password" />
          </FormField>
          <DividerHorizontal />

          <BaseButtons>
            <BaseButton type="submit" color="info" label="Submit" />
          </BaseButtons>
        </CardBox>
        <div class="lg:col-span-2">


        <CardBox title="Customize Roles" :icon="mdiLock" form @submit.prevent="submitRoles">
          <FormField label="Roles" :help="errors.userRoles">
         <div class="flex flex-wrap mb-6">
        <div class="w-full px-3 bg-light dark:bg-primary-dark rounded-md p-3 border border-primary-lighter">
            <label class="block capitalize tracking-wide text-primary-darker dark:text-white text-md font-bold mb-2" for="grid-password">
                Current Roles {{rolesForm.userRoles}}
            </label>
            <div class="grid grid-cols-1 md:grid-cols-2 text-left">


                    <div class="col-span-1" v-for="role in props.roles">
                        <input class="rounded-xl" type="checkbox" v-model="rolesForm.userRoles" name="rolesForm.userRoles[]" :value="role.id"   >
                        <label class="capitalize">{{ role.name }} </label>
                    </div>

            </div>
        </div>
    </div>


</FormField>
          <DividerHorizontal />
          <BaseButtons>
            <BaseButton type="submit" color="info" label="Submit" />
          </BaseButtons>
        </CardBox>
      </div>
       </div>
    </SectionMain>
  </AppLayout>
</template>


<script setup>
import AppLayout from '@/Layouts/App.vue';
import { ref, reactive } from 'vue'
import { useMainStore } from '@/stores/main'
import { mdiAccount, mdiAccountCircle, mdiLock, mdiMail, mdiAsterisk, mdiFormTextboxPassword } from '@mdi/js'
import SectionMain from '@/components/backend/SectionMain.vue'
import CardBox from '@/components/backend/CardBox.vue'
import SectionTitleBar from '@/components/backend/SectionTitleBar.vue'
import DividerHorizontal from '@/components/backend/DividerHorizontal.vue'
import FormField from '@/components/backend/FormField.vue'
import FormControl from '@/components/backend/FormControl.vue'
import FormFilePicker from '@/components/backend/FormFilePicker.vue'
import BaseButton from '@/components/backend/BaseButton.vue'
import BaseButtons from '@/components/backend/BaseButtons.vue'
import UserCard from '@/components/backend/UserCard.vue'
import { Head } from '@inertiajs/inertia-vue3'
import { Inertia } from '@inertiajs/inertia';
const props = defineProps({
  tuser: {
    type: Object,
    default: null
  },
  errors: Object,
  roles: {
    type: Object,
    default: null
  },
  crUID: {
    type: Array,
    default: null
  }
})

const titleStack = ref(['Dashboard', 'Users', props.tuser.name, 'Edit'])


const mainStore = useMainStore()
mainStore.userDataName = props.tuser.name
mainStore.userDataEmail = props.tuser.email


const rolesForm = reactive({
  userRoles: []
})
rolesForm.userRoles = props.crUID
const profileForm = reactive({
  name: mainStore.userDataName,
  email: mainStore.userDataEmail,
  error: ' '
})

const passwordForm = reactive({
  password: '',
  password_confirmation: ''
})

function changePass() {
  if (passwordForm.password == passwordForm.password_confirmation) {

    return passwordForm.password
  } else {
    passwordForm.error = 'Password dont match.'
  }
}

const submitProfile = () => {
  //mainStore.setUser(profileForm)
  let url = route('authentication.users.detail.store', props.tuser)
  Inertia.post(url, profileForm)
}


const submitPass = () => {
  //
  let pass = changePass();
  if (pass != null) {
    let url2 = route('authentication.users.passcode.store', props.tuser)
    Inertia.post(url2, rolesForm)
  } else {
    return 404
  }

}
const submitRoles = () => {
  let url2 = route('authentication.users.roles.store', props.tuser)
  Inertia.post(url2, rolesForm)
}
</script>

