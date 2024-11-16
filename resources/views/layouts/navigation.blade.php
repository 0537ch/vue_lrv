<nav x-data="{ open: false }" class="bg-gradient-to-r from-blue-500 to-purple-600 text-white fixed top-0 left-0 w-full border-b border-gray-200 shadow-lg z-50">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('about') }}">
                        <x-application-logo class="block h-9 w-auto text-white" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden sm:flex space-x-8 ml-10">
                    <x-nav-link :href="route('about')" :active="request()->routeIs('about')" class="text-white hover:text-gray-200 hover:underline transition duration-200">
                        {{ __('About') }}
                    </x-nav-link>
                    <x-nav-link :href="route('profile')" :active="request()->routeIs('profile')" class="text-white hover:text-gray-200 hover:underline transition duration-200">
                        {{ __('Profile') }}
                    </x-nav-link>
                    <x-nav-link :href="route('blog')" :active="request()->routeIs('blog')" class="text-white hover:text-gray-200 hover:underline transition duration-200">
                        {{ __('Blog') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-white hover:text-gray-300 hover:bg-gray-700 focus:outline-none focus:bg-gray-700 focus:text-white transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-gradient-to-r from-blue-500 to-purple-600">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('about')" :active="request()->routeIs('about')" class="text-white hover:text-gray-200">
                {{ __('About') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('profile')" :active="request()->routeIs('profile')" class="text-white hover:text-gray-200">
                {{ __('Profile') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('blog')" :active="request()->routeIs('blog')" class="text-white hover:text-gray-200">
                {{ __('Blog') }}
            </x-responsive-nav-link>
        </div>
    </div>
</nav>
