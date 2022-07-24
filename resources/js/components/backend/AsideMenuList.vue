<script setup>
import AsideMenuItem from '@/components/backend/AsideMenuItem.vue'

defineProps({
  isSubmenuList: {
    type: Boolean,
    default: false
  },
  menu: {
    type: Array,
    default: () => []
  }
})

const emit = defineEmits(['menu-click'])

const menuClick = (event, item) => {
  emit('menu-click', event, item)
 // console.log(item)
}
</script>

<template>
  <ul >
    <AsideMenuItem
      v-for="(item, index) in menu"

      :key="index"
      :item="item"
      :is-submenu-list="isSubmenuList"
      @menu-click="menuClick"
    />
  </ul>
</template>
