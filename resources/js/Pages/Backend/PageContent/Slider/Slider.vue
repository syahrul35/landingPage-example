<template>
    <Head title="Slider" />

    <AuthenticatedLayout>
        <template #header>
            Slider Management
        </template>

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="container mx-auto p-4">

                <div class="overflow-x-auto rounded-md">
                    <table class="min-w-full bg-white border border-gray-200 shadow-md rounded-lg">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="py-3 px-4 border-b font-semibold text-center">Image</th>
                                <th class="py-3 px-4 border-b font-semibold text-center">Active</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(slider, index) in sliders" :key="index" class="hover:bg-gray-50">
                                <td class="py-3 px-4 border-b">
                                    <img :src="getImageUrl(slider.galleryImage)" alt="Slider Image" class="w-20 h-20 object-cover rounded m-auto">
                                </td>
                                <td class="py-3 px-4 border-b text-center">
                                    <input
                                        type="checkbox" 
                                        :checked="slider.isSlider" 
                                        @change="toggleIsSlider(slider)" 
                                        class="form-checkbox h-5 w-5 text-blue-600 rounded-sm"
                                    >
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
import { defineProps, ref } from 'vue';
import { Head, router, useForm } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const props = defineProps({
    sliders: Array
});

const getImageUrl = (path) => {
    return path ? `/storage/${path}` : ''
}

const toggleIsSlider = async (slider) => {
  slider.isSlider = !slider.isSlider

  try {
      await router.post(route('slider.update', { slider: slider.id }), {
          _method: 'put',
          isSlider: slider.isSlider
      });
  } catch (error) {
      console.error(error)
  }
}
</script>