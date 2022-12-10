<script lang="ts">

import { BookStore } from "@/stores/BookStore";
import { useRoute } from "vue-router";
import { BookData } from "@/interfaces/BookData";
import LoadingButton from "@/components/LoadingButton.vue";
import CKEditor from '@ckeditor/ckeditor5-vue';
import InlineEditor from '@ckeditor/ckeditor5-build-inline';
import axios from "axios";
/* 😭 3 hours... Trying to let it work... It works only in option api... I hate it  */
export default {
    components: {
        LoadingButton,
        ckeditor: CKEditor.component,
    },
    data() {
        return {
            InlineEditor: InlineEditor,
            defaultConfig: {
            toolbar: {
                items: [
                    'heading',
                    '|',
                    'bold',
                    'italic',
                    'link',
                    'bulletedList',
                    'numberedList',
                    'undo',
                    'redo'
                ]
            }
        }
        }
    },
    setup() {
        const route = useRoute();
        axios.get(`/books/single/${route.params.id}`).then(
                (response) => {
                    BookStore().book = response.data;
                    return response.data;
                });
                const bookStore = BookStore();
                return { bookStore };
                
        },
    methods: {
        onFileInput(event: { target: { files: any[]; }; }) {
            let formData = new FormData();
            formData.append('image', event.target.files[0]);
            BookStore().changeImage(formData);
            return void 0;
        }
    },
    computed: {
        book: {
            get() {
                return BookStore().book;
            },
            set(value: BookData) {
                BookStore().book = value;
            }
        },
        }
    }
</script>

<template>
    <h1 class="font-bold text-4xl mb-2">Stai modificando il libro:</h1>
    <h2 class="font-bold text-2xl mb-5">{{ book.title }}</h2>
    <!-- I'm sprinting a little bit here 🚀 🚀 -->
    <div class="grid grid-cols-1 md:grid-cols-3 mt-6 mb-10 items-center">
        <div class="col-span-1">
            <img class="w-auto rounded-full" v-if="book.image" :src="book.image" />
            <img v-else class="w-auto rounded-full" src="@/assets/images/image-placeholder.webp" />
        </div>
        <div class="mb-3 w-auto col-span-2">
            <label for="formFile" class="form-label inline-block mb-2 text-gray-700">Modifica l'immagine del
                libro</label>
            <input type="file" ref="inputFile" label="Image" @change="onFileInput"
                class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded  transition ease-in-out m-0focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" />
        </div>
    </div>
    <form @submit.prevent="bookStore.modify(book)">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Title Input-->
            <div>
                <label for="title" class="form-label inline-block mb-2 text-gray-700">Titolo</label>
                <input type="text" v-model="book.title" placeholder="Inserisci il titolo del libro"
                    class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded  transition ease-in-out m-0focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" />
            </div>
            <!-- Author Input-->
            <div>
                <label for="author" class="form-label inline-block mb-2 text-gray-700">Autore</label>
                <input type="text" v-model="book.author" placeholder="Inserisci il nome dell'autore"
                    class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded  transition ease-in-out m-0focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" />
            </div>
            <!-- Publisher Input-->
            <div>
                <label for="publisher" class="form-label inline-block mb-2 text-gray-700">Editore</label>
                <input type="text" v-model="book.publisher" placeholder="Inserisci il nome dell'editore"
                    class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded  transition ease-in-out m-0focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" />
            </div>
            <!-- ISBN Input-->
            <div>
                <label for="isbn" class="form-label inline-block mb-2 text-gray-700">ISBN</label>
                <input type="text" v-model="book.isbn" placeholder="Inserisci il codice ISBN del libro"
                    class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded  transition ease-in-out m-0focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" />
            </div>
        </div>
        <div class="w-full mt-10">
            <label for="description" class="form-label inline-block mb-2 text-gray-700">Descrizione</label>
            <ckeditor id="description" v-model="book.description" :editor="InlineEditor"
                :config="defaultConfig" />
        </div>
        <LoadingButton text="Modifica" />
    </form>

    
</template>
<style>
.ck.ck-content {
    --tw-border-opacity: 1;
    border: 1px solid rgb(203 213 225 / var(--tw-border-opacity)) !important;
    border-radius: 0.375rem !important;
}
</style>