<script setup lang="ts">
/* This imports has to be refactored in one export file */
import { LoanStore } from '@/stores/LoanStore';
import { UserStore } from '@/stores/UserStore';
import { BookStore } from '@/stores/BookStore';
import { ref, watch } from 'vue';
import { loansSearch } from '@/interfaces/BookData';
import ListPagination from '@/components/ListPagination.vue';
import SearchBar from '@/components/SearchBar.vue';
import DatePicker from '@/components/DatePicker.vue';
import { debounce } from '@/stores/myFunctions';

const loanStore = LoanStore(),
userStore = UserStore(),
bookStore = BookStore(),
data = ref<loansSearch>({
    search_user: '',
    search_book: '',
    search_due_date: '',
    status: 0,
    sort: '',

}),
form = ref({
    user_id: 0,
    book_id: 0,
    status_id: 0,
    _method: 'PUT',
}),
showModal = (user_id: number, book_id: number, status_id: number) => {
    loanStore.active = true
    form.value.user_id = user_id;
    form.value.book_id = book_id;
    form.value.status_id = status_id;
},
debouncedFunction = debounce((value: loansSearch) => { loanStore.getLoans(value); }, 500); // Wait 500ms before calling the function
watch(() => [data.value.search_user, data.value.search_book, data.value.search_due_date, data.value.sort, data.value.status], (() => {
    debouncedFunction(data.value);
}));




loanStore.getLoansStatuses();
loanStore.getLoans(data.value); // Get all loans

</script>

<template>
    <h2 class="font-bold text-2xl my-8">Prestiti in corso</h2>
    <p> Qui puoi visualizzare i prestiti attualmente attivi, clicca sul libro o sull'utente per avere più informazioni.<br>
        Inoltre clicca sullo stato per modificarlo, una volta che verrà impostato lo stato di "consegnato", verrà aggiunta una scadenza al libro di 30 giorni se l'utente non è uno studente.
    </p>
    <div class="grid grid-cols-1 md:grid-cols-2 items-center gap-x-10 gap-y-5 mt-10 mb-12">
        <div>
            <!-- Search by user -->
            <SearchBar placeholder="Cerca un utente" v-model:search="data.search_user" />
        </div>
        <div>
            <!-- Search by book -->
            <SearchBar placeholder="Cerca un libro" v-model:search="data.search_book" />
        </div>
        <div>
            <!-- Search by due date -->
            <DatePicker text="Seleziona una scadenza" v-model:date="data.search_due_date" />
        </div>
        <!-- Filter by status-->
        <div>
            <select v-model="data.status"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                <option disable value="0" selected>-- Seleziona uno stato --</option>
                <option v-for="status, index in loanStore.statuses" :key="index" :value="status.id">{{ status.name }}
                </option>
            </select>
        </div>
        <!-- Sort -->

    </div>
    <div class="relative overflow-x-auto shadow-md rounded-lg mt-5 mb-16">

        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-900 uppercase bg-neutral-50">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Libro
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Utente
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Stato
                    </th>
                    <th scope="col" class="px-6 py-3 text-left">
                        Scadenza
                    </th>
                    <th scope="col" class="px-6 py-3 text-left">
                        Riconsegna
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="loan, index in loanStore.loans.data" :key="index"
                    class="border-b text-gray-900 bg-neutral-50  odd:bg-white even:bg-gray-50 ">
                    <!-- Book Title-->
                    <td scope="row" class="pl-6 py-4  font-medium text-gray-900 whitespace-nowrap">
                        <span @click="bookStore.toBook(loan.book_id)"
                            class="rounded-full text-gray-500 bg-orange-100 font-semibold text-sm flex align-center cursor-pointer active:bg-gray-300 transition duration-300 ease w-max">
                            <img v-if="loan.book_image" class="rounded-full w-9 h-9 max-w-none" alt="A"
                                :src="loan.book_image" />
                            <img v-else class="rounded-full w-9 h-9 max-w-none" alt="A"
                                src="@/assets/images/image-placeholder.webp" />
                            <span class="flex items-center px-3 py-2 w-[300px] overflow-x-auto">
                                {{ loan.title }}
                            </span>
                        </span>
                    </td>
                    <!-- User name -->
                    <td scope="row" class="pl-6 py-4  font-medium text-gray-900 whitespace-nowrap">
                        <span @click="userStore.toUser(loan.user_id)"
                            class="rounded-full text-gray-500 bg-blue-100 font-semibold text-sm flex align-center cursor-pointer active:bg-gray-300 transition duration-300 ease w-max">
                            <img v-if="loan.user_image" class="rounded-full w-9 h-9 max-w-none" alt="A"
                                :src="loan.user_image" />
                            <img v-else class="rounded-full w-9 h-9 max-w-none" alt="A"
                                src="@/assets/images/guest_avatar.png" />
                            <span class="flex items-center px-3 py-2">
                                {{ loan.name }}
                            </span>
                        </span>
                    </td>
                    <!-- Status -->
                    <td class="px-8">
                        <span @click="showModal(loan.user_id, loan.book_id, loan.status_id)"
                            :class="'hover:bg-' + loan.status_color + '-200 bg-' + loan.status_color + '-300'"
                            class="px-4 py-2 text-white rounded-full font-semibold text-sm flex align-center w-max cursor-pointer transition duration-300 ease">{{
                                    loan.status_name
                            }}</span>
                    </td>
                    <td scope="row" class="pl-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                        {{ loan.due_date !== null ? loan.due_date : 'N/D' }}
                    </td>
                    <td scope="row" class="pl-10 py-4 font-medium whitespace-nowrap">
                        <button class="font-medium" @click="loanStore.delete('many', loan.user_id, loan.book_id)">
                            <svg class="fill-orange-600 hover:fill-orange-500 w-5 h-5"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                <path
                                    d="M50.7 58.5L0 160H208V32H93.7C75.5 32 58.9 42.3 50.7 58.5zM240 160H448L397.3 58.5C389.1 42.3 372.5 32 354.3 32H240V160zm208 32H0V416c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V192z" />
                            </svg>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
        <ListPagination scope="loans" :currentPage="loanStore.loans.current_page" :lastPage="loanStore.loans.last_page"
            :nextPage="loanStore.loans.next_page_url" :prevPage="loanStore.loans.prev_page_url" />
    </div>

    <div v-if="loanStore.active === true"
        class="bg-gray-600 w-full h-full fixed z-50 bg-opacity-50 flex justify-center items-center top-0 right-0 bottom-0 left-0 outline-none overflow-hidden">
        <div class="bg-white px-16 py-14 rounded-md text-center">
            <div>
                <div class="text-xl mb-4 font-bold text-slate-500">Cambia lo stato della prenotazione</div>
                <div v-for="stat, index in loanStore.statuses" :key="index" class="flex items-center mb-4">
                    <input :id="'status-radio' + stat.id" type="radio" :value="stat.id" v-model="form.status_id"
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 ">
                    <label :for="'status-radio' + stat.id"
                        class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{stat.name}}</label>
                </div>
            </div>
            
            <button @click="loanStore.changeStatus(form)"
                class="bg-blue-600 px-7 py-2 ml-2 rounded-md text-md text-white font-semibold">Invia</button>
                <button @click="loanStore.active = false"
                class="bg-red-600 px-7 py-2 ml-2 rounded-md text-md text-white font-semibold">Annulla</button>
        </div>
    </div>
</template>