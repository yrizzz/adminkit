<div>
    <x-page-header :title="'Products'" subtitle="Pages · storefront grid with filters & ratings">
        <x-slot:actions>
            <x-ui.button variant="outline" icon="arrow-left" class="[&>svg]:rtl-flip" :href="route('dashboard')">Dashboard</x-ui.button>
            <x-ui.button icon="plus">Add product</x-ui.button>
        </x-slot:actions>
    </x-page-header>

    <div x-data="{ cat: 'All', cart: 0 }">
        {{-- Toolbar --}}
        <div class="mb-4 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div class="flex flex-wrap gap-2">
                @foreach (['All','Audio','Wearables','Accessories','Cameras'] as $cat)
                    <button @click="cat = '{{ $cat }}'" class="rounded-full border px-3.5 py-1.5 text-sm font-medium transition-colors" :class="cat === '{{ $cat }}' ? 'border-primary bg-primary text-primary-foreground' : 'border-border hover:bg-accent'">{{ $cat }}</button>
                @endforeach
            </div>
            <div class="flex items-center gap-2">
                <span class="hidden items-center gap-1.5 rounded-lg border border-border px-3 py-2 text-sm text-muted-foreground sm:flex"><i data-lucide="shopping-cart" class="size-4"></i><span x-text="cart"></span> items</span>
                <select class="h-9 rounded-lg border border-input bg-background px-3 text-sm"><option>Popular</option><option>Newest</option><option>Price: low to high</option><option>Price: high to low</option></select>
            </div>
        </div>

        {{-- Grid --}}
        <div class="grid grid-cols-2 gap-4 md:grid-cols-3 xl:grid-cols-4">
            @php
                $products = [
                    ['Wireless Headphones','Audio',129.00,4.8,342,true],
                    ['Smart Watch Series 7','Wearables',249.00,4.6,198,false],
                    ['Mechanical Keyboard','Accessories',89.00,4.9,521,true],
                    ['4K Action Camera','Cameras',199.00,4.5,87,false],
                    ['Noise-cancel Earbuds','Audio',159.00,4.7,264,true],
                    ['Fitness Tracker','Wearables',79.00,4.4,412,false],
                    ['USB-C Hub 7-in-1','Accessories',45.00,4.6,156,false],
                    ['Mirrorless Camera','Cameras',899.00,4.9,63,true],
                ];
            @endphp
            @foreach ($products as [$name,$cat,$price,$rating,$sold,$fav])
                <x-ui.card :padded="false" hover class="group overflow-hidden">
                    <div class="relative aspect-square overflow-hidden bg-muted">
                        <img src="https://picsum.photos/seed/{{ urlencode($name) }}/400/400" alt="" loading="lazy" class="size-full object-cover transition-transform duration-300 group-hover:scale-105" />
                        <button class="absolute end-2 top-2 grid size-8 place-items-center rounded-full bg-card/80 text-muted-foreground backdrop-blur transition hover:text-destructive"><i data-lucide="heart" class="size-4 {{ $fav ? 'fill-destructive text-destructive' : '' }}"></i></button>
                        <span class="absolute start-2 top-2"><x-ui.badge variant="muted">{{ $cat }}</x-ui.badge></span>
                    </div>
                    <div class="p-3">
                        <p class="truncate text-sm font-semibold">{{ $name }}</p>
                        <div class="mt-1 flex items-center gap-1 text-xs text-muted-foreground">
                            <i data-lucide="star" class="size-3.5 fill-amber-400 text-amber-400"></i>
                            <span class="font-medium text-foreground">{{ number_format($rating, 1) }}</span>
                            <span>· {{ $sold }} sold</span>
                        </div>
                        <div class="mt-2 flex items-center justify-between">
                            <span class="text-lg font-bold">${{ number_format($price, 2) }}</span>
                            <button @click="cart++; window.toast('Added to cart', { variant: 'success' })" class="grid size-9 place-items-center rounded-lg bg-primary text-primary-foreground transition hover:bg-primary/90"><i data-lucide="plus" class="size-4"></i></button>
                        </div>
                    </div>
                </x-ui.card>
            @endforeach
        </div>
    </div>
</div>
