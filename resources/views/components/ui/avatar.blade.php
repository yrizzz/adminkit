@props([
    'src'    => null,
    'name'   => '',
    'size'   => 'md',
    'status' => null, // online | away | busy | offline
])

@php
    $sizes = [
        'xs' => 'size-6 text-[0.6rem]',
        'sm' => 'size-8 text-xs',
        'md' => 'size-10 text-sm',
        'lg' => 'size-12 text-base',
        'xl' => 'size-16 text-lg',
    ];
    $initials = collect(explode(' ', trim($name)))->filter()->take(2)->map(fn ($p) => Str::upper(Str::substr($p, 0, 1)))->implode('');
    $statusColors = [
        'online' => 'bg-success', 'away' => 'bg-warning', 'busy' => 'bg-destructive', 'offline' => 'bg-muted-foreground',
    ];
@endphp

<span {{ $attributes->class('relative inline-flex shrink-0 items-center justify-center rounded-full '.($sizes[$size] ?? $sizes['md'])) }}>
    @if ($src)
        <img src="{{ $src }}" alt="{{ $name }}" class="size-full rounded-full object-cover" />
    @else
        <span class="flex size-full items-center justify-center rounded-full bg-primary/15 font-semibold text-primary">{{ $initials ?: '?' }}</span>
    @endif

    @if ($status)
        <span class="absolute -bottom-0 -end-0 block size-2.5 rounded-full ring-2 ring-background {{ $statusColors[$status] ?? 'bg-muted-foreground' }}"></span>
    @endif
</span>
