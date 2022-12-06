<script setup lang="ts">
import { UserStore } from '../stores/UserStore';

const userStore = UserStore();
</script>

<template>
    <div>
        Sei loggato!! {{ userStore.user.name}}
    </div>
</template>