<script lang="ts">

import { BookStore } from "@/stores/BookStore";
import { useRoute } from "vue-router";
import { BookData } from "@/interfaces/BookData";
import LoadingButton from "@/components/LoadingButton.vue";
import CKEditor from '@ckeditor/ckeditor5-vue';
import InlineEditor from '@ckeditor/ckeditor5-build-inline';
import axios from "axios";
import Cookies from "js-cookie";
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
            },
        }
    },
    setup() {
        const route = useRoute();
        axios.get(`/books/single/${route.params.id}`).then(
            (response) => {
                BookStore().book = response.data;
                return response.data;
            });
        axios.get("/books/categories", {
            headers: {
                authorization: Cookies.get("token"),
            }
        }).then((res) => {
            if (res.status === 200) {
                BookStore().categories = res.data;
            }
        }, (err) => {
            console.log(err);
        });
        BookStore().getCategories;
        const bookStore = BookStore();
        return { bookStore };

    },
    methods: {
        onFileInput(event: { target: { files: any[]; }; }) {
            let formData = new FormData();
            formData.append('image', event.target.files[0]);
            BookStore().changeImage(formData);
            return void 0;
        },
        removeObject(arr: any, id: number) {
            const objWithIdIndex = arr.findIndex((obj: any) => obj.id === id);

            if (objWithIdIndex > -1) {
                arr.splice(objWithIdIndex, 1);
            }

            return arr;
        },
        addObject(arr: any, obj: any) {
            if (arr.find((o: any) => o.id === obj.id)) {
                return;
            } else {
                BookStore().book.categories.push(obj);
                return;
            }
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
        /*cats: {
             get() {
                 return BookStore().categories;
             },
             set(value: any) {
                 BookStore().categories = value;
             }
         }*/
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
        <!-- Categorie -->
        <label for="categories" class="form-label inline-block mb-3 mt-5 text-gray-700">Categorie</label>

        <select id="categories" @input="addObject(book.categories, bookStore.categories[$event.target?.value - 1])"
            class="form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
            <option selected disabled value="">-- Seleziona le categorie --</option>
            <template v-for="cat, index in bookStore.categories" :key="index">
                <option :value="cat.id">{{ cat.name }}</option>
            </template>
        </select>
        <div class="flex align-middle gap-2 my-6">

            <template v-for="cat, index in book.categories" :key="index">
                <button @click="removeObject(book.categories, cat.id)" type="button"
                    :class="'hover:bg-' + cat.color + '-400 bg-' + cat.color + '-500'"
                    class="text-white  focus:outline-none focus:ring-4  font-medium rounded-full text-sm px-4 py-2 flex flex-nowrap items-center gap-2 mr-2 mb-2">{{
                            cat.name
                    }}
                    <svg class="w-3 h-3 fill-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                        <path
                            d="M376.6 84.5c11.3-13.6 9.5-33.8-4.1-45.1s-33.8-9.5-45.1 4.1L192 206 56.6 43.5C45.3 29.9 25.1 28.1 11.5 39.4S-3.9 70.9 7.4 84.5L150.3 256 7.4 427.5c-11.3 13.6-9.5 33.8 4.1 45.1s33.8 9.5 45.1-4.1L192 306 327.4 468.5c11.3 13.6 31.5 15.4 45.1 4.1s15.4-31.5 4.1-45.1L233.7 256 376.6 84.5z" />
                    </svg>
                </button>
            </template>

        </div>
        <div class="w-full mt-10">
            <label for="description" class="form-label inline-block mb-2 text-gray-700">Descrizione</label>
            <ckeditor id="description" v-model="book.description" :editor="InlineEditor" :config="defaultConfig" />
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