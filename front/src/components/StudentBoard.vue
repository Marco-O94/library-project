<script setup lang="ts">
import { UserStore } from '../stores/UserStore';

const userStore = UserStore();
</script>

<template>
    <div>
        <h1 class="font-bold">Bentornato {{ userStore.user.name }}!</h1>
        
        
    </div>
</template>