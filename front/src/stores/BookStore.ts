import { defineStore } from "pinia";
import axios from 'axios';
import { Book, Books } from "@/interfaces/BookData";


export const BookStore = defineStore("BookStore", {
    state: () => ({
        books: {} as Books,
        av_books: 0 as number,
        av_bookings: 0 as number,
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
                console.log(res)
            }, (err) => {
                console.log(err);
            });
        },

        async search(data: string) {
            await axios.get("/books/query", { params: {search: data}}).then((res) => {
                this.books = res.data;
                console.log(res)
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
        }


    }
});