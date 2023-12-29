<script setup>
import { usePriceCurrencyFormat } from "@/compositions/numbers/useNumberFormatting.js"
//Set the stock and price as a prop for the component
defineProps({
  stockAndPrice: {
    type: Object
  }
})
</script>
<template>
  <!-- Show only if there is stock -->
  <v-title v-if="stockAndPrice.stock > 0" size="3" class="text-secondary font-semibold">{{
    usePriceCurrencyFormat(stockAndPrice.price) }}</v-title>
  <v-title v-else size="3" class="text-primary-500 font-semibold">Out of stock</v-title>
</template>