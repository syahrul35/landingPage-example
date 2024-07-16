<template>

    <Head title="About Us" />

    <AuthenticatedLayout>
        <template #header>
            About Us
        </template>

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
                        <div class="flex justify-center my-4">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126646.20960987003!2d112.63028045639682!3d-7.275612006021701!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fbf8381ac47f%3A0x3027a76e352be40!2sSurabaya%2C%20Jawa%20Timur!5e0!3m2!1sid!2sid!4v1716399238164!5m2!1sid!2sid" width="400" height="300" style="border:0;text-align: center;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="rounded-lg"></iframe>
                        </div>
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

const props = defineProps({
    pageContent: Object
})
    console.log("🚀 ~ pageContent:", props.pageContent.id)

const editedPageContent = ref({
    id: props.pageContent.id,
    logo: props.pageContent.logo,
    about: props.pageContent.about,
    email: props.pageContent.email,
    phone: props.pageContent.phone,
    address: props.pageContent.address,
    maps: props.pageContent.maps,
})
    console.log("🚀 ~ id:", editedPageContent.value.id)

const form = useForm({
    logo: editedPageContent.value.logo,
    about: editedPageContent.value.about,
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