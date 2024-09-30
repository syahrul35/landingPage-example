<template>
    <Head title="Product Detail" />
    <!-- Navbar -->
    <Navbar :canLogin="canLogin" :canRegister="canRegister" :about="about" :isDetailPage="false"/>
    
    <section class="container mx-auto p-2 pt-12">
        <div class="flex flex-col md:flex-row md:space-x-20">
            <!-- Product Image on the Left -->
            <div class="md:w-1/2">
                <img :src="getImageUrl(product.productImage)" class="w-full h-96 object-cover rounded-lg shadow-lg">
            </div>
            <!-- Product Details on the Right -->
            <div class="md:w-1/2 flex flex-col justify-between">
                <div>
                    <h2 class="text-4xl font-bold text-gray-700">{{ product.productName }}</h2>
                    <p class="text-gray-600 mt-4 text-justify" v-html="product.description"></p>
                </div>
                <div class="flex justify-between items-center mt-6">
                    <span class="text-green-600 font-bold text-3xl">Rp. {{ formattedTotal(product.price) }}</span>
                    <button class="bg-blue-500 text-white px-6 py-3 rounded hover:bg-blue-600 transition duration-300">
                        Buy Now
                    </button>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import { Head, Link } from '@inertiajs/vue3'
import {onBeforeUnmount, onMounted} from 'vue'
import Navbar from './Partials/Navbar.vue'

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
    about: {
        type: Object
    },
    product: {
        type: Object
    }
})

const getImageUrl = (path) => {
    return path ? `/storage/${path}` : ''
}

const formattedTotal = (total) => {
    const roundedTotal = Math.round(total);
    return roundedTotal.toLocaleString('id-ID');
}

// Function to modify navbar styles for ProductDetail
const modifyNavbar = () => {
    const navbar = document.querySelector('nav')
    
    // Remove fixed class and modify opacity
    if (navbar) {
        navbar.classList.remove('bg-opacity-50', 'fixed')
        navbar.classList.add('bg-opacity-100')
    }
}

const restoreNavbar = () => {
    const navbar = document.querySelector('nav')
    
    // Restore fixed class and opacity
    if (navbar) {
        navbar.classList.add('bg-opacity-50', 'fixed')
        navbar.classList.remove('bg-opacity-100')
    }
}

// Function to add class to body
const addProductDetailClass = () => {
    document.body.classList.add('product-detail-page')
}

// Function to remove class from body
const removeProductDetailClass = () => {
    document.body.classList.remove('product-detail-page')
}

// Modify navbar when component mounts and restore when unmounted
onMounted(() => {
    modifyNavbar()
    addProductDetailClass()
})

onBeforeUnmount(() => {
    restoreNavbar()
    removeProductDetailClass()
})
</script>