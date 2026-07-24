<div x-data="{
        active: 0,
        places: [
            { name:'AdminKit HQ',      addr:'Jl. Sudirman No. 45, Jakarta',   q:'Jakarta',   type:'Headquarters', ic:'building-2', tone:'text-primary bg-primary/10' },
            { name:'Design Studio',    addr:'Orchard Rd, Singapore',          q:'Singapore', type:'Office',       ic:'palette',    tone:'text-info bg-info/10' },
            { name:'Engineering Hub',  addr:'Shibuya, Tokyo, Japan',          q:'Tokyo',     type:'Office',       ic:'code',       tone:'text-success bg-success/10' },
            { name:'Support Center',   addr:'Bali, Indonesia',                q:'Bali',      type:'Support',      ic:'life-buoy',  tone:'text-[hsl(var(--warning))] bg-warning/10' },
        ],
        get current() { return this.places[this.active] },
     }">
    <x-page-header :title="$pageTitle" subtitle="Maps · embedded interactive map with location pins">
        <x-slot:actions><x-ui.button variant="outline" icon="arrow-left" class="[&>svg]:rtl-flip" :href="route('dashboard')">Dashboard</x-ui.button></x-slot:actions>
    </x-page-header>

    <div class="grid grid-cols-1 gap-4 lg:grid-cols-[340px_1fr]">
        {{-- Locations list --}}
        <x-ui.card :padded="false" class="flex flex-col">
            <div class="border-b border-border p-3"><x-ui.input placeholder="Search locations…" icon="search" /></div>
            <div class="divide-y divide-border overflow-y-auto">
                <template x-for="(p, i) in places" :key="p.name">
                    <button @click="active = i" class="flex w-full items-start gap-3 p-3 text-start transition-colors" :class="active === i ? 'bg-primary/5' : 'hover:bg-accent/50'">
                        <span class="grid size-10 shrink-0 place-items-center rounded-xl" :class="p.tone"><i :data-lucide="p.ic" class="size-5"></i></span>
                        <div class="min-w-0 flex-1"><p class="truncate text-sm font-semibold" x-text="p.name"></p><p class="truncate text-xs text-muted-foreground" x-text="p.addr"></p></div>
                        <span class="shrink-0 rounded-full bg-muted px-2 py-0.5 text-[0.65rem] font-semibold text-muted-foreground" x-text="p.type"></span>
                    </button>
                </template>
            </div>
        </x-ui.card>

        {{-- Map + detail --}}
        <div class="space-y-4">
            <x-ui.card :padded="false" class="overflow-hidden">
                <div class="aspect-[16/10] w-full bg-muted">
                    <iframe :src="`https://maps.google.com/maps?q=${encodeURIComponent(current.q)}&t=&z=11&ie=UTF8&iwloc=&output=embed`"
                            class="size-full border-0" loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="Map"></iframe>
                </div>
            </x-ui.card>

            <x-ui.card>
                <div class="flex flex-wrap items-start justify-between gap-4">
                    <div class="flex items-start gap-3">
                        <span class="grid size-11 shrink-0 place-items-center rounded-xl" :class="current.tone"><i :data-lucide="current.ic" class="size-5"></i></span>
                        <div>
                            <p class="font-semibold" x-text="current.name"></p>
                            <p class="text-sm text-muted-foreground" x-text="current.addr"></p>
                            <div class="mt-2 flex gap-2">
                                <x-ui.button size="sm" icon="navigation" x-on:click="window.toast('Opening directions…')">Directions</x-ui.button>
                                <x-ui.button size="sm" variant="outline" icon="phone">Call</x-ui.button>
                                <x-ui.button size="sm" variant="outline" icon="share-2">Share</x-ui.button>
                            </div>
                        </div>
                    </div>
                    <x-ui.badge variant="success" class="shrink-0">Open now</x-ui.badge>
                </div>
            </x-ui.card>
        </div>
    </div>
</div>
