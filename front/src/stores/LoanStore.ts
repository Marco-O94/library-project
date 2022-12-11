import { defineStore } from "pinia";
import { Loans, Loan } from "@/interfaces/BookData";
import { GeneralStore } from "./GeneralStore";
import { UserStore } from "./UserStore";
import { loansSearch } from "@/interfaces/BookData";
import axios from "axios";
// eslint-disable-next-line @typescript-eslint/no-var-requires
const Cookies = require('js-cookie');

export const LoanStore = defineStore("LoanStore", {
    state: () => ({
        loans: {} as Loans,
        loan: {} as Loan,
    }),
    actions: {

        /* GET BORROWS */
        async getLoans(data: loansSearch) {
            await axios.get("/loans", {
                params: {
                    search_book: data.search_book,
                    search_user: data.search_user,
                    search_due_date: data.search_due_date,
                    sort: data.sort,
                },
                headers: {
                    authorization: Cookies.get("token"),
                }
            },
            ).then((res) => {
                console.log(res.data);
                this.loans = res.data;
            }, (err) => {
                console.log(err);
            });
        },

        /* GET SINGLE BORROW */
        async getSingleLoan(id: number) {
            await axios.get(`/loans/${id}`).then((res) => {
                this.loans = res.data;
            }, (err) => {
                console.log(err);
            });
        },

        async loanslist(page = 1) {
            await axios.get(`/loans?page=${page}`, {
                headers: {
                    authorization: Cookies.get("token"),
                }
            }).then(({ data }) => {
                this.loans = data
            }).catch(({ response }) => {
                console.error(response)
            })
        },


        /* DELETE BORROW */
        async delete(scope: string, user: number, book: number) {
            const query = {} as loansSearch;
            const data = {
                user_id: user,
                book_id: book,
                _method: "DELETE",
            }
            
            await axios.post("/loans", data, {
                    headers: {
                        authorization: Cookies.get("token"),
                        
                    },
                    
                }).then((res) => {
                    // Remove the book from the user's loan list
                        scope === "many" ? this.getLoans(query) : UserStore().getUserBooks(user);
                    GeneralStore().flash.message = res.data.message;
                }, (err) => {
                    console.log(err);
                });
        },

        /* UPDATE DUE DATE */
        async updateDueDate(id: number, data: string) {
            await axios.put(`/loans/update/date/${id}`, data, {
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
            await axios.post(`/loans/create`, data, {
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
            await axios.post("/loans/librarian/create", data, {
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
