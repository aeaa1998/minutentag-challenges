<script setup>
import { ArrowLeftIcon } from "@heroicons/vue/24/outline"
import { ListBulletIcon } from "@heroicons/vue/24/solid"
import { useRouter } from "vue-router"
import { setNavigationStackLayoutState } from "@/compositions/layouts/useNavigationStackLayout.js"

const router = useRouter()
const state = setNavigationStackLayoutState()
</script>
<template>
  <div class="flex flex-col min-h-screen">
    <!-- Navigation bar styled as a nav of an mobile application -->
    <div class="w-full flex flex-row items-center justify-between px-4 sm:px-6 lg:px-8 h-16">
      <button class="p-2 bg-white rounded-lg" @click="router.back()">
        <ArrowLeftIcon class="h-5 w-5" />
      </button>
      <v-heading class="text-primary-800 font-bold">
        {{ state.title }}
      </v-heading>
      <button class="p-2 bg-white rounded-lg">
        <ListBulletIcon class="h-5 w-5" />
      </button>
    </div>
    <router-view />
  </div>
</template>