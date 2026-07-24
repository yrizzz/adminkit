<div>
    <x-page-header :title="$pageTitle" subtitle="Ui Elements · how images fill their box">
        <x-slot:actions><x-ui.button variant="outline" icon="arrow-left" class="[&>svg]:rtl-flip" :href="route('ui.elements')">All elements</x-ui.button></x-slot:actions>
    </x-page-header>

    <x-ui.alert variant="info" title="What it does" class="mb-4">
        Each box below is the same size with the same wide image inside — only the <code class="rounded bg-muted px-1">object-fit</code> value changes.
    </x-ui.alert>

    <x-demo-section title="Fit values" desc="cover · contain · fill · none · scale-down" />
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-5">
        @foreach ([
            ['object-cover','Cover','Fills the box, cropping the overflow. The usual choice.'],
            ['object-contain','Contain','Fits entirely inside, leaving empty space.'],
            ['object-fill','Fill','Stretches to fill — distorts the aspect ratio.'],
            ['object-none','None','Keeps original size, cropped to the box.'],
            ['object-scale-down','Scale down','The smaller of none and contain.'],
        ] as [$cls,$label,$desc])
            <x-ui.card :padded="false" class="overflow-hidden">
                <div class="h-40 bg-[repeating-conic-gradient(hsl(var(--muted))_0%_25%,transparent_0%_50%)] bg-[length:16px_16px]">
                    <img src="https://picsum.photos/seed/objectfit/900/300" alt="" class="{{ $cls }} size-full" />
                </div>
                <div class="p-3">
                    <code class="text-xs font-semibold text-primary">{{ $cls }}</code>
                    <p class="mt-1 text-xs text-muted-foreground">{{ $desc }}</p>
                </div>
            </x-ui.card>
        @endforeach
    </div>

    <x-demo-section title="Object position" desc="Where the image sits when it's cropped." />
    <div class="grid grid-cols-2 gap-4 sm:grid-cols-5">
        @foreach (['object-top'=>'Top','object-center'=>'Center','object-bottom'=>'Bottom','object-left'=>'Left','object-right'=>'Right'] as $cls => $label)
            <div>
                <div class="h-28 overflow-hidden rounded-xl bg-muted"><img src="https://picsum.photos/seed/objectpos/600/900" alt="" class="{{ $cls }} size-full object-cover" /></div>
                <p class="mt-1.5 text-center text-xs text-muted-foreground">{{ $label }}</p>
            </div>
        @endforeach
    </div>

    <x-demo-section title="In practice" desc="Cover keeps grids tidy regardless of source ratio." />
    <x-ui.card>
        <div class="grid grid-cols-2 gap-3 sm:grid-cols-4">
            @foreach ([['600/900'],['900/600'],['600/600'],['1200/500']] as $i => [$ratio])
                <div class="aspect-square overflow-hidden rounded-xl bg-muted">
                    <img src="https://picsum.photos/seed/mix-{{ $i }}/{{ str_replace('/', '/', $ratio) }}" alt="" class="size-full object-cover" />
                </div>
            @endforeach
        </div>
        <p class="mt-3 text-center text-xs text-muted-foreground">Four differently-shaped sources, one uniform grid.</p>
    </x-ui.card>
</div>
