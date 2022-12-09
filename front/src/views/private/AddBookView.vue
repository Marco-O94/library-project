<script >

import { BookStore } from "@/stores/BookStore";
import { ref } from "vue";
import { Book } from "@/interfaces/BookData";
import LoadingButton from "@/components/LoadingButton.vue";
import CKEditor from '@ckeditor/ckeditor5-vue';
// eslint-disable-next-line @typescript-eslint/no-unused-vars
import InlineEditor from '@ckeditor/ckeditor5-build-inline';
import vueFilePond from "vue-filepond";
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type';
import FilePondPluginImagePreview from 'filepond-plugin-image-preview';
// Import styles
import 'filepond/dist/filepond.min.css';
import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css';
import VueFilePond from "vue-filepond";

const FilePond = vueFilePond(
  FilePondPluginFileValidateType,
  FilePondPluginImagePreview
);

const bookStore = BookStore();
const defaultConfig = {
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
};

const book = ref({
    title: '',
    author: '',
    publisher: '',
    isbn: '',
    description: '',
    image: null,
    
});

// eslint-disable-next-line @typescript-eslint/no-explicit-any
const data = {
    preview: null,
}
const ckeditor = CKEditor.component;
/* Get the filepond instance */
function updateFile(fileItem) {
            book.value.image = fileItem[0].file;
            return void 0;
        }
</script>

<template>
    <h1 class="font-bold text-4xl mb-2">Aggiungi un nuovo libro</h1>
    <h2 class="font-bold text-2xl mb-5">{{ book.title }}</h2>
    <!-- I'm sprinting a little bit here 🚀 🚀 -->
    <form @submit.prevent="bookStore.add(book)">
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
        <ckeditor id="description" v-model="book.description" :editor="InlineEditor" :config="defaultConfig" />
    </div>
    <div class="my-5 w-full">
        <label for="formFile" class="form-label inline-block mb-2 text-gray-700">Aggiungi un'immagine al Libro</label>
        <vueFilePond ref="pond"
            labelIdle="Trascina i tuoi file qui o <span class='filepond--label-action'> cerca nel pc </span>"
            allowMultiple="false" maxFiles="1" @updatefiles="updateFile()" accepted-file-types="image/jpg, image/jpeg, image/png"
            labelInvalidField="Solo documenti PDF" />
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