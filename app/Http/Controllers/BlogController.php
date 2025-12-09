<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\View\View;

class BlogController extends Controller
{
    /**
     * Display blog listing page.
     */
    public function index(): View
    {
        $posts = Post::published()
            ->with('author')
            ->orderByDesc('published_at')
            ->paginate(9);

        $popularPosts = Post::published()
            ->popular()
            ->take(5)
            ->get();

        return view('blog.index', compact('posts', 'popularPosts'));
    }

    /**
     * Display a single blog post.
     */
    public function show(Post $post): View
    {
        // Only show published posts to non-admin
        if (!$post->isPublished() && !auth()->user()?->hasRole(['admin', 'superadmin'])) {
            abort(404);
        }

        // Increment view count
        $post->incrementViews();

        // Get popular posts for sidebar
        $popularPosts = Post::published()
            ->where('id', '!=', $post->id)
            ->popular()
            ->take(5)
            ->get();

        // Get related posts (random published posts excluding current)
        $relatedPosts = Post::published()
            ->where('id', '!=', $post->id)
            ->inRandomOrder()
            ->take(3)
            ->get();

        return view('blog.show', compact('post', 'popularPosts', 'relatedPosts'));
    }
}
