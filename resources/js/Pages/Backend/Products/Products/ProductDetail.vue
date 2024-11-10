<template>

    <Head title="Product" />

    <AuthenticatedLayout>
        <Button :href="route('products.index')" variant="info">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-6 mr-2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
            </svg>
            Back
        </Button>

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
                        <!-- <button @click="buyProduct" class="bg-blue-500 text-white px-6 py-3 rounded hover:bg-blue-600 transition duration-300">
                            Buy Now
                        </button> -->
                    </div>
                </div>
            </div>
        </section>
    </AuthenticatedLayout>
</template>

<script setup>
import { ref, defineProps } from 'vue';
import { Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Button from '@/Components/Button.vue';

const props = defineProps({
    product: Object
})

const getImageUrl = (path) => {
    return path ? `/storage/${path}` : ''
}

const formattedTotal = (total) => {
    const roundedTotal = Math.round(total)
    return roundedTotal.toLocaleString('id-ID')
}
</script>