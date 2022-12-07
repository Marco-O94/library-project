import { defineStore } from "pinia";
import axios from 'axios';
import { Book } from "@/interfaces/BookData";

export const BookStore = defineStore("BookStore", {
    state: () => ({
        books: [] as Book[],
        book: {} as Book,
        av_books: 0 as number,
        av_bookings: 0 as number,
    }),
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

    }
});