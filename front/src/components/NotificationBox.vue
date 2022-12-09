<script setup lang="ts">
import { GeneralStore } from "@/stores/GeneralStore";
const generalStore = GeneralStore();
</script>
<template>
    <div v-if="generalStore.flash.message"
            class="bg-gray-600 w-full h-full fixed z-50 bg-opacity-50 flex justify-center items-center top-0 right-0 bottom-0 left-0 outline-none overflow-hidden">
            <div class="bg-white px-16 py-14 rounded-md text-center">
                <div>
                    <div class="text-xl mb-4 font-bold text-slate-500">{{generalStore.flash.message}}</div>
                </div>
                <button @click="generalStore.flash.message = ''"
                    class="bg-blue-600 px-7 py-2 ml-2 rounded-md text-md text-white font-semibold">Ok</button>
            </div>
        </div>
</template>