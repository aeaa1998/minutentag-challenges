<script setup>
defineProps({
  size: {
    default: "2",
    validation: (value) => {
      return ["1", "2", "3", "4"].includes(value)
    }
  }
})
</script>
<template>
  <h5 :class="{
    'text-4xl lg:text-5xl': size == '1',
    'text-3xl lg:text-4xl': size == '2',
    'text-2xl lg:text-3xl': size == '3',
    'text-xl lg:text-2xl': size == '4',
  }">
    <slot />
  </h5>
</template>