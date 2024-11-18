<!-- about.blade.php -->
<x-app-layout>
    <!-- Hero Section with Dynamic Background -->
    <div class="relative min-h-screen">
       

        <!-- Content Container -->
        <div class="relative z-10 px-4 py-12 mx-auto max-w-6xl">
            <!-- Enhanced Introduction Card -->
            <div class="mb-16 text-center">
                <h1 class="!text-6xl !md:text-8xl !lg:text-9xl font-bold mb-6 animate-fade-in text-white tracking-tight">
                    Hello, I'm <span class="bg-gradient-to-r from-blue-400 to-purple-500 text-transparent bg-clip-text">Abrar</span>
                </h1>
                <p class="!text-2xl !md:text-3xl text-blue-100 max-w-2xl mx-auto font-light leading-relaxed">
                    A passionate developer crafting digital experiences
                </p>
            </div>
            <!-- Main Content Grid with Enhanced Cards -->
            <div class="grid md:grid-cols-2 gap-8">
                <!-- Mission Section --><a href="/blog">
                <div class="group p-1 bg-gradient-to-br from-blue-500 to-purple-600 rounded-2xl hover:from-blue-400 hover:to-purple-500 transition-all duration-300">
                    <div class="group bg-gray-800 bg-opacity-80 backdrop-blur-lg p-6 rounded-lg hover:bg-gray-900 transition-all duration-300 border border-gray-800 hover:border-purple-500">
                        <div class="flex items-center mb-6">
                            <div class="p-3 bg-blue-500 opacity-80 rounded-xl group-hover:scale-110 transition-transform">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                            </div>
                            <h2 class="text-2xl font-bold ml-4 text-white">My Mission</h2>
                        </div>
                        <p class="text-white leading-relaxed">My passion is to create innovative digital solutions that make a positive impact. Through thoughtful design and robust development, I aim to build experiences that inspire and empower users.</p>
                    </div>
                </div>

                <!-- Background Section -->
                <div class="group p-1 bg-gradient-to-br from-purple-500 to-pink-600 rounded-2xl hover:from-purple-400 hover:to-pink-500 transition-all duration-300">
                    <a href="/background">
                    <div class="group bg-gray-800 bg-opacity-80 backdrop-blur-lg p-6 rounded-lg hover:bg-gray-900 transition-all duration-300 border border-gray-800 hover:border-purple-500">
                        <div class="flex items-center mb-6">
                            <div class="p-3 bg-purple-500 opacity-80 rounded-xl group-hover:scale-110 transition-transform">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            
                            <h2 class="text-2xl font-bold ml-4 text-white">My Background</h2>
                        </div>
                        <p class="text-white leading-relaxed">I am a passionate developer with extensive experience in web design and development. Specializing in creating engaging websites and applications, I'm committed to continuous learning and pushing the boundaries of what's possible.</p>
                    </div>
                </div>
            </div>

            <!-- Values Section with Enhanced Cards -->
            <div class="mt-12">
                <h1 class="text-3xl font-bold text-white mb-8 text-center">My Values</h1>
                <div class="grid md:grid-cols-4 gap-6">
                    <!-- Value Cards with Hover Effects -->
                    <div class="group bg-gray-800 bg-opacity-80 backdrop-blur-lg p-6 rounded-lg hover:bg-gray-900 transition-all duration-300 border border-gray-800 hover:border-blue-500">
                        <h3 class="font-semibold text-xl mb-3 text-white group-hover:text-blue-300">Integrity</h3>
                        <p class="text-white group-hover:text-gray-200">I uphold the highest standards of honesty and transparency in all my work.</p>
                    </div>
                    <div class="group bg-gray-800 bg-opacity-80 backdrop-blur-lg p-6 rounded-lg hover:bg-gray-900 transition-all duration-300 border border-gray-800 hover:border-purple-500">
                        <h3 class="font-semibold text-xl mb-3 text-white group-hover:text-purple-300">Innovation</h3>
                        <p class="text-white group-hover:text-gray-200">I embrace creativity and seek new ways to solve problems effectively.</p>
                    </div>
                    <div class="group bg-gray-800 bg-opacity-80 backdrop-blur-lg p-6 rounded-lg hover:bg-gray-900 transition-all duration-300 border border-gray-800 hover:border-pink-500">
                        <h3 class="font-semibold text-xl mb-3 text-white group-hover:text-pink-300">Customer Focus</h3>
                        <p class="text-white group-hover:text-gray-200">I prioritize the needs and satisfaction of my clients and users.</p>
                    </div>
                    <div class="group bg-gray-800 bg-opacity-80 backdrop-blur-lg p-6 rounded-lg hover:bg-gray-900 transition-all duration-300 border border-gray-800 hover:border-indigo-500">
                        <h3 class="font-semibold text-xl mb-3 text-white group-hover:text-indigo-300">Excellence</h3>
                        <p class="text-white group-hover:text-gray-200">I strive for excellence in every project, from concept to execution.</p>
                    </div>
                </div>
            </div>

            <!-- Enhanced Contact Button -->
            <div class="mt-16 text-center">
                <a href="https://linkedin.com/in/abrar-ikramaputra-b65051221/" class="inline-flex items-center px-8 py-4 text-lg font-bold text-white bg-gradient-to-r from-blue-600 to-purple-600 rounded-full hover:from-blue-500 hover:to-purple-500 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg hover:shadow-purple-500/25">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    Let's Connect
                </a>
            </div>
        </div>
    </div>

    <!-- Enhanced Animations -->
    <style>
        @keyframes fade-in {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in {
            animation: fade-in 1.2s cubic-bezier(0.4, 0, 0.2, 1);
        }
    </style>
</x-app-layout>