<script setup>
import { useRouter } from "vue-router"
const router = useRouter()
</script>
<template>
  <div class="w-screen bg-primary flex flex-col justify-center content-center flex-wrap items-center space-y-4">
    <p class="font-sans text-primary-700 error-text text-center">404</p>
    <p class="text-primary-600 mx-auto w-full px-8 text-center">The view that you where looking for does not seem to exist
      in our records we are sorry for the trouble.</p>
    <button @click="router.push({ name: 'Home' })" class="bg-secondary text-white rounded-lg py-2 px-24 w-fit">Go back
      home</button>
  </div>
</template>
<style>
.error-text {
  font-size: 130px;
}

@media (min-width: 768px) {
  .error-text {
    font-size: 220px;
  }
}
</style>