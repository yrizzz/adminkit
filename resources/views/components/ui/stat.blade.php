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

<div {{ $attributes->class('ak-card p-3.5 sm:p-4') }} x-data="{ localTone: '{{ $tone }}' }" x-init="
    const observer = new MutationObserver((mutations) => {
        mutations.forEach((mutation) => {
            if (mutation.attributeName === 'tone') {
                localTone = $el.getAttribute('tone');
            }
        });
    });
    observer.observe($el, { attributes: true });
    localTone = $el.getAttribute('tone') || '{{ $tone }}';
">
    <div class="flex items-start justify-between gap-2">
        <div class="min-w-0 flex-1">
            <p class="truncate text-xs font-medium text-muted-foreground/90" title="{{ $label }}">{{ $label }}</p>
            <p class="mt-1.5 truncate text-lg sm:text-xl xl:text-2xl font-bold tracking-tight text-foreground">{{ $value }}</p>
        </div>
        <div :class="{
            'bg-primary/10 text-primary': localTone === 'primary',
            'bg-success/12 text-success': localTone === 'success',
            'bg-warning/15 text-[hsl(var(--warning))]': localTone === 'warning',
            'bg-info/12 text-info': localTone === 'info',
            'bg-destructive/12 text-destructive': localTone === 'destructive'
        }" class="grid size-9 shrink-0 place-items-center rounded-lg sm:rounded-xl {{ $tones[$tone] ?? $tones['primary'] }}">
            <i data-lucide="{{ $icon }}" class="size-4.5"></i>
        </div>
    </div>

    @if ($trend)
        <div class="mt-2.5 flex flex-wrap items-center gap-x-1.5 gap-y-0.5 text-xs">
            <span class="inline-flex shrink-0 items-center gap-0.5 font-semibold {{ $trendUp ? 'text-success' : 'text-destructive' }}">
                <i data-lucide="{{ $trendUp ? 'trending-up' : 'trending-down' }}" class="size-3.5"></i>{{ $trend }}
            </span>
            <span class="text-muted-foreground/80 truncate text-[11px] sm:text-xs">{{ $slot->isEmpty() ? 'vs last month' : $slot }}</span>
        </div>
    @endif
</div>
