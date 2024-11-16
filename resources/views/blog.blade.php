<x-app-layout>
   
        <main class="max-w-4xl mx-auto px-auto sm:px-6 lg:px-8 py-8">
            <div class="min-h-screen bg-cover bg-center">
            <!-- Wrapper div untuk transparansi -->
            <div class="group p-1 bg-gradient-to-br from-blue-500 to-purple-600 rounded-2xl opacity-90 hover:from-blue-400 hover:to-purple-500 transition-all duration-300">
                <router-view v-slot="{ Component }">
                    <transition
                        name="fade" 
                        mode="out-in"
                        enter-active-class="transition ease-out duration-200"
                        enter-from-class="opacity-0 translate-y-1"
                        enter-to-class="opacity-100 translate-y-0"
                        leave-active-class="transition ease-in duration-150"
                        leave-from-class="opacity-100 translate-y-0"
                        leave-to-class="opacity-0 translate-y-1"
                    >
                        <component :is="Component" />
                    </transition>
                </router-view>
            </div>
        </main>
    </div>
</x-app-layout>
