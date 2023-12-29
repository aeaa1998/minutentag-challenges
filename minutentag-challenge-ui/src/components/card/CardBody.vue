<script setup>
const props = defineProps({
  flat: {
    type: Boolean,
    default: false
  }
})
</script>
<template>
  <div :class="{
    'px-4 py-5 sm:p-6': !flat,
    'px-2 py-3 sm:p-4': flat,
  }">
    <!-- Content goes here -->
    <slot />
  </div>
</template>