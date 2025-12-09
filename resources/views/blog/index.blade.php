@extends('layouts.blog')

@section('title', 'Blog')

@push('meta')
<meta name="description" content="Read our latest articles and insights about digital services, social media marketing, and more.">
@endpush

@php
$title = 'Blog';
$description = 'Read our latest articles and insights about digital services, social media marketing, and more.';
@endphp

<x-slot name="header">
    <h1 class="text-3xl sm:text-4xl font-bold text-white">Blog</h1>
    <p class="mt-3 text-lg text-white/80">Insights, tips, and updates from our team</p>
</x-slot>

{{-- Main Content --}}
@if($posts->isEmpty())
    <div class="text-center py-12">
        <svg class="mx-auto h-12 w-12 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
        </svg>
        <h3 class="mt-2 text-lg font-medium text-slate-900 dark:text-white">No posts yet</h3>
        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Check back soon for new articles.</p>
    </div>
@else
    <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-1">
        @foreach($posts as $post)
        <article class="group bg-white dark:bg-dark-elevated rounded-xl shadow-sm border border-slate-200 dark:border-dark-border overflow-hidden hover:shadow-md transition-shadow">
            <a href="{{ route('blog.show', $post) }}" class="block">
                {{-- Thumbnail --}}
                @if($post->thumbnail)
                <div class="aspect-video overflow-hidden">
                    <img src="{{ $post->thumbnail_url }}" 
                         alt="{{ $post->title }}" 
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                </div>
                @else
                <div class="aspect-video bg-gradient-to-br from-primary-100 to-primary-50 dark:from-primary-900/20 dark:to-primary-900/10 flex items-center justify-center">
                    <svg class="w-12 h-12 text-primary-300 dark:text-primary-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                    </svg>
                </div>
                @endif

                {{-- Content --}}
                <div class="p-5">
                    <h2 class="text-lg font-semibold text-slate-900 dark:text-white group-hover:text-primary-600 dark:group-hover:text-primary-400 transition-colors line-clamp-2">
                        {{ $post->title }}
                    </h2>
                    
                    @if($post->excerpt)
                    <p class="mt-2 text-sm text-slate-600 dark:text-slate-400 line-clamp-3">
                        {{ $post->excerpt }}
                    </p>
                    @endif

                    <div class="mt-4 flex items-center justify-between text-xs text-slate-500 dark:text-slate-400">
                        <div class="flex items-center gap-2">
                            <span>{{ $post->author?->name ?? 'Admin' }}</span>
                            <span>•</span>
                            <time datetime="{{ $post->published_at?->toISOString() }}">
                                {{ $post->published_at?->format('M d, Y') ?? $post->created_at->format('M d, Y') }}
                            </time>
                        </div>
                        <span class="flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            {{ number_format($post->views) }}
                        </span>
                    </div>
                </div>
            </a>
        </article>
        @endforeach
    </div>

    {{-- Pagination --}}
    <div class="mt-8">
        {{ $posts->links() }}
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
</x-slot>
