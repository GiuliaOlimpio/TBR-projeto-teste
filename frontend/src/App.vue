<template>
  <div id="app">
    <Navbar />
    <router-view />
    <Footer />
  </div>
</template>

<script setup>
  import Navbar from './views/Navbar.vue';
  import Footer from './views/Footer.vue';
</script>
