<div x-data="{
    activeTab: 'composer',
    copied: false,
    copiedSnippet: null,
    activeFaq: null,
    mobileMenuOpen: false,
    scrolled: false,
    init() {
        this.scrolled = (window.scrollY || window.pageYOffset) > 20;
    },
    copyCommand(text, id) {
        navigator.clipboard.writeText(text).catch(() => {});
        this.copiedSnippet = id;
        setTimeout(() => this.copiedSnippet = null, 2000);
    }
}"
x-on:scroll.window.passive="scrolled = ((window.scrollY || window.pageYOffset) > 20)"
class="min-h-screen bg-slate-50 dark:bg-[#05080F] text-slate-900 dark:text-white antialiased selection:bg-blue-600/30 selection:text-blue-400 relative overflow-x-clip font-sans">

    {{-- Ambient Spotlights Background --}}
    <div class="pointer-events-none fixed inset-0 z-0 overflow-hidden">
        <div class="absolute -top-56 left-1/2 -translate-x-1/3 w-[900px] h-[600px] bg-blue-600/12 dark:bg-blue-600/18 rounded-full blur-[160px]"></div>
        <div class="absolute top-1/3 -right-60 w-[700px] h-[700px] bg-indigo-600/8 dark:bg-indigo-600/12 rounded-full blur-[180px]"></div>
        <div class="absolute bottom-0 -left-40 w-[700px] h-[600px] bg-cyan-600/6 dark:bg-cyan-600/10 rounded-full blur-[160px]"></div>
        <div class="absolute top-2/3 left-1/2 w-[500px] h-[500px] bg-blue-700/6 dark:bg-blue-700/10 rounded-full blur-[140px]"></div>
    </div>

    {{-- Sticky Navbar --}}
    <header
        :class="scrolled || mobileMenuOpen
            ? 'bg-white/90 dark:bg-[#080C18]/90 backdrop-blur-2xl border-slate-200/80 dark:border-slate-800/70 py-3 shadow-xl shadow-black/5 dark:shadow-black/50'
            : 'bg-transparent border-transparent backdrop-blur-none py-4'"
        class="landing-header sticky top-0 z-50 w-full border-b transition-all duration-300">

        <div class="mx-auto flex max-w-7xl items-center justify-between px-4 sm:px-6 gap-3">

            {{-- Brand --}}
            <a href="{{ route('landing') }}" class="flex items-center gap-2.5 group shrink-0">
                <span class="relative grid size-9 shrink-0 place-items-center rounded-xl bg-gradient-to-br from-blue-500 to-indigo-600 text-white shadow-lg shadow-blue-600/30 overflow-hidden transition-transform group-hover:scale-105">
                    <span class="absolute inset-0 bg-gradient-to-r from-transparent via-white/25 to-transparent translate-x-[-100%] group-hover:translate-x-[100%] transition-transform duration-700"></span>
                    <i data-lucide="gem" class="size-4.5 relative z-10"></i>
                </span>
                <div class="flex flex-col leading-none">
                    <span class="text-[1.15rem] font-black tracking-tight text-slate-900 dark:text-white">AdminKit</span>
                    <span class="text-[9px] font-mono font-bold text-blue-500 dark:text-blue-400 mt-0.5">Enterprise v1.2</span>
                </div>
            </a>

            {{-- Desktop Nav --}}
            <nav class="hidden md:flex items-center gap-7 text-sm font-medium text-slate-600 dark:text-slate-300">
                <a href="#features" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Features</a>
                <a href="#showcase" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Preview</a>
                <a href="#tech" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Tech Stack</a>
                <a href="#quickstart" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Quickstart</a>
                <a href="#faq" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">FAQ</a>
                <a href="{{ route('page', ['path' => 'docs']) }}"
                   class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors font-semibold">
                    Docs
                </a>
            </nav>

            {{-- CTA & Controls --}}
            <div class="flex items-center gap-2 shrink-0">
                <button type="button" x-on:click="$store.ui.toggleTheme($event)"
                    class="size-9 grid place-items-center rounded-xl border border-slate-200 dark:border-slate-700/80 bg-white/80 dark:bg-slate-800/80 text-slate-500 dark:text-slate-400 hover:text-blue-600 dark:hover:text-blue-400 hover:border-blue-500/50 transition-all shadow-sm">
                    <i data-lucide="moon" x-show="!$store.ui.isDark" class="size-4"></i>
                    <i data-lucide="sun" x-show="$store.ui.isDark" x-cloak class="size-4"></i>
                </button>

                <a href="https://github.com/yrizzz/adminkit" target="_blank"
                   class="hidden sm:inline-flex items-center gap-2 rounded-xl border border-slate-200 dark:border-slate-700/80 bg-white/80 dark:bg-slate-800/80 px-3.5 py-2 text-xs font-semibold text-slate-700 dark:text-slate-200 hover:border-blue-500/50 hover:text-blue-600 dark:hover:text-blue-400 transition-all shadow-sm">
                    <i data-lucide="github" class="size-3.5"></i>
                    <span>GitHub</span>
                    <span class="rounded-md bg-blue-600/15 dark:bg-blue-600/25 border border-blue-500/30 px-1.5 py-0.5 text-[10px] font-mono text-blue-600 dark:text-blue-400">3.2k</span>
                </a>

                <a href="{{ route('dashboard') }}"
                   class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 px-4 py-2 text-xs font-bold text-white shadow-md shadow-blue-600/25 hover:from-blue-500 hover:to-indigo-500 transition-all">
                    Dashboard →
                </a>

                {{-- Hamburger --}}
                <button type="button" x-on:click="mobileMenuOpen = !mobileMenuOpen"
                    class="md:hidden p-2 rounded-xl border border-slate-200 dark:border-slate-700/80 bg-white/80 dark:bg-slate-800/80 text-slate-600 dark:text-slate-300 transition-colors">
                    <i data-lucide="menu" x-show="!mobileMenuOpen" class="size-4.5"></i>
                    <i data-lucide="x" x-show="mobileMenuOpen" x-cloak class="size-4.5"></i>
                </button>
            </div>
        </div>

        {{-- Mobile Dropdown --}}
        <div x-show="mobileMenuOpen" x-cloak
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-2"
             class="md:hidden border-t border-slate-200 dark:border-slate-800/80 bg-white/95 dark:bg-[#080C18]/98 px-4 py-5 space-y-2 shadow-2xl backdrop-blur-2xl">
            <nav class="flex flex-col gap-1 text-sm font-semibold text-slate-700 dark:text-slate-200">
                @foreach (['#features' => 'Features', '#showcase' => 'Preview', '#tech' => 'Tech Stack', '#quickstart' => 'Quickstart', '#faq' => 'FAQ'] as $href => $label)
                    <a href="{{ $href }}" x-on:click="mobileMenuOpen = false"
                       class="px-4 py-3 rounded-xl hover:bg-blue-600/10 hover:text-blue-600 dark:hover:text-blue-400 transition-colors flex items-center justify-between">
                        <span>{{ $label }}</span>
                        <i data-lucide="chevron-right" class="size-3.5 opacity-40"></i>
                    </a>
                @endforeach
                <div class="pt-2 mt-1 border-t border-slate-200 dark:border-slate-800/60 space-y-2.5">
                    <a href="{{ route('page', ['path' => 'docs']) }}" x-on:click="mobileMenuOpen = false"
                       class="w-full inline-flex items-center justify-center gap-2 h-11 rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 text-sm font-bold text-white shadow-md shadow-blue-600/30">
                        <i data-lucide="book-open" class="size-4"></i>Documentation
                    </a>
                    <a href="{{ route('dashboard') }}" x-on:click="mobileMenuOpen = false"
                       class="w-full inline-flex items-center justify-center gap-2 h-11 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-sm font-semibold text-slate-800 dark:text-white">
                        <i data-lucide="layout-dashboard" class="size-4 text-blue-500"></i>Dashboard
                    </a>
                </div>
            </nav>
        </div>
    </header>

    <main class="relative z-10">

        {{-- ═══════════════════════════════════════════
             HERO SECTION — Bento Grid Premium Layout
        ════════════════════════════════════════════ --}}
        <section class="relative min-h-[calc(100dvh-65px)] flex items-center py-12 lg:py-0 px-4 sm:px-6 overflow-hidden">
            <div class="mx-auto max-w-7xl w-full">

                {{-- Hero Badge --}}
                <div class="mb-6 flex justify-center lg:justify-start">
                    <a href="https://github.com/yrizzz/adminkit" target="_blank"
                       class="group inline-flex items-center gap-2.5 rounded-full border border-blue-500/30 bg-blue-600/8 dark:bg-blue-600/12 px-4 py-2 text-xs font-semibold text-blue-600 dark:text-blue-400 hover:border-blue-500/60 transition-all">
                        <span class="size-1.5 rounded-full bg-blue-500 animate-pulse"></span>
                        <span>Open Source · MIT License · Free Forever</span>
                        <i data-lucide="arrow-right" class="size-3.5 opacity-60 group-hover:translate-x-0.5 transition-transform"></i>
                    </a>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-8 items-center">

                    {{-- Left Text Column --}}
                    <div class="lg:col-span-6 space-y-6 text-center lg:text-start">

                        <h1 class="text-4xl sm:text-5xl lg:text-[3.5rem] xl:text-6xl font-black tracking-tight leading-[1.1]">
                            <span class="text-slate-900 dark:text-white">Enterprise Admin</span><br>
                            <span class="text-slate-900 dark:text-white">Panel,</span>
                            <span class="relative inline-block">
                                <span class="bg-gradient-to-r from-blue-600 via-indigo-500 to-cyan-500 dark:from-blue-400 dark:via-indigo-400 dark:to-cyan-400 bg-clip-text text-transparent"> Built Right</span>
                                <svg class="absolute -bottom-1 left-0 w-full" height="4" viewBox="0 0 200 4" preserveAspectRatio="none">
                                    <path d="M0 3 Q50 0 100 2 Q150 4 200 1" stroke="url(#ug)" stroke-width="2.5" fill="none" stroke-linecap="round"/>
                                    <defs><linearGradient id="ug" x1="0%" y1="0%" x2="100%" y2="0%"><stop offset="0%" stop-color="#2563eb"/><stop offset="50%" stop-color="#6366f1"/><stop offset="100%" stop-color="#06b6d4"/></linearGradient></defs>
                                </svg>
                            </span>
                        </h1>

                        <p class="text-slate-600 dark:text-slate-300 text-base sm:text-lg leading-relaxed max-w-xl mx-auto lg:mx-0">
                            The ultimate boilerplate powered by <strong class="text-slate-900 dark:text-white font-semibold">Laravel 13 &amp; Livewire 4</strong>. Ships with 13 dashboard templates, 40+ Blade components, live theme customizer, and SPA navigation — all free.
                        </p>

                        {{-- Action Buttons --}}
                        <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-3">
                            <a href="https://github.com/yrizzz/adminkit" target="_blank"
                               class="group relative h-12 w-full sm:w-auto inline-flex items-center justify-center gap-2.5 rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 px-6 text-sm font-extrabold text-white shadow-lg shadow-blue-600/30 hover:from-blue-500 hover:to-indigo-500 hover:scale-[1.02] active:scale-[0.98] transition-all overflow-hidden">
                                <span class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent translate-x-[-100%] group-hover:translate-x-[100%] transition-transform duration-700"></span>
                                <i data-lucide="star" class="size-4 fill-white relative z-10"></i>
                                <span class="relative z-10">Star on GitHub</span>
                                <span class="relative z-10 rounded-md bg-white/25 px-1.5 py-0.5 text-[10px] font-mono">3.2k</span>
                            </a>
                            <a href="{{ route('dashboard') }}"
                               class="h-12 w-full sm:w-auto inline-flex items-center justify-center gap-2.5 rounded-xl border border-slate-200 dark:border-slate-700/90 bg-white dark:bg-slate-800/80 px-6 text-sm font-semibold text-slate-700 dark:text-slate-200 hover:border-blue-500/50 hover:text-blue-600 dark:hover:text-blue-400 transition-all shadow-sm backdrop-blur">
                                <i data-lucide="layout-dashboard" class="size-4 text-blue-500 dark:text-blue-400"></i>
                                Live Preview
                            </a>
                        </div>

                        {{-- Social Proof --}}
                        <div class="flex items-center justify-center lg:justify-start gap-4 pt-1 text-xs text-slate-500 dark:text-slate-400">
                            <div class="flex items-center gap-2.5">
                                <div class="flex -space-x-2">
                                    @foreach (['YZ' => 'bg-blue-600', 'AK' => 'bg-indigo-600', 'LV' => 'bg-cyan-600', 'MK' => 'bg-violet-600'] as $initials => $color)
                                        <span class="flex size-7 items-center justify-center rounded-full ring-2 ring-white dark:ring-[#05080F] {{ $color }} text-white text-[9px] font-black">{{ $initials }}</span>
                                    @endforeach
                                </div>
                                <span class="font-medium text-slate-600 dark:text-slate-300">Trusted by 1,200+ devs</span>
                            </div>
                            <span class="text-slate-300 dark:text-slate-700">·</span>
                            <div class="flex items-center gap-1.5 text-emerald-600 dark:text-emerald-400 font-semibold">
                                <i data-lucide="check-circle" class="size-3.5"></i>
                                Laravel 13 + Livewire 4
                            </div>
                        </div>
                    </div>

                    {{-- Right Bento Hero Panel --}}
                    <div class="lg:col-span-6 relative">
                        {{-- Main Terminal Box --}}
                        <div class="rounded-2xl border border-blue-500/20 dark:border-blue-500/30 bg-white dark:bg-[#070B14] shadow-2xl shadow-blue-900/20 dark:shadow-blue-900/50 ring-1 ring-blue-500/10 overflow-hidden">

                            {{-- Window Bar --}}
                            <div class="flex items-center justify-between bg-slate-100 dark:bg-[#0A0F1E] px-4 py-3 border-b border-slate-200/80 dark:border-slate-800/80">
                                <div class="flex items-center gap-2">
                                    <span class="size-3 rounded-full bg-red-400/80"></span>
                                    <span class="size-3 rounded-full bg-amber-400/80"></span>
                                    <span class="size-3 rounded-full bg-emerald-400/80"></span>
                                    <span class="ms-2 text-[11px] font-mono text-slate-500 dark:text-slate-400">adminkit-cli — zsh</span>
                                </div>
                                <div class="flex items-center gap-1 bg-slate-200 dark:bg-slate-800 rounded-lg p-1">
                                    @foreach (['composer' => 'Composer', 'git' => 'Git Clone', 'artisan' => 'Artisan'] as $tab => $label)
                                        <button type="button" @click="activeTab = '{{ $tab }}'"
                                            :class="activeTab === '{{ $tab }}' ? 'bg-white dark:bg-blue-600 text-slate-900 dark:text-white shadow-sm' : 'text-slate-500 dark:text-slate-400 hover:text-slate-700 dark:hover:text-slate-200'"
                                            class="px-2.5 py-1 rounded-md text-[10px] font-semibold transition-all">
                                            {{ $label }}
                                        </button>
                                    @endforeach
                                </div>
                            </div>

                            {{-- Terminal Body --}}
                            <div class="bg-[#060A14] dark:bg-[#04070F] p-5 font-mono text-[12px] min-h-[200px] relative">
                                {{-- Composer Tab --}}
                                <div x-show="activeTab === 'composer'" class="space-y-2 text-slate-300 leading-relaxed">
                                    <div class="flex items-center gap-2 mb-3 pb-2 border-b border-slate-800">
                                        <span class="size-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                                        <span class="text-slate-400 text-[10px]">Install AdminKit via Composer</span>
                                        <button @click="copyCommand('composer create-project yrizzz/adminkit my-app\ncd my-app && php artisan dev', 'c1')"
                                            class="ms-auto px-2 py-0.5 rounded bg-slate-700 hover:bg-blue-600 text-[10px] text-slate-300 hover:text-white transition-colors">
                                            <span x-text="copiedSnippet === 'c1' ? 'Copied! ✓' : 'Copy'"></span>
                                        </button>
                                    </div>
                                    <div><span class="text-slate-500"># Create project</span></div>
                                    <div><span class="text-blue-400">$</span> composer create-project <span class="text-emerald-400">yrizzz/adminkit</span> my-app</div>
                                    <div class="mt-2"><span class="text-slate-500"># Boot dev server</span></div>
                                    <div><span class="text-blue-400">$</span> cd my-app && <span class="text-purple-400">php artisan</span> dev</div>
                                    <div class="mt-2 text-emerald-400 text-[10px]">✓ Server started on http://localhost:8000</div>
                                </div>

                                {{-- Git Tab --}}
                                <div x-show="activeTab === 'git'" x-cloak class="space-y-2 text-slate-300 leading-relaxed">
                                    <div class="flex items-center gap-2 mb-3 pb-2 border-b border-slate-800">
                                        <span class="size-1.5 rounded-full bg-blue-400 animate-pulse"></span>
                                        <span class="text-slate-400 text-[10px]">Clone from GitHub</span>
                                        <button @click="copyCommand('git clone https://github.com/yrizzz/adminkit.git\ncd adminkit && composer install && npm install', 'c2')"
                                            class="ms-auto px-2 py-0.5 rounded bg-slate-700 hover:bg-blue-600 text-[10px] text-slate-300 hover:text-white transition-colors">
                                            <span x-text="copiedSnippet === 'c2' ? 'Copied! ✓' : 'Copy'"></span>
                                        </button>
                                    </div>
                                    <div><span class="text-slate-500"># Clone repository</span></div>
                                    <div><span class="text-blue-400">$</span> git clone <span class="text-cyan-400">https://github.com/yrizzz/adminkit.git</span></div>
                                    <div class="mt-2"><span class="text-slate-500"># Install deps</span></div>
                                    <div><span class="text-blue-400">$</span> cd adminkit && <span class="text-emerald-400">composer install</span> && <span class="text-emerald-400">npm install</span></div>
                                    <div class="mt-2 text-emerald-400 text-[10px]">✓ Dependencies installed successfully</div>
                                </div>

                                {{-- Artisan Tab --}}
                                <div x-show="activeTab === 'artisan'" x-cloak class="space-y-2 text-slate-300 leading-relaxed">
                                    <div class="flex items-center gap-2 mb-3 pb-2 border-b border-slate-800">
                                        <span class="size-1.5 rounded-full bg-purple-400 animate-pulse"></span>
                                        <span class="text-slate-400 text-[10px]">Setup Environment</span>
                                        <button @click="copyCommand('cp .env.example .env\nphp artisan key:generate\nphp artisan migrate --seed\nphp artisan dev', 'c3')"
                                            class="ms-auto px-2 py-0.5 rounded bg-slate-700 hover:bg-blue-600 text-[10px] text-slate-300 hover:text-white transition-colors">
                                            <span x-text="copiedSnippet === 'c3' ? 'Copied! ✓' : 'Copy'"></span>
                                        </button>
                                    </div>
                                    <div><span class="text-blue-400">$</span> cp .env.example .env</div>
                                    <div><span class="text-blue-400">$</span> <span class="text-purple-400">php artisan</span> key:generate</div>
                                    <div><span class="text-blue-400">$</span> <span class="text-purple-400">php artisan</span> migrate --seed</div>
                                    <div><span class="text-blue-400">$</span> <span class="text-purple-400">php artisan</span> dev</div>
                                    <div class="mt-2 text-emerald-400 text-[10px]">✓ Application ready — 129 pages generated</div>
                                </div>
                            </div>
                        </div>

                        {{-- Mini Stat Cards Row --}}
                        <div class="grid grid-cols-3 gap-3 mt-4">
                            @foreach ([
                                ['3.2k+', 'GitHub Stars', 'star', 'text-amber-500'],
                                ['129', 'HTML Pages', 'file-code', 'text-blue-500'],
                                ['40+', 'UI Components', 'cpu', 'text-indigo-500'],
                            ] as [$num, $label, $ico, $color])
                                <div class="rounded-xl border border-slate-200 dark:border-slate-800/80 bg-white dark:bg-slate-900/60 p-3.5 text-center shadow-sm backdrop-blur">
                                    <div class="flex justify-center mb-1.5">
                                        <i data-lucide="{{ $ico }}" class="size-4 {{ $color }}"></i>
                                    </div>
                                    <div class="text-xl font-black text-slate-900 dark:text-white leading-none">{{ $num }}</div>
                                    <div class="text-[10px] text-slate-500 dark:text-slate-400 mt-1 font-medium">{{ $label }}</div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- ═══════════════════════════════════════════
             MARQUEE TECH BADGE STRIP
        ════════════════════════════════════════════ --}}
        <div class="relative overflow-hidden border-y border-slate-200 dark:border-slate-800/60 bg-white/60 dark:bg-slate-900/40 backdrop-blur py-4">
            <div class="flex gap-12 items-center animate-[marquee_25s_linear_infinite] whitespace-nowrap">
                @foreach ([
                    ['Laravel 13', 'flame', 'text-red-500'],
                    ['Livewire 4', 'zap', 'text-blue-500'],
                    ['Tailwind CSS v4', 'wind', 'text-cyan-500'],
                    ['Alpine.js 3', 'layers', 'text-teal-500'],
                    ['Chart.js', 'bar-chart-2', 'text-purple-500'],
                    ['Lucide Icons', 'aperture', 'text-indigo-500'],
                    ['Vite 8', 'rocket', 'text-amber-500'],
                    ['PHP 8.3+', 'code-2', 'text-violet-500'],
                    ['MIT License', 'shield-check', 'text-emerald-500'],
                    ['SPA Navigate', 'mouse-pointer-click', 'text-blue-500'],
                ] as $t)
                    <span class="inline-flex items-center gap-2 text-sm font-semibold text-slate-600 dark:text-slate-300">
                        <i data-lucide="{{ $t[1] }}" class="size-4 {{ $t[2] }}"></i>
                        {{ $t[0] }}
                    </span>
                @endforeach
                {{-- Duplicate for seamless loop --}}
                @foreach ([
                    ['Laravel 13', 'flame', 'text-red-500'],
                    ['Livewire 4', 'zap', 'text-blue-500'],
                    ['Tailwind CSS v4', 'wind', 'text-cyan-500'],
                    ['Alpine.js 3', 'layers', 'text-teal-500'],
                    ['Chart.js', 'bar-chart-2', 'text-purple-500'],
                    ['Lucide Icons', 'aperture', 'text-indigo-500'],
                    ['Vite 8', 'rocket', 'text-amber-500'],
                    ['PHP 8.3+', 'code-2', 'text-violet-500'],
                    ['MIT License', 'shield-check', 'text-emerald-500'],
                    ['SPA Navigate', 'mouse-pointer-click', 'text-blue-500'],
                ] as $t)
                    <span class="inline-flex items-center gap-2 text-sm font-semibold text-slate-600 dark:text-slate-300">
                        <i data-lucide="{{ $t[1] }}" class="size-4 {{ $t[2] }}"></i>
                        {{ $t[0] }}
                    </span>
                @endforeach
            </div>
            <div class="absolute inset-y-0 left-0 w-24 bg-gradient-to-r from-white dark:from-[#05080F] to-transparent z-10 pointer-events-none"></div>
            <div class="absolute inset-y-0 right-0 w-24 bg-gradient-to-l from-white dark:from-[#05080F] to-transparent z-10 pointer-events-none"></div>
        </div>

        {{-- ═══════════════════════════════════════════
             FEATURES SECTION — Modern Bento Grid
        ════════════════════════════════════════════ --}}
        <section id="features" class="py-16 lg:py-28 px-4 sm:px-6 max-w-7xl mx-auto">
            <div class="text-center max-w-3xl mx-auto mb-14 space-y-4">
                <span class="inline-block rounded-full bg-blue-600/15 border border-blue-500/30 px-4 py-1.5 text-xs font-extrabold text-blue-600 dark:text-blue-400 uppercase tracking-wider">Key Features</span>
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-black text-slate-900 dark:text-white tracking-tight">Built for Developers,<br><span class="text-blue-600 dark:text-blue-400">Loved by Teams</span></h2>
                <p class="text-slate-600 dark:text-slate-300 text-base leading-relaxed">Everything you need to ship fast, scalable admin dashboards without starting from scratch.</p>
            </div>

            {{-- Bento Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">

                {{-- Large Feature Card --}}
                <div class="lg:col-span-2 rounded-3xl border border-slate-200 dark:border-slate-800/70 bg-white dark:bg-slate-900/60 p-7 sm:p-8 space-y-4 hover:border-blue-500/40 hover:shadow-xl hover:shadow-blue-600/8 hover:-translate-y-1 transition-all duration-300 group overflow-hidden relative">
                    <div class="absolute -right-16 -top-16 size-52 bg-blue-600/5 dark:bg-blue-600/8 rounded-full blur-2xl group-hover:bg-blue-600/10 transition-all"></div>
                    <div class="size-12 rounded-2xl bg-gradient-to-br from-blue-500 to-indigo-600 text-white grid place-items-center shadow-lg shadow-blue-600/30">
                        <i data-lucide="palette" class="size-6"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 dark:text-white">Live Theme Customizer</h3>
                    <p class="text-slate-600 dark:text-slate-300 text-sm leading-relaxed">Real-time sidebar colors, navbar themes, HSL accent presets, dark/light toggle, gradient builder, and curved layout mode — all without page refresh.</p>
                    <div class="flex flex-wrap gap-2 pt-2">
                        @foreach (['Dark Mode', 'Light Mode', 'Curved Layout', 'Gradient Sidebar', '7 Accents', 'RTL Support'] as $badge)
                            <span class="rounded-full bg-blue-600/10 dark:bg-blue-600/15 border border-blue-500/25 px-3 py-1 text-[11px] font-semibold text-blue-600 dark:text-blue-400">{{ $badge }}</span>
                        @endforeach
                    </div>
                </div>

                <div class="rounded-3xl border border-slate-200 dark:border-slate-800/70 bg-white dark:bg-slate-900/60 p-7 space-y-4 hover:border-blue-500/40 hover:shadow-xl hover:shadow-blue-600/8 hover:-translate-y-1 transition-all duration-300 group overflow-hidden relative">
                    <div class="absolute -right-10 -bottom-10 size-36 bg-indigo-600/5 dark:bg-indigo-600/8 rounded-full blur-2xl"></div>
                    <div class="size-12 rounded-2xl bg-gradient-to-br from-indigo-500 to-purple-600 text-white grid place-items-center shadow-lg shadow-indigo-600/30">
                        <i data-lucide="layout-dashboard" class="size-6"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 dark:text-white">13 Dashboard Variants</h3>
                    <p class="text-slate-600 dark:text-slate-300 text-sm leading-relaxed">Sales, CRM, Analytics, Ecommerce, HRM, Jobs, NFT, Crypto, Projects, Timeline, and more — all production-ready.</p>
                </div>

                <div class="rounded-3xl border border-slate-200 dark:border-slate-800/70 bg-white dark:bg-slate-900/60 p-7 space-y-4 hover:border-blue-500/40 hover:shadow-xl hover:shadow-blue-600/8 hover:-translate-y-1 transition-all duration-300 group overflow-hidden relative">
                    <div class="size-12 rounded-2xl bg-gradient-to-br from-cyan-500 to-blue-600 text-white grid place-items-center shadow-lg shadow-cyan-600/30">
                        <i data-lucide="zap" class="size-6"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 dark:text-white">SPA Wire Navigation</h3>
                    <p class="text-slate-600 dark:text-slate-300 text-sm leading-relaxed">Zero page reload transitions powered by Livewire wire:navigate with smooth view-transition animations.</p>
                </div>

                <div class="rounded-3xl border border-slate-200 dark:border-slate-800/70 bg-white dark:bg-slate-900/60 p-7 space-y-4 hover:border-blue-500/40 hover:shadow-xl hover:shadow-blue-600/8 hover:-translate-y-1 transition-all duration-300 group overflow-hidden relative">
                    <div class="size-12 rounded-2xl bg-gradient-to-br from-emerald-500 to-teal-600 text-white grid place-items-center shadow-lg shadow-emerald-600/30">
                        <i data-lucide="cpu" class="size-6"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 dark:text-white">40+ Blade Components</h3>
                    <p class="text-slate-600 dark:text-slate-300 text-sm leading-relaxed">Cards, modals, tables, forms, charts, alerts, badges, buttons — reusable UI atoms with full slot support.</p>
                </div>

                <div class="lg:col-span-2 rounded-3xl border border-slate-200 dark:border-slate-800/70 bg-white dark:bg-slate-900/60 p-7 sm:p-8 space-y-4 hover:border-blue-500/40 hover:shadow-xl hover:shadow-blue-600/8 hover:-translate-y-1 transition-all duration-300 group overflow-hidden relative">
                    <div class="absolute -left-12 -bottom-12 size-48 bg-violet-600/5 dark:bg-violet-600/8 rounded-full blur-2xl"></div>
                    <div class="size-12 rounded-2xl bg-gradient-to-br from-violet-500 to-purple-600 text-white grid place-items-center shadow-lg shadow-violet-600/30">
                        <i data-lucide="code-2" class="size-6"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 dark:text-white">Static HTML Export — 129 Pages</h3>
                    <p class="text-slate-600 dark:text-slate-300 text-sm leading-relaxed">Run one command and get 129 fully-rendered static HTML files ready to deploy on any CDN, GitHub Pages, or Netlify. No server required.</p>
                    <div class="rounded-xl bg-slate-900 dark:bg-[#04070F] p-3.5 font-mono text-xs text-slate-300 border border-slate-800">
                        <span class="text-blue-400">$</span> php scripts/export-html.php<br>
                        <span class="text-emerald-400">✓ Successfully generated 129 static HTML pages in dist/</span>
                    </div>
                </div>

                <div class="rounded-3xl border border-slate-200 dark:border-slate-800/70 bg-white dark:bg-slate-900/60 p-7 space-y-4 hover:border-blue-500/40 hover:shadow-xl hover:shadow-blue-600/8 hover:-translate-y-1 transition-all duration-300 group">
                    <div class="size-12 rounded-2xl bg-gradient-to-br from-rose-500 to-pink-600 text-white grid place-items-center shadow-lg shadow-rose-600/30">
                        <i data-lucide="shield-check" class="size-6"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 dark:text-white">MIT Open Source</h3>
                    <p class="text-slate-600 dark:text-slate-300 text-sm leading-relaxed">100% free forever. Use it in personal and commercial projects with no licensing fees or royalties.</p>
                </div>
            </div>
        </section>

        {{-- ═══════════════════════════════════════════
             PREVIEW / SHOWCASE SECTION
        ════════════════════════════════════════════ --}}
        <section id="showcase" class="py-16 lg:py-28 px-4 sm:px-6 max-w-7xl mx-auto">
            <div class="text-center max-w-3xl mx-auto mb-14 space-y-4">
                <span class="inline-block rounded-full bg-blue-600/15 border border-blue-500/30 px-4 py-1.5 text-xs font-extrabold text-blue-600 dark:text-blue-400 uppercase tracking-wider">Preview Demos</span>
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-black text-slate-900 dark:text-white tracking-tight">Explore AdminKit<br>Inside &amp; Out</h2>
                <p class="text-slate-600 dark:text-slate-300 text-base leading-relaxed">Browse through the collection of pages, components, and themes available in AdminKit.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                @foreach ([
                    ['Dashboard Overview', 'Main analytics dashboard with real-time widgets, charts, and KPI metrics.', 'layout-dashboard', 'from-blue-500 to-indigo-600', 'bg-blue-600/10', route('dashboard')],
                    ['UI Components', '40+ production-ready Blade components including modals, forms, tables, and more.', 'cpu', 'from-violet-500 to-purple-600', 'bg-violet-600/10', route('ui.elements')],
                    ['Authentication', 'Beautiful auth pages: Login, Register, Reset Password, Lock Screen, 2FA and more.', 'lock-keyhole', 'from-emerald-500 to-teal-600', 'bg-emerald-600/10', route('page', ['path' => 'sign-in'])],
                    ['Documentation', 'Full architecture guide, component API reference, quickstart, and live playground.', 'book-open', 'from-rose-500 to-pink-600', 'bg-rose-600/10', route('page', ['path' => 'docs'])],
                ] as [$title, $desc, $ico, $grad, $bg, $href])
                    <a href="{{ $href }}"
                       class="group rounded-2xl border border-slate-200 dark:border-slate-800/70 bg-white dark:bg-slate-900/60 p-5 space-y-4 hover:border-blue-500/40 hover:shadow-xl hover:shadow-blue-600/8 hover:-translate-y-1.5 transition-all duration-300 block">
                        <div class="rounded-xl {{ $bg }} dark:bg-opacity-20 p-6 flex items-center justify-center group-hover:scale-105 transition-transform">
                            <div class="size-10 rounded-xl bg-gradient-to-br {{ $grad }} text-white grid place-items-center shadow-lg">
                                <i data-lucide="{{ $ico }}" class="size-5"></i>
                            </div>
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-900 dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">{{ $title }}</h4>
                            <p class="text-xs text-slate-600 dark:text-slate-300 mt-1.5 leading-relaxed">{{ $desc }}</p>
                        </div>
                        <div class="inline-flex items-center gap-1.5 text-xs font-semibold text-blue-600 dark:text-blue-400 group-hover:gap-2.5 transition-all">
                            View Demo <i data-lucide="arrow-right" class="size-3"></i>
                        </div>
                    </a>
                @endforeach
            </div>

            {{-- Stats Row --}}
            <div class="mt-10 grid grid-cols-2 sm:grid-cols-4 gap-5">
                @foreach ([
                    ['13', 'Dashboard Templates', 'text-blue-600 dark:text-blue-400'],
                    ['129', 'Static HTML Pages', 'text-indigo-600 dark:text-indigo-400'],
                    ['40+', 'Blade Components', 'text-violet-600 dark:text-violet-400'],
                    ['100%', 'Responsive & Free', 'text-emerald-600 dark:text-emerald-400'],
                ] as [$num, $label, $color])
                    <div class="rounded-2xl border border-slate-200 dark:border-slate-800/70 bg-white dark:bg-slate-900/60 p-6 text-center shadow-sm">
                        <div class="text-4xl font-black {{ $color }}">{{ $num }}</div>
                        <div class="text-sm text-slate-500 dark:text-slate-400 mt-1.5 font-medium">{{ $label }}</div>
                    </div>
                @endforeach
            </div>
        </section>

        {{-- ═══════════════════════════════════════════
             TECH STACK SECTION
        ════════════════════════════════════════════ --}}
        <section id="tech" class="py-16 lg:py-28 px-4 sm:px-6 bg-slate-100/60 dark:bg-slate-900/30">
            <div class="max-w-7xl mx-auto">
                <div class="text-center max-w-3xl mx-auto mb-14 space-y-4">
                    <span class="inline-block rounded-full bg-blue-600/15 border border-blue-500/30 px-4 py-1.5 text-xs font-extrabold text-blue-600 dark:text-blue-400 uppercase tracking-wider">Tech Stack</span>
                    <h2 class="text-3xl sm:text-4xl lg:text-5xl font-black text-slate-900 dark:text-white tracking-tight">Cutting-Edge Stack,<br>Enterprise-Grade</h2>
                    <p class="text-slate-600 dark:text-slate-300 text-base leading-relaxed">Powered by the best modern PHP ecosystem tools.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                    @foreach ([
                        ['Laravel 13', 'The world\'s most elegant PHP framework — expressive syntax, robust features, zero friction.', 'flame', 'from-red-500 to-orange-500', 'v13.x', 'Production Ready'],
                        ['Livewire 4', 'Full-stack reactive Blade components with wire:navigate SPA routing and real-time updates.', 'zap', 'from-blue-500 to-cyan-500', 'v4.x', 'SPA Built-in'],
                        ['Tailwind CSS v4', 'Utility-first CSS framework with HSL design tokens, custom properties, and CSS layers.', 'wind', 'from-cyan-500 to-teal-500', 'v4.0', 'Zero Config'],
                        ['Alpine.js 3', 'Lightweight reactive JavaScript layer for interactive UI without heavy frameworks.', 'layers', 'from-teal-500 to-emerald-500', 'v3.x', 'Lightweight'],
                        ['Chart.js', 'Beautiful responsive charts — line, bar, doughnut, radar with dynamic theme sync.', 'bar-chart-2', 'from-violet-500 to-purple-500', 'Latest', 'Dark Mode Sync'],
                        ['Vite 8', 'Lightning fast build tool with HMR, instant dev server, and optimized production bundles.', 'rocket', 'from-amber-500 to-yellow-500', 'v8.x', 'Sub 2s Build'],
                    ] as [$name, $desc, $ico, $grad, $version, $badge])
                        <div class="rounded-2xl border border-slate-200 dark:border-slate-800/70 bg-white dark:bg-slate-900/60 p-6 space-y-4 hover:border-blue-500/40 hover:shadow-lg hover:-translate-y-1 transition-all duration-300 group">
                            <div class="flex items-center justify-between">
                                <div class="size-11 rounded-xl bg-gradient-to-br {{ $grad }} text-white grid place-items-center shadow-md group-hover:scale-105 transition-transform">
                                    <i data-lucide="{{ $ico }}" class="size-5"></i>
                                </div>
                                <div class="text-right">
                                    <div class="text-[10px] font-mono font-bold text-blue-600 dark:text-blue-400 bg-blue-600/10 dark:bg-blue-600/15 rounded-full px-2.5 py-1">{{ $version }}</div>
                                </div>
                            </div>
                            <div>
                                <h3 class="font-bold text-slate-900 dark:text-white">{{ $name }}</h3>
                                <p class="text-xs text-slate-600 dark:text-slate-300 mt-1.5 leading-relaxed">{{ $desc }}</p>
                            </div>
                            <span class="inline-block rounded-full bg-emerald-600/10 dark:bg-emerald-600/15 border border-emerald-500/25 px-2.5 py-1 text-[10px] font-semibold text-emerald-600 dark:text-emerald-400">{{ $badge }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- ═══════════════════════════════════════════
             QUICKSTART SECTION
        ════════════════════════════════════════════ --}}
        <section id="quickstart" class="py-16 lg:py-28 px-4 sm:px-6 max-w-7xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center">
                <div class="space-y-6">
                    <span class="inline-block rounded-full bg-blue-600/15 border border-blue-500/30 px-4 py-1.5 text-xs font-extrabold text-blue-600 dark:text-blue-400 uppercase tracking-wider">Quickstart</span>
                    <h2 class="text-3xl sm:text-4xl lg:text-5xl font-black text-slate-900 dark:text-white tracking-tight">Up and Running<br>in <span class="text-blue-600 dark:text-blue-400">3 Minutes</span></h2>
                    <p class="text-slate-600 dark:text-slate-300 text-base leading-relaxed">Get your admin dashboard live with a single command. AdminKit takes care of the boilerplate so you can focus on your product.</p>

                    <div class="space-y-4">
                        @foreach ([
                            ['1', 'Clone or Install', 'git clone or composer create-project to bootstrap the project.', 'download-cloud'],
                            ['2', 'Configure Environment', 'Copy .env.example, generate app key, and set your database.', 'settings'],
                            ['3', 'Launch Dev Server', 'Run php artisan dev to start Vite + Laravel simultaneously.', 'rocket'],
                        ] as [$step, $title, $desc, $ico])
                            <div class="flex items-start gap-4">
                                <span class="flex size-10 shrink-0 items-center justify-center rounded-xl bg-blue-600 text-white text-sm font-black shadow-md shadow-blue-600/30">{{ $step }}</span>
                                <div>
                                    <h4 class="font-bold text-slate-900 dark:text-white flex items-center gap-2">
                                        <i data-lucide="{{ $ico }}" class="size-3.5 text-blue-500"></i>
                                        {{ $title }}
                                    </h4>
                                    <p class="text-sm text-slate-600 dark:text-slate-300 mt-0.5">{{ $desc }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <a href="{{ route('page', ['path' => 'docs']) }}"
                       class="inline-flex items-center gap-2 text-sm font-semibold text-blue-600 dark:text-blue-400 hover:gap-3 transition-all">
                        Full Documentation <i data-lucide="arrow-right" class="size-4"></i>
                    </a>
                </div>

                {{-- Code Block --}}
                <div class="rounded-2xl border border-slate-200 dark:border-slate-800/80 bg-white dark:bg-slate-900/60 overflow-hidden shadow-xl">
                    <div class="flex items-center justify-between px-4 py-3 bg-slate-100 dark:bg-slate-800/80 border-b border-slate-200 dark:border-slate-700/60">
                        <div class="flex items-center gap-1.5">
                            <span class="size-2.5 rounded-full bg-red-400/80"></span>
                            <span class="size-2.5 rounded-full bg-amber-400/80"></span>
                            <span class="size-2.5 rounded-full bg-emerald-400/80"></span>
                        </div>
                        <span class="text-[11px] font-mono text-slate-500 dark:text-slate-400">install.sh</span>
                        <button @click="copyCommand('git clone https://github.com/yrizzz/adminkit.git\ncd adminkit\ncomposer install && npm install\ncp .env.example .env && php artisan key:generate\nphp artisan dev', 'qs')"
                            class="text-[11px] px-2.5 py-1 rounded-lg bg-blue-600 text-white hover:bg-blue-500 transition-colors font-semibold">
                            <span x-text="copiedSnippet === 'qs' ? 'Copied! ✓' : 'Copy All'"></span>
                        </button>
                    </div>
                    <pre class="p-5 font-mono text-xs text-slate-700 dark:text-slate-300 leading-7 overflow-x-auto bg-white dark:bg-slate-900/60"><span class="text-slate-400 dark:text-slate-500"># 1. Clone repository</span>
<span class="text-blue-600 dark:text-blue-400">git clone</span> https://github.com/yrizzz/adminkit.git
<span class="text-blue-600 dark:text-blue-400">cd</span> adminkit

<span class="text-slate-400 dark:text-slate-500"># 2. Install dependencies</span>
<span class="text-emerald-600 dark:text-emerald-400">composer install</span> && npm install

<span class="text-slate-400 dark:text-slate-500"># 3. Configure environment</span>
<span class="text-blue-600 dark:text-blue-400">cp</span> .env.example .env
<span class="text-purple-600 dark:text-purple-400">php artisan</span> key:generate

<span class="text-slate-400 dark:text-slate-500"># 4. Launch dev server</span>
<span class="text-purple-600 dark:text-purple-400">php artisan</span> dev

<span class="text-emerald-600 dark:text-emerald-400">✓ Ready at http://localhost:8000</span></pre>
                </div>
            </div>
        </section>

        {{-- ═══════════════════════════════════════════
             FAQ SECTION
        ════════════════════════════════════════════ --}}
        <section id="faq" class="py-16 lg:py-28 px-4 sm:px-6 bg-slate-100/60 dark:bg-slate-900/30">
            <div class="max-w-4xl mx-auto">
                <div class="text-center mb-14 space-y-4">
                    <span class="inline-block rounded-full bg-blue-600/15 border border-blue-500/30 px-4 py-1.5 text-xs font-extrabold text-blue-600 dark:text-blue-400 uppercase tracking-wider">FAQ</span>
                    <h2 class="text-3xl sm:text-4xl lg:text-5xl font-black text-slate-900 dark:text-white tracking-tight">Frequently Asked<br>Questions</h2>
                    <p class="text-slate-600 dark:text-slate-300 text-base">Everything you need to know about using and licensing AdminKit.</p>
                </div>

                <div class="space-y-3">
                    @foreach ([
                        [1, 'Is AdminKit completely free to use?', 'Yes! AdminKit is released as 100% Open Source under the MIT License. You can use it freely for personal, commercial, or client projects without any licensing fees or royalties.'],
                        [2, 'Which Laravel & Livewire versions are supported?', 'AdminKit is built natively for <strong>Laravel 13</strong> and <strong>Livewire 4</strong>, powered by <strong>Tailwind CSS v4</strong> with Alpine.js 3 and automatic SPA wire-navigation.'],
                        [3, 'Does it support Dark Mode and Custom Themes?', 'Absolutely! AdminKit ships with a Live Theme Customizer — real-time dark/light toggle, HSL accent presets, gradient sidebar builder, curved layout mode, and RTL direction support.'],
                        [4, 'Can I export it as static HTML?', 'Yes! Run <code class="bg-slate-200 dark:bg-slate-800 px-1.5 py-0.5 rounded text-sm font-mono">php scripts/export-html.php</code> to generate 129 fully rendered static HTML pages in the <code class="bg-slate-200 dark:bg-slate-800 px-1.5 py-0.5 rounded text-sm font-mono">dist/</code> folder — no server required for deployment.'],
                        [5, 'How do I contribute to AdminKit?', 'Fork the GitHub repository, create a feature branch, make your improvements, and open a pull request. Check the Issues page for good first-issue tasks to tackle.'],
                    ] as [$id, $q, $a])
                        <div class="rounded-2xl border border-slate-200 dark:border-slate-800/70 bg-white dark:bg-slate-900/70 overflow-hidden shadow-sm hover:border-blue-500/40 transition-colors">
                            <button type="button" @click="activeFaq = activeFaq === {{ $id }} ? null : {{ $id }}"
                                    class="w-full p-5 text-start font-bold text-base text-slate-900 dark:text-white flex items-center justify-between gap-4 hover:bg-slate-50 dark:hover:bg-slate-800/40 transition-colors">
                                <span>{{ $q }}</span>
                                <span :class="activeFaq === {{ $id }} ? 'rotate-45 text-blue-500' : 'text-slate-400'" class="shrink-0 transition-all duration-200">
                                    <i data-lucide="plus" class="size-5"></i>
                                </span>
                            </button>
                            <div x-show="activeFaq === {{ $id }}" x-cloak
                                 x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-1" x-transition:enter-end="opacity-100 translate-y-0"
                                 class="px-5 pb-5 text-sm text-slate-600 dark:text-slate-300 leading-relaxed border-t border-slate-200 dark:border-slate-800/60 pt-4">
                                {!! $a !!}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- ═══════════════════════════════════════════
             CTA BANNER
        ════════════════════════════════════════════ --}}
        <section class="py-16 lg:py-24 px-4 sm:px-6 max-w-7xl mx-auto">
            <div class="relative rounded-3xl bg-gradient-to-br from-blue-700 via-blue-600 to-indigo-700 p-10 sm:p-16 shadow-2xl shadow-blue-700/30 overflow-hidden text-center">
                <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top_left,rgba(255,255,255,0.15),transparent_60%)]"></div>
                <div class="absolute -right-16 -bottom-16 size-80 bg-white/5 rounded-full blur-3xl"></div>
                <div class="absolute -left-16 -top-16 size-60 bg-white/5 rounded-full blur-3xl"></div>

                <div class="relative z-10 space-y-6 max-w-3xl mx-auto">
                    <div class="inline-flex items-center gap-2 rounded-full bg-white/15 border border-white/25 px-4 py-2 text-xs font-bold text-white">
                        <span class="size-2 rounded-full bg-white animate-pulse"></span>
                        Open Source · Free Forever
                    </div>
                    <h2 class="text-3xl sm:text-5xl font-black text-white tracking-tight">
                        Ready to Build Your<br>Next Project?
                    </h2>
                    <p class="text-blue-100 text-base max-w-xl mx-auto">
                        AdminKit is completely open-source and free to use. Star the repository to support the project and stay updated with the latest releases.
                    </p>
                    <div class="flex flex-col sm:flex-row items-center justify-center gap-3.5 pt-2">
                        <a href="https://github.com/yrizzz/adminkit" target="_blank"
                           class="h-13 w-full sm:w-auto inline-flex items-center justify-center gap-2.5 rounded-xl bg-white px-8 text-sm font-extrabold text-blue-700 hover:bg-slate-100 hover:scale-[1.02] active:scale-[0.98] transition-all shadow-lg">
                            <i data-lucide="star" class="size-4 fill-blue-700"></i>
                            Star on GitHub
                            <span class="rounded-md bg-blue-100 px-1.5 py-0.5 text-[11px] font-mono text-blue-800">3.2k</span>
                        </a>
                        <a href="{{ route('dashboard') }}"
                           class="h-13 w-full sm:w-auto inline-flex items-center justify-center gap-2.5 rounded-xl border border-white/30 bg-white/10 px-8 text-sm font-semibold text-white hover:bg-white/20 transition-all backdrop-blur">
                            <i data-lucide="layout-dashboard" class="size-4"></i>
                            Live Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </main>

    {{-- ═══════════════════════════════════════════
         FOOTER
    ════════════════════════════════════════════ --}}
    <footer class="bg-white dark:bg-[#06090F] border-t border-slate-200 dark:border-slate-800/70 pt-16 pb-10 px-4 sm:px-6 relative z-10">
        <div class="mx-auto max-w-7xl">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-10">

                {{-- Brand Column --}}
                <div class="lg:col-span-2 space-y-4">
                    <a href="{{ route('landing') }}" class="flex items-center gap-2.5 group w-fit">
                        <span class="grid size-9 shrink-0 place-items-center rounded-xl bg-gradient-to-br from-blue-500 to-indigo-600 text-white shadow-lg shadow-blue-600/30 transition-transform group-hover:scale-105">
                            <i data-lucide="gem" class="size-4"></i>
                        </span>
                        <span class="text-xl font-black tracking-tight text-slate-900 dark:text-white">AdminKit</span>
                    </a>
                    <p class="text-sm text-slate-600 dark:text-slate-300 leading-relaxed max-w-xs">
                        Modern enterprise admin dashboard boilerplate built with Laravel 13, Livewire 4, and Tailwind CSS v4.
                    </p>
                    <div class="inline-flex items-center gap-2 rounded-full border border-emerald-500/30 bg-emerald-600/8 dark:bg-emerald-600/12 px-3.5 py-1.5 text-xs font-semibold text-emerald-600 dark:text-emerald-400">
                        <span class="size-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                        All Systems Operational (99.99%)
                    </div>
                </div>

                <div class="space-y-4">
                    <h4 class="text-xs font-extrabold uppercase tracking-wider text-slate-900 dark:text-white">Navigation</h4>
                    <ul class="space-y-2.5 text-sm text-slate-600 dark:text-slate-300">
                        <li><a href="#features" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Features</a></li>
                        <li><a href="#showcase" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Preview</a></li>
                        <li><a href="{{ route('page', ['path' => 'docs']) }}" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Documentation</a></li>
                        <li><a href="#quickstart" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Quickstart</a></li>
                        <li><a href="#faq" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">FAQ</a></li>
                    </ul>
                </div>

                <div class="space-y-4">
                    <h4 class="text-xs font-extrabold uppercase tracking-wider text-slate-900 dark:text-white">Resources</h4>
                    <ul class="space-y-2.5 text-sm text-slate-600 dark:text-slate-300">
                        <li><a href="https://github.com/yrizzz/adminkit" target="_blank" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">GitHub Repository</a></li>
                        <li><a href="https://github.com/yrizzz/adminkit/issues" target="_blank" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Issue Tracker</a></li>
                        <li><a href="https://github.com/yrizzz/adminkit/discussions" target="_blank" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Discussions</a></li>
                        <li><a href="https://github.com/yrizzz/adminkit/blob/main/LICENSE" target="_blank" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">MIT License</a></li>
                    </ul>
                </div>

                <div class="space-y-4">
                    <h4 class="text-xs font-extrabold uppercase tracking-wider text-slate-900 dark:text-white">Support</h4>
                    <p class="text-sm text-slate-600 dark:text-slate-300 leading-relaxed">Questions or ideas? Open an issue on GitHub.</p>
                    <a href="https://github.com/yrizzz/adminkit/issues" target="_blank"
                       class="inline-flex items-center gap-2 rounded-xl border border-slate-200 dark:border-slate-700/60 bg-white dark:bg-slate-800/80 px-4 py-2.5 text-xs font-bold text-slate-800 dark:text-white hover:border-blue-500/50 hover:text-blue-600 dark:hover:text-blue-400 transition-all shadow-sm">
                        <i data-lucide="github" class="size-4"></i>
                        Open GitHub Issue
                    </a>
                </div>
            </div>

            <div class="mt-12 pt-8 border-t border-slate-200 dark:border-slate-800/70 flex flex-col sm:flex-row items-center justify-between gap-4 text-sm text-slate-500 dark:text-slate-400">
                <p>&copy; {{ date('Y') }} AdminKit. Built with <span class="text-red-500">♥</span> for Laravel Developers.</p>
                <div class="flex items-center gap-5">
                    <a href="https://github.com/yrizzz/adminkit" target="_blank" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors flex items-center gap-1.5">
                        <i data-lucide="github" class="size-4"></i> GitHub
                    </a>
                    <a href="{{ route('page', ['path' => 'docs']) }}" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Docs</a>
                    <a href="{{ route('dashboard') }}" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Dashboard</a>
                </div>
            </div>
        </div>
    </footer>

    @push('scripts')
    <style>
        @keyframes marquee { from { transform: translateX(0); } to { transform: translateX(-50%); } }
    </style>
    @endpush
</div>
