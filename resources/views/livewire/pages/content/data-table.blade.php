<div>
    <x-page-header :title="$pageTitle" subtitle="Tables · search, sort, filter, hide columns & paginate">
        <x-slot:actions>
            <x-ui.badge variant="success" dot>Fully interactive</x-ui.badge>
            <x-ui.button variant="outline" icon="arrow-left" class="[&>svg]:rtl-flip" :href="route('tables')">All tables</x-ui.button>
        </x-slot:actions>
    </x-page-header>

    <x-ui.card :padded="false"
        x-data="{
            q: '', role: 'all', status: 'all',
            sortKey: 'name', sortDir: 'asc',
            page: 1, perPage: 8,
            selected: [],
            columns: [
                { key: 'name',   label: 'Name',    on: true },
                { key: 'role',   label: 'Role',    on: true },
                { key: 'dept',   label: 'Team',    on: true },
                { key: 'status', label: 'Status',  on: true },
                { key: 'joined', label: 'Joined',  on: true },
                { key: 'salary', label: 'Salary',  on: false },
            ],
            rows: [
                { id:1,  name:'Aisha Rahman',   email:'aisha@company.com',  role:'Admin',   dept:'Engineering', status:'Active',    joined:'2023-01-14', salary:9200 },
                { id:2,  name:'David Chen',     email:'david@company.com',  role:'Editor',  dept:'Design',      status:'Active',    joined:'2023-03-02', salary:7400 },
                { id:3,  name:'Sofia Martinez', email:'sofia@company.com',  role:'Viewer',  dept:'Marketing',   status:'Invited',   joined:'2024-06-21', salary:6100 },
                { id:4,  name:'Omar Haddad',    email:'omar@company.com',   role:'Manager', dept:'Sales',       status:'Suspended', joined:'2022-11-08', salary:8800 },
                { id:5,  name:'Priya Sharma',   email:'priya@company.com',  role:'Editor',  dept:'Finance',     status:'Active',    joined:'2023-07-19', salary:7000 },
                { id:6,  name:'Kenji Tanaka',   email:'kenji@company.com',  role:'Admin',   dept:'Engineering', status:'Active',    joined:'2021-05-30', salary:9600 },
                { id:7,  name:'Layla Farouk',   email:'layla@company.com',  role:'Viewer',  dept:'Support',     status:'Active',    joined:'2024-02-11', salary:5400 },
                { id:8,  name:'Marcus Johnson', email:'marcus@company.com', role:'Manager', dept:'Sales',       status:'Invited',   joined:'2024-08-03', salary:8200 },
                { id:9,  name:'Emily Watson',   email:'emily@company.com',  role:'Editor',  dept:'Design',      status:'Active',    joined:'2023-09-27', salary:7300 },
                { id:10, name:'Budi Santoso',   email:'budi@company.com',   role:'Viewer',  dept:'Support',     status:'Suspended', joined:'2022-04-15', salary:5000 },
                { id:11, name:'Citra Dewi',     email:'citra@company.com',  role:'Editor',  dept:'Marketing',   status:'Active',    joined:'2023-12-01', salary:6800 },
                { id:12, name:'Dani Pratama',   email:'dani@company.com',   role:'Admin',   dept:'Engineering', status:'Active',    joined:'2021-10-22', salary:9400 },
                { id:13, name:'Eka Putri',      email:'eka@company.com',    role:'Viewer',  dept:'Finance',     status:'Invited',   joined:'2024-05-09', salary:5900 },
                { id:14, name:'Farhan Ali',     email:'farhan@company.com', role:'Manager', dept:'Sales',       status:'Active',    joined:'2023-02-18', salary:8600 },
                { id:15, name:'Gita Sari',      email:'gita@company.com',   role:'Editor',  dept:'Design',      status:'Active',    joined:'2024-01-30', salary:7100 },
                { id:16, name:'Hasan Yusuf',    email:'hasan@company.com',  role:'Viewer',  dept:'Support',     status:'Suspended', joined:'2022-08-12', salary:5200 },
            ],
            /* ---- computed ---- */
            colOn(key) { return this.columns.find(c => c.key === key)?.on },
            get shownCols() { return this.columns.filter(c => c.on) },
            get filtered() {
                const q = this.q.toLowerCase().trim();
                return this.rows.filter(r =>
                    (! q || (r.name + r.email + r.dept).toLowerCase().includes(q)) &&
                    (this.role === 'all' || r.role === this.role) &&
                    (this.status === 'all' || r.status === this.status)
                );
            },
            get sorted() {
                const k = this.sortKey, dir = this.sortDir === 'asc' ? 1 : -1;
                return [...this.filtered].sort((a, b) => (a[k] > b[k] ? 1 : a[k] < b[k] ? -1 : 0) * dir);
            },
            get pageCount() { return Math.max(1, Math.ceil(this.sorted.length / this.perPage)) },
            get paged() { const s = (this.page - 1) * this.perPage; return this.sorted.slice(s, s + this.perPage) },
            get from() { return this.sorted.length ? (this.page - 1) * this.perPage + 1 : 0 },
            get to() { return Math.min(this.page * this.perPage, this.sorted.length) },
            /* ---- actions ---- */
            sort(key) { if (this.sortKey === key) this.sortDir = this.sortDir === 'asc' ? 'desc' : 'asc'; else { this.sortKey = key; this.sortDir = 'asc' } },
            clampPage() { if (this.page > this.pageCount) this.page = this.pageCount; if (this.page < 1) this.page = 1 },
            resetFilters() { this.q = ''; this.role = 'all'; this.status = 'all'; this.page = 1 },
            get activeFilters() { return (this.q ? 1 : 0) + (this.role !== 'all' ? 1 : 0) + (this.status !== 'all' ? 1 : 0) },
            toggleAll(e) { this.selected = e.target.checked ? this.paged.map(r => r.id) : [] },
            get allChecked() { return this.paged.length && this.paged.every(r => this.selected.includes(r.id)) },
            statusTone(s) { return { Active:'success', Invited:'warning', Suspended:'destructive' }[s] || 'muted' },
            fmt(n) { return '$' + n.toLocaleString() },
            avatar(n) { return 'https://api.dicebear.com/9.x/initials/svg?seed=' + encodeURIComponent(n) + '&backgroundType=gradientLinear' },
        }"
        x-init="$watch('q', () => page = 1); $watch('role', () => page = 1); $watch('status', () => page = 1); $watch('perPage', () => { page = 1 }); $watch('page', () => selected = [])"
        x-effect="paged.length; shownCols.length; sortKey; sortDir; $nextTick(() => window.renderIcons && window.renderIcons())"
    >
        {{-- ══ Toolbar ══ --}}
        <div class="flex flex-col gap-3 border-b border-border p-4 lg:flex-row lg:items-center">
            <div class="relative lg:w-72">
                <i data-lucide="search" class="pointer-events-none absolute inset-y-0 start-0 my-auto ms-3 size-4 text-muted-foreground"></i>
                <input x-model="q" type="text" placeholder="Search name, email or team…" class="h-9 w-full rounded-lg border border-input bg-background ps-9 pe-3 text-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring">
            </div>

            <div class="flex flex-wrap items-center gap-2 lg:ms-auto">
                {{-- Role filter --}}
                <select x-model="role" class="h-9 rounded-lg border border-input bg-background px-3 text-sm" :class="role !== 'all' && 'border-primary text-primary'">
                    <option value="all">All roles</option><option>Admin</option><option>Manager</option><option>Editor</option><option>Viewer</option>
                </select>
                {{-- Status filter --}}
                <select x-model="status" class="h-9 rounded-lg border border-input bg-background px-3 text-sm" :class="status !== 'all' && 'border-primary text-primary'">
                    <option value="all">All statuses</option><option>Active</option><option>Invited</option><option>Suspended</option>
                </select>

                {{-- Column visibility --}}
                <x-ui.dropdown align="end" width="w-48">
                    <x-slot:trigger>
                        <button class="flex h-9 items-center gap-2 rounded-lg border border-input px-3 text-sm font-medium hover:bg-accent"><i data-lucide="columns-3" class="size-4"></i>Columns</button>
                    </x-slot:trigger>
                    <p class="px-2.5 pb-1 pt-1.5 text-xs font-semibold text-muted-foreground">Toggle columns</p>
                    <template x-for="c in columns" :key="c.key">
                        <label class="flex cursor-pointer items-center gap-2.5 rounded-lg px-2.5 py-2 text-sm hover:bg-accent">
                            <input type="checkbox" x-model="c.on" class="size-4 rounded border-input text-primary focus:ring-primary">
                            <span x-text="c.label"></span>
                        </label>
                    </template>
                </x-ui.dropdown>

                <button x-show="activeFilters > 0" @click="resetFilters()" class="flex h-9 items-center gap-1.5 rounded-lg px-2.5 text-sm font-medium text-muted-foreground hover:bg-accent hover:text-foreground">
                    <i data-lucide="x" class="size-4"></i>Clear (<span x-text="activeFilters"></span>)
                </button>
            </div>
        </div>

        {{-- ══ Bulk action bar ══ --}}
        <div x-show="selected.length" x-cloak class="flex items-center gap-3 border-b border-border bg-primary/5 px-4 py-2.5 text-sm">
            <span class="font-medium"><span x-text="selected.length"></span> selected</span>
            <x-ui.button size="sm" variant="outline" icon="mail">Email</x-ui.button>
            <x-ui.button size="sm" variant="outline" icon="download">Export</x-ui.button>
            <x-ui.button size="sm" variant="destructive" icon="trash-2" @click="rows = rows.filter(r => ! selected.includes(r.id)); selected = []; window.toast('Rows deleted', { variant: 'destructive' })">Delete</x-ui.button>
            <button @click="selected = []" class="ms-auto text-muted-foreground hover:text-foreground"><i data-lucide="x" class="size-4"></i></button>
        </div>

        {{-- ══ Table ══ --}}
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-border text-xs uppercase tracking-wide text-muted-foreground">
                        <th class="w-10 ps-4"><input type="checkbox" :checked="allChecked" @change="toggleAll($event)" class="size-4 rounded border-input text-primary focus:ring-primary"></th>
                        <template x-for="c in shownCols" :key="c.key">
                            <th class="p-3 text-start font-medium">
                                <button @click="sort(c.key)" class="inline-flex items-center gap-1 hover:text-foreground">
                                    <span x-text="c.label"></span>
                                    <span class="inline-flex">
                                        <i data-lucide="chevrons-up-down" class="size-3.5 opacity-40" x-show="sortKey !== c.key"></i>
                                        <i data-lucide="arrow-up" class="size-3.5 text-primary" x-show="sortKey === c.key && sortDir === 'asc'"></i>
                                        <i data-lucide="arrow-down" class="size-3.5 text-primary" x-show="sortKey === c.key && sortDir === 'desc'"></i>
                                    </span>
                                </button>
                            </th>
                        </template>
                        <th class="p-3 pe-4 text-end font-medium">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <template x-for="r in paged" :key="r.id">
                        <tr class="border-b border-border last:border-0 transition-colors hover:bg-accent/40" :class="selected.includes(r.id) && 'bg-primary/5'">
                            <td class="ps-4"><input type="checkbox" :value="r.id" x-model="selected" class="size-4 rounded border-input text-primary focus:ring-primary"></td>
                            <td class="p-3" x-show="colOn('name')">
                                <div class="flex items-center gap-2.5">
                                    <img :src="avatar(r.name)" alt="" class="size-8 shrink-0 rounded-full bg-muted">
                                    <div class="min-w-0"><p class="truncate font-medium" x-text="r.name"></p><p class="truncate text-xs text-muted-foreground" x-text="r.email"></p></div>
                                </div>
                            </td>
                            <td class="p-3 text-muted-foreground" x-show="colOn('role')" x-text="r.role"></td>
                            <td class="p-3 text-muted-foreground" x-show="colOn('dept')" x-text="r.dept"></td>
                            <td class="p-3" x-show="colOn('status')"><span class="rounded-full px-2 py-0.5 text-xs font-semibold" :class="{ success:'bg-success/12 text-success', warning:'bg-warning/15 text-[hsl(var(--warning))]', destructive:'bg-destructive/12 text-destructive' }[statusTone(r.status)]" x-text="r.status"></span></td>
                            <td class="p-3 text-muted-foreground" x-show="colOn('joined')" x-text="new Date(r.joined).toLocaleDateString('en-US',{year:'numeric',month:'short',day:'numeric'})"></td>
                            <td class="p-3 font-medium" x-show="colOn('salary')" x-text="fmt(r.salary)"></td>
                            <td class="p-3 pe-4 text-end">
                                <x-ui.dropdown align="end" width="w-36">
                                    <x-slot:trigger><button class="rounded-lg p-1.5 text-muted-foreground hover:bg-accent"><i data-lucide="ellipsis-vertical" class="size-4"></i></button></x-slot:trigger>
                                    <x-ui.dropdown-item icon="eye">View</x-ui.dropdown-item>
                                    <x-ui.dropdown-item icon="pencil">Edit</x-ui.dropdown-item>
                                    <x-ui.dropdown-item icon="trash-2" variant="destructive">Delete</x-ui.dropdown-item>
                                </x-ui.dropdown>
                            </td>
                        </tr>
                    </template>
                    <tr x-show="! paged.length">
                        <td :colspan="shownCols.length + 2" class="p-12 text-center">
                            <div class="flex flex-col items-center gap-2 text-muted-foreground">
                                <i data-lucide="search-x" class="size-8"></i>
                                <p class="text-sm">No people match your filters.</p>
                                <button @click="resetFilters()" class="text-sm font-medium text-primary hover:underline">Clear filters</button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        {{-- ══ Pagination ══ --}}
        <div class="flex flex-col items-center justify-between gap-3 border-t border-border p-4 sm:flex-row">
            <div class="flex items-center gap-4 text-sm text-muted-foreground">
                <div class="flex items-center gap-2">
                    Rows per page
                    <select x-model.number="perPage" class="h-8 rounded-lg border border-input bg-background px-2 text-sm"><option>5</option><option>8</option><option>10</option><option>20</option></select>
                </div>
                <span>Showing <span class="font-medium text-foreground" x-text="from"></span>–<span class="font-medium text-foreground" x-text="to"></span> of <span class="font-medium text-foreground" x-text="sorted.length"></span></span>
            </div>

            <div class="flex items-center gap-1">
                <button @click="page = 1" :disabled="page === 1" class="grid size-8 place-items-center rounded-lg border border-border text-muted-foreground hover:bg-accent disabled:opacity-40"><i data-lucide="chevrons-left" class="rtl-flip size-4"></i></button>
                <button @click="page--" :disabled="page === 1" class="grid size-8 place-items-center rounded-lg border border-border text-muted-foreground hover:bg-accent disabled:opacity-40"><i data-lucide="chevron-left" class="rtl-flip size-4"></i></button>
                <template x-for="n in pageCount" :key="n">
                    <button x-show="Math.abs(n - page) < 3 || n === 1 || n === pageCount" @click="page = n"
                            class="grid size-8 place-items-center rounded-lg text-sm font-medium transition-colors"
                            :class="page === n ? 'bg-primary text-primary-foreground' : 'border border-border text-muted-foreground hover:bg-accent'" x-text="n"></button>
                </template>
                <button @click="page++" :disabled="page === pageCount" class="grid size-8 place-items-center rounded-lg border border-border text-muted-foreground hover:bg-accent disabled:opacity-40"><i data-lucide="chevron-right" class="rtl-flip size-4"></i></button>
                <button @click="page = pageCount" :disabled="page === pageCount" class="grid size-8 place-items-center rounded-lg border border-border text-muted-foreground hover:bg-accent disabled:opacity-40"><i data-lucide="chevrons-right" class="rtl-flip size-4"></i></button>
            </div>
        </div>
    </x-ui.card>

    <p class="mt-3 text-center text-xs text-muted-foreground">Search, sort any column, filter by role/status, hide columns, select rows and paginate — all client-side with Alpine.</p>
</div>
