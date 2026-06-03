<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Controller: PostController
 *
 * Controlador público para el blog. Maneja listado con búsqueda,
 * detalle de posts, filtrado por categoría/tag y feed RSS.
 */
class PostController extends Controller
{
    public function index(Request $request): View
    {
        $query = Post::published()->with('categories', 'tagsRelation');

        if ($search = $request->query('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('excerpt', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        $posts = $query->orderByDesc('published_at')->paginate(9);

        if ($request->expectsJson()) {
            return response()->json($posts);
        }

        $allCategories = Category::whereHas('posts')->withCount('posts')->orderByDesc('posts_count')->get();
        $allTags = Tag::whereHas('posts')->withCount('posts')->orderByDesc('posts_count')->take(15)->get();

        return view('pages.blog', compact('posts', 'allCategories', 'allTags'));
    }

    public function show(string $slug): View
    {
        $post = Post::published()->with('categories', 'tagsRelation')->where('slug', $slug)->firstOrFail();
        $related = $post->relatedPosts();

        $categories = Category::whereHas('posts')->withCount('posts')->orderByDesc('posts_count')->get();
        $tags = Tag::whereHas('posts')->withCount('posts')->orderByDesc('posts_count')->take(15)->get();
        $recentPosts = Post::published()->where('id', '!=', $post->id)->orderByDesc('published_at')->take(5)->get();

        return view('pages.post-detail', compact('post', 'related', 'categories', 'tags', 'recentPosts'));
    }

    public function category(string $slug): View
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $posts = $category->posts()->published()->with('categories', 'tagsRelation')->orderByDesc('published_at')->paginate(9);

        $allCategories = Category::whereHas('posts')->withCount('posts')->orderByDesc('posts_count')->get();
        $allTags = Tag::whereHas('posts')->withCount('posts')->orderByDesc('posts_count')->take(15)->get();

        return view('pages.blog', compact('posts', 'category', 'allCategories', 'allTags'));
    }

    public function tag(string $slug): View
    {
        $tag = Tag::where('slug', $slug)->firstOrFail();
        $posts = $tag->posts()->published()->with('categories', 'tagsRelation')->orderByDesc('published_at')->paginate(9);

        $allCategories = Category::whereHas('posts')->withCount('posts')->orderByDesc('posts_count')->get();
        $allTags = Tag::whereHas('posts')->withCount('posts')->orderByDesc('posts_count')->take(15)->get();

        return view('pages.blog', compact('posts', 'tag', 'allCategories', 'allTags'));
    }

    public function feed(): \Illuminate\Http\Response
    {
        $posts = Post::published()->orderByDesc('published_at')->take(20)->get();

        return response()->view('pages.blog-feed', compact('posts'))->header('Content-Type', 'application/xml');
    }
}
