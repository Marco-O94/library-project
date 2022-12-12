<script setup lang="ts">
import SectionCard from '@/components/SectionCard.vue';
import { UserStore } from '@/stores/UserStore';

const userStore = UserStore();
</script>

<template>
    <h2 class="font-bold text-xl">Bentornato {{ userStore.user.name }}</h2>
    <p class="text-md mb-10">Ruolo: <span class="font-bold">{{ userStore.user.role.name }}</span></p>
    <div class="w-full grid gap-8 grid-cols-1 md:grid-cols-3">

        <div class="w-full h-full">
            <SectionCard link="books" title="Catalogo" :icon="0" />
        </div>
        <div class="w-full h-full">
            <SectionCard link="profile" title="Profilo" :icon="1" />
        </div>
        <div class="w-full h-full">
            <SectionCard link="home" title="Libri in prestito" :icon="3" />
        </div>
    </div>
</template>