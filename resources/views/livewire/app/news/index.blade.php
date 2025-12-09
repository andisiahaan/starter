<div>
    <div class="max-w-4xl mx-auto">
        <div class="sm:flex sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-white">News & Announcements</h1>
                <p class="mt-1 text-sm text-slate-400">Stay updated with platform news and updates</p>
            </div>
        </div>

        <div class="mt-6">
            <select wire:model.live="typeFilter" class="rounded-md border-dark-border bg-dark-elevated text-white text-sm py-2 px-3">
                <option value="">All Types</option>
                @foreach($types as $key => $label)
                <option value="{{ $key }}">{{ $label }}</option>
                @endforeach
            </select>
        </div>

        <div class="mt-6 space-y-4">
            @forelse($newsList as $news)
            <a href="{{ route('app.news.show', $news) }}" class="block bg-dark-elevated rounded-lg border border-dark-border p-5 hover:border-primary-500/50 transition">
                <div class="flex items-start justify-between">
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-2">
                            @if($news->is_pinned)
                            <svg class="w-4 h-4 text-yellow-400 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M5 4a2 2 0 012-2h6a2 2 0 012 2v14l-5-2.5L5 18V4z" />
                            </svg>
                            @endif
                            <h3 class="text-white font-semibold truncate">{{ $news->title }}</h3>
                        </div>
                        <p class="text-sm text-slate-400 mt-2 line-clamp-2">{!! Str::limit(strip_tags($news->content), 150) !!}</p>
                        <p class="text-xs text-slate-500 mt-3">{{ $news->published_at?->format('M d, Y') ?? $news->created_at->format('M d, Y') }}</p>
                    </div>
                    <span class="ml-4 inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium flex-shrink-0
                        @if($news->type === 'warning') bg-yellow-900/30 text-yellow-400
                        @elseif($news->type === 'maintenance') bg-orange-900/30 text-orange-400
                        @elseif($news->type === 'update') bg-blue-900/30 text-blue-400
                        @else bg-primary-900/30 text-primary-400
                        @endif">
                        {{ $types[$news->type] ?? $news->type }}
                    </span>
                </div>
            </a>
            @empty
            <div class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                </svg>
                <h3 class="mt-2 text-sm font-medium text-white">No news</h3>
                <p class="mt-1 text-sm text-slate-400">Check back later for updates.</p>
            </div>
            @endforelse
        </div>

        <div class="mt-6">{{ $newsList->links() }}</div>
    </div>
</div>