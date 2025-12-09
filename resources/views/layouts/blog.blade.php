<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- SEO Meta Tags --}}
    <title>{{ $title ?? 'Blog' }} - {{ setting('main.name', config('app.name')) }}</title>
    <meta name="description" content="{{ $description ?? setting('main.description', '') }}">
    <meta name="keywords" content="{{ $keywords ?? '' }}">

    {{-- Open Graph --}}
    <meta property="og:title" content="{{ $title ?? 'Blog' }} - {{ setting('main.name', config('app.name')) }}">
    <meta property="og:description" content="{{ $description ?? setting('main.description', '') }}">
    <meta property="og:type" content="{{ $ogType ?? 'website' }}">
    <meta property="og:url" content="{{ url()->current() }}">
    @if(isset($ogImage))
    <meta property="og:image" content="{{ $ogImage }}">
    @endif

    {{-- Article Schema for Blog Posts --}}
    @if(isset($article))
    <meta property="article:published_time" content="{{ $article['published_at'] ?? '' }}">
    <meta property="article:author" content="{{ $article['author'] ?? '' }}">
    @endif

    {{-- Canonical URL --}}
    <link rel="canonical" href="{{ url()->current() }}">

    @if(setting('main.favicon'))
    <link rel="icon" href="{{ Storage::url(setting('main.favicon')) }}" type="image/x-icon">
    @endif

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts & Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased text-slate-900 bg-white dark:bg-dark-base dark:text-white flex flex-col min-h-screen"
    x-data="{ 
          mobileMenuOpen: false,
          init() {
              const defaultTheme = '{{ setting('main.default_theme', 'system') }}';
              const savedTheme = localStorage.getItem('theme');
              
              if (savedTheme === 'dark' || (!savedTheme && defaultTheme === 'dark') || 
                  (!savedTheme && defaultTheme === 'system' && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                  document.documentElement.classList.add('dark');
              }
          }
      }"
    x-cloak>

    @include('layouts.partials.toast')

    @include('layouts.partials.navigation')

    {{-- Blog Header --}}
    @isset($header)
    <header class="bg-gradient-to-r from-primary-600 to-primary-700 dark:from-dark-elevated dark:to-dark-muted">
        <div class="max-w-7xl mx-auto px-4 py-8 sm:px-6 sm:py-12 lg:px-8 lg:py-16">
            {{ $header }}
        </div>
    </header>
    @endisset

    <main class="flex-grow">
        @include('layouts.partials.alert')
        
        {{-- Blog Content with Sidebar --}}
        <div class="max-w-7xl mx-auto px-4 py-8 sm:px-6 lg:px-8 lg:py-12">
            <div class="lg:flex lg:gap-8">
                {{-- Main Content --}}
                <div class="lg:flex-1 lg:max-w-[calc(100%-320px-2rem)]">
                    {{ $slot }}
                </div>

                {{-- Right Sidebar --}}
                <aside class="mt-8 lg:mt-0 lg:w-80 lg:flex-shrink-0">
                    {{ $sidebar ?? '' }}
                </aside>
            </div>
        </div>
    </main>

    @include('layouts.partials.footer')

    <script src="//unpkg.com/alpinejs" defer></script>
</body>

</html>
