<div>
    <x-page-header :title="'Position'" subtitle="Utilities · relative, absolute, sticky, z-index">
        <x-slot:actions>
            <x-ui.button variant="outline" icon="arrow-left" class="[&>svg]:rtl-flip" :href="route('dashboard')">Dashboard</x-ui.button>
        </x-slot:actions>
    </x-page-header>

    <x-demo-section title="Absolute placement" desc="Pin children to the edges & center of a relative parent." />
    <x-ui.card>
        <div class="relative h-56 rounded-xl border-2 border-dashed border-border bg-muted/30">
            @php $badge = 'absolute rounded-lg bg-primary px-2.5 py-1 text-xs font-semibold text-primary-foreground shadow'; @endphp
            <span class="{{ $badge }} start-2 top-2">top-2 start-2</span>
            <span class="{{ $badge }} end-2 top-2">top-2 end-2</span>
            <span class="{{ $badge }} bottom-2 start-2">bottom-2 start-2</span>
            <span class="{{ $badge }} bottom-2 end-2">bottom-2 end-2</span>
            <span class="{{ $badge }} left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 rtl:translate-x-1/2">centered</span>
            <span class="absolute inset-x-0 top-1/2 mx-auto w-fit -translate-y-1/2 rounded-full bg-card px-3 py-1 text-xs text-muted-foreground shadow-sm" style="margin-top:-2rem">inset-x-0 mx-auto</span>
        </div>
    </x-ui.card>

    <x-demo-section title="Overlay badges" desc="Common absolute patterns — notification dot & corner ribbon." />
    <div class="flex flex-wrap gap-6">
        <div class="relative"><button class="grid size-12 place-items-center rounded-xl border border-border bg-card"><i data-lucide="bell" class="size-5"></i></button><span class="absolute -end-1 -top-1 grid size-5 place-items-center rounded-full bg-destructive text-[0.65rem] font-bold text-white">9</span></div>
        <div class="relative"><x-ui.avatar name="Aisha Rahman" size="lg" /><span class="absolute -end-0.5 -bottom-0.5 size-3.5 rounded-full border-2 border-card bg-success"></span></div>
        <div class="relative overflow-hidden rounded-xl border border-border"><div class="grid size-24 place-items-center bg-muted"><i data-lucide="image" class="size-8 text-muted-foreground"></i></div><span class="absolute -end-6 top-3 w-24 rotate-45 bg-primary py-0.5 text-center text-[0.6rem] font-bold text-primary-foreground">NEW</span></div>
    </div>

    <x-demo-section title="Sticky" desc="An element that sticks while its container scrolls." />
    <x-ui.card :padded="false">
        <div class="h-64 overflow-y-auto">
            <div class="sticky top-0 z-10 border-b border-border bg-card/90 px-5 py-3 backdrop-blur"><p class="text-sm font-semibold">Sticky header</p></div>
            <div class="space-y-2 p-5">
                @for ($i = 1; $i <= 12; $i++)<div class="rounded-lg bg-muted/50 px-4 py-3 text-sm text-muted-foreground">Scrollable row {{ $i }} — keep scrolling, the header stays pinned.</div>@endfor
            </div>
        </div>
    </x-ui.card>

    <x-demo-section title="Z-index stacking" desc="Overlapping layers ordered by z-index." />
    <x-ui.card>
        <div class="relative h-32">
            @foreach ([['z-10','start-0','bg-sky-500'],['z-20','start-10','bg-violet-500'],['z-30','start-20','bg-rose-500'],['z-40','start-32','bg-emerald-500']] as [$z,$pos,$bg])
                <div class="{{ $z }} {{ $pos }} {{ $bg }} absolute top-4 grid size-24 place-items-center rounded-2xl text-sm font-bold text-white shadow-lg ring-4 ring-card">{{ $z }}</div>
            @endforeach
        </div>
    </x-ui.card>
</div>
