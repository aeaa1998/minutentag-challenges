<script setup>
const props = defineProps({
  shadow: {
    type: Boolean,
    default: false
  },
  pill: {
    type: Boolean,
    default: false
  }
})

const emit = defineEmits(["click"])
</script>
<template>
  <div class=" divide-gray-200 rounded-lg " :class="{ shadow: shadow, '!rounded-full': pill }" @click="emit('click')">
    <slot name="header" />
    <slot />
    <slot name="footer" />

  </div>
</template>