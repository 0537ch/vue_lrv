<!-- resources/js/Components/Profile.vue -->
<template>
    <div class="max-w-2xl mx-auto p-4">
      <div class="group p-1 bg-gradient-to-br from-purple-500 to-pink-600 rounded-2xl hover:from-purple-400 hover:to-pink-500 transition-all duration-300">
        <div class="bg-gray-800 bg-opacity-80 backdrop-blur-lg p-6 rounded-xl hover:bg-gray-900 transition-all duration-300 border border-gray-800 hover:border-purple-500">
          <!-- Profile Header -->
          <div class="flex flex-col items-center mb-6">
            <div class="w-32 h-32 rounded-full p-1 bg-gradient-to-br from-purple-500 to-pink-600">
              <div class="w-full h-full rounded-full overflow-hidden">
                <img 
                  :src="profileImage" 
                  alt="Profile"
                  class="w-full h-full object-cover"
                >
              </div>
            </div>
            <h1 class="text-2xl font-bold text-white mt-4 text-center">
              {{ name }}
            </h1>
          </div>
  
          <!-- Profile Info -->
          <div class="text-gray-200 space-y-4">
            <div class="text-center">
              <h2 class="font-semibold text-lg text-purple-300">
                {{ role }}
              </h2>
              <p class="text-gray-400">{{ semester }}</p>
            </div>
  
            <p class="text-gray-300 leading-relaxed text-center">
              {{ description }}
            </p>
  
            <!-- Food Tags -->
            <div class="flex flex-wrap justify-center gap-2">
              <span
                v-for="food in favoriteFoods"
                :key="food"
                class="inline-flex items-center px-3 py-1 rounded-full bg-purple-100 text-purple-800 text-sm font-medium"
              >
                <svg class="w-4 h-4 mr-1.5" viewBox="0 0 20 20" fill="currentColor">
                  <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z" />
                </svg>
                {{ food }}
              </span>
            </div>
  
            <!-- About Button -->
            <div class="flex justify-center">
              <button 
                @click="showAbout"
                class="inline-flex items-center px-4 py-2 rounded-lg bg-purple-600 text-white hover:bg-purple-700 transition-colors duration-200"
              >
                <svg 
                  class="w-5 h-5 mr-2" 
                  fill="none" 
                  stroke="currentColor" 
                  viewBox="0 0 24 24"
                >
                  <path 
                    stroke-linecap="round" 
                    stroke-linejoin="round" 
                    stroke-width="2" 
                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                  />
                </svg>
                About Me
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref } from 'vue'
  
  // Props
  const props = defineProps({
    profileImage: {
      type: String,
      default: '/abrar.jpg'
    },
    name: {
      type: String,
      default: 'Abrar Ikramaputra'
    },
    role: {
      type: String,
      default: 'Mahasiswa Teknologi Rekayasa Internet'
    },
    semester: {
      type: String,
      default: 'Semester 7 angkatan 2021'
    },
    description: {
      type: String,
      default: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas dignissim, dui vitae molestie congue, dolor ipsum feugiat dui, a lacinia metus nulla ac magna.'
    },
    favoriteFoods: {
      type: Array,
      default: () => ['Ayam Goreng', 'Sayur Lodeh', 'Es Teh']
    }
  })
  
  // Methods
  const showAbout = () => {
    // Add your about functionality here
    console.log('Show about section')
  }
  </script>
  
  <style scoped>
  /* Add any additional custom styles here */
  </style>