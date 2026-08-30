<div x-data="{ 
        docTab: 'introduction',
        searchQuery: '',
        copiedSnippet: null,
        mobileSidebarOpen: false,
        mobileMenuOpen: false,

        // Sandbox State
        btnVariant: 'primary',
        btnSize: 'md',
        btnLoading: false,

        statTone: 'success',
        statTrend: true,

        modalPosition: 'center',

        gaugeValue: 85,
        gaugeTone: 'primary',

        inputVal: 'admin@adminkit.test',
        inputHasError: false,

        scrolled: false,
        init() {
            this.scrolled = (window.scrollY || window.pageYOffset) > 20;
        },

        copyText(text, id) {
            navigator.clipboard.writeText(text);
            this.copiedSnippet = id;
            window.toast('Code copied to clipboard! 📋', { variant: 'success' });
            setTimeout(() => { if (this.copiedSnippet === id) this.copiedSnippet = null; }, 2000);
        }
    }"
    x-on:scroll.window.passive="scrolled = ((window.scrollY || window.pageYOffset) > 20)"
    class="min-h-screen bg-slate-50 dark:bg-[#070B14] text-slate-900 dark:text-white antialiased selection:bg-blue-600/30 selection:text-blue-400 relative overflow-x-clip font-sans"
>
    {{-- Smooth Organic Ambient Spotlights --}}
    <div class="pointer-events-none fixed inset-0 z-0 overflow-hidden opacity-40 dark:opacity-100">
        <div class="absolute -top-40 left-1/2 -translate-x-1/2 w-[1000px] h-[500px] bg-blue-600/15 rounded-full blur-[140px]"></div>
        <div class="absolute top-1/3 -right-40 w-[600px] h-[600px] bg-indigo-600/10 rounded-full blur-[160px]"></div>
        <div class="absolute bottom-10 -left-40 w-[600px] h-[600px] bg-blue-700/10 rounded-full blur-[160px]"></div>
    </div>

    {{-- Top Glassmorphic Pro Navbar (Identical to Landing Page) --}}
    <header :class="scrolled || mobileMenuOpen ? 'bg-white/95 dark:bg-[#0D1527]/95 backdrop-blur-xl border-slate-200 dark:border-slate-800/80 py-3 shadow-xl shadow-black/5 dark:shadow-black/40' : 'bg-transparent border-transparent backdrop-blur-none py-4'" class="landing-header sticky top-0 z-50 w-full border-b transition-all duration-300">
        <div class="mx-auto flex max-w-8xl items-center justify-between px-3 sm:px-6 gap-2">
            {{-- Brand Logo --}}
            <a href="{{ route('landing') }}" wire:navigate class="flex items-center gap-2.5 sm:gap-3 group shrink-0">
                <span class="grid size-9 shrink-0 place-items-center rounded-xl bg-gradient-to-br from-blue-500 to-blue-700 text-white shadow-lg shadow-blue-600/40 transition-transform group-hover:scale-105">
                    <x-ui.icon name="gem" class="size-5" />
                </span>
                <div class="flex flex-col">
                    <span class="text-xl font-black tracking-tight text-slate-900 dark:text-white leading-none">AdminKit</span>
                    <span class="text-[10px] font-mono text-blue-500 dark:text-blue-400 font-semibold leading-tight mt-0.5">PRO DOCS</span>
                </div>
            </a>

            {{-- Navigation Links (Desktop) --}}
            <nav class="hidden md:flex items-center gap-7 text-xs sm:text-sm font-semibold text-slate-600 dark:text-slate-300">
                <a href="{{ route('landing') }}#features" wire:navigate class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Features</a>
                <a href="{{ route('landing') }}#showcase" wire:navigate class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Demos</a>
                <a href="{{ route('landing') }}#tech" wire:navigate class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Tech Stack</a>
                <a href="{{ route('landing') }}#quickstart" wire:navigate class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Quickstart</a>
                <a href="{{ route('landing') }}#faq" wire:navigate class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">FAQ</a>
                <a href="{{ route('page', ['path' => 'docs']) }}" wire:navigate class="text-blue-600 dark:text-blue-400 font-bold border-b-2 border-blue-500 pb-0.5">Documentation</a>
            </nav>

            {{-- Right Actions & Theme Switcher --}}
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

                @auth
                    <a href="{{ route('dashboard') }}" wire:navigate class="h-9 inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-blue-600 to-blue-700 px-3.5 text-xs font-extrabold text-white hover:from-blue-500 hover:to-blue-600 transition-all shadow-lg shadow-blue-600/30">
                        <x-ui.icon name="layout-dashboard" class="size-4" />
                        <span class="hidden sm:inline">Dashboard</span>
                    </a>
                @endauth

                {{-- Mobile Navigation Hamburger Button --}}
                <button type="button" x-on:click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden p-2 rounded-xl border border-slate-700/80 bg-slate-800/80 text-slate-300 hover:text-white transition-colors shrink-0" aria-label="Toggle Navigation">
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
            <nav class="flex flex-col gap-1 text-sm font-semibold text-slate-200">
                <a href="{{ route('landing') }}#features" wire:navigate x-on:click="mobileMenuOpen = false" class="px-4 py-3 rounded-xl hover:bg-blue-600/15 hover:text-white transition-colors flex items-center justify-between">
                    <span>Features</span>
                    <x-ui.icon name="chevron-right" class="size-4 text-slate-500" />
                </a>
                <a href="{{ route('landing') }}#showcase" wire:navigate x-on:click="mobileMenuOpen = false" class="px-4 py-3 rounded-xl hover:bg-blue-600/15 hover:text-white transition-colors flex items-center justify-between">
                    <span>Preview Demos</span>
                    <x-ui.icon name="chevron-right" class="size-4 text-slate-500" />
                </a>
                <a href="{{ route('landing') }}#tech" wire:navigate x-on:click="mobileMenuOpen = false" class="px-4 py-3 rounded-xl hover:bg-blue-600/15 hover:text-white transition-colors flex items-center justify-between">
                    <span>Tech Stack</span>
                    <x-ui.icon name="chevron-right" class="size-4 text-slate-500" />
                </a>
                <a href="{{ route('landing') }}#quickstart" wire:navigate x-on:click="mobileMenuOpen = false" class="px-4 py-3 rounded-xl hover:bg-blue-600/15 hover:text-white transition-colors flex items-center justify-between">
                    <span>Quickstart</span>
                    <x-ui.icon name="chevron-right" class="size-4 text-slate-500" />
                </a>
                <a href="{{ route('page', ['path' => 'docs']) }}" wire:navigate x-on:click="mobileMenuOpen = false" class="px-4 py-3 rounded-xl bg-blue-600/20 text-blue-400 font-bold flex items-center justify-between">
                    <span>Pro Documentation</span>
                    <x-ui.icon name="chevron-right" class="size-4 text-blue-400" />
                </a>
            </nav>
        </div>
    </header>

    {{-- Main Container --}}
    <div class="max-w-8xl mx-auto px-3 sm:px-8 py-6 sm:py-8 flex gap-8 overflow-x-clip min-w-0">
        
        {{-- Mobile Overlay Backdrop --}}
        <div x-show="mobileSidebarOpen" x-cloak x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" x-on:click="mobileSidebarOpen = false" class="fixed inset-0 z-40 bg-black/75 backdrop-blur-xs lg:hidden"></div>

        {{-- Sidebar Navigation --}}
        <aside :class="mobileSidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'" class="fixed lg:sticky top-0 lg:top-[73px] start-0 z-50 lg:z-10 h-full lg:h-[calc(100vh-73px)] w-72 shrink-0 bg-white lg:bg-transparent dark:bg-[#0D1527] lg:dark:bg-transparent border-e lg:border-none border-slate-200 dark:border-slate-800/80 p-4 lg:p-0 transition-transform duration-300 overflow-y-auto space-y-6">
            
            <div class="flex items-center justify-between lg:hidden pb-3 border-b border-slate-200 dark:border-slate-800/80">
                <span class="font-bold text-sm text-slate-800 dark:text-white flex items-center gap-2">
                    <x-ui.icon name="book-open" class="size-4 text-blue-400" />
                    <span>Documentation Menu</span>
                </span>
                <button type="button" x-on:click="mobileSidebarOpen = false" class="p-1 rounded-lg text-slate-400 hover:text-slate-900 dark:hover:text-white">
                    <x-ui.icon name="x" class="size-5" />
                </button>
            </div>

            {{-- Mobile Drawer Search Bar --}}
            <div class="relative lg:hidden">
                <i data-lucide="search" class="absolute start-3 top-1/2 -translate-y-1/2 size-4 text-slate-400"></i>
                <input type="text" 
                       x-model="searchQuery" 
                       placeholder="Filter components..." 
                       class="w-full h-9 rounded-xl border border-slate-200 dark:border-slate-700/80 bg-white dark:bg-slate-800/80 ps-9 pe-4 text-xs text-slate-800 dark:text-white placeholder:text-slate-400 focus:outline-none focus:border-blue-500"
                 >
            </div>

            <div class="lg:hidden space-y-2 pb-4 border-b border-slate-200 dark:border-slate-800/80">
                <a href="{{ route('landing') }}" wire:navigate class="flex items-center gap-2 px-3 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700/80 bg-white dark:bg-slate-800/60 text-xs font-semibold text-slate-600 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white">
                    <x-ui.icon name="arrow-left" class="size-4 text-blue-400" />
                    <span>Back to Landing Page</span>
                </a>
                @auth
                    <a href="{{ route('dashboard') }}" wire:navigate class="flex items-center gap-2 px-3 py-2.5 rounded-xl bg-blue-600 text-white text-xs font-bold shadow-lg shadow-blue-600/30">
                        <x-ui.icon name="layout-dashboard" class="size-4 text-white" />
                        <span>To Dashboard</span>
                    </a>
                @endauth
            </div>

            {{-- Group 1: Core Architecture --}}
            <div class="space-y-2">
                <h4 class="font-bold uppercase tracking-wider text-xs px-2 flex items-center gap-1.5 text-slate-500 dark:text-slate-400">
                    <i data-lucide="book-open" class="size-3.5 text-blue-500 dark:text-blue-400"></i> Core Guides
                </h4>
                <nav class="space-y-1 text-xs sm:text-sm font-medium">
                    <button type="button" x-on:click="docTab = 'introduction'; mobileSidebarOpen = false"
                            :class="docTab === 'introduction' ? 'bg-blue-50 dark:bg-blue-600/20 text-blue-600 dark:text-blue-400 font-bold border-s-2 border-blue-600 dark:border-blue-500 shadow-sm' : 'text-slate-500 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white hover:bg-slate-200/50 dark:hover:bg-slate-800/60'"
                            class="w-full text-start px-3 py-2.5 rounded-r-xl transition-all flex items-center justify-between">
                        <span>Architecture Overview</span>
                        <span class="text-xs font-mono rounded bg-blue-50 dark:bg-blue-600/20 text-blue-600 dark:text-blue-400 px-1.5 py-0.5 border border-blue-200 dark:border-blue-500/30">v1.2.0</span>
                    </button>
                    <button type="button" x-on:click="docTab = 'installation'; mobileSidebarOpen = false"
                            :class="docTab === 'installation' ? 'bg-blue-50 dark:bg-blue-600/20 text-blue-600 dark:text-blue-400 font-bold border-s-2 border-blue-600 dark:border-blue-500 shadow-sm' : 'text-slate-500 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white hover:bg-slate-200/50 dark:hover:bg-slate-800/60'"
                            class="w-full text-start px-3 py-2.5 rounded-r-xl transition-all">
                        Installation & CLI Setup
                    </button>
                    <button type="button" x-on:click="docTab = 'theming'; mobileSidebarOpen = false"
                            :class="docTab === 'theming' ? 'bg-blue-50 dark:bg-blue-600/20 text-blue-600 dark:text-blue-400 font-bold border-s-2 border-blue-600 dark:border-blue-500 shadow-sm' : 'text-slate-500 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white hover:bg-slate-200/50 dark:hover:bg-slate-800/60'"
                            class="w-full text-start px-3 py-2.5 rounded-r-xl transition-all">
                        HSL Engine & Obsidian Dark
                    </button>
                    <button type="button" x-on:click="docTab = 'routing'; mobileSidebarOpen = false"
                            :class="docTab === 'routing' ? 'bg-blue-50 dark:bg-blue-600/20 text-blue-600 dark:text-blue-400 font-bold border-s-2 border-blue-600 dark:border-blue-500 shadow-sm' : 'text-slate-500 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white hover:bg-slate-200/50 dark:hover:bg-slate-800/60'"
                            class="w-full text-start px-3 py-2.5 rounded-r-xl transition-all">
                        Tree Navigation & Active States
                    </button>
                </nav>
            </div>

            {{-- Group 2: Blade UI Components --}}
            <div class="space-y-2">
                <h4 class="font-bold uppercase tracking-wider text-xs px-2 flex items-center gap-1.5 text-slate-500 dark:text-slate-400">
                    <i data-lucide="layers" class="size-3.5 text-blue-500 dark:text-blue-400"></i> UI Components (Blade)
                </h4>
                <nav class="space-y-1 text-xs sm:text-sm font-medium">
                    @php
                        $docItems = [
                            ['stat','Stat Card Metric','x-ui.stat'],
                            ['alert','Alert Banner','x-ui.alert'],
                            ['button','Button & Action','x-ui.button'],
                            ['badge','Badge Status','x-ui.badge'],
                            ['card','Card Container','x-ui.card'],
                            ['modal','Modal Dialog','x-ui.modal'],
                            ['input','Form Input','x-ui.input'],
                            ['dropdown','Dropdown Menu','x-ui.dropdown'],
                            ['avatar','User Avatar','x-ui.avatar'],
                            ['gauge','Gauge Progress','x-ui.gauge'],
                        ];
                    @endphp
                    @foreach ($docItems as [$key, $label, $code])
                        <button type="button" x-on:click="docTab = '{{ $key }}'; mobileSidebarOpen = false"
                                x-show="!searchQuery || '{{ strtolower($label) }} {{ $key }}'.includes(searchQuery.toLowerCase())"
                                :class="docTab === '{{ $key }}' ? 'bg-blue-50 dark:bg-blue-600/20 text-blue-600 dark:text-blue-400 font-bold border-s-2 border-blue-600 dark:border-blue-500 shadow-sm' : 'text-slate-500 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white hover:bg-slate-200/50 dark:hover:bg-slate-800/60'"
                                class="w-full text-start px-3 py-2.5 rounded-r-xl transition-all flex items-center justify-between">
                            <span>{{ $label }}</span>
                            <span class="text-xs font-mono text-slate-500 dark:text-slate-400 opacity-80">&lt;{{ $code }}&gt;</span>
                        </button>
                    @endforeach
                </nav>
            </div>

            {{-- Group 3: Livewire & State --}}
            <div class="space-y-2">
                <h4 class="font-bold uppercase tracking-wider text-xs px-2 flex items-center gap-1.5 text-slate-500 dark:text-slate-400">
                    <i data-lucide="bell" class="size-3.5 text-blue-500 dark:text-blue-400"></i> State & Notifications
                </h4>
                <nav class="space-y-1 text-xs sm:text-sm font-medium">
                    <button type="button" x-on:click="docTab = 'toast'; mobileSidebarOpen = false"
                            :class="docTab === 'toast' ? 'bg-blue-50 dark:bg-blue-600/20 text-blue-600 dark:text-blue-400 font-bold border-s-2 border-blue-600 dark:border-blue-500 shadow-sm' : 'text-slate-500 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white hover:bg-slate-200/50 dark:hover:bg-slate-800/60'"
                            class="w-full text-start px-3 py-2.5 rounded-r-xl transition-all flex items-center justify-between">
                        <span>Toast Notifications</span>
                        <span class="text-xs font-mono text-slate-500 dark:text-slate-400">window.toast</span>
                    </button>
                </nav>
            </div>

        </aside>

        {{-- Main Documentation Content Area --}}
        <main class="flex-1 min-w-0 max-w-full space-y-6 sm:space-y-10 pb-20">
            
            {{-- Mobile Quick Nav Scroll Pills --}}
            <div class="lg:hidden flex items-center gap-2 overflow-x-auto pb-2 scrollbar-none border-b border-slate-200 dark:border-slate-800/80">
                <button type="button" x-on:click="docTab = 'introduction'" :class="docTab === 'introduction' ? 'bg-blue-600 text-white font-bold shadow-lg shadow-blue-600/30' : 'bg-white dark:bg-slate-800/80 border border-slate-200 dark:border-slate-700/80 text-slate-600 dark:text-slate-300'" class="px-3 py-1.5 rounded-xl text-xs whitespace-nowrap transition-all">Overview</button>
                <button type="button" x-on:click="docTab = 'installation'" :class="docTab === 'installation' ? 'bg-blue-600 text-white font-bold shadow-lg shadow-blue-600/30' : 'bg-white dark:bg-slate-800/80 border border-slate-200 dark:border-slate-700/80 text-slate-600 dark:text-slate-300'" class="px-3 py-1.5 rounded-xl text-xs whitespace-nowrap transition-all">Installation</button>
                <button type="button" x-on:click="docTab = 'theming'" :class="docTab === 'theming' ? 'bg-blue-600 text-white font-bold shadow-lg shadow-blue-600/30' : 'bg-white dark:bg-slate-800/80 border border-slate-200 dark:border-slate-700/80 text-slate-600 dark:text-slate-300'" class="px-3 py-1.5 rounded-xl text-xs whitespace-nowrap transition-all">Theming</button>
                <button type="button" x-on:click="docTab = 'routing'" :class="docTab === 'routing' ? 'bg-blue-600 text-white font-bold shadow-lg shadow-blue-600/30' : 'bg-white dark:bg-slate-800/80 border border-slate-200 dark:border-slate-700/80 text-slate-600 dark:text-slate-300'" class="px-3 py-1.5 rounded-xl text-xs whitespace-nowrap transition-all">Routing</button>
                <button type="button" x-on:click="docTab = 'stat'" :class="docTab === 'stat' ? 'bg-blue-600 text-white font-bold shadow-lg shadow-blue-600/30' : 'bg-white dark:bg-slate-800/80 border border-slate-200 dark:border-slate-700/80 text-slate-600 dark:text-slate-300'" class="px-3 py-1.5 rounded-xl text-xs whitespace-nowrap transition-all">Stat Metric</button>
                <button type="button" x-on:click="docTab = 'alert'" :class="docTab === 'alert' ? 'bg-blue-600 text-white font-bold shadow-lg shadow-blue-600/30' : 'bg-white dark:bg-slate-800/80 border border-slate-200 dark:border-slate-700/80 text-slate-600 dark:text-slate-300'" class="px-3 py-1.5 rounded-xl text-xs whitespace-nowrap transition-all">Alert</button>
                <button type="button" x-on:click="docTab = 'button'" :class="docTab === 'button' ? 'bg-blue-600 text-white font-bold shadow-lg shadow-blue-600/30' : 'bg-white dark:bg-slate-800/80 border border-slate-200 dark:border-slate-700/80 text-slate-600 dark:text-slate-300'" class="px-3 py-1.5 rounded-xl text-xs whitespace-nowrap transition-all">Button</button>
                <button type="button" x-on:click="docTab = 'badge'" :class="docTab === 'badge' ? 'bg-blue-600 text-white font-bold shadow-lg shadow-blue-600/30' : 'bg-white dark:bg-slate-800/80 border border-slate-200 dark:border-slate-700/80 text-slate-600 dark:text-slate-300'" class="px-3 py-1.5 rounded-xl text-xs whitespace-nowrap transition-all">Badge</button>
                <button type="button" x-on:click="docTab = 'modal'" :class="docTab === 'modal' ? 'bg-blue-600 text-white font-bold shadow-lg shadow-blue-600/30' : 'bg-white dark:bg-slate-800/80 border border-slate-200 dark:border-slate-700/80 text-slate-600 dark:text-slate-300'" class="px-3 py-1.5 rounded-xl text-xs whitespace-nowrap transition-all">Modal</button>
                <button type="button" x-on:click="docTab = 'input'" :class="docTab === 'input' ? 'bg-blue-600 text-white font-bold shadow-lg shadow-blue-600/30' : 'bg-white dark:bg-slate-800/80 border border-slate-200 dark:border-slate-700/80 text-slate-600 dark:text-slate-300'" class="px-3 py-1.5 rounded-xl text-xs whitespace-nowrap transition-all">Input</button>
                <button type="button" x-on:click="docTab = 'toast'" :class="docTab === 'toast' ? 'bg-blue-600 text-white font-bold shadow-lg shadow-blue-600/30' : 'bg-white dark:bg-slate-800/80 border border-slate-200 dark:border-slate-700/80 text-slate-600 dark:text-slate-300'" class="px-3 py-1.5 rounded-xl text-xs whitespace-nowrap transition-all">Toast</button>
            </div>
            
            {{-- 1. INTRODUCTION --}}
            <div x-show="docTab === 'introduction'" class="space-y-8">
                <div class="space-y-3 border-b border-slate-200 dark:border-slate-800/80 pb-6">
                    <div class="flex items-center gap-2">
                        <span class="px-2.5 py-1 rounded-lg bg-blue-600/20 text-blue-500 dark:text-blue-400 border border-blue-500/30 text-xs font-bold font-mono">Core Architecture</span>
                        <span class="text-xs font-mono text-slate-500 dark:text-slate-400">AdminKit Enterprise v1.2.0 Pro</span>
                    </div>
                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black text-slate-900 dark:text-white tracking-tight">AdminKit Enterprise Documentation</h1>
                    <p class="text-slate-600 dark:text-slate-300 text-base sm:text-lg leading-relaxed max-w-3xl">
                        AdminKit is a high-performance enterprise admin dashboard boilerplate built natively on top of <strong class="text-slate-900 dark:text-white">Laravel 13</strong>, <strong class="text-slate-900 dark:text-white">Livewire 4</strong>, <strong class="text-slate-900 dark:text-white">Alpine.js</strong>, and <strong class="text-slate-900 dark:text-white">Tailwind CSS v4</strong>. Designed with signature <em class="text-blue-600 dark:text-blue-400 not-italic">Deep Obsidian Black (`#070B14`)</em> aesthetics, high visual density, and a dynamic Blade component library.
                    </p>
                </div>

                {{-- Key Pillars Grid --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="rounded-2xl border border-slate-200 dark:border-slate-800/80 bg-white dark:bg-slate-900/80 backdrop-blur-xl p-5 space-y-2 shadow-lg">
                        <div class="flex items-center gap-2.5 font-bold text-sm text-slate-900 dark:text-white">
                            <span class="grid size-8 place-items-center rounded-lg bg-blue-600/20 text-blue-500 dark:text-blue-400 border border-blue-500/30">
                                <i data-lucide="zap" class="size-4"></i>
                            </span>
                            <span>Pure Blade Components</span>
                        </div>
                        <p class="text-xs text-slate-600 dark:text-slate-300 leading-relaxed">
                            Zero heavy JS bundles required. All components (<code class="font-mono text-blue-500 dark:text-blue-400">x-ui.stat</code>, <code class="font-mono text-blue-500 dark:text-blue-400">x-ui.button</code>, <code class="font-mono text-blue-500 dark:text-blue-400">x-ui.card</code>) are fast, lightweight native Blade components.
                        </p>
                    </div>

                    <div class="rounded-2xl border border-slate-200 dark:border-slate-800/80 bg-white dark:bg-slate-900/80 backdrop-blur-xl p-5 space-y-2 shadow-lg">
                        <div class="flex items-center gap-2.5 font-bold text-sm text-slate-900 dark:text-white">
                            <span class="grid size-8 place-items-center rounded-lg bg-blue-600/20 text-blue-555 dark:text-blue-400 border border-blue-500/30">
                                <i data-lucide="palette" class="size-4"></i>
                            </span>
                            <span>Vivid HSL Design System</span>
                        </div>
                        <p class="text-xs text-slate-650 dark:text-slate-300 leading-relaxed">
                            Supports runtime HSL theme colors (Electric Blue, Emerald, Violet, Amber, Rose) and Obsidian Mode with high-contrast borders.
                        </p>
                    </div>

                    <div class="rounded-2xl border border-slate-200 dark:border-slate-800/80 bg-white dark:bg-slate-900/80 backdrop-blur-xl p-5 space-y-2 shadow-lg">
                        <div class="flex items-center gap-2.5 font-bold text-sm text-slate-900 dark:text-white">
                            <span class="grid size-8 place-items-center rounded-lg bg-blue-600/20 text-blue-555 dark:text-blue-400 border border-blue-500/30">
                                <i data-lucide="refresh-cw" class="size-4"></i>
                            </span>
                            <span>Livewire 4 SPA Directives</span>
                        </div>
                        <p class="text-xs text-slate-650 dark:text-slate-300 leading-relaxed">
                            Native `wire:navigate` integration for instant page transitions without full browser reloads, complete with NProgress indicator.
                        </p>
                    </div>

                    <div class="rounded-2xl border border-slate-200 dark:border-slate-800/80 bg-white dark:bg-slate-900/80 backdrop-blur-xl p-5 space-y-2 shadow-lg">
                        <div class="flex items-center gap-2.5 font-bold text-sm text-slate-900 dark:text-white">
                            <span class="grid size-8 place-items-center rounded-lg bg-blue-600/20 text-blue-555 dark:text-blue-400 border border-blue-500/30">
                                <i data-lucide="bell" class="size-4"></i>
                            </span>
                            <span>Global Reactive Toast</span>
                        </div>
                        <p class="text-xs text-slate-650 dark:text-slate-300 leading-relaxed">
                            Floating Alpine.js notification engine callable anywhere via `window.toast(...)` or Livewire Blade events.
                        </p>
                    </div>
                </div>

                {{-- Architecture Structure Box --}}
                <div class="rounded-2xl border border-slate-200 dark:border-slate-800/80 bg-white dark:bg-slate-900/80 backdrop-blur-xl p-4 sm:p-6 space-y-4 shadow-lg min-w-0 max-w-full">
                    <h3 class="font-bold text-base text-slate-900 dark:text-white flex items-center gap-2">
                        <i data-lucide="folder-tree" class="size-4 text-blue-600 dark:text-blue-400"></i> Project Directory Structure
                    </h3>
                    <pre class="overflow-x-auto max-w-full rounded-xl bg-slate-950 p-4 text-xs font-mono text-slate-200 border border-slate-200 dark:border-slate-800 break-all whitespace-pre-wrap sm:whitespace-pre">adminkit/
├── app/
│   ├── Livewire/ (Livewire SPA Pages)
│   └── Support/Menu.php (Sidebar Navigation Tree Architecture)
├── resources/
│   ├── css/app.css (HSL Token System & Obsidian Dark Mode)
│   ├── js/app.js (Alpine UI Store & Global Toast Engine)
│   └── views/
│       ├── components/ui/ (Enterprise Blade Component Library)
│       └── livewire/ (Dashboard & Content View Templates)
└── routes/web.php (Dashboard Application Routing)</pre>
                </div>
            </div>

            {{-- 2. INSTALLATION --}}
            <div x-show="docTab === 'installation'" x-cloak class="space-y-8">
                <div class="space-y-3 border-b border-border/60 pb-6">
                    <x-ui.badge variant="solid">Setup Guide</x-ui.badge>
                    <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight">Installation & CLI Workflow</h1>
                    <p class="text-muted-foreground text-sm leading-relaxed max-w-3xl">
                        Comprehensive step-by-step guide to installing, configuring, and deploying AdminKit Enterprise on local development environments or production servers.
                    </p>
                </div>

                {{-- System Requirements Grid --}}
                <div class="space-y-3">
                    <h3 class="font-bold text-base text-foreground flex items-center gap-2">
                        <i data-lucide="check-circle-2" class="size-4 text-primary"></i> System Requirements & Prerequisites
                    </h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                        <div class="rounded-xl border border-border bg-card p-4 space-y-1">
                            <span class="text-[11px] font-semibold text-muted-foreground uppercase tracking-wider">PHP Engine</span>
                            <p class="text-sm font-extrabold text-foreground font-mono">PHP >= 8.2</p>
                            <p class="text-[11px] text-muted-foreground">BCMath, OpenSSL, Mbstring</p>
                        </div>
                        <div class="rounded-xl border border-border bg-card p-4 space-y-1">
                            <span class="text-[11px] font-semibold text-muted-foreground uppercase tracking-wider">Node Runtime</span>
                            <p class="text-sm font-extrabold text-foreground font-mono">Node.js >= 18.x</p>
                            <p class="text-[11px] text-muted-foreground">NPM 9+ for Tailwind v4</p>
                        </div>
                        <div class="rounded-xl border border-border bg-card p-4 space-y-1">
                            <span class="text-[11px] font-semibold text-muted-foreground uppercase tracking-wider">Package Manager</span>
                            <p class="text-sm font-extrabold text-foreground font-mono">Composer 2.6+</p>
                            <p class="text-[11px] text-muted-foreground">Dependency Management</p>
                        </div>
                        <div class="rounded-xl border border-border bg-card p-4 space-y-1">
                            <span class="text-[11px] font-semibold text-muted-foreground uppercase tracking-wider">Database Engine</span>
                            <p class="text-sm font-extrabold text-foreground font-mono">MySQL 8 / Postgres</p>
                            <p class="text-[11px] text-muted-foreground">SQLite 3.35+ Supported</p>
                        </div>
                    </div>
                </div>

                {{-- Step by Step Workflow --}}
                <div class="space-y-6 min-w-0 max-w-full">
                    <h3 class="font-bold text-base text-foreground flex items-center gap-2 pt-2">
                        <i data-lucide="terminal" class="size-4 text-primary"></i> Step-by-Step Installation Workflow
                    </h3>

                    <div class="flex gap-3 sm:gap-4 items-start min-w-0 max-w-full">
                        <span class="grid size-8 shrink-0 place-items-center rounded-xl bg-primary text-primary-foreground font-bold text-sm">1</span>
                        <div class="space-y-2 flex-1 min-w-0">
                            <h3 class="font-bold text-base text-foreground">Clone Repository & Install Dependencies</h3>
                            <p class="text-xs sm:text-sm text-muted-foreground">Clone the AdminKit repository and run PHP Composer alongside NPM package installation for Tailwind v4.</p>
                            <div class="relative group min-w-0 max-w-full">
                                <pre class="overflow-x-auto max-w-full rounded-xl bg-neutral-950 p-4 text-xs font-mono text-neutral-200 border border-neutral-800 break-all whitespace-pre-wrap sm:whitespace-pre">git clone https://github.com/yrizzz/adminkit.git
cd adminkit
composer install
npm install</pre>
                                <button type="button" x-on:click="copyText('git clone https://github.com/yrizzz/adminkit.git\ncd adminkit\ncomposer install\nnpm install', 'c1')" class="absolute end-2 top-2 sm:end-3 sm:top-3 px-2.5 py-1 rounded-lg bg-neutral-800/90 hover:bg-neutral-700 text-[11px] text-neutral-300 transition-colors z-10">
                                    <span x-text="copiedSnippet === 'c1' ? 'Copied! ✓' : 'Copy'"></span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="flex gap-3 sm:gap-4 items-start min-w-0 max-w-full">
                        <span class="grid size-8 shrink-0 place-items-center rounded-xl bg-primary text-primary-foreground font-bold text-sm">2</span>
                        <div class="space-y-2 flex-1 min-w-0">
                            <h3 class="font-bold text-base text-foreground">Environment Setup & App Encryption Key</h3>
                            <p class="text-xs sm:text-sm text-muted-foreground">Duplicate the default `.env.example` environment file and generate a secure 32-character application encryption key.</p>
                            <div class="relative group min-w-0 max-w-full">
                                <pre class="overflow-x-auto max-w-full rounded-xl bg-neutral-950 p-4 text-xs font-mono text-neutral-200 border border-neutral-800 break-all whitespace-pre-wrap sm:whitespace-pre">cp .env.example .env
php artisan key:generate</pre>
                                <button type="button" x-on:click="copyText('cp .env.example .env\nphp artisan key:generate', 'c2')" class="absolute end-2 top-2 sm:end-3 sm:top-3 px-2.5 py-1 rounded-lg bg-neutral-800/90 hover:bg-neutral-700 text-[11px] text-neutral-300 transition-colors z-10">
                                    <span x-text="copiedSnippet === 'c2' ? 'Copied! ✓' : 'Copy'"></span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="flex gap-3 sm:gap-4 items-start min-w-0 max-w-full">
                        <span class="grid size-8 shrink-0 place-items-center rounded-xl bg-primary text-primary-foreground font-bold text-sm">3</span>
                        <div class="space-y-2 flex-1 min-w-0">
                            <h3 class="font-bold text-base text-foreground">Database Credentials & Migration</h3>
                            <p class="text-xs sm:text-sm text-muted-foreground">Update your `.env` database connection parameters and run the database schema migrations with default seeders.</p>
                            <div class="relative group min-w-0 max-w-full">
                                <pre class="overflow-x-auto max-w-full rounded-xl bg-neutral-950 p-4 text-xs font-mono text-neutral-200 border border-neutral-800 break-all whitespace-pre-wrap sm:whitespace-pre"># Configure database credentials in .env file
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=adminkit
DB_USERNAME=root
DB_PASSWORD=

# Execute migrations and populate initial data
php artisan migrate --seed</pre>
                                <button type="button" x-on:click="copyText('php artisan migrate --seed', 'c3')" class="absolute end-2 top-2 sm:end-3 sm:top-3 px-2.5 py-1 rounded-lg bg-neutral-800/90 hover:bg-neutral-700 text-[11px] text-neutral-300 transition-colors z-10">
                                    <span x-text="copiedSnippet === 'c3' ? 'Copied! ✓' : 'Copy'"></span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="flex gap-3 sm:gap-4 items-start min-w-0 max-w-full">
                        <span class="grid size-8 shrink-0 place-items-center rounded-xl bg-primary text-primary-foreground font-bold text-sm">4</span>
                        <div class="space-y-2 flex-1 min-w-0">
                            <h3 class="font-bold text-base text-foreground">Launch Development Server</h3>
                            <p class="text-xs sm:text-sm text-muted-foreground">Use the Artisan Dev CLI command to concurrently execute Vite asset compilation and the PHP development server.</p>
                            <div class="relative group min-w-0 max-w-full">
                                <pre class="overflow-x-auto max-w-full rounded-xl bg-neutral-950 p-4 text-xs font-mono text-neutral-200 border border-neutral-800 break-all whitespace-pre-wrap sm:whitespace-pre">php artisan dev</pre>
                                <button type="button" x-on:click="copyText('php artisan dev', 'c4')" class="absolute end-2 top-2 sm:end-3 sm:top-3 px-2.5 py-1 rounded-lg bg-neutral-800/90 hover:bg-neutral-700 text-[11px] text-neutral-300 transition-colors z-10">
                                    <span x-text="copiedSnippet === 'c4' ? 'Copied! ✓' : 'Copy'"></span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="flex gap-3 sm:gap-4 items-start min-w-0 max-w-full">
                        <span class="grid size-8 shrink-0 place-items-center rounded-xl bg-primary text-primary-foreground font-bold text-sm">5</span>
                        <div class="space-y-2 flex-1 min-w-0">
                            <h3 class="font-bold text-base text-foreground">Production Deployment & Caching</h3>
                            <p class="text-xs sm:text-sm text-muted-foreground">Before deploying to production, compile optimized frontend bundles and cache framework configuration, routes, and views.</p>
                            <div class="relative group min-w-0 max-w-full">
                                <pre class="overflow-x-auto max-w-full rounded-xl bg-neutral-950 p-4 text-xs font-mono text-neutral-200 border border-neutral-800 break-all whitespace-pre-wrap sm:whitespace-pre"># Production asset compilation
npm run build

# Enable high-performance production caching
php artisan config:cache
php artisan route:cache
php artisan view:cache</pre>
                                <button type="button" x-on:click="copyText('npm run build\nphp artisan config:cache\nphp artisan route:cache\nphp artisan view:cache', 'c5')" class="absolute end-2 top-2 sm:end-3 sm:top-3 px-2.5 py-1 rounded-lg bg-neutral-800/90 hover:bg-neutral-700 text-[11px] text-neutral-300 transition-colors z-10">
                                    <span x-text="copiedSnippet === 'c5' ? 'Copied! ✓' : 'Copy'"></span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- CLI Utilities Reference Box --}}
                <div class="rounded-2xl border border-border bg-card p-6 space-y-3 shadow-sm">
                    <h3 class="font-bold text-sm text-foreground flex items-center gap-2">
                        <i data-lucide="wrench" class="size-4 text-primary"></i> Essential Artisan Maintenance Commands
                    </h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs">
                        <div class="p-3 rounded-xl border border-border bg-accent/20 space-y-1">
                            <code class="font-mono font-bold text-primary">php artisan optimize:clear</code>
                            <p class="text-[11px] text-muted-foreground">Clear all cached configurations, routes, compiled views, and bootstrap caches.</p>
                        </div>
                        <div class="p-3 rounded-xl border border-border bg-accent/20 space-y-1">
                            <code class="font-mono font-bold text-primary">php artisan view:clear</code>
                            <p class="text-[11px] text-muted-foreground">Flush all compiled Livewire and Blade component template views.</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- 3. THEMING --}}
            <div x-show="docTab === 'theming'" x-cloak class="space-y-8">
                <div class="space-y-3 border-b border-border/60 pb-6">
                    <x-ui.badge variant="solid">Design Tokens</x-ui.badge>
                    <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight">HSL Engine & Obsidian Theme</h1>
                    <p class="text-muted-foreground text-sm leading-relaxed">
                        AdminKit's color system uses the HSL (Hue, Saturation, Lightness) format for dynamic theme customization and smooth dark mode transitions.
                    </p>
                </div>

                {{-- Theme Switcher Interactive Box --}}
                <div class="rounded-2xl border border-border bg-card p-6 space-y-4 shadow-sm">
                    <h3 class="font-bold text-sm text-foreground">Live Accent Color Tester</h3>
                    <p class="text-xs text-muted-foreground">Click any color palette below to instantly update the primary theme token across the application:</p>
                    
                    <div class="flex flex-wrap items-center gap-3">
                        <button type="button" x-on:click="$store.ui.setAccent('blue')" class="flex items-center gap-2 px-3 py-2 rounded-xl border border-border bg-accent/40 text-xs font-bold hover:border-primary transition-all">
                            <span class="size-3.5 rounded-full bg-blue-500"></span> Electric Blue
                        </button>
                        <button type="button" x-on:click="$store.ui.setAccent('emerald')" class="flex items-center gap-2 px-3 py-2 rounded-xl border border-border bg-accent/40 text-xs font-bold hover:border-emerald-500 transition-all">
                            <span class="size-3.5 rounded-full bg-emerald-500"></span> Emerald Green
                        </button>
                        <button type="button" x-on:click="$store.ui.setAccent('violet')" class="flex items-center gap-2 px-3 py-2 rounded-xl border border-border bg-accent/40 text-xs font-bold hover:border-violet-500 transition-all">
                            <span class="size-3.5 rounded-full bg-violet-500"></span> Royal Violet
                        </button>
                        <button type="button" x-on:click="$store.ui.setAccent('amber')" class="flex items-center gap-2 px-3 py-2 rounded-xl border border-border bg-accent/40 text-xs font-bold hover:border-amber-500 transition-all">
                            <span class="size-3.5 rounded-full bg-amber-500"></span> Warm Amber
                        </button>
                    </div>
                </div>

                <div class="space-y-4 min-w-0 max-w-full">
                    <h3 class="font-bold text-base text-foreground">CSS Variables (`resources/css/app.css`)</h3>
                    <pre class="overflow-x-auto max-w-full rounded-xl bg-neutral-950 p-4 text-xs font-mono text-neutral-300 border border-neutral-800 break-all whitespace-pre-wrap sm:whitespace-pre">:root {
  --background: 0 0% 100%;
  --foreground: 224 71.4% 4.1%;
  --primary: 221 83% 53%; /* Vivid Royal Electric Blue */
  --primary-foreground: 210 40% 98%;
  --border: 220 13% 91%;
}

