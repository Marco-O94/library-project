import { defineStore } from "pinia";
import axios from 'axios';
import { LoginData, RegisterData, Errors } from '../interfaces/FormData';
import { Role, User } from '../interfaces/UserData';
import router from '@/router';
// eslint-disable-next-line @typescript-eslint/no-var-requires
const Cookies = require('js-cookie');

/* ❗❗ I usually use Cookies to store the token, but I'm using localStorage for this example ❗❗ */


/* AXIOS CONFIGURATION */

/* Laravel path goes down here 👇 */
axios.defaults.baseURL = 'http://localhost:8000/api';
axios.defaults.headers.post['Content-Type'] = 'application/json';
axios.defaults.headers.post['Accept'] = 'application/json';
axios.defaults.withCredentials = true;

/* END AXIOS CONFIGURATION */

 const makeToken = (token: string) => {
    return `Bearer ${token}`;
 };


export const UserStore = defineStore("UserStore", {
    state: () => ({
        user: JSON.parse(Cookies.get("user") || "{}")  as User,
        roles: [] as Role[],
        token: Cookies.get('token') || '',
        returnURL: '' as string,
        errors: {
            email: [],
            password: [],
            name: [],
            password_confirmation: [],
            message: [],
        } as Errors,
    }),

    getters: {
        isLogged: state => !!state.token, // !! converts to boolean
    },

    actions: {
        /* Login */
        async loginRequest(loginData: LoginData) {
            axios.post("/login", loginData)
            .then(res => {
                    if(res.status === 200) {
                    loginData.remember ? Cookies.set("user", JSON.stringify(res.data.user)) : Cookies.set("user", JSON.stringify(res.data.user), { expires: 10 });
                    loginData.remember ? Cookies.set("token", makeToken(res.data.token)) : Cookies.set("token", makeToken(res.data.token), { expires: 10 });
                    this.user = res.data.user;
                    this.token = res.data.token;
                    router.push({ name: "Dashboard" });
                    }
            }).catch((error) => {
                    this.errors = error.response.data.errors;
                    console.log(error);
            });

        },
        /* Register */
        async registerRequest(registerData: RegisterData) {
            return axios.post("/register", registerData).then((res) => {
                if(res.status === 201){
                    Cookies.set("user", JSON.stringify(res.data.user));
                    Cookies.set("token", makeToken(res.data.token));
                    this.user = res.data.user;
                    this.token = res.data.token;
                    router.push({ name: "Dashboard" });
                }
            }
            ).catch((err) => {
                    this.errors = err.response.data.errors;
            });
            

        },
        /* Logout */
        logout () {
             return axios.post("/logout", {}, { 
             headers: {
                authorization: Cookies.get("token"),
            
            }}).then((res) => {
                if(res.status === 200) {
                //this.user = {} as User
                //this.token = ''  
                console.log(res);
                delete axios.defaults.headers.common["authorization"]
                Cookies.remove("token")
                Cookies.remove("user")
                router.push({ name: "Login" })
                }
                
              }).catch((err) => {
                console.log(err);
                })

          }

    }
});