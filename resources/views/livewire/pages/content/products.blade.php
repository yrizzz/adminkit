<div>
    <x-page-header :title="'Products Pro'" subtitle="Storefront inventory · grid and list views with live search & filters">
        <x-slot:actions>
            <x-ui.button variant="outline" icon="arrow-left" class="[&>svg]:rtl-flip" :href="route('dashboard')">Dashboard</x-ui.button>
            <x-ui.button icon="plus" @click="window.toast('New product modal', {variant:'info'})">Add product</x-ui.button>
        </x-slot:actions>
    </x-page-header>

    <div x-data="{
        view: 'grid',
        cat: 'All',
        q: '',
        cart: 0,
        products: [
            { id: 1, name: 'Wireless Noise-Canceling Headphones', cat: 'Audio', price: 129.00, rating: 4.8, sold: 342, stock: 45, status: 'In Stock', fav: true },
            { id: 2, name: 'Smart Watch Series 7 Pro', cat: 'Wearables', price: 249.00, rating: 4.6, sold: 198, stock: 12, status: 'Low Stock', fav: false },
            { id: 3, name: 'RGB Mechanical Gaming Keyboard', cat: 'Accessories', price: 89.00, rating: 4.9, sold: 521, stock: 88, status: 'In Stock', fav: true },
            { id: 4, name: 'Ultra HD 4K Action Camera', cat: 'Cameras', price: 199.00, rating: 4.5, sold: 87, stock: 0, status: 'Out of Stock', fav: false },
            { id: 5, name: 'True Wireless Noise-Cancel Earbuds', cat: 'Audio', price: 159.00, rating: 4.7, sold: 264, stock: 30, status: 'In Stock', fav: true },
            { id: 6, name: 'Fitness & Health Tracker Band', cat: 'Wearables', price: 79.00, rating: 4.4, sold: 412, stock: 65, status: 'In Stock', fav: false },
            { id: 7, name: 'Multi-Port USB-C Aluminum Hub', cat: 'Accessories', price: 45.00, rating: 4.6, sold: 156, stock: 5, status: 'Low Stock', fav: false },
            { id: 8, name: 'Full-Frame Mirrorless Pro Camera', cat: 'Cameras', price: 899.00, rating: 4.9, sold: 63, stock: 18, status: 'In Stock', fav: true },
        ],
        get filtered() {
            return this.products.filter(p => {
                const matchCat = this.cat === 'All' || p.cat === this.cat;
                const matchQ = !this.q || p.name.toLowerCase().includes(this.q.toLowerCase());
                return matchCat && matchQ;
            });
        }
    }">
        {{-- Toolbar --}}
        <div class="mb-5 flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
            {{-- Category Filter --}}
            <div class="flex flex-wrap items-center gap-2">
                <template x-for="c in ['All','Audio','Wearables','Accessories','Cameras']" :key="c">
                    <button type="button" @click="cat = c"
                            class="rounded-full border px-4 py-1.5 text-sm font-medium transition-all"
                            :class="cat === c ? 'border-primary bg-primary text-primary-foreground shadow-sm' : 'border-border bg-card hover:bg-accent text-foreground'">
                        <span x-text="c"></span>
                    </button>
                </template>
            </div>

            {{-- Search & View Toggle --}}
            <div class="flex flex-wrap items-center gap-2.5">
                <div class="relative min-w-[200px] flex-1 sm:w-64 sm:flex-none">
                    <i data-lucide="search" class="pointer-events-none absolute inset-y-0 start-0 my-auto ms-3 size-4 text-muted-foreground"></i>
                    <input x-model="q" type="text" placeholder="Search products..."
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

                <span class="inline-flex items-center gap-2 rounded-lg border border-border bg-card px-3 py-1.5 text-sm font-medium">
                    <i data-lucide="shopping-cart" class="size-4 text-primary"></i>
                    <span x-text="cart"></span> <span class="text-xs text-muted-foreground">items</span>
                </span>
            </div>
        </div>

        {{-- Products Grid View --}}
        <div x-show="view === 'grid'" class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            <template x-for="p in filtered" :key="p.id">
                <x-ui.card :padded="false" hover class="group overflow-hidden">
                    <div class="relative aspect-square overflow-hidden bg-muted">
                        <img :src="'https://picsum.photos/seed/' + encodeURIComponent(p.name) + '/400/400'" :alt="p.name" loading="lazy" class="size-full object-cover transition-transform duration-300 group-hover:scale-105" />
                        <button type="button" @click="p.fav = !p.fav" class="absolute end-2 top-2 grid size-8 place-items-center rounded-full bg-card/80 text-muted-foreground backdrop-blur transition hover:text-destructive">
                            <i data-lucide="heart" class="size-4" :class="p.fav ? 'fill-destructive text-destructive' : ''"></i>
                        </button>
                        <span class="absolute start-2 top-2"><x-ui.badge variant="muted" x-text="p.cat"></x-ui.badge></span>
                    </div>
                    <div class="p-4">
                        <p class="truncate text-sm font-semibold" x-text="p.name"></p>
                        <div class="mt-1 flex items-center justify-between text-xs">
                            <span class="flex items-center gap-1 text-muted-foreground">
                                <i data-lucide="star" class="size-3.5 fill-amber-400 text-amber-400"></i>
                                <span class="font-medium text-foreground" x-text="p.rating"></span>
                                <span>· <span x-text="p.sold"></span> sold</span>
                            </span>
                            <span class="font-semibold" :class="p.stock > 10 ? 'text-success' : (p.stock > 0 ? 'text-[hsl(var(--warning))]' : 'text-destructive')" x-text="p.status"></span>
                        </div>
                        <div class="mt-3 flex items-center justify-between border-t border-border pt-3">
                            <span class="text-lg font-bold" x-text="'$' + p.price.toFixed(2)"></span>
                            <button type="button" @click="cart++; window.toast('Added ' + p.name + ' to cart', { variant: 'success' })"
                                    class="grid size-9 place-items-center rounded-lg bg-primary text-primary-foreground transition hover:bg-primary/90">
                                <i data-lucide="plus" class="size-4"></i>
                            </button>
                        </div>
                    </div>
                </x-ui.card>
            </template>
        </div>

        {{-- Products List View --}}
        <div x-show="view === 'list'" class="space-y-3">
            <template x-for="p in filtered" :key="p.id">
                <x-ui.card :padded="false" hover class="group overflow-hidden">
                    <div class="flex flex-col sm:flex-row sm:items-center">
                        <div class="relative h-44 w-full shrink-0 overflow-hidden bg-muted sm:h-32 sm:w-44">
                            <img :src="'https://picsum.photos/seed/' + encodeURIComponent(p.name) + '/400/400'" :alt="p.name" loading="lazy" class="size-full object-cover transition-transform duration-300 group-hover:scale-105" />
                            <span class="absolute start-2 top-2"><x-ui.badge variant="muted" x-text="p.cat"></x-ui.badge></span>
                        </div>
                        <div class="flex flex-1 flex-col justify-between p-4 sm:flex-row sm:items-center">
                            <div class="min-w-0 flex-1 pe-4">
                                <h3 class="truncate text-base font-semibold" x-text="p.name"></h3>
                                <div class="mt-1 flex flex-wrap items-center gap-3 text-xs text-muted-foreground">
                                    <span class="flex items-center gap-1">
                                        <i data-lucide="star" class="size-3.5 fill-amber-400 text-amber-400"></i>
                                        <span class="font-medium text-foreground" x-text="p.rating"></span>
                                        <span>(<span x-text="p.sold"></span> sold)</span>
                                    </span>
                                    <span>·</span>
                                    <span>Stock: <strong class="text-foreground" x-text="p.stock"></strong></span>
                                    <span>·</span>
                                    <span class="font-semibold" :class="p.stock > 10 ? 'text-success' : (p.stock > 0 ? 'text-[hsl(var(--warning))]' : 'text-destructive')" x-text="p.status"></span>
                                </div>
                            </div>
                            <div class="mt-3 flex items-center justify-between gap-4 border-t border-border pt-3 sm:mt-0 sm:border-0 sm:pt-0">
                                <span class="text-xl font-bold" x-text="'$' + p.price.toFixed(2)"></span>
                                <x-ui.button size="sm" icon="shopping-cart" @click="cart++; window.toast('Added ' + p.name + ' to cart', { variant: 'success' })">Add to cart</x-ui.button>
                            </div>
                        </div>
                    </div>
                </x-ui.card>
            </template>
        </div>
    </div>
</div>
