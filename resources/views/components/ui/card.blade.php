@props([
    'title'    => null,
    'subtitle' => null,
    'hover'    => false,
    'padded'   => true,
])

<div {{ $attributes->class(['ak-card', 'transition-all duration-200 hover:shadow-md hover:-translate-y-0.5' => $hover]) }}>
    @if ($title || isset($header) || $subtitle || isset($actions))
        <div class="flex items-start justify-between gap-4 border-b border-border px-5 py-4">
            <div class="min-w-0">
                @if ($title)
                    <h3 class="font-semibold leading-none tracking-tight">{{ $title }}</h3>
                @endif
                @if ($subtitle)
                    <p class="mt-1.5 text-sm text-muted-foreground">{{ $subtitle }}</p>
                @endif
                {{ $header ?? '' }}
            </div>
            @isset($actions)
                <div class="flex shrink-0 items-center gap-2">{{ $actions }}</div>
            @endisset
        </div>
    @endif

    <div class="{{ $padded ? 'p-5' : '' }}">
        {{ $slot }}
    </div>

    @isset($footer)
        <div class="border-t border-border px-5 py-4">{{ $footer }}</div>
    @endisset
</div>
