<script setup lang="ts">
import { defineProps } from 'vue';
import { Book } from '../interfaces/BookData';


const props = defineProps({
    books: {
        type: Array as () => Book[],
        required: true
    }   
})
</script>

<template>
    <div class="relative overflow-x-auto shadow-md rounded-lg mt-5">
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
                    <th scope="col" class="px-6 py-3">
                        Data prestito
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Data riconsegna
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Scheda
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(book, index) in props.books" :key="index"
                    class="border-b text-gray-900 bg-neutral-50  odd:bg-white even:bg-gray-50 ">
                    <td scope="row" class="pl-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                       {{ index + 1 }}
                    </td>
                    <td scope="row" class="pl-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                        {{ book.title }}
                     </td>
                     <td scope="row" class="pl-6 py-4 flex flex-nowrap align-middle gap-3 font-medium text-gray-900 whitespace-nowrap">
                        <span class="px-4 py-2 rounded-full text-gray-500 bg-gray-200 font-semibold text-sm flex align-center w-max cursor-pointer active:bg-gray-300 transition duration-300 ease" v-for="cat, index in book.categories" :key="index">{{cat.name}}</span>
                     </td>
                </tr>


            </tbody>
        </table>
       
    </div>
</template>