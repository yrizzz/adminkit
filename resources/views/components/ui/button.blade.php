@props([
    'variant' => 'default',
    'size'    => 'default',
    'href'    => null,
    'type'    => 'button',
    'icon'    => null,
    'iconEnd' => null,
    'loading' => false,
])

@php
    $base = 'inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-lg text-sm font-medium transition-all ak-ring disabled:pointer-events-none disabled:opacity-50 [&>svg]:size-4 [&>svg]:shrink-0';

    $variants = [
        'default'     => 'bg-primary text-primary-foreground shadow-sm hover:bg-primary/90 active:scale-[.98]',
        'secondary'   => 'bg-secondary text-secondary-foreground hover:bg-secondary/70 active:scale-[.98]',
        'outline'     => 'border border-input bg-transparent hover:bg-accent hover:text-accent-foreground active:scale-[.98]',
        'ghost'       => 'hover:bg-accent hover:text-accent-foreground',
        'link'        => 'text-primary underline-offset-4 hover:underline',
        'destructive' => 'bg-destructive text-destructive-foreground shadow-sm hover:bg-destructive/90 active:scale-[.98]',
        'success'     => 'bg-success text-success-foreground shadow-sm hover:brightness-110 active:scale-[.98]',
        'soft'        => 'bg-primary/10 text-primary hover:bg-primary/15',
    ];

    $sizes = [
        'sm'      => 'h-8 rounded-md px-3 text-xs',
        'default' => 'h-10 px-4 py-2',
        'lg'      => 'h-11 rounded-lg px-6 text-[0.95rem]',
        'icon'    => 'size-10',
        'icon-sm' => 'size-8 rounded-md',
    ];

    $classes = trim($base.' '.($variants[$variant] ?? $variants['default']).' '.($sizes[$size] ?? $sizes['default']));
    $tag = $href ? 'a' : 'button';
@endphp

<{{ $tag }}
    @if ($href) href="{{ $href }}" @else type="{{ $type }}" @endif
    {{ $attributes->class($classes) }}
>
    @if ($loading)
        <span class="size-4 animate-spin rounded-full border-2 border-current border-e-transparent"></span>
    @elseif ($icon)
        <i data-lucide="{{ $icon }}"></i>
    @endif
    {{ $slot }}
    @if ($iconEnd)
        <i data-lucide="{{ $iconEnd }}"></i>
    @endif
</{{ $tag }}>
