<script setup>
import ProductSizeCard from "./ProductSizeCard.vue"
import { ref } from "vue"
const props = defineProps(["skus", "selectedSku"])
//Define the emit to bind the value of the selected sku
const emit = defineEmits(["update:selectedSku"])

</script>
<template>
  <div class="flex flex-col space-y-1">
    <v-heading class="text-primary-800 font-normal">Size</v-heading>
    <div class="flex flex-row flex-wrap gap-x-4 gap-y-2">
      <!-- Each one of the sizes options and emits the change to set the selected sku -->
      <product-size-card v-for="sku in skus" :key="sku.code" @click="emit('update:selectedSku', sku)" :sku="sku"
        :selected="selectedSku.code == sku.code" />

    </div>
  </div>
</template>