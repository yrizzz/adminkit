@props([
    'title' => 'Authentication',
])

{{-- Standalone, full-screen layout for the Authentication screens.
     No sidebar / navbar — each page paints the whole viewport itself. --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    @include('partials.head', ['title' => $title])
</head>
<body x-data class="min-h-screen bg-background font-sans text-foreground antialiased">

    {{-- Floating controls: back to the panel, RTL and theme --}}
    <div class="fixed end-4 top-4 z-50 flex items-center gap-1">
        <a href="{{ route('dashboard') }}" wire:navigate title="Back to dashboard"
           class="grid size-9 place-items-center rounded-lg bg-card/80 text-muted-foreground shadow-sm ring-1 ring-border backdrop-blur transition-colors hover:text-foreground">
            <i data-lucide="layout-dashboard" class="size-4"></i>
        </a>
        <button type="button" @click="$store.ui.toggleDirection()" title="Toggle RTL/LTR"
                class="grid size-9 place-items-center rounded-lg bg-card/80 text-muted-foreground shadow-sm ring-1 ring-border backdrop-blur transition-colors hover:text-foreground">
            <i data-lucide="languages" class="size-4"></i>
        </button>
        <button type="button" @click="$store.ui.toggleTheme()" title="Toggle theme"
                class="grid size-9 place-items-center rounded-lg bg-card/80 text-muted-foreground shadow-sm ring-1 ring-border backdrop-blur transition-colors hover:text-foreground">
            <i data-lucide="sun" class="size-4" x-show="$store.ui.isDark" x-cloak></i>
            <i data-lucide="moon" class="size-4" x-show="!$store.ui.isDark"></i>
        </button>
    </div>

    {{ $slot }}

    <x-ui.toaster />
    @livewireScripts
    @stack('scripts')
</body>
</html>
