<div>
    <x-page-header :title="'Contacts Pro'" subtitle="Directory · grid & list views with search, status filters & detail drawer">
        <x-slot:actions>
            <x-ui.button variant="outline" icon="arrow-left" class="[&>svg]:rtl-flip" :href="route('dashboard')">Dashboard</x-ui.button>
            <x-ui.button icon="plus" @click="window.toast('New contact modal', {variant:'info'})">New contact</x-ui.button>
        </x-slot:actions>
    </x-page-header>

    <div x-data="{
            view: 'grid',
            q: '',
            tagFilter: 'All',
            selected: 0,
            contacts: [
                { id: 1, name: 'Aisha Rahman', role: 'Product Designer', company: 'Northwind Tech', email: 'aisha@northwind.co', phone: '+62 812 1111 2222', city: 'Jakarta', tag: 'Client', tone: 'success' },
                { id: 2, name: 'David Chen', role: 'Engineering Lead', company: 'Orbit Systems', email: 'david@orbit.io', phone: '+62 813 3333 4444', city: 'Bandung', tag: 'Partner', tone: 'info' },
                { id: 3, name: 'Sofia Martinez', role: 'Marketing Manager', company: 'Lumen Digital', email: 'sofia@lumen.com', phone: '+62 811 5555 6666', city: 'Surabaya', tag: 'Lead', tone: 'warning' },
                { id: 4, name: 'Omar Haddad', role: 'Sales Executive', company: 'Vertex Solutions', email: 'omar@vertex.co', phone: '+62 812 7777 8888', city: 'Medan', tag: 'Client', tone: 'success' },
                { id: 5, name: 'Priya Sharma', role: 'Data Analyst', company: 'Cobalt Labs', email: 'priya@cobalt.io', phone: '+62 814 9999 0000', city: 'Bali', tag: 'Lead', tone: 'warning' },
                { id: 6, name: 'Kenji Tanaka', role: 'Backend Engineer', company: 'CyberPulse', email: 'kenji@cyberpulse.dev', phone: '+62 815 2222 3333', city: 'Yogyakarta', tag: 'Partner', tone: 'info' },
            ],
            get filtered() {
                const t = this.q.toLowerCase();
                return this.contacts.filter(c => {
                    const matchQ = (c.name + c.company + c.role + c.email).toLowerCase().includes(t);
                    const matchTag = this.tagFilter === 'All' || c.tag === this.tagFilter;
                    return matchQ && matchTag;
                });
            },
            get active() { return this.contacts[this.selected] || this.contacts[0]; }
         }"
         class="space-y-4">

        {{-- Toolbar --}}
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div class="flex flex-wrap items-center gap-2">
                <template x-for="tf in ['All','Client','Partner','Lead']" :key="tf">
                    <button type="button" @click="tagFilter = tf"
                            class="rounded-full border px-4 py-1.5 text-sm font-medium transition-colors"
                            :class="tagFilter === tf ? 'border-primary bg-primary text-primary-foreground shadow-sm' : 'border-border bg-card hover:bg-accent text-foreground'">
                        <span x-text="tf"></span>
                    </button>
                </template>
            </div>

            <div class="flex items-center gap-2.5">
                <div class="relative flex-1 sm:w-64 sm:flex-none">
                    <i data-lucide="search" class="pointer-events-none absolute inset-y-0 start-0 my-auto ms-3 size-4 text-muted-foreground"></i>
                    <input x-model="q" type="text" placeholder="Search contacts..."
                           class="h-9 w-full rounded-lg border border-input bg-background ps-9 pe-3 text-sm focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring">
                </div>

                <div class="flex items-center gap-1 rounded-lg border border-border bg-card p-1">
                    <button type="button" @click="view = 'grid'" title="Grid view"
                            class="grid size-7 place-items-center rounded-md transition-colors"
                            :class="view === 'grid' ? 'bg-primary text-primary-foreground shadow-sm' : 'text-muted-foreground hover:bg-accent'">
                        <i data-lucide="layout-grid" class="size-4"></i>
                    </button>
                    <button type="button" @click="view = 'list'" title="List view"
                            class="grid size-7 place-items-center rounded-md transition-colors"
                            :class="view === 'list' ? 'bg-primary text-primary-foreground shadow-sm' : 'text-muted-foreground hover:bg-accent'">
                        <i data-lucide="list" class="size-4"></i>
                    </button>
                </div>
            </div>
        </div>

        {{-- Grid View --}}
        <div x-show="view === 'grid'" class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
            <template x-for="(c, i) in filtered" :key="c.id">
                <x-ui.card hover class="group relative flex flex-col justify-between">
                    <div>
                        <div class="flex items-start justify-between">
                            <span class="grid size-12 place-items-center rounded-2xl bg-gradient-to-br from-primary to-sidebar-primary text-base font-bold text-white shadow-md"
                                  x-text="c.name.split(' ').map(w => w[0]).slice(0,2).join('')"></span>
                            <span class="rounded-full px-2.5 py-0.5 text-xs font-semibold"
                                  :class="{ Client: 'bg-success/15 text-success', Partner: 'bg-info/15 text-info', Lead: 'bg-warning/15 text-[hsl(var(--warning))]' }[c.tag]"
                                  x-text="c.tag"></span>
                        </div>
                        <h3 class="mt-4 text-base font-bold" x-text="c.name"></h3>
                        <p class="text-xs text-muted-foreground" x-text="c.role + ' · ' + c.company"></p>
                        <div class="mt-4 space-y-2 border-t border-border pt-3 text-xs text-muted-foreground">
                            <p class="flex items-center gap-2 truncate"><i data-lucide="mail" class="size-3.5 text-primary"></i> <span x-text="c.email"></span></p>
                            <p class="flex items-center gap-2"><i data-lucide="phone" class="size-3.5 text-primary"></i> <span x-text="c.phone"></span></p>
                            <p class="flex items-center gap-2"><i data-lucide="map-pin" class="size-3.5 text-primary"></i> <span x-text="c.city"></span></p>
                        </div>
                    </div>
                    <div class="mt-5 flex gap-2 border-t border-border pt-3">
                        <x-ui.button size="sm" variant="outline" class="flex-1" icon="mail" @click="window.toast('Email sent to ' + c.name, {variant:'success'})">Email</x-ui.button>
                        <x-ui.button size="sm" variant="outline" class="flex-1" icon="phone" @click="window.toast('Calling ' + c.name, {variant:'info'})">Call</x-ui.button>
                    </div>
                </x-ui.card>
            </template>
        </div>

        {{-- List View with Detail Drawer --}}
        <div x-show="view === 'list'" class="grid grid-cols-1 gap-4 lg:grid-cols-[1fr_360px]">
            <x-ui.card :padded="false">
                <div class="divide-y divide-border">
                    <template x-for="(c, i) in filtered" :key="c.id">
                        <button type="button" @click="selected = contacts.indexOf(c)"
                                class="flex w-full items-center gap-3 p-3.5 text-start transition-colors"
                                :class="active === c ? 'bg-primary/10' : 'hover:bg-accent/50'">
                            <span class="grid size-10 shrink-0 place-items-center rounded-full bg-gradient-to-br from-primary to-sidebar-primary text-sm font-semibold text-white"
                                  x-text="c.name.split(' ').map(w => w[0]).slice(0,2).join('')"></span>
                            <div class="min-w-0 flex-1">
                                <p class="truncate text-sm font-semibold" x-text="c.name"></p>
                                <p class="truncate text-xs text-muted-foreground" x-text="c.role + ' · ' + c.company"></p>
                            </div>
                            <span class="shrink-0 rounded-full px-2 py-0.5 text-xs font-semibold"
                                  :class="{ Client: 'bg-success/15 text-success', Partner: 'bg-info/15 text-info', Lead: 'bg-warning/15 text-[hsl(var(--warning))]' }[c.tag]"
                                  x-text="c.tag"></span>
                        </button>
                    </template>
                </div>
            </x-ui.card>

            <x-ui.card class="lg:sticky lg:top-32 lg:self-start">
                <div class="flex flex-col items-center text-center">
                    <span class="grid size-20 place-items-center rounded-full bg-gradient-to-br from-primary to-sidebar-primary text-2xl font-bold text-white shadow-lg"
                          x-text="active.name.split(' ').map(w => w[0]).slice(0,2).join('')"></span>
                    <h3 class="mt-3 text-lg font-bold" x-text="active.name"></h3>
                    <p class="text-sm text-muted-foreground" x-text="active.role + ' · ' + active.company"></p>
                    <div class="mt-4 flex gap-2">
                        <x-ui.button size="sm" icon="mail" @click="window.toast('Email sent', {variant:'success'})">Email</x-ui.button>
                        <x-ui.button size="sm" variant="outline" icon="phone" @click="window.toast('Calling...', {variant:'info'})">Call</x-ui.button>
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
</div>
