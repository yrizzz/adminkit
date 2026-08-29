<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data x-bind:class="$store.ui.isDark ? 'dark' : ''">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'AdminKit Enterprise') }}</title>
        @fonts

        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
    </head>
    <body class="bg-background text-foreground antialiased flex flex-col min-h-screen">
        {{-- Navigation Header --}}
        <header class="w-full border-b border-border bg-card/80 backdrop-blur-md sticky top-0 z-40 px-6 py-4">
            <div class="max-w-7xl mx-auto flex items-center justify-between">
                <a href="{{ url('/') }}" class="flex items-center gap-2.5 font-bold text-lg tracking-tight">
                    <span class="grid size-9 place-items-center rounded-xl bg-primary text-primary-foreground shadow-md shadow-primary/30">
                        <i data-lucide="gem" class="size-5"></i>
                    </span>
                    <span>{{ config('adminkit.name', 'AdminKit') }}</span>
                    <span class="rounded-full bg-primary/10 px-2 py-0.5 text-[0.65rem] font-semibold text-primary">Enterprise</span>
                </a>

                <div class="flex items-center gap-3">
                    <button type="button" @click="$store.ui.toggleTheme()" class="rounded-lg p-2 text-muted-foreground hover:bg-accent hover:text-foreground">
                        <i data-lucide="moon" class="size-5 hidden dark:block"></i>
                        <i data-lucide="sun" class="size-5 block dark:hidden"></i>
                    </button>

                    @if (Route::has('login'))
                        @auth
                            <x-ui.button href="{{ route('dashboard') }}" icon="layout-dashboard">Go to Dashboard</x-ui.button>
                        @else
                            <x-ui.button href="{{ route('login') }}" variant="outline">Log in</x-ui.button>
                            @if (Route::has('register'))
                                <x-ui.button href="{{ route('register') }}" variant="primary">Get Started</x-ui.button>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </header>

        {{-- Hero Section --}}
        <main class="flex-1 flex flex-col justify-center max-w-7xl mx-auto px-6 py-16 w-full">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="space-y-6">
                    <div class="inline-flex items-center gap-2 rounded-full border border-primary/20 bg-primary/10 px-3.5 py-1 text-xs font-semibold text-primary">
                        <i data-lucide="sparkles" class="size-3.5"></i>
                        Next-Gen Admin Dashboard Architecture
                    </div>
                    <h1 class="text-4xl sm:text-5xl font-extrabold tracking-tight leading-tight">
                        Build Faster with <span class="text-primary">AdminKit Enterprise</span>
                    </h1>
                    <p class="text-base sm:text-lg text-muted-foreground leading-relaxed">
                        Production-grade Laravel 13 & Livewire 4 admin starter kit with deep obsidian dark mode, dense responsive layouts, and customizable UI design tokens.
                    </p>
                    <div class="flex flex-wrap items-center gap-4 pt-2">
                        <x-ui.button href="{{ route('dashboard') }}" variant="primary" icon="arrow-right" class="px-6 py-3 text-base">
                            Explore Dashboard
                        </x-ui.button>
                        <x-ui.button href="{{ route('pages.content.docs') }}" variant="outline" icon="book-open" class="px-6 py-3 text-base">
                            View Documentation
                        </x-ui.button>
                    </div>
                </div>

                {{-- Hero Visual Card --}}
                <div class="ak-card p-6 border border-border shadow-2xl relative overflow-hidden">
                    <div class="flex items-center justify-between border-b border-border pb-4 mb-4">
                        <div class="flex items-center gap-2">
                            <span class="size-3 rounded-full bg-rose-500"></span>
                            <span class="size-3 rounded-full bg-amber-500"></span>
                            <span class="size-3 rounded-full bg-emerald-500"></span>
                        </div>
                        <span class="text-xs font-mono text-muted-foreground">adminkit-telemetry.v2</span>
                    </div>

                    <div class="grid grid-cols-2 gap-3 mb-4">
                        <x-ui.stat label="Active Workspaces" value="1,280" icon="server" tone="primary" trend="+24.5%" :trend-up="true" />
                        <x-ui.stat label="System Uptime" value="99.99%" icon="activity" tone="success" trend="Stable" :trend-up="true" />
                    </div>

                    <div class="rounded-lg border border-border bg-muted/40 p-4 font-mono text-xs text-muted-foreground space-y-1">
                        <p><span class="text-primary">$</span> php artisan dev</p>
                        <p class="text-success">✔ Compiled Tailwind v4 & Vite assets (525ms)</p>
                        <p class="text-muted-foreground">⚡ Ready on http://localhost:8000</p>
                    </div>
                </div>
            </div>
        </main>

        {{-- Footer --}}
        @include('partials.footer')
    </body>
</html>
