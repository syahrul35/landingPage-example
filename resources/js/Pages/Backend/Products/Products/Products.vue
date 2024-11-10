<template>
    <Head title="Product" />

    <AuthenticatedLayout>
        <template #header>
            Products Management
        </template>

        <div class="flash-message-container mb-2">
            <flashmessage
                v-if="$page.props.flash.message"
                :message="$page.props.flash.message.message"
                :type="$page.props.flash.message.type"
            />
        </div>

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="container mx-auto p-4">
                <button 
                    @click="openAddProductModal" 
                    class="flex items-center bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-2 rounded text-sm mb-4"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 mr-1">
                        <path fill-rule="evenodd" d="M12 3.75a.75.75 0 0 1 .75.75v6.75h6.75a.75.75 0 0 1 0 1.5h-6.75v6.75a.75.75 0 0 1-1.5 0v-6.75H4.5a.75.75 0 0 1 0-1.5h6.75V4.5a.75.75 0 0 1 .75-.75Z" clip-rule="evenodd" />
                    </svg>
                    Add Product
                </button>

                <div class="overflow-x-auto rounded-md">
                    <table class="min-w-full bg-white border border-gray-200 shadow-md rounded-lg">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="py-3 px-4 border-b font-semibold text-left">Image</th>
                                <th class="py-3 px-4 border-b font-semibold text-left">Title</th>
                                <th class="py-3 px-4 border-b font-semibold text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(product, index) in products" :key="index" class="hover:bg-gray-50">
                                <td class="py-3 px-4 border-b">
                                    <img :src="getImageUrl(product.productImage)" alt="Product Image" class="w-20 h-20 object-cover rounded">
                                </td>
                                <td class="py-3 px-4 border-b">{{ product.productName }}</td>
                                <td class="py-1 px-2 border-b text-center">
                                    <div class="flex justify-center space-x-2">
                                        <button 
                                            @click="detailProduct(product)" 
                                            class="flex items-center bg-emerald-500 hover:bg-emerald-700 text-white font-semibold py-2 px-2 rounded text-sm"
                                        >
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 mr-1">
                                            <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm8.706-1.442c1.146-.573 2.437.463 2.126 1.706l-.709 2.836.042-.02a.75.75 0 0 1 .67 1.34l-.04.022c-1.147.573-2.438-.463-2.127-1.706l.71-2.836-.042.02a.75.75 0 1 1-.671-1.34l.041-.022ZM12 9a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" clip-rule="evenodd" />
                                        </svg>
                                            Detail
                                        </button>
                                        <button 
                                            @click="openEditProductModal(product)" 
                                            class="flex items-center bg-yellow-500 hover:bg-yellow-700 text-white font-semibold py-2 px-2 rounded text-sm"
                                        >
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 mr-1">
                                                <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32l8.4-8.4Z" />
                                                <path d="M5.25 5.25a3 3 0 0 0-3 3v10.5a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3V13.5a.75.75 0 0 0-1.5 0v5.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5V8.25a1.5 1.5 0 0 1 1.5-1.5h5.25a.75.75 0 0 0 0-1.5H5.25Z" />
                                            </svg>
                                            Edit
                                        </button>
                                        <button 
                                            @click="deleteProduct(product)" 
                                            class="flex items-center bg-red-500 hover:bg-red-700 text-white font-semibold py-2 px-2 rounded text-sm"
                                        >
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 mr-1">
                                                <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z" clip-rule="evenodd" />
                                            </svg>
                                            Delete
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <teleport to="body">
                <AddProductModal v-if="showAddModal" @closeAddProductModal="closeAddProductModal" :categories="categories"/>
                <EditProductModal v-if="showEditModal" @closeEditProductModal="closeEditProductModal" :categories="categories" :selectedProduct="selectedProduct"/>
            </teleport>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import { ref, defineProps } from 'vue';
import { Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { useForm } from '@inertiajs/vue3';
import AddProductModal from './AddProductModal.vue';
import EditProductModal from './EditProductModal.vue';
import Flashmessage from '../../../../Components/FlashMessage.vue';

// const emit = defineEmits(['sort'])
const showAddModal = ref(false)

const openAddProductModal = () => {
    showAddModal.value = true
}

const closeAddProductModal = () => {
    showAddModal.value = false
}

const selectedProduct = ref(null)
const showEditModal = ref(false)
function openEditProductModal(product) {
    selectedProduct.value = product
    showEditModal.value = true
}

function closeEditProductModal(product) {
    showEditModal.value = false
}

const props = defineProps({
    categories: Array,
    products: Array
})

const getImageUrl = (path) => {
    return path ? `/storage/${path}` : '';
}

const form = useForm({})
async function deleteProduct(product) {
    if (confirm('Are You Sure to Delete This Product?')) {
      try {
        await form.delete(route('products.destroy', { product: product.id }))
      } catch (error) {
        console.log(error)
      }
    }
}

const detailProduct = (product) => {
    window.location.href = route('products.show', product.id)
}
</script>