.dark {
  --background: 222 47% 5.5%; /* Deep Obsidian Black #070B14 */
  --foreground: 210 40% 98%;
  --primary: 221 83% 53%;
  --border: 217 19% 18%; /* Enhanced contrast border */
}</pre>
                </div>
            </div>

            {{-- 4. ROUTING --}}
            <div x-show="docTab === 'routing'" x-cloak class="space-y-8">
                <div class="space-y-3 border-b border-border/60 pb-6">
                    <x-ui.badge variant="solid">Sidebar Navigation</x-ui.badge>
                    <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight">Tree Navigation & Active States</h1>
                    <p class="text-muted-foreground text-sm leading-relaxed">
                        The primary sidebar navigation is centrally configured in `App\Support\Menu.php` to support multi-level nested menus (tree navigation) and automatic active state highlighting.
                    </p>
                </div>

                <div class="rounded-2xl border border-border bg-card p-4 sm:p-6 space-y-4 shadow-sm min-w-0 max-w-full">
                    <h3 class="font-bold text-sm text-foreground">Menu Structure (`app/Support/Menu.php`)</h3>
                    <pre class="overflow-x-auto max-w-full rounded-xl bg-neutral-950 p-4 text-xs font-mono text-neutral-300 border border-neutral-800 break-all whitespace-pre-wrap sm:whitespace-pre">public static function items(): array
{
    return [
        [
            'section' => 'Overview',
            'items'   => [
                ['title' => 'Dashboard Pro', 'icon' => 'layout-dashboard', 'route' => 'dashboard'],
                ['title' => 'Analytics', 'icon' => 'bar-chart-3', 'route' => 'page.analytics'],
            ],
        ],
        // Additional sections...
    ];
}</pre>
                </div>
            </div>

            {{-- 5. STAT CARD METRIC --}}
            <div x-show="docTab === 'stat'" x-cloak class="space-y-8">
                <div class="space-y-3 border-b border-border/60 pb-6">
                    <div class="flex items-center gap-2">
                        <x-ui.badge variant="solid">Data Display</x-ui.badge>
                        <span class="text-xs font-mono text-muted-foreground">components/ui/stat.blade.php</span>
                    </div>
                    <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight">Stat Card Metric Component</h1>
                    <p class="text-muted-foreground text-sm leading-relaxed">
                        Key numerical metric component for displaying KPIs, revenue figures, user counts, or system telemetry concisely.
                    </p>
                </div>

                {{-- LIVE PLAYGROUND --}}
                <div class="rounded-2xl border border-border bg-card p-6 space-y-5 shadow-sm">
                    <div class="flex items-center justify-between border-b border-border pb-4">
                        <h3 class="font-bold text-sm text-foreground flex items-center gap-2">
                            <i data-lucide="play-circle" class="size-4 text-primary"></i> Live Playground Preview
                        </h3>
                        <div class="flex items-center gap-3">
                            <label class="text-xs text-muted-foreground font-medium">Tone:</label>
                            <select x-model="statTone" class="rounded-lg border border-border bg-background px-2.5 py-1 text-xs font-medium">
                                <option value="success">Success (Emerald)</option>
                                <option value="warning">Warning (Amber)</option>
                                <option value="destructive">Destructive (Rose)</option>
                                <option value="primary">Primary (Blue)</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <x-ui.stat label="Total Revenue" value="$128,450" trend="+18.4% vs last month" icon="dollar-sign" ::tone="statTone" />
                        <x-ui.stat label="Active Enterprise Users" value="12,840" trend="+8.7% vs last month" icon="users" ::tone="statTone" />
                    </div>
                </div>

                {{-- PROPS API TABLE --}}
                <div class="space-y-3">
                    <h3 class="font-bold text-base text-foreground">API Reference & Props</h3>
                    <div class="overflow-x-auto rounded-2xl border border-border bg-card">
                        <table class="w-full text-start text-xs">
                            <thead class="bg-accent/50 border-b border-border text-muted-foreground font-bold">
                                <tr>
                                    <th class="p-3.5 text-start">Prop Name</th>
                                    <th class="p-3.5 text-start">Type</th>
                                    <th class="p-3.5 text-start">Default</th>
                                    <th class="p-3.5 text-start">Description</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-border/60">
                                <tr><td class="p-3.5 font-mono text-primary font-bold">label</td><td class="p-3.5 text-muted-foreground">string</td><td class="p-3.5 text-muted-foreground">null</td><td class="p-3.5">Primary title of the stat metric</td></tr>
                                <tr><td class="p-3.5 font-mono text-primary font-bold">value</td><td class="p-3.5 text-muted-foreground">string</td><td class="p-3.5 text-muted-foreground">null</td><td class="p-3.5">Primary numerical value of the KPI (e.g. $128,450)</td></tr>
                                <tr><td class="p-3.5 font-mono text-primary font-bold">trend</td><td class="p-3.5 text-muted-foreground">string</td><td class="p-3.5 text-muted-foreground">null</td><td class="p-3.5">Percentage indicator text for increase/decrease</td></tr>
                                <tr><td class="p-3.5 font-mono text-primary font-bold">icon</td><td class="p-3.5 text-muted-foreground">string</td><td class="p-3.5 text-muted-foreground">null</td><td class="p-3.5">Lucide icon name (e.g. 'dollar-sign', 'users')</td></tr>
                                <tr><td class="p-3.5 font-mono text-primary font-bold">tone</td><td class="p-3.5 text-muted-foreground">string</td><td class="p-3.5 text-muted-foreground">'success'</td><td class="p-3.5">Accent color indicator ('success'|'warning'|'destructive'|'primary')</td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- CODE SNIPPET --}}
                <div class="space-y-2 min-w-0 max-w-full">
                    <h3 class="font-bold text-base text-foreground">Blade Code Syntax</h3>
                    <div class="relative group min-w-0 max-w-full">
                        <pre class="overflow-x-auto max-w-full rounded-2xl bg-neutral-950 p-4 text-xs font-mono text-neutral-200 border border-neutral-800 break-all whitespace-pre-wrap sm:whitespace-pre">&lt;x-ui.stat 
    label="Total Revenue" 
    value="$128,450" 
    trend="+18.4% vs last month" 
    icon="dollar-sign" 
    tone="success" /&gt;</pre>
                        <button type="button" x-on:click="copyText('<x-ui.stat label=\'Total Revenue\' value=\'$128,450\' trend=\'+18.4% vs last month\' icon=\'dollar-sign\' tone=\'success\' />', 'code-stat')" class="absolute end-2 top-2 sm:end-3 sm:top-3 px-2.5 py-1 rounded-lg bg-neutral-800/90 hover:bg-neutral-700 text-[11px] text-neutral-300 transition-colors z-10">
                            <span x-text="copiedSnippet === 'code-stat' ? 'Copied! ✓' : 'Copy'"></span>
                        </button>
                    </div>
                </div>
            </div>

            {{-- 6. ALERT BANNER --}}
            <div x-show="docTab === 'alert'" x-cloak class="space-y-8">
                <div class="space-y-3 border-b border-slate-200 dark:border-slate-800/80 pb-6">
                    <div class="flex items-center gap-2">
                        <span class="px-2.5 py-1 rounded-lg bg-blue-50 dark:bg-blue-600/20 text-blue-600 dark:text-blue-400 border border-blue-200 dark:border-blue-500/30 text-xs font-bold font-mono">Feedback</span>
                        <span class="text-xs font-mono text-slate-500 dark:text-slate-400">components/ui/alert.blade.php</span>
                    </div>
                    <h1 class="text-3xl sm:text-4xl font-black text-slate-900 dark:text-white tracking-tight">Alert Banner Component</h1>
                    <p class="text-slate-650 dark:text-slate-300 text-sm sm:text-base leading-relaxed">
                        Essential notification banner for displaying success messages, server status info, warnings, or system error alerts.
                    </p>
                </div>

                {{-- LIVE PLAYGROUND --}}
                <div class="rounded-2xl border border-slate-200 dark:border-slate-800/80 bg-white dark:bg-slate-900/80 backdrop-blur-xl p-6 space-y-4 shadow-lg">
                    <h3 class="font-bold text-sm text-slate-900 dark:text-white flex items-center gap-2">
                        <i data-lucide="play-circle" class="size-4 text-blue-500 dark:text-blue-400"></i> Alert Variants Preview
                    </h3>
                    <div class="space-y-3">
                        <x-ui.alert variant="info" title="Server Information">System Live Sync v1.2.0 active with 12ms latency.</x-ui.alert>
                        <x-ui.alert variant="success" title="Success">Configuration changes applied successfully.</x-ui.alert>
                        <x-ui.alert variant="warning" title="Warning">Server RAM capacity reached 82% threshold.</x-ui.alert>
                        <x-ui.alert variant="destructive" title="Error">Database socket connection temporarily lost.</x-ui.alert>
                    </div>
                </div>

                {{-- PROPS API TABLE --}}
                <div class="space-y-3">
                    <h3 class="font-bold text-base text-slate-900 dark:text-white">API Reference & Props</h3>
                    <div class="overflow-x-auto rounded-2xl border border-slate-200 dark:border-slate-800/80 bg-white dark:bg-slate-900/80 backdrop-blur-xl shadow-lg">
                        <table class="w-full text-start text-xs">
                            <thead class="bg-slate-100 dark:bg-slate-800/60 border-b border-slate-200 dark:border-slate-700/80 text-slate-700 dark:text-slate-300 font-bold">
                                <tr>
                                    <th class="p-3.5 text-start">Prop Name</th>
                                    <th class="p-3.5 text-start">Type</th>
                                    <th class="p-3.5 text-start">Default</th>
                                    <th class="p-3.5 text-start">Description</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-200 dark:divide-slate-800/60 text-slate-650 dark:text-slate-300">
                                <tr><td class="p-3.5 font-mono text-blue-600 dark:text-blue-400 font-bold">variant</td><td class="p-3.5 text-slate-500 dark:text-slate-400">string</td><td class="p-3.5 text-slate-500 dark:text-slate-400">'info'</td><td class="p-3.5">Banner variant style ('info'|'success'|'warning'|'destructive')</td></tr>
                                <tr><td class="p-3.5 font-mono text-blue-600 dark:text-blue-400 font-bold">title</td><td class="p-3.5 text-slate-500 dark:text-slate-400">string</td><td class="p-3.5 text-slate-500 dark:text-slate-400">null</td><td class="p-3.5">Bold title for the alert banner</td></tr>
                                <tr><td class="p-3.5 font-mono text-blue-600 dark:text-blue-400 font-bold">icon</td><td class="p-3.5 text-slate-500 dark:text-slate-400">string</td><td class="p-3.5 text-slate-500 dark:text-slate-400">auto</td><td class="p-3.5">Custom Lucide icon name (optional)</td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- CODE SNIPPET --}}
                <div class="space-y-2 min-w-0 max-w-full">
                    <h3 class="font-bold text-base text-slate-900 dark:text-white">Blade Code Syntax</h3>
                    <div class="relative group min-w-0 max-w-full">
                        <pre class="overflow-x-auto max-w-full rounded-2xl bg-[#030712] p-4 text-xs font-mono text-slate-200 border border-slate-800 break-all whitespace-pre-wrap sm:whitespace-pre">&lt;x-ui.alert variant="success" title="Success"&gt;
    Configuration changes saved successfully.
