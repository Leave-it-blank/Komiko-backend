<template>
  <AppLayout>
    <Head title="Welcome" />
    <h1>Welcome</h1>

  </AppLayout>
</template>


<script setup>
  import AppLayout from '@/Layouts/App.vue';
  import { Head } from '@inertiajs/inertia-vue3'
const props = defineProps({
  users: {
    type: Object,
    default: null
  }
})

</script>
