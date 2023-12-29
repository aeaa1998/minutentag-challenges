<script setup>
import { HomeIcon as HomeFilledIcon, ShoppingBagIcon as ShoppingBagFilledIcon, CogIcon as CogFilledIcon, ClipboardDocumentListIcon as ClipboardFilledIcon } from '@heroicons/vue/24/solid'
import { HomeIcon, ShoppingBagIcon, CogIcon, ClipboardDocumentListIcon } from '@heroicons/vue/24/outline'
import { computed, ref } from 'vue';

const navItems = [
  {
    selectedIcon: HomeFilledIcon,
    unselectedIcon: HomeIcon,
    selected: ref(true),
    path: "/"
  },
  {
    selectedIcon: ClipboardFilledIcon,
    unselectedIcon: ClipboardDocumentListIcon,
    selected: ref(false),
    path: "/something"
  },
  {
    selectedIcon: ShoppingBagFilledIcon,
    unselectedIcon: ShoppingBagIcon,
    selected: ref(false),
    path: "/bag"
  },
  {
    selectedIcon: CogFilledIcon,
    unselectedIcon: CogIcon,
    selected: ref(false),
    path: "/settings"
  },
]

const setSelected = (navItem) => {
  navItems.forEach(item => {
    item.selected.value = item.path == navItem.path
  });
}
</script>
<template>
  <div
    class="w-full cursor-pointer bg-white py-2 px-4 sm:px-6 lg:px-8 h-24 shadow-lg flex flex-row flex-1 justify-evenly items-center lg:flex-col lg:max-w-32 lg:justify-start lg:h-screen lg:space-y-6 lg:pt-8">
    <div v-for="item in navItems" :key="item.path" @click="setSelected(item)"
      class="h-14 w-14 rounded-full relative group">

      <div class="blur-sm w-full h-full absolute rounded-full" :class="{
        ' group-hover:bg-secondary-200/50': !item.selected.value,
        ' bg-secondary-200/50': item.selected.value,
      }"></div>
      <component class="absolute h-12 w-12 p-2 left-0 right-0 top-0 bottom-0 m-auto" :class="{
        'text-primary-300  group-hover:text-secondary-400': !item.selected.value,
        'text-secondary': item.selected.value,
      }" :is="item.selected.value ? item.selectedIcon : item.unselectedIcon" />

    </div>

  </div>
</template>