<x-layouts.main :title="__('blog.title')">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-slate-900 dark:text-white mb-4">{{ __('blog.title') }}</h1>
            <p class="text-lg text-slate-600 dark:text-slate-400 max-w-2xl mx-auto">{{ __('blog.subtitle') }}</p>
        </div>

        <!-- Featured Posts -->
        @if($featuredPosts->isNotEmpty())
        <div class="mb-16">
            <h2 class="text-xl font-semibold text-slate-900 dark:text-white mb-6">{{ __('blog.featured_posts') }}</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($featuredPosts as $post)
                <a href="{{ route('blog.show', $post->slug) }}" class="group block bg-white dark:bg-dark-elevated rounded-xl border border-slate-200 dark:border-dark-border overflow-hidden hover:shadow-lg transition">
                    @if($post->featured_image)
                    <img src="{{ Storage::url($post->featured_image) }}" alt="{{ $post->title }}" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                    @else
                    <div class="w-full h-48 bg-gradient-to-br from-primary-500 to-primary-700 flex items-center justify-center">
                        <svg class="w-16 h-16 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 4v12l-4-2-4 2V4M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    @endif
                    <div class="p-5">
                        <div class="flex items-center gap-2 mb-3">
                            @if($post->primary_category)
                            <span class="px-2 py-1 text-xs font-medium bg-primary-100 dark:bg-primary-900/30 text-primary-700 dark:text-primary-400 rounded">{{ $post->primary_category->name }}</span>
                            @endif
                            <span class="text-xs text-slate-500 dark:text-slate-400">{{ $post->published_at->format('M d, Y') }}</span>
                        </div>
                        <h3 class="text-lg font-semibold text-slate-900 dark:text-white group-hover:text-primary-600 dark:group-hover:text-primary-400 transition">{{ $post->title }}</h3>
                        @if($post->excerpt)
                        <p class="mt-2 text-sm text-slate-600 dark:text-slate-400 line-clamp-2">{{ $post->excerpt }}</p>
                        @endif
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-3">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-semibold text-slate-900 dark:text-white">{{ __('blog.latest_posts') }}</h2>
                    <form action="{{ route('blog.index') }}" method="GET" class="relative">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="{{ __('blog.public.search') }}" class="pl-10 pr-4 py-2 rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-elevated text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 text-sm">
                        <svg class="w-5 h-5 text-slate-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </form>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @forelse($posts as $post)
                    <a href="{{ route('blog.show', $post->slug) }}" class="group block bg-white dark:bg-dark-elevated rounded-xl border border-slate-200 dark:border-dark-border overflow-hidden hover:shadow-lg hover:border-primary-500/30 transition">
                        @if($post->featured_image)
                        <img src="{{ Storage::url($post->featured_image) }}" alt="{{ $post->title }}" class="w-full h-40 object-cover">
                        @endif
                        <div class="p-5">
                            <div class="flex items-center gap-2 mb-2">
                                @if($post->primary_category)
                                <span class="px-2 py-0.5 text-xs font-medium bg-slate-100 dark:bg-dark-soft text-slate-600 dark:text-slate-400 rounded">{{ $post->primary_category->name }}</span>
                                @endif
                                <span class="text-xs text-slate-500 dark:text-slate-400">{{ __('blog.public.reading_time', ['count' => $post->reading_time]) }}</span>
                            </div>
                            <h3 class="font-semibold text-slate-900 dark:text-white group-hover:text-primary-600 dark:group-hover:text-primary-400 transition line-clamp-2">{{ $post->title }}</h3>
                            @if($post->excerpt)
                            <p class="mt-2 text-sm text-slate-600 dark:text-slate-400 line-clamp-2">{{ $post->excerpt }}</p>
                            @endif
                            <div class="flex items-center gap-2 mt-4 pt-4 border-t border-slate-100 dark:border-dark-border">
                                <span class="text-xs text-slate-500 dark:text-slate-400">{{ $post->author->name ?? 'Unknown' }}</span>
                                <span class="text-slate-300 dark:text-slate-600">•</span>
                                <span class="text-xs text-slate-500 dark:text-slate-400">{{ $post->published_at->format('M d, Y') }}</span>
                            </div>
                        </div>
                    </a>
                    @empty
                    <div class="col-span-2 text-center py-12">
                        <svg class="w-16 h-16 mx-auto text-slate-300 dark:text-slate-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                        </svg>
                        <p class="text-slate-500 dark:text-slate-400">{{ __('blog.public.no_posts') }}</p>
                    </div>
                    @endforelse
                </div>

                <div class="mt-8">
                    {{ $posts->links() }}
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Categories -->
                <div class="bg-white dark:bg-dark-elevated rounded-xl border border-slate-200 dark:border-dark-border p-5">
                    <h3 class="font-semibold text-slate-900 dark:text-white mb-4">{{ __('blog.public.categories') }}</h3>
                    <ul class="space-y-2">
                        @foreach($categories as $category)
                        <li>
                            <a href="{{ route('blog.category', $category->slug) }}" class="flex items-center justify-between text-sm text-slate-600 dark:text-slate-400 hover:text-primary-600 dark:hover:text-primary-400 transition">
                                <span>{{ $category->name }}</span>
                                <span class="px-2 py-0.5 bg-slate-100 dark:bg-dark-soft rounded text-xs">{{ $category->posts_count }}</span>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Tags -->
                @if($tags->isNotEmpty())
                <div class="bg-white dark:bg-dark-elevated rounded-xl border border-slate-200 dark:border-dark-border p-5">
                    <h3 class="font-semibold text-slate-900 dark:text-white mb-4">{{ __('blog.public.tags') }}</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach($tags as $tag)
                        <a href="{{ route('blog.tag', $tag->slug) }}" class="px-3 py-1 text-xs bg-slate-100 dark:bg-dark-soft text-slate-600 dark:text-slate-400 rounded-full hover:bg-primary-100 hover:text-primary-700 dark:hover:bg-primary-900/30 dark:hover:text-primary-400 transition">
                            {{ $tag->name }}
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-layouts.main>
