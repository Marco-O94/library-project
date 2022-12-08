<script setup lang="ts">
import SectionCard from '@/components/SectionCard.vue';
</script>

<template>
    <div class="w-full grid gap-8 grid-cols-1 md:grid-cols-2">
        <div class="w-full h-full">
            <SectionCard link="/panel/profile" title="Miei Libri" :icon="0" />
        </div>
        <div class="w-full h-full">
            <SectionCard link="#" title="Profilo" :icon="1" />
        </div>
    </div>
</template>