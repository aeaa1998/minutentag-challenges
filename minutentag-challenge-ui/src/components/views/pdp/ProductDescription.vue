<script setup>
import { ref, computed } from "vue"
const props = defineProps(["product"])
//Tells if it is collapsed or not
const descriptionCollapsed = ref(true)

//This value tells if the text can be truncated
const canTruncate = computed(() => props.product.information.length > 250)
//We will have the description text based on if it is collapsed
const description = computed(() => descriptionCollapsed.value ? props.product.information.substring(0, 250) : props.product.information)
</script>
<template>
  <div class="flex flex-col space-y-1 lg:max-w-5xl">
    <v-heading class="text-primary-800 font-normal">Description</v-heading>

    <!-- Show the description truncated -->
    <div class="text-sm text-primary-400">
      {{ description }} {{ canTruncate && descriptionCollapsed ? '...' : '' }}
    </div>

    <button v-if="canTruncate" @click="descriptionCollapsed = !descriptionCollapsed"
      class="font-bold text-secondary self-start">{{
        descriptionCollapsed ? 'Read more' : 'Read less' }}</button>
  </div>
</template>