&lt;/x-ui.alert&gt;</pre>
                    </div>
                </div>
            </div>

            {{-- 7. BUTTON & ACTION --}}
            <div x-show="docTab === 'button'" x-cloak class="space-y-8">
                <div class="space-y-3 border-b border-slate-200 dark:border-slate-800/80 pb-6">
                    <div class="flex items-center gap-2">
                        <span class="px-2.5 py-1 rounded-lg bg-blue-50 dark:bg-blue-600/20 text-blue-600 dark:text-blue-400 border border-blue-200 dark:border-blue-500/30 text-xs font-bold font-mono">Actions</span>
                        <span class="text-xs font-mono text-slate-500 dark:text-slate-400">components/ui/button.blade.php</span>
                    </div>
                    <h1 class="text-3xl sm:text-4xl font-black text-slate-900 dark:text-white tracking-tight">Button & Action Component</h1>
                    <p class="text-slate-650 dark:text-slate-300 text-sm sm:text-base leading-relaxed">
                        Interactive button component with micro-animation hover effects, automatic loading states, and Lucide icon support.
                    </p>
                </div>

                {{-- LIVE PLAYGROUND --}}
                <div class="rounded-2xl border border-slate-200 dark:border-slate-800/80 bg-white dark:bg-slate-900/80 backdrop-blur-xl p-6 space-y-6 shadow-lg">
                    <div class="flex flex-wrap items-center justify-between gap-4 border-b border-slate-200 dark:border-slate-800 pb-4">
                        <h3 class="font-bold text-sm text-slate-900 dark:text-white flex items-center gap-2">
                            <i data-lucide="play-circle" class="size-4 text-blue-500 dark:text-blue-400"></i> Live Interactive Sandbox
                        </h3>
                        <div class="flex flex-wrap items-center gap-3 text-xs">
                            <label class="font-medium text-slate-600 dark:text-slate-400">Variant:</label>
                            <select x-model="btnVariant" class="rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 px-2 py-1 font-medium text-slate-800 dark:text-white focus:outline-none focus:border-blue-500">
                                <option value="primary">Primary</option>
                                <option value="secondary">Secondary</option>
                                <option value="outline">Outline</option>
                                <option value="ghost">Ghost</option>
                                <option value="destructive">Destructive</option>
                            </select>

                            <label class="font-medium text-slate-600 dark:text-slate-400 ms-2">Size:</label>
                            <select x-model="btnSize" class="rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 px-2 py-1 font-medium text-slate-800 dark:text-white focus:outline-none focus:border-blue-500">
                                <option value="xs">XS</option>
                                <option value="sm">SM</option>
                                <option value="md">MD</option>
                                <option value="lg">LG</option>
                            </select>
                        </div>
                    </div>

                    <div class="flex flex-wrap items-center justify-center gap-4 py-4 bg-slate-50 dark:bg-slate-800/50 rounded-xl border border-slate-200 dark:border-slate-700/50">
                        <x-ui.button ::variant="btnVariant" ::size="btnSize" icon="sparkles">
                            Enterprise Action
                        </x-ui.button>
                        <x-ui.button ::variant="btnVariant" ::size="btnSize" icon="download" iconEnd>
                            Export Report
                        </x-ui.button>
                    </div>
                </div>

                {{-- PROPS API TABLE --}}
                <div class="space-y-3">
                    <h3 class="font-bold text-base text-slate-900 dark:text-white">API Reference & Props</h3>
                    <div class="overflow-x-auto rounded-2xl border border-slate-200 dark:border-slate-800/80 bg-white dark:bg-slate-900/80 backdrop-blur-xl shadow-lg">
                        <table class="w-full text-start text-xs">
                            <thead class="bg-slate-100 dark:bg-slate-800/60 border-b border-slate-200 dark:border-slate-700/80 text-slate-700 dark:text-slate-300 font-bold">
                                <tr>
                                    <th class="p-3.5 text-start">Prop Name</th>
                                    <th class="p-3.5 text-start">Type</th>
                                    <th class="p-3.5 text-start">Default</th>
                                    <th class="p-3.5 text-start">Description</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-200 dark:divide-slate-800/60 text-slate-650 dark:text-slate-300">
                                <tr><td class="p-3.5 font-mono text-blue-600 dark:text-blue-400 font-bold">variant</td><td class="p-3.5 text-slate-500 dark:text-slate-400">string</td><td class="p-3.5 text-slate-500 dark:text-slate-400">'primary'</td><td class="p-3.5">'primary' | 'secondary' | 'outline' | 'ghost' | 'destructive'</td></tr>
                                <tr><td class="p-3.5 font-mono text-blue-600 dark:text-blue-400 font-bold">size</td><td class="p-3.5 text-slate-500 dark:text-slate-400">string</td><td class="p-3.5 text-slate-500 dark:text-slate-400">'md'</td><td class="p-3.5">'xs' | 'sm' | 'md' | 'lg' | 'icon'</td></tr>
                                <tr><td class="p-3.5 font-mono text-blue-600 dark:text-blue-400 font-bold">icon</td><td class="p-3.5 text-slate-500 dark:text-slate-400">string</td><td class="p-3.5 text-slate-500 dark:text-slate-400">null</td><td class="p-3.5">Lucide icon name positioned on the left</td></tr>
                                <tr><td class="p-3.5 font-mono text-blue-600 dark:text-blue-400 font-bold">iconEnd</td><td class="p-3.5 text-slate-500 dark:text-slate-400">boolean</td><td class="p-3.5 text-slate-500 dark:text-slate-400">false</td><td class="p-3.5">Positions icon to the right of text</td></tr>
                                <tr><td class="p-3.5 font-mono text-blue-600 dark:text-blue-400 font-bold">href</td><td class="p-3.5 text-slate-500 dark:text-slate-400">string</td><td class="p-3.5 text-slate-500 dark:text-slate-400">null</td><td class="p-3.5">If set, automatically renders as an &lt;a&gt; tag</td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- CODE SNIPPET --}}
                <div class="space-y-2 min-w-0 max-w-full">
                    <h3 class="font-bold text-base text-slate-900 dark:text-white">Blade Code Syntax</h3>
                    <div class="relative group min-w-0 max-w-full">
                        <pre class="overflow-x-auto max-w-full rounded-2xl bg-[#030712] p-4 text-xs font-mono text-slate-200 border border-slate-800 break-all whitespace-pre-wrap sm:whitespace-pre">&lt;x-ui.button variant="primary" size="md" icon="sparkles"&gt;
    Enterprise Action
