<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Page;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    /**
     * Generate sitemap.xml
     */
    public function index(): Response
    {
        $posts = Post::published()
            ->orderByDesc('updated_at')
            ->get();

        // Get published pages if Page model has published scope
        $pages = [];
        if (class_exists('App\Models\Page')) {
            $pages = Page::where('is_published', true)->get();
        }

        $content = view('sitemap.index', compact('posts', 'pages'))->render();

        return response($content, 200)
            ->header('Content-Type', 'text/xml');
    }
}
