

<template>
    <div class="flex flex-col items-center justify-center">
        <img src="../assets/images/not_found.png" alt="not found" class="w-1/2">
        <h2 class="text-2xl pt-5 font-bold">Pagina non trovata</h2>
        <p class="text-gray-500"><router-link :to="{name: 'home'}" class="text-primary animate-bounce font-semibold">Clicca qui</router-link> per tornare alla home</p>
    </div>
</template>