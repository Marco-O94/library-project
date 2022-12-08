<script setup lang="ts">
import SectionCard from '@/components/SectionCard.vue';
</script>
<template>
    <div class="w-full grid grid-cols-1 md:grid-cols-3">
        <div class="w-full h-full">
            <SectionCard title="Libri" link="#" :icon="0" />
        </div>
        <div class="w-full h-full">
            <SectionCard title="Profilo" link="#" :icon="1" />
        </div>
        <div class="w-full h-full">
            <SectionCard title="Utenti" link="#" :icon="2" />
        </div>
        </div>
</template>