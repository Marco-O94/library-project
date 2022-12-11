import { defineStore } from "pinia";
import { Errors } from "@/interfaces/Errors";

export const GeneralStore = defineStore("GeneralStore", {
    state: () => ({
        flash: {
            message: "",
        },
        errors: {
            email: [],
            password: [],
            name: [],
            password_confirmation: [],
            message: [],
            image: [],
            title: [],
            quantity: [],
            role: [],
        } as Errors,
        loading: false,
    }),



});