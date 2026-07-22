@props([
    'name'     => 'modal',
    'title'    => null,
    'maxWidth' => 'max-w-lg',
])

<div
    x-data="{ open: false }"
    x-on:open-modal.window="$event.detail === '{{ $name }}' && (open = true)"
    x-on:close-modal.window="$event.detail === '{{ $name }}' && (open = false)"
    x-on:keydown.escape.window="open = false"
>
    <template x-teleport="body">
        <div x-show="open" x-cloak class="fixed inset-0 z-[100] flex items-center justify-center p-4">
            <div
                x-show="open"
                x-transition:enter="ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                x-transition:leave="ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                class="absolute inset-0 bg-background/70 backdrop-blur-sm" @click="open = false"
            ></div>

            <div
                x-show="open"
                x-trap.noscroll="open"
                x-transition:enter="ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-3 scale-95" x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                x-transition:leave="ease-in duration-150" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                class="relative w-full {{ $maxWidth }} overflow-hidden rounded-2xl border border-border bg-card text-card-foreground shadow-2xl"
            >
                @if ($title || isset($header))
                    <div class="flex items-center justify-between gap-4 border-b border-border px-6 py-4">
                        <div>
                            @if ($title)<h3 class="text-lg font-semibold">{{ $title }}</h3>@endif
                            {{ $header ?? '' }}
                        </div>
                        <button type="button" @click="open = false" class="rounded-lg p-1.5 text-muted-foreground hover:bg-accent hover:text-foreground">
                            <i data-lucide="x" class="size-5"></i>
                        </button>
                    </div>
                @endif

                <div class="px-6 py-5">{{ $slot }}</div>

                @isset($footer)
                    <div class="flex items-center justify-end gap-3 border-t border-border bg-muted/30 px-6 py-4">{{ $footer }}</div>
                @endisset
            </div>
        </div>
    </template>
</div>
