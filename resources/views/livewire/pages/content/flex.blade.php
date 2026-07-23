<div>
    <x-page-header :title="'Flex'" subtitle="Utilities · direction, justify, align, wrap & grow">
        <x-slot:actions>
            <x-ui.button variant="outline" icon="arrow-left" class="[&>svg]:rtl-flip" :href="route('dashboard')">Dashboard</x-ui.button>
        </x-slot:actions>
    </x-page-header>

    @php $item = 'grid place-items-center rounded-lg bg-primary/10 text-xs font-semibold text-primary'; @endphp

    <x-demo-section title="Justify content" desc="Distribute items along the main axis." />
    <div class="space-y-3">
        @foreach (['justify-start' => 'start','justify-center' => 'center','justify-end' => 'end','justify-between' => 'between','justify-around' => 'around','justify-evenly' => 'evenly'] as $cls => $label)
            <x-ui.card :padded="false">
                <div class="flex items-center gap-3 p-3">
                    <code class="w-32 shrink-0 text-xs text-muted-foreground">{{ $cls }}</code>
                    <div class="flex {{ $cls }} flex-1 gap-2 rounded-lg bg-muted/50 p-2">
                        @for ($i = 0; $i < 3; $i++)<div class="{{ $item }} size-10">{{ $i + 1 }}</div>@endfor
                    </div>
                </div>
            </x-ui.card>
        @endforeach
    </div>

    <x-demo-section title="Align items" desc="Position items along the cross axis." />
    <div class="grid grid-cols-1 gap-3 sm:grid-cols-3">
        @foreach (['items-start' => 'start','items-center' => 'center','items-end' => 'end'] as $cls => $label)
            <x-ui.card>
                <code class="text-xs text-muted-foreground">{{ $cls }}</code>
                <div class="mt-2 flex {{ $cls }} h-28 gap-2 rounded-lg bg-muted/50 p-2">
                    <div class="{{ $item }} h-10 w-10">1</div><div class="{{ $item }} h-16 w-10">2</div><div class="{{ $item }} h-12 w-10">3</div>
                </div>
            </x-ui.card>
        @endforeach
    </div>

    <x-demo-section title="Direction & wrap" desc="Row, column and wrapping flows." />
    <div class="grid grid-cols-1 gap-3 lg:grid-cols-3">
        <x-ui.card><code class="text-xs text-muted-foreground">flex-row</code><div class="mt-2 flex flex-row gap-2 rounded-lg bg-muted/50 p-2">@for($i=0;$i<3;$i++)<div class="{{ $item }} size-10">{{ $i+1 }}</div>@endfor</div></x-ui.card>
        <x-ui.card><code class="text-xs text-muted-foreground">flex-col</code><div class="mt-2 flex flex-col gap-2 rounded-lg bg-muted/50 p-2">@for($i=0;$i<3;$i++)<div class="{{ $item }} h-8 w-full">{{ $i+1 }}</div>@endfor</div></x-ui.card>
        <x-ui.card><code class="text-xs text-muted-foreground">flex-wrap</code><div class="mt-2 flex flex-wrap gap-2 rounded-lg bg-muted/50 p-2">@for($i=0;$i<8;$i++)<div class="{{ $item }} size-10">{{ $i+1 }}</div>@endfor</div></x-ui.card>
    </div>

    <x-demo-section title="Grow & shrink" desc="Let items flex to fill available space." />
    <x-ui.card>
        <div class="space-y-3">
            <div class="flex gap-2"><div class="{{ $item }} h-12 flex-1">flex-1</div><div class="{{ $item }} h-12 flex-1">flex-1</div><div class="{{ $item }} h-12 flex-1">flex-1</div></div>
            <div class="flex gap-2"><div class="{{ $item }} h-12 flex-1">flex-1</div><div class="{{ $item }} h-12 w-24 shrink-0">w-24</div><div class="{{ $item }} h-12 flex-1">flex-1</div></div>
            <div class="flex gap-2"><div class="{{ $item }} h-12 grow">grow</div><div class="{{ $item }} h-12 w-20 shrink-0">fixed</div></div>
        </div>
    </x-ui.card>
</div>
