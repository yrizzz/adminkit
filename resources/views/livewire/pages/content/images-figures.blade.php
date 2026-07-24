<div>
    <x-page-header :title="$pageTitle" subtitle="Ui Elements · image shapes, figures & galleries">
        <x-slot:actions><x-ui.button variant="outline" icon="arrow-left" class="[&>svg]:rtl-flip" :href="route('ui.elements')">All elements</x-ui.button></x-slot:actions>
    </x-page-header>

    <x-demo-section title="Shapes" desc="Rounding options." />
    <x-ui.card>
        <div class="flex flex-wrap items-end gap-6">
            @foreach (['rounded-none'=>'Square','rounded-lg'=>'Rounded','rounded-3xl'=>'Extra rounded','rounded-full'=>'Circle'] as $cls => $label)
                <div class="text-center">
                    <img src="https://picsum.photos/seed/shape-{{ $loop->index }}/200/200" alt="" class="size-24 {{ $cls }} object-cover" />
                    <p class="mt-2 text-xs text-muted-foreground">{{ $label }}</p>
                </div>
            @endforeach
            <div class="text-center">
                <img src="https://picsum.photos/seed/thumb/200/200" alt="" class="size-24 rounded-lg border-4 border-border object-cover" />
                <p class="mt-2 text-xs text-muted-foreground">Thumbnail</p>
            </div>
        </div>
    </x-ui.card>

    <x-demo-section title="Aspect ratios" desc="Consistent proportions at any width." />
    <div class="grid grid-cols-2 gap-4 sm:grid-cols-4">
        @foreach (['aspect-square'=>'1:1','aspect-video'=>'16:9','aspect-[4/3]'=>'4:3','aspect-[3/4]'=>'3:4'] as $cls => $label)
            <div>
                <div class="{{ $cls }} overflow-hidden rounded-xl bg-muted"><img src="https://picsum.photos/seed/ratio-{{ $loop->index }}/600/600" alt="" class="size-full object-cover" /></div>
                <p class="mt-1.5 text-center text-xs text-muted-foreground">{{ $label }}</p>
            </div>
        @endforeach
    </div>

    <x-demo-section title="Figures" desc="Images with captions." />
    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
        <figure class="overflow-hidden rounded-xl border border-border">
            <img src="https://picsum.photos/seed/figure-a/800/450" alt="" class="aspect-video w-full object-cover" />
            <figcaption class="px-4 py-3 text-sm text-muted-foreground"><span class="font-medium text-foreground">Fig 1.</span> A caption sitting below the image inside the frame.</figcaption>
        </figure>
        <figure>
            <img src="https://picsum.photos/seed/figure-b/800/450" alt="" class="aspect-video w-full rounded-xl object-cover" />
            <figcaption class="mt-2 text-center text-sm text-muted-foreground">A caption underneath, centred.</figcaption>
        </figure>
    </div>

    <x-demo-section title="Gallery & overlay" desc="Grids and hover states." />
    <x-ui.card>
        <div class="grid grid-cols-2 gap-3 sm:grid-cols-4">
            @for ($i = 1; $i <= 8; $i++)
                <button class="group relative aspect-square overflow-hidden rounded-xl bg-muted">
                    <img src="https://picsum.photos/seed/gal-{{ $i }}/400/400" alt="" class="size-full object-cover transition-transform duration-300 group-hover:scale-110" />
                    <span class="absolute inset-0 grid place-items-center bg-black/50 opacity-0 transition-opacity group-hover:opacity-100">
                        <i data-lucide="maximize-2" class="size-5 text-white"></i>
                    </span>
                </button>
            @endfor
        </div>
    </x-ui.card>
</div>
