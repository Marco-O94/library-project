<script setup lang="ts">
import { reactive } from 'vue';
import { RegisterData } from '../interfaces/FormData';
import { UserStore } from '../stores/UserStore';
import  ErrorField from '../components/ErrorField.vue';


const registerData = reactive<RegisterData>({
  name: '',
  email: '',
  password: '',
  password_confirmation: '',
});

const userStore = UserStore();



</script>

<template>
        <section>
            <div class="px-6 h-full">
              <div class="flex justify-center items-center flex-wrap h-full g-6 text-gray-800">
                <div class="md:w-8/12 lg:w-6/12 mb-12 md:mb-0">
                  <img
                    src="../assets/images/loginImage.png"
                    class="w-full"
                    alt="Phone image"
                  />
                </div>
                <div class="md:w-8/12 lg:w-5/12 lg:ml-20">
                  <div class="grid grid-cols-1 md:grid-cols-4 gap-4 align-middle items-center mb-8">
                  <div class="link-grow inline-block col-span-1">
                  <router-link  to="login"><svg class="inline-block mr-3 w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                    <path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z"/></svg>
                  Login
                  </router-link>
                </div>
                    <h1 class="text-4xl font-bold col-span-3">Registrati</h1>
                  </div>
                  <form @submit.prevent="userStore.registerRequest(registerData)">
                    <!-- Email input -->
                    <div class="mb-6">
                      <input v-model="registerData.name"
                        type="text"
                        class="form-control block w-full px-4 py-2 text-xl font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                        placeholder="Nome completo"
                      />
                      <ErrorField v-if="userStore.errors.name" :errors="userStore.errors.name" /> 
                    </div>
                    <div class="mb-6">
                      <input v-model="registerData.email"
                        type="email"
                        class="form-control block w-full px-4 py-2 text-xl font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                        placeholder="Indirizzo Email"
                      />
                    </div>
                    <ErrorField v-if="userStore.errors.email" :errors="userStore.errors.email" />
                    
                    <!-- Password input -->
                    <div class="mb-6">
                      <input v-model="registerData.password"
                        type="password"
                        class="form-control block w-full px-4 py-2 text-xl font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                        placeholder="Password"
                      />
                      <ErrorField v-if="userStore.errors.password" :errors="userStore.errors.password" />
                    </div>
                    <div class="mb-6">
                      <input v-model="registerData.password_confirmation"
                        type="password"
                        class="form-control block w-full px-4 py-2 text-xl font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                        placeholder="Conferma la password"
                      />
                    </div>
                    <ErrorField v-if="userStore.errors.password_confirmation" :errors="userStore.errors.password_confirmation" />
          
          
                    <!-- Submit button -->
                    <button v-if="(registerData.name && registerData.email && registerData.password && registerData.password_confirmation && registerData.password === registerData.password_confirmation)"
                      type="submit"
                      class="inline-block px-7 py-3 bg-blue-600 text-white font-medium text-sm leading-snug uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out w-full"
                      data-mdb-ripple="true"
                      data-mdb-ripple-color="light"
                    >
                      Registrati
                    </button>
                    <button v-else
                      disabled
                      class="inline-block px-7 py-3 bg-gray-600 text-white font-medium text-sm leading-snug uppercase rounded shadow-md  hover:shadow-lg focus:outline-none focus:ring-0  active:shadow-lg transition duration-150 ease-in-out w-full"
                      data-mdb-ripple="true"
                      data-mdb-ripple-color="light"
                    >
                      Registrati
                    </button>
                    
                  </form>
                </div>
              </div>
            </div>
          </section>
    </template>
    <style>
  .link-grow:hover {
    animation: grow 0.5s ease-in-out;
  }

  @keyframes grow {
    0% {
      transform: scale(1);
    }
    50% {
      transform: scale(1.1);
    }
    100% {
      transform: scale(1);
    }
  }
  </style>

