<template>
    <transition name="modal">
        <div class="fixed z-50 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-center justify-center min-h-screen px-4 py-6 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" @click="closeEditCategoryModal"></div>

                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <div
                    class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4 max-h-[80vh] overflow-y-auto">
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                Edit Category
                            </h3>

                            <!-- Form tambahan -->
                            <form @submit.prevent="submitForm">
                                <div class="mt-4 sm:flex sm:items-center">
                                    <label for="categoryName"
                                        class="block text-sm font-medium text-gray-700 sm:w-1/4 grid justify-start">Category Name</label>
                                    <input type="text" id="categoryName" name="categoryName"
                                    v-model="form.categoryName"
                                        class="mt-1 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm sm:w-3/4">
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="bg-gray-900 px-4 py-3 sm:px-6 sm:flex sm:flex-row justify-end">
                        <button @click="submitForm" type="button"
                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-emerald-500 text-base font-medium text-white hover:bg-emerald-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:w-auto sm:text-sm mr-2 min-w-20 mb-2">
                            Save
                        </button>
                        <button @click="closeEditCategoryModal" type="button"
                            class="min-w-20 w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:w-auto sm:text-sm mb-2">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </transition>
</template>

<script setup>
import { ref, defineProps, defineEmits, computed, onMounted } from 'vue';
import { useForm } from '@inertiajs/vue3';

// Modal
const emits = defineEmits(['closeEditCategoryModal']);

const closeEditCategoryModal = () => {
    emits('closeEditCategoryModal');
};
// end Modal

const props = defineProps({
    categories: Array,
    selectedCategory: Object
})

const editedCategory = ref({
    id: props.selectedCategory.id,
    categoryName: props.selectedCategory.categoryName
})

const form = useForm({
    categoryName: editedCategory.value.categoryName
})

const submitForm = async () => {
    try {
        await form.put(route('category.update', { category: editedCategory.value.id }), {
            categoryName: form.categoryName
        })
        closeEditCategoryModal()
    } catch (error) {
        console.log(error)
    }
}

</script>