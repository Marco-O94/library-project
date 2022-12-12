<script setup lang="ts">
import { BookStore } from '@/stores/BookStore';
import { LoanStore } from '@/stores/LoanStore';
import { UserStore } from '@/stores/UserStore';
import { useRoute } from 'vue-router';
const route = useRoute(),
bookStore = BookStore(),
userStore = UserStore(),
loanStore = LoanStore();
bookStore.getBook(parseInt(route.params.id[0]))
</script>

<template>
    <section class="mb-32 text-gray-800 container shadow-lg rounded px-10 py-20">
        <div class="flex flex-wrap">
            <div class="grow-0 shrink-0 basis-auto w-full md:w-2/12 lg:w-3/12">
                <img v-if="bookStore.book.image" :src="bookStore.book.image" class="w-full shadow-lg rounded-lg mb-6"
                    alt="book-image" />
                <img v-else src="@/assets/images/image-placeholder.webp" class="w-full shadow-lg rounded-lg mb-6"
                    alt="" />
            </div>

            <div class="grow-0 shrink-0 basis-auto w-full md:w-10/12 lg:w-9/12 md:pl-6 text-center md:text-left">
                <h5 class="text-xl font-semibold mb-6">{{ bookStore.book.title }}</h5>
                <div class="mb-6 flex space-x-4 gap-8 justify-center md:justify-start">
                    <div>
                        <p class="text-sm font-semibold">Autore:</p>
                        <p class="text-sm">{{ bookStore.book.author }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-semibold">Editore:</p>
                        <p class="text-sm">{{ bookStore.book.publisher }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-semibold">ISBN:</p>
                        <p class="text-sm">{{ bookStore.book.isbn }}</p>
                    </div>
                    </div>
                    <p v-html="bookStore.book.description">
                    </p>
                    <div class="mt-8">
                        <template v-if="userStore.isLogged && userStore.user.role.name != 'Librarian'">
                    <button @click="loanStore.getRequest(bookStore.book.id)" v-if="(bookStore.book.quantity - bookStore.book.users_count) > 0" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center mr-2 ">
                        <svg aria-hidden="true" class="mr-2 -ml-1 w-5 h-5" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                            <path d="M96 0C43 0 0 43 0 96V416c0 53 43 96 96 96H384h32c17.7 0 32-14.3 32-32s-14.3-32-32-32V384c17.7 0 32-14.3 32-32V32c0-17.7-14.3-32-32-32H384 96zm0 384H352v64H96c-17.7 0-32-14.3-32-32s14.3-32 32-32zm32-240c0-8.8 7.2-16 16-16H336c8.8 0 16 7.2 16 16s-7.2 16-16 16H144c-8.8 0-16-7.2-16-16zm16 48H336c8.8 0 16 7.2 16 16s-7.2 16-16 16H144c-8.8 0-16-7.2-16-16s7.2-16 16-16z"/></svg>
                        Richiedi
                      </button>
                      <button v-else type="button" disabled class="text-white cursor-not-allowed bg-gray-500 hover:bg-gray-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center mr-2 ">
                        <svg aria-hidden="true" class="mr-2 -ml-1 w-5 h-5" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                            <path d="M96 0C43 0 0 43 0 96V416c0 53 43 96 96 96H384h32c17.7 0 32-14.3 32-32s-14.3-32-32-32V384c17.7 0 32-14.3 32-32V32c0-17.7-14.3-32-32-32H384 96zm0 384H352v64H96c-17.7 0-32-14.3-32-32s14.3-32 32-32zm32-240c0-8.8 7.2-16 16-16H336c8.8 0 16 7.2 16 16s-7.2 16-16 16H144c-8.8 0-16-7.2-16-16zm16 48H336c8.8 0 16 7.2 16 16s-7.2 16-16 16H144c-8.8 0-16-7.2-16-16s7.2-16 16-16z"/></svg>
                        Non disponibile
                      </button>
                    </template>
                    <template v-else-if="userStore.isLogged && userStore.user.role.name == 'Librarian'">
                        <button @click="bookStore.toBook(bookStore.book.id)" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center mr-2 ">
                            <svg aria-hidden="true" class="mr-2 -ml-1 w-5 h-5" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                <path d="M96 0C43 0 0 43 0 96V416c0 53 43 96 96 96H384h32c17.7 0 32-14.3 32-32s-14.3-32-32-32V384c17.7 0 32-14.3 32-32V32c0-17.7-14.3-32-32-32H384 96zm0 384H352v64H96c-17.7 0-32-14.3-32-32s14.3-32 32-32zm32-240c0-8.8 7.2-16 16-16H336c8.8 0 16 7.2 16 16s-7.2 16-16 16H144c-8.8 0-16-7.2-16-16zm16 48H336c8.8 0 16 7.2 16 16s-7.2 16-16 16H144c-8.8 0-16-7.2-16-16s7.2-16 16-16z"/></svg>
                            Modifica
                          </button>
                    </template>
                    <template v-else>
                        <router-link :to="{name: 'register'}" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center mr-2 ">
                            <svg aria-hidden="true" class="mr-2 -ml-1 w-5 h-5" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                <path d="M96 0C43 0 0 43 0 96V416c0 53 43 96 96 96H384h32c17.7 0 32-14.3 32-32s-14.3-32-32-32V384c17.7 0 32-14.3 32-32V32c0-17.7-14.3-32-32-32H384 96zm0 384H352v64H96c-17.7 0-32-14.3-32-32s14.3-32 32-32zm32-240c0-8.8 7.2-16 16-16H336c8.8 0 16 7.2 16 16s-7.2 16-16 16H144c-8.8 0-16-7.2-16-16zm16 48H336c8.8 0 16 7.2 16 16s-7.2 16-16 16H144c-8.8 0-16-7.2-16-16s7.2-16 16-16z"/></svg>
                            Registrati
                          </router-link>
                    </template>
                    </div>
                </div>
                
            </div>
    </section>
</template>