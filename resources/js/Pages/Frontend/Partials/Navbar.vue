<template>
    <nav class="bg-gray-800 bg-opacity-50 text-white p-5 fixed w-full z-10 transition duration-300 ease-in-out">
        <div class="container mx-auto flex justify-between items-center">
            <a href="#" class="text-lg font-bold">IndoFood</a>
            <div class="flex items-center space-x-4">
                <div id="nav-link" class="space-x-4">
                    <a href="#description" class="grow-underline active">Description</a>
                    <a href="#products" class="grow-underline">Products</a>
                    <a href="#contact" class="grow-underline">Contact</a>
                </div>
                <div id="nav-btn" class="flex items-center pl-8">
                    <nav v-if="canLogin" class="-mx-3 flex flex-1 justify-end">
                        <Link
                            v-if="$page.props.auth.user"
                            :href="route('dashboard')"
                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                        >
                            Dashboard
                        </Link>

                        <template v-else>
                            <Link
                                :href="route('login')"
                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                            >
                                Log in
                            </Link>

                            <Link
                                v-if="canRegister"
                                :href="route('register')"
                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                            >
                                Register
                            </Link>
                        </template>
                    </nav>
                </div>
            </div>
        </div>
    </nav>
</template>

<script setup>
    import { Head, Link } from '@inertiajs/vue3';
    import { defineProps } from 'vue';

    const props = defineProps({
        canLogin: {
            type: Boolean,
        },
        canRegister: {
            type: Boolean,
        },
    })
</script>