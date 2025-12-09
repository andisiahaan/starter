<div>
    <div class="max-w-3xl mx-auto">
        <div class="mb-6">
            <a href="{{ route('app.news.index') }}" class="text-primary-400 hover:text-primary-300 text-sm flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Back to News
            </a>
        </div>

        <article class="bg-dark-elevated rounded-lg border border-dark-border overflow-hidden">
            <div class="p-6 sm:p-8">
                <div class="flex items-start justify-between mb-4">
                    <span class="inline-flex items-center rounded-full px-3 py-1 text-sm font-medium
                        @if($news->type === 'warning') bg-yellow-900/30 text-yellow-400
                        @elseif($news->type === 'maintenance') bg-orange-900/30 text-orange-400
                        @elseif($news->type === 'update') bg-blue-900/30 text-blue-400
                        @else bg-primary-900/30 text-primary-400
                        @endif">
                        {{ \App\Models\News::types()[$news->type] ?? $news->type }}
                    </span>
                    <time class="text-sm text-slate-500">{{ $news->published_at?->format('F d, Y') ?? $news->created_at->format('F d, Y') }}</time>
                </div>

                <h1 class="text-2xl sm:text-3xl font-bold text-white mb-6">{{ $news->title }}</h1>

                <div class="prose prose-lg prose-invert max-w-none">
                    {!! $news->content !!}
                </div>
            </div>
        </article>
    </div>
</div>