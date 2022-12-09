import { defineStore } from "pinia";
import axios from 'axios';
import { Book, Books, librarianSearch, Category } from "@/interfaces/BookData";
// eslint-disable-next-line @typescript-eslint/no-var-requires
const Cookies = require('js-cookie');


export const BookStore = defineStore("BookStore", {
    state: () => ({
        books: {} as Books,
        av_books: 0 as number,
        av_bookings: 0 as number,
        categories: [] as Category[],
    }),
    getters: {
        book : (state) => (id: number) => {
            return state.books.data.find((book: Book) => book.id === id);
        }

    },
    actions: {

        getBooksData() {
            axios.get("/books/count").then((res) => {
                this.av_books = res.data.av_books;
                this.av_bookings = res.data.av_bookings;
            }, (err) => {
                console.log(err);
            });
        },

        async search(data: string) {
            await axios.get("/books/query", { params: {search: data}}).then((res) => {
                this.books = res.data;
            }, (err) => {
                console.log(err);
            });
            return;
        },
        async list(page=1){
            await axios.get(`/books/query?page=${page}`).then(({data})=>{
                this.books = data
            }).catch(({ response })=>{
                console.error(response)
            })
        },
        async librarianSearch(data: librarianSearch) {
            await axios.get("/books/librarians/query", { params: {search: data.search, category: data.category}, headers: {
                authorization: Cookies.get("token"),
              }},
            ).then((res) => {
                this.books = res.data;
            }, (err) => {
                console.log(err);
            });
            return;
        },
        async librarianlist(page=1){
            await axios.get(`/books/librarians/query?page=${page}`, {
                headers: {
                    authorization: Cookies.get("token"),
                  }}).then(({data})=>{
                this.books = data
            }).catch(({ response })=>{
                console.error(response)
            })
        },
        async getCategories() {
            await axios.get("/books/categories", {
                headers: {
                    authorization: Cookies.get("token"),
                  }}).then((res) => {
                if(res.status === 200) {
                this.categories = res.data;
                }
            }, (err) => {
                console.log(err);
            });
        },


       async modify(id: number, data: any) {
            await axios.put(`/books/${id}`, data).then((res) => {
                console.log(res);
            }, (err) => {
                console.log(err);
            });
        },
        async delete(id: number) {
            await axios.delete(`/books/destroy/${id}`,{
                headers: {
                    authorization: Cookies.get("token"),
                  }}).then((res) => {
                console.log(res);
                if(res.status === 200){
                    this.books.data = this.books.data.filter((book: Book) => book.id !== id)
                }
            }, (err) => {
                console.log(err);
            });
        },
        async add(data: Book) {
            await axios.post("/books", data).then((res) => {
                console.log(res);
            }, (err) => {
                console.log(err);
            }
            );
        },


    }
});