<template>
    <Head title="Slider" />

    <AuthenticatedLayout>
        <template #header>
            Slider Management
        </template>

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="container mx-auto p-4">
                <button 
                    @click="addSlider" 
                    class="flex items-center bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-2 rounded text-sm mb-4"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 mr-1">
                        <path fill-rule="evenodd" d="M12 3.75a.75.75 0 0 1 .75.75v6.75h6.75a.75.75 0 0 1 0 1.5h-6.75v6.75a.75.75 0 0 1-1.5 0v-6.75H4.5a.75.75 0 0 1 0-1.5h6.75V4.5a.75.75 0 0 1 .75-.75Z" clip-rule="evenodd" />
                    </svg>
                    Add Slider
                </button>

                <div class="overflow-x-auto rounded-md">
                    <table class="min-w-full bg-white border border-gray-200 shadow-md rounded-lg">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="py-3 px-4 border-b font-semibold text-left">Image</th>
                                <th class="py-3 px-4 border-b font-semibold text-center">Active</th>
                                <th class="py-3 px-4 border-b font-semibold text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(slider, index) in sliders" :key="index" class="hover:bg-gray-50">
                                <td class="py-3 px-4 border-b">
                                    <img :src="slider.image" alt="Slider Image" class="w-20 h-20 object-cover rounded">
                                </td>
                                <td class="py-3 px-4 border-b text-center">
                                    <input 
                                        type="checkbox" 
                                        v-model="slider.active" 
                                        @change="toggleActive(slider)" 
                                        class="form-checkbox h-5 w-5 text-blue-600 rounded-sm"
                                    >
                                </td>
                                <td class="py-1 px-2 border-b text-center">
                                    <div class="flex justify-center space-x-2">
                                        <button 
                                            @click="editSlider(slider)" 
                                            class="flex items-center bg-yellow-500 hover:bg-yellow-700 text-white font-semibold py-2 px-2 rounded text-sm"
                                        >
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 mr-1">
                                                <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32l8.4-8.4Z" />
                                                <path d="M5.25 5.25a3 3 0 0 0-3 3v10.5a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3V13.5a.75.75 0 0 0-1.5 0v5.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5V8.25a1.5 1.5 0 0 1 1.5-1.5h5.25a.75.75 0 0 0 0-1.5H5.25Z" />
                                            </svg>
                                            Edit
                                        </button>
                                        <button 
                                            @click="deleteSlider(slider)" 
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
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import { ref } from 'vue';
import { Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const sliders = ref([
    { title: 'Slider 1', image: '/path/to/image1.jpg', active: true },
    { title: 'Slider 2', image: '/path/to/image2.jpg', active: false },
    { title: 'Slider 3', image: '/path/to/image3.jpg', active: true },
]);

function addSlider() {
    // Logic for adding a new slider
}

function toggleActive(slider) {
    // Logic for toggling the active state
}

function editSlider(slider) {
    // Logic for editing the slider
}

function deleteSlider(slider) {
    // Logic for deleting the slider
}
</script>
