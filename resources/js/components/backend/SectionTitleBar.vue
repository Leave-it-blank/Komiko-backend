<script setup>
import { mdiGithub } from '@mdi/js'
import BaseLevel from '@/components/backend/BaseLevel.vue'
import BaseButton from '@/components/backend/BaseButton.vue'


const props = defineProps({
  titleStack: {
    type: Array,
    default: () => []
  },
  routeName: {
  type: String,
    default: 'dashboard'
  },
  routeId: {
     type: Number,
    default: null
  }
})
console.log(props.routeId, props.routeName)
</script>

<template>
  <section class="p-6">
    <BaseLevel>
      <ul>
        <li
          v-for="(title, index) in props.titleStack"
          :key="index"
          class="stack-item inline-block pr-3 text-2xl text-gray-500 dark:text-gray-400 last:pr-0 last:font-black last:text-black"
        >
          {{ title }}
        </li>
      </ul>
      <BaseButton
        :routeName="props.routeName"
        :routeTo = "props.routeId"
        color="info"
        label="Go Back"
        target="_blank"
        :icon="mdiGithub"
      />
    </BaseLevel>
  </section>
</template>
