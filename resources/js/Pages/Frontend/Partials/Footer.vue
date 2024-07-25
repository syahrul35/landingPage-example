<template>
    <footer class="bg-gray-800 text-white text-center p-6">
        <div class="container mx-auto grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <h4 class="font-bold text-lg mb-2">About Us</h4>
                <ul class="space-y-2">
                    <li><a href="/about" class="hover:text-gray-300">Our Company</a></li>
                    <li><a href="/team" class="hover:text-gray-300">Our Team</a></li>
                    <li><a href="/careers" class="hover:text-gray-300">Careers</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold text-lg mb-2">Quick Links</h4>
                <ul class="space-y-2">
                    <li><a href="/services" class="hover:text-gray-300">Services</a></li>
                    <li><a href="/blog" class="hover:text-gray-300">Blog</a></li>
                    <li><a href="/contact" class="hover:text-gray-300">Contact Us</a></li>
                </ul>
            </div>
            <div class="items-center">
                <h4 class="font-bold text-lg ">Follow Us</h4>
                <ul class="flex space-x-4 justify-center mt-2">
                    <li><a href="#" class="hover:text-gray-300"><img src="../../../../../storage/app/public/facebook.png" alt="Facebook"
                                class="w-6 h-6"></a></li>
                    <!-- <li><a href="#" class="hover:text-gray-300"><img src=".../../../../../storage/app/public/twitter.jpeg" alt="Twitter"
                                class="w-6 h-6"></a></li> -->
                    <li><a href="#" class="hover:text-gray-300"><img src="../../../../../storage/app/public/instagram.png" alt="Instagram"
                                class="w-6 h-6"></a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold text-lg mb-2">Legal</h4>
                <ul class="space-y-2">
                    <li><a href="/terms" class="hover:text-gray-300">Terms of Service</a></li>
                    <li><a href="/privacy" class="hover:text-gray-300">Privacy Policy</a></li>
                </ul>
            </div>
        </div>
        <div class="text-center text-gray-500 mt-16">
            © 2024 IndoFood. All rights reserved.
        </div>
    </footer>
</template>

<script setup>
    import { defineProps } from 'vue';

    const props = defineProps({
        about: Object
    })
</script>