<!-- resources/views/articles/index.blade.php -->
<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8">
        <div class="bg-white shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h1 class="text-xl font-bold mb-4">Articles</h1>
                <table class="min-w-full table-auto border-collapse border border-gray-300">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 border border-gray-300 bg-gray-100">ID</th>
                            <th class="px-4 py-2 border border-gray-300 bg-gray-100">Title</th>
                            <th class="px-4 py-2 border border-gray-300 bg-gray-100">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($articles as $article)
                        <tr>
                            <td class="px-4 py-2 border border-gray-300">{{ $article->id }}</td>
                            <td class="px-4 py-2 border border-gray-300">{{ $article->title }}</td>
                            <td class="px-4 py-2 border border-gray-300">
                                <a href="{{ route('articles.show', $article->id) }}" class="text-blue-500 hover:text-blue-700">View</a>
                                <a href="{{ route('articles.edit', $article->id) }}" class="text-green-500 hover:text-green-700 ml-4">Edit</a>
                                <form action="{{ route('articles.destroy', $article->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 ml-4" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
