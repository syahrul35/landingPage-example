<template>
    <nav class="bg-gray-800 bg-opacity-50 text-white p-5 fixed w-full z-10 transition duration-300 ease-in-out">
        <div class="container mx-auto flex justify-between items-center">
            <a href="/" class="text-lg font-bold">
                <img :src="getImageUrl(about.logo)" alt="logo" class="w-10 h-10 rounded-lg">
            </a>
            <div class="flex items-center space-x-4">
                <div id="nav-link" v-if="isDetailPage" class="space-x-4">
                    <div v-if="isDetailPage" class="space-x-4">
                    <a href="#description"
                        :class="{ 'active': activeLink === 'description' }" 
                        @click="setActive('description')" 
                        class="grow-underline">
                        Description
                    </a>
                    <a href="#products"
                        :class="{ 'active': activeLink === 'products' }" 
                        @click="setActive('products')" 
                        class="grow-underline">
                        Products
                    </a>
                    <a href="#contact"
                        :class="{ 'active': activeLink === 'contact' }" 
                        @click="setActive('contact')" 
                        class="grow-underline">
                        Contact
                    </a>
                </div>
                </div>
                <div id="nav-btn" class="flex items-center pl-8">
                    <nav v-if="canLogin" class="-mx-3 flex flex-1 justify-end">
                        <Link v-if="$page.props.auth.user" :href="route('dashboard')"
                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                        Dashboard
                        </Link>

                        <template v-else>
                            <Link :href="route('login')"
                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                            Log in
                            </Link>

                            <Link v-if="canRegister" :href="route('register')"
                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
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
import { defineProps, ref, onMounted } from 'vue';

const props = defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    about: {
        type: Object
    },
    isDetailPage: {
        type: Boolean,
        default: true
    }
})

const getImageUrl = (path) => {
    return path ? `/storage/${path}` : ''
}

// State untuk menyimpan link aktif
const activeLink = ref('description')
const navHeight = ref(0) // Menggunakan ref untuk navHeight agar reaktif

// Ambil tinggi navbar setelah komponen di-mount
onMounted(() => {
  const navElement = document.querySelector("nav")
  if (navElement) {
    navHeight.value = navElement.offsetHeight // Ambil tinggi navbar
  }
})

// Method untuk mengubah link aktif dan scroll ke bagian yang sesuai
const setActive = (section) => {
  activeLink.value = section
  const targetElement = document.querySelector(`#${section}`)

  if (targetElement) {
    // Melakukan smooth scroll dengan mempertimbangkan tinggi navbar
    window.scrollTo({
      top: targetElement.offsetTop - navHeight.value, // Menggunakan navHeight dari ref
      behavior: "smooth",
    })
  }
}
</script>