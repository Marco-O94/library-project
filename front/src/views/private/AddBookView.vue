<script>
import { BookStore } from "@/stores/BookStore";
import { GeneralStore } from "@/stores/GeneralStore";
import LoadingButton from "@/components/LoadingButton.vue";
import CKEditor from '@ckeditor/ckeditor5-vue';
import ErrorField from '@/components/ErrorField.vue';
import InlineEditor from '@ckeditor/ckeditor5-build-inline';
import FilePond from "vue-filepond";
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type';
import FilePondPluginImagePreview from 'filepond-plugin-image-preview';
// Import styles
import 'filepond/dist/filepond.min.css';
import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css';


export default {
    components: {
        LoadingButton,
        ckeditor: CKEditor.component,
        // eslint-disable-next-line vue/no-unused-components
        FilePond: FilePond(
            FilePondPluginFileValidateType,
            FilePondPluginImagePreview,
        ),
        ErrorField,
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
                },
            },
            book: {
                title: '',
                author: '',
                publisher: '',
                isbn: '',
                description: '',
                quantity: 1,
                image: [],

            },
        }
    },
    setup() {
        const bookStore = BookStore();
        const generalStore = GeneralStore();
        return { bookStore, generalStore };
    },
    methods: {
        updateFile(fileItem) {
            console.log(fileItem);
            this.book.image = fileItem[0].file;
        }
    }
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
                <ErrorField :errors="generalStore.errors.title" />
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
            <!-- Quantity Input-->
            <div>
                <label for="isbn" class="form-label inline-block mb-2 text-gray-700">Quantità</label>
                <input type="number" v-model="book.quantity" placeholder="Inserisci il codice ISBN del libro"
                    class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded  transition ease-in-out m-0focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" />
                <ErrorField :errors="generalStore.errors.quantity" />
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
            <label for="formFile" class="form-label inline-block mb-2 text-gray-700">Aggiungi un'immagine al
                Libro</label>
            <FilePond ref="pond"
                labelIdle="Trascina i tuoi file qui o <span class='filepond--label-action'> cerca nel pc </span>"
                allowMultiple="false" maxFiles="1" @updatefiles="updateFile"
                accepted-file-types="image/jpg, image/jpeg, image/png" labelInvalidField="Solo immagini!" />
            <ErrorField :errors="generalStore.errors.image" />
        </div>
        <LoadingButton text="Aggiungi" />
    </form>


</template>
<style>
.ck.ck-content {
    --tw-border-opacity: 1;
    border: 1px solid rgb(203 213 225 / var(--tw-border-opacity)) !important;
    border-radius: 0.375rem !important;
}
</style>