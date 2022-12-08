<script setup lang="ts">
import { defineProps } from 'vue';

const props = defineProps<{
    title: string;
    link: string;
    icon: number;
}>();

const icons = [
    "https://cdn-icons-png.flaticon.com/512/3038/3038168.png",
    "https://cdn-icons-png.flaticon.com/512/8750/8750683.png",
    "https://cdn-icons-png.flaticon.com/512/2158/2158509.png"
 ];

</script>

<template>
        <div class="rounded-lg shadow-lg bg-white max-w-sm mx-auto pt-8 pb-2 text-center">
          <router-link :to="{name: props.link}">
            <div class="p-3 relative w-full generic_box">
              <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                        x="0px" y="0px" viewBox="0 0 80 80" xml:space="preserve">
                        <circle class="cr" cx="40" cy="40" r="36" fill="transparent" stroke="#3093f1" />
                    </svg>
            <img class="my-auto mx-auto w-20 h-auto" :src="icons[props.icon]" alt=""/>
        </div>
          <div class="p-6">
            <h5 class="text-gray-900 text-xl font-medium mb-2">{{props.title}}</h5>
          </div>
        </router-link>
        </div>
</template>
<style>
.generic_box:hover svg circle {
  stroke-dasharray: 230;
  stroke-dashoffset: 0;
  stroke-width: 0;
  animation-name: rotate;
  animation-duration: 1.5s;
  /* Da qui regoli la velocità */
  animation-timing-function: cubic-bezier(0.7, 0.05, 0.36, 0.94);
  animation-fill-mode: forwards;
}
.generic_box svg {
  width: 8em;
  height: 8em;
  position: absolute;
  top: 0;
    bottom: 0;
    margin: auto;
    left: 0;
    right: 0;
  fill: #3093f1;
  transform: rotate(-90deg);

}
@keyframes rotate {
  from {
      stroke-dashoffset: 230;
      stroke-width: 1px;
  }

  to {
      stroke-dashoffset: 0;
      stroke-width: 1px;
  }
}

@-ms-keyframes rotate {
  from {
      stroke-dashoffset: 230;
      stroke-width: 1px;
  }

  to {
      stroke-dashoffset: 0;
      stroke-width: 1px;
  }
}

@-moz-keyframes rotate {
  from {
      stroke-dashoffset: 230;
      stroke-width: 1px;
  }

  to {
      stroke-dashoffset: 0;
      stroke-width: 1px;
  }
}

@-webkit-keyframes rotate {
  from {
      stroke-dashoffset: 230;
      stroke-width: 1px;
  }

  to {
      stroke-dashoffset: 0;
      stroke-width: 1px;
  }
}
</style>