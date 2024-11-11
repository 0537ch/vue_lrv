<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        try {
            $posts = Post::all();
            return response()->json([
                'status' => 'success',
                'data' => $posts
            ], 200);
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
            $post = Post::findOrFail($id);
            return response()->json($post);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Post not found'], 404);
        }
    }

    public function store(Request $request)
    {
        $post = Post::create($request->all());
        return response()->json($post, 201);
    }
}