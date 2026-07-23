<div>
    <x-page-header :title="$pageTitle" subtitle="Pages · searchable directory with detail panel">
        <x-slot:actions>
            <x-ui.button variant="outline" icon="arrow-left" class="[&>svg]:rtl-flip" :href="route('dashboard')">Dashboard</x-ui.button>
            <x-ui.button icon="plus">New contact</x-ui.button>
        </x-slot:actions>
    </x-page-header>

    <div x-data="{
            q: '',
            selected: 0,
            contacts: [
                { name: 'Aisha Rahman', role: 'Product Designer', company: 'Northwind', email: 'aisha@northwind.co', phone: '+62 812 1111 2222', city: 'Jakarta', tag: 'Client', tone: 'success' },
                { name: 'David Chen', role: 'Engineering Lead', company: 'Orbit', email: 'david@orbit.io', phone: '+62 813 3333 4444', city: 'Bandung', tag: 'Partner', tone: 'info' },
                { name: 'Sofia Martinez', role: 'Marketing Manager', company: 'Lumen', email: 'sofia@lumen.com', phone: '+62 811 5555 6666', city: 'Surabaya', tag: 'Lead', tone: 'warning' },
                { name: 'Omar Haddad', role: 'Sales Executive', company: 'Vertex', email: 'omar@vertex.co', phone: '+62 812 7777 8888', city: 'Medan', tag: 'Client', tone: 'success' },
                { name: 'Priya Sharma', role: 'Data Analyst', company: 'Cobalt', email: 'priya@cobalt.io', phone: '+62 814 9999 0000', city: 'Bali', tag: 'Lead', tone: 'warning' },
            ],
            get filtered() { const t = this.q.toLowerCase(); return this.contacts.filter(c => (c.name + c.company + c.role).toLowerCase().includes(t)); },
            get active() { return this.contacts[this.selected]; },
         }"
         class="grid grid-cols-1 gap-4 lg:grid-cols-[1fr_360px]">
        {{-- List --}}
        <x-ui.card :padded="false">
            <div class="border-b border-border p-3"><x-ui.input x-model="q" placeholder="Search contacts…" icon="search" /></div>
            <div class="divide-y divide-border">
                <template x-for="(c, i) in filtered" :key="c.email">
                    <button type="button" @click="selected = contacts.indexOf(c)" class="flex w-full items-center gap-3 p-3 text-start transition-colors" :class="active === c ? 'bg-primary/5' : 'hover:bg-accent/50'">
                        <span class="grid size-10 shrink-0 place-items-center rounded-full bg-gradient-to-br from-primary to-sidebar-primary text-sm font-semibold text-white" x-text="c.name.split(' ').map(w => w[0]).slice(0,2).join('')"></span>
                        <div class="min-w-0 flex-1"><p class="truncate text-sm font-semibold" x-text="c.name"></p><p class="truncate text-xs text-muted-foreground" x-text="c.role + ' · ' + c.company"></p></div>
                        <span class="shrink-0 rounded-full px-2 py-0.5 text-xs font-semibold"
                              :class="{ success: 'bg-success/12 text-success', info: 'bg-info/12 text-info', warning: 'bg-warning/15 text-[hsl(var(--warning))]' }[c.tone]" x-text="c.tag"></span>
                    </button>
                </template>
                <div x-show="filtered.length === 0" class="p-8 text-center text-sm text-muted-foreground">No contacts found.</div>
            </div>
        </x-ui.card>

        {{-- Detail --}}
        <x-ui.card class="lg:sticky lg:top-32 lg:self-start">
            <div class="flex flex-col items-center text-center">
                <span class="grid size-20 place-items-center rounded-full bg-gradient-to-br from-primary to-sidebar-primary text-2xl font-bold text-white" x-text="active.name.split(' ').map(w => w[0]).slice(0,2).join('')"></span>
                <h3 class="mt-3 text-lg font-bold" x-text="active.name"></h3>
                <p class="text-sm text-muted-foreground" x-text="active.role + ' · ' + active.company"></p>
                <div class="mt-4 flex gap-2">
                    <x-ui.button size="sm" icon="mail">Email</x-ui.button>
                    <x-ui.button size="sm" variant="outline" icon="phone">Call</x-ui.button>
                    <x-ui.button size="sm" variant="outline" icon="message-square">Chat</x-ui.button>
                </div>
            </div>
            <div class="mt-6 space-y-3 border-t border-border pt-5 text-sm">
                <div class="flex items-center gap-3"><i data-lucide="mail" class="size-4 text-muted-foreground"></i><span x-text="active.email"></span></div>
                <div class="flex items-center gap-3"><i data-lucide="phone" class="size-4 text-muted-foreground"></i><span x-text="active.phone"></span></div>
                <div class="flex items-center gap-3"><i data-lucide="map-pin" class="size-4 text-muted-foreground"></i><span x-text="active.city"></span></div>
                <div class="flex items-center gap-3"><i data-lucide="building-2" class="size-4 text-muted-foreground"></i><span x-text="active.company"></span></div>
            </div>
        </x-ui.card>
    </div>
</div>
