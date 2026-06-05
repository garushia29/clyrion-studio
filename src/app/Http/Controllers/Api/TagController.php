<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\JsonResponse;

class TagController extends Controller
{
    public function index(): JsonResponse
    {
        $tags = Tag::withCount('posts')
            ->orderBy('name')
            ->get();

        return response()->json($tags);
    }

    public function show(string $slug): JsonResponse
    {
        $tag = Tag::where('slug', $slug)
            ->with(['posts' => function ($q) {
                $q->published()->orderBy('published_at', 'desc');
            }])
            ->firstOrFail();

        return response()->json($tag);
    }
}