&lt;/x-ui.button&gt;</pre>
                    </div>
                </div>
            </div>

            {{-- 8. BADGE STATUS --}}
            <div x-show="docTab === 'badge'" x-cloak class="space-y-8">
                <div class="space-y-3 border-b border-slate-200 dark:border-slate-800/80 pb-6">
                    <div class="flex items-center gap-2">
                        <span class="px-2.5 py-1 rounded-lg bg-blue-50 dark:bg-blue-600/20 text-blue-600 dark:text-blue-400 border border-blue-200 dark:border-blue-500/30 text-xs font-bold font-mono">Data Display</span>
                        <span class="text-xs font-mono text-slate-500 dark:text-slate-400">components/ui/badge.blade.php</span>
                    </div>
                    <h1 class="text-3xl sm:text-4xl font-black text-slate-900 dark:text-white tracking-tight">Badge Status Component</h1>
                    <p class="text-slate-650 dark:text-slate-300 text-sm sm:text-base leading-relaxed">
                        Compact status indicator label for marking data conditions such as payment status, live sync status, or category tags.
                    </p>
                </div>

                {{-- LIVE PLAYGROUND --}}
                <div class="rounded-2xl border border-slate-200 dark:border-slate-800/80 bg-white dark:bg-slate-900/80 backdrop-blur-xl p-6 space-y-4 shadow-lg">
                    <h3 class="font-bold text-sm text-slate-900 dark:text-white flex items-center gap-2">
                        <i data-lucide="play-circle" class="size-4 text-blue-500 dark:text-blue-400"></i> Preview Live Badges
                    </h3>
                    <div class="flex flex-wrap items-center gap-3">
                        <x-ui.badge variant="solid">Solid Primary</x-ui.badge>
                        <x-ui.badge variant="success" dot>Live Sync Active</x-ui.badge>
                        <x-ui.badge variant="warning">Pending Approval</x-ui.badge>
                        <x-ui.badge variant="destructive">Payment Refunded</x-ui.badge>
                        <x-ui.badge variant="outline">Outline Tag</x-ui.badge>
                    </div>
                </div>

                {{-- CODE SNIPPET --}}
                <div class="space-y-2 min-w-0 max-w-full">
                    <h3 class="font-bold text-base text-slate-900 dark:text-white">Blade Code Syntax</h3>
                    <div class="relative group min-w-0 max-w-full">
                        <pre class="overflow-x-auto max-w-full rounded-2xl bg-[#030712] p-4 text-xs font-mono text-slate-200 border border-slate-800 break-all whitespace-pre-wrap sm:whitespace-pre">&lt;x-ui.badge variant="success" dot&gt;
    Live Sync Active
