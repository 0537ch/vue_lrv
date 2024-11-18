<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8">
        <div class="bg-white shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h1 class="text-xl font-bold mb-4">Edit Article</h1>
                <form action="{{ route('articles.update', $post->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="judul" class="block text-gray-700 font-bold mb-2">Title</label>
                        <input type="text" name="judul" id="judul" class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200"
                            value="{{ $post->judul }}" required>
                    </div>

                    <div class="mb-4">
                        <label for="body" class="block text-gray-700 font-bold mb-2">Content</label>
                        <textarea name="body" id="body" rows="6" class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200" 
                        required>{{ $post->body }}</textarea>
                    </div>

                    <div class="flex items-center justify-between">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                            Update
                        </button>
                        <a href="{{ route('articles.index') }}" class="text-blue-500 hover:text-blue-700">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
