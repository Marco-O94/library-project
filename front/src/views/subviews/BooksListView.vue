<script setup lang="ts">
import { ref, watch } from 'vue';
import SearchBar from '../../components/SearchBar.vue';
import { BookStore } from '../../stores/BookStore';
import ListPagination from '../../components/ListPagination.vue';
const bookStore = BookStore();

const data = ref({
    search: '' as string,
});

// I have no time for Throttle or Debounce but here goes the idea 😄
watch(() => data.value.search, ((search) => {
    bookStore.search(search);
}));
</script>

<template>
    <section class="py-12 bg-white sm:py-16 lg:py-20">
        <div class="px-4 mx-auto sm:px-6 lg:px-8 max-w-7xl">
            <div class="mx-auto text-center">
                <h2 class="text-2xl font-bold text-gray-900 sm:text-3xl">I nostri libri</h2>
                <p class="mt-2 mb-3 text-xl text-gray-600 sm:mt-4">
                    Qui puoi trovare i libri che abbiamo in catalogo.</p>
                <SearchBar placeholder="Cerca qui il tuo libro..." v-model:search="data.search" />
            </div>
            
            <div v-if="!bookStore.books.data" class="mt-10 font-bold text-xl">Inizia a cercare!</div>
            <template v-else>
            <div class="grid grid-cols-1 gap-6 mt-10 lg:mt-16 lg:gap-4 md:grid-cols-2 lg:grid-cols-3">
                <div class="relative group" v-for="book, index in bookStore.books.data" :key="index">
                    <div class="overflow-hidden aspect-w-1 aspect-h-1">
                        <img class="object-cover w-full h-full transition-all duration-300 group-hover:scale-125"
                            :src="book.image" />
                            <div class="absolute left-3 top-3 flex flex-nowrap gap-2">
                                <p v-for="cat, index in book.categories" :key="index" :class="'bg-' + cat.color + '-200 bg-' + cat.color + '-300'" class="sm:px-3 sm:py-1.5 px-1.5 py-1 text-[8px] sm:text-xs text-white font-bold tracking-wide uppercase rounded-full">{{cat.name}}</p>
                            </div>
                    </div>
                    <div class="flex items-start justify-between mt-4 space-x-4">
                        <div>
                            <h3 class="text-xs font-bold text-gray-900 sm:text-sm md:text-base">
                                <router-link :to="`/books/show/${book.id}`">
                                    {{ book.title }}
                                    <span class="absolute inset-0" aria-hidden="true"></span>
                                </router-link>
                            </h3>
                        </div>
                    </div>
                </div> 
            </div>
            <ListPagination :currentPage="bookStore.books.current_page" :lastPage="bookStore.books.last_page" :nextPage="bookStore.books.next_page_url" :prevPage="bookStore.books.prev_page_url" />
        </template>
        </div>
    </section>
</template>