@php
    use App\Support\Menu;
    $cfg = config('adminkit');
    $items = collect($cfg['menu'])->flatMap(fn ($g) => $g['items'])->all();
@endphp

<div x-show="$store.ui.layout === 'horizontal'" x-cloak
     class="sticky top-16 z-20 hidden border-b border-border bg-background/80 backdrop-blur-lg lg:block">
    <nav class="flex flex-wrap items-center gap-0.5 px-4 py-1.5">
        @foreach ($items as $item)
            @php($active = Menu::active($item))
            @if (Menu::hasChildren($item))
                <div x-data="{ open: false }" class="relative" @mouseenter="open = true" @mouseleave="open = false">
                    <button type="button" @click="open = !open"
                            class="flex items-center gap-2 whitespace-nowrap rounded-lg px-3 py-2 text-sm font-medium transition-colors hover:bg-accent {{ $active ? 'bg-accent text-primary' : 'text-foreground' }}">
                        <i data-lucide="{{ $item['icon'] ?? 'dot' }}" class="size-4"></i>
                        {{ $item['label'] }}
                        <i data-lucide="chevron-down" class="size-3.5 text-muted-foreground"></i>
                    </button>
                    <div x-show="open" x-cloak
                         x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0 -translate-y-1" x-transition:enter-end="opacity-100 translate-y-0"
                         class="absolute start-0 z-50 mt-0.5 max-h-[70vh] w-64 overflow-y-auto rounded-xl border border-border bg-popover p-1.5 shadow-lg">
                        @foreach ($item['children'] as $child)
                            @include('partials.horizontal-child', ['item' => $child, 'level' => 1])
                        @endforeach
                    </div>
                </div>
            @else
                <a href="{{ Menu::href($item) }}" wire:navigate
                   class="flex items-center gap-2 whitespace-nowrap rounded-lg px-3 py-2 text-sm font-medium transition-colors hover:bg-accent {{ $active ? 'bg-accent text-primary' : 'text-foreground' }}">
                    <i data-lucide="{{ $item['icon'] ?? 'dot' }}" class="size-4"></i>
                    {{ $item['label'] }}
                </a>
            @endif
        @endforeach
    </nav>
</div>
