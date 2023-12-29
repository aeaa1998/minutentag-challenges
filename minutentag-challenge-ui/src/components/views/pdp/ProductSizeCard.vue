<script setup>
defineProps(["selected", "sku"])
const emit = defineEmits(["click"])
</script>
<template>
  <!-- UI for each card -->
  <card pill @click="emit('click', sku)" class="px-3 py-2 border text-sm" :class="{
    'border-secondary text-secondary': selected,
    'border-primary-400 text-primary-400 hover:border-secondary-300 hover:text-secondary-300': !selected,
  }">
    {{ sku.name }}
  </card>
</template>