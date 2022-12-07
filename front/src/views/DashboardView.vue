<script setup lang="ts">
import { UserStore } from '../stores/UserStore';
import LibDash from './subviews/LibrarianDash.vue';
import UserDash from './subviews/UserDash.vue';

const userStore = UserStore();
</script>

<template>
    <div>
        <div>
            <h1 class=" text-2xl text-left font-bold">Dashboard</h1>
        </div>
        <div class="rounded-lg shadow-lg mt-5 text-left p-10">
            <LibDash v-if="userStore.user.role === 'librarian'" />
        </div>
    </div>
</template>