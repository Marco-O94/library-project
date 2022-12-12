<script setup lang="ts">
import { UserStore } from '@/stores/UserStore';
import { GeneralStore } from '@/stores/GeneralStore';
import { LoanStore } from '@/stores/LoanStore';
import { computed } from 'vue';
import LoadingButton from '@/components/LoadingButton.vue';
import { useRoute } from 'vue-router';
import ErrorField from '@/components/ErrorField.vue';
const route = useRoute(),
userStore = UserStore(),
generalStore = GeneralStore(),
loanStore = LoanStore(),


// eslint-disable-next-line @typescript-eslint/no-explicit-any
onFileInput = (event: { target: { files: any[]; }; }) => {
    let formData = new FormData();
    formData.append('image', event.target.files[0]);
    formData.append('id', route.params.id[0]);
    userStore.changeImage(formData);
    return void 0;
};

userStore.getUser(parseInt(route.params.id[0]));
userStore.getRoles();
window.scrollTo(0,0); 
/* 😍 Finally I found solution in Composition Api Style 😍 */
const userForm = computed(() => {
    return {
        id: parseInt(route.params.id[0]),
        name: userStore.anotherUser.name,
        email: userStore.anotherUser.email,
        role: userStore.anotherUser.role_id,
    };
});

const userBooks = computed(() => {
    return userStore.anotherUser.books;
});
</script>
<template>
    <h1 class="font-bold text-4xl mb-2">Stai modificando l'utente:</h1>
    <h2 class="font-bold text-2xl mb-5">{{ userForm.name }}</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 mt-6 mb-10 items-center">
        <div class="col-span-1">
            <img class="w-28 h-28 rounded-full" v-if="userStore.anotherUser.image_path"
                :src="userStore.anotherUser.image_path" />
            <img v-else class="w-28 h-28 rounded-full" src="@/assets/images/guest_avatar.png" />
        </div>
        <div class="mb-3 w-auto col-span-2">
            <label for="formFile" class="form-label inline-block mb-2 text-gray-700">Modifica la tua foto
                profilo</label>
            <input type="file" ref="inputFile" label="Image" @change="onFileInput"
                class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded  transition ease-in-out m-0focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" />

        </div>
    </div>
    <form @submit.prevent="userStore.editUser(userForm as unknown as FormData)">
        <div class="grid grid-cols-2 gap-10 mb-4">
            <div>
                <!-- Input Name -->
                <label for="name" class="form-label inline-block mb-2 text-gray-700">Nome</label>
                <input v-model="userForm.name" type="text" class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none
                      " id="name" placeholder="Inserisci un nome" />
                <ErrorField :errors="generalStore.errors.name" />
            </div>
            <div>
                <label for="email" class="form-label inline-block mb-2 text-gray-700">Indirizzo Email</label>
                <input v-model="userForm.email" type="email"
                    class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                    id="email" placeholder="Inserisci una email" />
                <ErrorField :errors="generalStore.errors.email" />
            </div>
            <div class="col-span-2">
                <label for="role" class="form-label inline-block mb-2 text-gray-700">Ruolo</label>
                <select id="role" v-model="userForm.role"
                    class="form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                    <template v-for="role, index in userStore.roles" :key="index">
                        <option selected v-if="role.id === userForm.role" :value="role.id">{{ role.name }}</option>
                        <option v-else :value="role.id">{{ role.name }}</option>
                    </template>
                </select>
                <ErrorField :errors="generalStore.errors.role" />
            </div>

        </div>
        <!-- Button Group -->
        <LoadingButton text="Modifica" />
    </form>

    <!-- If user has Books loaned show table -->
        <h2 class="font-bold text-2xl mt-12 mb-6">Libri presi in prestito</h2>
        <div class="relative overflow-x-auto shadow-md rounded-lg mt-5 mb-16">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-900 uppercase bg-neutral-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            #
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Libro
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Data del prestito
                        </th>
                        <th scope="col" class="px-6 py-3 text-left">
                            Scadenza
                        </th>
                        <th scope="col" class="px-6 py-3 text-left">
                            Modifica
                        </th>
                        <th scope="col" class="px-6 py-3 text-left">
                            Elimina
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="book, index in userBooks" :key="index"
                        class="border-b text-gray-900 bg-neutral-50  odd:bg-white even:bg-gray-50 ">
                        <td scope="row" class="pl-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            {{ index + 1 }}
                        </td>
                        <td scope="row" class="pl-6 py-4  font-medium text-gray-900 whitespace-nowrap">
                            <p class="truncate w-60">{{ book.title }}</p>
                        </td>
                        <td scope="row" class="pl-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            {{ book.pivot.created_at !== null ? book.pivot.created_at : 'N/D' }}
                        </td>
                        <td scope="row" class="pl-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            {{ book.pivot.due_date !== null ? book.pivot.due_date : 'N/D' }}
                        </td>

                        <td scope="row" class="pl-10 py-4 font-medium whitespace-nowrap">
                            <button class="font-medium">
                                <svg class="w-5 h-5 fill-blue-600 hover:fill-blue-500"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <path
                                        d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.8 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z" />
                                </svg>
                            </button>
                        </td>
                        <td scope="row" class="pl-10 py-4 font-medium whitespace-nowrap">
                            <button class="font-medium" @click="loanStore.delete('', parseInt(route.params.id[0]), book.id)">
                                <svg class="fill-red-600 hover:fill-red-500 w-5 h-5" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 448 512">
                                    <path
                                        d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z" />
                                </svg>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
</template>