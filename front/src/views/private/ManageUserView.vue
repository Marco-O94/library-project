<script setup lang="ts">
import { UserStore } from '@/stores/UserStore';
import { computed } from 'vue';
import LoadingButton from '@/components/LoadingButton.vue';
import { useRoute } from 'vue-router';
const route = useRoute();
const userStore = UserStore();


// eslint-disable-next-line @typescript-eslint/no-explicit-any
const onFileInput = (event: { target: { files: any[]; }; }) => {
    let formData = new FormData();
    formData.append('userpic', event.target.files[0]);
    userStore.changeImage(formData);
    return void 0;
};

userStore.getUser(parseInt(route.params.id[0]));

/* 😍 Finally I found solution in Composition Api Style 😍 */
const userForm = computed(() => {
    return {
        id: parseInt(route.params.id[0]),
        name: userStore.anotherUser.name,
        email: userStore.anotherUser.email,
        image: userStore.anotherUser.image_path,
    };
});
</script>
<template>
        <h1 class="font-bold text-4xl mb-5">Modifica i tuoi dati</h1>
        <div class="grid grid-cols-1 md:grid-cols-3 mt-6 mb-10 items-center">
            <div class="col-span-1">
            <img class="w-28 h-28 rounded-full" v-if="userStore.user.image_path" :src="userStore.user.image_path" />
            <img v-else class="w-28 h-28 rounded-full" src="@/assets/images/guest_avatar.png" />
        </div>
            <div class="mb-3 w-auto col-span-2">
                <label for="formFile" class="form-label inline-block mb-2 text-gray-700">Modifica la tua foto profilo</label>
                <input type="file" ref="inputFile" label="Image" @change="onFileInput" class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded  transition ease-in-out m-0focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" />

                </div>
        </div>
        <form @submit.prevent="UserStore().editUser(userForm as unknown as FormData)">
        <div class="grid grid-cols-2 gap-10">
                <div>
                    <!-- Input Name -->
                    <label for="name" class="form-label inline-block mb-2 text-gray-700">Nome</label>
                    <input v-model="userForm.name" type="text" class=" form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none
                      " id="name" placeholder="Inserisci qui il tuo nome" />
                </div>
                <div>
                    <label for="exampleEmail0" class="form-label inline-block mb-2 text-gray-700"
                    >Indirizzo Email</label>
                    <input 
                    v-model="userForm.email"
                    type="email"
                    class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                    id="email"
                    placeholder="Inserisci la tua email"/>
                </div>
            
        </div>
        <!-- Button Group -->
        <LoadingButton text="Salva" />
    </form>
</template>