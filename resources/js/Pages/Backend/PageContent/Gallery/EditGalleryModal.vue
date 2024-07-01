<template>
    <transition name="modal">
        <div class="fixed z-50 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-center justify-center min-h-screen px-4 py-6 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" @click="closeEditGalleryModal"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4 max-h-[80vh] overflow-y-auto">
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                Edit Gallery
                            </h3>
                            <form @submit.prevent="submitForm" enctype="multipart/form-data">
                                <div class="mt-4 sm:flex sm:items-center">
                                    <label for="galleryImage" class="block text-sm font-medium text-gray-700 sm:w-1/4 grid justify-start">Image</label>
                                    <input type="file" id="galleryImage" name="galleryImage" @change="handleImageUpload"
                                        class="mt-1 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm sm:w-3/4">
                                </div>
                                <div class="mt-4 sm:flex sm:items-center">
                                    <label for="galleryTitle" class="block text-sm font-medium text-gray-700 sm:w-1/4 grid justify-start">Title</label>
                                    <input type="text" id="galleryTitle" name="galleryTitle" v-model="form.galleryTitle"
                                        class="mt-1 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm sm:w-3/4">
                                </div>
                                <div class="mt-4 sm:items-center">
                                    <label for="description" class="block text-sm font-medium text-gray-700 sm:w-1/4 grid justify-start mb-2">Description</label>
                                    <textarea id="editor" name="description" rows="3"
                                        class="mt-1 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm sm:w-3/4"></textarea>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="bg-gray-900 px-4 py-3 sm:px-6 sm:flex sm:flex-row justify-end">
                        <button @click="submitForm" type="button"
                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-emerald-500 text-base font-medium text-white hover:bg-emerald-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:w-auto sm:text-sm mr-2 min-w-20 mb-2">
                            Save
                        </button>
                        <button @click="closeEditGalleryModal" type="button"
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
import { ref, defineProps, defineEmits, onMounted } from 'vue';
import { router, useForm } from '@inertiajs/vue3';

// Modal close event
const emits = defineEmits(['closeEditGalleryModal'])
const closeEditGalleryModal = () => {
    emits('closeEditGalleryModal')
}

// Props for the selected gallery and initial data
const props = defineProps({
    galleries: Array,
    gallerySelected: Object,
});

const editedGallery = ref({
    id: props.gallerySelected.id,
    galleryImage: props.gallerySelected.galleryImage,
    galleryTitle: props.gallerySelected.title,
    description: props.gallerySelected.description,
});

const form = useForm({
    galleryImage: editedGallery.value.galleryImage,
    galleryTitle: editedGallery.value.galleryTitle,
    description: editedGallery.value.description,
});

const handleImageUpload = (event) => {
    const file = event.target.files[0]
    form.galleryImage = file;
};

onMounted(() => {
    ClassicEditor
        .create(document.querySelector('#editor'))
        .then(editor => {
            editor.setData(editedGallery.value.description);
            editor.model.document.on('change:data', () => {
                form.description = editor.getData();
            });
        })
        .catch(error => {
            console.error(error);
        });
});

const submitForm = async () => {
    try {
        // Kirim data form menggunakan metode put
        await router.post(route('gallery.update', { gallery: editedGallery.value.id }), {
            _method: 'put',
            galleryImage: form.galleryImage,
            galleryTitle: form.galleryTitle,
            description: form.description,
        })
        closeEditGalleryModal()
    } catch (error) {
        console.error(error)
    }
}
</script>
