<?php
namespace App\Http\Controllers;

use App\Models\Post; // Gunakan model Post
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    // Tampilkan semua artikel
    public function index()
    {
        $articles = Post::all(); // Ambil data dari tabel posts
        return view('articles.index', compact('articles'));
    }

    public function show($id)
    {
        // Ambil data berdasarkan ID dari tabel posts
        $article = Post::findOrFail($id);

        // Kirim data ke view
        return view('articles.show', compact('article'));
    }

    // Form tambah artikel
    public function create()
    {
        return view('articles.create');
    }

    // Simpan artikel baru
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'body' => 'required',
        ]);

        // Simpan ke tabel posts
        Post::create([
            'judul' => $request->judul,
            'body' => $request->body,
        ]);

        return redirect()->route('articles.index')->with('success', 'Article created successfully.');
    }

    // Form edit artikel
    public function edit($id)
    {
        // Ambil data dari tabel posts berdasarkan ID
        $post = Post::findOrFail($id);
        return view('articles.edit', compact('post'));
    }

    // Update artikel
    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'body' => 'required',
        ]);

        // Update data di tabel posts
        $post = Post::findOrFail($id);
        $post->update([
            'judul' => $request->judul,
            'body' => $request->body,
        ]);

        return redirect()->route('articles.index')->with('success', 'Article updated successfully.');
    }

    // Hapus artikel
    public function destroy($id)
    {
        // Hapus data dari tabel posts berdasarkan ID
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect()->route('articles.index')->with('success', 'Article deleted successfully.');
    }
}
