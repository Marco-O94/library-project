import { defineStore } from "pinia";
import { Errors } from "@/interfaces/Errors";
import router from "@/router";

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