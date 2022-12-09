import { defineStore } from "pinia";
import axios from 'axios';
import { LoginData, RegisterData } from '../interfaces/FormData';
import { GeneralStore } from './GeneralStore';
import { Role, User, Users, userSearch } from '../interfaces/UserData';
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

/* Make bearer token */
 const makeToken = (token: string) => {
    return `Bearer ${token}`;
 };


export const UserStore = defineStore("UserStore", {
    state: () => ({
        user: JSON.parse(Cookies.get("user") || "{}")  as User,
        users: {} as Users,
        roles: [] as Role[],
        token: Cookies.get('token') || '',
        returnURL: '' as string,
        loading: false,
    }),

    getters: {
        isLogged: state => !!state.token, // !! converts to boolean
    },

    actions: {
        /* LOGIN */
        async loginRequest(loginData: LoginData) {
            axios.post("/login", loginData)
            .then(res => {
                    if(res.status === 200) {
                    loginData.remember ? Cookies.set("user", JSON.stringify(res.data.user)) : Cookies.set("user", JSON.stringify(res.data.user), { expires: 10 });
                    loginData.remember ? Cookies.set("token", makeToken(res.data.token)) : Cookies.set("token", makeToken(res.data.token), { expires: 10 });
                    this.user = res.data.user;
                    this.token = res.data.token;
                    router.push({ name: "dashboard" });
                    }
            }).catch((error) => {
                    GeneralStore().errors = error?.response?.data?.errors;
                    console.log(error);
            });

        },
        /* REGISTER */
        async registerRequest(registerData: RegisterData) {
            return axios.post("/register", registerData).then((res) => {
                if(res.status === 201){
                    Cookies.set("user", JSON.stringify(res.data.user));
                    Cookies.set("token", makeToken(res.data.token));
                    this.user = res.data.user;
                    this.token = res.data.token;
                    router.push({ name: "dashboard" });
                }
            }
            ).catch((err) => {
                GeneralStore().errors = err.response.data.errors;
            });
            

        },
        /* LOGOUT */
        async logout () {
             await axios.post("/logout", {}, { 
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
                router.push({ name: "login" })
                }
                
              }).catch((err) => {
                console.log(err);
                })

          },

         /* GET CATEGORIES */
         async getRoles() {
            await axios.get("/users/roles", {
                headers: {
                    authorization: Cookies.get("token"),
                }
            }).then((res) => {
                if (res.status === 200) {
                    this.roles = res.data;
                }
            }, (err) => {
                console.log(err);
            });
        },

        /* CHANGE USER IMAGE */
        async changeImage(formData: FormData) { 
            await axios.post("/users/image", formData, { 
                headers: {
                    authorization: Cookies.get("token"),
                    'Content-Type': 'multipart/form-data',
                  },
                  transformRequest: formData => formData
                }).then((res) => {
                if(res.status === 201) {
                    this.user = res.data.user;
                    Cookies.remove("user");
                    Cookies.set("user", JSON.stringify(res.data.user));
                    GeneralStore().flash.message = res.data.message;
                    console.log(res.data);
                }
            }).catch((err) => {
                console.log(err);
            });
        },

        /* UPDATE USER */
        async updateUser(formData: FormData) {
            this.loading = true;
            await axios.put("/users/selfupdate", formData, {
                headers: {
                    authorization: Cookies.get("token"),
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    },
            }).then((res) => {
                if(res.status === 201) {
                    this.user = res.data.user;
                    GeneralStore().flash.message = res.data.message;
                    Cookies.remove("user");
                    Cookies.set("user", JSON.stringify(res.data.user));
                }
            }
            ).catch((err) => {
                console.log(err);
            });
            this.loading = false;
    },
    
    /* GET USERS FOR LIBRARIAN */
    async userSearch(data: userSearch) {
        await axios.get("/users", {
            params: { search: data.search, role: data.role }, headers: {
                authorization: Cookies.get("token"),
            }
        },
        ).then((res) => {
            this.users = res.data;
        }, (err) => {
            console.log(err);
        });
        return;
    },
    /* GET PAGINATED USERS FOR LIBRARIAN */
    async userlist(page = 1) {
        await axios.get(`/users?page=${page}`, {
            headers: {
                authorization: Cookies.get("token"),
            }
        }).then(({ data }) => {
            this.users = data
        }).catch(({ response }) => {
            console.error(response)
        })
    },

    /* DELETE USER */
    async delete(id: number) {
        await axios.delete(`/users/${id}`).then((res) => {
            if(res.status === 200) {
                GeneralStore().flash.message = res.data.message;
            }
        });
    }
}

});