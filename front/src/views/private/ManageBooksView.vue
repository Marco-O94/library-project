<script setup lang="ts">
import { BookStore } from "@/stores/BookStore";
import { ref, watch } from 'vue';
import { debounce } from '@/stores/myFunctions';
import { librarianSearch } from "@/interfaces/BookData";
import SearchBar from "@/components/SearchBar.vue";
import ListPagination from '@/components/ListPagination.vue';
import { useRouter } from 'vue-router';

const bookStore = BookStore();
bookStore.getCategories();
const router = useRouter();

const data = ref({
    search: '',
    category: '',
});
bookStore.librarianSearch(data.value);
const debouncedFunction = debounce(function (value: librarianSearch) { bookStore.librarianSearch(value); }, 500);
watch(() => [data.value.search, data.value.category], (() => {
    debouncedFunction(data.value);
}));

const toBook = (book: number) => {
    router.push({ name: 'editbook', params: { id: book } })
};

</script>

<template>
    <!-- It should go in a child component, I'm speeding up a little bit, pls forgive me... -->
    
    <h1 class="text-3xl md:text-4xl  font-bold text-gray-900 mb-8">Amministrazione Libri</h1>
    <router-link :to="{name: 'addBook'}" data-mdb-ripple="true" data-mdb-ripple-color="light" class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">Aggiungi un nuovo libro</router-link>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-10 my-10">
        <div>
            <SearchBar placeholder="Cerca tra i libri caricati..." v-model:search="data.search" />
        </div>
        <div>
           <select id="categories" name="categories" v-model="data.category"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full  p-4  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="" selected>-- Scegli una categoria -- </option>
                <option v-for="category in bookStore.categories" :key="category.id" :value="category.name">
                    {{ category.name }}
                </option>
            </select>
        </div>

    </div>
    <div class="relative overflow-x-auto shadow-md rounded-lg mt-5 mb-16">

        <table class="w-full text-sm text-left text-gray-500 lg:table-auto">
            <thead class="text-xs text-gray-900 uppercase bg-neutral-50">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        #
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Titolo
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Genere
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Autore
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Quantità disponibile
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Modifica
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Elimina
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="book, index in bookStore.books.data" :key="index"
                    class="border-b text-gray-900 bg-neutral-50  odd:bg-white even:bg-gray-50 ">
                    <td scope="row" class="pl-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                        {{ index + 1 }}
                    </td>
                    <td scope="row" class="pl-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                        {{ book.title }}
                    </td>
                    <td scope="row"
                        class="pl-6 py-4 flex flex-nowrap align-middle gap-3 font-medium text-gray-900 whitespace-nowrap">
                        <span :class="'hover:bg-' + cat.color + '-400 bg-' + cat.color + '-500'"
                            class="px-4 py-2 text-white rounded-full font-semibold text-sm flex align-center w-max cursor-pointer transition duration-300 ease"
                            v-for="cat, index in book.categories" :key="index">{{ cat.name }}</span>
                    </td>
                    <td scope="row" class="pl-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                        {{ book.author }}
                    </td>
                    <td scope="row" class="pl-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                        {{ book.quantity - book.users_count }}
                    </td>
                    <td scope="row" class="pl-6 py-4 font-medium whitespace-nowrap">
                        <button @click="toBook(book.id)" class="font-medium">
                            <svg class="w-5 h-5 fill-blue-600 hover:fill-blue-500" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 512 512">
                                <path
                                    d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.8 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z" />
                            </svg>
                        </button>
                    </td>
                    <td scope="row" class="pl-6 py-4 font-medium whitespace-nowrap">
                        <button @click="bookStore.delete(book.id)" class="font-medium ">
                            <svg class="fill-red-600 hover:fill-red-500 w-5 h-5" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 448 512">
                                <path
                                    d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z" />
                            </svg>
                        </button>
                    </td>
                </tr>


            </tbody>
        </table>
        <ListPagination scope="librarianBooks" :currentPage="bookStore.books.current_page"
            :lastPage="bookStore.books.last_page" :nextPage="bookStore.books.next_page_url"
            :prevPage="bookStore.books.prev_page_url" />
    </div>
</template>