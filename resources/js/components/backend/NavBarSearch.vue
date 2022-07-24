<script setup>
import FormControl from '@/components/backend/FormControl.vue'
</script>

<template>
  <FormControl
    ref="root"
    placeholder="Search (ctrl+k)"
    ctrl-k-focus
    transparent
    borderless
  />
</template>
