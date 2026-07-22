@props([
    'href'    => null,
    'icon'    => null,
    'type'    => 'button',
    'variant' => 'default', // default | destructive
])

@php
    $tag = $href ? 'a' : 'button';
    $tone = $variant === 'destructive'
        ? 'text-destructive hover:bg-destructive/10'
        : 'text-foreground hover:bg-accent hover:text-accent-foreground';
@endphp

<{{ $tag }}
    @if ($href) href="{{ $href }}" @else type="{{ $type }}" @endif
    {{ $attributes->class('flex w-full items-center gap-2.5 rounded-lg px-2.5 py-2 text-start text-sm font-medium transition-colors [&>svg]:size-4 [&>svg]:text-muted-foreground '.$tone) }}
>
    @if ($icon)<i data-lucide="{{ $icon }}"></i>@endif
    {{ $slot }}
</{{ $tag }}>
