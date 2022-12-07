<script setup lang="ts">
import { BookStore } from '../stores/BookStore';
const bookStore = BookStore();

bookStore.getBooksData();

</script>
<template>
  <section class="pt-12 pb-12 sm:pb-16 lg:pt-8">
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="grid max-w-lg grid-cols-1 mx-auto lg:max-w-full lg:items-center lg:grid-cols-2 gap-y-12 lg:gap-x-16">
            <div>
                <div class="text-center lg:text-left">
                    <h1 class="text-3xl font-bold leading-tight text-gray-900 sm:text-3xl sm:leading-tight lg:leading-tight lg:text-4xl font-pj">L'anima di un individuo risiede nei libri in cui legge</h1>
                    <p class="mt-2 text-lg text-gray-600 sm:mt-8 font-inter">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                </div>

                <div class="flex items-center justify-center mt-10 space-x-6 lg:justify-start sm:space-x-8">
                    <div class="flex items-center">
                        <p class="text-3xl font-medium text-gray-900 sm:text-4xl font-pj">{{ bookStore.av_books }}</p>
                        <p v-if="(bookStore.av_books === 1)" class="ml-3 text-sm text-gray-900 font-pj">Libro<br />Disponibile</p>
                        <p v-else class="ml-3 text-sm text-gray-900 font-pj">Libri<br />Disponibili</p>
                    </div>

                    <div class="hidden sm:block">
                        <svg class="text-gray-400" width="16" height="39" viewBox="0 0 16 39" fill="none" stroke="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <line x1="0.72265" y1="10.584" x2="15.7226" y2="0.583975"></line>
                            <line x1="0.72265" y1="17.584" x2="15.7226" y2="7.58398"></line>
                            <line x1="0.72265" y1="24.584" x2="15.7226" y2="14.584"></line>
                            <line x1="0.72265" y1="31.584" x2="15.7226" y2="21.584"></line>
                            <line x1="0.72265" y1="38.584" x2="15.7226" y2="28.584"></line>
                        </svg>
                    </div>

                    <div class="flex items-center">
                        <p class="text-3xl font-medium text-gray-900 sm:text-4xl font-pj">{{ bookStore.av_bookings }}</p>
                        <p v-if="(bookStore.av_bookings === 1)"  class="ml-3 text-sm text-gray-900 font-pj">Libro<br />Prestato</p>
                        <p v-else class="ml-3 text-sm text-gray-900 font-pj">Libri<br />Prestati</p>
                    </div>
                </div>
            </div>
            <div class="bg-[url('https://images.unsplash.com/photo-1633354516388-41b56d6fe980?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8MTZ8fGxpYnJhcnl8ZW58MHwyfDB8fA%3D%3D&auto=format&fit=crop&w=800&q=60')] bg-contain rounded-lg bg-no-repeat md:w-[500px] md:h-[500px]"> 
            </div>
        </div>
    </div>
</section>
</template>

<script setup lang="ts">

</script>
