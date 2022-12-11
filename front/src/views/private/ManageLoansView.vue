<script setup lang="ts">
/* This imports has to be refactored in one export file */
import { LoanStore } from '@/stores/LoanStore';
import { UserStore } from '@/stores/UserStore';
import { BookStore } from '@/stores/BookStore';
import { useRoute } from 'vue-router';
import { ref, watch } from 'vue';
import { loansSearch } from '@/interfaces/BookData';
import ListPagination from '@/components/ListPagination.vue';
import SearchBar from '@/components/SearchBar.vue';
import DatePicker from '@/components/DatePicker.vue';
import { debounce } from '@/stores/myFunctions';
const loanStore = LoanStore();
const userStore = UserStore();
const bookStore = BookStore();

const data = ref<loansSearch>({
    search_user: '',
    search_book: '',
    search_due_date: '',
    sort: '',
    
});

loanStore.getLoans(data.value); // Get all loans
const debouncedFunction = debounce((value: loansSearch) => { loanStore.getLoans(value); }, 500); // Wait 500ms before calling the function
watch(() => [data.value.search_user, data.value.search_book, data.value.search_due_date, data.value.sort], (() => {
    debouncedFunction(data.value);
}));

</script>

<template>
    <h2 class="font-bold text-2xl my-8">Prestiti in corso</h2>
    <p> Qui puoi visualizzare i prestiti attualmente attivi, clicca sul libro o sull'utente per avere più informazioni</p>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-10 my-10">
        <div>
            <SearchBar placeholder="Cerca un utente" v-model:search="data.search_user" />
        </div>
        <div>
            <SearchBar placeholder="Cerca un libro" v-model:search="data.search_book" />
        </div>
        <div>
            <DatePicker text="Seleziona una scadenza" v-model:date="data.search_due_date" />
        </div>
    </div>
    <div class="relative overflow-x-auto shadow-md rounded-lg mt-5 mb-16">
        
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-900 uppercase bg-neutral-50">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        #
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Libro
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Utente
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Data del prestito
                    </th>
                    <th scope="col" class="px-6 py-3 text-left">
                        Scadenza
                    </th>
                    <th scope="col" class="px-6 py-3 text-left">
                        Modifica
                    </th>
                    <th scope="col" class="px-6 py-3 text-left">
                        Riconsegna
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="loan, index in loanStore.loans.data" :key="index"
                    class="border-b text-gray-900 bg-neutral-50  odd:bg-white even:bg-gray-50 ">
                    <td scope="row" class="pl-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                        {{ index + 1 }}
                    </td>
                    <td scope="row" class="pl-6 py-4  font-medium text-gray-900 whitespace-nowrap">
                        <span @click="bookStore.toBook(loan.book_id)"
                            class="rounded-full text-gray-500 bg-orange-100 font-semibold text-sm flex align-center cursor-pointer active:bg-gray-300 transition duration-300 ease w-max">
                            <img v-if="loan.book_image" class="rounded-full w-9 h-9 max-w-none" alt="A"
                                :src="loan.book_image" />
                                <img v-else class="rounded-full w-9 h-9 max-w-none" alt="A"
                                src="@/assets/images/image-placeholder.webp" />
                            <span class="flex items-center px-3 py-2">
                                {{ loan.title }}
                            </span>
                        </span>
                    </td>
                    <td scope="row" class="pl-6 py-4  font-medium text-gray-900 whitespace-nowrap">
                        <span @click="userStore.toUser(loan.user_id)"
                            class="rounded-full text-gray-500 bg-blue-100 font-semibold text-sm flex align-center cursor-pointer active:bg-gray-300 transition duration-300 ease w-max">
                            <img v-if="loan.user_image" class="rounded-full w-9 h-9 max-w-none" alt="A"
                                :src="loan.user_image" />
                                <img v-else class="rounded-full w-9 h-9 max-w-none" alt="A"
                                src="@/assets/images/guest_avatar.png" />
                            <span class="flex items-center px-3 py-2">
                                {{ loan.name}}
                            </span>
                        </span>
                    </td>
                    <td scope="row" class="pl-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                        {{ loan.created_at !== null ? loan.created_at : 'N/D' }}
                    </td>
                    <td scope="row" class="pl-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                        {{ loan.due_date !== null ? loan.due_date : 'Studente' }}
                    </td>

                    <td scope="row" class="pl-10 py-4 font-medium whitespace-nowrap">
                        <button class="font-medium">
                            <svg class="w-5 h-5 fill-blue-600 hover:fill-blue-500" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 512 512">
                                <path
                                    d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.8 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z" />
                            </svg>
                        </button>
                    </td>
                    <td scope="row" class="pl-10 py-4 font-medium whitespace-nowrap">
                        <button class="font-medium" @click="loanStore.delete('many', loan.user_id, loan.book_id)">
                                <svg class="fill-orange-600 hover:fill-orange-500 w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                    <path d="M50.7 58.5L0 160H208V32H93.7C75.5 32 58.9 42.3 50.7 58.5zM240 160H448L397.3 58.5C389.1 42.3 372.5 32 354.3 32H240V160zm208 32H0V416c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V192z"/></svg>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
        <ListPagination scope="loans" :currentPage="loanStore.loans.current_page"
            :lastPage="loanStore.loans.last_page" :nextPage="loanStore.loans.next_page_url"
            :prevPage="loanStore.loans.prev_page_url" />
    </div>
</template>