<script setup>
import { MagnifyingGlassIcon } from '@heroicons/vue/20/solid'

const props = defineProps({
  modelValue: {
    type: String,
  },
  placeholder: {
    type: String,
    default: "Search"
  }
})
const emit = defineEmits(["update:modelValue"])
// defineOptions({
//   inheritAttrs: false
// })
</script>
<template>
  <div class="w-full max-w-lg lg:max-w-xs">
    <label for="search" class="sr-only">Search</label>
    <div class="relative">
      <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
        <MagnifyingGlassIcon class="h-5 w-5 text-primary-400" aria-hidden="true" />
      </div>
      <input :value="modelValue" @change="value => emit('update:modelValue', value)" id="search" name="search"
        class="block w-full rounded-lg border-0 bg-white py-1.5 pl-10 pr-3 text-primary-900  placeholder:text-primary-300 focus:ring-2 focus:ring-inset focus:ring-primary-600 text-sm sm:leading-6"
        :placeholder="placeholder" type="search" />
    </div>
  </div>
</template>