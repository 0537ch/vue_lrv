<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 sticky">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('about') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-blue-500 hover:text-blue-700 active:text-blue-800" />                    </a>
                </div>
 
                <!-- Navigation Links -->
                <div class="hidden space-x-12 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('about')" :active="request()->routeIs('about')" 
                        class="inline-flex items-center px-1 pt-1 text-sm font-medium transition-colors duration-300
                        {{ request()->routeIs('about') 
                            ? 'text-blue-600 font-semibold' 
                            : 'from-blue-500 to-purple-400 hover:text-blue-700' }}">
                        {{ __('About') }}
                    </x-nav-link>

                    <x-nav-link :href="route('profile')" :active="request()->routeIs('profile')"
                        class="inline-flex items-center px-1 pt-1 text-sm font-medium transition-colors duration-300
                        {{ request()->routeIs('profile') 
                            ? 'text-blue-600 font-semibold' 
                            : 'from-blue-500 to-purple-400 hover:text-blue-700' }}">
                        {{ __('Profile') }}
                    </x-nav-link>

                    <x-nav-link :href="route('blog')" :active="request()->routeIs('blog')"
                        class="inline-flex items-center px-1 pt-1 text-sm font-medium transition-colors duration-300
                        {{ request()->routeIs('blog') 
                            ? 'text-blue-600 font-semibold' 
                            : 'from-blue-500 to-purple-400 hover:text-blue-700' }}">
                        {{ __('Blog') }}
                    </x-nav-link>

                    <x-nav-link :href="route('login')" :active="request()->routeIs('login')"
                        class="inline-flex items-center px-1 pt-1 text-sm font-medium transition-colors duration-300
                        {{ request()->routeIs('login') 
                            ? 'text-blue-600 font-semibold' 
                            : 'from-blue-500 to-purple-400 hover:text-blue-700' }}">
                        {{ __('login') }}
                    </x-nav-link>
                </div>
            </div>
 
            
 
            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
 
    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('blog')" :active="request()->routeIs('blog')">
                {{ __('Blog') }}
            </x-responsive-nav-link>
        </div>
 
        
    </div>
</nav>