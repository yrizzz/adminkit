@props([
    'code'    => '404',
    'icon'    => 'circle-alert',
    'tone'    => 'primary',   // primary | info | warning | destructive
    'title'   => '',
    'message' => '',
])

@php
    // Literal class strings so Tailwind's scanner picks them up.
    $tones = [
        'primary'     => ['badge' => 'bg-primary/10 text-primary',                         'grad' => 'from-primary to-sidebar-primary',        'glow' => 'bg-primary/15'],
        'info'        => ['badge' => 'bg-info/10 text-info',                                'grad' => 'from-info to-primary',                   'glow' => 'bg-info/15'],
        'warning'     => ['badge' => 'bg-warning/15 text-[hsl(var(--warning))]',            'grad' => 'from-[hsl(var(--warning))] to-orange-500','glow' => 'bg-warning/20'],
        'destructive' => ['badge' => 'bg-destructive/10 text-destructive',                  'grad' => 'from-destructive to-rose-500',           'glow' => 'bg-destructive/15'],
    ];
    $t = $tones[$tone] ?? $tones['primary'];
@endphp

<div class="relative grid min-h-screen place-items-center overflow-hidden px-6 py-14 text-center">
    <div class="pointer-events-none absolute -end-24 -top-24 size-80 rounded-full {{ $t['glow'] }} blur-3xl"></div>
    <div class="pointer-events-none absolute -bottom-24 -start-24 size-80 rounded-full {{ $t['glow'] }} blur-3xl"></div>

    <div class="relative mx-auto max-w-lg">
        <span class="mx-auto grid size-16 place-items-center rounded-2xl {{ $t['badge'] }}">
            <i data-lucide="{{ $icon }}" class="size-8"></i>
        </span>

        <p class="mt-6 bg-gradient-to-br {{ $t['grad'] }} bg-clip-text text-7xl font-black leading-none tracking-tighter text-transparent sm:text-8xl">
            {{ $code }}
        </p>

        <h1 class="mt-4 text-2xl font-bold tracking-tight sm:text-3xl">{{ $title }}</h1>
        <p class="mx-auto mt-3 max-w-md text-muted-foreground">{{ $message }}</p>

        {{-- per-page extras (search box, error id, status…) --}}
        @if (trim($slot) !== '')
            <div class="mt-7">{{ $slot }}</div>
        @endif

        <div class="mt-8 flex flex-wrap items-center justify-center gap-3">
            <x-ui.button variant="outline" icon="arrow-left" class="[&>svg]:rtl-flip" onclick="history.back()">Go back</x-ui.button>
            <x-ui.button icon="layout-dashboard" :href="route('dashboard')" wire:navigate>Back to dashboard</x-ui.button>
        </div>

        <p class="mt-6 text-sm text-muted-foreground">
            Think this is a mistake? <a href="#" class="font-medium text-primary hover:underline">Contact support</a>
        </p>
    </div>
</div>
