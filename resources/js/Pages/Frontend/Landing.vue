<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { onMounted } from 'vue';
import Slider from './Partials/Slider.vue';
import Navbar from './Partials/Navbar.vue';
import Description from './Partials/Description.vue';
import Products from './Partials/Products.vue';
import Contact from './Partials/Contact.vue';
import FooterSection from './Partials/Footer.vue';
// import '../../../css/frontend.css';

const props = defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
    galleries: {
        type: Array
    },
    about: {
        type: Object
    },
    products: {
        type: Array
    }
})

function handleImageError() {
    document.getElementById('screenshot-container')?.classList.add('!hidden');
    document.getElementById('docs-card')?.classList.add('!row-span-1');
    document.getElementById('docs-card-content')?.classList.add('!flex-row');
    document.getElementById('background')?.classList.add('!hidden');
}

onMounted(() => {
    import('../../Frontend').then(module => {
        module.default();
    });
})
</script>

<template>
    <Head title="Welcome" />
    <!-- Navbar -->
    <Navbar :canLogin="canLogin" :canRegister="canRegister" :about="about"/>

    <!-- Image Slider - Swiper -->
    <Slider :galleries="galleries"/>

    <!-- Description -->
    <Description :about="about"/>

    <!-- Products and Prices -->
    <Products :products="products"/>

    <!-- Contact Section -->
    <Contact :about="about"/>

    <!-- Footer -->
    <FooterSection :about="about"/>
</template>
