<template>
    <Head title="Product Detail" />
    <!-- Navbar -->
    <Navbar :canLogin="canLogin" :canRegister="canRegister" :about="about" :isDetailPage="false"/>
    
    <section class="container mx-auto p-2 pt-12 min-h-[100vh]">
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
                    <button @click="buyProduct" class="bg-blue-500 text-white px-6 py-3 rounded hover:bg-blue-600 transition duration-300">
                        Buy Now
                    </button>
                </div>
            </div>
        </div>
    </section>

    <FooterSection :about="about"/>
</template>

<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3'
import {onBeforeUnmount, onMounted} from 'vue'
import Navbar from './Partials/Navbar.vue'
import FooterSection from './Partials/Footer.vue'

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
    about: Object,
    product: Object,
    snap_token: String
})

const getImageUrl = (path) => {
    return path ? `/storage/${path}` : ''
}

const formattedTotal = (total) => {
    const roundedTotal = Math.round(total)
    return roundedTotal.toLocaleString('id-ID')
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
    // Load Navbar script
    modifyNavbar()
    addProductDetailClass()

    // Load Midtrans Snap script
    const script = document.createElement('script')
    script.src = 'https://app.sandbox.midtrans.com/snap/snap.js'
    script.setAttribute('data-client-key', import.meta.env.VITE_MIDTRANS_CLIENT_KEY)
    document.head.appendChild(script)
})

onBeforeUnmount(() => {
    restoreNavbar()
    removeProductDetailClass()
})

// Create form using Inertia's useForm
const form = useForm({
    product_id: props.product.id,
    product_name: props.product.productName,
    price: props.product.price,
    name: 'Customer Name', // Replace this with dynamic customer data
    email: 'customer@example.com' // Replace this with dynamic customer data
})

// Function to handle purchase
const buyProduct = () => {
    form.post('/payment/token', {
        onSuccess: (page) => {
            const snapToken = page.props.snap_token // Get snap_token from response

            // Call Midtrans Snap Pay
            window.snap.pay(snapToken, {
                onSuccess: (result) => {
                    console.log('Payment Success:', result)
                    // Handle successful payment
                },
                onPending: (result) => {
                    console.log('Payment Pending:', result)
                    // Handle pending payment
                },
                onError: (result) => {
                    console.log('Payment Error:', result)
                    // Handle failed payment
                },
            })
        },
        onError: (errors) => {
            console.error('Payment Error:', errors)
        }
    }),
    window.snap.pay(snap_token, {
        onSuccess: function(result) {
            alert("Payment successful!")
            console.log(result)
        },
        onPending: function(result) {
            alert("Payment pending.")
            console.log(result)
        },
        onError: function(result) {
            alert("Payment failed.")
            console.log(result)
        },
        onClose: function() {
            alert('Transaction was closed.')
        }
    })
}
</script>