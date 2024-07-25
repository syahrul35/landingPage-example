<template>
    <section id="contact" class="bg-gray-100 text-gray-700 py-6 px-4 text-center">
        <h3 class="text-2xl font-bold mb-6">Contact Us</h3>

        <!-- Contact Form -->
        <form class="max-w-lg mx-auto mb-8">
            <div class="mb-4">
                <input type="text" name="name" placeholder="Nama Anda"
                    class="form-input p-3 w-full border-gray-300 rounded">
            </div>
            <div class="mb-4">
                <input type="email" name="email" placeholder="Email Anda"
                    class="form-input p-3 w-full border-gray-300 rounded">
            </div>
            <div class="mb-6">
                <textarea name="message" rows="4" placeholder="Pesan Anda"
                    class="form-textarea p-3 w-full border-gray-300 rounded"></textarea>
            </div>
            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded transition duration-300 ease-in-out">Kirim
                Pesan</button>
        </form>

        <!-- Contact Info -->
        <div class="grid md:grid-cols-3 gap-8 text-left max-w-4xl mx-auto">
            <!-- Address -->
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-600 text-white mr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                        <path fill-rule="evenodd"
                            d="m11.54 22.351.07.04.028.016a.76.76 0 0 0 .723 0l.028-.015.071-.041a16.975 16.975 0 0 0 1.144-.742 19.58 19.58 0 0 0 2.683-2.282c1.944-1.99 3.963-4.98 3.963-8.827a8.25 8.25 0 0 0-16.5 0c0 3.846 2.02 6.837 3.963 8.827a19.58 19.58 0 0 0 2.682 2.282 16.975 16.975 0 0 0 1.145.742ZM12 13.5a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <div>
                    <h4 class="font-semibold">Adress:</h4>
                    <p>{{ props.about.address }}</p>
                </div>
            </div>

            <!-- Phone -->
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-600 text-white mr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                        <path fill-rule="evenodd"
                            d="M1.5 4.5a3 3 0 0 1 3-3h1.372c.86 0 1.61.586 1.819 1.42l1.105 4.423a1.875 1.875 0 0 1-.694 1.955l-1.293.97c-.135.101-.164.249-.126.352a11.285 11.285 0 0 0 6.697 6.697c.103.038.25.009.352-.126l.97-1.293a1.875 1.875 0 0 1 1.955-.694l4.423 1.105c.834.209 1.42.959 1.42 1.82V19.5a3 3 0 0 1-3 3h-2.25C8.552 22.5 1.5 15.448 1.5 6.75V4.5Z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <div>
                    <h4 class="font-semibold">Telepon:</h4>
                    <p>{{ props.about.phone }}</p>
                </div>
            </div>

            <!-- Email -->
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-600 text-white mr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                        <path
                            d="M1.5 8.67v8.58a3 3 0 0 0 3 3h15a3 3 0 0 0 3-3V8.67l-8.928 5.493a3 3 0 0 1-3.144 0L1.5 8.67Z" />
                        <path
                            d="M22.5 6.908V6.75a3 3 0 0 0-3-3h-15a3 3 0 0 0-3 3v.158l9.714 5.978a1.5 1.5 0 0 0 1.572 0L22.5 6.908Z" />
                    </svg>
                </div>
                <div>
                    <h4 class="font-semibold">Email:</h4>
                    <p>
                        <a :href="`mailto:${props.about.email}`" class="text-blue-500 hover:underline">
                            {{ props.about.email }}
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
    import { defineProps } from 'vue';

    const props = defineProps({
        about: Object
    })
</script>