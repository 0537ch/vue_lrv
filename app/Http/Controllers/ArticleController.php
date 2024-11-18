<?php
namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    // Tampilkan semua artikel
    public function index()
    {
        $articles = Article::all();
        return view('articles.index', compact('articles'));
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
            'title' => 'required|string|max:255',
            'body' => 'required',
        ]);

        Article::create($request->all());
        return redirect()->route('articles.index')->with('success', 'Article created successfully.');
    }

    // Form edit artikel
    public function edit(Article $article)
    {
        return view('articles.edit', compact('article'));
    }

    // Update artikel
    public function update(Request $request, Article $article)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required',
        ]);

        $article->update($request->all());
        return redirect()->route('articles.index')->with('success', 'Article updated successfully.');
    }

    // Hapus artikel
    public function destroy(Article $article)
    {
        $article->delete();
        return redirect()->route('articles.index')->with('success', 'Article deleted successfully.');
    }
}
