@php
    use App\Support\Menu;
    $level ??= 0;
    $isSub = $level > 0;
    $hasChildren = Menu::hasChildren($item);
    $active = Menu::active($item);
    $href = Menu::href($item);
    $badge = $item['badge'] ?? null;
    $badgeTones = [
        'neutral' => 'bg-white/10 text-sidebar-foreground',
        'primary' => 'bg-sidebar-primary/20 text-sidebar-primary',
        'success' => 'bg-success/20 text-success',
        'warning' => 'bg-warning/20 text-[hsl(var(--warning))]',
        'hot'     => 'bg-orange-500/15 text-orange-400',
    ];
    $tone = $badge ? ($badgeTones[$badge['variant'] ?? 'neutral'] ?? $badgeTones['neutral']) : '';
    $linkClass = 'nav-link '.($isSub ? 'nav-sub ' : '').($active ? 'active' : '');
@endphp

@if ($hasChildren)
    <li x-data="{ open: @js($active) }">
        <button type="button" @click="open = ! open" class="{{ $linkClass }} w-full" :class="{ 'is-open': open }">
            @if ($isSub)
                <span class="nav-node"></span>
            @else
                <i data-lucide="{{ $item['icon'] ?? 'dot' }}" class="nav-icon size-[1.15rem]"></i>
            @endif
            <span class="nav-label flex-1 truncate text-start">{{ $item['label'] }}</span>
            @if ($badge)
                <span class="nav-badge rounded-md px-1.5 py-0.5 text-[0.65rem] font-bold leading-none {{ $tone }}">{{ $badge['text'] }}</span>
            @endif
            <i data-lucide="chevron-down" class="nav-chevron size-4 shrink-0 text-sidebar-muted transition-transform duration-200" :class="{ 'rotate-180': open }"></i>
        </button>

        <ul x-show="open" x-collapse x-cloak class="nav-sublist">
            @foreach ($item['children'] as $child)
                @include('partials.menu-item', ['item' => $child, 'level' => $level + 1])
            @endforeach
        </ul>
    </li>
@else
    <li>
        <a href="{{ $href }}" class="{{ $linkClass }}">
            @if ($isSub)
                <span class="nav-node"></span>
            @else
                <i data-lucide="{{ $item['icon'] ?? 'dot' }}" class="nav-icon size-[1.15rem]"></i>
            @endif
            <span class="nav-label flex-1 truncate">{{ $item['label'] }}</span>
            @if ($badge)
                <span class="nav-badge rounded-md px-1.5 py-0.5 text-[0.65rem] font-bold leading-none {{ $tone }}">{{ $badge['text'] }}</span>
            @endif
        </a>
    </li>
@endif
