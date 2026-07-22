@php($leaves = \App\Support\Menu::leaves())

{{-- Command palette (⌘K / Ctrl+K) --}}
<div
    x-data="{
        q: '',
        items: @js($leaves),
        get results() {
            const t = this.q.toLowerCase().trim();
            if (!t) return this.items.slice(0, 8);
            return this.items.filter(i => (i.label + ' ' + (i.group||'')).toLowerCase().includes(t)).slice(0, 20);
        },
        open() { $store.ui.commandOpen = true; this.q = ''; $nextTick(() => { this.$refs.input.focus(); window.renderIcons && window.renderIcons(); }); },
        go(href) { if (href && href !== '#') { $store.ui.commandOpen = false; window.Livewire ? Livewire.navigate(href) : (window.location.href = href); } }
    }"
    x-init="$watch('$store.ui.commandOpen', v => { if (v) open(); })"
    @keydown.window.prevent.cmd.k="open()"
    @keydown.window.prevent.ctrl.k="open()"
    x-cloak
>
    <div x-show="$store.ui.commandOpen" x-transition.opacity
         @click="$store.ui.commandOpen = false"
         class="fixed inset-0 z-[110] bg-black/50 backdrop-blur-sm"></div>

    <div x-show="$store.ui.commandOpen" class="fixed inset-x-0 top-[12vh] z-[115] mx-auto w-full max-w-xl px-4">
        <div x-show="$store.ui.commandOpen"
             x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-3 scale-95" x-transition:enter-end="opacity-100 translate-y-0 scale-100"
             @keydown.escape.window="$store.ui.commandOpen = false"
             class="overflow-hidden rounded-2xl border border-border bg-popover text-popover-foreground shadow-2xl">
            <div class="flex items-center gap-3 border-b border-border px-4">
                <i data-lucide="search" class="size-5 text-muted-foreground"></i>
                <input x-ref="input" x-model="q" type="text" placeholder="Search pages, sections…"
                       class="h-14 w-full bg-transparent text-sm outline-none placeholder:text-muted-foreground">
                <kbd class="rounded border border-border bg-muted px-1.5 py-0.5 text-[0.65rem] font-semibold text-muted-foreground">ESC</kbd>
            </div>
            <div class="max-h-80 overflow-y-auto p-2">
                <template x-for="item in results" :key="item.href + item.label">
                    <a :href="item.href" @click.prevent="go(item.href)"
                       class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm hover:bg-accent">
                        <span class="grid size-8 place-items-center rounded-lg bg-muted text-muted-foreground">
                            <i :data-lucide="item.icon" class="size-4"></i>
                        </span>
                        <span class="flex-1 font-medium" x-text="item.label"></span>
                        <span class="text-xs text-muted-foreground" x-text="item.group"></span>
                        <i data-lucide="corner-down-left" class="size-4 text-muted-foreground/50"></i>
                    </a>
                </template>
                <p x-show="results.length === 0" class="px-3 py-8 text-center text-sm text-muted-foreground">No results for “<span x-text="q"></span>”.</p>
            </div>
        </div>
    </div>
</div>
