<script setup>
import WelcomeItem from '@/components/WelcomeItem.vue'
import { SearchBar } from '@/components/inputs'
import { CategoryCard, PopularCard } from "@/components/views/home"
import { computed, markRaw, onMounted, reactive, ref } from 'vue';
import { useProductStore } from '@/stores/product';
import { storeToRefs } from 'pinia';
const categories = markRaw([
  {
    name: "All",
  },
  {
    name: "Beer",
    icon: "./icons/Beer.png"
  },
  {
    name: "Wine",
    icon: "./icons/Wine-glass.png"
  },
])

//Products related information
const productStore = useProductStore()
const { popularProducts, stockAndPrices } = storeToRefs(productStore)

//Destruct the actions from store
const { fetchAllStockAndPrices } = productStore

//The selected category
const selectedCategory = ref(categories[0])

onMounted(() => {
  fetchAllStockAndPrices()
})
</script>

<template>
  <main class="space-y-6">
    <!-- Welcome section -->
    <div class="space-y-2 ">
      <WelcomeItem />
      <search-bar class="lg:max-w-full" placeholder="Search for a burger, pizza, drink or etc..." />
    </div>
    <!-- The drink category filter -->
    <div class="space-y-4">
      <div class="flex justify-between items-end">
        <v-heading class="text-primary-800 font-semibold">Drink Category</v-heading>
        <a class="text-primary-300 text-sm cursor-pointer">See All</a>
      </div>
      <!-- Iterate on each one of the categories of the home view -->
      <div class="flex flex-row flex-shrink-0 space-x-3 overflow-x-auto">
        <CategoryCard v-for="category in categories" :key="category.name" :category="category"
          @click="selectedCategory = category" :selected="category.name == selectedCategory.name" />
      </div>
    </div>

    <!-- Popular items -->
    <div class="space-y-4">
      <div class="flex justify-between items-end">
        <v-heading class="text-primary-800 font-semibold">Popular</v-heading>
        <a class="text-primary-300 text-sm cursor-pointer">See All</a>
      </div>
      <div class="grid grid-cols-2 gap-3 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5">
        <!-- Show each one of the popular products -->
        <PopularCard v-for="product in popularProducts" :key="`${product.id}-${product.brand}`" :item="product"
          :stockAndPrices="stockAndPrices" />
      </div>
    </div>
  </main>
</template>
