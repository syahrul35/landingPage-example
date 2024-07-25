<template>
    <section id="description" class="text-center p-8 pt-12">
        <h2 class="text-3xl font-bold" v-html="props.about.companyName"></h2>
        <p class="mt-4 text-gray-600 w-6/12 mx-auto">
            {{ props.about.about }}
        </p>
    </section>
</template>

<script setup>
    import { defineProps } from 'vue';

    const props = defineProps({
        about: Object
    })
</script>