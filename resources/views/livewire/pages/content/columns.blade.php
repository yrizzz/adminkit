<div>
    <x-page-header :title="'Columns'" subtitle="Utilities · grid columns, spans & responsive layouts">
        <x-slot:actions>
            <x-ui.button variant="outline" icon="arrow-left" class="[&>svg]:rtl-flip" :href="route('dashboard')">Dashboard</x-ui.button>
        </x-slot:actions>
    </x-page-header>

    @php $box = 'grid h-12 place-items-center rounded-lg bg-primary/10 text-xs font-semibold text-primary'; @endphp

    <x-demo-section title="Equal columns" desc="From 2 up to 6 evenly-sized columns." />
    <x-ui.card>
        <div class="space-y-3">
            @foreach (['grid-cols-2' => 2, 'grid-cols-3' => 3, 'grid-cols-4' => 4, 'grid-cols-6' => 6] as $cls => $n)
                <div class="grid {{ $cls }} gap-3">
                    @for ($i = 0; $i < $n; $i++)<div class="{{ $box }}">1/{{ $n }}</div>@endfor
                </div>
            @endforeach
        </div>
    </x-ui.card>

    <x-demo-section title="Column spans" desc="Items spanning multiple tracks in a 12-column grid." />
    <x-ui.card>
        <div class="grid grid-cols-12 gap-3">
            <div class="{{ $box }} col-span-12">col-span-12</div>
            <div class="{{ $box }} col-span-6">col-span-6</div>
            <div class="{{ $box }} col-span-6">col-span-6</div>
            <div class="{{ $box }} col-span-4">col-span-4</div>
            <div class="{{ $box }} col-span-4">col-span-4</div>
            <div class="{{ $box }} col-span-4">col-span-4</div>
            <div class="{{ $box }} col-span-8">col-span-8</div>
            <div class="{{ $box }} col-span-4">col-span-4</div>
        </div>
    </x-ui.card>

    <x-demo-section title="Responsive" desc="Stacks on mobile, splits into columns as the screen grows." />
    <x-ui.card>
        <div class="grid grid-cols-1 gap-3 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6">
            @for ($i = 1; $i <= 6; $i++)<div class="{{ $box }}">{{ $i }}</div>@endfor
        </div>
        <p class="mt-3 text-center text-xs text-muted-foreground"><code>grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6</code></p>
    </x-ui.card>

    <x-demo-section title="Sidebar layout" desc="A fixed-width sidebar next to a fluid content area." />
    <x-ui.card>
        <div class="grid grid-cols-1 gap-3 lg:grid-cols-[220px_1fr]">
            <div class="grid h-32 place-items-center rounded-lg bg-sidebar-primary/10 text-sm font-semibold text-sidebar-primary">Sidebar · 220px</div>
            <div class="grid h-32 place-items-center rounded-lg bg-primary/10 text-sm font-semibold text-primary">Content · 1fr</div>
        </div>
    </x-ui.card>
</div>
