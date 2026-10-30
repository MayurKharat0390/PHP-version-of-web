<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($title ?? 'UHV PCCOE - Universal Human Values Cell') ?></title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="32x32" href="<?= asset('images/favicon.png') ?>">
    <link rel="icon" type="image/x-icon" href="<?= asset('favicon.ico') ?>">
    <link rel="shortcut icon" href="<?= asset('favicon.ico') ?>">
    <link rel="apple-touch-icon" href="<?= asset('images/favicon.png') ?>">

    <!-- SEO & Open Graph Meta Tags -->
    <meta name="description" content="UHV Cell, PCCOE - Dedicated to fostering harmony at all levels of human existence through value-based education and self-exploration.">
    <meta property="og:title" content="<?= e($title ?? 'UHV PCCOE - Universal Human Values Cell') ?>">
    <meta property="og:description" content="Dedicated to fostering harmony at all levels of human existence through value-based education and self-exploration.">
    <meta property="og:site_name" content="UHV PCCOE">
    <meta property="og:image" content="<?= asset('images/favicon.png') ?>">
    <meta name="application-name" content="UHV PCCOE">
    <meta name="google-site-verification" content="googlee5ff1cdad0d9acd2">
    <meta name="deployment-platform" content="php">

    <!-- Google Site Name Structured Data (Schema.org) -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "WebSite",
      "name": "UHV PCCOE",
      "alternateName": ["Universal Human Values PCCOE", "UHV Cell PCCOE", "PCCOE UHV"],
      "url": "https://uhv-website.vercel.app/"
    }
    </script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&display=swap"
        rel="stylesheet">

    <!-- HTMX -->
    <script src="https://unpkg.com/htmx.org@1.9.10"
        integrity="sha384-D1Kt99CQMDuVetoL1lrYwg5t+9QdHe7NLX/SoJYkXDFfX37iInKRy5xLSi8nO7UC"
        crossorigin="anonymous"></script>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            DEFAULT: '#0d9488', // Teal 600
                            50: '#f0fdfa',
                            100: '#ccfbf1',
                            200: '#99f6e4',
                            300: '#5eead4',
                            400: '#2dd4bf',
                            500: '#14b8a6',
                            600: '#0d9488',
                            700: '#0f766e',
                            800: '#115e59',
                            900: '#134e4a',
                        },
                        accent: {
                            DEFAULT: '#0ea5e9', // Sky Blue 500
                            50: '#f0f9ff',
                            100: '#e0f2fe',
                            200: '#bae6fd',
                            300: '#7dd3fc',
                            400: '#38bdf8',
                            500: '#0ea5e9',
                            600: '#0284c7',
                            700: '#0369a1',
                        },
                        harmony: {
                            DEFAULT: '#10b981', // Emerald 500
                            50: '#ecfdf5',
                            100: '#d1fae5',
                            200: '#a7f3d0',
                            300: '#6ee7b7',
                            400: '#34d399',
                            500: '#10b981',
                        }
                    },
                    fontFamily: {
                        sans: ['Outfit', 'sans-serif'],
                        serif: ['Playfair Display', 'serif'],
                    },
                    boxShadow: {
                        'glass': '0 8px 32px 0 rgba(31, 38, 135, 0.15)',
                        'glow-primary': '0 0 20px rgba(16, 185, 129, 0.4)',
                        'glow-accent': '0 0 20px rgba(245, 158, 11, 0.4)',
                        '3d': '0 20px 60px -15px rgba(0, 0, 0, 0.3)',
                    },
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                        'pulse-slow': 'pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                        'gradient': 'gradient 8s linear infinite',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0px)' },
                            '50%': { transform: 'translateY(-20px)' },
                        },
                        gradient: {
                            '0%, 100%': { backgroundPosition: '0% 50%' },
                            '50%': { backgroundPosition: '100% 50%' },
                        }
                    },
                    backgroundSize: {
                        '300%': '300%',
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Outfit', sans-serif;
            font-size: 18px;
            line-height: 1.7;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            color: #1e293b;
            position: relative;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.92);
            z-index: -1;
        }

        h1, h2, h3, h4, .font-serif {
            font-family: 'Playfair Display', serif;
        }

        .glass {
            background: rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .glass-strong {
            background: rgba(255, 255, 255, 0.85);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .card-3d {
            transition: transform 0.3s ease;
        }

        .card-3d:hover {
            transform: translateY(-5px);
        }

        .gradient-text {
            background: linear-gradient(90deg, #4f46e5, #10b981, #6366f1);
            background-size: 200% auto;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: textGradient 5s linear infinite;
        }

        @keyframes textGradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .slide-up {
            opacity: 0;
            transform: translateY(40px);
            animation: slideUp 1s cubic-bezier(0.2, 0.8, 0.2, 1) forwards;
        }

        @keyframes slideUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        ::-webkit-scrollbar {
            width: 10px;
        }

        ::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(180deg, #4f46e5, #10b981);
            border-radius: 10px;
        }

        @keyframes ticker {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }

        .animate-ticker {
            display: inline-flex;
            white-space: nowrap;
            animation: ticker 40s linear infinite;
        }

        .animate-ticker:hover {
            animation-play-state: paused;
        }
    </style>
</head>

<body class="flex flex-col min-h-screen selection:bg-primary-200 selection:text-primary-900">

    <!-- Floating Background Elements -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none z-0">
        <div class="absolute top-20 left-10 w-72 h-72 bg-accent-200 rounded-full mix-blend-multiply filter blur-2xl opacity-30 animate-float"></div>
        <div class="absolute bottom-20 right-20 w-80 h-80 bg-primary-200 rounded-full mix-blend-multiply filter blur-2xl opacity-30 animate-float" style="animation-delay: 3s;"></div>
    </div>

    <!-- Main College Header -->
    <header class="bg-[#fcfdfd] py-6 border-b border-gray-100/80 relative z-[60]">
        <div class="max-w-[95%] mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center text-center md:text-left gap-8">
                <!-- Left Logos -->
                <div class="flex items-center">
                    <img src="<?= asset('images/pccoe_logo.png') ?>" alt="PCCOE Logo"
                        class="h-16 md:h-24 w-auto drop-shadow-sm hover:scale-105 transition-transform duration-300">
                </div>

                <!-- Center Text Content -->
                <div class="flex flex-col items-center justify-center flex-grow text-center px-4">
                    <h2 class="text-primary-600 font-black text-[10px] md:text-xs tracking-[0.3em] uppercase leading-tight mb-2 opacity-80">
                        Pimpri Chinchwad Education Trust's
                    </h2>
                    <h1 class="bg-gradient-to-r from-amber-400 via-amber-600 to-amber-800 bg-clip-text text-transparent font-black text-xl md:text-4xl tracking-tight uppercase mb-3 font-serif leading-none">
                        Pimpri Chinchwad College of Engineering
                    </h1>
                    <div class="flex flex-wrap justify-center gap-x-3 gap-y-1.5 text-[10px] md:text-xs text-gray-500 font-bold">
                        <span class="whitespace-nowrap bg-gray-100/50 px-2 py-0.5 rounded shadow-sm">NBA Accredited</span>
                        <span class="whitespace-nowrap bg-gray-100/50 px-2 py-0.5 rounded shadow-sm">NAAC Accredited 'A' Grade</span>
                        <span class="whitespace-nowrap bg-gray-100/50 px-2 py-0.5 rounded shadow-sm">An Autonomous Institute</span>
                        <span class="whitespace-nowrap bg-gray-100/50 px-2 py-0.5 rounded shadow-sm">AICTE Approved</span>
                    </div>
                </div>

                <!-- Right Logo -->
                <div class="flex items-center">
                    <img src="<?= asset('images/ai_year_logo.png') ?>" alt="AI PCCOE Logo"
                        class="h-16 md:h-24 w-auto drop-shadow-sm hover:scale-105 transition-transform duration-300">
                </div>
            </div>
        </div>
    </header>

    <?php
    $currentUri = '/' . trim(explode('?', $_SERVER['REQUEST_URI'] ?? '/')[0], '/');
    if ($currentUri === '//') $currentUri = '/';
    ?>

    <!-- Distinguished Navigation Bar -->
    <nav class="sticky top-0 w-full z-50 transition-all duration-500" x-data="{ scrolled: false }"
        @scroll.window="scrolled = (window.pageYOffset > 20)"
        :class="scrolled ? 'bg-white/95 backdrop-blur-md shadow-2xl py-2' : 'bg-white py-4 shadow-sm'">
        <div class="max-w-[95%] mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <!-- Logo -->
                <a href="<?= url('') ?>" class="flex items-center space-x-4 group text-decoration-none">
                    <div class="relative">
                        <div class="absolute inset-0 bg-gradient-to-r from-primary-400 to-primary-600 rounded-2xl blur-md opacity-40 group-hover:opacity-100 transition-opacity"></div>
                        <div class="relative w-12 h-12 bg-white border-2 border-primary-500/20 rounded-2xl flex items-center justify-center font-serif font-black text-2xl text-primary-600 shadow-xl transform group-hover:scale-105 group-hover:-rotate-3 transition-all duration-500">
                            U
                        </div>
                    </div>
                    <div>
                        <span class="block text-3xl font-serif font-black bg-gradient-to-r from-primary-600 via-primary-800 to-primary-900 bg-clip-text text-transparent leading-none tracking-tighter">UHV</span>
                    </div>
                </a>

                <!-- Nav Menu -->
                <div class="hidden lg:flex items-center bg-gray-50/50 p-1.5 rounded-[2rem] border border-gray-100">
                    <a href="<?= url('') ?>" class="px-5 py-2.5 rounded-full text-[13px] font-black uppercase tracking-wider whitespace-nowrap transition-all duration-500 <?= $currentUri === '/' ? 'bg-primary-600 text-white shadow-glow-primary scale-105' : 'text-gray-600 hover:text-primary-700 hover:bg-white' ?>">Home</a>
                    <a href="<?= url('uhv-cell') ?>" class="px-5 py-2.5 rounded-full text-[13px] font-black uppercase tracking-wider whitespace-nowrap transition-all duration-500 <?= $currentUri === '/uhv-cell' ? 'bg-primary-600 text-white shadow-glow-primary scale-105' : 'text-gray-600 hover:text-primary-700 hover:bg-white' ?>">Institute UHV Cell</a>
                    <a href="<?= url('resources') ?>" class="px-5 py-2.5 rounded-full text-[13px] font-black uppercase tracking-wider whitespace-nowrap transition-all duration-500 <?= str_starts_with($currentUri, '/resources') ? 'bg-primary-600 text-white shadow-glow-primary scale-105' : 'text-gray-600 hover:text-primary-700 hover:bg-white' ?>">Resources</a>
                    <a href="<?= url('activities') ?>" class="px-5 py-2.5 rounded-full text-[13px] font-black uppercase tracking-wider whitespace-nowrap transition-all duration-500 <?= str_starts_with($currentUri, '/activities') ? 'bg-primary-600 text-white shadow-glow-primary scale-105' : 'text-gray-600 hover:text-primary-700 hover:bg-white' ?>">Activities</a>
                    <a href="<?= url('voices') ?>" class="px-5 py-2.5 rounded-full text-[13px] font-black uppercase tracking-wider whitespace-nowrap transition-all duration-500 <?= str_starts_with($currentUri, '/voices') ? 'bg-primary-600 text-white shadow-glow-primary scale-105' : 'text-gray-600 hover:text-primary-700 hover:bg-white' ?>">Impact Stories</a>
                    <a href="<?= url('innovations') ?>" class="px-5 py-2.5 rounded-full text-[13px] font-black uppercase tracking-wider whitespace-nowrap transition-all duration-500 <?= str_starts_with($currentUri, '/innovations') ? 'bg-primary-600 text-white shadow-glow-primary scale-105' : 'text-gray-600 hover:text-primary-700 hover:bg-white' ?>">Innovations</a>
                    <a href="<?= url('contact') ?>" class="px-5 py-2.5 rounded-full text-[13px] font-black uppercase tracking-wider whitespace-nowrap transition-all duration-500 <?= $currentUri === '/contact' ? 'bg-primary-600 text-white shadow-glow-primary scale-105' : 'text-gray-600 hover:text-primary-700 hover:bg-white' ?>">Contact Us</a>
                </div>

                <!-- User Actions & Visitor Counter -->
                <div class="hidden md:flex items-center space-x-3">
                    <?php if ($isAdmin): ?>
                        <div class="relative" x-data="{ userMenu: false }">
                            <button @click="userMenu = !userMenu" class="flex items-center gap-2 px-4 py-2 glass-strong rounded-full border border-purple-200 text-xs font-bold text-purple-800 hover:shadow-md transition-all">
                                <span class="w-2 h-2 rounded-full bg-purple-500"></span>
                                <span>Admin</span>
                                <svg class="w-3.5 h-3.5 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                            <div x-show="userMenu" @click.away="userMenu = false" class="absolute right-0 mt-2 w-44 bg-white rounded-2xl shadow-2xl py-2 z-50 border border-gray-100" style="display: none;">
                                <a href="<?= url('admin') ?>" class="block px-4 py-2 text-xs text-purple-700 hover:bg-purple-50 font-bold">⚙️ Admin Panel</a>
                                <div class="border-t border-gray-100 my-1"></div>
                                <a href="<?= url('logout') ?>" class="block px-4 py-2 text-xs text-red-600 hover:bg-red-50 font-medium">Sign Out</a>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Visitor Counter -->
                    <div class="inline-flex items-center gap-2.5 glass px-4 py-2 rounded-2xl shadow-sm border border-white/40">
                        <div class="flex h-2 w-2 relative">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-[8px] uppercase tracking-widest font-extrabold text-gray-400 leading-none mb-0.5">Visitors</span>
                            <span class="text-sm font-bold text-gray-700 leading-none" id="visitor-counter-val"><?= number_format($total_visitors ?: 1500) ?></span>
                        </div>
                    </div>
                </div>

                <!-- Mobile Menu Button -->
                <div class="md:hidden flex items-center gap-2">
                    <button @click="$dispatch('toggle-mobile-menu')" class="p-2 text-gray-700 hover:text-primary-600 glass rounded-xl">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Mobile Menu -->
    <div x-data="{ open: false }" @toggle-mobile-menu.window="open = !open" x-show="open"
        class="fixed inset-0 z-[100] md:hidden" style="display: none;">
        <div class="absolute inset-0 bg-black/40 backdrop-blur-sm" @click="open = false" x-transition.opacity></div>
        <div class="absolute right-0 top-0 h-full w-72 glass-strong shadow-2xl p-6 flex flex-col space-y-5 overflow-y-auto"
            x-transition:enter="transform transition ease-out duration-300" x-transition:enter-start="translate-x-full"
            x-transition:enter-end="translate-x-0">
            <button @click="open = false" class="self-end text-gray-500 hover:text-gray-900">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
            <a href="<?= url('') ?>" class="text-lg font-bold text-gray-800 hover:text-primary-600">Home</a>
            <a href="<?= url('uhv-cell') ?>" class="text-lg font-bold text-gray-800 hover:text-primary-600">Institute UHV Cell</a>
            <a href="<?= url('resources') ?>" class="text-lg font-bold text-gray-800 hover:text-primary-600">Resources</a>
            <a href="<?= url('activities') ?>" class="text-lg font-bold text-gray-800 hover:text-primary-600">Activities</a>
            <a href="<?= url('voices') ?>" class="text-lg font-bold text-gray-800 hover:text-primary-600">Impact Stories</a>
            <a href="<?= url('innovations') ?>" class="text-lg font-bold text-gray-800 hover:text-primary-600">Innovations</a>
            <a href="<?= url('faculty') ?>" class="text-lg font-bold text-gray-800 hover:text-primary-600">Faculty Mentors</a>
            <a href="<?= url('contact') ?>" class="text-lg font-bold text-gray-800 hover:text-primary-600">Contact Us</a>

            <?php if ($isAdmin): ?>
                <div class="border-t border-gray-200 pt-4">
                    <p class="text-xs uppercase font-extrabold text-purple-600 mb-2">Admin Portal</p>
                    <a href="<?= url('admin') ?>" class="block py-1.5 text-base font-bold text-purple-700">⚙️ Admin Panel</a>
                    <a href="<?= url('logout') ?>" class="block py-1.5 text-base font-bold text-red-600">Sign Out</a>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- News Ticker -->
    <div class="sticky top-[72px] md:top-[88px] z-40 bg-gradient-to-r from-primary-900 to-primary-700 text-white border-y border-accent-500/20 shadow-lg overflow-hidden py-2"
        x-data="{ scrolled: false }" @scroll.window="scrolled = (window.pageYOffset > 50)"
        :class="scrolled ? 'opacity-90 blur-[1px] hover:opacity-100 hover:blur-none transition-all duration-300' : ''">
        <div class="relative flex items-center px-4">
            <div class="flex-shrink-0 bg-accent-500 text-primary-900 text-[10px] font-extrabold uppercase tracking-widest px-4 py-1.5 z-10 shadow-xl flex items-center gap-2 rounded-lg">
                <span class="relative flex h-2 w-2">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-primary-900 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-primary-900"></span>
                </span>
                Updates
            </div>
            <div class="flex-grow overflow-hidden whitespace-nowrap mask-linear-fade flex items-center relative h-8">
                <div class="animate-ticker inline-flex items-center space-x-12 px-12 absolute left-0 text-accent-100">
                    <?php foreach ($ticker_updates as $update): ?>
                        <span class="text-sm font-semibold tracking-wide flex items-center gap-2">
                            <?php if (($update['icon_type'] ?? '') === 'update'): ?>
                                <svg class="w-4 h-4 fill-accent-400" viewBox="0 0 24 24"><path d="M12 2L6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 14H9V8h2v8zm4 0h-2V8h2v8z" /></svg>
                            <?php elseif (($update['icon_type'] ?? '') === 'event'): ?>
                                <svg class="w-4 h-4 fill-accent-400" viewBox="0 0 24 24"><path d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11zM7 10h5v5H7z" /></svg>
                            <?php else: ?>
                                <svg class="w-4 h-4 fill-accent-400" viewBox="0 0 24 24"><path d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2z" /></svg>
                            <?php endif; ?>
                            <?= e($update['text']) ?>
                        </span>
                    <?php endforeach; ?>
                    <!-- Duplicate for seamless looping -->
                    <?php foreach ($ticker_updates as $update): ?>
                        <span class="text-sm font-semibold tracking-wide flex items-center gap-2">
                            <?php if (($update['icon_type'] ?? '') === 'update'): ?>
                                <svg class="w-4 h-4 fill-accent-400" viewBox="0 0 24 24"><path d="M12 2L6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 14H9V8h2v8zm4 0h-2V8h2v8z" /></svg>
                            <?php elseif (($update['icon_type'] ?? '') === 'event'): ?>
                                <svg class="w-4 h-4 fill-accent-400" viewBox="0 0 24 24"><path d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11zM7 10h5v5H7z" /></svg>
                            <?php else: ?>
                                <svg class="w-4 h-4 fill-accent-400" viewBox="0 0 24 24"><path d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2z" /></svg>
                            <?php endif; ?>
                            <?= e($update['text']) ?>
                        </span>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <main class="flex-grow pt-4 page-transition relative z-10">
        <?php if (!empty($flashSuccess)): ?>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-6">
                <div class="glass-strong border border-emerald-300 text-emerald-800 px-5 py-4 rounded-2xl shadow-glass flex items-center">
                    <svg class="w-5 h-5 mr-3 text-emerald-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="font-medium"><?= e($flashSuccess) ?></span>
                </div>
            </div>
        <?php endif; ?>

        <?php if (!empty($flashError)): ?>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-6">
                <div class="glass-strong border border-red-300 text-red-800 px-5 py-4 rounded-2xl shadow-glass flex items-center">
                    <svg class="w-5 h-5 mr-3 text-red-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="font-medium"><?= e($flashError) ?></span>
                </div>
            </div>
        <?php endif; ?>

        <?php if (!empty($flashInfo)): ?>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-6">
                <div class="glass-strong border border-primary-200 text-primary-900 px-5 py-4 rounded-2xl shadow-glass flex items-center">
                    <svg class="w-5 h-5 mr-3 text-primary-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="font-medium"><?= e($flashInfo) ?></span>
                </div>
            </div>
        <?php endif; ?>

        <?= $content ?>
    </main>

    <!-- Footer -->
    <footer class="glass-strong border-t border-white/30 mt-20 relative overflow-hidden z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 relative">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12">
                <div class="md:col-span-2">
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="w-12 h-12 bg-gradient-to-br from-primary-600 to-primary-800 rounded-2xl flex items-center justify-center font-serif font-bold text-2xl text-white shadow-lg">U</div>
                        <span class="font-serif font-bold text-3xl gradient-text">UHV PCCOE</span>
                    </div>
                    <p class="text-gray-600 leading-relaxed text-lg max-w-md mb-8">
                        Dedicated to fostering harmony at all levels of human existence through value-based education and self-exploration.
                    </p>
                </div>

                <div>
                    <h4 class="font-serif font-bold text-xl mb-6 text-gray-900 border-b-2 border-emerald-500 w-fit pb-1">Quick Explore</h4>
                    <ul class="space-y-4 text-gray-600 font-medium">
                        <li><a href="<?= url('') ?>" class="hover:text-primary-600 transition-all flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-primary-400"></span> Home</a></li>
                        <li><a href="<?= url('uhv-cell') ?>" class="hover:text-primary-600 transition-all flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-primary-400"></span> UHV Cell</a></li>
                        <li><a href="<?= url('activities') ?>" class="hover:text-primary-600 transition-all flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-primary-400"></span> Activities</a></li>
                        <li><a href="<?= url('innovations') ?>" class="hover:text-primary-600 transition-all flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-primary-400"></span> Innovations</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-serif font-bold text-xl mb-6 text-gray-900 border-b-2 border-primary-500 w-fit pb-1">Our Philosophy</h4>
                    <p class="text-gray-600 leading-relaxed italic text-base border-l-4 border-indigo-100 pl-4">
                        "Education is the development of consciousness to lead a life of fulfillment and contribute to universal well-being."
                    </p>
                </div>
            </div>

            <div class="border-t border-gray-200/50 mt-16 pt-8 flex flex-col md:flex-row justify-between items-center gap-6 text-sm text-gray-500">
                <p>&copy; <?= date('Y') ?> Universal Human Values Cell - PCCOE. All rights reserved.</p>
                <div class="flex items-center gap-6">
                    <a href="<?= url('contact') ?>" class="hover:text-primary-600 transition-colors">Support</a>
                    <a href="#" class="hover:text-primary-600 transition-colors">Privacy Policy</a>
                    <a href="#" class="hover:text-primary-600 transition-colors">Feedback</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Event Announcement Flyer Modal (Only on Homepage) -->
    <?php if ($currentUri === '/'): ?>
    <div id="flyer-modal"
        class="fixed inset-0 z-[150] flex items-center justify-center p-3 sm:p-4 md:p-6 transition-all duration-300 opacity-0 pointer-events-none"
        role="dialog"
        aria-modal="true"
        aria-label="Event Flyer Announcement">

        <div class="fixed inset-0 bg-black/80 backdrop-blur-sm transition-opacity" onclick="closeFlyerModal()" aria-hidden="true"></div>

        <div class="relative z-10 flex flex-col items-center justify-center max-w-[95vw] max-h-[96vh] animate-float">
            <button onclick="closeFlyerModal()"
                type="button"
                aria-label="Close Flyer"
                class="absolute -top-3 -right-3 sm:-top-4 sm:-right-4 z-30 w-9 h-9 sm:w-11 sm:h-11 rounded-full bg-white text-gray-800 shadow-2xl border-2 border-gray-200 flex items-center justify-center hover:bg-red-50 hover:text-red-600 hover:border-red-300 hover:scale-110 active:scale-95 transition-all duration-200 cursor-pointer">
                <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>

            <div class="relative rounded-2xl sm:rounded-3xl overflow-hidden shadow-2xl border-2 border-white/20 bg-slate-950 flex items-center justify-center">
                <img src="<?= asset('images/flyers/parent_meet_2026.jpg') ?>"
                    alt="PCCOE UHV Cell - Beyond Academics: Building Bonds that Last"
                    class="block w-auto h-auto max-w-[90vw] sm:max-w-md md:max-w-lg lg:max-w-[460px] max-h-[82vh] sm:max-h-[85vh] object-contain rounded-2xl sm:rounded-3xl select-none"
                    loading="eager" />
            </div>

            <button onclick="closeFlyerModal()"
                type="button"
                class="mt-2.5 inline-flex items-center gap-1.5 text-xs sm:text-sm font-semibold text-white/90 hover:text-white bg-white/10 hover:bg-white/20 border border-white/20 backdrop-blur-md px-4 py-1.5 rounded-full transition-all shadow-md hover:scale-105 active:scale-95 cursor-pointer">
                <span>✕ Close & Continue to Website</span>
            </button>
        </div>
    </div>

    <script>
        function openFlyerModal() {
            const modal = document.getElementById('flyer-modal');
            if (modal) {
                modal.classList.remove('opacity-0', 'pointer-events-none');
                modal.classList.add('opacity-100', 'pointer-events-auto');
                document.body.style.overflow = 'hidden';
            }
        }

        function closeFlyerModal() {
            const modal = document.getElementById('flyer-modal');
            if (modal) {
                modal.classList.remove('opacity-100', 'pointer-events-auto');
                modal.classList.add('opacity-0', 'pointer-events-none');
                document.body.style.overflow = '';
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            setTimeout(openFlyerModal, 400);
        });

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                closeFlyerModal();
            }
        });
    </script>
    <?php endif; ?>

</body>
</html>
