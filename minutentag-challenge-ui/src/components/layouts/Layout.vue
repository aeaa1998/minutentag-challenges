<template>
  <!-- We have a base layout where we will add the nav bar and the router view this is useful when other views that dont require the nav-bar appear -->
  <!-- So for those views we will not set this as the layout -->
  <div class="w-full">
    <IconNavigationBar class="hidden lg:flex lg:fixed top-0 left-0" />
    <div class="w-full lg:pl-32">
      <nav-bar />
      <div class="container mx-auto pt-2 pb-32 px-4 sm:px-6 lg:px-8 lg:pt-4">
        <router-view />
      </div>
    </div>
  </div>
  <IconNavigationBar class="fixed bottom-0 lg:hidden" />
</template>
