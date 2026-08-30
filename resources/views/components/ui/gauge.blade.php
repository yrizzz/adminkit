@props([
    'value'  => 0,        // 0..100
    'label'  => null,
    'sub'    => null,
    'size'   => 128,
    'stroke' => 10,
    'tone'   => 'primary', // primary | success | warning | info | destructive | chart-1..5
    'display'=> null,       // center text override (defaults to value%)
])

@php
    $toneColor = [
        'primary'     => 'hsl(var(--primary))',
        'success'     => 'hsl(var(--success))',
        'warning'     => 'hsl(var(--warning))',
        'info'        => 'hsl(var(--info))',
        'destructive' => 'hsl(var(--destructive))',
        'chart-1'     => 'hsl(var(--chart-1))',
        'chart-2'     => 'hsl(var(--chart-2))',
        'chart-3'     => 'hsl(var(--chart-3))',
        'chart-4'     => 'hsl(var(--chart-4))',
        'chart-5'     => 'hsl(var(--chart-5))',
    ][$tone] ?? 'hsl(var(--primary))';

    $r = ($size - $stroke) / 2;
    $c = 2 * M_PI * $r;
    $val = max(0, min(100, (float) $value));
    $offset = $c * (1 - $val / 100);
@endphp

<div {{ $attributes->class('flex flex-col items-center') }} x-data="{ currentVal: {{ $val }}, r: {{ $r }}, c: {{ $c }} }" x-init="
    const observer = new MutationObserver((mutations) => {
        mutations.forEach((mutation) => {
            if (mutation.attributeName === 'value') {
                currentVal = parseFloat($el.getAttribute('value')) || 0;
            }
        });
    });
    observer.observe($el, { attributes: true });
    currentVal = parseFloat($el.getAttribute('value')) || {{ $val }};
">
    <div class="relative" style="width: {{ $size }}px; height: {{ $size }}px">
        <svg width="{{ $size }}" height="{{ $size }}" viewBox="0 0 {{ $size }} {{ $size }}" class="-rotate-90">
            <circle cx="{{ $size / 2 }}" cy="{{ $size / 2 }}" r="{{ $r }}" fill="none" stroke="hsl(var(--muted))" stroke-width="{{ $stroke }}" />
            <circle cx="{{ $size / 2 }}" cy="{{ $size / 2 }}" r="{{ $r }}" fill="none" stroke="{{ $toneColor }}" stroke-width="{{ $stroke }}"
                    stroke-linecap="round" stroke-dasharray="{{ $c }}" :stroke-dashoffset="c * (1 - Math.max(0, Math.min(100, currentVal)) / 100)"
                    style="transition: stroke-dashoffset .6s cubic-bezier(.22,1,.36,1)" />
        </svg>
        <div class="absolute inset-0 flex flex-col items-center justify-center">
            <span class="font-bold leading-none" style="font-size: {{ max(11, round($size * 0.22)) }}px" x-text="Math.round(currentVal) + '%'">{{ $display ?? $val . '%' }}</span>
            @if ($sub)<span class="mt-1 text-[0.7rem] text-muted-foreground">{{ $sub }}</span>@endif
        </div>
    </div>
    @if ($label)<p class="mt-2 text-sm font-medium">{{ $label }}</p>@endif
</div>
