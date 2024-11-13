<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

use function Ramsey\Uuid\v1;

class PostController extends Controller
{
    public function index(Request $request)
    {
        try {
            $query = Post::query();

            // Ambil semua post untuk client-side pagination
            $posts = $query->get();
            
            return response()->json([
                'status' => 'success',
                'data' => $posts->map(function ($post) {
                    return [
                        'id' => $post->id,
                        'judul' => $post->judul,
                        'body' => $post->body,
                        'created_at' => $post->created_at->format('Y-m-d H:i:s')
                    ];
                })
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
{
    try {
        $post = Post::with('author_id')->findOrFail($id);
        
        // Jika request dari API/Vue
        if (request()->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'data' => [
                    'id' => $post->id,
                    'judul' => $post->judul,
                    'body' => $post->body,
                    'author' => $post->author_id,
                    'created_at' => $post->created_at->format('Y-m-d H:i:s')
                ]
            ]);
        }
        
        // Jika direct browser request
        return view('artikel', [
            'title' => 'Artikel cuy',
            'post' => $post,
        ]);
        
    } catch (\Exception $e) {
        if (request()->wantsJson()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Article not found'
            ], 404);
        }
        abort(404);
    }
}

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'judul' => 'required|max:255',
                'body' => 'required'
            ]);
            
            $post = Post::create($validatedData);
            
            return response()->json([
                'status' => 'success',
                'data' => [
                    'id' => $post->id,
                    'judul' => $post->judul,
                    'body' => $post->body,
                    'created_at' => $post->created_at->format('Y-m-d H:i:s')
                ]
            ], 201);
            
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}