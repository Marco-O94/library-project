<script setup lang="ts">
import { UserStore } from '../../stores/UserStore';
import LibDash from './LibrarianDash.vue';
import UserDash from './UserDash.vue';

const userStore = UserStore();
</script>

<template>
        <div>
                <LibDash v-if="userStore.user.role_id === 1" />
                <UserDash v-else />
        </div>
</template>