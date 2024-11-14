<x-app-layout>
    @vite(['resources/css/profile.css'])
    
    <div class="profile-container">
        <div class="profile-header">
            <div class="profile-image-container">
                <img src="pi.jpg" alt="Image" style="width: 300px; min-h-screen bg-cover bg-center bg-fixed display:block;margin:auto;">
            </div>
            <h1 class="profile-name">Abrar Ikramaputra</h1>
        </div>

        <div class="profile-section bg-opacity-80">
            <div class="profile-info">
                <p class="mb-4">
                    <span class="font-semibold">Mahasiswa Teknologi Rekayasa Internet</span>
                    <br>Semester 7 angkatan 2021 
                </p>
                <p class="mb-4">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas dignissim, dui vitae molestie congue, dolor ipsum feugiat dui, a lacinia metus nulla ac magna. Sed in diam urna. Etiam non finibus dolor. Maecenas facilisis, eros sit amet vestibulum rutrum, orci nibh lobortis nulla, sed varius ligula erat id lorem. Maecenas nisi velit, convallis ut tortor at, dictum euismod orci. Maecenas sed diam vel velit ornare elementum sit amet non turpis. Sed pharetra aliquet nisl. In porta mattis dui sit amet posuere. Nulla id vestibulum mauris, eget porta dolor. Cras quis erat sed nisl porttitor eleifend et in nulla. Nulla facilisi. Sed felis sapien, dapibus mollis tortor in, congue euismod neque. In dictum egestas enim, quis mattis augue scelerisque et.
                </p>
                
                <div class="flex justify-center space-x-4 mb-4">
                    <span class="inline-flex items-center px-3 py-1 rounded-full bg-yellow-100 text-yellow-800">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
                        </svg>
                        Ayam Goreng
                    </span>
                    <span class="inline-flex items-center px-3 py-1 rounded-full bg-green-100 text-green-800">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
                        </svg>
                        Sayur Lodeh
                    </span>
                    <span class="inline-flex items-center px-3 py-1 rounded-full bg-blue-100 text-blue-800">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
                        </svg>
                        Es Teh
                    </span>
                </div>

                <button class="about-button">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    About Me
                </button>
            </div>
        </div>
    </div>


</x-app-layout>

