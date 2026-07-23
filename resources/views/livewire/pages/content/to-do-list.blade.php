<div>
    <x-page-header :title="'Board'" subtitle="Pages · Trello-style kanban — cards, checklists, comments & filters">
        <x-slot:actions>
            <x-ui.button variant="outline" icon="arrow-left" class="[&>svg]:rtl-flip" :href="route('dashboard')">Dashboard</x-ui.button>
        </x-slot:actions>
    </x-page-header>

    <div x-data="{
            q: '', label: 'all', member: 'all',
            drag: null, addingCol: null, draft: '', addingList: false, listDraft: '', nextId: 200, nextCol: 50,
            active: null, activeCi: null, newCheck: '', newComment: '',
            labelDefs: { green: ['Feature','bg-emerald-500'], blue: ['Design','bg-sky-500'], purple: ['Backend','bg-violet-500'], orange: ['Docs','bg-orange-500'], red: ['Bug','bg-rose-500'], yellow: ['A11y','bg-amber-400'] },
            members: ['Aisha Rahman','David Chen','Sofia Martinez','Omar Haddad','Priya Sharma'],
            avatar(n) { return 'https://api.dicebear.com/9.x/initials/svg?seed=' + encodeURIComponent(n) + '&backgroundType=gradientLinear&fontWeight=600' },
            columns: [
                { id: 'todo', title: 'To Do', accent: 'bg-slate-400', cards: [
                    { id: 1, title: 'Design empty states for the dashboard', labels: ['blue','yellow'], members: ['Sofia Martinez'], due: '2026-07-26', overdue: false, desc: 'Cover the no-data, no-results and error states with friendly illustrations.', checklist: [{t:'Audit current screens',d:true},{t:'Sketch variants',d:false},{t:'Build in Figma',d:false},{t:'Hand off to eng',d:false}], comments: [{who:'David Chen',t:'Love the direction here 👏',at:'2h'}] },
                    { id: 2, title: 'Audit color contrast across the app', labels: ['yellow'], members: ['Aisha Rahman','David Chen'], due: '2026-07-24', overdue: true, desc: 'Ensure all text meets WCAG AA contrast ratios in light and dark mode.', checklist: [{t:'Run automated audit',d:false},{t:'Fix failing tokens',d:false},{t:'Re-test',d:false}], comments: [] },
                    { id: 3, title: 'Write the v2.1 release notes', labels: ['orange'], members: ['Priya Sharma'], due: null, overdue: false, desc: '', checklist: [], comments: [{who:'Aisha Rahman',t:'Ping me before publishing.',at:'1d'}] },
                ]},
                { id: 'progress', title: 'In Progress', accent: 'bg-info', cards: [
                    { id: 4, title: 'Build the settings screen', labels: ['green'], members: ['David Chen'], due: '2026-07-28', overdue: false, desc: 'Profile, appearance, notifications and security tabs.', checklist: [{t:'Profile tab',d:true},{t:'Appearance tab',d:true},{t:'Notifications tab',d:true},{t:'Security tab',d:false},{t:'Wire up saving',d:false},{t:'Tests',d:false}], comments: [{who:'Omar Haddad',t:'Security tab is blocked on the API.',at:'3h'}] },
                    { id: 5, title: 'Refactor the auth guard middleware', labels: ['purple','red'], members: ['Omar Haddad'], due: '2026-07-25', overdue: false, desc: 'Consolidate the three overlapping guards into one.', checklist: [{t:'Map current logic',d:true},{t:'Write new guard',d:true},{t:'Migrate routes',d:false},{t:'Remove old guards',d:false},{t:'QA',d:false}], comments: [] },
                ]},
                { id: 'review', title: 'Review', accent: 'bg-warning', cards: [
                    { id: 6, title: 'PR #218 — timeline dashboard', labels: ['green'], members: ['Aisha Rahman','Priya Sharma'], due: '2026-07-23', overdue: false, desc: 'Review the new timeline dashboard implementation.', checklist: [{t:'Code review',d:true},{t:'Design QA',d:true},{t:'A11y check',d:true},{t:'Approve',d:true},{t:'Merge',d:true}], comments: [{who:'Priya Sharma',t:'LGTM, just one nit inline.',at:'20m'}] },
                ]},
                { id: 'done', title: 'Done', accent: 'bg-success', cards: [
                    { id: 7, title: 'Set up the CI/CD pipeline', labels: ['purple'], members: ['Omar Haddad'], due: '2026-07-20', overdue: false, desc: '', checklist: [{t:'Build',d:true},{t:'Test',d:true},{t:'Deploy',d:true},{t:'Notify',d:true}], comments: [] },
                    { id: 8, title: 'Migrate database to v3 schema', labels: ['purple','red'], members: ['David Chen'], due: '2026-07-19', overdue: false, desc: 'Zero-downtime migration.', checklist: [{t:'Backup',d:true},{t:'Migrate',d:true},{t:'Verify',d:true}], comments: [] },
                ]},
            ],
            /* ---- helpers ---- */
            toggle(arr, v) { const i = arr.indexOf(v); i > -1 ? arr.splice(i, 1) : arr.push(v) },
            done(c) { return c.checklist.filter(x => x.d).length },
            matches(c) {
                const q = this.q.toLowerCase().trim();
                if (q && ! c.title.toLowerCase().includes(q)) return false;
                if (this.label !== 'all' && ! c.labels.includes(this.label)) return false;
                if (this.member !== 'all' && ! c.members.includes(this.member)) return false;
                return true;
            },
            shown(col) { return col.cards.filter(c => this.matches(c)).length },
            activeFilters() { return (this.q ? 1 : 0) + (this.label !== 'all' ? 1 : 0) + (this.member !== 'all' ? 1 : 0) },
            clear() { this.q = ''; this.label = 'all'; this.member = 'all' },
            icons() { this.$nextTick(() => window.renderIcons && window.renderIcons()) },
            /* ---- drag ---- */
            start(ci, i) { this.drag = { ci, i } },
            move(tc, ti) {
                if (! this.drag) return;
                const { ci, i } = this.drag;
                const card = this.columns[ci].cards.splice(i, 1)[0];
                if (ci === tc && i < ti) ti--;
                this.columns[tc].cards.splice(ti, 0, card);
                this.drag = null; this.icons();
            },
            /* ---- cards & lists ---- */
            openCard(ci, i) { this.active = this.columns[ci].cards[i]; this.activeCi = ci; this.icons() },
            deleteCard() { const col = this.columns[this.activeCi]; const idx = col.cards.indexOf(this.active); if (idx > -1) col.cards.splice(idx, 1); this.active = null },
            addCard(ci) {
                const t = this.draft.trim(); if (! t) return;
                this.columns[ci].cards.push({ id: this.nextId++, title: t, labels: [], members: [], due: null, overdue: false, desc: '', checklist: [], comments: [] });
                this.draft = ''; this.addingCol = null; this.icons();
            },
            addList() {
                const t = this.listDraft.trim(); if (! t) return;
                this.columns.push({ id: 'c' + this.nextCol++, title: t, accent: 'bg-slate-400', cards: [] });
                this.listDraft = ''; this.addingList = false; this.icons();
            },
            deleteList(ci) { this.columns.splice(ci, 1) },
            addCheck() { const t = this.newCheck.trim(); if (! t) return; this.active.checklist.push({ t, d: false }); this.newCheck = '' },
            addComment() { const t = this.newComment.trim(); if (! t) return; this.active.comments.unshift({ who: 'Yrizzz', t, at: 'now' }); this.newComment = ''; this.icons() },
         }"
         x-init="icons()">

        {{-- Toolbar --}}
        <div class="mb-4 flex flex-col gap-3 rounded-xl border border-border bg-card p-3 sm:flex-row sm:items-center">
            <div class="flex items-center gap-3">
                <h2 class="font-bold">Product Sprint</h2>
                <div class="flex -space-x-2">
                    @foreach (['Aisha Rahman','David Chen','Sofia Martinez','Omar Haddad'] as $m)
                        <img src="https://api.dicebear.com/9.x/initials/svg?seed={{ urlencode($m) }}&backgroundType=gradientLinear" alt="" class="size-7 rounded-full ring-2 ring-card" title="{{ $m }}" />
                    @endforeach
                    <span class="grid size-7 place-items-center rounded-full bg-muted text-[0.6rem] font-bold text-muted-foreground ring-2 ring-card">+3</span>
                </div>
            </div>
            <div class="flex flex-1 flex-wrap items-center gap-2 sm:justify-end">
                <div class="relative">
                    <i data-lucide="search" class="pointer-events-none absolute inset-y-0 start-0 my-auto ms-2.5 size-4 text-muted-foreground"></i>
                    <input x-model="q" type="text" placeholder="Search cards…" class="h-9 w-full rounded-lg border border-input bg-background ps-9 pe-3 text-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring sm:w-44">
                </div>
                <x-ui.dropdown align="end" width="w-48">
                    <x-slot:trigger>
                        <button class="flex h-9 items-center gap-2 rounded-lg border border-input px-3 text-sm font-medium hover:bg-accent" :class="label !== 'all' && 'border-primary text-primary'"><i data-lucide="tag" class="size-4"></i>Label <i data-lucide="chevron-down" class="size-3.5"></i></button>
                    </x-slot:trigger>
                    <button @click="label = 'all'" class="flex w-full items-center gap-2.5 rounded-lg px-2.5 py-2 text-sm hover:bg-accent" :class="label === 'all' && 'font-semibold text-primary'"><span class="size-3 rounded bg-muted-foreground/40"></span>All labels</button>
                    <template x-for="(def, key) in labelDefs" :key="key"><button @click="label = key" class="flex w-full items-center gap-2.5 rounded-lg px-2.5 py-2 text-sm hover:bg-accent" :class="label === key && 'font-semibold'"><span class="h-3 w-6 rounded" :class="def[1]"></span><span x-text="def[0]"></span></button></template>
                </x-ui.dropdown>
                <x-ui.dropdown align="end" width="w-52">
                    <x-slot:trigger>
                        <button class="flex h-9 items-center gap-2 rounded-lg border border-input px-3 text-sm font-medium hover:bg-accent" :class="member !== 'all' && 'border-primary text-primary'"><i data-lucide="user" class="size-4"></i>Member <i data-lucide="chevron-down" class="size-3.5"></i></button>
                    </x-slot:trigger>
                    <button @click="member = 'all'" class="flex w-full items-center gap-2.5 rounded-lg px-2.5 py-2 text-sm hover:bg-accent" :class="member === 'all' && 'font-semibold text-primary'"><i data-lucide="users" class="size-4 text-muted-foreground"></i>All members</button>
                    <template x-for="m in members" :key="m"><button @click="member = m" class="flex w-full items-center gap-2.5 rounded-lg px-2.5 py-2 text-sm hover:bg-accent" :class="member === m && 'font-semibold'"><img :src="avatar(m)" class="size-6 rounded-full" alt=""><span x-text="m"></span></button></template>
                </x-ui.dropdown>
                <button x-show="activeFilters() > 0" @click="clear()" class="flex h-9 items-center gap-1.5 rounded-lg px-2.5 text-sm font-medium text-muted-foreground hover:bg-accent hover:text-foreground"><i data-lucide="x" class="size-4"></i>Clear (<span x-text="activeFilters()"></span>)</button>
            </div>
        </div>

        {{-- Board --}}
        <div class="flex items-start gap-4 overflow-x-auto pb-3">
            <template x-for="(col, ci) in columns" :key="col.id">
                <div class="flex w-72 shrink-0 flex-col rounded-xl bg-muted/50" @dragover.prevent @drop.prevent="move(ci, col.cards.length)">
                    <div class="flex items-center gap-2 px-2 py-2.5">
                        <span class="ms-1 size-2.5 shrink-0 rounded-full" :class="col.accent"></span>
                        <input x-model="col.title" class="min-w-0 flex-1 rounded-md border border-transparent bg-transparent px-1.5 py-0.5 text-sm font-semibold hover:border-input focus:border-input focus:bg-background focus:outline-none">
                        <span class="grid min-w-5 place-items-center rounded-full bg-background px-1.5 text-xs font-semibold text-muted-foreground" x-text="shown(col)"></span>
                        <x-ui.dropdown align="end" width="w-40">
                            <x-slot:trigger><button class="grid size-7 place-items-center rounded-lg text-muted-foreground hover:bg-accent"><i data-lucide="ellipsis" class="size-4"></i></button></x-slot:trigger>
                            <button @click="addingCol = ci; draft = ''" class="flex w-full items-center gap-2.5 rounded-lg px-2.5 py-2 text-sm hover:bg-accent"><i data-lucide="plus" class="size-4"></i>Add card</button>
                            <button @click="deleteList(ci)" class="flex w-full items-center gap-2.5 rounded-lg px-2.5 py-2 text-sm text-destructive hover:bg-accent"><i data-lucide="trash-2" class="size-4"></i>Delete list</button>
                        </x-ui.dropdown>
                    </div>

                    <div class="flex max-h-[58vh] min-h-2 flex-1 flex-col gap-2 overflow-y-auto px-2">
                        <template x-for="(card, i) in col.cards" :key="card.id">
                            <div x-show="matches(card)" draggable="true"
                                 @dragstart="start(ci, i)" @dragend="drag = null" @dragover.prevent.stop @drop.prevent.stop="move(ci, i)"
                                 @click="openCard(ci, i)"
                                 class="group cursor-pointer rounded-lg border border-border bg-card p-2.5 shadow-sm transition"
                                 :class="drag && drag.ci === ci && drag.i === i ? 'rotate-2 opacity-50 ring-2 ring-primary' : 'hover:border-primary/40 hover:shadow-md'">
                                <div class="flex flex-wrap gap-1" x-show="card.labels.length"><template x-for="l in card.labels" :key="l"><span class="h-1.5 w-9 rounded-full" :class="labelDefs[l][1]"></span></template></div>
                                <p class="mt-1.5 text-sm font-medium leading-snug" x-text="card.title"></p>
                                <div class="mt-2 flex items-center gap-3 text-xs text-muted-foreground">
                                    <span x-show="card.due" class="flex items-center gap-1 rounded px-1.5 py-0.5" :class="card.overdue ? 'bg-destructive/10 text-destructive' : ''"><i data-lucide="clock" class="size-3.5"></i><span x-text="card.due ? new Date(card.due).toLocaleDateString('en-US',{month:'short',day:'numeric'}) : ''"></span></span>
                                    <span x-show="card.checklist.length" class="flex items-center gap-1" :class="done(card) === card.checklist.length ? 'text-success' : ''"><i data-lucide="square-check-big" class="size-3.5"></i><span x-text="done(card) + '/' + card.checklist.length"></span></span>
                                    <span x-show="card.comments.length" class="flex items-center gap-1"><i data-lucide="message-square" class="size-3.5"></i><span x-text="card.comments.length"></span></span>
                                    <div class="ms-auto flex -space-x-1.5"><template x-for="m in card.members" :key="m"><img :src="avatar(m)" :title="m" class="size-6 rounded-full ring-2 ring-card" alt=""></template></div>
                                </div>
                            </div>
                        </template>
                    </div>

                    <div class="p-2">
                        <div x-show="addingCol === ci" x-cloak>
                            <textarea x-model="draft" @keydown.enter.prevent="addCard(ci)" @keydown.escape="addingCol = null" rows="2" placeholder="Enter a title…" class="w-full resize-none rounded-lg border border-input bg-card px-2.5 py-2 text-sm shadow-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring"></textarea>
                            <div class="mt-1.5 flex items-center gap-2"><x-ui.button size="sm" @click="addCard(ci)">Add card</x-ui.button><button @click="addingCol = null; draft = ''" class="grid size-8 place-items-center rounded-lg text-muted-foreground hover:bg-accent"><i data-lucide="x" class="size-4"></i></button></div>
                        </div>
                        <button x-show="addingCol !== ci" @click="addingCol = ci; draft = ''" class="flex w-full items-center gap-2 rounded-lg px-2.5 py-2 text-sm font-medium text-muted-foreground transition-colors hover:bg-accent hover:text-foreground"><i data-lucide="plus" class="size-4"></i>Add a card</button>
                    </div>
                </div>
            </template>

            {{-- Add list --}}
            <div class="w-72 shrink-0">
                <div x-show="addingList" x-cloak class="rounded-xl bg-muted/50 p-2">
                    <input x-model="listDraft" @keydown.enter="addList()" @keydown.escape="addingList = false" placeholder="Enter list title…" class="w-full rounded-lg border border-input bg-card px-2.5 py-2 text-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring">
                    <div class="mt-1.5 flex items-center gap-2"><x-ui.button size="sm" @click="addList()">Add list</x-ui.button><button @click="addingList = false; listDraft = ''" class="grid size-8 place-items-center rounded-lg text-muted-foreground hover:bg-accent"><i data-lucide="x" class="size-4"></i></button></div>
                </div>
                <button x-show="! addingList" @click="addingList = true" class="flex w-full items-center gap-2 rounded-xl border border-dashed border-border px-3 py-2.5 text-sm font-medium text-muted-foreground transition-colors hover:bg-accent hover:text-foreground"><i data-lucide="plus" class="size-4"></i>Add another list</button>
            </div>
        </div>

        {{-- ===== Card detail modal ===== --}}
        <template x-teleport="body">
            <div x-show="active" x-cloak class="fixed inset-0 z-[100] overflow-y-auto" @keydown.escape.window="active = null">
                <div x-show="active" x-transition:enter="ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="fixed inset-0 bg-background/70 backdrop-blur-sm" @click="active = null"></div>
                <div x-show="active" x-transition:enter="ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-3" x-transition:enter-end="opacity-100 translate-y-0"
                     class="relative mx-auto my-6 w-[92%] max-w-2xl rounded-2xl border border-border bg-card shadow-2xl" x-trap.noscroll="active">
                    <template x-if="active">
                        <div>
                            {{-- header --}}
                            <div class="flex items-start gap-3 border-b border-border p-5">
                                <i data-lucide="credit-card" class="mt-1 size-5 shrink-0 text-muted-foreground"></i>
                                <div class="min-w-0 flex-1">
                                    <input x-model="active.title" class="w-full rounded-md border border-transparent bg-transparent px-1 text-lg font-bold hover:border-input focus:border-input focus:outline-none">
                                    <p class="px-1 text-sm text-muted-foreground">in list <span class="font-medium text-foreground" x-text="columns[activeCi].title"></span></p>
                                </div>
                                <button @click="active = null" class="rounded-lg p-1.5 text-muted-foreground hover:bg-accent"><i data-lucide="x" class="size-5"></i></button>
                            </div>

                            <div class="grid grid-cols-1 gap-6 p-5 sm:grid-cols-[1fr_180px]">
                                {{-- main --}}
                                <div class="min-w-0 space-y-6">
                                    {{-- labels + members preview --}}
                                    <div class="flex flex-wrap gap-4">
                                        <div x-show="active.labels.length"><p class="mb-1 text-xs font-semibold uppercase text-muted-foreground">Labels</p><div class="flex gap-1"><template x-for="l in active.labels" :key="l"><span class="rounded px-2 py-1 text-xs font-semibold text-white" :class="labelDefs[l][1]" x-text="labelDefs[l][0]"></span></template></div></div>
                                        <div x-show="active.members.length"><p class="mb-1 text-xs font-semibold uppercase text-muted-foreground">Members</p><div class="flex -space-x-1.5"><template x-for="m in active.members" :key="m"><img :src="avatar(m)" :title="m" class="size-8 rounded-full ring-2 ring-card" alt=""></template></div></div>
                                        <div x-show="active.due"><p class="mb-1 text-xs font-semibold uppercase text-muted-foreground">Due</p><span class="inline-flex items-center gap-1.5 rounded-lg px-2 py-1 text-sm" :class="active.overdue ? 'bg-destructive/10 text-destructive' : 'bg-muted'"><i data-lucide="clock" class="size-4"></i><span x-text="active.due ? new Date(active.due).toLocaleDateString('en-US',{month:'short',day:'numeric',year:'numeric'}) : ''"></span></span></div>
                                    </div>

                                    {{-- description --}}
                                    <div>
                                        <p class="mb-1.5 flex items-center gap-2 text-sm font-semibold"><i data-lucide="align-left" class="size-4"></i>Description</p>
                                        <textarea x-model="active.desc" rows="3" placeholder="Add a more detailed description…" class="w-full rounded-lg border border-input bg-background px-3 py-2 text-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring"></textarea>
                                    </div>

                                    {{-- checklist --}}
                                    <div>
                                        <div class="mb-1.5 flex items-center justify-between">
                                            <p class="flex items-center gap-2 text-sm font-semibold"><i data-lucide="square-check-big" class="size-4"></i>Checklist</p>
                                            <span class="text-xs text-muted-foreground" x-show="active.checklist.length" x-text="Math.round(done(active) / active.checklist.length * 100) + '%'"></span>
                                        </div>
                                        <div class="mb-2 h-1.5 overflow-hidden rounded-full bg-muted" x-show="active.checklist.length"><div class="h-full rounded-full bg-success transition-all" :style="`width: ${active.checklist.length ? done(active)/active.checklist.length*100 : 0}%`"></div></div>
                                        <div class="space-y-1">
                                            <template x-for="(item, k) in active.checklist" :key="k">
                                                <div class="group/ci flex items-center gap-2.5 rounded-lg px-1.5 py-1 hover:bg-accent/50">
                                                    <input type="checkbox" x-model="item.d" class="size-4 rounded border-input text-primary focus:ring-primary">
                                                    <span class="flex-1 text-sm" :class="item.d && 'text-muted-foreground line-through'" x-text="item.t"></span>
                                                    <button @click="active.checklist.splice(k,1)" class="rounded p-1 text-muted-foreground opacity-0 hover:text-destructive group-hover/ci:opacity-100"><i data-lucide="x" class="size-3.5"></i></button>
                                                </div>
                                            </template>
                                        </div>
                                        <form @submit.prevent="addCheck()" class="mt-1.5 flex gap-2">
                                            <input x-model="newCheck" placeholder="Add an item…" class="h-8 flex-1 rounded-lg border border-input bg-background px-2.5 text-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring">
                                            <x-ui.button size="sm" type="submit">Add</x-ui.button>
                                        </form>
                                    </div>

                                    {{-- comments --}}
                                    <div>
                                        <p class="mb-2 flex items-center gap-2 text-sm font-semibold"><i data-lucide="message-square" class="size-4"></i>Comments</p>
                                        <form @submit.prevent="addComment()" class="mb-3 flex gap-2">
                                            <img :src="avatar('Yrizzz')" class="size-8 shrink-0 rounded-full" alt="">
                                            <input x-model="newComment" placeholder="Write a comment…" class="h-9 flex-1 rounded-lg border border-input bg-background px-3 text-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring">
                                            <x-ui.button size="sm" type="submit" icon="send" class="[&>svg]:rtl-flip" />
                                        </form>
                                        <div class="space-y-3">
                                            <template x-for="(c, k) in active.comments" :key="k">
                                                <div class="flex gap-2.5">
                                                    <img :src="avatar(c.who)" class="size-8 shrink-0 rounded-full" alt="">
                                                    <div class="min-w-0 flex-1"><div class="flex items-center gap-2"><span class="text-sm font-semibold" x-text="c.who"></span><span class="text-xs text-muted-foreground" x-text="c.at"></span></div><p class="mt-0.5 rounded-lg bg-muted/60 px-3 py-1.5 text-sm" x-text="c.t"></p></div>
                                                </div>
                                            </template>
                                        </div>
                                    </div>
                                </div>

                                {{-- sidebar: add to card --}}
                                <div class="space-y-4">
                                    <div>
                                        <p class="mb-1.5 text-xs font-semibold uppercase text-muted-foreground">Members</p>
                                        <div class="flex flex-wrap gap-1">
                                            <template x-for="m in members" :key="m">
                                                <button @click="toggle(active.members, m)" :title="m" class="relative rounded-full ring-offset-1 ring-offset-card transition" :class="active.members.includes(m) ? 'ring-2 ring-primary' : 'opacity-60 hover:opacity-100'"><img :src="avatar(m)" class="size-8 rounded-full" alt=""></button>
                                            </template>
                                        </div>
                                    </div>
                                    <div>
                                        <p class="mb-1.5 text-xs font-semibold uppercase text-muted-foreground">Labels</p>
                                        <div class="grid grid-cols-2 gap-1.5">
                                            <template x-for="(def, key) in labelDefs" :key="key">
                                                <button @click="toggle(active.labels, key)" class="flex items-center gap-1.5 rounded px-2 py-1.5 text-xs font-semibold text-white transition" :class="[def[1], active.labels.includes(key) ? 'ring-2 ring-offset-1 ring-offset-card ring-foreground/30' : 'opacity-70 hover:opacity-100']"><i data-lucide="check" class="size-3" x-show="active.labels.includes(key)"></i><span x-text="def[0]"></span></button>
                                            </template>
                                        </div>
                                    </div>
                                    <div>
                                        <p class="mb-1.5 text-xs font-semibold uppercase text-muted-foreground">Due date</p>
                                        <input type="date" x-model="active.due" class="h-9 w-full rounded-lg border border-input bg-background px-2 text-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring">
                                    </div>
                                    <div class="border-t border-border pt-3">
                                        <button @click="deleteCard()" class="flex w-full items-center gap-2 rounded-lg bg-destructive/10 px-3 py-2 text-sm font-medium text-destructive hover:bg-destructive/15"><i data-lucide="trash-2" class="size-4"></i>Delete card</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </template>
    </div>
</div>
