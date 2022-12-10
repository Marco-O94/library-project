<script setup lang="ts">
import MainLayout from './views/Layout/MainLayout.vue';

</script>

<template>
  <MainLayout>
    <router-view />
  </MainLayout>
</template>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}

nav {
  padding: 30px;
}

nav a {
  font-weight: bold;
  color: #2c3e50;
}

nav a.router-link-exact-active {
  color: #1E90FF;
}

.logo-text {
  fill: white;
}

.logo-book {
  fill: #0B87F0;
}

.logo {
  width: 150px;
  height: auto;
}
</style>
