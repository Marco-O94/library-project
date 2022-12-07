<script setup lang="ts">
import { UserStore } from '../stores/UserStore';

const userStore = UserStore();
</script>

<template>
    <section class="container mx-auto" id="dashboard">
        <div>
            <h1 class=" text-2xl text-left font-bold">Dashboard</h1>
        </div>
        <div class="rounded-lg shadow-lg mt-5 text-left p-10">
            <h2 class="font-semibold text-lg">Lista dei libri presi in prestito</h2>
        </div>
    </section>
</template>