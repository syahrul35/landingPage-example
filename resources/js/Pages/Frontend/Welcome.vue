<script setup>
import { Head, Link } from '@inertiajs/vue3';
import Slider from './Partials/Slider.vue';
// import '../../../css/frontend.css';

const props = defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
    galleries: {
        type: Array
    }
});

function handleImageError() {
    document.getElementById('screenshot-container')?.classList.add('!hidden');
    document.getElementById('docs-card')?.classList.add('!row-span-1');
    document.getElementById('docs-card-content')?.classList.add('!flex-row');
    document.getElementById('background')?.classList.add('!hidden');
}
</script>

<template>
    <Head title="Welcome" />
    <!-- Navbar -->
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

    <!-- Image Slider - Swiper -->
    <Slider :galleries="galleries"/>

    <!-- Description -->
    <section id="description" class="text-center p-8 pt-12">
        <h2 class="text-3xl font-bold">Discover the Taste of Indonesia</h2>
        <p class="mt-4 text-gray-600 w-6/12 mx-auto">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis consequuntur delectus soluta,
            repudiandae esse sed excepturi quaerat itaque ad nisi officiis placeat repellat suscipit aspernatur
            dignissimos totam vero animi tempora.
            Voluptatum cumque minus corporis accusamus alias delectus iste necessitatibus deleniti, laudantium, natus
            accusantium blanditiis ex rerum quae consectetur iure ut incidunt modi? In impedit ullam quas architecto ab
            rerum unde!

            Voluptatum, incidunt ratione officiis autem exercitationem enim laboriosam accusantium! Consectetur
            veritatis saepe minima quam modi mollitia magnam repellat velit porro similique, fuga minus, nesciunt
            tempore praesentium odit nihil soluta eligendi.
            Obcaecati architecto quidem accusantium corporis natus aspernatur dolores. Eaque voluptates, eius voluptatum
            corrupti odit recusandae rerum incidunt ipsum impedit repellat atque sint placeat qui, animi magnam
            similique distinctio ab reprehenderit?
            Quisquam rem culpa atque delectus aliquid molestiae voluptates id numquam quo odio eveniet, voluptate
            commodi vel velit non eos nemo voluptatum iusto earum possimus aspernatur. Suscipit impedit quam consequatur
            dolor.

            Necessitatibus veritatis facilis iure nesciunt, repellat adipisci molestias reiciendis eligendi quod saepe
            ipsam vitae repudiandae sint odio ad cum! Possimus voluptatem facilis assumenda totam nobis autem distinctio
            libero vel quos.
            Eos facere soluta pariatur quo tempore possimus, laborum assumenda molestias ratione nam. Dolorum libero ut
            qui quasi nesciunt ab, nostrum at? Aliquid suscipit hic sit libero recusandae accusamus explicabo
            doloremque.
            Eum in iste illum voluptatum optio possimus omnis corporis, odit dolor reiciendis non? Ab, eveniet veniam,
            iste, sed modi minus et aspernatur ex maiores omnis illo optio quia totam ea.
            Quos, provident? Quae officiis blanditiis vitae quaerat voluptates nobis saepe est commodi earum ipsa sit
            minima exercitationem, eligendi perspiciatis quos, modi officia omnis velit laborum nulla veritatis!
            Placeat, quod eveniet?
            Quam, vitae! Tempore fuga velit laboriosam perferendis quidem molestias praesentium unde vitae
            necessitatibus quaerat? Repudiandae ab dolore consectetur quas quibusdam ut similique corporis, autem
            placeat recusandae dolorem unde quasi magnam.
            Natus nihil minima porro error, tenetur molestias aliquam labore beatae, delectus suscipit et qui quis odio
            similique cum repudiandae architecto, voluptatem laborum accusamus culpa ipsum incidunt harum commodi. Quos,
            voluptatem?

            Beatae mollitia odio distinctio delectus sunt in recusandae saepe nam fugiat cupiditate! Voluptate pariatur,
            sit eius excepturi animi illo autem quae eos doloribus inventore corrupti velit cumque, esse, eveniet ipsam.
            Assumenda quae veniam odit inventore aliquid rerum dolore fugiat sunt, consectetur voluptas saepe
            necessitatibus minima, praesentium laboriosam similique ea quod voluptates recusandae et. Illo quidem illum
            nostrum temporibus, ducimus similique.
            Praesentium dolorum asperiores necessitatibus obcaecati dignissimos inventore incidunt aliquid, porro veniam
            vel sed, debitis perferendis similique. Atque, sit pariatur. Nisi minima in assumenda aliquid ullam animi,
            sequi delectus repellat modi.
        </p>
    </section>

    <!-- Products and Prices -->
    <section id="products" class="container mx-auto p-4">
        <h3 class="text-2xl font-bold text-center mb-6 text-gray-700">Our Products</h3>
        <div class="grid grid-cols-3 gap-4">
            <div class="border p-2 bg-white shadow-lg rounded-lg transition duration-500 ease-in-out transform hover:-translate-y-1 hover:shadow-2xl">
                <img src="../../../../storage/app/public/nasi_kuning.jpeg" alt="Nasi Kuning" class="w-full h-48 object-cover rounded-t-lg shadow-lg">
                <div class="py-2">
                    <h3 class="text-lg font-bold text-gray-800">Nasi Kuning</h3>
                    <p class="text-gray-600 text-sm">A vibrant and flavorful dish enjoyed across Indonesia.</p>
                    <div class="flex items-center mt-1">
                        <!-- SVG Star Icons with animation -->
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                            class="w-5 h-5 text-yellow-400 hover:text-yellow-500 transition ease-in-out duration-150">
                            <path fill-rule="evenodd"
                                d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z"
                                clip-rule="evenodd" />
                        </svg>
                        <!-- Repeat SVG for more stars as needed -->
                    </div>
                    <div class="flex justify-between items-center mt-2">
                        <span class="text-green-600 font-bold text-xl">$5.00</span>
                        <button
                            class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600 transition duration-300">Buy
                            Now</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Repeat for other products -->
    </section>

    <!-- Contact Section -->
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
                    <h4 class="font-semibold">Alamat:</h4>
                    <p>Jl. Merdeka No.123, Jakarta, Indonesia</p>
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
                    <p>+62 21 555 0123</p>
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
                    <p><a href="mailto:info@indofood.com" class="text-blue-500 hover:underline">info@indofood.com</a>
                    </p>
                </div>
            </div>
        </div>
    </section>


    <!-- Footer -->
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
                    <li><a href="#" class="hover:text-gray-300"><img src="../../../../storage/app/public/facebook.png" alt="Facebook"
                                class="w-6 h-6"></a></li>
                    <!-- <li><a href="#" class="hover:text-gray-300"><img src=".../../../../storage/app/public/twitter.jpeg" alt="Twitter"
                                class="w-6 h-6"></a></li> -->
                    <li><a href="#" class="hover:text-gray-300"><img src="../../../../storage/app/public/instagram.png" alt="Instagram"
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