&lt;/x-ui.badge&gt;</pre>
                    </div>
                </div>
            </div>

            {{-- 9. CARD CONTAINER --}}
            <div x-show="docTab === 'card'" x-cloak class="space-y-8">
                <div class="space-y-3 border-b border-slate-200 dark:border-slate-800/80 pb-6">
                    <div class="flex items-center gap-2">
                        <span class="px-2.5 py-1 rounded-lg bg-blue-50 dark:bg-blue-600/20 text-blue-600 dark:text-blue-400 border border-blue-200 dark:border-blue-500/30 text-xs font-bold font-mono">Containers</span>
                        <span class="text-xs font-mono text-slate-500 dark:text-slate-400">components/ui/card.blade.php</span>
                    </div>
                    <h1 class="text-3xl sm:text-4xl font-black text-slate-900 dark:text-white tracking-tight">Card Container Component</h1>
                    <p class="text-slate-650 dark:text-slate-300 text-sm sm:text-base leading-relaxed">
                        Structured content container featuring headers, subtitles, header action slots, and optional footers.
                    </p>
                </div>

                {{-- LIVE PLAYGROUND --}}
                <div class="rounded-2xl border border-slate-200 dark:border-slate-800/80 bg-white dark:bg-slate-900/80 backdrop-blur-xl p-6 space-y-4 shadow-lg">
                    <h3 class="font-bold text-sm text-slate-900 dark:text-white flex items-center gap-2">
                        <i data-lucide="play-circle" class="size-4 text-blue-500 dark:text-blue-400"></i> Demo Card Container
                    </h3>
                    <x-ui.card title="System Telemetry Settings" subtitle="Configure real-time memory & CPU threshold limits" hover>
                        <x-slot:actions>
                            <x-ui.button variant="outline" size="sm" icon="refresh-cw" x-on:click="window.toast('Telemetry refreshed', {variant:'info'})">Refresh</x-ui.button>
                        </x-slot:actions>
                        <p class="text-xs text-slate-600 dark:text-slate-300 leading-relaxed">
                            This parameter controls the Livewire server process memory allocation limit. When CPU load exceeds 85%, the system automatically enables response caching.
                        </p>
                    </x-ui.card>
                </div>
            </div>

            {{-- 10. MODAL DIALOG --}}
            <div x-show="docTab === 'modal'" x-cloak class="space-y-8">
                <div class="space-y-3 border-b border-slate-200 dark:border-slate-800/80 pb-6">
                    <div class="flex items-center gap-2">
                        <span class="px-2.5 py-1 rounded-lg bg-blue-50 dark:bg-blue-600/20 text-blue-600 dark:text-blue-400 border border-blue-200 dark:border-blue-500/30 text-xs font-bold font-mono">Overlay</span>
                        <span class="text-xs font-mono text-slate-500 dark:text-slate-400">components/ui/modal.blade.php</span>
                    </div>
                    <h1 class="text-3xl sm:text-4xl font-black text-slate-900 dark:text-white tracking-tight">Modal Dialog Overlay</h1>
                    <p class="text-slate-650 dark:text-slate-300 text-sm sm:text-base leading-relaxed">
                        Interactive popup modal built on Alpine.js with backdrop blur effects, ESC key handling, and smooth transition animations.
                    </p>
                </div>

                {{-- LIVE PLAYGROUND --}}
                <div class="rounded-2xl border border-slate-200 dark:border-slate-800/80 bg-white dark:bg-slate-900/80 backdrop-blur-xl p-6 space-y-4 shadow-lg">
                    <div class="flex items-center justify-between border-b border-slate-200 dark:border-slate-800 pb-4">
                        <h3 class="font-bold text-sm text-slate-900 dark:text-white flex items-center gap-2">
                            <i data-lucide="play-circle" class="size-4 text-blue-500 dark:text-blue-400"></i> Live Interactive Modal Test
                        </h3>
                    </div>

                    <div class="flex flex-col items-center justify-center p-8 bg-slate-50 dark:bg-slate-800/40 rounded-xl space-y-4 border border-slate-200 dark:border-slate-700/50">
                        <p class="text-xs text-slate-650 dark:text-slate-300 text-center max-w-md">Click the button below to trigger a live interactive modal dialog inside the application:</p>
                        
                        <x-ui.button x-on:click="$dispatch('open-modal', 'demo-doc-modal')" variant="primary" icon="maximize-2">
                            Open Live Modal Dialog
                        </x-ui.button>
                    </div>

                    {{-- REAL LIVE MODAL INSTANCE FOR DEMO --}}
                    <x-ui.modal name="demo-doc-modal" title="Enterprise Action Confirmation">
                        <div class="space-y-4 py-2">
                            <x-ui.alert variant="warning" title="Attention">
                                Are you sure you want to process this data synchronization to the production server?
                            </x-ui.alert>
                            <p class="text-xs text-slate-650 dark:text-slate-300 leading-relaxed">
                                This action will refresh server cache tables and broadcast notification events to all active administrators.
                            </p>
                            <div class="flex justify-end gap-2 pt-2 border-t border-slate-200 dark:border-slate-800">
                                <x-ui.button x-on:click="$dispatch('close-modal', 'demo-doc-modal')" variant="ghost" size="sm">Cancel</x-ui.button>
                                <x-ui.button x-on:click="window.toast('Sync in progress! 🚀', {variant:'success'}); $dispatch('close-modal', 'demo-doc-modal')" variant="primary" size="sm">Proceed</x-ui.button>
                            </div>
                        </div>
                    </x-ui.modal>
                </div>

                {{-- PROPS API TABLE --}}
                <div class="space-y-3">
                    <h3 class="font-bold text-base text-slate-900 dark:text-white">API Reference & Props</h3>
                    <div class="overflow-x-auto rounded-2xl border border-slate-200 dark:border-slate-800/80 bg-white dark:bg-slate-900/80 backdrop-blur-xl shadow-lg">
                        <table class="w-full text-start text-xs">
                            <thead class="bg-slate-100 dark:bg-slate-800/60 border-b border-slate-200 dark:border-slate-700/80 text-slate-700 dark:text-slate-300 font-bold">
                                <tr>
                                    <th class="p-3.5 text-start">Prop Name</th>
                                    <th class="p-3.5 text-start">Type</th>
                                    <th class="p-3.5 text-start">Default</th>
                                    <th class="p-3.5 text-start">Description</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-200 dark:divide-slate-800/60 text-slate-650 dark:text-slate-300">
                                <tr><td class="p-3.5 font-mono text-blue-600 dark:text-blue-400 font-bold">name</td><td class="p-3.5 text-slate-500 dark:text-slate-400">string</td><td class="p-3.5 text-slate-500 dark:text-slate-400">'modal'</td><td class="p-3.5">Unique modal identifier for $dispatch('open-modal', 'name')</td></tr>
                                <tr><td class="p-3.5 font-mono text-blue-600 dark:text-blue-400 font-bold">title</td><td class="p-3.5 text-slate-500 dark:text-slate-400">string</td><td class="p-3.5 text-slate-500 dark:text-slate-400">null</td><td class="p-3.5">Primary header title for modal</td></tr>
                                <tr><td class="p-3.5 font-mono text-blue-600 dark:text-blue-400 font-bold">maxWidth</td><td class="p-3.5 text-slate-500 dark:text-slate-400">string</td><td class="p-3.5 text-slate-500 dark:text-slate-400">'max-w-lg'</td><td class="p-3.5">Maximum width ('max-w-sm'|'max-w-md'|'max-w-lg'|'max-w-2xl')</td></tr>
                                <tr><td class="p-3.5 font-mono text-blue-600 dark:text-blue-400 font-bold">position</td><td class="p-3.5 text-slate-500 dark:text-slate-400">string</td><td class="p-3.5 text-slate-500 dark:text-slate-400">'center'</td><td class="p-3.5">Placement position ('center'|'top'|'drawer-left'|'drawer-right')</td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- CODE SNIPPET --}}
                <div class="space-y-2 min-w-0 max-w-full">
                    <h3 class="font-bold text-base text-slate-900 dark:text-white">Blade Code Syntax</h3>
                    <div class="relative group min-w-0 max-w-full">
                        <pre class="overflow-x-auto max-w-full rounded-2xl bg-[#030712] p-4 text-xs font-mono text-slate-200 border border-slate-800 break-all whitespace-pre-wrap sm:whitespace-pre">&lt;!-- Modal Trigger Button --&gt;
