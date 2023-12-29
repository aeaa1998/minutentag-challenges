<script setup>
import { useRouter } from "vue-router"
import { computed } from "vue"
import { usePriceCurrencyFormat } from "@/compositions/numbers/useNumberFormatting.js"
const props = defineProps({
  item: {
    type: Object
  },
  stockAndPrices: {
    type: Object
  },
  isLoadingStockAndPrices: {
    type: Boolean,
    default: true
  }
})

const emit = defineEmits(["add"])

const router = useRouter()

const price = computed(() => {
  let price = 0
  if (props.item.skus.length) {
    const sku = props.item.skus.find(sku => sku.code in props.stockAndPrices)
    if (sku) {
      price = props.stockAndPrices[sku.code].price
    }
  }
  return usePriceCurrencyFormat(price)
})
</script>
<template>
  <card @click="router.push(`/${item.id}-${item.brand}`)" class="bg-white cursor-pointer">
    <div class="flex flex-col items-center p-3 space-y-2">
      <!-- The name of product -->
      <div class="text-primary-900 w-full text-start">{{ item.brand }}</div>
      <img :src="item.image" class="h-[140px] w-auto" />
    </div>
    <div>
      <div class="w-full flex justify-between items-end">
        <div class="pl-4 pb-2 text-primary-800 tex-lg">{{ price }}</div>
        <button class="rounded-tl-lg rounded-br-lg bg-secondary h-12 w-12 text-lg text-white font-bold">+</button>
      </div>
    </div>
  </card>
</template>