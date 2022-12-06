<script>
export default {
    props: {
        errors: {
            type: Array,
            required: true,
        },
    },
}

</script>

<template>
        <div>
            <div :class="(index + 1) === errors.length || errors.length == 1 ? 'mb-5' : 'mb-3'"
                v-for="error, index  in errors" :key="index" class="text-red-700 animate-bounce rounded-xl bg-red-300 py-2">{{ error }}
            </div>
        </div>
</template>

