<script setup lang="ts">

</script>
<template>
    <div>
        <div>
            <h1 class=" text-2xl text-left font-bold">Dashboard</h1>
            <div @click="$router.go(-1)" class="cursor-pointer flex items-center gap-3 text-blue-600 coursor-pointer hover:text-blue-700 transition duration-300 ease-in-out mt-3"><svg class="fill-blue-600 hover:fill-blue-700 w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                <path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z"/></svg><span>Torna Indietro</span></div>        
        </div>
        <div class="rounded-lg shadow-lg mt-5 text-left px-8 py-10 mb-28">
            <router-view></router-view>
        </div>
    </div>
</template>