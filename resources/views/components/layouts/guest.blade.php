@props([
    'title' => 'Welcome',
])

@php($cfg = config('adminkit'))

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    @include('partials.head', ['title' => $title])
</head>
<body x-data class="min-h-screen bg-background font-sans text-foreground antialiased">
    <div class="grid min-h-screen lg:grid-cols-2">
        {{-- Brand / marketing panel --}}
        <div class="relative hidden overflow-hidden bg-sidebar text-white lg:flex lg:flex-col lg:justify-between p-12">
            <div class="pointer-events-none absolute inset-0 opacity-90"
                 style="background:
                    radial-gradient(60rem 60rem at 110% -10%, hsl(var(--primary)/0.45), transparent 60%),
                    radial-gradient(40rem 40rem at -10% 110%, hsl(var(--sidebar-primary)/0.35), transparent 60%);"></div>
            <div class="pointer-events-none absolute inset-0"
                 style="background-image: linear-gradient(hsl(0 0% 100% / .04) 1px, transparent 1px), linear-gradient(90deg, hsl(0 0% 100% / .04) 1px, transparent 1px); background-size: 42px 42px;"></div>

            <div class="relative z-10 flex items-center gap-3">
                <span class="grid size-11 place-items-center rounded-2xl bg-white/10 backdrop-blur-sm">
                    <i data-lucide="gem" class="size-6"></i>
                </span>
                <span class="text-xl font-bold tracking-tight">{{ $cfg['name'] }}</span>
            </div>

            <div class="relative z-10 max-w-md">
                <h2 class="text-4xl font-bold leading-tight">Build beautiful admin apps, faster.</h2>
                <p class="mt-4 text-white/70">A modern, themeable Laravel + Livewire admin panel — shadcn-inspired components, RTL/LTR, dark mode, and horizontal or vertical layouts out of the box.</p>
                <ul class="mt-8 space-y-3">
                    @foreach (['40+ shadcn-inspired components', 'Light / dark / system themes', 'RTL & LTR ready', 'Vertical & horizontal layouts'] as $f)
                        <li class="flex items-center gap-3 text-sm text-white/85">
                            <span class="grid size-6 place-items-center rounded-full bg-white/10"><i data-lucide="check" class="size-3.5"></i></span>{{ $f }}
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="relative z-10 text-sm text-white/50">© {{ date('Y') }} {{ $cfg['name'] }} — v{{ $cfg['version'] }}</div>
        </div>

        {{-- Form panel --}}
        <div class="relative flex flex-col items-center justify-center p-6 sm:p-10">
            <div class="absolute end-4 top-4 flex items-center gap-1">
                <button type="button" @click="$store.ui.toggleDirection()" title="Toggle RTL/LTR"
                        class="rounded-lg p-2 text-muted-foreground hover:bg-accent hover:text-foreground">
                    <i data-lucide="languages" class="size-5"></i>
                </button>
                <button type="button" @click="$store.ui.toggleTheme()" title="Toggle theme"
                        class="rounded-lg p-2 text-muted-foreground hover:bg-accent hover:text-foreground">
                    <i data-lucide="sun" class="size-5" x-show="$store.ui.isDark" x-cloak></i>
                    <i data-lucide="moon" class="size-5" x-show="!$store.ui.isDark"></i>
                </button>
            </div>

            <div class="w-full max-w-sm animate-in-up">
                <a href="{{ route('dashboard') }}" class="mb-8 flex items-center justify-center gap-2.5 lg:hidden">
                    <span class="grid size-10 place-items-center rounded-xl bg-gradient-to-br from-primary to-sidebar-primary text-white"><i data-lucide="gem" class="size-5"></i></span>
                    <span class="text-lg font-bold">{{ $cfg['name'] }}</span>
                </a>
                {{ $slot }}
            </div>
        </div>
    </div>

    <x-ui.toaster />
    @stack('scripts')
</body>
</html>
