@php
    use App\Support\Menu;
    $level ??= 1;
    $href = Menu::href($item);
    $pad = 0.625 + ($level - 1) * 0.75;
@endphp

@if (Menu::hasChildren($item))
    <p class="px-2.5 pb-0.5 pt-2 text-[0.65rem] font-semibold uppercase tracking-wide text-muted-foreground" style="padding-inline-start: {{ $pad }}rem">{{ $item['label'] }}</p>
    @foreach ($item['children'] as $child)
        @include('partials.horizontal-child', ['item' => $child, 'level' => $level + 1])
    @endforeach
@else
    <a href="{{ $href }}" wire:navigate
       class="flex items-center gap-2 rounded-lg py-1.5 pe-2.5 text-sm font-medium text-foreground hover:bg-accent {{ Menu::active($item) ? 'text-primary' : '' }}"
       style="padding-inline-start: {{ $pad }}rem">
        <span class="h-px w-2 bg-current opacity-40"></span>{{ $item['label'] }}
    </a>
@endif
