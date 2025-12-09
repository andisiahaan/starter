<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Untitled' }} - {{ setting('main.name', config('app.name')) }}</title>
    <meta name="description" content="{{ setting('main.description', '') }}">

    @if(setting('main.favicon'))
    <link rel="icon" href="{{ Storage::url(setting('main.favicon')) }}" type="image/x-icon">
    @endif

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts & Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="font-sans antialiased h-full bg-slate-50 text-slate-900 dark:bg-dark-base dark:text-white"
    x-data="{ 
          sidebarOpen: false,
          init() {
              // Initialize theme from settings or localStorage
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

    <div class="min-h-full flex">
        <!-- Sidebar -->
        @include('layouts.partials.sidebar')

        <!-- Main Content Column -->
        <div class="flex-1 flex flex-col min-w-0 md:pl-64">
            <!-- Topbar -->
            @include('layouts.partials.topbar')

            <!-- Optional Header -->
            @isset($header)
            <header class="bg-white dark:bg-dark-elevated border-b border-slate-200 dark:border-dark-border">
                <div class="px-4 py-4 sm:px-6 md:px-8">
                    {{ $header }}
                </div>
            </header>
            @endisset

            <!-- Main Content -->
            <main class="flex-1 overflow-y-auto focus:outline-none p-4 md:p-6 lg:p-8">
                @include('layouts.partials.alert')
                {{ $slot }}
            </main>
        </div>
    </div>
    @livewire('livewire-modal')
    @livewireScripts
    
    {{-- Service Worker Registration --}}
    <script>
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register('/sw.js')
                    .then((registration) => {
                        console.log('[App] ServiceWorker registered:', registration.scope);
                    })
                    .catch((error) => {
                        console.error('[App] ServiceWorker registration failed:', error);
                    });
            });
        }
    </script>
</body>

</html>