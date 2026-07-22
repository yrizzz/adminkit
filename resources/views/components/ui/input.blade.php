@props([
    'label'   => null,
    'name'    => null,
    'type'    => 'text',
    'icon'    => null,
    'hint'    => null,
    'error'   => null,
])

@php
    $id = $attributes->get('id') ?? $name ?? 'in_'.Str::random(5);
    $error = $error ?? ($name ? ($errors->first($name) ?: null) : null);
@endphp

<div class="space-y-1.5">
    @if ($label)
        <label for="{{ $id }}" class="block text-sm font-medium text-foreground">{{ $label }}</label>
    @endif

    <div class="relative">
        @if ($icon)
            <span class="pointer-events-none absolute inset-y-0 start-0 flex items-center ps-3 text-muted-foreground">
                <i data-lucide="{{ $icon }}" class="size-4"></i>
            </span>
        @endif

        <input
            id="{{ $id }}"
            @if ($name) name="{{ $name }}" @endif
            type="{{ $type }}"
            {{ $attributes->class([
                'flex h-10 w-full rounded-lg border bg-background px-3 py-2 text-sm shadow-sm transition-colors placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-1 focus-visible:ring-offset-background disabled:cursor-not-allowed disabled:opacity-50',
                'ps-9' => $icon,
                'border-input' => ! $error,
                'border-destructive ring-1 ring-destructive/40' => $error,
            ]) }}
        />
    </div>

    @if ($error)
        <p class="flex items-center gap-1 text-xs font-medium text-destructive">
            <i data-lucide="circle-alert" class="size-3.5"></i>{{ $error }}
        </p>
    @elseif ($hint)
        <p class="text-xs text-muted-foreground">{{ $hint }}</p>
    @endif
</div>