&lt;x-ui.button x-on:click="$dispatch('open-modal', 'confirm-modal')"&gt;Open Modal&lt;/x-ui.button&gt;

&lt;!-- Modal Dialog Component --&gt;
&lt;x-ui.modal name="confirm-modal" title="Confirm Data Deletion"&gt;
    &lt;p class="text-xs text-slate-300"&gt;Are you sure you want to delete this data record?&lt;/p&gt;
&lt;/x-ui.modal&gt;</pre>
                    </div>
                </div>
            </div>

            {{-- 11. FORM INPUT --}}
            <div x-show="docTab === 'input'" x-cloak class="space-y-8">
                <div class="space-y-3 border-b border-slate-200 dark:border-slate-800/80 pb-6">
                    <div class="flex items-center gap-2">
                        <span class="px-2.5 py-1 rounded-lg bg-blue-50 dark:bg-blue-600/20 text-blue-600 dark:text-blue-400 border border-blue-200 dark:border-blue-500/30 text-xs font-bold font-mono">Forms</span>
                        <span class="text-xs font-mono text-slate-500 dark:text-slate-400">components/ui/input.blade.php</span>
                    </div>
                    <h1 class="text-3xl sm:text-4xl font-black text-slate-900 dark:text-white tracking-tight">Form Input Component</h1>
                    <p class="text-slate-650 dark:text-slate-300 text-sm sm:text-base leading-relaxed">
                        Unified form input field complete with labels, validation error messaging, helper hints, and inset icons.
                    </p>
                </div>

                {{-- LIVE PLAYGROUND --}}
                <div class="rounded-2xl border border-slate-200 dark:border-slate-800/80 bg-white dark:bg-slate-900/80 backdrop-blur-xl p-6 space-y-4 shadow-lg">
                    <h3 class="font-bold text-sm text-slate-900 dark:text-white flex items-center gap-2">
                        <i data-lucide="play-circle" class="size-4 text-blue-500 dark:text-blue-400"></i> Live Input Preview
                    </h3>
                    <div class="space-y-4 max-w-md">
                        <x-ui.input label="Enterprise Email Address" type="email" placeholder="admin@adminkit.test" icon="mail" />
                        <x-ui.input label="API Key Keyring" type="password" placeholder="••••••••••••••••" icon="key" hint="Ensure you hold an active production license" />
                    </div>
                </div>

                {{-- CODE SNIPPET --}}
                <div class="space-y-2 min-w-0 max-w-full">
                    <h3 class="font-bold text-base text-slate-900 dark:text-white">Blade Code Syntax</h3>
                    <div class="relative group min-w-0 max-w-full">
                        <pre class="overflow-x-auto max-w-full rounded-2xl bg-[#030712] p-4 text-xs font-mono text-slate-200 border border-slate-800 break-all whitespace-pre-wrap sm:whitespace-pre">&lt;x-ui.input 
    label="Enterprise Email Address" 
    type="email" 
    placeholder="admin@adminkit.test" 
    icon="mail" /&gt;</pre>
                    </div>
                </div>
            </div>

            {{-- 12. DROPDOWN MENU --}}
            <div x-show="docTab === 'dropdown'" x-cloak class="space-y-8">
                <div class="space-y-3 border-b border-slate-200 dark:border-slate-800/80 pb-6">
                    <div class="flex items-center gap-2">
                        <span class="px-2.5 py-1 rounded-lg bg-blue-50 dark:bg-blue-600/20 text-blue-600 dark:text-blue-400 border border-blue-200 dark:border-blue-500/30 text-xs font-bold font-mono">Overlay</span>
                        <span class="text-xs font-mono text-slate-500 dark:text-slate-400">components/ui/dropdown.blade.php</span>
                    </div>
                    <h1 class="text-3xl sm:text-4xl font-black text-slate-900 dark:text-white tracking-tight">Dropdown Menu Component</h1>
                    <p class="text-slate-650 dark:text-slate-300 text-sm sm:text-base leading-relaxed">
                        Contextual floating menu for swift navigation and table row actions.
                    </p>
                </div>

                {{-- LIVE PLAYGROUND --}}
                <div class="rounded-2xl border border-slate-200 dark:border-slate-800/80 bg-white dark:bg-slate-900/80 backdrop-blur-xl p-6 space-y-4 shadow-lg">
                    <h3 class="font-bold text-sm text-slate-900 dark:text-white flex items-center gap-2">
                        <i data-lucide="play-circle" class="size-4 text-blue-500 dark:text-blue-400"></i> Live Dropdown Test
                    </h3>
                    <div class="flex justify-start">
                        <x-ui.dropdown label="Account Options Menu" icon="chevron-down">
                            <x-ui.dropdown-item icon="user">View Profile</x-ui.dropdown-item>
                            <x-ui.dropdown-item icon="settings">Account Settings</x-ui.dropdown-item>
                            <x-ui.dropdown-item icon="log-out" variant="destructive">Sign Out</x-ui.dropdown-item>
                        </x-ui.dropdown>
                    </div>
                </div>
            </div>

            {{-- 13. USER AVATAR --}}
            <div x-show="docTab === 'avatar'" x-cloak class="space-y-8">
                <div class="space-y-3 border-b border-slate-200 dark:border-slate-800/80 pb-6">
                    <div class="flex items-center gap-2">
                        <span class="px-2.5 py-1 rounded-lg bg-blue-50 dark:bg-blue-600/20 text-blue-600 dark:text-blue-400 border border-blue-200 dark:border-blue-500/30 text-xs font-bold font-mono">Data Display</span>
                        <span class="text-xs font-mono text-slate-500 dark:text-slate-400">components/ui/avatar.blade.php</span>
                    </div>
                    <h1 class="text-3xl sm:text-4xl font-black text-slate-900 dark:text-white tracking-tight">User Avatar Component</h1>
                    <p class="text-slate-650 dark:text-slate-300 text-sm sm:text-base leading-relaxed">
                        User profile picture component that automatically renders name initials when an image is not provided.
                    </p>
                </div>

                {{-- LIVE PLAYGROUND --}}
                <div class="rounded-2xl border border-slate-200 dark:border-slate-800/80 bg-white dark:bg-slate-900/80 backdrop-blur-xl p-6 flex flex-wrap items-center gap-4 shadow-lg">
                    <x-ui.avatar name="Emily Watson" size="sm" status="online" />
                    <x-ui.avatar name="Omar Haddad" size="md" status="online" />
                    <x-ui.avatar name="Alex Rivera" size="lg" status="busy" />
                </div>
            </div>

            {{-- 14. GAUGE PROGRESS CHART --}}
            <div x-show="docTab === 'gauge'" x-cloak class="space-y-8">
                <div class="space-y-3 border-b border-slate-200 dark:border-slate-800/80 pb-6">
                    <div class="flex items-center gap-2">
                        <span class="px-2.5 py-1 rounded-lg bg-blue-50 dark:bg-blue-600/20 text-blue-600 dark:text-blue-400 border border-blue-200 dark:border-blue-500/30 text-xs font-bold font-mono">Charts</span>
                        <span class="text-xs font-mono text-slate-500 dark:text-slate-400">components/ui/gauge.blade.php</span>
                    </div>
                    <h1 class="text-3xl sm:text-4xl font-black text-slate-900 dark:text-white tracking-tight">Gauge Progress Chart</h1>
                    <p class="text-slate-650 dark:text-slate-300 text-sm sm:text-base leading-relaxed">
                        Semi-circular SVG gauge chart for visualizing goal achievements or percentage metrics.
                    </p>
                </div>

                {{-- LIVE PLAYGROUND --}}
                <div class="rounded-2xl border border-slate-200 dark:border-slate-800/80 bg-white dark:bg-slate-900/80 backdrop-blur-xl p-6 space-y-6 shadow-lg">
                    <div class="flex items-center justify-between border-b border-slate-200 dark:border-slate-800 pb-4">
                        <h3 class="font-bold text-sm text-slate-900 dark:text-white flex items-center gap-2">
                            <i data-lucide="play-circle" class="size-4 text-blue-500 dark:text-blue-400"></i> Interactive Gauge Slider
                        </h3>
                        <div class="flex items-center gap-2 text-xs">
                            <span class="font-medium text-slate-600 dark:text-slate-400">Percentage:</span>
                            <input type="range" min="0" max="100" x-model="gaugeValue" class="w-32 accent-blue-500 cursor-pointer bg-slate-200 dark:bg-slate-700">
                            <span class="font-mono font-bold text-blue-600 dark:text-blue-400 w-8" x-text="gaugeValue + '%'"></span>
                        </div>
                    </div>

                    <div class="flex justify-center py-4">
                        <x-ui.gauge ::value="gaugeValue" tone="primary" sub="$128.4K / $150K" label="Monthly target goal" :size="160" />
                    </div>
                </div>
            </div>

            {{-- 15. TOAST NOTIFICATIONS ENGINE --}}
            <div x-show="docTab === 'toast'" x-cloak class="space-y-8">
                <div class="space-y-3 border-b border-slate-200 dark:border-slate-800/80 pb-6">
                    <div class="flex items-center gap-2">
                        <span class="px-2.5 py-1 rounded-lg bg-blue-50 dark:bg-blue-600/20 text-blue-600 dark:text-blue-400 border border-blue-200 dark:border-blue-500/30 text-xs font-bold font-mono">State Management</span>
                        <span class="text-xs font-mono text-slate-500 dark:text-slate-400">window.toast()</span>
                    </div>
                    <h1 class="text-3xl sm:text-4xl font-black text-slate-900 dark:text-white tracking-tight">Toast Notifications Engine</h1>
                    <p class="text-slate-650 dark:text-slate-300 text-sm sm:text-base leading-relaxed">
                        Integrated floating toast notification system callable from anywhere using vanilla JavaScript or Alpine.js.
                    </p>
                </div>

                {{-- LIVE PLAYGROUND --}}
                <div class="space-y-4">
                    <h3 class="text-sm font-bold text-slate-900 dark:text-white">Live Toast Test</h3>
                    <div class="rounded-2xl border border-slate-200 dark:border-slate-800/80 bg-white dark:bg-slate-900/80 backdrop-blur-xl p-6 flex flex-wrap items-center gap-3 shadow-lg">
                        <x-ui.button x-on:click="window.toast('Operation completed successfully! 🎉', {variant:'success'})" variant="primary">
                            Trigger Success Toast
                        </x-ui.button>
                        <x-ui.button x-on:click="window.toast('System maintenance scheduled tonight at 00:00 UTC', {variant:'info'})" variant="secondary">
                            Trigger Info Toast
                        </x-ui.button>
                        <x-ui.button x-on:click="window.toast('Warning: High server CPU load detected (88%)', {variant:'warning'})" variant="outline">
                            Trigger Warning Toast
                        </x-ui.button>
                        <x-ui.button x-on:click="window.toast('Failed to establish database socket connection', {variant:'destructive'})" variant="destructive">
                            Trigger Error Toast
                        </x-ui.button>
                    </div>
                </div>

                <div class="space-y-3 min-w-0 max-w-full">
                    <h3 class="text-sm font-bold text-slate-900 dark:text-white">JavaScript Call Syntax</h3>
                    <pre class="overflow-x-auto max-w-full rounded-xl bg-[#030712] p-4 text-xs font-mono text-slate-200 border border-slate-800 break-all whitespace-pre-wrap sm:whitespace-pre"><code>// Vanilla JavaScript or Alpine.js standard call
