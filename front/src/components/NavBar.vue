<script setup lang="ts">
import { UserStore } from '../stores/UserStore';
const userStore = UserStore();
</script>

<template>
  <nav class="bg-secondary opacity-90 border-gray-200 px-2 sm:px-4 py-3 sticky top-0 z-50">
    <div class="md:container flex flex-wrap items-center justify-between mx-auto">
      <router-link :to="{name: 'home'}" class="flex items-center">
        <svg viewBox="0 0 320 88.820068359375" class="logo">
          <defs id="SvgjsDefs1168"></defs>
          <g id="SvgjsG1169" featurekey="odWo6G-0" transform="matrix(1,0,0,1,0,-5.589931011199951)" class="logo-book">
            <g xmlns="http://www.w3.org/2000/svg">
              <path
                d="M98.178,20.699c0-4.862,1.822-11.412,1.822-11.412L48.634,5.748c-3.34-0.572-6.323,0.442-8.291,2.498h0   c0,0-37.437,37.688-37.636,37.906l-0.01,0.011c0.001-0.001,0.002-0.002,0.003-0.003C1.008,48.019,0,50.534,0,53.383   c0,3.173,1.22,6.35,3.436,8.945c0.484,0.568,1.007,1.091,1.558,1.572c-1.415,1.456-2.257,2.324-2.287,2.356l-0.01,0.01   c0.001-0.001,0.002-0.001,0.003-0.002C1.008,68.122,0,70.638,0,73.487c0,3.173,1.22,6.35,3.436,8.945   c2.209,2.589,5.165,4.312,8.322,4.854l57.723,7.124L100,47.607c0,0-1.822-2.741-1.822-7.604s1.822-11.7,1.822-11.7   S98.178,25.562,98.178,20.699z M44.189,13.452l40.27,3.953l-1.519,2.338l-40.635-4.022L44.189,13.452z M39.125,19.488l40.707,4.286   l-1.52,2.338l-41.188-4.287L39.125,19.488z M67.008,89.503l-54.568-6.259c-4.601-0.795-8.341-5.169-8.341-9.757   c0-3.786,2.588-6.431,6.294-6.431c1.436,0,56.615,7.726,56.615,7.726V89.503z M67.008,70.199l-54.568-7.059   c-4.601-0.796-8.341-5.17-8.341-9.758c0-3.786,2.588-6.431,6.294-6.431c0.403,0,47.679,6.609,56.615,7.859V70.199z M69.467,86.982   V75.121L95.397,35.36c-0.462,1.571-1.04,4.146-0.795,6.609c0.256,2.572,1.299,4.344,1.299,4.344L69.467,86.982z M94.603,22.666   c0.256,2.572,1.299,4.344,1.299,4.344L69.467,67.678V53.525l26.435-38.971C95.901,14.555,94.213,18.752,94.603,22.666z">
              </path>
            </g>
          </g>
          <g id="SvgjsG1170" featurekey="VGK2BT-0"
            transform="matrix(2.0236908875162625,0,0,2.0236908875162625,117.77092323485766,12.966702015484776)"
            class="logo-text">
            <path
              d="M9.322 18.1525 c0.15238 0 0.27102 0.10169 0.27102 0.28814 l0 1.2881 c0 0.15238 -0.11881 0.27102 -0.27119 0.27102 l-8 0 c-0.15254 0 -0.22034 -0.11864 -0.22034 -0.27102 l0 -13.017 c0 -0.15254 0.10169 -0.27119 0.27136 -0.27119 l1.3729 0 c0.15254 0 0.27119 0.11864 0.27119 0.27119 l0 11.441 l6.3051 0 z M12.72862372881356 8.492 c-0.55915 0 -1.0168 -0.44068 -1.0168 -1.0169 c0 -0.55932 0.45763 -1.0169 1.0168 -1.0169 c0.55932 0 1.0169 0.45763 1.0169 1.0169 c0 0.57627 -0.45763 1.0169 -1.0169 1.0169 z M13.389623728813559 11.6102 l-1.3051 0 c-0.16949 0 -0.27119 0.11881 -0.27119 0.27119 l0 7.4407 c0 0.38983 0.23729 0.6778 0.64407 0.6778 l0.94915 0 c0.15254 0 0.25424 -0.10153 0.25424 -0.28797 l0 -7.8305 c0 -0.15238 -0.11864 -0.27119 -0.27119 -0.27119 z M20.33885084745763 11.5256 c1.9831 0 3.8812 1.6273 3.8812 4.1697 c0 2.4746 -1.5424 4.4064 -3.9322 4.4064 c-0.91525 0 -1.6949 -0.30475 -2.3049 -0.72847 c-0.084746 0.40678 -0.54237 0.62695 -0.88136 0.62695 l-0.67797 0 c-0.15254 0 -0.27119 -0.11864 -0.27119 -0.27102 l0 -11.831 c0 -0.52542 -0.084746 -0.79661 -0.13559 -1.1017 c-0.033732 -0.18661 0.017115 -0.3561 0.18661 -0.3561 l1.1525 0 c0.38983 0 0.64407 0.25424 0.64407 0.61017 l0 5.1356 c0.57627 -0.35593 1.3219 -0.66102 2.3388 -0.66102 z M19.99965084745763 18.3903 c1.3729 0 2.4068 -1.0169 2.4068 -2.6949 c0 -1.7288 -1.2712 -2.4576 -2.339 -2.4576 c-0.76271 0 -1.4576 0.27119 -2.0678 0.66102 l0 3.9322 c0.54237 0.30508 1.1864 0.55932 2 0.55932 z M32.01679661016949 12.034099999999999 c0.18644 0.11864 0.23729 0.22017 0.11848 0.40661 l-0.69475 1.0169 c-0.084746 0.11864 -0.20339 0.15254 -0.35593 0.11864 c-0.35593 -0.16949 -0.66102 -0.32203 -1.2203 -0.32203 s-1.4407 0.23729 -1.9153 1.2881 l0 5.1866 c0 0.15238 -0.10169 0.27102 -0.25424 0.27102 l-1.339 0 c-0.15254 0 -0.25424 -0.11864 -0.25424 -0.27102 l0 -7.8476 c0 -0.15238 0.11864 -0.27119 0.25424 -0.27119 l0.9322 0 c0.40678 0 0.66102 0.42373 0.66102 0.72881 l0 0.11881 c0.59322 -0.54237 1.3051 -0.91525 2.2373 -0.91525 c0.86441 0 1.5085 0.27119 1.8305 0.49153 z M40.6777779661017 19.62712 c-0.22034 -1.661 -0.2368 -3.2032 -0.16916 -4.8302 c0.084746 -2 -1.0169 -3.2881 -3.0847 -3.2881 c-1.3559 0 -2.7627 0.40678 -3.5932 0.86441 c-0.15254 0.084746 -0.25424 0.23712 -0.18644 0.38966 l0.42373 0.98305 c0.067797 0.16949 0.18644 0.22034 0.40678 0.11864 c1.0847 -0.49153 1.9661 -0.72881 2.8305 -0.72881 c0.91525 0 1.4576 0.35593 1.4237 1.322 c-3.1356 0.5422 -5.5254 1.1015 -5.5254 3.3049 c0 1.4746 1.0678 2.3219 2.7966 2.3219 c1.4408 0 2.1864 -0.44051 2.8983 -0.98288 c0.08458 0.50847 0.23712 0.89831 0.5761 0.89831 l1.0169 0 c0.15238 0 0.20322 -0.18644 0.18627 -0.37288 z M36.322177966101705 18.627299999999998 c-0.69492 0 -1.2373 -0.23729 -1.2373 -0.88136 c0 -1.0339 1.8981 -1.3729 3.6102 -1.7288 c-0.016949 0.55932 -0.016949 1.3051 0 1.7966 c-0.55932 0.42373 -1.5085 0.81356 -2.3729 0.81356 z M48.55916949152543 12.034099999999999 c0.18644 0.11864 0.23729 0.22017 0.11848 0.40661 l-0.69475 1.0169 c-0.084746 0.11864 -0.20339 0.15254 -0.35593 0.11864 c-0.35593 -0.16949 -0.66102 -0.32203 -1.2203 -0.32203 s-1.4407 0.23729 -1.9153 1.2881 l0 5.1866 c0 0.15238 -0.10169 0.27102 -0.25424 0.27102 l-1.339 0 c-0.15254 0 -0.25424 -0.11864 -0.25424 -0.27102 l0 -7.8476 c0 -0.15238 0.11864 -0.27119 0.25424 -0.27119 l0.9322 0 c0.40678 0 0.66102 0.42373 0.66102 0.72881 l0 0.11881 c0.59322 -0.54237 1.3051 -0.91525 2.2373 -0.91525 c0.86441 0 1.5085 0.27119 1.8305 0.49153 z M58.57622711864408 11.6102 c0.20339 0 0.30525 0.13543 0.20356 0.32203 l-3.3559 6.8983 c-1.678 3.4914 -3.1525 5.5083 -3.9492 6.288 c-0.15254 0.13559 -0.33898 0.067797 -0.50847 -0.10169 l-0.72881 -0.72881 c-0.18644 -0.16949 -0.15254 -0.33898 0.016949 -0.54237 c1.0339 -1.1695 2.3729 -3.1017 3.2373 -5.0507 l-3.5254 -6.7797 c-0.084746 -0.16949 0 -0.30508 0.18644 -0.30508 l1.4915 0 c0.15238 0 0.23712 0.067797 0.30492 0.18661 l2.4915 5.0846 l2.3729 -5.0678 c0.067797 -0.13559 0.16949 -0.20339 0.32203 -0.20339 l1.4407 0 z M67.7118372881356 12.7798 c1.4068 0.64407 2.2881 1.9324 2.2881 3.4408 c0 2.2373 -1.9661 3.7795 -4.0508 3.7795 l-5.4746 0 c-0.16949 0 -0.28814 -0.11864 -0.28814 -0.28814 l0 -13 c0 -0.15254 0.10169 -0.27119 0.27119 -0.27119 l5.051 0 c2.1524 0 3.7625 1.8814 3.7625 3.5763 c0 1.2373 -0.66102 2.2034 -1.5593 2.7627 z M65.1356372881356 12.2207 c2.8136 0 2.8644 -3.9322 0.033898 -3.9322 l-3.0678 0 l0 3.9322 l3.0339 0 z M65.5084372881356 18.1529 c3.322 0 3.339 -4.1356 -0.033898 -4.1356 l-3.3729 0 l0.016949 4.1356 l3.3898 0 z M75.91510508474578 20.11864 c2.3729 0 4.339 -1.8812 4.339 -4.3049 c0 -2.4746 -1.9661 -4.322 -4.339 -4.322 s-4.339 1.8475 -4.339 4.322 c0 2.4237 1.9661 4.3049 4.339 4.3049 z M75.91510508474578 18.39 c-1.4576 0 -2.5424 -1.2034 -2.5424 -2.5593 c0 -1.4068 1.0847 -2.6102 2.5424 -2.6102 s2.5424 1.2034 2.5424 2.6102 c0 1.3559 -1.0847 2.5593 -2.5424 2.5593 z M85.83035932203391 20.11864 c2.3729 0 4.339 -1.8812 4.339 -4.3049 c0 -2.4746 -1.9661 -4.322 -4.339 -4.322 s-4.339 1.8475 -4.339 4.322 c0 2.4237 1.9661 4.3049 4.339 4.3049 z M85.83035932203391 18.39 c-1.4576 0 -2.5424 -1.2034 -2.5424 -2.5593 c0 -1.4068 1.0847 -2.6102 2.5424 -2.6102 s2.5424 1.2034 2.5424 2.6102 c0 1.3559 -1.0847 2.5593 -2.5424 2.5593 z M99.81335762711866 19.44085 c0.22034 0.23729 0.11848 0.54271 -0.20356 0.54271 l-1.3729 0 c-0.15254 0 -0.23729 -0.033898 -0.33898 -0.15254 l-4.0339 -4.0339 l0 3.9322 c0 0.15238 -0.11864 0.27102 -0.27119 0.27102 l-1.2881 0 c-0.16949 0 -0.28814 -0.11864 -0.28814 -0.27102 l0 -11.848 c0 -0.57627 -0.084746 -0.83051 -0.13559 -1.0847 c-0.033732 -0.18661 0.017115 -0.3561 0.18661 -0.3561 l1.1525 0 c0.38983 0 0.64407 0.25424 0.64407 0.61017 l0 8.2881 l3.4068 -3.5932 c0.10169 -0.10169 0.20339 -0.13559 0.32203 -0.13559 l1.3559 0 c0.27119 0 0.42373 0.33898 0.22034 0.55932 l-3.339 3.4068 z">
            </path>
          </g>
        </svg>
      </router-link>
      <div class="grid grid-cols-2 gap-4 items-center">
        <div v-if="userStore.isLogged" class="grid grid-cols-2 gap-3">
          <router-link class="w-5 h-auto fill-white" :to="{name: 'dashboard'}">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
              <path
                d="M224 256c70.7 0 128-57.3 128-128S294.7 0 224 0S96 57.3 96 128s57.3 128 128 128zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z" />
            </svg>
          </router-link>
          <button @click="userStore.logout" class="w-5 h-auto fill-white">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
              <path
                d="M160 96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96C43 32 0 75 0 128V384c0 53 43 96 96 96h64c17.7 0 32-14.3 32-32s-14.3-32-32-32H96c-17.7 0-32-14.3-32-32l0-256c0-17.7 14.3-32 32-32h64zM504.5 273.4c4.8-4.5 7.5-10.8 7.5-17.4s-2.7-12.9-7.5-17.4l-144-136c-7-6.6-17.2-8.4-26-4.6s-14.5 12.5-14.5 22v72H192c-17.7 0-32 14.3-32 32l0 64c0 17.7 14.3 32 32 32H320v72c0 9.6 5.7 18.2 14.5 22s19 2 26-4.6l144-136z" />
            </svg>
          </button>
        </div>
        <router-link v-else :to="{name: 'login'}">
          <svg class="w-5 h-auto fill-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
            <path
              d="M352 96h64c17.7 0 32 14.3 32 32V384c0 17.7-14.3 32-32 32H352c-17.7 0-32 14.3-32 32s14.3 32 32 32h64c53 0 96-43 96-96V128c0-53-43-96-96-96H352c-17.7 0-32 14.3-32 32s14.3 32 32 32zm-7.5 177.4c4.8-4.5 7.5-10.8 7.5-17.4s-2.7-12.9-7.5-17.4l-144-136c-7-6.6-17.2-8.4-26-4.6s-14.5 12.5-14.5 22v72H32c-17.7 0-32 14.3-32 32v64c0 17.7 14.3 32 32 32H160v72c0 9.6 5.7 18.2 14.5 22s19 2 26-4.6l144-136z" />
          </svg>
        </router-link>
        <button type="button" data-bs-toggle="offcanvas" data-bs-target="#drawerMenu"
          class="flex mr-3 text-sm rounded-sm md:mr-0" id="user-menu-button" aria-expanded="false"
          data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
          <svg class="w-5 h-auto fill-white hover:fill-primary" xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 448 512">
            <path
              d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z" />
          </svg>
        </button>
      </div>
    </div>
  </nav>
  <div
    class="offcanvas offcanvas-start fixed bottom-0 flex flex-col max-w-full bg-white invisible bg-clip-padding shadow-sm outline-none transition duration-300 ease-in-out text-gray-700 top-0 left-0 border-none w-96"
    tabindex="-1" id="drawerMenu" aria-labelledby="drawerMenuLabel">
    <div class="offcanvas-header flex items-center justify-between p-4 mt-4">
      <button type="button"
        class="btn-close box-content w-4 h-4 p-2 -my-5 -mr-2 text-black border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:text-black hover:opacity-75 hover:no-underline"
        data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body overflow-y-auto">
      <div class="pt-4 pb-2 px-6" v-if="userStore.isLogged">
        <router-link :to="{name: 'dashboard'}">
          <div class="flex items-center">
            <div class="shrink-0">
              <img v-if="userStore.user.image_path" :src="userStore.user.image_path" class="rounded-full w-10"
                alt="Avatar">
              <img v-else src="../assets/images/guest_avatar.png" class="rounded-full w-10" alt="Avatar">
            </div>
            <div class="grow ml-3">
              <p class="text-sm font-semibold text-blue-600">{{ userStore.user.name }}</p>

            </div>
          </div>
        </router-link>
      </div>
      <ul class="relative px-1">
        <li class="relative">
          <router-link
            class="flex items-center text-sm py-4 px-6 h-12 overflow-hidden text-gray-700 text-ellipsis whitespace-nowrap rounded hover:text-blue-600 hover:bg-blue-50 transition duration-300 ease-in-out"
            :to="{name: 'home'}" data-mdb-ripple="true" data-mdb-ripple-color="primary">
            <svg aria-hidden="true" focusable="false" data-prefix="fas" class="w-3 h-3 mr-3" role="img"
              xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
              <path
                d="M575.8 255.5c0 18-15 32.1-32 32.1h-32l.7 160.2c0 2.7-.2 5.4-.5 8.1V472c0 22.1-17.9 40-40 40H456c-1.1 0-2.2 0-3.3-.1c-1.4 .1-2.8 .1-4.2 .1H416 392c-22.1 0-40-17.9-40-40V448 384c0-17.7-14.3-32-32-32H256c-17.7 0-32 14.3-32 32v64 24c0 22.1-17.9 40-40 40H160 128.1c-1.5 0-3-.1-4.5-.2c-1.2 .1-2.4 .2-3.6 .2H104c-22.1 0-40-17.9-40-40V360c0-.9 0-1.9 .1-2.8V287.6H32c-18 0-32-14-32-32.1c0-9 3-17 10-24L266.4 8c7-7 15-8 22-8s15 2 21 7L564.8 231.5c8 7 12 15 11 24z" />
            </svg>

            <span>Home</span>
          </router-link>
        </li>
        <li class="relative">
          <router-link
            class="flex items-center text-sm py-4 px-6 h-12 overflow-hidden text-gray-700 text-ellipsis whitespace-nowrap rounded hover:text-blue-600 hover:bg-blue-50 transition duration-300 ease-in-out"
            :to="{name: 'books'}" data-mdb-ripple="true" data-mdb-ripple-color="primary">
            <svg aria-hidden="true" focusable="false" data-prefix="fas" class="w-3 h-3 mr-3" role="img"
              xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
              <path
                d="M96 0C43 0 0 43 0 96V416c0 53 43 96 96 96H384h32c17.7 0 32-14.3 32-32s-14.3-32-32-32V384c17.7 0 32-14.3 32-32V32c0-17.7-14.3-32-32-32H384 96zm0 384H352v64H96c-17.7 0-32-14.3-32-32s14.3-32 32-32zm32-240c0-8.8 7.2-16 16-16H336c8.8 0 16 7.2 16 16s-7.2 16-16 16H144c-8.8 0-16-7.2-16-16zm16 48H336c8.8 0 16 7.2 16 16s-7.2 16-16 16H144c-8.8 0-16-7.2-16-16s7.2-16 16-16z" />
            </svg>
            <span>Catalogo libri</span>
          </router-link>
        </li>

        <li v-if="userStore.isLogged" class="relative">
          <a class="flex items-center text-sm py-4 px-6 h-12 overflow-hidden text-gray-700 text-ellipsis whitespace-nowrap rounded hover:text-blue-600 hover:bg-blue-50 transition duration-300 ease-in-out cursor-pointer"
            data-mdb-ripple="true" data-mdb-ripple-color="primary" data-bs-toggle="collapse"
            data-bs-target="#collapsePannello" aria-expanded="false" aria-controls="collapsePannello">
            <svg aria-hidden="true" focusable="false" data-prefix="fas" class="w-3 h-3 mr-3" role="img"
              xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
              <path fill="currentColor"
                d="M496 384H64V80c0-8.84-7.16-16-16-16H16C7.16 64 0 71.16 0 80v336c0 17.67 14.33 32 32 32h464c8.84 0 16-7.16 16-16v-32c0-8.84-7.16-16-16-16zM464 96H345.94c-21.38 0-32.09 25.85-16.97 40.97l32.4 32.4L288 242.75l-73.37-73.37c-12.5-12.5-32.76-12.5-45.25 0l-68.69 68.69c-6.25 6.25-6.25 16.38 0 22.63l22.62 22.62c6.25 6.25 16.38 6.25 22.63 0L192 237.25l73.37 73.37c12.5 12.5 32.76 12.5 45.25 0l96-96 32.4 32.4c15.12 15.12 40.97 4.41 40.97-16.97V112c.01-8.84-7.15-16-15.99-16z">
              </path>
            </svg>
            <span>Pannello</span>
            <svg aria-hidden="true" focusable="false" data-prefix="fas" class="w-3 h-3 ml-auto" role="img"
              xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
              <path fill="currentColor"
                d="M207.029 381.476L12.686 187.132c-9.373-9.373-9.373-24.569 0-33.941l22.667-22.667c9.357-9.357 24.522-9.375 33.901-.04L224 284.505l154.745-154.021c9.379-9.335 24.544-9.317 33.901.04l22.667 22.667c9.373 9.373 9.373 24.569 0 33.941L240.971 381.476c-9.373 9.372-24.569 9.372-33.942 0z">
              </path>
            </svg>
          </a>
          <ul class="relative accordion-collapse collapse" id="collapsePannello" aria-labelledby="sidenavXxEx3"
            data-bs-parent="#sidenavSecExample">
            <li class="relative">
              <router-link :to="{name: 'dashboard'}"
                class="flex items-center text-xs py-4 pl-12 pr-6 h-6 overflow-hidden text-gray-700 text-ellipsis whitespace-nowrap rounded hover:text-blue-600 hover:bg-blue-50 transition duration-300 ease-in-out"
                data-mdb-ripple="true" data-mdb-ripple-color="primary">Dashboard</router-link>
            </li>
            <li class="relative">
              <router-link :to="{name: 'profile'}"
                class="flex items-center text-xs py-4 pl-12 pr-6 h-6 overflow-hidden text-gray-700 text-ellipsis whitespace-nowrap rounded hover:text-blue-600 hover:bg-blue-50 transition duration-300 ease-in-out"
                data-mdb-ripple="true" data-mdb-ripple-color="primary">Profilo</router-link>
            </li>

          </ul>
        </li>
        <li v-if="userStore.user.role_id === 1" class="relative">
          <a class="flex items-center text-sm py-4 px-6 h-12 overflow-hidden text-gray-700 text-ellipsis whitespace-nowrap rounded hover:text-blue-600 hover:bg-blue-50 transition duration-300 ease-in-out cursor-pointer"
            data-mdb-ripple="true" data-mdb-ripple-color="primary" data-bs-toggle="collapse"
            data-bs-target="#collapseGestione" aria-expanded="false" aria-controls="collapseGestione">
            <svg aria-hidden="true" focusable="false" data-prefix="fas" class="w-3 h-3 mr-3" role="img"
              xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
              <path fill="currentColor"
                d="M496 384H64V80c0-8.84-7.16-16-16-16H16C7.16 64 0 71.16 0 80v336c0 17.67 14.33 32 32 32h464c8.84 0 16-7.16 16-16v-32c0-8.84-7.16-16-16-16zM464 96H345.94c-21.38 0-32.09 25.85-16.97 40.97l32.4 32.4L288 242.75l-73.37-73.37c-12.5-12.5-32.76-12.5-45.25 0l-68.69 68.69c-6.25 6.25-6.25 16.38 0 22.63l22.62 22.62c6.25 6.25 16.38 6.25 22.63 0L192 237.25l73.37 73.37c12.5 12.5 32.76 12.5 45.25 0l96-96 32.4 32.4c15.12 15.12 40.97 4.41 40.97-16.97V112c.01-8.84-7.15-16-15.99-16z">
              </path>
            </svg>
            <span>Gestione</span>
            <svg aria-hidden="true" focusable="false" data-prefix="fas" class="w-3 h-3 ml-auto" role="img"
              xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
              <path fill="currentColor"
                d="M207.029 381.476L12.686 187.132c-9.373-9.373-9.373-24.569 0-33.941l22.667-22.667c9.357-9.357 24.522-9.375 33.901-.04L224 284.505l154.745-154.021c9.379-9.335 24.544-9.317 33.901.04l22.667 22.667c9.373 9.373 9.373 24.569 0 33.941L240.971 381.476c-9.373 9.372-24.569 9.372-33.942 0z">
              </path>
            </svg>
          </a>
          <ul class="relative accordion-collapse collapse" id="collapseGestione" aria-labelledby="sidenavXxEx3"
            data-bs-parent="#sidenavSecExample">
            <li class="relative">
              <router-link :to="{name: 'managebooks'}"
                class="flex items-center text-xs py-4 pl-12 pr-6 h-6 overflow-hidden text-gray-700 text-ellipsis whitespace-nowrap rounded hover:text-blue-600 hover:bg-blue-50 transition duration-300 ease-in-out"
                data-mdb-ripple="true" data-mdb-ripple-color="primary">Libri</router-link>
            </li>
            <li class="relative">
              <router-link :to="{name: 'manageusers'}"
                class="flex items-center text-xs py-4 pl-12 pr-6 h-6 overflow-hidden text-gray-700 text-ellipsis whitespace-nowrap rounded hover:text-blue-600 hover:bg-blue-50 transition duration-300 ease-in-out"
                data-mdb-ripple="true" data-mdb-ripple-color="primary">Utenti</router-link>
            </li>
            <li class="relative">
              <a href="#!"
                class="flex items-center text-xs py-4 pl-12 pr-6 h-6 overflow-hidden text-gray-700 text-ellipsis whitespace-nowrap rounded hover:text-blue-600 hover:bg-blue-50 transition duration-300 ease-in-out"
                data-mdb-ripple="true" data-mdb-ripple-color="primary">Prestiti</a>
            </li>
          </ul>
        </li>

      </ul>
      <hr class="my-2">
      <ul class="relative px-1">
        <li v-if="!userStore.isLogged" class="relative">
          <router-link
            class="flex items-center text-sm py-4 px-6 h-12 overflow-hidden text-gray-700 text-ellipsis whitespace-nowrap rounded hover:text-blue-600 hover:bg-blue-50 transition duration-300 ease-in-out"
            :to="{name: 'login'}" data-mdb-ripple="true" data-mdb-ripple-color="primary">
            <svg aria-hidden="true" focusable="false" data-prefix="fas" class="w-3 h-3 mr-3" role="img"
              xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
              <path
                d="M96 0C43 0 0 43 0 96V416c0 53 43 96 96 96H384h32c17.7 0 32-14.3 32-32s-14.3-32-32-32V384c17.7 0 32-14.3 32-32V32c0-17.7-14.3-32-32-32H384 96zm0 384H352v64H96c-17.7 0-32-14.3-32-32s14.3-32 32-32zm32-240c0-8.8 7.2-16 16-16H336c8.8 0 16 7.2 16 16s-7.2 16-16 16H144c-8.8 0-16-7.2-16-16zm16 48H336c8.8 0 16 7.2 16 16s-7.2 16-16 16H144c-8.8 0-16-7.2-16-16s7.2-16 16-16z" />
            </svg>
            <span>Accedi</span>
          </router-link>
        </li>
        <li v-else class="relative">
          <a @click="userStore.logout"
            class="flex items-center text-xs py-4 pl-12 pr-6 h-6 overflow-hidden text-gray-700 text-ellipsis whitespace-nowrap rounded hover:text-blue-600 hover:bg-blue-50 transition duration-300 ease-in-out cursor-pointer"
            data-mdb-ripple="true" data-mdb-ripple-color="primary">Esci</a>
        </li>
      </ul>
    </div>
  </div>

</template>