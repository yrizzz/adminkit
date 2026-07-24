<div>
    <x-page-header :title="$pageTitle" subtitle="Maps · SVG vector map with markers & regions">
        <x-slot:actions><x-ui.button variant="outline" icon="arrow-left" class="[&>svg]:rtl-flip" :href="route('dashboard')">Dashboard</x-ui.button></x-slot:actions>
    </x-page-header>

    <div x-data="{
            sel: 'jakarta',
            cities: {
                sanfran:  { name:'San Francisco', x:14, y:38, users:'4.2k' },
                london:   { name:'London',        x:47, y:28, users:'6.1k' },
                lagos:    { name:'Lagos',         x:49, y:56, users:'2.8k' },
                dubai:    { name:'Dubai',         x:60, y:44, users:'3.4k' },
                jakarta:  { name:'Jakarta',       x:76, y:62, users:'8.4k' },
                tokyo:    { name:'Tokyo',         x:84, y:36, users:'5.9k' },
                sydney:   { name:'Sydney',        x:88, y:76, users:'1.9k' },
            },
        }" class="grid grid-cols-1 gap-4 lg:grid-cols-[1fr_300px]">

        {{-- Vector canvas --}}
        <x-ui.card :padded="false" class="overflow-hidden">
            <div class="relative aspect-[2/1] w-full bg-gradient-to-br from-primary/5 to-sidebar-primary/5">
                {{-- dotted world texture --}}
                <div class="absolute inset-0 opacity-40" style="background-image: radial-gradient(hsl(var(--muted-foreground)/0.4) 1px, transparent 1px); background-size: 14px 14px;"></div>

                {{-- connection arcs --}}
                <svg class="absolute inset-0 size-full" viewBox="0 0 100 50" preserveAspectRatio="none">
                    <template x-for="(c, key) in cities" :key="'arc-' + key">
                        <line x1="76" y1="31" :x2="c.x" :y2="c.y/1.02" stroke="hsl(var(--primary))" stroke-width="0.15" stroke-dasharray="0.6 0.6" opacity="0.35" />
                    </template>
                </svg>

                {{-- markers --}}
                <template x-for="(c, key) in cities" :key="key">
                    <button @click="sel = key" class="group absolute -translate-x-1/2 -translate-y-1/2" :style="`left:${c.x}%; top:${c.y}%`">
                        <span class="relative flex" :class="sel === key ? 'size-4' : 'size-3'">
                            <span class="absolute inline-flex size-full animate-ping rounded-full" :class="sel === key ? 'bg-primary' : 'bg-primary/50'"></span>
                            <span class="relative inline-flex size-full rounded-full ring-2 ring-card" :class="sel === key ? 'bg-primary' : 'bg-sidebar-primary'"></span>
                        </span>
                        <span class="pointer-events-none absolute start-1/2 top-full mt-1 -translate-x-1/2 whitespace-nowrap rounded bg-foreground px-1.5 py-0.5 text-[0.6rem] font-semibold text-background opacity-0 transition group-hover:opacity-100" x-text="c.name"></span>
                    </button>
                </template>
            </div>
        </x-ui.card>

        {{-- Detail + legend --}}
        <div class="space-y-4">
            <x-ui.card>
                <p class="text-xs font-semibold uppercase tracking-wide text-muted-foreground">Selected region</p>
                <p class="mt-1 text-lg font-bold" x-text="cities[sel].name"></p>
                <div class="mt-3 flex items-baseline gap-1"><span class="text-3xl font-bold text-primary" x-text="cities[sel].users"></span><span class="text-sm text-muted-foreground">active users</span></div>
                <x-ui.button size="sm" variant="outline" class="mt-3 w-full" icon="external-link">View region</x-ui.button>
            </x-ui.card>

            <x-ui.card title="Top regions" :padded="false">
                <div class="divide-y divide-border">
                    @foreach ([['🇮🇩','Indonesia','8.4k',96],['🇬🇧','United Kingdom','6.1k',70],['🇯🇵','Japan','5.9k',67],['🇺🇸','United States','4.2k',48],['🇦🇪','UAE','3.4k',39]] as [$flag,$name,$v,$pct])
                        <div class="flex items-center gap-3 p-3">
                            <span class="text-lg">{{ $flag }}</span>
                            <div class="min-w-0 flex-1"><div class="flex justify-between text-sm"><span class="truncate font-medium">{{ $name }}</span><span class="text-muted-foreground">{{ $v }}</span></div><div class="mt-1 h-1.5 overflow-hidden rounded-full bg-muted"><div class="h-full rounded-full bg-primary" style="width: {{ $pct }}%"></div></div></div>
                        </div>
                    @endforeach
                </div>
            </x-ui.card>
        </div>
    </div>

    <x-ui.alert variant="info" class="mt-4">This is a lightweight, dependency-free SVG map — click any pulsing marker to inspect a region. Swap in a full GeoJSON world map when you need real geography.</x-ui.alert>
</div>
