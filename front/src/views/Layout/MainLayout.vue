<script setup lang="ts">
import NavBar from '@/components/NavBar.vue';
import FooterSection from '@/components/FooterSection.vue';
import BreadCrumbs from '@/components/BreadCrumbs.vue'


</script>

<template>
  <!-- Navbar -->
  <NavBar />
  <!-- Content -->
 <section name="content" class="min-h-screen md:container mx-auto">
  <BreadCrumbs class="pt-10" />
  <div class="pt-20">
  <slot ></slot>
</div>
</section>
  <!-- Footer -->
  <FooterSection />
</template>