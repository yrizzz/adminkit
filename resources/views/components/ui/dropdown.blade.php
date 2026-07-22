@props([
    'align' => 'end',   // start | end
    'width' => 'w-56',
])

<div x-data="{ open: false }" class="relative" @keydown.escape.window="open = false">
    <div @click="open = ! open" class="cursor-pointer">
        {{ $trigger }}
    </div>

    <div
        x-show="open"
        x-cloak
        @click.outside="open = false"
        @click="open = false"
        x-transition:enter="transition ease-out duration-150"
        x-transition:enter-start="opacity-0 -translate-y-1 scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
        x-transition:leave="transition ease-in duration-100"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        class="absolute z-50 mt-2 {{ $width }} {{ $align === 'end' ? 'end-0 origin-top-right' : 'start-0 origin-top-left' }} rounded-xl border border-border bg-popover p-1.5 text-popover-foreground shadow-lg shadow-black/5"
    >
        {{ $slot }}
    </div>
</div>
