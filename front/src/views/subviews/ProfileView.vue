<script setup lang="ts">
import { UserStore } from '../../stores/UserStore';
const userStore = UserStore();

// eslint-disable-next-line @typescript-eslint/no-explicit-any
const onFileInput = (event: { target: { files: any[]; }; }) => {
    let data = event.target.files[0];
    userStore.changeImage(userStore.user.id, data);
    return void 0;
};
</script>
<template>
        <h1 class="font-bold text-4xl mb-5">Modifica i tuoi dati</h1>
        <div class="grid grid-cols-1 md:grid-cols-3 mb-5 mt-6 mb-10">
            <div class="col-span-1">
            <img class="w-20 h-20 rounded-full" v-if="userStore.user.image_path" :src="userStore.user.image_path" />
            <img v-else class="w-28 h-28 rounded-full" src="../../assets/images/guest_avatar.png" />
        </div>
            <div class="mb-3 w-auto col-span-2">
                <label for="formFile" class="form-label inline-block mb-2 text-gray-700">Modifica la tua foto profilo</label>
                <input type="file" ref="inputFile" label="Image" @change="onFileInput" class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded  transition ease-in-out m-0focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" />

                </div>
        </div>
        <form>
        <div class="grid grid-cols-2 gap-10">
                <div>
                    <!-- Input Name -->
                    <label for="name" class="form-label inline-block mb-2 text-gray-700">Nome</label>
                    <input type="text" class=" form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none
                      " id="name" placeholder="Text input" />
                </div>
                <div>
                    <label for="exampleEmail0" class="form-label inline-block mb-2 text-gray-700"
                    >Email input</label>
                    <input 
                    type="email"
                    class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                    id="email"
                    placeholder="Inserisci la tua email"/>
                </div>
            
        </div>
    </form>
</template>