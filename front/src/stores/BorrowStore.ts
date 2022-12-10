import { defineStore } from "pinia";

export const BorrowStore = defineStore("BorrowStore", {
    state: () => ({
        borrows: [] as any,
    }),
    actions: {
    },
});
