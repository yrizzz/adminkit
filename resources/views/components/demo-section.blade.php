@props([
    'title' => '',
    'desc'  => null,
    'badge' => null,
])

<div {{ $attributes->class('mb-4 mt-10 first:mt-0') }}>
    <div class="flex items-center gap-3">
        <h2 class="shrink-0 text-base font-bold tracking-tight">{{ $title }}</h2>
        @if ($badge)
            <x-ui.badge variant="muted">{{ $badge }}</x-ui.badge>
        @endif
        <div class="h-px flex-1 bg-gradient-to-r from-border to-transparent"></div>
    </div>
    @if ($desc)
        <p class="mt-1 text-sm text-muted-foreground">{{ $desc }}</p>
    @endif
</div>
