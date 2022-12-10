<script setup lang="ts">
import { reactive } from 'vue';
import { LoginData } from '@/interfaces/FormData';
import ErrorField from '@/components/ErrorField.vue';
import { UserStore } from '@/stores/UserStore';
import { GeneralStore } from '@/stores/GeneralStore';
const userStore = UserStore();
const generalStore = GeneralStore();

const loginData = reactive<LoginData>({
  email: '',
  password: '',
  remember: false,
});

</script>
<template>
    <section>
        <div class=" px-6 h-full">
          <div class="flex justify-center items-center flex-wrap h-full g-6 text-gray-800">
            <div class="md:w-8/12 lg:w-6/12 mb-12 md:mb-0">
              <img
                src="@/assets/images/loginImage.png"
                class="w-full"
                alt="Phone image"
              />
            </div>
            <div class="w-10/12 lg:w-5/12 lg:ml-20">
                <h1 class="text-4xl font-bold mb-8">Login</h1>
              <form @submit.prevent="userStore.loginRequest(loginData)">
                <!-- Email input -->
                <div class="mb-6">
                  <input v-model="loginData.email"
                    type="text"
                    class="form-control block w-full px-4 py-2 text-xl font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                    placeholder="Indirizzo Email"
                  />
                  <ErrorField v-if="generalStore.errors.email" :errors="generalStore.errors.email" />
                </div>
      
                <!-- Password input -->
                <div class="mb-6">
                  <input v-model="loginData.password"
                    type="password"
                    class="form-control block w-full px-4 py-2 text-xl font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                    placeholder="Password"
                  />
                </div>
      
                <div class="flex justify-between items-center mb-6">
                  <div class="form-group form-check">
                    <input v-model="loginData.remember"
                      type="checkbox"
                      class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                      id="remember"
                      
                    />
                    <label class="form-check-label inline-block text-gray-800" for="exampleCheck2"
                      >Mantieni l'accesso</label
                    >
                  </div>
                  <a
                    href="#!"
                    class="text-blue-600 hover:text-blue-700 focus:text-blue-700 active:text-blue-800 duration-200 transition ease-in-out"
                    >Password dimenticata?</a
                  >
                  <ErrorField v-if="generalStore.errors.password" :errors="generalStore.errors.password" />
                </div>
      
                <!-- Submit button -->
                <button
                  type="submit"
                  class="inline-block px-7 py-3 bg-blue-600 text-white font-medium text-sm leading-snug uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out w-full"
                  data-mdb-ripple="true"
                  data-mdb-ripple-color="light"
                >
                  Accedi
                </button>
                <div class="text-gray-800 mt-3 mb-4 text-left">Non hai un account? <router-link :to="{name: 'register'}" class="text-blue-600 hover:text-blue-400">Registrati</router-link></div>
              </form>
              <ErrorField v-if="generalStore.errors.message" :errors="generalStore.errors.message" />
              
            </div>
            
          </div>
        </div>
      </section>
</template>