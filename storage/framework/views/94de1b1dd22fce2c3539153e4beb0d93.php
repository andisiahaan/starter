<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(setting('main.name', config('app.name'))); ?> - Modern SaaS Platform</title>
    <meta name="description" content="<?php echo e(setting('main.description', 'Build and scale your business with our powerful SaaS platform.')); ?>">

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(setting('main.favicon')): ?>
    <link rel="icon" href="<?php echo e(Storage::url(setting('main.favicon'))); ?>" type="image/x-icon">
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800,900&display=swap" rel="stylesheet" />

    <!-- AOS Animation Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- Scripts & Styles -->
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

    <style>
        .gradient-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .hero-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
        }
        .card-gradient {
            background: linear-gradient(145deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0.05) 100%);
        }
        .glow {
            box-shadow: 0 0 60px rgba(102, 126, 234, 0.4);
        }
        .floating {
            animation: floating 3s ease-in-out infinite;
        }
        @keyframes floating {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        .pulse-glow {
            animation: pulse-glow 2s ease-in-out infinite;
        }
        @keyframes pulse-glow {
            0%, 100% { box-shadow: 0 0 20px rgba(102, 126, 234, 0.4); }
            50% { box-shadow: 0 0 40px rgba(102, 126, 234, 0.8); }
        }
    </style>
</head>

<body class="font-sans antialiased bg-slate-950 text-white overflow-x-hidden">
    <!-- Navigation -->
    <nav class="fixed top-0 left-0 right-0 z-50 bg-slate-950/80 backdrop-blur-xl border-b border-white/5">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-lg hero-gradient flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <span class="text-xl font-bold"><?php echo e(setting('main.name', config('app.name'))); ?></span>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center gap-8">
                    <a href="#features" class="text-slate-300 hover:text-white transition-colors">Features</a>
                    <a href="#pricing" class="text-slate-300 hover:text-white transition-colors">Pricing</a>
                    <a href="#testimonials" class="text-slate-300 hover:text-white transition-colors">Testimonials</a>
                    <a href="#faq" class="text-slate-300 hover:text-white transition-colors">FAQ</a>
                </div>

                <!-- Auth Buttons -->
                <div class="flex items-center gap-3">
                    <a href="<?php echo e(route('login')); ?>" class="text-slate-300 hover:text-white transition-colors px-4 py-2">
                        Login
                    </a>
                    <a href="<?php echo e(route('register')); ?>" class="bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 px-5 py-2 rounded-full font-medium transition-all hover:scale-105">
                        Get Started
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative min-h-screen flex items-center pt-16 overflow-hidden">
        <!-- Background Effects -->
        <div class="absolute inset-0">
            <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-purple-500/30 rounded-full blur-3xl"></div>
            <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-indigo-500/30 rounded-full blur-3xl"></div>
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[800px] bg-gradient-to-r from-indigo-500/10 to-purple-500/10 rounded-full blur-3xl"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
            <div class="text-center">
                <!-- Badge -->
                <div data-aos="fade-down" data-aos-duration="600" class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/5 border border-white/10 mb-8">
                    <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span>
                    <span class="text-sm text-slate-300">Trusted by 10,000+ businesses worldwide</span>
                </div>

                <!-- Headline -->
                <h1 data-aos="fade-up" data-aos-duration="800" class="text-5xl md:text-7xl font-black mb-6 leading-tight">
                    Build <span class="gradient-text">Faster</span>,<br>
                    Scale <span class="gradient-text">Smarter</span>
                </h1>

                <!-- Subheadline -->
                <p data-aos="fade-up" data-aos-delay="100" data-aos-duration="800" class="text-xl text-slate-400 max-w-2xl mx-auto mb-10">
                    The all-in-one platform for modern businesses. Manage users, billing, support, and more with our powerful and intuitive dashboard.
                </p>

                <!-- CTA Buttons -->
                <div data-aos="fade-up" data-aos-delay="200" data-aos-duration="800" class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="<?php echo e(route('register')); ?>" class="group relative inline-flex items-center justify-center gap-2 px-8 py-4 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-full font-semibold text-lg transition-all hover:scale-105 pulse-glow">
                        Start Free Trial
                        <svg class="w-5 h-5 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                    </a>
                    <a href="#demo" class="inline-flex items-center justify-center gap-2 px-8 py-4 bg-white/5 hover:bg-white/10 border border-white/10 rounded-full font-semibold text-lg transition-all">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M8 5v14l11-7z"/>
                        </svg>
                        Watch Demo
                    </a>
                </div>

                <!-- Stats -->
                <div data-aos="fade-up" data-aos-delay="300" data-aos-duration="800" class="grid grid-cols-3 gap-8 max-w-2xl mx-auto mt-16 pt-16 border-t border-white/10">
                    <div>
                        <div class="text-3xl md:text-4xl font-bold gradient-text">10K+</div>
                        <div class="text-slate-400 text-sm mt-1">Active Users</div>
                    </div>
                    <div>
                        <div class="text-3xl md:text-4xl font-bold gradient-text">99.9%</div>
                        <div class="text-slate-400 text-sm mt-1">Uptime</div>
                    </div>
                    <div>
                        <div class="text-3xl md:text-4xl font-bold gradient-text">24/7</div>
                        <div class="text-slate-400 text-sm mt-1">Support</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scroll Indicator -->
        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 animate-bounce">
            <svg class="w-6 h-6 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
            </svg>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-24 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center mb-16">
                <div data-aos="fade-up" class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-indigo-500/10 border border-indigo-500/20 mb-4">
                    <span class="text-indigo-400 text-sm font-medium">Features</span>
                </div>
                <h2 data-aos="fade-up" data-aos-delay="100" class="text-4xl md:text-5xl font-bold mb-4">
                    Everything you need to <span class="gradient-text">succeed</span>
                </h2>
                <p data-aos="fade-up" data-aos-delay="200" class="text-slate-400 text-lg max-w-2xl mx-auto">
                    Powerful features designed to help you manage and grow your business efficiently.
                </p>
            </div>

            <!-- Features Grid -->
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Feature 1 -->
                <div data-aos="fade-up" data-aos-delay="100" class="group p-6 rounded-2xl bg-white/5 border border-white/5 hover:border-indigo-500/30 transition-all hover:-translate-y-1">
                    <div class="w-12 h-12 rounded-xl bg-gradient-to-r from-indigo-500 to-purple-600 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">User Management</h3>
                    <p class="text-slate-400">Complete user management with roles, permissions, 2FA, and activity tracking.</p>
                </div>

                <!-- Feature 2 -->
                <div data-aos="fade-up" data-aos-delay="200" class="group p-6 rounded-2xl bg-white/5 border border-white/5 hover:border-indigo-500/30 transition-all hover:-translate-y-1">
                    <div class="w-12 h-12 rounded-xl bg-gradient-to-r from-green-500 to-emerald-600 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Credit System</h3>
                    <p class="text-slate-400">Flexible billing with credits, multiple payment gateways, and transaction history.</p>
                </div>

                <!-- Feature 3 -->
                <div data-aos="fade-up" data-aos-delay="300" class="group p-6 rounded-2xl bg-white/5 border border-white/5 hover:border-indigo-500/30 transition-all hover:-translate-y-1">
                    <div class="w-12 h-12 rounded-xl bg-gradient-to-r from-orange-500 to-red-600 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Support Tickets</h3>
                    <p class="text-slate-400">Built-in ticketing system with real-time notifications and priority management.</p>
                </div>

                <!-- Feature 4 -->
                <div data-aos="fade-up" data-aos-delay="100" class="group p-6 rounded-2xl bg-white/5 border border-white/5 hover:border-indigo-500/30 transition-all hover:-translate-y-1">
                    <div class="w-12 h-12 rounded-xl bg-gradient-to-r from-cyan-500 to-blue-600 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Smart Notifications</h3>
                    <p class="text-slate-400">Multi-channel notifications via email, database, and push with user preferences.</p>
                </div>

                <!-- Feature 5 -->
                <div data-aos="fade-up" data-aos-delay="200" class="group p-6 rounded-2xl bg-white/5 border border-white/5 hover:border-indigo-500/30 transition-all hover:-translate-y-1">
                    <div class="w-12 h-12 rounded-xl bg-gradient-to-r from-pink-500 to-rose-600 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">REST API</h3>
                    <p class="text-slate-400">Full-featured API with token authentication and granular permissions.</p>
                </div>

                <!-- Feature 6 -->
                <div data-aos="fade-up" data-aos-delay="300" class="group p-6 rounded-2xl bg-white/5 border border-white/5 hover:border-indigo-500/30 transition-all hover:-translate-y-1">
                    <div class="w-12 h-12 rounded-xl bg-gradient-to-r from-violet-500 to-purple-600 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Enterprise Security</h3>
                    <p class="text-slate-400">Two-factor authentication, activity logs, and comprehensive access control.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section id="pricing" class="py-24 relative">
        <div class="absolute inset-0">
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-indigo-500/10 rounded-full blur-3xl"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center mb-16">
                <div data-aos="fade-up" class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-green-500/10 border border-green-500/20 mb-4">
                    <span class="text-green-400 text-sm font-medium">Pricing</span>
                </div>
                <h2 data-aos="fade-up" data-aos-delay="100" class="text-4xl md:text-5xl font-bold mb-4">
                    Simple, <span class="gradient-text">transparent</span> pricing
                </h2>
                <p data-aos="fade-up" data-aos-delay="200" class="text-slate-400 text-lg max-w-2xl mx-auto">
                    Start free and scale as you grow. No hidden fees, no surprises.
                </p>
            </div>

            <!-- Pricing Cards -->
            <div class="grid md:grid-cols-3 gap-8 max-w-5xl mx-auto">
                <!-- Starter -->
                <div data-aos="fade-up" data-aos-delay="100" class="p-8 rounded-2xl bg-white/5 border border-white/10">
                    <h3 class="text-xl font-semibold mb-2">Starter</h3>
                    <p class="text-slate-400 mb-6">Perfect for trying out</p>
                    <div class="mb-6">
                        <span class="text-4xl font-bold">Free</span>
                    </div>
                    <ul class="space-y-3 mb-8">
                        <li class="flex items-center gap-2 text-slate-300">
                            <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            Up to 100 users
                        </li>
                        <li class="flex items-center gap-2 text-slate-300">
                            <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            Basic support
                        </li>
                        <li class="flex items-center gap-2 text-slate-300">
                            <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            Community access
                        </li>
                    </ul>
                    <a href="<?php echo e(route('register')); ?>" class="block w-full py-3 text-center rounded-full border border-white/20 hover:bg-white/5 transition-colors font-medium">
                        Get Started
                    </a>
                </div>

                <!-- Pro -->
                <div data-aos="fade-up" data-aos-delay="200" class="relative p-8 rounded-2xl bg-gradient-to-b from-indigo-500/20 to-purple-500/20 border border-indigo-500/30 scale-105">
                    <div class="absolute -top-4 left-1/2 -translate-x-1/2 px-4 py-1 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-full text-sm font-medium">
                        Most Popular
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Professional</h3>
                    <p class="text-slate-400 mb-6">For growing businesses</p>
                    <div class="mb-6">
                        <span class="text-4xl font-bold">$29</span>
                        <span class="text-slate-400">/month</span>
                    </div>
                    <ul class="space-y-3 mb-8">
                        <li class="flex items-center gap-2 text-slate-300">
                            <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            Unlimited users
                        </li>
                        <li class="flex items-center gap-2 text-slate-300">
                            <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            Priority support
                        </li>
                        <li class="flex items-center gap-2 text-slate-300">
                            <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            Advanced analytics
                        </li>
                        <li class="flex items-center gap-2 text-slate-300">
                            <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            API access
                        </li>
                    </ul>
                    <a href="<?php echo e(route('register')); ?>" class="block w-full py-3 text-center rounded-full bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 transition-colors font-medium">
                        Start Free Trial
                    </a>
                </div>

                <!-- Enterprise -->
                <div data-aos="fade-up" data-aos-delay="300" class="p-8 rounded-2xl bg-white/5 border border-white/10">
                    <h3 class="text-xl font-semibold mb-2">Enterprise</h3>
                    <p class="text-slate-400 mb-6">For large organizations</p>
                    <div class="mb-6">
                        <span class="text-4xl font-bold">Custom</span>
                    </div>
                    <ul class="space-y-3 mb-8">
                        <li class="flex items-center gap-2 text-slate-300">
                            <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            Everything in Pro
                        </li>
                        <li class="flex items-center gap-2 text-slate-300">
                            <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            Dedicated support
                        </li>
                        <li class="flex items-center gap-2 text-slate-300">
                            <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            Custom integrations
                        </li>
                        <li class="flex items-center gap-2 text-slate-300">
                            <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            SLA guarantee
                        </li>
                    </ul>
                    <a href="#" class="block w-full py-3 text-center rounded-full border border-white/20 hover:bg-white/5 transition-colors font-medium">
                        Contact Sales
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section id="testimonials" class="py-24 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center mb-16">
                <div data-aos="fade-up" class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-purple-500/10 border border-purple-500/20 mb-4">
                    <span class="text-purple-400 text-sm font-medium">Testimonials</span>
                </div>
                <h2 data-aos="fade-up" data-aos-delay="100" class="text-4xl md:text-5xl font-bold mb-4">
                    Loved by <span class="gradient-text">thousands</span>
                </h2>
                <p data-aos="fade-up" data-aos-delay="200" class="text-slate-400 text-lg max-w-2xl mx-auto">
                    See what our customers have to say about their experience.
                </p>
            </div>

            <!-- Testimonials Grid -->
            <div class="grid md:grid-cols-3 gap-6">
                <div data-aos="fade-up" data-aos-delay="100" class="p-6 rounded-2xl bg-white/5 border border-white/5">
                    <div class="flex items-center gap-1 mb-4">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php for($i = 0; $i < 5; $i++): ?>
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        <?php endfor; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                    <p class="text-slate-300 mb-6">"This platform has completely transformed how we manage our SaaS business. The credit system and user management are exactly what we needed."</p>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-r from-indigo-500 to-purple-600 flex items-center justify-center font-semibold">A</div>
                        <div>
                            <div class="font-medium">Ahmad Rizki</div>
                            <div class="text-sm text-slate-400">CEO, TechStartup</div>
                        </div>
                    </div>
                </div>

                <div data-aos="fade-up" data-aos-delay="200" class="p-6 rounded-2xl bg-white/5 border border-white/5">
                    <div class="flex items-center gap-1 mb-4">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php for($i = 0; $i < 5; $i++): ?>
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        <?php endfor; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                    <p class="text-slate-300 mb-6">"The notification system is incredible. Our customers love getting real-time updates, and the admin panel makes everything so easy to manage."</p>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-r from-green-500 to-emerald-600 flex items-center justify-center font-semibold">S</div>
                        <div>
                            <div class="font-medium">Sarah Chen</div>
                            <div class="text-sm text-slate-400">Product Manager, CloudCo</div>
                        </div>
                    </div>
                </div>

                <div data-aos="fade-up" data-aos-delay="300" class="p-6 rounded-2xl bg-white/5 border border-white/5">
                    <div class="flex items-center gap-1 mb-4">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php for($i = 0; $i < 5; $i++): ?>
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        <?php endfor; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                    <p class="text-slate-300 mb-6">"Setup was incredibly fast. Within an hour, we had a fully functional SaaS platform with authentication, billing, and support tickets."</p>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-r from-orange-500 to-red-600 flex items-center justify-center font-semibold">M</div>
                        <div>
                            <div class="font-medium">Michael Torres</div>
                            <div class="text-sm text-slate-400">Founder, AppLab</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section id="faq" class="py-24 relative">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center mb-16">
                <div data-aos="fade-up" class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-cyan-500/10 border border-cyan-500/20 mb-4">
                    <span class="text-cyan-400 text-sm font-medium">FAQ</span>
                </div>
                <h2 data-aos="fade-up" data-aos-delay="100" class="text-4xl md:text-5xl font-bold mb-4">
                    Frequently asked <span class="gradient-text">questions</span>
                </h2>
            </div>

            <!-- FAQ Items -->
            <div class="space-y-4" x-data="{ open: 1 }">
                <div data-aos="fade-up" data-aos-delay="100" class="rounded-2xl bg-white/5 border border-white/5 overflow-hidden">
                    <button @click="open = open === 1 ? null : 1" class="w-full flex items-center justify-between p-6 text-left">
                        <span class="font-medium">How do I get started?</span>
                        <svg class="w-5 h-5 transition-transform" :class="{ 'rotate-180': open === 1 }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="open === 1" x-collapse class="px-6 pb-6">
                        <p class="text-slate-400">Simply click "Get Started" and create your account. You'll have access to all features immediately with our free trial. No credit card required.</p>
                    </div>
                </div>

                <div data-aos="fade-up" data-aos-delay="200" class="rounded-2xl bg-white/5 border border-white/5 overflow-hidden">
                    <button @click="open = open === 2 ? null : 2" class="w-full flex items-center justify-between p-6 text-left">
                        <span class="font-medium">What payment methods do you support?</span>
                        <svg class="w-5 h-5 transition-transform" :class="{ 'rotate-180': open === 2 }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="open === 2" x-collapse class="px-6 pb-6">
                        <p class="text-slate-400">We support various payment methods including credit cards, bank transfers, and e-wallets through our integrated payment gateway.</p>
                    </div>
                </div>

                <div data-aos="fade-up" data-aos-delay="300" class="rounded-2xl bg-white/5 border border-white/5 overflow-hidden">
                    <button @click="open = open === 3 ? null : 3" class="w-full flex items-center justify-between p-6 text-left">
                        <span class="font-medium">Can I customize the platform?</span>
                        <svg class="w-5 h-5 transition-transform" :class="{ 'rotate-180': open === 3 }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="open === 3" x-collapse class="px-6 pb-6">
                        <p class="text-slate-400">Absolutely! The platform is built with customization in mind. You can modify themes, add custom features, and integrate with your existing tools via our API.</p>
                    </div>
                </div>

                <div data-aos="fade-up" data-aos-delay="400" class="rounded-2xl bg-white/5 border border-white/5 overflow-hidden">
                    <button @click="open = open === 4 ? null : 4" class="w-full flex items-center justify-between p-6 text-left">
                        <span class="font-medium">Is my data secure?</span>
                        <svg class="w-5 h-5 transition-transform" :class="{ 'rotate-180': open === 4 }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="open === 4" x-collapse class="px-6 pb-6">
                        <p class="text-slate-400">Security is our top priority. We use industry-standard encryption, two-factor authentication, and regular security audits to keep your data safe.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-24 relative">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div data-aos="fade-up" class="relative p-12 rounded-3xl overflow-hidden">
                <!-- Background -->
                <div class="absolute inset-0 bg-gradient-to-r from-indigo-600 to-purple-600"></div>
                <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width=\"30\" height=\"30\" viewBox=\"0 0 30 30\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\"%3E%3Cpath d=\"M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z\" fill=\"rgba(255,255,255,0.07)\"%3E%3C/path%3E%3C/svg%3E')] opacity-50"></div>

                <div class="relative text-center">
                    <h2 class="text-3xl md:text-4xl font-bold mb-4">Ready to get started?</h2>
                    <p class="text-white/80 text-lg mb-8 max-w-xl mx-auto">
                        Join thousands of businesses already using our platform. Start your free trial today.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="<?php echo e(route('register')); ?>" class="inline-flex items-center justify-center gap-2 px-8 py-4 bg-white text-indigo-600 rounded-full font-semibold text-lg hover:bg-slate-100 transition-all hover:scale-105">
                            Start Free Trial
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                            </svg>
                        </a>
                        <a href="#" class="inline-flex items-center justify-center gap-2 px-8 py-4 bg-white/10 hover:bg-white/20 border border-white/20 rounded-full font-semibold text-lg transition-all">
                            Talk to Sales
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-12 border-t border-white/5">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-8 mb-12">
                <!-- Brand -->
                <div>
                    <div class="flex items-center gap-2 mb-4">
                        <div class="w-8 h-8 rounded-lg hero-gradient flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                        </div>
                        <span class="text-xl font-bold"><?php echo e(setting('main.name', config('app.name'))); ?></span>
                    </div>
                    <p class="text-slate-400 text-sm">
                        The all-in-one platform for modern SaaS businesses.
                    </p>
                </div>

                <!-- Product -->
                <div>
                    <h4 class="font-semibold mb-4">Product</h4>
                    <ul class="space-y-2 text-sm text-slate-400">
                        <li><a href="#features" class="hover:text-white transition-colors">Features</a></li>
                        <li><a href="#pricing" class="hover:text-white transition-colors">Pricing</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Changelog</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Documentation</a></li>
                    </ul>
                </div>

                <!-- Company -->
                <div>
                    <h4 class="font-semibold mb-4">Company</h4>
                    <ul class="space-y-2 text-sm text-slate-400">
                        <li><a href="<?php echo e(route('page.show', 'about')); ?>" class="hover:text-white transition-colors">About Us</a></li>
                        <li><a href="<?php echo e(route('page.show', 'contact')); ?>" class="hover:text-white transition-colors">Contact Us</a></li>
                        <li><a href="<?php echo e(route('docs.api')); ?>" class="hover:text-white transition-colors">API Docs</a></li>
                    </ul>
                </div>

                <!-- Legal -->
                <div>
                    <h4 class="font-semibold mb-4">Legal</h4>
                    <ul class="space-y-2 text-sm text-slate-400">
                        <li><a href="<?php echo e(route('page.show', 'privacy-policy')); ?>" class="hover:text-white transition-colors">Privacy Policy</a></li>
                        <li><a href="<?php echo e(route('page.show', 'terms-of-service')); ?>" class="hover:text-white transition-colors">Terms of Service</a></li>
                        <li><a href="<?php echo e(route('page.show', 'refund-policy')); ?>" class="hover:text-white transition-colors">Refund Policy</a></li>
                        <li><a href="<?php echo e(route('page.show', 'disclaimer')); ?>" class="hover:text-white transition-colors">Disclaimer</a></li>
                    </ul>
                </div>
            </div>

            <div class="flex flex-col md:flex-row items-center justify-between pt-8 border-t border-white/5">
                <p class="text-slate-400 text-sm">
                    © <?php echo e(date('Y')); ?> <?php echo e(setting('main.name', config('app.name'))); ?>. All rights reserved.
                </p>
                <div class="flex items-center gap-4 mt-4 md:mt-0">
                    <a href="#" class="text-slate-400 hover:text-white transition-colors">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg>
                    </a>
                    <a href="#" class="text-slate-400 hover:text-white transition-colors">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
                    </a>
                    <a href="#" class="text-slate-400 hover:text-white transition-colors">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <!-- AOS Script -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            easing: 'ease-out-cubic',
            once: true,
            offset: 50
        });
    </script>
</body>

</html>
<?php /**PATH D:\Installed\Apps\laragon\www\starter\resources\views/home.blade.php ENDPATH**/ ?>