<template>
    <Head title="About Us" />

    <AuthenticatedLayout>
        <template #header>
            About Us
        </template>

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 border-b border-gray-200">
                1. logo <br>
                2. about us <br>
                    - description <br>
                3. contact <br>
                    - email <br>
                    - phone <br>
                    - address <br>
                    - maps <br>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head } from '@inertiajs/vue3';
</script>