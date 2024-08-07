<template>

    <Head title="About Us" />

    <AuthenticatedLayout>
        <template #header>
            About Us
        </template>

        <div class="flash-message-container mb-2">
            <flashmessage
                v-if="$page.props.flash.message"
                :message="$page.props.flash.message.message"
                :type="$page.props.flash.message.type"
            />
        </div>
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <form @submit.prevent="submitForm">
                <div class="container mx-auto p-6 w-11/12">
                    <!-- Logo Input -->
                    <div class="mb-6">
                        <label for="logo" class="block text-2xl font-bold mb-1">Logo</label>
                        <input type="file" id="logo"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-1"
                            @change="handleImageUpload">
                    </div>

                    <!-- Company Name -->
                    <div class="mb-6">
                        <label for="companyName" class="block text-2xl font-bold mb-1">Company Name</label>
                        <input type="text" id="companyName" v-model="form.companyName"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-1">
                    </div>
    
                    <!-- Description -->
                    <div class="mb-6">
                        <label for="description" class="block text-2xl font-bold mb-1">
                            Description
                        </label>
                        <textarea id="editor"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm h-[500px]" name="description"></textarea>
                    </div>
    
                    <!-- Contact -->
                    <h2 class="block text-2xl font-bold mb-1">Contact</h2>
                    <div class="mb-4">
                        <label for="email" class="block text-md font-medium text-gray-700">Email</label>
                        <input type="text" id="email" v-model="form.email"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    </div>
                    <div class="mb-4">
                        <label for="phone" class="block text-md font-medium text-gray-700">Phone</label>
                        <input type="text" id="phone" v-model="form.phone"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    </div>
                    <div class="mb-4">
                        <label for="address" class="block text-md font-medium text-gray-700">Address</label>
                        <input type="text" id="address" v-model="form.address"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    </div>
                    <div class="mb-4">
                        <label for="maps" class="block text-md font-medium text-gray-700">Maps</label>
                        <input type="text" id="maps" v-model="form.maps"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        <div class="flex justify-center my-4" v-html="form.maps"></div>
                    </div>
    
                    <div class="flex justify-end">
                        <button class="mt-4 bg-emerald-500 text-white px-6 py-2 rounded-md hover:bg-emerald-600 mx-1"  type="button" @click="submitForm">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { ref, defineProps, onMounted } from 'vue';
import { Head, useForm, router } from '@inertiajs/vue3';
import Flashmessage from '../../../../Components/FlashMessage.vue';

const props = defineProps({
    pageContent: Object
})

const editedPageContent = ref({
    id: props.pageContent.id,
    logo: props.pageContent.logo,
    companyName: props.pageContent.companyName,
    about: props.pageContent.about,
    email: props.pageContent.email,
    phone: props.pageContent.phone,
    address: props.pageContent.address,
    maps: props.pageContent.maps,
})

const form = useForm({
    logo: editedPageContent.value.logo,
    about: editedPageContent.value.about,
    companyName: editedPageContent.value.companyName,
    email: editedPageContent.value.email,
    phone: editedPageContent.value.phone,
    address: editedPageContent.value.address,
    maps: editedPageContent.value.maps,
})

const handleImageUpload = (event) => {
    const file = event.target.files[0]
    form.logo = file
};

onMounted(() => {
    ClassicEditor
        .create(document.querySelector('#editor'))
        .then(editor => {
            editor.setData(editedPageContent.value.about);
            editor.model.document.on('change:data', () => {
                form.about = editor.getData();
            });
        })
        .catch(error => {
            console.error(error);
        });
});

const submitForm = async () => {
    try {
        await router.post(route('aboutus.update', { aboutu:editedPageContent.value.id }), {
            _method: 'put',
            logo: form.logo,
            about: form.about,
            companyName: form.companyName,
            email: form.email,
            phone: form.phone,
            address: form.address,
            maps: form.maps,
        })
    } catch (error) {
        console.error(error)
    }
};
</script>