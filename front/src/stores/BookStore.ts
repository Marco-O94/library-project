import { defineStore } from "pinia";
import axios from 'axios';
import { Book, Books, librarianSearch, Category } from "@/interfaces/BookData";
import { UserStore } from "./UserStore";
import { GeneralStore } from "./GeneralStore";
import router from '@/router';
// eslint-disable-next-line @typescript-eslint/no-var-requires
const Cookies = require('js-cookie');
export const BookStore = defineStore("BookStore", {
    state: () => ({
        books: {} as Books,
        bookId: 0 as number,
        // eslint-disable-next-line @typescript-eslint/no-explicit-any
        book: {} as Book | any,
        av_books: 0 as number,
        av_bookings: 0 as number,
        categories: [] as Category[],

    }),
    actions: {
        /* GET BOOKS GENERIC DATA */
        getBooksData() {
            axios.get("/books/count").then((res) => {
                this.av_books = res.data.av_books;
                this.av_bookings = res.data.av_bookings;
            }, (err) => {
                console.log(err);
            });
        },

        /* GET BOOKS */
        async search(data: string) {
            await axios.get("/books/query", { params: { search: data } }).then((res) => {
                this.books = res.data;
            }, (err) => {
                console.log(err);
            });
            return;
        },

        /* GET BOOKS PAGINATION */
        async list(page = 1) {
            await axios.get(`/books/query?page=${page}`).then(({ data }) => {
                this.books = data
            }).catch(({ response }) => {
                console.error(response)
            })
        },

        /* GET BOOKS FOR LIBRARIAN */
        async librarianSearch(data: librarianSearch) {
            await axios.get("/books/librarians/query", {
                params: { search: data.search, category: data.category }, headers: {
                    authorization: Cookies.get("token"),
                }
            },
            ).then((res) => {
                this.books = res.data;
            }, (err) => {
                console.log(err);
            });
            return;
        },
        /* GET PAGINATED BOOKS FOR LIBRARIAN */
        async librarianlist(page = 1) {
            await axios.get(`/books/librarians/query?page=${page}`, {
                headers: {
                    authorization: Cookies.get("token"),
                }
            }).then(({ data }) => {
                this.books = data
            }).catch(({ response }) => {
                console.error(response)
            })
        },

        /* GET CATEGORIES */
        async getCategories() {
            await axios.get("/books/categories", {
                headers: {
                    authorization: Cookies.get("token"),
                }
            }).then((res) => {
                if (res.status === 200) {
                    this.categories = res.data;
                }
            }, (err) => {
                console.log(err);
            });
        },

        /* MODIFY BOOK */
        async modify(formData: FormData) {
            UserStore().loading = true;
            await axios.put("/books/update", formData, {
                headers: {
                    authorization: Cookies.get("token"),
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                },
            }).then((res) => {
                if (res.status === 201) {
                    GeneralStore().flash.message = res.data.message;
                }
            }
            ).catch((err) => {
                console.log(err);
            });
            UserStore().loading = false;
        },

        /* DELETE BOOK */
        async delete(id: number) {
            await axios.delete(`/books/${id}`, {
                headers: {
                    authorization: Cookies.get("token"),
                }
            }).then((res) => {
                console.log(res);
                if (res.status === 200) {
                    this.books.data = this.books.data.filter((book: Book) => book.id !== id)
                    GeneralStore().flash.message = res.data.message;
                }
            }, (err) => {
                console.log(err);
            });
        },

        /* ADD BOOK */
        async add(data: FormData) {
            await axios.post("/books/store", data, {
                headers: {
                    authorization: Cookies.get("token"),
                    'Content-Type': 'multipart/form-data',
                },
                
            }).then((res) => {
                if(res.status === 201){
                    router.push({ name: "managebooks" });
                    GeneralStore().flash.message = res.data.message;
                }
                console.log(res);
            }, (err) => {
                GeneralStore().errors = err.response.data.errors;
            }
            );
        },

        /* CHANGE BOOK IMAGE */
        async changeImage(formData: FormData) {
            await axios.post(`/books/image/${this.book.id}`, formData, {
                headers: {
                    authorization: Cookies.get("token"),
                    'Content-Type': 'multipart/form-data',
                },
                transformRequest: formData => formData
            }).then((res) => {
                if (res.status === 201) {
                    this.book.image = res.data.image;
                    GeneralStore().flash.message = res.data.message;
                }
            }).catch((err) => {
                console.log(err);
            });
        },
    }

});