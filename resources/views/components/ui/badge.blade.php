@props([
    'variant' => 'default',
    'dot'     => false,
])

@php
    $variants = [
        'default'     => 'border-transparent bg-primary/10 text-primary',
        'solid'       => 'border-transparent bg-primary text-primary-foreground',
        'secondary'   => 'border-transparent bg-secondary text-secondary-foreground',
        'success'     => 'border-transparent bg-success/12 text-success',
        'warning'     => 'border-transparent bg-warning/15 text-[hsl(var(--warning))]',
        'destructive' => 'border-transparent bg-destructive/12 text-destructive',
        'info'        => 'border-transparent bg-info/12 text-info',
        'outline'     => 'border-border text-foreground',
        'muted'       => 'border-transparent bg-muted text-muted-foreground',
    ];
    $classes = 'inline-flex items-center gap-1.5 rounded-full border px-2.5 py-0.5 text-xs font-semibold transition-colors '.($variants[$variant] ?? $variants['default']);
@endphp

<span {{ $attributes->class($classes) }}>
    @if ($dot)
        <span class="size-1.5 rounded-full bg-current"></span>
    @endif
    {{ $slot }}
</span>
