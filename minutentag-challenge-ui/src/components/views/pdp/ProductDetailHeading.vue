<script setup>
import ProductDetailPrice from "./ProductDetailPrice.vue"
import { usePriceCurrencyFormat } from "@/compositions/numbers/useNumberFormatting.js"
const props = defineProps(["product", "stockAndPrice"])
</script>
<template>
  <div class="flex flex-row space-x-4 justify-between">
    <div class="space-y-1">
      <!-- The name of the product -->
      <v-title size="3" class="font-semibold text-primary-800">{{ product.brand }}</v-title>
      <!-- Shows the origin and stock -->
      <p class="text-sm text-primary-400">Origin: {{ product.origin }} Stock: {{ stockAndPrice.stock }}</p>
    </div>
    <product-detail-price :stockAndPrice="stockAndPrice" />
  </div>
</template>