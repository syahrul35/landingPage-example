<template>
    <section id="products" class="container mx-auto p-4">
        <h3 class="text-2xl font-bold text-center mb-6 text-gray-700">Our Products</h3>
        <div class="grid grid-cols-3 gap-4">
            <div v-for="product in products" :key="product.id"
                class="border p-2 bg-white shadow-lg rounded-lg transition duration-500 ease-in-out transform hover:-translate-y-1 hover:shadow-2xl">
                <img :src="getImageUrl(product.productImage)" class="w-full h-48 object-cover rounded-t-lg shadow-lg">
                <div class="py-2">
                    <h3 class="text-lg font-bold text-gray-800 min-h-10">{{ product.productName }}</h3>
                    <p class="text-gray-600 text-sm h-24 overflow-y-auto" v-html="product.description"></p>
                    <div class="flex items-center mt-1">
                        <svg v-for="n in 5" :key="n" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                            fill="currentColor"
                            class="w-5 h-5 text-yellow-400 hover:text-yellow-500 transition ease-in-out duration-150">
                            <path fill-rule="evenodd"
                                d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="flex justify-between items-center mt-2">
                        <span class="text-green-600 font-bold text-xl">Rp. {{ formattedTotal(product.price) }}</span>
                        <button @click="openProductDetail(product)" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600 transition duration-300">Buy Now</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import { defineProps } from 'vue'

const props = defineProps({
    products: Array
})

const getImageUrl = (path) => {
    return path ? `/storage/${path}` : ''
}

const formattedTotal = (total) => {
    const roundedTotal = Math.round(total);
    return roundedTotal.toLocaleString('id-ID');
}

const openProductDetail = (product) => {
    window.location.href = route('product.show', product.id)
}
</script>