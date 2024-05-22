<template>
    <swiper
      :modules="modules"
      :slides-per-view="1"
      :space-between="10"
      navigation
      :pagination="{ clickable: true }"
      :autoplay="{ delay: 10000 }"
      :speed="1000"
      loop
      @swiper="onSwiper"
      @slideChange="onSlideChange"
    >
      <swiper-slide v-for="(image, index) in images" :key="index" class="max-h-[100vh]">
        <img :src="image.src" class="w-full h-full object-cover" :alt="'Slide ' + (index + 1)">
      </swiper-slide>
    </swiper>
  </template>
  
  <script setup>
  import { ref } from 'vue';
  import { Navigation, Pagination, Autoplay } from 'swiper/modules';
  import { Swiper, SwiperSlide } from 'swiper/vue';
  import 'swiper/css';
  import 'swiper/css/navigation';
  import 'swiper/css/pagination';
  import 'swiper/css/autoplay';
  
  const images = ref([
    { src: '/storage/kue_putu.jpg' },
    { src: '/storage/ketoprak.jpg' },
    { src: '/storage/nasi_kuning.jpeg' }
  ]);
  
  const onSwiper = (swiper) => {
    console.log(swiper);
  };
  
  const onSlideChange = () => {
    console.log('slide change');
  };
  
  const modules = [Navigation, Pagination, Autoplay];
  </script>
  
  <style>
  /* Optional: Add any additional styling here */
  </style>
  