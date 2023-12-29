<script setup>
import { ShoppingBagIcon } from '@heroicons/vue/24/outline'
</script>
<template>
  <div class="flex flex-row flex-nowrap justify-around py-4 space-x-6 lg:justify-start">
    <!-- The button to go to the shopping card -->
    <button class="p-3 rounded-lg text-secondary border border-secondary">
      <ShoppingBagIcon class="h-7 w-7 " />
    </button>

    <!-- The button to add an item into the bag -->
    <button class="p-3 rounded-lg text-white bg-secondary grow lg:grow-0 lg:px-24">
      Add to cart
    </button>
  </div>
</template>