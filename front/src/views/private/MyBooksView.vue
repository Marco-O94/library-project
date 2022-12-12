<script setup lang="ts">
import { UserStore } from '@/stores/UserStore';
const userStore = UserStore();
userStore.getUserBooks(userStore.user.id);

</script>
<template>
<!-- If user has Books loaned show table -->
<h2 class="font-bold text-2xl mt-12 mb-6">Libri presi in prestito</h2>
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
                    Data del prestito
                </th>
                <th scope="col" class="px-6 py-3 text-left">
                    Scadenza
                </th>
                <th scope="col" class="px-6 py-3 text-left">
                    Status
                </th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="book, index in userStore.user.books" :key="index"
                class="border-b text-gray-900 bg-neutral-50  odd:bg-white even:bg-gray-50 ">
                <td scope="row" class="pl-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                    {{ index + 1 }}
                </td>
                <td scope="row" class="pl-6 py-4  font-medium text-gray-900 whitespace-nowrap">
                    <p class="truncate w-60">{{ book.title }}</p>
                </td>
                <td scope="row" class="pl-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                    {{ book.pivot.created_at !== null ? book.pivot.created_at : 'N/D' }}
                </td>
                <td scope="row" class="pl-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                    {{ book.pivot.due_date !== null ? book.pivot.due_date : 'N/D' }}
                </td>
                <td class="px-8">
                    <span v-if="book.pivot.status_id === 1"
                        :class="'hover:bg-orange-200 bg-orange-300'"
                        class="px-4 py-2 text-white rounded-full font-semibold text-sm flex align-center w-max transition duration-300 ease">
                                In sospeso
                        </span>
                        <span v-else-if="book.pivot.status_id === 2"
                        :class="'hover:bg-green-200 bg-green-300'"
                        class="px-4 py-2 text-white rounded-full font-semibold text-sm flex align-center w-max transition duration-300 ease">
                                Consegnato
                        </span>
                        <span v-else-if="book.pivot.status_id === 3"
                        :class="'hover:bg-gray-200 bg-gray-300'"
                        class="px-4 py-2 text-white rounded-full font-semibold text-sm flex align-center w-max transition duration-300 ease">
                                Scaduto
                        </span>
                </td>
                <td scope="row" class="pl-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                    {{ book.due_date !== null ? book.due_date : 'N/D' }}
                </td>
            </tr>
        </tbody>
    </table>
</div>
</template>