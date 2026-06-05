<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\JsonResponse;

class PostController extends Controller
{
    public function index(): JsonResponse
    {
        $posts = Post::with(['category', 'tags'])
            ->published()
            ->orderBy('published_at', 'desc')
            ->paginate(15);

        return response()->json($posts);
    }

    public function show(string $slug): JsonResponse
    {
        $post = Post::with(['category', 'tags'])
            ->where('slug', $slug)
            ->published()
            ->firstOrFail();

        return response()->json($post);
    }

    public function featured(): JsonResponse
    {
        $posts = Post::with(['category', 'tags'])
            ->published()
            ->where('is_featured', true)
            ->orderBy('published_at', 'desc')
            ->take(5)
            ->get();

        return response()->json($posts);
    }
}
