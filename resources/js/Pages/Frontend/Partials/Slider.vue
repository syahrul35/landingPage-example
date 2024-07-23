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
      <swiper-slide v-for="(gallery, index) in galleries" :key="index" class="max-h-[100vh]">
        <img :src="getImageUrl(gallery.galleryImage)" class="w-full h-full object-cover" :alt="'Slide ' + (index + 1)">
      </swiper-slide>
    </swiper>
  </template>
  
  <script setup>
  import { ref, defineProps } from 'vue';
  import { Navigation, Pagination, Autoplay } from 'swiper/modules';
  import { Swiper, SwiperSlide } from 'swiper/vue';
  import 'swiper/css';
  import 'swiper/css/navigation';
  import 'swiper/css/pagination';
  import 'swiper/css/autoplay';

  const props = defineProps({
    galleries: Array
  })
  
  const getImageUrl = (path) => {
    return path ? `/storage/${path}` : ''
  }
  
  const onSwiper = (swiper) => {
  };
  
  const onSlideChange = () => {
  };
  
  const modules = [Navigation, Pagination, Autoplay];
  </script>
  
  <style>
  /* Optional: Add any additional styling here */
  </style>
  