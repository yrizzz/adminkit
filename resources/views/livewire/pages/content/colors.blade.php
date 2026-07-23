<div x-data="{ copied: null, copy(v) { navigator.clipboard && navigator.clipboard.writeText(v); this.copied = v; window.toast('Copied ' + v); setTimeout(() => this.copied = null, 1200) } }">
    <x-page-header :title="'Colors'" subtitle="Utilities · theme tokens & palette">
        <x-slot:actions>
            <x-ui.button variant="outline" icon="arrow-left" class="[&>svg]:rtl-flip" :href="route('dashboard')">Dashboard</x-ui.button>
        </x-slot:actions>
    </x-page-header>

    <x-demo-section title="Semantic tokens" desc="Theme-aware colors that adapt to light & dark. Click to copy the class." />
    <div class="grid grid-cols-2 gap-3 sm:grid-cols-3 lg:grid-cols-4">
        @foreach ([
            ['primary','bg-primary','text-primary-foreground'],
            ['secondary','bg-secondary','text-secondary-foreground'],
            ['success','bg-success','text-success-foreground'],
            ['warning','bg-[hsl(var(--warning))]','text-white'],
            ['destructive','bg-destructive','text-destructive-foreground'],
            ['info','bg-info','text-info-foreground'],
            ['muted','bg-muted','text-muted-foreground'],
            ['accent','bg-accent','text-accent-foreground'],
        ] as [$name,$bg,$fg])
            <button @click="copy('bg-{{ $name }}')" class="group overflow-hidden rounded-xl border border-border text-start transition hover:shadow-md">
                <div class="flex h-20 items-end p-3 {{ $bg }} {{ $fg }}"><span class="text-xs font-semibold opacity-0 transition group-hover:opacity-100"><i data-lucide="copy" class="size-3.5"></i></span></div>
                <div class="p-2.5"><p class="text-sm font-semibold capitalize">{{ $name }}</p><code class="text-xs text-muted-foreground">bg-{{ $name }}</code></div>
            </button>
        @endforeach
    </div>

    <x-demo-section title="Chart palette" desc="The five accent colors used across charts." />
    <div class="grid grid-cols-5 gap-3">
        @foreach ([1,2,3,4,5] as $n)
            <div class="overflow-hidden rounded-xl border border-border">
                <div class="h-16" style="background: hsl(var(--chart-{{ $n }}))"></div>
                <div class="p-2 text-center"><code class="text-xs text-muted-foreground">chart-{{ $n }}</code></div>
            </div>
        @endforeach
    </div>

    <x-demo-section title="Palette ramps" desc="A selection of Tailwind color scales." />
    <div class="space-y-3">
        @foreach (['rose','amber','emerald','sky','violet','slate'] as $hue)
            <div>
                <p class="mb-1.5 text-sm font-medium capitalize">{{ $hue }}</p>
                <div class="grid grid-cols-5 gap-1.5 sm:grid-cols-10">
                    @foreach ([50,100,200,300,400,500,600,700,800,900] as $shade)
                        <button @click="copy('bg-{{ $hue }}-{{ $shade }}')" class="group relative h-10 rounded-lg ring-1 ring-inset ring-black/5" style="background: var(--color-{{ $hue }}-{{ $shade }})">
                            <span class="absolute inset-x-0 -bottom-5 hidden text-center text-[0.6rem] text-muted-foreground group-hover:block">{{ $shade }}</span>
                        </button>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</div>
