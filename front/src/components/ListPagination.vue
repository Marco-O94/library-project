<script setup lang="ts">
import { defineProps } from 'vue';
import { BookStore } from '../stores/BookStore';

const bookStore = BookStore();

const props = defineProps({
    currentPage: {
        type: Number,
        required: true,
    },
    lastPage: {
        type: Number,
        required: true,
    },
    nextPage: {
        type: String,
    },
    prevPage: {
        type: String,
    
    }
});
</script>

<template>

    <div class="flex justify-center">
        <nav aria-label="Page navigation">
            <ul class="flex list-style-none">
                <!-- Previous -->
                <li v-if="prevPage" @click="bookStore.list(currentPage - 1)" class="page-item cursor-pointer"><span
                        class="page-linkrelative block py-1.5 px-3 rounded border-0 bg-transparent outline-none transition-all duration-300  text-gray-900 pointer-events-none focus:shadow-none"
                        tabindex="-1">Precedente</span></li>
                <li v-else class="page-item disabled"><span
                        class="page-link relative block py-1.5 px-3 rounded border-0 bg-transparent outline-none transition-all duration-300  text-gray-500 pointer-events-none focus:shadow-none"
                        tabindex="-1" aria-disabled="true">Precedente</span></li>
                <!-- Pages -->
                <template v-for="index in props.lastPage" :key="index">
                    <li @click="bookStore.list(index)" v-if="props.currentPage === index" class="page-item active"><span
                        class="page-link cursor-default relative block py-1.5 px-3 rounded border-0 bg-blue-600 outline-none transition-all duration-300  text-white hover:text-white hover:bg-blue-600 shadow-md focus:shadow-md"
                        >{{index}} <span class="visually-hidden">(current)</span></span></li>
                <li @click="bookStore.list(index)" v-else class="page-item"><span
                        class="page-link cursor-pointer relative block py-1.5 px-3 rounded border-0 bg-transparent outline-none transition-all duration-300  text-gray-800 hover:text-gray-800 hover:bg-gray-200 focus:shadow-none"
                        >{{index}}</span></li>
                
                    </template>
                <!-- Next -->
                <li v-if="nextPage" @click="bookStore.list(currentPage + 1)" class="page-item cursor-pointer"><span
                    class="page-link relative block py-1.5 px-3 rounded border-0 bg-transparent outline-none transition-all duration-300  text-gray-900 pointer-events-none focus:shadow-none"
                    tabindex="-1" >Successivo</span></li>
            <li v-else class="page-item disabled"><span
                    class="page-link relative block py-1.5 px-3 rounded border-0 bg-transparent outline-none transition-all duration-300  text-gray-500 pointer-events-none focus:shadow-none"
                    tabindex="-1" aria-disabled="true">Successivo</span></li>
            </ul>
        </nav>
    </div>

</template>
