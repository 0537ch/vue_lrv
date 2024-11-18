<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8">
        <div class="bg-white shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h1 class="text-2xl font-bold mb-4">{{ $article->judul }}</h1>
                <p class="text-gray-700">{{ $article->body }}</p>
                <div class="mt-6">
                    <a href="{{ route('articles.index') }}" class="text-blue-500 hover:text-blue-700">
                        &larr; Back to Articles
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
