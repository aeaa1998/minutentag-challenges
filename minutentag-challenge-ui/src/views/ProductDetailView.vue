<script setup>
import { useNavigationStackLayout } from "@/compositions/layouts/useNavigationStackLayout.js"
import { computed, onBeforeMount, onBeforeUnmount, onMounted, ref, watch } from "vue";
import { useRoute } from "vue-router";
import { useProductStore } from '@/stores/product';
import { ProductDetailHeading, ProductDescription, ProductSize, ProductActions } from "@/components/views/pdp"
import { storeToRefs } from "pinia";
import { NotFound } from "@/components/views/errors"
let intervalId = null
const route = useRoute()
const navState = useNavigationStackLayout()
const productStore = useProductStore()


//Retrieve the function to pull info of the sku
const { fetchSkuStockAndPrice } = productStore
const { productsMappedByIdAndBrand, stockAndPrices } = storeToRefs(productStore)

//Retrieve the desired product
const product = computed(() => productsMappedByIdAndBrand.value[route.params.productId][route.params.productBrand])

//The state
//The sku to select
const selectedSku = ref(product.value.skus.length ? product.value.skus[0] : null)

//Stock and price information for the selecteed product
const stockAndPrice = computed(() => {
  //There is a selected sku and it is on the json of prices and stock info
  if (selectedSku.value && selectedSku.value.code in stockAndPrices.value) {
    return stockAndPrices.value[selectedSku.value.code]
  }
  return { stock: 0, price: 0 }
})

//Set the interval and repeat the function to retrieve the sku info every 5 seconds
onBeforeMount(() => intervalId = setInterval(() => fetchSkuStockAndPrice(selectedSku.value?.code), 5000))

//On the mounting we will set the title of the nav
onMounted(() => {
  navState.title = "Detail"
})

//Before the unmount happens we will clear this interval
onBeforeUnmount(() => clearInterval(intervalId))

//We will add this watcher to ensure on init make a fetch and on each change make a fetch to avoid waiting for 5 seconds for it
watch(selectedSku, (newSku) => fetchSkuStockAndPrice(newSku?.code), { immediate: true })
</script>
<template>
  <template v-if="product">
    <img :src="product.image" class="w-[240px] h-[240px] mx-auto my-6 object-contain" />
    <div class="flex flex-col space-y-4 bg-white rounded-t-lg px-4 sm:px-6 lg:px-8 pt-8 grow">
      <product-detail-heading :product="product" :stockAndPrice="stockAndPrice" />
      <product-description :product="product" />
      <product-size :skus="product.skus ?? []" v-model:selectedSku="selectedSku" />
      <product-actions />
    </div>
  </template>
  <!-- if the product was not found -->
  <not-found v-else>
  </not-found>
</template>