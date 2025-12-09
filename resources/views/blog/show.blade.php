@extends('layouts.blog')

@php
$title = $post->seo_title;
$description = $post->seo_description;
$keywords = $post->meta_keywords;
$ogType = 'article';
$ogImage = $post->thumbnail_url ? url($post->thumbnail_url) : null;
$article = [
    'published_at' => $post->published_at?->toISOString(),
    'author' => $post->author?->name ?? 'Admin',
];
@endphp

<x-slot name="header">
    <div class="max-w-4xl">
        <nav class="flex items-center gap-2 text-sm text-white/70 mb-4">
            <a href="{{ route('blog.index') }}" class="hover:text-white transition-colors">Blog</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
            <span class="text-white/90 truncate">{{ $post->title }}</span>
        </nav>
        <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-white leading-tight">{{ $post->title }}</h1>
        <div class="mt-4 flex flex-wrap items-center gap-x-4 gap-y-2 text-sm text-white/80">
            <div class="flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                <span>{{ $post->author?->name ?? 'Admin' }}</span>
            </div>
            <div class="flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <time datetime="{{ $post->published_at?->toISOString() }}">
                    {{ $post->published_at?->format('F d, Y') ?? $post->created_at->format('F d, Y') }}
                </time>
            </div>
            <div class="flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
                <span>{{ number_format($post->views) }} views</span>
            </div>
        </div>
    </div>
</x-slot>

{{-- Main Content --}}
<article class="bg-white dark:bg-dark-elevated rounded-xl shadow-sm border border-slate-200 dark:border-dark-border overflow-hidden">
    {{-- Thumbnail --}}
    @if($post->thumbnail)
    <div class="aspect-video">
        <img src="{{ $post->thumbnail_url }}" 
             alt="{{ $post->title }}" 
             class="w-full h-full object-cover">
    </div>
    @endif

    {{-- Content --}}
    <div class="p-6 lg:p-8">
        @if($post->excerpt)
        <p class="text-lg text-slate-600 dark:text-slate-300 font-medium mb-6 pb-6 border-b border-slate-200 dark:border-dark-border">
            {{ $post->excerpt }}
        </p>
        @endif

        <div class="prose prose-slate dark:prose-invert max-w-none 
                    prose-headings:font-semibold 
                    prose-h2:text-xl prose-h2:mt-8 prose-h2:mb-4
                    prose-h3:text-lg prose-h3:mt-6 prose-h3:mb-3
                    prose-p:leading-relaxed
                    prose-a:text-primary-600 dark:prose-a:text-primary-400
                    prose-img:rounded-lg prose-img:shadow-md">
            {!! nl2br(e($post->content)) !!}
        </div>
    </div>

    {{-- Share --}}
    <div class="px-6 lg:px-8 py-5 bg-slate-50 dark:bg-dark-soft border-t border-slate-200 dark:border-dark-border">
        <div class="flex flex-wrap items-center justify-between gap-4">
            <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Share this article:</span>
            <div class="flex items-center gap-2">
                <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($post->title) }}" 
                   target="_blank" 
                   rel="noopener noreferrer"
                   class="p-2 rounded-lg text-slate-500 hover:text-sky-500 hover:bg-sky-50 dark:hover:bg-sky-900/20 transition-colors">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                    </svg>
                </a>
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" 
                   target="_blank" 
                   rel="noopener noreferrer"
                   class="p-2 rounded-lg text-slate-500 hover:text-blue-600 hover:bg-blue-50 dark:hover:bg-blue-900/20 transition-colors">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" />
                    </svg>
                </a>
                <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(url()->current()) }}" 
                   target="_blank" 
                   rel="noopener noreferrer"
                   class="p-2 rounded-lg text-slate-500 hover:text-blue-700 hover:bg-blue-50 dark:hover:bg-blue-900/20 transition-colors">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" />
                    </svg>
                </a>
                <button onclick="navigator.clipboard.writeText('{{ url()->current() }}')" 
                        class="p-2 rounded-lg text-slate-500 hover:text-slate-700 hover:bg-slate-100 dark:hover:bg-slate-700 transition-colors"
                        title="Copy link">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</article>

{{-- Related Posts --}}
@if($relatedPosts->isNotEmpty())
<div class="mt-8">
    <h2 class="text-lg font-semibold text-slate-900 dark:text-white mb-4">Related Articles</h2>
    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
        @foreach($relatedPosts as $relatedPost)
        <a href="{{ route('blog.show', $relatedPost) }}" class="group block bg-white dark:bg-dark-elevated rounded-xl shadow-sm border border-slate-200 dark:border-dark-border overflow-hidden hover:shadow-md transition-shadow">
            @if($relatedPost->thumbnail)
            <div class="aspect-video overflow-hidden">
                <img src="{{ $relatedPost->thumbnail_url }}" 
                     alt="" 
                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
            </div>
            @else
            <div class="aspect-video bg-gradient-to-br from-primary-100 to-primary-50 dark:from-primary-900/20 dark:to-primary-900/10 flex items-center justify-center">
                <svg class="w-8 h-8 text-primary-300 dark:text-primary-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                </svg>
            </div>
            @endif
            <div class="p-4">
                <h3 class="font-medium text-slate-900 dark:text-white group-hover:text-primary-600 dark:group-hover:text-primary-400 transition-colors line-clamp-2">
                    {{ $relatedPost->title }}
                </h3>
            </div>
        </a>
        @endforeach
    </div>
</div>
@endif

{{-- Sidebar --}}
<x-slot name="sidebar">
    {{-- Popular Posts --}}
    @if($popularPosts->isNotEmpty())
    <div class="bg-white dark:bg-dark-elevated rounded-xl shadow-sm border border-slate-200 dark:border-dark-border p-5">
        <h3 class="text-sm font-semibold text-slate-900 dark:text-white uppercase tracking-wider">
            Popular Posts
        </h3>
        <div class="mt-4 space-y-4">
            @foreach($popularPosts as $popularPost)
            <a href="{{ route('blog.show', $popularPost) }}" class="group flex items-start gap-3">
                @if($popularPost->thumbnail)
                <img src="{{ $popularPost->thumbnail_url }}" 
                     alt="" 
                     class="w-16 h-12 rounded-lg object-cover flex-shrink-0">
                @else
                <div class="w-16 h-12 rounded-lg bg-slate-100 dark:bg-dark-muted flex-shrink-0 flex items-center justify-center">
                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                @endif
                <div class="flex-1 min-w-0">
                    <h4 class="text-sm font-medium text-slate-900 dark:text-white group-hover:text-primary-600 dark:group-hover:text-primary-400 transition-colors line-clamp-2">
                        {{ $popularPost->title }}
                    </h4>
                    <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">
                        {{ number_format($popularPost->views) }} views
                    </p>
                </div>
            </a>
            @endforeach
        </div>
    </div>
    @endif

    {{-- Back to Blog --}}
    <div class="mt-6">
        <a href="{{ route('blog.index') }}" class="flex items-center gap-2 text-sm font-medium text-primary-600 dark:text-primary-400 hover:text-primary-700 dark:hover:text-primary-300 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back to Blog
        </a>
    </div>
</x-slot>
