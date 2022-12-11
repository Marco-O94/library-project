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
    <div class="datepicker relative form-floating mb-3 w-full">
        <input @input="$emit('update:date', $event?.target?.value)" type="date"
          class="form-control bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
          placeholder="Seleziona una data" />
        <label for="floatingInput" class="text-gray-700">{{ props.text }}</label>
      </div>
</template>