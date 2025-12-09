<x-layouts.main title="API Documentation">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="lg:grid lg:grid-cols-4 lg:gap-8">
            {{-- Sidebar --}}
            <aside class="hidden lg:block">
                <div class="sticky top-24">
                    <div class="bg-white dark:bg-dark-elevated rounded-lg border border-slate-200 dark:border-dark-border overflow-hidden shadow-sm">
                        <div class="p-4 border-b border-slate-200 dark:border-dark-border">
                            <h2 class="font-semibold text-slate-900 dark:text-white">Documentation</h2>
                            <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">API v1.0</p>
                        </div>
                        <nav class="p-2">
                            @foreach($sections as $key => $section)
                            <a href="{{ route('docs.api', $key) }}" 
                               class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition {{ $currentSection === $key ? 'bg-primary-50 dark:bg-primary-600/20 text-primary-700 dark:text-primary-400 font-medium' : 'text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white hover:bg-slate-50 dark:hover:bg-dark-soft' }}">
                                @switch($section['icon'] ?? 'document')
                                    @case('rocket')
                                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.59 14.37a6 6 0 01-5.84 7.38v-4.8m5.84-2.58a14.98 14.98 0 006.16-12.12A14.98 14.98 0 009.631 8.41m5.96 5.96a14.926 14.926 0 01-5.841 2.58m-.119-8.54a6 6 0 00-7.381 5.84h4.8m2.581-5.84a14.927 14.927 0 00-2.58 5.84m2.699 2.7c-.103.021-.207.041-.311.06a15.09 15.09 0 01-2.448-2.448 14.9 14.9 0 01.06-.312m-2.24 2.39a4.493 4.493 0 00-1.757 4.306 4.493 4.493 0 004.306-1.758M16.5 9a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"/></svg>
                                    @break
                                    @case('user')
                                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                    @break
                                    @case('exclamation-triangle')
                                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                                    @break
                                    @default
                                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                @endswitch
                                <span>{{ $section['title'] }}</span>
                            </a>
                            @endforeach
                        </nav>
                        
                        <div class="p-4 border-t border-slate-200 dark:border-dark-border">
                            <div class="text-xs text-slate-500 dark:text-slate-400 mb-1">Base URL</div>
                            <code class="text-xs text-primary-600 dark:text-primary-400 break-all">{{ $baseUrl }}</code>
                        </div>
                    </div>
                </div>
            </aside>

            {{-- Main Content --}}
            <main class="lg:col-span-3">
                @php $sectionData = $sections[$currentSection] ?? []; @endphp

                <div class="mb-6">
                    <h1 class="text-2xl font-bold text-slate-900 dark:text-white">{{ $sectionData['title'] ?? 'Documentation' }}</h1>
                </div>

                {{-- Content blocks --}}
                @if(isset($sectionData['content']))
                    @foreach($sectionData['content'] as $block)
                    <div class="mb-6 p-6 bg-white dark:bg-dark-elevated rounded-xl border border-slate-200 dark:border-dark-border shadow-sm">
                        <h3 class="text-lg font-semibold text-slate-900 dark:text-white mb-3">{{ $block['title'] }}</h3>
                        <p class="text-slate-600 dark:text-slate-400 leading-relaxed">{{ $block['description'] }}</p>
                        
                        @if(isset($block['code']))
                        <div class="mt-4">
                            <pre class="bg-slate-50 dark:bg-dark-soft rounded-lg overflow-x-auto p-4"><code class="text-sm text-slate-700 dark:text-slate-300">{{ $block['code']['content'] }}</code></pre>
                        </div>
                        @endif
                    </div>
                    @endforeach
                @endif

                {{-- Endpoints --}}
                @if(isset($sectionData['endpoints']))
                    @foreach($sectionData['endpoints'] as $endpoint)
                    <div class="mb-6 bg-white dark:bg-dark-elevated rounded-xl border border-slate-200 dark:border-dark-border overflow-hidden shadow-sm">
                        <div class="p-6 border-b border-slate-200 dark:border-dark-border">
                            <div class="flex items-center gap-3 mb-3">
                                <span class="inline-flex items-center px-3 py-1 rounded-md text-xs font-semibold
                                    @if($endpoint['method'] === 'GET') bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400
                                    @elseif($endpoint['method'] === 'POST') bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400
                                    @elseif($endpoint['method'] === 'PUT') bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-400
                                    @else bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400
                                    @endif">{{ $endpoint['method'] }}</span>
                                <code class="text-sm text-slate-700 dark:text-slate-300">{{ $endpoint['path'] }}</code>
                            </div>
                            <h3 class="text-lg font-semibold text-slate-900 dark:text-white">{{ $endpoint['title'] }}</h3>
                            <p class="text-slate-600 dark:text-slate-400 mt-2">{{ $endpoint['description'] }}</p>
                            
                            @if(isset($endpoint['abilities']))
                            <div class="mt-3 flex items-center gap-2">
                                <span class="text-xs text-slate-500 dark:text-slate-400">Required abilities:</span>
                                @foreach($endpoint['abilities'] as $ability)
                                <span class="px-2 py-0.5 text-xs rounded bg-primary-100 dark:bg-primary-900/30 text-primary-700 dark:text-primary-400">{{ $ability }}</span>
                                @endforeach
                            </div>
                            @endif
                        </div>

                        @if(isset($endpoint['headers']))
                        <div class="p-6 border-b border-slate-200 dark:border-dark-border">
                            <h4 class="text-sm font-semibold text-slate-900 dark:text-white mb-3">Headers</h4>
                            <div class="bg-slate-50 dark:bg-dark-soft rounded-lg overflow-hidden">
                                <table class="w-full text-sm">
                                    @foreach($endpoint['headers'] as $key => $value)
                                    <tr class="border-b border-slate-200 dark:border-dark-border last:border-0">
                                        <td class="px-4 py-2.5 text-primary-600 dark:text-primary-400 font-mono">{{ $key }}</td>
                                        <td class="px-4 py-2.5 text-slate-600 dark:text-slate-400 font-mono">{{ $value }}</td>
                                    </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                        @endif

                        @if(isset($endpoint['response']))
                        <div class="p-6">
                            <h4 class="text-sm font-semibold text-slate-900 dark:text-white mb-3">Response</h4>
                            <pre class="bg-slate-50 dark:bg-dark-soft rounded-lg overflow-x-auto p-4"><code class="text-sm text-slate-700 dark:text-slate-300">{{ json_encode($endpoint['response'], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) }}</code></pre>
                        </div>
                        @endif
                    </div>
                    @endforeach
                @endif

                {{-- Error codes --}}
                @if(isset($sectionData['error_codes']))
                <div class="bg-white dark:bg-dark-elevated rounded-xl border border-slate-200 dark:border-dark-border overflow-hidden shadow-sm">
                    <div class="p-6 border-b border-slate-200 dark:border-dark-border">
                        <h3 class="text-lg font-semibold text-slate-900 dark:text-white">HTTP Status Codes</h3>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead class="bg-slate-50 dark:bg-dark-soft">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase">Code</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase">Description</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-200 dark:divide-dark-border">
                                @foreach($sectionData['error_codes'] as $error)
                                <tr class="hover:bg-slate-50 dark:hover:bg-dark-soft/50 transition">
                                    <td class="px-6 py-4">
                                        <span class="px-2 py-1 rounded text-xs font-mono {{ str_starts_with($error['code'], '2') ? 'bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400' : (str_starts_with($error['code'], '4') ? 'bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-400' : 'bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400') }}">
                                            {{ $error['code'] }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-slate-900 dark:text-white font-medium">{{ $error['status'] }}</td>
                                    <td class="px-6 py-4 text-slate-600 dark:text-slate-400">{{ $error['description'] }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @endif
            </main>
        </div>
    </div>

    {{-- Mobile Nav Toggle --}}
    <div class="lg:hidden fixed bottom-4 right-4 z-40">
        <button onclick="document.getElementById('mobile-docs-nav').classList.toggle('hidden')" class="p-3 bg-primary-600 text-white rounded-full shadow-lg hover:bg-primary-700 transition">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>
    </div>

    {{-- Mobile Nav --}}
    <div id="mobile-docs-nav" class="hidden lg:hidden fixed inset-0 z-50 bg-white dark:bg-dark-base">
        <div class="flex items-center justify-between p-4 border-b border-slate-200 dark:border-dark-border">
            <h2 class="font-semibold text-slate-900 dark:text-white">API Documentation</h2>
            <button onclick="document.getElementById('mobile-docs-nav').classList.add('hidden')" class="text-slate-400 hover:text-slate-600 dark:hover:text-white">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        <nav class="p-4 space-y-2">
            @foreach($sections as $key => $section)
            <a href="{{ route('docs.api', $key) }}" 
               class="block px-4 py-3 rounded-lg transition {{ $currentSection === $key ? 'bg-primary-100 dark:bg-primary-600/20 text-primary-700 dark:text-primary-400 font-medium' : 'text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-dark-soft' }}">
                {{ $section['title'] }}
            </a>
            @endforeach
        </nav>
    </div>
</x-layouts.main>
