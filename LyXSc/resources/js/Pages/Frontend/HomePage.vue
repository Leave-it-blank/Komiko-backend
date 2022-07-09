<template>
<ReaderLayout>

<ReaderNavBar></ReaderNavBar>

</ReaderLayout>

</template>

<script setup>

import { Head } from '@inertiajs/inertia-vue3'
import { computed, ref, onMounted } from 'vue'
import { useComicStore } from '@/stores/comic'
import ReaderNavBar from '@/components/ReaderNavBar.vue'
import ReaderLayout from '@/Layouts/ReaderLayout.vue'
</script>
