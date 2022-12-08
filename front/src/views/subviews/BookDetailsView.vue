<script setup lang="ts">

</script>

<template>
    <div>
    <a @click="$router.go(-1)">back</a>
   <router-view></router-view>
</div>
</template>