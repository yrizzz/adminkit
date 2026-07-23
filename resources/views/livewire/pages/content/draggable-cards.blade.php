<div x-data x-init="$nextTick(() => window.renderIcons && window.renderIcons())">
    <x-page-header :title="$pageTitle" subtitle="Advanced Ui · drag & drop kanban, sortable lists & reorderable grids">
        <x-slot:actions>
            <x-ui.badge variant="success" dot>3 variants</x-ui.badge>
            <x-ui.button variant="outline" icon="arrow-left" class="[&>svg]:rtl-flip" :href="route('dashboard')">Dashboard</x-ui.button>
        </x-slot:actions>
    </x-page-header>

    <x-demo-section title="Kanban board" desc="Drag any card onto another (to reorder) or an empty area (to append)." />
    <div x-data="{
            drag: null,
            cols: [
                { title: 'To Do', tone: 'text-muted-foreground', cards: [
                    { id: 1, title: 'Design empty states', tag: 'Design', tone: 'default' },
                    { id: 2, title: 'Audit color contrast', tag: 'A11y', tone: 'info' },
                    { id: 3, title: 'Write release notes', tag: 'Docs', tone: 'muted' },
                ]},
                { title: 'In Progress', tone: 'text-info', cards: [
                    { id: 4, title: 'Build settings screen', tag: 'Feature', tone: 'warning' },
                    { id: 5, title: 'Refactor auth guard', tag: 'Backend', tone: 'default' },
                ]},
                { title: 'Done', tone: 'text-success', cards: [
                    { id: 6, title: 'Set up CI pipeline', tag: 'DevOps', tone: 'success' },
                ]},
            ],
            start(c, i) { this.drag = { c, i }; },
            move(tc, ti) {
                if (! this.drag) return;
                const { c, i } = this.drag;
                const card = this.cols[c].cards.splice(i, 1)[0];
                if (c === tc && i < ti) ti--;
                this.cols[tc].cards.splice(ti, 0, card);
                this.drag = null;
            },
            badge(tone) {
                return { default: 'bg-primary/10 text-primary', info: 'bg-info/12 text-info', warning: 'bg-warning/15 text-[hsl(var(--warning))]', success: 'bg-success/12 text-success', muted: 'bg-muted text-muted-foreground' }[tone] || 'bg-muted text-muted-foreground';
            },
         }"
         class="grid grid-cols-1 gap-4 sm:grid-cols-3">
        <template x-for="(col, ci) in cols" :key="col.title">
            <div class="flex flex-col rounded-xl border border-border bg-muted/30" @dragover.prevent @drop.prevent="move(ci, col.cards.length)">
                <div class="flex items-center justify-between px-4 py-3">
                    <h3 class="flex items-center gap-2 text-sm font-semibold" :class="col.tone"><i data-lucide="circle" class="size-2.5 fill-current"></i><span x-text="col.title"></span></h3>
                    <span class="rounded-full bg-background px-2 py-0.5 text-xs font-semibold text-muted-foreground" x-text="col.cards.length"></span>
                </div>
                <div class="flex min-h-24 flex-1 flex-col gap-2 p-2">
                    <template x-for="(card, i) in col.cards" :key="card.id">
                        <div draggable="true" @dragstart="start(ci, i)" @dragend="drag = null" @dragover.prevent.stop @drop.prevent.stop="move(ci, i)"
                             class="group cursor-grab rounded-lg border border-border bg-card p-3 shadow-sm transition active:cursor-grabbing"
                             :class="drag && drag.c === ci && drag.i === i ? 'opacity-40 ring-2 ring-primary' : 'hover:shadow-md hover:-translate-y-0.5'">
                            <div class="flex items-start justify-between gap-2"><p class="text-sm font-medium" x-text="card.title"></p><i data-lucide="grip-vertical" class="size-4 shrink-0 text-muted-foreground/40"></i></div>
                            <span class="mt-2 inline-flex rounded-full px-2 py-0.5 text-xs font-semibold" :class="badge(card.tone)" x-text="card.tag"></span>
                        </div>
                    </template>
                    <div x-show="col.cards.length === 0" class="grid flex-1 place-items-center rounded-lg border-2 border-dashed border-border py-6 text-xs text-muted-foreground">Drop here</div>
                </div>
            </div>
        </template>
    </div>

    <x-demo-section title="Sortable list & reorderable tags" desc="Drag rows to reorder a list, or rearrange chips in a grid." />
    <div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
        {{-- Sortable list --}}
        <x-ui.card title="Sortable list" subtitle="Drag the handle to reorder">
            <div x-data="{
                    from: null,
                    items: [
                        { id: 1, icon: 'flag', title: 'Define project scope' },
                        { id: 2, icon: 'palette', title: 'Create design system' },
                        { id: 3, icon: 'code', title: 'Implement components' },
                        { id: 4, icon: 'test-tube', title: 'Write tests' },
                        { id: 5, icon: 'rocket', title: 'Deploy to production' },
                    ],
                    move(to) { if (this.from === null || this.from === to) return; const it = this.items.splice(this.from, 1)[0]; this.items.splice(to, 0, it); this.from = null; },
                 }" class="space-y-2">
                <template x-for="(it, i) in items" :key="it.id">
                    <div draggable="true" @dragstart="from = i" @dragend="from = null" @dragover.prevent @drop.prevent="move(i)"
                         class="flex items-center gap-3 rounded-lg border border-border bg-card p-3 transition"
                         :class="from === i ? 'opacity-40 ring-2 ring-primary' : 'hover:bg-accent/40'">
                        <i data-lucide="grip-vertical" class="size-4 shrink-0 cursor-grab text-muted-foreground/50"></i>
                        <span class="grid size-8 shrink-0 place-items-center rounded-lg bg-primary/10 text-primary"><i :data-lucide="it.icon" class="size-4"></i></span>
                        <span class="flex-1 text-sm font-medium" x-text="it.title"></span>
                        <span class="text-xs font-semibold text-muted-foreground" x-text="'#' + (i + 1)"></span>
                    </div>
                </template>
            </div>
        </x-ui.card>

        {{-- Reorderable chips --}}
        <x-ui.card title="Reorderable chips" subtitle="Drag to rearrange priorities">
            <div x-data="{
                    from: null,
                    chips: ['Performance','Accessibility','Security','Design','Testing','Docs','SEO','Analytics'],
                    move(to) { if (this.from === null || this.from === to) return; const c = this.chips.splice(this.from, 1)[0]; this.chips.splice(to, 0, c); this.from = null; },
                 }" class="flex flex-wrap gap-2">
                <template x-for="(chip, i) in chips" :key="chip">
                    <div draggable="true" @dragstart="from = i" @dragend="from = null" @dragover.prevent @drop.prevent="move(i)"
                         class="flex cursor-grab items-center gap-1.5 rounded-full border border-border bg-card px-3 py-1.5 text-sm font-medium transition active:cursor-grabbing"
                         :class="from === i ? 'opacity-40 ring-2 ring-primary' : 'hover:border-primary hover:text-primary'">
                        <i data-lucide="grip-vertical" class="size-3.5 text-muted-foreground/50"></i><span x-text="chip"></span>
                    </div>
                </template>
            </div>
        </x-ui.card>
    </div>
</div>
