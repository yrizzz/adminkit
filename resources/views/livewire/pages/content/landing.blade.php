<div x-data="{ 
        activeDemo: 'sales',
        activeTab: 'composer',
        copied: false,
        activeFaq: null,
        mobileMenuOpen: false,
        scrolled: false,
        init() {
            this.scrolled = (window.scrollY || window.pageYOffset) > 20;
        },
        copyCommand(text) {
            navigator.clipboard.writeText(text);
            this.copied = true;
            setTimeout(() => this.copied = false, 2000);
        }
     }" 
     x-on:scroll.window.passive="scrolled = ((window.scrollY || window.pageYOffset) > 20)"
     class="min-h-screen bg-slate-50 dark:bg-[#070B14] text-slate-900 dark:text-white antialiased selection:bg-blue-600/30 selection:text-blue-400 relative overflow-x-clip font-sans">

    {{-- Smooth Organic Ambient Spotlights (No Grid Pattern) --}}
    <div class="pointer-events-none fixed inset-0 z-0 overflow-hidden opacity-40 dark:opacity-100">
        <div class="absolute -top-40 left-1/2 -translate-x-1/2 w-[1000px] h-[500px] bg-blue-600/15 rounded-full blur-[140px]"></div>
        <div class="absolute top-1/3 -right-40 w-[600px] h-[600px] bg-indigo-600/10 rounded-full blur-[160px]"></div>
        <div class="absolute bottom-10 -left-40 w-[600px] h-[600px] bg-blue-700/10 rounded-full blur-[160px]"></div>
    </div>

    {{-- Top Glassmorphic Pro Navbar --}}
    <header :class="scrolled || mobileMenuOpen ? 'bg-white/95 dark:bg-[#0D1527]/95 backdrop-blur-xl border-slate-200 dark:border-slate-800/80 py-3 shadow-xl shadow-black/5 dark:shadow-black/40' : 'bg-transparent border-transparent backdrop-blur-none py-4'" class="landing-header sticky top-0 z-50 w-full border-b transition-all duration-300">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-3 sm:px-6 gap-2">
            {{-- Brand Logo --}}
            <a href="{{ route('landing') }}" wire:navigate class="flex items-center gap-2.5 sm:gap-3 group shrink-0">
                <span class="grid size-9 shrink-0 place-items-center rounded-xl bg-gradient-to-br from-blue-500 to-blue-700 text-white shadow-lg shadow-blue-600/40 transition-transform group-hover:scale-105">
                    <x-ui.icon name="gem" class="size-5" />
                </span>
                <div class="flex flex-col">
                    <span class="text-xl font-black tracking-tight text-slate-900 dark:text-white leading-none">AdminKit</span>
                    <span class="text-[10px] font-mono text-blue-500 dark:text-blue-400 font-semibold leading-tight mt-0.5">v1.2.0</span>
                </div>
            </a>

            {{-- Navigation Links (Desktop) --}}
            <nav class="hidden md:flex items-center gap-8 text-xs sm:text-sm font-medium text-slate-600 dark:text-slate-300">
                <a href="#features" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Features</a>
                <a href="#showcase" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Preview Demos</a>
                <a href="#tech" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Tech Stack</a>
                <a href="#quickstart" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Quickstart</a>
                <a href="#faq" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">FAQ</a>
                <a href="{{ route('page', ['path' => 'docs']) }}" wire:navigate class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Documentation</a>
            </nav>

            {{-- Right Actions & Mobile Hamburger --}}
            <div class="flex items-center gap-2 sm:gap-3 shrink-0">
                {{-- Theme Switcher Button --}}
                <button type="button" x-on:click="$store.ui.toggleTheme($event)" class="size-9 grid place-items-center rounded-xl border border-slate-200 dark:border-slate-700/80 bg-white dark:bg-slate-800/80 text-slate-600 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white hover:border-blue-500/60 transition-all shadow-md" title="Toggle Light / Dark Theme">
                    <x-ui.icon name="moon" x-show="!$store.ui.isDark" class="size-4" />
                    <x-ui.icon name="sun" x-show="$store.ui.isDark" class="size-4" />
                </button>

                <a href="https://github.com/yrizzz/adminkit" target="_blank"
                   class="hidden sm:inline-flex items-center gap-2 rounded-xl border border-slate-200 dark:border-slate-700/80 bg-white dark:bg-slate-800/80 px-3.5 py-2 text-xs font-semibold text-slate-800 dark:text-white hover:bg-slate-50 dark:hover:bg-slate-700 hover:border-blue-500/60 transition-all shadow-md">
                    <x-ui.icon name="github" class="size-4 text-slate-800 dark:text-white" />
                    <span>Star on GitHub</span>
                    <span class="ms-0.5 rounded-md bg-blue-600/30 px-1.5 py-0.5 text-[10px] font-mono text-blue-500 dark:text-blue-400 border border-blue-500/40">3.2k</span>
                </a>

                {{-- Hamburger Button (Mobile Only) --}}
                <button type="button" x-on:click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden p-2 rounded-xl border border-slate-200 dark:border-slate-700/80 bg-white dark:bg-slate-800/80 text-slate-600 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white transition-colors shrink-0" aria-label="Toggle Navigation">
                    <x-ui.icon name="menu" x-show="!mobileMenuOpen" class="size-5" />
                    <x-ui.icon name="x" x-show="mobileMenuOpen" x-cloak class="size-5" />
                </button>
            </div>
        </div>

        {{-- Mobile Navigation Dropdown --}}
        <div x-show="mobileMenuOpen" 
             x-cloak 
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-2"
             class="md:hidden border-t border-slate-800/80 bg-[#0D1527]/98 px-4 py-4 space-y-3 shadow-2xl backdrop-blur-2xl"
        >
            <nav class="flex flex-col gap-1 text-sm sm:text-base font-semibold text-slate-200">
                <a href="#features" x-on:click="mobileMenuOpen = false" class="px-4 py-3 rounded-xl hover:bg-blue-600/15 hover:text-white transition-colors flex items-center justify-between">
                    <span>Features</span>
                    <x-ui.icon name="chevron-right" class="size-4 text-slate-500" />
                </a>
                <a href="#showcase" x-on:click="mobileMenuOpen = false" class="px-4 py-3 rounded-xl hover:bg-blue-600/15 hover:text-white transition-colors flex items-center justify-between">
                    <span>Preview Demos</span>
                    <x-ui.icon name="chevron-right" class="size-4 text-slate-500" />
                </a>
                <a href="#tech" x-on:click="mobileMenuOpen = false" class="px-4 py-3 rounded-xl hover:bg-blue-600/15 hover:text-white transition-colors flex items-center justify-between">
                    <span>Tech Stack</span>
                    <x-ui.icon name="chevron-right" class="size-4 text-slate-500" />
                </a>
                <a href="#quickstart" x-on:click="mobileMenuOpen = false" class="px-4 py-3 rounded-xl hover:bg-blue-600/15 hover:text-white transition-colors flex items-center justify-between">
                    <span>Quickstart</span>
                    <x-ui.icon name="chevron-right" class="size-4 text-slate-500" />
                </a>
                <a href="#faq" x-on:click="mobileMenuOpen = false" class="px-4 py-3 rounded-xl hover:bg-blue-600/15 hover:text-white transition-colors flex items-center justify-between">
                    <span>FAQ</span>
                    <x-ui.icon name="chevron-right" class="size-4 text-slate-500" />
                </a>

                <div class="pt-2 space-y-2.5 border-t border-slate-800/60 mt-1">
                    <a href="{{ route('page', ['path' => 'docs']) }}" wire:navigate x-on:click="mobileMenuOpen = false" class="h-12 w-full inline-flex items-center justify-between rounded-xl bg-gradient-to-r from-blue-600 to-blue-700 px-4 text-sm font-extrabold text-white hover:from-blue-500 hover:to-blue-600 transition-all shadow-lg shadow-blue-600/30">
                        <span class="flex items-center gap-2.5">
                            <x-ui.icon name="book-open" class="size-4.5 text-white" />
                            <span>Pro Documentation</span>
                        </span>
                        <x-ui.icon name="arrow-right" class="size-4.5 text-white" />
                    </a>
                    <a href="https://github.com/yrizzz/adminkit" target="_blank" class="h-12 w-full inline-flex items-center justify-between rounded-xl border border-slate-700/90 bg-slate-800/80 px-4 text-sm font-bold text-white hover:bg-slate-700/90 transition-all backdrop-blur shadow-md">
                        <span class="flex items-center gap-2.5">
                            <x-ui.icon name="github" class="size-4.5 text-white" />
                            <span>Star on GitHub</span>
                        </span>
                        <span class="rounded-md bg-blue-500/20 px-2 py-0.5 text-xs font-mono font-bold text-blue-400 border border-blue-500/30">3.2k</span>
                    </a>
                </div>
            </nav>
        </div>
    </header>

    {{-- Main Content --}}
    <main class="relative z-10">

        {{-- HERO SECTION (100dvh Full Device Height) --}}
        <section class="relative min-h-[calc(100dvh-65px)] flex items-center justify-center py-6 sm:py-16 px-4 sm:px-6 overflow-hidden">
            <div class="mx-auto max-w-7xl relative z-10 grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-8 items-center w-full">
                
                {{-- Left Text Column --}}
                <div class="lg:col-span-6 space-y-5 sm:space-y-6 text-center lg:text-start">
                    {{-- Pro Badges --}}
                    <div class="inline-flex items-center gap-2.5 flex-wrap justify-center lg:justify-start">
                        <span class="rounded-full bg-blue-600/20 px-4 py-1.5 text-xs font-extrabold text-blue-400 border border-blue-500/40 uppercase tracking-wider flex items-center gap-2 shadow-sm">
                            <span class="size-2 rounded-full bg-blue-500 animate-pulse"></span>
                            OPEN SOURCE MIT
                        </span>
                        <span class="rounded-full bg-emerald-600/20 px-4 py-1.5 text-xs font-extrabold text-emerald-400 border border-emerald-500/40 uppercase tracking-wider flex items-center gap-2 shadow-sm">
                            <x-ui.icon name="file-code" class="size-3.5 text-emerald-400" />
                            STATIC HTML VERSION (129 PAGES)
                        </span>
                        <span class="rounded-full bg-white dark:bg-slate-800/90 px-4 py-1.5 text-xs font-semibold text-slate-600 dark:text-slate-300 border border-slate-200 dark:border-slate-700/80 backdrop-blur shadow-sm">
                            100% Free Forever
                        </span>
                    </div>

                    {{-- Pro Headline --}}
                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-[1.12] text-slate-900 dark:text-white">
                        Admin Dashboard <br />
                        Modern, Clean, <br />
                        and <span class="bg-gradient-to-r from-blue-600 via-blue-700 to-indigo-600 dark:from-blue-400 dark:via-blue-50 dark:via-blue-500 dark:to-indigo-400 bg-clip-text text-transparent underline decoration-blue-500/40 underline-offset-8">Powerful Pro</span>
                    </h1>

                    {{-- Description --}}
                    <p class="text-slate-650 dark:text-slate-300 text-sm sm:text-base leading-relaxed max-w-xl mx-auto lg:mx-0 font-normal">
                        The ultimate enterprise admin panel boilerplate powered by <strong>Laravel 13, Livewire 4, and Tailwind CSS v4</strong>. Ships with <strong>13 dashboard templates</strong>, 40+ Blade components, real-time theme customizer, and <strong>129 pre-rendered Static HTML pages</strong> ready to deploy anywhere without a server.
                    </p>

                    {{-- Action Buttons --}}
                    <div class="pt-2 flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-3.5 w-full sm:w-auto">
                        <a href="https://github.com/yrizzz/adminkit" target="_blank"
                           class="h-12 w-full sm:w-auto inline-flex items-center justify-center gap-2.5 rounded-xl bg-gradient-to-r from-blue-600 to-blue-700 px-6 text-sm sm:text-base font-extrabold text-white hover:from-blue-500 hover:to-blue-600 transition-all shadow-md shadow-blue-600/20 hover:scale-[1.01] active:scale-[0.99] shrink-0">
                            <x-ui.icon name="star" class="size-4 fill-white" />
                            <span>Star on GitHub</span>
                            <span class="rounded bg-white/20 px-1.5 py-0.5 text-xs font-mono">3.2k</span>
                        </a>

                        <a href="{{ route('dashboard') }}" wire:navigate
                           class="h-12 w-full sm:w-auto inline-flex items-center justify-center gap-2.5 rounded-xl border border-slate-200 dark:border-slate-700/90 bg-white dark:bg-slate-800/80 px-6 text-sm sm:text-base font-semibold text-slate-800 dark:text-slate-200 hover:bg-slate-50 dark:hover:bg-slate-700/90 hover:text-slate-900 dark:hover:text-white hover:border-blue-500/50 transition-all backdrop-blur shadow-md shrink-0">
                            <x-ui.icon name="layout-dashboard" class="size-4 text-blue-500 dark:text-blue-400" />
                            <span>Dashboard</span>
                        </a>
                    </div>

                    {{-- Social Proof & Stats --}}
                    <div class="pt-3 flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-3 text-xs sm:text-sm text-slate-500 dark:text-slate-400">
                        <div class="flex items-center gap-3">
                            <div class="flex -space-x-2 rounded-full overflow-hidden p-0.5">
                                <span class="flex size-8 items-center justify-center rounded-full ring-2 ring-slate-50 dark:ring-[#070B14] bg-blue-600 text-white text-[10px] font-black leading-none tracking-tight">YZ</span>
                                <span class="flex size-8 items-center justify-center rounded-full ring-2 ring-slate-50 dark:ring-[#070B14] bg-blue-700 text-white text-[10px] font-black leading-none tracking-tight">AK</span>
                                <span class="flex size-8 items-center justify-center rounded-full ring-2 ring-slate-50 dark:ring-[#070B14] bg-indigo-600 text-white text-[10px] font-black leading-none tracking-tight">LV</span>
                            </div>
                            <span class="font-medium text-slate-650 dark:text-slate-300">Trusted by developers worldwide.</span>
                        </div>
                        <span class="hidden sm:inline text-slate-300 dark:text-slate-700">&bull;</span>
                        <div class="flex items-center gap-1.5 font-mono text-blue-600 dark:text-blue-400 font-semibold">
                            <x-ui.icon name="check-circle" class="size-4" />
                            <span>Laravel 13 & Livewire 4</span>
                        </div>
                    </div>
                </div>

                {{-- Right Interactive Dashboard Showcase Mockup --}}
                {{-- Right Developer Terminal & Feature Showcase Card --}}
                <div class="lg:col-span-6 relative">
                    {{-- Glowing Border Container --}}
                    <div class="rounded-2xl border border-blue-500/30 bg-[#070B14] p-3 sm:p-4 shadow-2xl shadow-blue-900/40 backdrop-blur-2xl ring-1 ring-blue-500/20 space-y-3">
                        
                        {{-- Terminal Window Bar --}}
                        <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-between border-b border-slate-800/80 bg-[#0A1020] p-2.5 sm:px-3.5 sm:py-2.5 rounded-t-xl gap-2">
                            <div class="flex items-center justify-between sm:justify-start w-full sm:w-auto px-1 sm:px-0">
                                <div class="flex items-center gap-2">
                                    <span class="size-3 rounded-full bg-red-500/80"></span>
                                    <span class="size-3 rounded-full bg-amber-500/80"></span>
                                    <span class="size-3 rounded-full bg-emerald-500/80"></span>
                                    <span class="text-[11px] font-mono text-slate-400 ms-1">adminkit-cli</span>
                                </div>
                            </div>

                            {{-- Selector Tabs --}}
                            <div class="grid grid-cols-3 gap-1 bg-slate-900/90 p-1 rounded-lg border border-slate-800/80 w-full sm:w-auto">
                                <button type="button" @click="activeDemo = 'sales'"
                                        :class="activeDemo === 'sales' ? 'bg-blue-600 text-white font-bold shadow' : 'text-slate-400 hover:text-white'"
                                        class="px-2 py-1 text-[10px] sm:text-xs rounded-md transition-all flex items-center justify-center gap-1">
                                    <x-ui.icon name="terminal" class="size-3 sm:size-3.5" />
                                    <span class="truncate">Quickstart</span>
                                </button>
                                <button type="button" @click="activeDemo = 'crypto'"
                                        :class="activeDemo === 'crypto' ? 'bg-blue-600 text-white font-bold shadow' : 'text-slate-400 hover:text-white'"
                                        class="px-2 py-1 text-[10px] sm:text-xs rounded-md transition-all flex items-center justify-center gap-1">
                                    <x-ui.icon name="palette" class="size-3 sm:size-3.5" />
                                    <span class="truncate">Tokens</span>
                                </button>
                                <button type="button" @click="activeDemo = 'ecommerce'"
                                        :class="activeDemo === 'ecommerce' ? 'bg-blue-600 text-white font-bold shadow' : 'text-slate-400 hover:text-white'"
                                        class="px-2 py-1 text-[10px] sm:text-xs rounded-md transition-all flex items-center justify-center gap-1">
                                    <x-ui.icon name="layers" class="size-3 sm:size-3.5" />
                                    <span class="truncate">Stack</span>
                                </button>
                            </div>
                        </div>

                        {{-- Terminal Inner Viewport --}}
                        <div class="rounded-b-xl border-t-0 border-slate-800/80 bg-[#04070F] overflow-hidden">
                            
                            {{-- TAB 1: QUICKSTART TERMINAL CODE --}}
                            <div x-show="activeDemo === 'sales'" class="p-4 sm:p-5 space-y-4 font-mono text-xs">
                                <div class="flex items-center justify-between border-b border-slate-800/80 pb-3">
                                    <div class="flex items-center gap-2">
                                        <span class="size-2 rounded-full bg-emerald-500 animate-pulse"></span>
                                        <span class="text-slate-300 font-bold">Install & Run AdminKit</span>
                                    </div>
                                    <button type="button" x-on:click="copyText('git clone https://github.com/yrizzz/adminkit.git\ncd adminkit && composer install\nphp artisan dev', 'term')" class="px-2.5 py-1 rounded bg-slate-800 text-[10px] text-blue-400 hover:bg-slate-700 transition-colors">
                                        <span x-text="copiedSnippet === 'term' ? 'Copied! ✓' : 'Copy Code'"></span>
                                    </button>
                                </div>

                                <pre class="overflow-x-auto text-slate-300 leading-relaxed space-y-1 font-mono text-[11px] sm:text-xs">
<span class="text-slate-500"># 1. Clone AdminKit Repository</span>
<span class="text-blue-400">git clone</span> https://github.com/yrizzz/adminkit.git
<span class="text-blue-400">cd</span> adminkit && <span class="text-emerald-400">composer install</span>

<span class="text-slate-500"># 2. Setup Environment & Encryption Key</span>
<span class="text-blue-400">cp</span> .env.example .env
<span class="text-purple-400">php artisan</span> key:generate

<span class="text-slate-500"># 3. Launch Development Server (Vite + Laravel)</span>
<span class="text-purple-400">php artisan</span> dev</pre>
                            </div>

                            {{-- TAB 2: DESIGN SYSTEM TOKENS --}}
                            <div x-show="activeDemo === 'crypto'" x-cloak class="p-4 sm:p-5 space-y-3">
                                <div class="flex items-center justify-between border-b border-slate-800/80 pb-3">
                                    <span class="text-xs font-bold text-white flex items-center gap-2">
                                        <x-ui.icon name="sparkles" class="size-4 text-blue-400" />
                                        Design Tokens & Variables
                                    </span>
                                    <span class="text-[10px] font-mono text-blue-400 bg-blue-600/20 px-2 py-0.5 rounded border border-blue-500/30">TAILWIND V4</span>
                                </div>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5">
                                    <div class="rounded-xl border border-slate-800/80 bg-slate-900/60 p-3 space-y-1">
                                        <span class="text-[10px] text-slate-400 uppercase font-semibold">Primary Accent</span>
                                        <div class="flex items-center justify-between">
                                            <span class="text-xs font-extrabold text-white">Electric Blue</span>
                                            <span class="size-3.5 rounded-full bg-blue-600 border border-blue-400"></span>
                                        </div>
                                    </div>
                                    <div class="rounded-xl border border-slate-800/80 bg-slate-900/60 p-3 space-y-1">
                                        <span class="text-[10px] text-slate-400 uppercase font-semibold">Dark Background</span>
                                        <div class="flex items-center justify-between">
                                            <span class="text-xs font-extrabold text-white">Obsidian #070B14</span>
                                            <span class="size-3.5 rounded-full bg-[#070B14] border border-slate-700"></span>
                                        </div>
                                    </div>
                                    <div class="rounded-xl border border-slate-800/80 bg-slate-900/60 p-3 space-y-1">
                                        <span class="text-[10px] text-slate-400 uppercase font-semibold">UI Components</span>
                                        <span class="text-xs font-extrabold text-blue-400 block">40+ Blade & Livewire 4</span>
                                    </div>
                                    <div class="rounded-xl border border-slate-800/80 bg-slate-900/60 p-3 space-y-1">
                                        <span class="text-[10px] text-slate-400 uppercase font-semibold">Typography</span>
                                        <span class="text-xs font-extrabold text-white block">Instrument Sans</span>
                                    </div>
                                </div>
                            </div>

                            {{-- TAB 3: TECH STACK --}}
                            <div x-show="activeDemo === 'ecommerce'" x-cloak class="p-4 sm:p-5 space-y-3 text-xs">
                                <div class="flex items-center justify-between border-b border-slate-800/80 pb-3">
                                    <span class="text-xs font-bold text-white flex items-center gap-2">
                                        <x-ui.icon name="cpu" class="size-4 text-blue-400" />
                                        Core Stack Specs
                                    </span>
                                    <span class="text-[10px] font-mono text-emerald-400 bg-emerald-600/20 px-2 py-0.5 rounded border border-emerald-500/30">100% PRODUCTION READY</span>
                                </div>
                                <div class="space-y-2">
                                    <div class="flex items-center justify-between p-2.5 rounded-xl border border-slate-800/80 bg-slate-900/60">
                                        <span class="text-slate-300 font-bold">Laravel Framework</span>
                                        <span class="font-mono text-blue-400 font-bold">v13.x</span>
                                    </div>
                                    <div class="flex items-center justify-between p-2.5 rounded-xl border border-slate-800/80 bg-slate-900/60">
                                        <span class="text-slate-300 font-bold">Livewire Engine</span>
                                        <span class="font-mono text-blue-400 font-bold">v4.x</span>
                                    </div>
                                    <div class="flex items-center justify-between p-2.5 rounded-xl border border-slate-800/80 bg-slate-900/60">
                                        <span class="text-slate-300 font-bold">Tailwind CSS</span>
                                        <span class="font-mono text-blue-400 font-bold">v4.0</span>
                                    </div>
                                </div>
                            </div>

                        </div>

                        {{-- Footer Status Bar --}}
                        <div class="flex items-center justify-between text-[11px] text-slate-400 px-2 pt-1">
                            <span class="flex items-center gap-1.5 text-blue-400 font-mono font-semibold">
                                <x-ui.icon name="shield-check" class="size-3.5" />
                                MIT Open Source
                            </span>
                            <span class="font-mono text-emerald-400 font-semibold">● Operational</span>
                        </div>

                    </div>
                </div>

            </div>
        </section>

        {{-- KEY FEATURES SECTION ("Built for Developers") --}}
        <section id="features" class="py-14 lg:py-24 px-4 sm:px-6 max-w-7xl mx-auto space-y-12 lg:space-y-16">
            <div class="text-center max-w-3xl mx-auto space-y-4">
                <div>
                    <span class="inline-block rounded-full bg-blue-600/20 px-4 py-1.5 text-xs font-extrabold text-blue-600 dark:text-blue-400 border border-blue-500/40 uppercase tracking-wider">KEY FEATURES</span>
                </div>
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-black text-slate-900 dark:text-white tracking-tight">Built for Developers</h2>
                <p class="text-slate-600 dark:text-slate-300 text-sm sm:text-base leading-relaxed max-w-2xl mx-auto">Everything you need to build fast, modern, and highly scalable admin dashboards.</p>
            </div>

            {{-- 6 Feature Cards Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                {{-- 1. Modern & Clean UI --}}
                <div data-aos="fade-up" style="transition-delay: 0ms;" class="rounded-2xl border border-slate-200 dark:border-slate-800/80 bg-white dark:bg-slate-900/60 p-6 space-y-4 hover:border-blue-500/50 hover:bg-slate-50 dark:hover:bg-slate-900/90 transition-all duration-300 group hover:-translate-y-1 shadow-lg backdrop-blur">
                    <div class="size-12 rounded-xl bg-blue-600/15 border border-blue-500/30 text-blue-600 dark:text-blue-400 grid place-items-center group-hover:bg-blue-600 group-hover:text-white transition-all shadow-md">
                        <x-ui.icon name="palette" class="size-6" />
                    </div>
                    <h3 class="text-lg sm:text-xl font-bold text-slate-900 dark:text-white">Modern & Clean UI</h3>
                    <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-300 leading-relaxed">
                        Modern, clean, user-centric design with world-class interface aesthetics and flawless typography.
                    </p>
                </div>

                {{-- 2. Fully Responsive --}}
                <div data-aos="fade-up" style="transition-delay: 100ms;" class="rounded-2xl border border-slate-200 dark:border-slate-800/80 bg-white dark:bg-slate-900/60 p-6 space-y-4 hover:border-blue-500/50 hover:bg-slate-50 dark:hover:bg-slate-900/90 transition-all duration-300 group hover:-translate-y-1 shadow-lg backdrop-blur">
                    <div class="size-12 rounded-xl bg-blue-600/15 border border-blue-500/30 text-blue-600 dark:text-blue-400 grid place-items-center group-hover:bg-blue-600 group-hover:text-white transition-all shadow-md">
                        <x-ui.icon name="layout" class="size-6" />
                    </div>
                    <h3 class="text-lg sm:text-xl font-bold text-slate-900 dark:text-white">Fully Responsive</h3>
                    <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-300 leading-relaxed">
                        Flawless layout adaptation across all devices, from mobile smartphones to ultrawide desktop monitors.
                    </p>
                </div>

                {{-- 3. Rich Component Library --}}
                <div data-aos="fade-up" style="transition-delay: 200ms;" class="rounded-2xl border border-slate-200 dark:border-slate-800/80 bg-white dark:bg-slate-900/60 p-6 space-y-4 hover:border-blue-500/50 hover:bg-slate-50 dark:hover:bg-slate-900/90 transition-all duration-300 group hover:-translate-y-1 shadow-lg backdrop-blur">
                    <div class="size-12 rounded-xl bg-blue-600/15 border border-blue-500/30 text-blue-600 dark:text-blue-400 grid place-items-center group-hover:bg-blue-600 group-hover:text-white transition-all shadow-md">
                        <x-ui.icon name="cpu" class="size-6" />
                    </div>
                    <h3 class="text-lg sm:text-xl font-bold text-slate-900 dark:text-white">Rich Component Library</h3>
                    <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-300 leading-relaxed">
                        Comprehensive suite of production-ready Blade UI components, fully customizable for your application architecture.
                    </p>
                </div>

                {{-- 4. Developer Friendly --}}
                <div data-aos="fade-up" style="transition-delay: 300ms;" class="rounded-2xl border border-slate-200 dark:border-slate-800/80 bg-white dark:bg-slate-900/60 p-6 space-y-4 hover:border-blue-500/50 hover:bg-slate-50 dark:hover:bg-slate-900/90 transition-all duration-300 group hover:-translate-y-1 shadow-lg backdrop-blur">
                    <div class="size-12 rounded-xl bg-blue-600/15 border border-blue-500/30 text-blue-600 dark:text-blue-400 grid place-items-center group-hover:bg-blue-600 group-hover:text-white transition-all shadow-md">
                        <x-ui.icon name="code" class="size-6" />
                    </div>
                    <h3 class="text-lg sm:text-xl font-bold text-slate-900 dark:text-white">Developer Friendly</h3>
                    <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-300 leading-relaxed">
                        Clean and well-organized codebase structure, effortless to adapt for any business logic and API requirements.
                    </p>
                </div>

                {{-- 5. Static HTML Version --}}
                <div data-aos="fade-up" style="transition-delay: 400ms;" class="rounded-2xl border border-emerald-500/30 bg-white dark:bg-slate-900/60 p-6 space-y-4 hover:border-emerald-500/60 hover:bg-slate-50 dark:hover:bg-slate-900/90 transition-all duration-300 group hover:-translate-y-1 shadow-lg backdrop-blur">
                    <div class="size-12 rounded-xl bg-emerald-600/15 border border-emerald-500/30 text-emerald-600 dark:text-emerald-400 grid place-items-center group-hover:bg-emerald-600 group-hover:text-white transition-all shadow-md">
                        <x-ui.icon name="file-code" class="size-6" />
                    </div>
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg sm:text-xl font-bold text-slate-900 dark:text-white">Static HTML Export</h3>
                        <span class="rounded-full bg-emerald-600/20 px-2.5 py-0.5 text-[10px] font-mono font-bold text-emerald-400 border border-emerald-500/30">129 PAGES</span>
                    </div>
                    <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-300 leading-relaxed">
                        Export all 129 pre-built pages into pure static HTML files with one simple PHP command. Deploy to GitHub Pages, Netlify, or CDN without server requirement.
                    </p>
                </div>

                {{-- 6. 100% Open Source --}}
                <div data-aos="fade-up" style="transition-delay: 500ms;" class="rounded-2xl border border-slate-200 dark:border-slate-800/80 bg-white dark:bg-slate-900/60 p-6 space-y-4 hover:border-blue-500/50 hover:bg-slate-50 dark:hover:bg-slate-900/90 transition-all duration-300 group hover:-translate-y-1 shadow-lg backdrop-blur">
                    <div class="size-12 rounded-xl bg-blue-600/15 border border-blue-500/30 text-blue-600 dark:text-blue-400 grid place-items-center group-hover:bg-blue-600 group-hover:text-white transition-all shadow-md">
                        <x-ui.icon name="github" class="size-6" />
                    </div>
                    <h3 class="text-lg sm:text-xl font-bold text-slate-900 dark:text-white">100% Open Source</h3>
                    <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-300 leading-relaxed">
                        Free forever under the permissive MIT license, passionately crafted for the entire open-source developer community.
                    </p>
                </div>
            </div>
        </section>

        {{-- PREVIEW SECTION ("Explore AdminKit Inside & Out") --}}
        <section id="showcase" class="py-14 lg:py-24 px-4 sm:px-6 max-w-7xl mx-auto space-y-12 lg:space-y-16">
            <div class="text-center max-w-3xl mx-auto space-y-4">
                <div>
                    <span class="inline-block rounded-full bg-blue-600/20 px-4 py-1.5 text-xs font-extrabold text-blue-600 dark:text-blue-400 border border-blue-500/40 uppercase tracking-wider">PREVIEW DEMOS</span>
                </div>
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-black text-slate-900 dark:text-white tracking-tight">Explore AdminKit Inside & Out</h2>
                <p class="text-slate-650 dark:text-slate-300 text-sm sm:text-base leading-relaxed max-w-2xl mx-auto">A glimpse of core view templates and UI components available in AdminKit.</p>
            </div>

            {{-- 4 Page Preview Cards --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                {{-- Card 1: Dashboard --}}
                <div data-aos="fade-up" style="transition-delay: 0ms;" class="rounded-2xl border border-slate-200 dark:border-slate-800/80 bg-white dark:bg-slate-900/70 overflow-hidden space-y-3 p-4 hover:border-blue-500/60 hover:bg-slate-50 dark:hover:bg-slate-900/90 transition-all cursor-pointer group hover:-translate-y-1 shadow-md" @click="activeDemo = 'sales'">
                    <div class="rounded-xl border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-950 p-3 h-36 flex flex-col justify-between group-hover:scale-[1.02] transition-transform">
                        <div class="flex items-center justify-between text-[11px] font-bold text-blue-600 dark:text-blue-400">
                            <span>Dashboard</span>
                            <span class="size-2 rounded-full bg-blue-500"></span>
                        </div>
                        <div class="space-y-1">
                            <div class="h-2 w-3/4 rounded bg-blue-600/40"></div>
                            <div class="h-2 w-1/2 rounded bg-slate-200 dark:bg-slate-850"></div>
                        </div>
                        <div class="h-10 w-full rounded bg-blue-600/20 border border-blue-500/30"></div>
                    </div>
                    <div>
                        <h4 class="text-base font-bold text-slate-900 dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">Dashboard Overview</h4>
                        <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-300 mt-1">Modern analytics dashboard with real-time widgets and interactive charts.</p>
                    </div>
                </div>

                {{-- Card 2: Tables --}}
                <div data-aos="fade-up" style="transition-delay: 100ms;" class="rounded-2xl border border-slate-200 dark:border-slate-800/80 bg-white dark:bg-slate-900/70 overflow-hidden space-y-3 p-4 hover:border-blue-500/60 hover:bg-slate-50 dark:hover:bg-slate-900/90 transition-all cursor-pointer group hover:-translate-y-1 shadow-md" @click="activeDemo = 'ecommerce'">
                    <div class="rounded-xl border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-950 p-3 h-36 flex flex-col justify-between group-hover:scale-[1.02] transition-transform">
                        <div class="flex items-center justify-between text-[11px] font-bold text-blue-600 dark:text-blue-400">
                            <span>Tables</span>
                            <span class="size-2 rounded-full bg-blue-500"></span>
                        </div>
                        <div class="space-y-1.5">
                            <div class="h-2 w-full rounded bg-slate-200 dark:bg-slate-850"></div>
                            <div class="h-2 w-full rounded bg-slate-200/60 dark:bg-slate-850/60"></div>
                            <div class="h-2 w-full rounded bg-slate-200/40 dark:bg-slate-850/40"></div>
                        </div>
                        <div class="h-4 w-1/3 rounded bg-blue-600/30"></div>
                    </div>
                    <div>
                        <h4 class="text-base font-bold text-slate-900 dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">Data Tables</h4>
                        <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-300 mt-1">Responsive data tables with instant sorting, searching, and pagination.</p>
                    </div>
                </div>

                {{-- Card 3: Forms --}}
                <div data-aos="fade-up" style="transition-delay: 200ms;" class="rounded-2xl border border-slate-200 dark:border-slate-800/80 bg-white dark:bg-slate-900/70 overflow-hidden space-y-3 p-4 hover:border-blue-500/60 hover:bg-slate-50 dark:hover:bg-slate-900/90 transition-all cursor-pointer group hover:-translate-y-1 shadow-md" @click="activeDemo = 'crm'">
                    <div class="rounded-xl border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-950 p-3 h-36 flex flex-col justify-between group-hover:scale-[1.02] transition-transform">
                        <div class="flex items-center justify-between text-[11px] font-bold text-blue-600 dark:text-blue-400">
                            <span>Forms</span>
                            <span class="size-2 rounded-full bg-blue-500"></span>
                        </div>
                        <div class="space-y-2">
                            <div class="h-5 w-full rounded border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900"></div>
                            <div class="h-5 w-full rounded border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900"></div>
                        </div>
                        <div class="h-6 w-full rounded bg-blue-600 text-white text-[10px] grid place-items-center font-bold">Submit</div>
                    </div>
                    <div>
                        <h4 class="text-base font-bold text-slate-900 dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">Form Elements</h4>
                        <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-300 mt-1">Complete collection of styled form controls ready for immediate integration.</p>
                    </div>
                </div>

                {{-- Card 4: Charts --}}
                <div data-aos="fade-up" style="transition-delay: 300ms;" class="rounded-2xl border border-slate-200 dark:border-slate-800/80 bg-white dark:bg-slate-900/70 overflow-hidden space-y-3 p-4 hover:border-blue-500/60 hover:bg-slate-50 dark:hover:bg-slate-900/90 transition-all cursor-pointer group hover:-translate-y-1 shadow-md" @click="activeDemo = 'sales'">
                    <div class="rounded-xl border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-950 p-3 h-36 flex flex-col justify-between group-hover:scale-[1.02] transition-transform">
                        <div class="flex items-center justify-between text-[11px] font-bold text-blue-600 dark:text-blue-400">
                            <span>Charts</span>
                            <span class="size-2 rounded-full bg-blue-500"></span>
                        </div>
                        <div class="h-16 w-full flex items-end justify-between gap-1 pt-2">
                            <div class="w-full bg-blue-600/30 rounded-t h-[30%]"></div>
                            <div class="w-full bg-blue-600/50 rounded-t h-[70%]"></div>
                            <div class="w-full bg-blue-600/40 rounded-t h-[50%]"></div>
                            <div class="w-full bg-blue-500 rounded-t h-[90%]"></div>
                        </div>
                    </div>
                    <div>
                        <h4 class="text-base font-bold text-slate-900 dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">Interactive Charts</h4>
                        <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-300 mt-1">Seamless data visualization integrations using Chart.js & ApexCharts.</p>
                    </div>
                </div>
            </div>

            <div class="text-center pt-2">
                <a href="{{ route('page', ['path' => 'docs']) }}" wire:navigate
                   class="inline-flex items-center gap-2 rounded-xl border border-blue-500/40 bg-blue-600/5 dark:bg-blue-600/10 px-6 py-3.5 text-xs sm:text-sm font-bold text-blue-600 dark:text-blue-400 hover:bg-blue-600 hover:text-white transition-all shadow-md">
                    <span>Explore All Pages & Documentation &rarr;</span>
                </a>
            </div>
        </section>

        {{-- TECHNOLOGY STACK SECTION ("Built with Modern Technologies") --}}
        <section id="tech" class="py-14 lg:py-24 px-4 sm:px-6 max-w-7xl mx-auto space-y-10 lg:space-y-14">
            <div class="text-center max-w-3xl mx-auto space-y-4">
                <div>
                    <span class="inline-block rounded-full bg-blue-600/20 px-4 py-1.5 text-xs font-extrabold text-blue-600 dark:text-blue-400 border border-blue-500/40 uppercase tracking-wider">TECHNOLOGY STACK</span>
                </div>
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-black text-slate-900 dark:text-white tracking-tight">Built with Modern Technologies</h2>
                <p class="text-slate-650 dark:text-slate-300 text-sm sm:text-base leading-relaxed max-w-2xl mx-auto">Powered by industry-standard tools trusted by millions of developers worldwide.</p>
            </div>

            {{-- Responsive Tech Stack Cards Grid --}}
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-2.5 sm:gap-4 max-w-5xl mx-auto">
                {{-- 1. Laravel 13 --}}
                <div class="group relative rounded-2xl border border-slate-200 dark:border-red-500/20 bg-white dark:bg-slate-900/60 p-3 sm:p-4 hover:border-red-500/60 dark:hover:border-red-500/60 hover:bg-slate-50 dark:hover:bg-slate-900/80 hover:shadow-lg transition-all duration-300 flex items-center gap-3">
                    <div class="size-9 sm:size-11 rounded-xl bg-red-500/15 border border-red-500/30 grid place-items-center text-red-500 dark:text-red-400 shrink-0 group-hover:scale-105 transition-transform">
                        <x-ui.icon name="cpu" class="size-4 sm:size-5" />
                    </div>
                    <div class="min-w-0 flex-1">
                        <div class="flex items-center justify-between gap-1">
                            <span class="text-xs sm:text-sm font-extrabold text-slate-900 dark:text-white truncate">Laravel 13</span>
                            <span class="text-[9px] font-mono font-bold text-red-500 dark:text-red-450 bg-red-500/10 px-1.5 py-0.5 rounded border border-red-500/20 shrink-0">v13</span>
                        </div>
                        <p class="text-[10px] sm:text-xs text-slate-500 dark:text-slate-400 font-medium truncate">PHP Framework</p>
                    </div>
                </div>

                {{-- 2. Livewire 4 --}}
                <div class="group relative rounded-2xl border border-slate-200 dark:border-pink-500/20 bg-white dark:bg-slate-900/60 p-3 sm:p-4 hover:border-pink-500/60 dark:hover:border-pink-500/60 hover:bg-slate-50 dark:hover:bg-slate-900/80 hover:shadow-lg transition-all duration-300 flex items-center gap-3">
                    <div class="size-9 sm:size-11 rounded-xl bg-pink-500/15 border border-pink-500/30 grid place-items-center text-pink-500 dark:text-pink-400 shrink-0 group-hover:scale-105 transition-transform">
                        <x-ui.icon name="zap" class="size-4 sm:size-5" />
                    </div>
                    <div class="min-w-0 flex-1">
                        <div class="flex items-center justify-between gap-1">
                            <span class="text-xs sm:text-sm font-extrabold text-slate-900 dark:text-white truncate">Livewire 4</span>
                            <span class="text-[9px] font-mono font-bold text-pink-500 dark:text-pink-450 bg-pink-500/10 px-1.5 py-0.5 rounded border border-pink-500/20 shrink-0">v4</span>
                        </div>
                        <p class="text-[10px] sm:text-xs text-slate-500 dark:text-slate-400 font-medium truncate">Full-Stack SPA</p>
                    </div>
                </div>

                {{-- 3. Tailwind CSS v4 --}}
                <div class="group relative rounded-2xl border border-slate-200 dark:border-sky-400/20 bg-white dark:bg-slate-900/60 p-3 sm:p-4 hover:border-sky-400/60 dark:hover:border-sky-400/60 hover:bg-slate-50 dark:hover:bg-slate-900/80 hover:shadow-lg transition-all duration-300 flex items-center gap-3">
                    <div class="size-9 sm:size-11 rounded-xl bg-sky-500/15 border border-sky-400/30 grid place-items-center text-sky-500 dark:text-sky-400 shrink-0 group-hover:scale-105 transition-transform">
                        <x-ui.icon name="palette" class="size-4 sm:size-5" />
                    </div>
                    <div class="min-w-0 flex-1">
                        <div class="flex items-center justify-between gap-1">
                            <span class="text-xs sm:text-sm font-extrabold text-slate-900 dark:text-white truncate">Tailwind v4</span>
                            <span class="text-[9px] font-mono font-bold text-sky-550 dark:text-sky-400 bg-sky-400/10 px-1.5 py-0.5 rounded border border-sky-400/20 shrink-0">v4.0</span>
                        </div>
                        <p class="text-[10px] sm:text-xs text-slate-500 dark:text-slate-400 font-medium truncate">CSS Engine</p>
                    </div>
                </div>

                {{-- 4. Chart.js --}}
                <div class="group relative rounded-2xl border border-slate-200 dark:border-amber-400/20 bg-white dark:bg-slate-900/60 p-3 sm:p-4 hover:border-amber-400/60 dark:hover:border-amber-400/60 hover:bg-slate-50 dark:hover:bg-slate-900/80 hover:shadow-lg transition-all duration-300 flex items-center gap-3">
                    <div class="size-9 sm:size-11 rounded-xl bg-amber-500/15 border border-amber-400/30 grid place-items-center text-amber-500 dark:text-amber-400 shrink-0 group-hover:scale-105 transition-transform">
                        <x-ui.icon name="bar-chart-2" class="size-4 sm:size-5" />
                    </div>
                    <div class="min-w-0 flex-1">
                        <div class="flex items-center justify-between gap-1">
                            <span class="text-xs sm:text-sm font-extrabold text-slate-900 dark:text-white truncate">Chart.js</span>
                            <span class="text-[9px] font-mono font-bold text-amber-550 dark:text-amber-400 bg-amber-400/10 px-1.5 py-0.5 rounded border border-amber-400/20 shrink-0">v4.4</span>
                        </div>
                        <p class="text-[10px] sm:text-xs text-slate-500 dark:text-slate-400 font-medium truncate">Interactive Charts</p>
                    </div>
                </div>

                {{-- 5. Alpine.js --}}
                <div class="group relative rounded-2xl border border-slate-200 dark:border-teal-400/20 bg-white dark:bg-slate-900/60 p-3 sm:p-4 hover:border-teal-400/60 dark:hover:border-teal-400/60 hover:bg-slate-50 dark:hover:bg-slate-900/80 hover:shadow-lg transition-all duration-300 flex items-center gap-3">
                    <div class="size-9 sm:size-11 rounded-xl bg-teal-500/15 border border-teal-400/30 grid place-items-center text-teal-500 dark:text-teal-400 shrink-0 group-hover:scale-105 transition-transform">
                        <x-ui.icon name="code" class="size-4 sm:size-5" />
                    </div>
                    <div class="min-w-0 flex-1">
                        <div class="flex items-center justify-between gap-1">
                            <span class="text-xs sm:text-sm font-extrabold text-slate-900 dark:text-white truncate">Alpine.js</span>
                            <span class="text-[9px] font-mono font-bold text-teal-550 dark:text-teal-400 bg-teal-400/10 px-1.5 py-0.5 rounded border border-teal-400/20 shrink-0">v3</span>
                        </div>
                        <p class="text-[10px] sm:text-xs text-slate-500 dark:text-slate-400 font-medium truncate">Micro JS Library</p>
                    </div>
                </div>

                {{-- 6. PHP 8.4 --}}
                <div class="group relative rounded-2xl border border-slate-200 dark:border-indigo-400/20 bg-white dark:bg-slate-900/60 p-3 sm:p-4 hover:border-indigo-400/60 dark:hover:border-indigo-400/60 hover:bg-slate-50 dark:hover:bg-slate-900/80 hover:shadow-lg transition-all duration-300 flex items-center gap-3">
                    <div class="size-9 sm:size-11 rounded-xl bg-indigo-500/15 border border-indigo-400/30 grid place-items-center text-indigo-500 dark:text-indigo-400 shrink-0 group-hover:scale-105 transition-transform">
                        <x-ui.icon name="terminal" class="size-4 sm:size-5" />
                    </div>
                    <div class="min-w-0 flex-1">
                        <div class="flex items-center justify-between gap-1">
                            <span class="text-xs sm:text-sm font-extrabold text-slate-900 dark:text-white truncate">PHP 8.4</span>
                            <span class="text-[9px] font-mono font-bold text-indigo-550 dark:text-indigo-400 bg-indigo-400/10 px-1.5 py-0.5 rounded border border-indigo-400/20 shrink-0">v8.4</span>
                        </div>
                        <p class="text-[10px] sm:text-xs text-slate-500 dark:text-slate-400 font-medium truncate">Server Runtime</p>
                    </div>
                </div>

                {{-- 7. Blade Icons --}}
                <div class="group relative rounded-2xl border border-slate-200 dark:border-blue-400/20 bg-white dark:bg-slate-900/60 p-3 sm:p-4 hover:border-blue-400/60 dark:hover:border-blue-400/60 hover:bg-slate-50 dark:hover:bg-slate-900/80 hover:shadow-lg transition-all duration-300 flex items-center gap-3">
                    <div class="size-9 sm:size-11 rounded-xl bg-blue-500/15 border border-blue-400/30 grid place-items-center text-blue-500 dark:text-blue-400 shrink-0 group-hover:scale-105 transition-transform">
                        <x-ui.icon name="layers" class="size-4 sm:size-5" />
                    </div>
                    <div class="min-w-0 flex-1">
                        <div class="flex items-center justify-between gap-1">
                            <span class="text-xs sm:text-sm font-extrabold text-slate-900 dark:text-white truncate">Blade Icons</span>
                            <span class="text-[9px] font-mono font-bold text-blue-500 dark:text-blue-400 bg-blue-400/10 px-1.5 py-0.5 rounded border border-blue-400/20 shrink-0">40+</span>
                        </div>
                        <p class="text-[10px] sm:text-xs text-slate-500 dark:text-slate-400 font-medium truncate">Lucide Icons</p>
                    </div>
                </div>

                {{-- 8. Vite Engine --}}
                <div class="group relative rounded-2xl border border-slate-200 dark:border-purple-400/20 bg-white dark:bg-slate-900/60 p-3 sm:p-4 hover:border-purple-400/60 dark:hover:border-purple-400/60 hover:bg-slate-50 dark:hover:bg-slate-900/80 hover:shadow-lg transition-all duration-300 flex items-center gap-3">
                    <div class="size-9 sm:size-11 rounded-xl bg-purple-500/15 border border-purple-400/30 grid place-items-center text-purple-500 dark:text-purple-400 shrink-0 group-hover:scale-105 transition-transform">
                        <x-ui.icon name="sparkles" class="size-4 sm:size-5" />
                    </div>
                    <div class="min-w-0 flex-1">
                        <div class="flex items-center justify-between gap-1">
                            <span class="text-xs sm:text-sm font-extrabold text-slate-900 dark:text-white truncate">Vite Engine</span>
                            <span class="text-[9px] font-mono font-bold text-purple-550 dark:text-purple-400 bg-purple-400/10 px-1.5 py-0.5 rounded border border-purple-400/20 shrink-0">v6</span>
                        </div>
                        <p class="text-[10px] sm:text-xs text-slate-500 dark:text-slate-400 font-medium truncate">Hot Module Reload</p>
                    </div>
                </div>
            </div>
        </section>

        {{-- SPLIT SECTION: "One Template, Endless Possibilities" & Interactive Terminal & Stats --}}
        <section id="quickstart" class="py-14 lg:py-24 px-4 sm:px-6 max-w-7xl mx-auto space-y-12 lg:space-y-16">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-stretch">
                
                {{-- Left: Use cases --}}
                <div class="lg:col-span-4 rounded-2xl border border-slate-200 dark:border-slate-800/80 bg-white dark:bg-slate-900/60 p-6 sm:p-8 space-y-6 flex flex-col justify-between shadow-xl backdrop-blur">
                    <div class="space-y-4">
                        <div>
                            <span class="inline-block rounded-full bg-blue-600/20 px-3.5 py-1 text-xs font-extrabold text-blue-600 dark:text-blue-400 border border-blue-500/40 uppercase tracking-wider">VERSATILE USE CASES</span>
                        </div>
                        <h3 class="text-xl sm:text-2xl lg:text-3xl font-black text-slate-900 dark:text-white">One Template, Endless Possibilities</h3>
                        <p class="text-xs sm:text-sm text-slate-650 dark:text-slate-300 leading-relaxed">
                            AdminKit features a modular design architecture engineered to streamline any enterprise management platform.
                        </p>

                        <div class="space-y-3 pt-2 text-xs sm:text-sm font-medium text-slate-700 dark:text-slate-200">
                            <div class="flex items-center gap-2.5">
                                <x-ui.icon name="check-circle" class="size-4.5 text-blue-500 dark:text-blue-400 shrink-0" />
                                <span>Enterprise Admin & Management Systems</span>
                            </div>
                            <div class="flex items-center gap-2.5">
                                <x-ui.icon name="check-circle" class="size-4.5 text-blue-500 dark:text-blue-400 shrink-0" />
                                <span>Analytics & Real-time Reporting Engine</span>
                            </div>
                            <div class="flex items-center gap-2.5">
                                <x-ui.icon name="check-circle" class="size-4.5 text-blue-500 dark:text-blue-400 shrink-0" />
                                <span>CRM & ERP Sales Pipeline Dashboard</span>
                            </div>
                            <div class="flex items-center gap-2.5">
                                <x-ui.icon name="check-circle" class="size-4.5 text-blue-500 dark:text-blue-400 shrink-0" />
                                <span>Project & Team Workflow Workspace</span>
                            </div>
                            <div class="flex items-center gap-2.5">
                                <x-ui.icon name="check-circle" class="size-4.5 text-blue-500 dark:text-blue-400 shrink-0" />
                                <span>E-commerce Storefront & Point of Sale (POS)</span>
                            </div>
                            <div class="flex items-center gap-2.5">
                                <x-ui.icon name="check-circle" class="size-4.5 text-blue-500 dark:text-blue-400 shrink-0" />
                                <span>SaaS Application & SaaS Admin Scaffold</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Middle: Interactive Terminal Box --}}
                <div class="lg:col-span-5 rounded-2xl border border-slate-200 dark:border-slate-800/80 bg-white dark:bg-slate-900/90 p-4 sm:p-8 space-y-4 shadow-xl flex flex-col justify-between backdrop-blur overflow-hidden">
                    <div class="space-y-4">
                        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between border-b border-slate-200 dark:border-slate-800 pb-3 gap-2">
                            <div class="flex items-center gap-2">
                                <span class="rounded-full bg-blue-600/20 px-3 py-0.5 text-[11px] font-bold text-blue-600 dark:text-blue-400 border border-blue-500/30">FAST INSTALLATION</span>
                            </div>

                            {{-- Tab Switches --}}
                            <div class="flex items-center gap-1 bg-slate-100 dark:bg-slate-950 p-1 rounded-lg border border-slate-200 dark:border-slate-800 text-[11px]">
                                <button type="button" @click="activeTab = 'composer'" :class="activeTab === 'composer' ? 'bg-blue-600 text-white font-bold' : 'text-slate-500 dark:text-slate-400'" class="px-2.5 py-0.5 rounded">Composer</button>
                                <button type="button" @click="activeTab = 'git'" :class="activeTab === 'git' ? 'bg-blue-600 text-white font-bold' : 'text-slate-500 dark:text-slate-400'" class="px-2.5 py-0.5 rounded">Git Clone</button>
                            </div>
                        </div>

                        {{-- Code Window Composer --}}
                        <div x-show="activeTab === 'composer'" class="rounded-xl border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-[#050912] p-3.5 sm:p-4 font-mono text-xs text-slate-800 dark:text-slate-200 space-y-3 relative group overflow-hidden">
                            <div class="flex items-center justify-between border-b border-slate-200 dark:border-slate-800/60 pb-2">
                                <span class="text-slate-500 text-[10px]"># Step 1: Create fresh project</span>
                                <button type="button" @click="copyCommand('composer create-project yrizzz/adminkit my-app')" class="px-2 py-1 rounded bg-slate-200 dark:bg-slate-800 hover:bg-blue-600 dark:hover:bg-blue-600 text-slate-700 dark:text-slate-300 hover:text-white dark:hover:text-white transition-all text-[10px] flex items-center gap-1 shrink-0">
                                    <x-ui.icon name="copy" class="size-3" />
                                    <span x-text="copied ? 'Copied!' : 'Copy'">Copy</span>
                                </button>
                            </div>

                            <div class="text-blue-600 dark:text-blue-400 font-bold overflow-x-auto break-all sm:break-normal text-[11px] sm:text-xs leading-relaxed py-1">$ composer create-project yrizzz/adminkit my-app</div>
                            
                            <div class="text-slate-500 text-[10px] pt-1"># Step 2: Boot local dev server</div>
                            <div class="text-blue-600 dark:text-blue-400 font-bold overflow-x-auto break-all sm:break-normal text-[11px] sm:text-xs leading-relaxed">$ cd my-app && php artisan dev</div>
                        </div>

                        {{-- Code Window Git --}}
                        <div x-show="activeTab === 'git'" x-cloak class="rounded-xl border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-[#050912] p-3.5 sm:p-4 font-mono text-xs text-slate-800 dark:text-slate-200 space-y-3 relative group overflow-hidden">
                            <div class="flex items-center justify-between border-b border-slate-200 dark:border-slate-800/60 pb-2">
                                <span class="text-slate-500 text-[10px]"># Step 1: Clone repository</span>
                                <button type="button" @click="copyCommand('git clone https://github.com/yrizzz/adminkit.git')" class="px-2 py-1 rounded bg-slate-200 dark:bg-slate-800 hover:bg-blue-600 dark:hover:bg-blue-600 text-slate-700 dark:text-slate-300 hover:text-white dark:hover:text-white transition-all text-[10px] flex items-center gap-1 shrink-0">
                                    <x-ui.icon name="copy" class="size-3" />
                                    <span x-text="copied ? 'Copied!' : 'Copy'">Copy</span>
                                </button>
                            </div>

                            <div class="text-blue-600 dark:text-blue-400 font-bold overflow-x-auto break-all sm:break-normal text-[11px] sm:text-xs leading-relaxed py-1">$ git clone https://github.com/yrizzz/adminkit.git</div>
                            
                            <div class="text-slate-500 text-[10px] pt-1"># Step 2: Install dependencies</div>
                            <div class="text-blue-600 dark:text-blue-400 font-bold overflow-x-auto break-all sm:break-normal text-[11px] sm:text-xs leading-relaxed">$ composer install && npm install</div>
                        </div>
                    </div>
                </div>

                {{-- Right: Stats List --}}
                <div class="lg:col-span-3 rounded-2xl border border-slate-200 dark:border-slate-800/80 bg-white dark:bg-slate-900/60 p-6 space-y-4 flex flex-col justify-around text-center lg:text-start shadow-xl backdrop-blur">
                    <div class="space-y-1">
                        <div class="text-3xl font-black text-blue-600 dark:text-blue-400">3.2k+</div>
                        <div class="text-xs text-slate-500 dark:text-slate-400 font-semibold">GitHub Stars</div>
                    </div>

                    <div class="space-y-1 border-t border-slate-200 dark:border-slate-800/80 pt-3">
                        <div class="text-3xl font-black text-slate-900 dark:text-white">100+</div>
                        <div class="text-xs text-slate-500 dark:text-slate-400 font-semibold">UI Components</div>
                    </div>

                    <div class="space-y-1 border-t border-slate-200 dark:border-slate-800/80 pt-3">
                        <div class="text-3xl font-black text-slate-900 dark:text-white">50+</div>
                        <div class="text-xs text-slate-500 dark:text-slate-400 font-semibold">Pre-built Pages</div>
                    </div>

                    <div class="space-y-1 border-t border-slate-200 dark:border-slate-800/80 pt-3">
                        <div class="text-3xl font-black text-blue-600 dark:text-blue-400">100%</div>
                        <div class="text-xs text-slate-500 dark:text-slate-400 font-semibold">Responsive & Free MIT</div>
                    </div>
                </div>

            </div>
        </section>

        {{-- FAQ ACCORDION SECTION --}}
        <section id="faq" class="py-14 lg:py-24 px-4 sm:px-6 max-w-4xl mx-auto space-y-10 lg:space-y-14">
            <div class="text-center space-y-4">
                <div>
                    <span class="inline-block rounded-full bg-blue-600/20 px-4 py-1.5 text-xs font-extrabold text-blue-600 dark:text-blue-400 border border-blue-500/40 uppercase tracking-wider">FAQ</span>
                </div>
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-black text-slate-900 dark:text-white tracking-tight">Frequently Asked Questions</h2>
                <p class="text-slate-650 dark:text-slate-300 text-sm sm:text-base max-w-2xl mx-auto leading-relaxed">Everything you need to know about using and licensing AdminKit.</p>
            </div>

            <div class="space-y-3.5">
                {{-- FAQ Item 1 --}}
                <div class="rounded-2xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900/70 overflow-hidden shadow-md">
                    <button type="button" @click="activeFaq = activeFaq === 1 ? null : 1"
                            class="w-full p-4.5 sm:p-5 text-start font-bold text-base sm:text-lg text-slate-900 dark:text-white flex items-center justify-between gap-4">
                        <span>Is AdminKit completely free to use?</span>
                        <span class="inline-block transition-transform shrink-0" :class="activeFaq === 1 ? 'rotate-180' : ''">
                            <x-ui.icon name="chevron-down" class="size-5 text-blue-500 dark:text-blue-400" />
                        </span>
                    </button>
                    <div x-show="activeFaq === 1" x-cloak class="px-4.5 sm:px-5 pb-5 text-sm text-slate-600 dark:text-slate-300 leading-relaxed border-t border-slate-200 dark:border-slate-800/60 pt-3.5">
                        Yes! AdminKit is released as 100% Open Source under the MIT License. You are free to use it for personal, commercial, or client projects without any licensing fees or royalty costs.
                    </div>
                </div>

                {{-- FAQ Item 2 --}}
                <div class="rounded-2xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900/70 overflow-hidden shadow-md">
                    <button type="button" @click="activeFaq = activeFaq === 2 ? null : 2"
                            class="w-full p-4.5 sm:p-5 text-start font-bold text-base sm:text-lg text-slate-900 dark:text-white flex items-center justify-between gap-4">
                        <span>Which Laravel & Livewire versions are supported?</span>
                        <span class="inline-block transition-transform shrink-0" :class="activeFaq === 2 ? 'rotate-180' : ''">
                            <x-ui.icon name="chevron-down" class="size-5 text-blue-500 dark:text-blue-400" />
                        </span>
                    </button>
                    <div x-show="activeFaq === 2" x-cloak class="px-4.5 sm:px-5 pb-5 text-sm text-slate-600 dark:text-slate-300 leading-relaxed border-t border-slate-200 dark:border-slate-800/60 pt-3.5">
                        AdminKit is crafted natively for <strong class="text-slate-900 dark:text-white">Laravel 13</strong> and <strong class="text-slate-900 dark:text-white">Livewire 4</strong>, leveraging <strong class="text-slate-900 dark:text-white">Tailwind CSS v4</strong> with automatic SPA wire-navigation.
                    </div>
                </div>

                {{-- FAQ Item 3 --}}
                <div class="rounded-2xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900/70 overflow-hidden shadow-md">
                    <button type="button" @click="activeFaq = activeFaq === 3 ? null : 3"
                            class="w-full p-4.5 sm:p-5 text-start font-bold text-base sm:text-lg text-slate-900 dark:text-white flex items-center justify-between gap-4">
                        <span>Does AdminKit support Dark Mode & Custom Themes?</span>
                        <span class="inline-block transition-transform shrink-0" :class="activeFaq === 3 ? 'rotate-180' : ''">
                            <x-ui.icon name="chevron-down" class="size-5 text-blue-500 dark:text-blue-400" />
                        </span>
                    </button>
                    <div x-show="activeFaq === 3" x-cloak class="px-4.5 sm:px-5 pb-5 text-sm text-slate-600 dark:text-slate-300 leading-relaxed border-t border-slate-200 dark:border-slate-800/60 pt-3.5">
                        Absolutely! AdminKit comes integrated with a Live Theme Customizer powered by HSL CSS variables, enabling real-time Light/Dark mode toggling and 7 vibrant accent colors.
                    </div>
                </div>
            </div>
        </section>

        {{-- BIG CALL TO ACTION BANNER ("Ready to build your next project?") --}}
        <section class="py-12 lg:py-20 px-4 sm:px-6 max-w-7xl mx-auto">
            <div class="rounded-3xl bg-gradient-to-r from-blue-700 via-blue-600 to-indigo-600 p-6 sm:p-14 shadow-2xl relative overflow-hidden flex flex-col lg:flex-row items-center justify-between gap-8 text-center lg:text-start">
                {{-- Watermark background icon --}}
                <x-ui.icon name="gem" class="absolute -right-10 -bottom-10 size-72 text-white/10 pointer-events-none" />

                <div class="space-y-3 max-w-2xl relative z-10">
                    <h2 class="text-3xl sm:text-5xl font-black text-white tracking-tight">
                        Ready to build your next project?
                    </h2>
                    <p class="text-blue-100 text-xs sm:text-base">
                        AdminKit is completely open-source and free to use. Star the repository on GitHub and support the development ★
                    </p>
                </div>

                <div class="flex flex-col sm:flex-row items-center gap-3.5 justify-center relative z-10 w-full lg:w-auto shrink-0">
                    <a href="https://github.com/yrizzz/adminkit" target="_blank"
                       class="h-12 w-full sm:w-auto inline-flex items-center justify-center gap-2.5 rounded-xl bg-white px-6 text-sm font-black text-blue-700 hover:bg-slate-100 transition-all shadow-lg hover:scale-[1.01] active:scale-[0.99] shrink-0">
                        <x-ui.icon name="star" class="size-4 fill-blue-700" />
                        <span>Star on GitHub</span>
                        <span class="ms-1 rounded bg-blue-100 px-1.5 py-0.5 text-xs text-blue-800 font-mono">3.2k</span>
                    </a>

                    <a href="{{ route('dashboard') }}" wire:navigate
                       class="h-12 w-full sm:w-auto inline-flex items-center justify-center gap-2.5 rounded-xl border border-white/40 bg-white/10 px-6 text-sm font-semibold text-white hover:bg-white/20 transition-all backdrop-blur shrink-0">
                        <x-ui.icon name="layout-dashboard" class="size-4 text-white" />
                        <span>Dashboard</span>
                    </a>
                </div>
            </div>
        </section>

    </main>

    {{-- MODERN RESPONSIVE FOOTER --}}
    <footer class="bg-[#F8FAFC] dark:bg-[#050A14] border-t border-slate-200 dark:border-none pt-16 pb-10 px-4 sm:px-6 relative z-10 overflow-hidden">
        {{-- Shimmer Animated Top Accent Line (Thin & Elegant) --}}
        <div class="absolute top-0 inset-x-0 h-[1px] bg-slate-200 dark:bg-slate-800/40 overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-r from-transparent via-blue-500/70 to-transparent w-full animate-shimmer-slow"></div>
        </div>

        <div class="mx-auto max-w-7xl space-y-12">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-8 lg:gap-10">
                
                {{-- Brand Column --}}
                <div class="lg:col-span-2 space-y-4">
                    <a href="{{ route('landing') }}" wire:navigate class="flex items-center gap-2.5 group w-fit">
                        <span class="grid size-10 shrink-0 place-items-center rounded-xl bg-gradient-to-br from-blue-500 to-blue-700 text-white shadow-lg shadow-blue-600/40 relative overflow-hidden group-hover:scale-105 transition-transform">
                            <span class="absolute inset-0 bg-gradient-to-r from-transparent via-white/40 to-transparent animate-shimmer-fast"></span>
                            <x-ui.icon name="gem" class="size-5 relative z-10" />
                        </span>
                        <span class="text-2xl font-black tracking-tight bg-clip-text text-transparent bg-gradient-to-r from-slate-900 via-blue-600 to-slate-900 dark:from-white dark:via-blue-300 dark:to-white animate-text-shimmer">AdminKit</span>
                    </a>
                    
                    <p class="text-sm sm:text-base text-slate-650 dark:text-slate-300 leading-relaxed max-w-sm">
                        Modern, clean, and powerful admin panel boilerplate for your enterprise projects. Built with Laravel 13, Livewire 4, and Tailwind CSS v4.
                    </p>

                    <div class="inline-flex items-center gap-2 rounded-full border border-blue-500/20 dark:border-blue-500/30 bg-blue-600/5 dark:bg-blue-600/10 px-3.5 py-1.5 text-xs sm:text-sm font-semibold text-blue-600 dark:text-blue-400 relative overflow-hidden group">
                        <span class="absolute inset-0 bg-gradient-to-r from-transparent via-blue-400/15 dark:via-blue-400/25 to-transparent animate-shimmer-slow"></span>
                        <span class="size-2 rounded-full bg-blue-500 animate-pulse"></span>
                        <span class="relative z-10">All Systems Operational (99.99%)</span>
                    </div>
                </div>

                {{-- Column 1: LINKS --}}
                <div class="space-y-3.5">
                    <h4 class="text-xs sm:text-sm font-bold uppercase tracking-wider text-slate-900 dark:text-white">LINKS</h4>
                    <ul class="space-y-2.5 text-sm text-slate-600 dark:text-slate-300 font-medium">
                        <li><a href="#features" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Features</a></li>
                        <li><a href="#showcase" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Demos</a></li>
                        <li><a href="{{ route('page', ['path' => 'docs']) }}" wire:navigate class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Documentation</a></li>
                        <li><a href="#quickstart" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Quickstart</a></li>
                        <li><a href="#faq" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">FAQ</a></li>
                    </ul>
                </div>

                {{-- Column 2: RESOURCES --}}
                <div class="space-y-3.5">
                    <h4 class="text-xs sm:text-sm font-bold uppercase tracking-wider text-slate-900 dark:text-white">RESOURCES</h4>
                    <ul class="space-y-2.5 text-sm text-slate-600 dark:text-slate-300 font-medium">
                        <li><a href="https://github.com/yrizzz/adminkit" target="_blank" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">GitHub Repository</a></li>
                        <li><a href="https://github.com/yrizzz/adminkit/issues" target="_blank" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Issues</a></li>
                        <li><a href="https://github.com/yrizzz/adminkit/discussions" target="_blank" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Discussions</a></li>
                        <li><a href="https://github.com/yrizzz/adminkit/blob/main/LICENSE" target="_blank" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">License (MIT)</a></li>
                    </ul>
                </div>

                {{-- Column 3: SUPPORT --}}
                <div class="space-y-3.5">
                    <h4 class="text-xs sm:text-sm font-bold uppercase tracking-wider text-slate-900 dark:text-white">SUPPORT</h4>
                    <p class="text-sm text-slate-650 dark:text-slate-300 leading-relaxed">Have questions or feature suggestions? Open an issue on GitHub.</p>
                    <a href="https://github.com/yrizzz/adminkit/issues" target="_blank"
                       class="inline-flex items-center gap-2 rounded-xl border border-slate-200 dark:border-slate-700/60 bg-white dark:bg-slate-800/80 px-4 py-2.5 text-xs sm:text-sm font-bold text-slate-800 dark:text-white hover:bg-slate-50 dark:hover:bg-slate-700 hover:border-blue-500/50 transition-all shadow-md">
                        <x-ui.icon name="github" class="size-4 text-slate-650 dark:text-white" />
                        <span>Create GitHub Issue</span>
                    </a>
                </div>

            </div>

            {{-- Bottom Footer Bar --}}
            <div class="relative pt-8 text-center border-t border-slate-200 dark:border-slate-800/80 overflow-hidden">
                <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400 font-medium">
                    &copy; {{ date('Y') }} AdminKit. Built with <span class="text-red-500">❤️</span> for Laravel Developers.
                </p>
            </div>
        </div>
    </footer>
</div>
