import { defineStore } from "pinia";
import { Users } from "@/interfaces/UserData";
import { GeneralStore } from "./GeneralStore";
import { UserStore } from "./UserStore";
import axios from "axios";
// eslint-disable-next-line @typescript-eslint/no-var-requires
const Cookies = require('js-cookie');

export const BorrowStore = defineStore("BorrowStore", {
    state: () => ({
        borrows: {} as Users,
    }),
    actions: {

        /* GET BORROWS */
        async getBorrows() {
            await axios.get("/borrows").then((res) => {
                this.borrows = res.data;
            }, (err) => {
                console.log(err);
            });
        },

        /* GET SINGLE BORROW */
        async getSingleBorrow(id: number) {
            await axios.get(`/borrows/${id}`).then((res) => {
                this.borrows = res.data;
            }, (err) => {
                console.log(err);
            });
        },


        /* DELETE BORROW */
        async delete(user: number, book: number) {
            const data = {
                user_id: user,
                book_id: book,
                _method: "DELETE",
            }
            
            await axios.post("/borrows", data, {
                    headers: {
                        authorization: Cookies.get("token"),
                        
                    },
                    
                }).then((res) => {
                    // Remove the book from the user's borrow list
                    UserStore().getUserBooks(user);
                    GeneralStore().flash.message = res.data.message;
                }, (err) => {
                    console.log(err);
                });
        },

        /* UPDATE DUE DATE */
        async updateDueDate(id: number, data: string) {
            await axios.put(`/borrows/update/${id}`, data, {
                headers: {
                    authorization: Cookies.get("token"),
                }
            }).then((res) => {
                GeneralStore().flash.message = res.data.message;
            }
            ).catch((err) => {
                console.log(err);
            }
            );
        },

        /* BORROW REQUEST BY USER */
        async sendRequest(data: string) {
            await axios.post(`/borrows/create`, data, {
                headers: {
                    authorization: Cookies.get("token"),
                }
            }).then((res) => {
                GeneralStore().flash.message = res.data.message;
            }, (err) => {
                console.log(err);
            });
        },

        /* CREATE BORROW REQUEST BY LIBRARIAN */
        async create(data: string) {
            await axios.post("/borrows/librarian/create", data, {
                headers: {
                    authorization: Cookies.get("token"),
                }
            }).then((res) => {
                GeneralStore().flash.message = res.data.message;
            }, (err) => {
                console.log(err);
            });
        }

    },
});
