@php
    use App\Support\Menu;
    $cfg = config('adminkit');
    $items = collect($cfg['menu'])->flatMap(fn ($g) => $g['items'])->all();
@endphp

<div x-show="$store.ui.layout === 'horizontal'" x-cloak
     class="hnav-topbar sticky top-16 z-20 hidden border-b backdrop-blur-lg lg:block"
     :style="(() => {
         const c = $store.ui.navbarColor;
         const dark = $store.ui.isDark;
         if (c === 'primary')    return 'background-color:hsl(var(--primary));border-color:rgba(255,255,255,0.12);color:#fff;';
         if (c === 'dark')       return 'background-color:#070B14;border-color:rgba(255,255,255,0.12);color:#fff;';
         if (c === 'gradient' || c === 'gradient1') return 'background:linear-gradient(90deg,#1e1b4b 0%,#0f172a 100%);border-color:rgba(255,255,255,0.1);color:#fff;';
         if (c === 'gradient2')  return 'background:linear-gradient(90deg,#0d9488 0%,#064e3b 100%);border-color:rgba(255,255,255,0.1);color:#fff;';
         if (c === 'gradient3')  return 'background:linear-gradient(90deg,#e11d48 0%,#4c0519 100%);border-color:rgba(255,255,255,0.1);color:#fff;';
         if (c === 'glass')      return 'background-color:rgba(255,255,255,0.1);backdrop-filter:blur(16px);border-color:rgba(255,255,255,0.15);color:' + (dark ? '#fff' : '#0f172a') + ';';
         if (dark)               return 'background-color:#0D1527;border-color:rgba(255,255,255,0.1);color:#fff;';
         return 'background-color:rgba(255,255,255,0.88);border-color:rgba(0,0,0,0.08);color:#0f172a;';
     })()">
    <div
        x-data="{
            canS: false, canE: false,
            upd() {
                const t = this.$refs.track; if (! t) return;
                const max = t.scrollWidth - t.clientWidth;
                const x = Math.abs(t.scrollLeft);
                this.canS = x > 2;
                this.canE = x < max - 2;
            },
            nudge(dir) {
                const t = this.$refs.track; if (! t) return;
                const rtl = document.documentElement.getAttribute('dir') === 'rtl';
                const sign = (dir === 'start' ? -1 : 1) * (rtl ? -1 : 1);
                t.scrollBy({ left: sign * Math.max(220, t.clientWidth * 0.7), behavior: 'smooth' });
            },
        }"
        x-init="$nextTick(() => upd())"
        x-effect="$store.ui.layout; $nextTick(() => upd())"
        @resize.window="upd()"
        x-on:livewire:navigated.window="$nextTick(() => upd())"
        class="relative flex items-center"
    >
        {{-- Scroll toward start (overlays the left edge, only when scrollable) --}}
        <div class="pointer-events-none absolute inset-y-0 start-0 z-10 flex items-center bg-gradient-to-r from-background via-background/95 to-transparent ps-1.5 pe-8 transition-opacity"
             :class="canS ? 'opacity-100' : 'opacity-0'">
            <button type="button" @click="nudge('start')" :disabled="! canS" aria-label="Scroll menu backward"
                    class="pointer-events-auto grid size-8 place-items-center rounded-lg bg-background/80 text-muted-foreground ring-1 ring-border transition-colors hover:bg-accent hover:text-foreground">
                <i data-lucide="chevron-left" class="rtl-flip size-4"></i>
            </button>
        </div>

        <nav x-ref="track" @scroll="upd(); $dispatch('hnav-close')"
             class="no-scrollbar flex flex-1 flex-nowrap items-center gap-0.5 overflow-x-auto scroll-smooth px-5 py-1.5">
            @foreach ($items as $item)
                @php($active = Menu::active($item))
                @if (Menu::hasChildren($item))
                    <div x-data="{
                            open: false, x: 0, y: 0, timer: null,
                            place() {
                                const r = this.$refs.btn.getBoundingClientRect();
                                const rtl = document.documentElement.getAttribute('dir') === 'rtl';
                                let left = rtl ? r.right - 256 : r.left;
                                this.x = Math.min(Math.max(8, left), window.innerWidth - 256 - 8);
                                this.y = r.bottom + 4;
                            },
                            show() { clearTimeout(this.timer); this.place(); this.open = true; },
                            hide() { this.timer = setTimeout(() => this.open = false, 140); },
                            toggle() { this.open ? this.open = false : this.show(); },
                         }"
                         class="relative shrink-0"
                         @mouseenter="show()" @mouseleave="hide()"
                         @hnav-close.window="open = false; clearTimeout(timer)">
                        <button type="button" x-ref="btn" @click="toggle()"
                                :class="{{ $active ? 'true' : 'false' }} ? 'bg-white/15' : 'hover:bg-white/10'"
                                :style="
                                    $store.ui.navbarColor !== 'default' && $store.ui.navbarColor !== '' && !($store.ui.isDark && $store.ui.navbarColor === 'default')
                                        ? 'color:inherit;'
                                        : '{{ $active ? 'color:hsl(var(--primary))' : 'color:hsl(var(--foreground))' }}'
                                "
                                class="flex items-center gap-2 whitespace-nowrap rounded-lg px-3 py-2 text-sm font-medium transition-colors">
                            <i data-lucide="{{ $item['icon'] ?? 'dot' }}" class="size-4"></i>
                            {{ $item['label'] }}
                            <i data-lucide="chevron-down" class="size-3.5 opacity-60"></i>
                        </button>
                        <template x-teleport="body">
                            <div x-show="open" x-cloak
                                 @mouseenter="show()" @mouseleave="hide()"
                                 @keydown.escape.window="open = false"
                                 @resize.window="open && place()"
                                 :style="`top:${y}px; left:${x}px; width:16rem;`"
                                 x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0 -translate-y-1" x-transition:enter-end="opacity-100 translate-y-0"
                                 class="fixed z-50 max-h-[70vh] overflow-y-auto rounded-xl border border-border bg-popover p-1.5 shadow-lg">
                                @foreach ($item['children'] as $child)
                                    @include('partials.horizontal-child', ['item' => $child, 'level' => 1])
                                @endforeach
                            </div>
                        </template>
                    </div>
                @else
                    <a href="{{ Menu::href($item) }}" wire:navigate
                       :class="{{ $active ? 'true' : 'false' }} ? 'bg-white/15' : 'hover:bg-white/10'"
                       :style="
                           $store.ui.navbarColor !== 'default' && $store.ui.navbarColor !== '' && !($store.ui.isDark && $store.ui.navbarColor === 'default')
                               ? 'color:inherit;'
                               : '{{ $active ? 'color:hsl(var(--primary))' : 'color:hsl(var(--foreground))' }}'
                       "
                       class="flex shrink-0 items-center gap-2 whitespace-nowrap rounded-lg px-3 py-2 text-sm font-medium transition-colors">
                        <i data-lucide="{{ $item['icon'] ?? 'dot' }}" class="size-4"></i>
                        {{ $item['label'] }}
                    </a>
                @endif
            @endforeach
        </nav>

        {{-- Scroll toward end (overlays the right edge, only when scrollable) --}}
        <div class="pointer-events-none absolute inset-y-0 end-0 z-10 flex items-center justify-end bg-gradient-to-l from-background via-background/95 to-transparent ps-8 pe-1.5 transition-opacity"
             :class="canE ? 'opacity-100' : 'opacity-0'">
            <button type="button" @click="nudge('end')" :disabled="! canE" aria-label="Scroll menu forward"
                    class="pointer-events-auto grid size-8 place-items-center rounded-lg bg-background/80 text-muted-foreground ring-1 ring-border transition-colors hover:bg-accent hover:text-foreground">
                <i data-lucide="chevron-right" class="rtl-flip size-4"></i>
            </button>
        </div>
    </div>
</div>