window.toast('Message content here', {
    variant: 'success', // 'success' | 'info' | 'warning' | 'destructive'
    duration: 3000
});</code></pre>
                </div>
            </div>

        </main>

        {{-- Right Floating Sticky Table of Contents --}}
        <aside class="hidden xl:block w-72 shrink-0 sticky top-[73px] h-[calc(100vh-73px)] overflow-y-auto pt-4 pb-8 space-y-5">

            {{-- On This Page --}}
            <div class="rounded-2xl border border-slate-200 dark:border-slate-800/80 bg-white dark:bg-slate-900/80 p-5 space-y-4 shadow-lg">
                <h4 class="font-black text-xs uppercase tracking-widest text-slate-500 dark:text-slate-400 flex items-center gap-2">
                    <i data-lucide="list" class="size-3.5 text-blue-500 dark:text-blue-400"></i> Page Navigation
                </h4>
                <ul class="space-y-1.5 text-xs font-medium">
                    <li>
                        <a href="#" x-on:click.prevent="window.scrollTo({top:0, behavior:'smooth'})"
                           class="flex items-center gap-2 px-3 py-2 rounded-lg bg-blue-50 dark:bg-blue-600/15 text-blue-600 dark:text-blue-400 font-bold border border-blue-200 dark:border-blue-500/30 transition-all">
                            <i data-lucide="file-text" class="size-3.5 shrink-0"></i>
                            <span>Document Summary</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" x-on:click.prevent="window.scrollTo({top:250, behavior:'smooth'})"
                           class="flex items-center gap-2 px-3 py-2 rounded-lg text-slate-600 dark:text-slate-400 hover:text-blue-600 dark:hover:text-blue-400 hover:bg-slate-100 dark:hover:bg-slate-800/60 transition-all">
                            <i data-lucide="play-circle" class="size-3.5 shrink-0"></i>
                            <span>Live Playground</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" x-on:click.prevent="window.scrollTo({top:500, behavior:'smooth'})"
                           class="flex items-center gap-2 px-3 py-2 rounded-lg text-slate-600 dark:text-slate-400 hover:text-blue-600 dark:hover:text-blue-400 hover:bg-slate-100 dark:hover:bg-slate-800/60 transition-all">
                            <i data-lucide="table-2" class="size-3.5 shrink-0"></i>
                            <span>API &amp; Props Table</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" x-on:click.prevent="window.scrollTo({top:750, behavior:'smooth'})"
                           class="flex items-center gap-2 px-3 py-2 rounded-lg text-slate-600 dark:text-slate-400 hover:text-blue-600 dark:hover:text-blue-400 hover:bg-slate-100 dark:hover:bg-slate-800/60 transition-all">
                            <i data-lucide="code-2" class="size-3.5 shrink-0"></i>
                            <span>Code Snippet</span>
                        </a>
                    </li>
                </ul>
            </div>

            {{-- Quick Links --}}
            <div class="rounded-2xl border border-slate-200 dark:border-slate-800/80 bg-white dark:bg-slate-900/80 p-5 space-y-4 shadow-lg">
                <h4 class="font-black text-xs uppercase tracking-widest text-slate-500 dark:text-slate-400 flex items-center gap-2">
                    <i data-lucide="zap" class="size-3.5 text-blue-500 dark:text-blue-400"></i> Quick Jump
                </h4>
                <div class="space-y-1.5">
                    @php
                        $quickLinks = [
                            ['tab' => 'introduction', 'label' => 'Architecture Overview', 'icon' => 'layout-dashboard'],
                            ['tab' => 'installation',  'label' => 'Installation Guide',    'icon' => 'terminal'],
                            ['tab' => 'theming',       'label' => 'HSL & Dark Mode',       'icon' => 'palette'],
                            ['tab' => 'routing',       'label' => 'Tree Navigation',        'icon' => 'git-branch'],
                            ['tab' => 'button',        'label' => 'Button Component',       'icon' => 'mouse-pointer-2'],
                            ['tab' => 'modal',         'label' => 'Modal Dialog',           'icon' => 'maximize-2'],
                            ['tab' => 'toast',         'label' => 'Toast Engine',           'icon' => 'bell'],
                        ];
                    @endphp
                    @foreach($quickLinks as $ql)
                    <button type="button"
                            x-on:click="docTab = '{{ $ql['tab'] }}'; window.scrollTo({top:0,behavior:'smooth'})"
                            :class="docTab === '{{ $ql['tab'] }}' ? 'bg-blue-50 dark:bg-blue-600/15 text-blue-600 dark:text-blue-400 font-bold border-blue-200 dark:border-blue-500/30' : 'text-slate-600 dark:text-slate-400 border-transparent hover:bg-slate-100 dark:hover:bg-slate-800/60 hover:text-slate-900 dark:hover:text-white'"
                            class="w-full flex items-center gap-2.5 px-3 py-2 rounded-lg text-xs border transition-all text-start">
                        <i data-lucide="{{ $ql['icon'] }}" class="size-3.5 shrink-0"></i>
                        <span>{{ $ql['label'] }}</span>
                    </button>
                    @endforeach
                </div>
            </div>

            {{-- Version Badge --}}
            <div class="rounded-2xl border border-slate-200 dark:border-slate-800/80 bg-white dark:bg-slate-900/80 p-5 space-y-3 shadow-lg">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-black text-slate-900 dark:text-white uppercase tracking-wider">AdminKit</span>
                    <span class="text-[10px] font-mono font-bold px-2 py-0.5 rounded-md bg-blue-600/15 text-blue-600 dark:text-blue-400 border border-blue-500/30">v1.2.0</span>
                </div>
                <div class="space-y-2 text-[11px] text-slate-600 dark:text-slate-400">
                    <div class="flex items-center gap-2">
                        <span class="size-1.5 rounded-full bg-emerald-500 shrink-0"></span>
                        <span>Laravel 13 + Livewire 4</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="size-1.5 rounded-full bg-blue-500 shrink-0"></span>
                        <span>Tailwind CSS v4</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="size-1.5 rounded-full bg-violet-500 shrink-0"></span>
                        <span>Alpine.js 3 + Vite 6</span>
                    </div>
                </div>
            </div>

            {{-- GitHub Card --}}
            <div class="rounded-2xl border border-slate-200 dark:border-slate-800/80 bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 p-5 space-y-3 shadow-xl relative overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-br from-blue-600/10 to-violet-600/10 pointer-events-none"></div>
                <div class="relative space-y-3">
                    <div class="flex items-center gap-2">
                        <x-ui.icon name="github" class="size-5 text-white" />
                        <span class="font-black text-sm text-white">GitHub Repository</span>
                    </div>
                    <p class="text-xs text-slate-300 leading-relaxed">Want to contribute components, report bugs, or suggest features? We welcome all contributions!</p>
                    <div class="flex items-center gap-2 pt-1">
                        <a href="https://github.com/yrizzz/adminkit" target="_blank"
                           class="flex-1 text-center px-3 py-2 rounded-xl bg-white/10 hover:bg-white/20 border border-white/20 text-white text-xs font-bold transition-all">
                            ⭐ Star Repo
                        </a>
                        <a href="https://github.com/yrizzz/adminkit/issues" target="_blank"
                           class="flex-1 text-center px-3 py-2 rounded-xl bg-blue-600 hover:bg-blue-500 text-white text-xs font-bold transition-all shadow-lg shadow-blue-600/30">
                            Open Issue
                        </a>
                    </div>
                </div>
            </div>

        </aside>

    </div>

    {{-- MODERN RESPONSIVE FOOTER (Identical to Landing Page) --}}
    <footer class="bg-[#F8FAFC] dark:bg-[#050A14] border-t border-slate-200 dark:border-none pt-16 pb-10 px-4 sm:px-6 relative z-10 overflow-hidden">
        {{-- Shimmer Animated Top Accent Line (Thin & Elegant) --}}
        <div class="absolute top-0 inset-x-0 h-[1px] bg-slate-200 dark:bg-slate-800/40 overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-r from-transparent via-blue-500/70 to-transparent w-full animate-shimmer-slow"></div>
        </div>

        <div class="mx-auto max-w-8xl space-y-12">
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
                    <ul class="space-y-2.5 text-sm text-slate-600 dark:text-slate-355 font-medium">
                        <li><a href="{{ route('landing') }}#features" wire:navigate class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Features</a></li>
                        <li><a href="{{ route('landing') }}#showcase" wire:navigate class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Demos</a></li>
                        <li><a href="{{ route('page', ['path' => 'docs']) }}" wire:navigate class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors font-bold text-blue-600 dark:text-blue-400">Documentation</a></li>
                        <li><a href="{{ route('landing') }}#quickstart" wire:navigate class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Quickstart</a></li>
                        <li><a href="{{ route('landing') }}#faq" wire:navigate class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">FAQ</a></li>
                    </ul>
                </div>

                {{-- Column 2: RESOURCES --}}
                <div class="space-y-3.5">
                    <h4 class="text-xs sm:text-sm font-bold uppercase tracking-wider text-slate-900 dark:text-white">RESOURCES</h4>
                    <ul class="space-y-2.5 text-sm text-slate-600 dark:text-slate-355 font-medium">
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
