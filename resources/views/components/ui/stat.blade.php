@props([
    'label'    => '',
    'value'    => '',
    'icon'     => 'activity',
    'trend'    => null,      // e.g. '+12.5%'
    'trendUp'  => true,
    'tone'     => 'primary', // primary | success | warning | info | destructive
])

@php
    $tones = [
        'primary'     => 'bg-primary/10 text-primary',
        'success'     => 'bg-success/12 text-success',
        'warning'     => 'bg-warning/15 text-[hsl(var(--warning))]',
        'info'        => 'bg-info/12 text-info',
        'destructive' => 'bg-destructive/12 text-destructive',
    ];
@endphp

<div {{ $attributes->class('ak-card p-5') }}>
    <div class="flex items-start justify-between gap-3">
        <div class="min-w-0">
            <p class="truncate text-sm font-medium text-muted-foreground">{{ $label }}</p>
            <p class="mt-2 text-2xl font-bold tracking-tight sm:text-[1.7rem]">{{ $value }}</p>
        </div>
        <div class="grid size-11 shrink-0 place-items-center rounded-xl {{ $tones[$tone] ?? $tones['primary'] }}">
            <i data-lucide="{{ $icon }}" class="size-5"></i>
        </div>
    </div>

    @if ($trend)
        <div class="mt-3 flex items-center gap-1.5 text-sm">
            <span class="inline-flex items-center gap-0.5 font-semibold {{ $trendUp ? 'text-success' : 'text-destructive' }}">
                <i data-lucide="{{ $trendUp ? 'trending-up' : 'trending-down' }}" class="size-4"></i>{{ $trend }}
            </span>
            <span class="text-muted-foreground">{{ $slot->isEmpty() ? 'vs last month' : $slot }}</span>
        </div>
    @endif
</div>
