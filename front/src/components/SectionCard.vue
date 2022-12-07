<script setup lang="ts">
import { defineProps } from 'vue';

const props = defineProps<{
    title: string;
    link: string;
    icon: string;
}>();

</script>

<template>
        <div class="rounded-lg shadow-lg bg-white max-w-sm text-center">
          <router-link :to="props.link">
            <img class=" my-auto w-1/2 h-auto" :src="props.icon" alt=""/>
          <div class="p-6">
            <h5 class="text-gray-900 text-xl font-medium mb-2">{{props.title}}</h5>
          </div>
        </router-link>
        </div>
</template>