<script setup lang="ts">
import moment from 'moment';
import { defineProps } from 'vue';

const props = defineProps({
    text: {
        type: String,
        required: true
    },
});
</script>
<template>
    <div class="datepicker relative form-floating mb-3 xl:w-96">
        <input @input="$emit('update:date', $event?.target?.value)" type="date"
          class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
          placeholder="Seleziona una data" />
        <label for="floatingInput" class="text-gray-700">{{ props.text }}</label>
      </div>
</template>