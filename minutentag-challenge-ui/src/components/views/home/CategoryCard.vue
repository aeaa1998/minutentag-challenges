<script setup>
const props = defineProps({
  category: {
    type: Object
  },
  selected: {
    type: Boolean,
    default: false
  }
})

const emit = defineEmits(["click"])
</script>
<template>
  <card class="px-5 py-3 cursor-pointer " :class="{
    'bg-secondary text-white': selected,
    'hover:bg-secondary-200 hover:text-white bg-white': !selected
  }" @click="emit('click', category)">
    <div class="flex flex-row items-center justify-center">
      <!-- Only render icon if it's present -->
      <img v-if="category.icon" :src="category.icon" class="w-[20px] h-[20px] mr-4" />
      {{ category.name }}
    </div>
  </card>
</template>