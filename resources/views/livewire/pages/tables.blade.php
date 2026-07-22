<div>
    <x-page-header title="Data Table" subtitle="Sortable, searchable, selectable — powered by Alpine.">
        <x-slot:actions>
            <x-ui.button variant="outline" icon="filter">Filter</x-ui.button>
            <x-ui.button icon="plus" x-on:click="$dispatch('open-modal', 'add-user')">Add User</x-ui.button>
        </x-slot:actions>
    </x-page-header>

    @php
        $roles = ['Admin', 'Editor', 'Viewer', 'Manager'];
        $rows = \App\Models\User::query()->orderBy('id')->get()->map(fn ($u, $i) => [
            'id' => $u->id,
            'name' => $u->name,
            'email' => $u->email,
            'role' => ['Admin','Editor','Viewer','Manager','Editor','Viewer','Manager','Admin','Editor'][$i % 9] ?? 'Viewer',
            'status' => ($i % 4 === 0) ? 'Inactive' : 'Active',
            'joined' => now()->subDays($i * 9 + 3)->format('M d, Y'),
        ])->values();
    @endphp

    <div x-data="{
            q: '',
            sortKey: 'name',
            asc: true,
            selected: [],
            rows: @js($rows),
            get filtered() {
                let r = this.rows.filter(x => (x.name + x.email + x.role).toLowerCase().includes(this.q.toLowerCase()));
                r.sort((a, b) => (a[this.sortKey] > b[this.sortKey] ? 1 : -1) * (this.asc ? 1 : -1));
                return r;
            },
            sort(k) { this.asc = this.sortKey === k ? !this.asc : true; this.sortKey = k; },
            toggleAll(e) { this.selected = e.target.checked ? this.filtered.map(r => r.id) : []; },
        }">
    <x-ui.card :padded="false">
        {{-- Toolbar --}}
        <div class="flex flex-col gap-3 border-b border-border p-4 sm:flex-row sm:items-center sm:justify-between">
            <div class="relative w-full sm:max-w-xs">
                <i data-lucide="search" class="pointer-events-none absolute inset-y-0 start-0 my-auto ms-3 size-4 text-muted-foreground"></i>
                <input x-model="q" type="text" placeholder="Search users…" class="h-10 w-full rounded-lg border border-input bg-background ps-9 pe-3 text-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring">
            </div>
            <div class="flex items-center gap-2">
                <span x-show="selected.length" x-cloak class="text-sm text-muted-foreground"><span x-text="selected.length"></span> selected</span>
                <x-ui.button x-show="selected.length" x-cloak variant="destructive" size="sm" icon="trash-2" @click="window.toast(selected.length + ' users deleted', {variant:'destructive'}); selected = []">Delete</x-ui.button>
                <x-ui.button variant="outline" size="sm" icon="download" @click="window.toast('Exported CSV', {variant:'success'})">Export</x-ui.button>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-border bg-muted/30 text-xs uppercase tracking-wide text-muted-foreground">
                        <th class="w-10 px-4 py-3"><input type="checkbox" @change="toggleAll($event)" class="size-4 rounded border-input text-primary focus:ring-primary"></th>
                        @foreach (['name' => 'User', 'role' => 'Role', 'status' => 'Status', 'joined' => 'Joined'] as $key => $label)
                            <th class="cursor-pointer px-4 py-3 text-start font-semibold hover:text-foreground" @click="sort('{{ $key }}')">
                                <span class="inline-flex items-center gap-1">{{ $label }}<i data-lucide="chevrons-up-down" class="size-3.5 opacity-50"></i></span>
                            </th>
                        @endforeach
                        <th class="px-4 py-3 text-end font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border">
                    <template x-for="row in filtered" :key="row.id">
                        <tr class="transition-colors hover:bg-muted/40" :class="selected.includes(row.id) && 'bg-primary/5'">
                            <td class="px-4 py-3"><input type="checkbox" :value="row.id" x-model="selected" class="size-4 rounded border-input text-primary focus:ring-primary"></td>
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-3">
                                    <span class="grid size-9 place-items-center rounded-full bg-primary/15 text-xs font-semibold text-primary" x-text="row.name.split(' ').map(n=>n[0]).slice(0,2).join('')"></span>
                                    <div>
                                        <p class="font-medium" x-text="row.name"></p>
                                        <p class="text-xs text-muted-foreground" x-text="row.email"></p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3"><span class="rounded-full bg-muted px-2.5 py-0.5 text-xs font-semibold" x-text="row.role"></span></td>
                            <td class="px-4 py-3">
                                <span class="inline-flex items-center gap-1.5 rounded-full px-2.5 py-0.5 text-xs font-semibold"
                                      :class="row.status === 'Active' ? 'bg-success/12 text-success' : 'bg-muted text-muted-foreground'">
                                    <span class="size-1.5 rounded-full bg-current"></span><span x-text="row.status"></span>
                                </span>
                            </td>
                            <td class="px-4 py-3 text-muted-foreground" x-text="row.joined"></td>
                            <td class="px-4 py-3">
                                <div class="flex items-center justify-end gap-1">
                                    <button class="rounded-lg p-1.5 text-muted-foreground hover:bg-accent hover:text-foreground" @click="window.toast('Editing ' + row.name)"><i data-lucide="pencil" class="size-4"></i></button>
                                    <button class="rounded-lg p-1.5 text-muted-foreground hover:bg-destructive/10 hover:text-destructive" @click="window.toast(row.name + ' removed', {variant:'destructive'})"><i data-lucide="trash-2" class="size-4"></i></button>
                                </div>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>

        <div class="flex flex-col items-center justify-between gap-3 border-t border-border p-4 text-sm sm:flex-row">
            <p class="text-muted-foreground">Showing <span class="font-medium text-foreground" x-text="filtered.length"></span> of <span class="font-medium text-foreground" x-text="rows.length"></span> users</p>
            <div class="flex items-center gap-1">
                <x-ui.button variant="outline" size="sm" icon="chevron-left" class="[&>svg]:rtl-flip">Prev</x-ui.button>
                <x-ui.button variant="outline" size="icon-sm">1</x-ui.button>
                <x-ui.button variant="ghost" size="icon-sm">2</x-ui.button>
                <x-ui.button variant="ghost" size="icon-sm">3</x-ui.button>
                <x-ui.button variant="outline" size="sm" iconEnd="chevron-right" class="[&>svg]:rtl-flip">Next</x-ui.button>
            </div>
        </div>
    </x-ui.card>
    </div>

    {{-- Add user modal --}}
    <x-ui.modal name="add-user" title="Add new user">
        <div class="space-y-4">
            <x-ui.input label="Full name" placeholder="Jane Cooper" icon="user" />
            <x-ui.input label="Email" type="email" placeholder="jane@example.com" icon="mail" />
            <div class="grid grid-cols-2 gap-3">
                <x-ui.input label="Role" placeholder="Editor" icon="shield" />
                <x-ui.input label="Department" placeholder="Design" icon="building" />
            </div>
        </div>
        <x-slot:footer>
            <x-ui.button variant="outline" x-on:click="$dispatch('close-modal', 'add-user')">Cancel</x-ui.button>
            <x-ui.button icon="check" x-on:click="$dispatch('close-modal', 'add-user'); window.toast('User created', {variant:'success'})">Save user</x-ui.button>
        </x-slot:footer>
    </x-ui.modal>
</div>
