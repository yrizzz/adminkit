@props([
    'variant' => 'info',   // info | success | warning | destructive | default
    'title'   => null,
    'icon'    => null,
])

@php
    $map = [
        'default'     => ['wrap' => 'bg-muted/50 border-border text-foreground',                'ico' => 'text-foreground',   'i' => 'info'],
        'info'        => ['wrap' => 'bg-info/8 border-info/25 text-foreground',                  'ico' => 'text-info',         'i' => 'info'],
        'success'     => ['wrap' => 'bg-success/8 border-success/25 text-foreground',            'ico' => 'text-success',      'i' => 'circle-check-big'],
        'warning'     => ['wrap' => 'bg-warning/10 border-warning/30 text-foreground',           'ico' => 'text-[hsl(var(--warning))]', 'i' => 'triangle-alert'],
        'destructive' => ['wrap' => 'bg-destructive/8 border-destructive/25 text-foreground',    'ico' => 'text-destructive',  'i' => 'circle-alert'],
    ];
    $c = $map[$variant] ?? $map['info'];
@endphp

<div {{ $attributes->class('flex items-start gap-3 rounded-xl border px-4 py-3 text-sm '.$c['wrap']) }}>
    <i data-lucide="{{ $icon ?? $c['i'] }}" class="mt-0.5 size-5 shrink-0 {{ $c['ico'] }}"></i>
    <div class="min-w-0 flex-1">
        @if ($title)<p class="font-semibold">{{ $title }}</p>@endif
        <div class="{{ $title ? 'mt-0.5 text-muted-foreground' : '' }}">{{ $slot }}</div>
    </div>
</div>
