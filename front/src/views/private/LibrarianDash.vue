<script setup lang="ts">
import SectionCard from '@/components/SectionCard.vue';
</script>
<template>
    <div class="w-full grid gap-8 grid-cols-1 md:grid-cols-3">
        <div class="w-full h-full">
            <SectionCard title="Libri" link="managebooks" :icon="0" />
        </div>
        <div class="w-full h-full">
            <SectionCard title="Profilo" link="profile" :icon="1" />
        </div>
        <div class="w-full h-full">
            <SectionCard title="Utenti" link="home" :icon="2" />
        </div>
        </div>
</template>