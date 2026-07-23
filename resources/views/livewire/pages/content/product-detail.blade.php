<div>
    <x-page-header :title="'Product Detail'" subtitle="Pages · gallery, variants & add to cart">
        <x-slot:actions>
            <x-ui.button variant="outline" icon="arrow-left" class="[&>svg]:rtl-flip" :href="route('dashboard')">Dashboard</x-ui.button>
        </x-slot:actions>
    </x-page-header>

    <div x-data="{ img: 0, color: 'Graphite', size: 'M', qty: 1, tab: 'desc', imgs: ['a','b','c','d'] }" class="grid grid-cols-1 gap-6 lg:grid-cols-2">
        {{-- Gallery --}}
        <div>
            <div class="aspect-square overflow-hidden rounded-2xl border border-border bg-muted">
                <template x-for="(s, i) in imgs" :key="i">
                    <img x-show="img === i" :src="`https://picsum.photos/seed/prod-${s}/700/700`" alt="" class="size-full object-cover" />
                </template>
            </div>
            <div class="mt-3 grid grid-cols-4 gap-3">
                <template x-for="(s, i) in imgs" :key="i">
                    <button @click="img = i" class="aspect-square overflow-hidden rounded-xl border-2 transition" :class="img === i ? 'border-primary' : 'border-transparent opacity-70 hover:opacity-100'">
                        <img :src="`https://picsum.photos/seed/prod-${s}/200/200`" alt="" class="size-full object-cover" />
                    </button>
                </template>
            </div>
        </div>

        {{-- Info --}}
        <div>
            <x-ui.badge variant="success">In stock</x-ui.badge>
            <h1 class="mt-2 text-2xl font-bold">Wireless Noise-Cancelling Headphones</h1>
            <div class="mt-2 flex items-center gap-2 text-sm">
                <div class="flex gap-0.5">@for ($n = 0; $n < 5; $n++)<i data-lucide="star" class="size-4 {{ $n < 5 ? 'fill-amber-400 text-amber-400' : '' }}"></i>@endfor</div>
                <span class="font-medium">4.8</span><span class="text-muted-foreground">· 342 reviews</span>
            </div>
            <div class="mt-4 flex items-baseline gap-3">
                <span class="text-3xl font-bold">$129.00</span>
                <span class="text-lg text-muted-foreground line-through">$179.00</span>
                <x-ui.badge variant="destructive">-28%</x-ui.badge>
            </div>
            <p class="mt-4 text-sm text-muted-foreground">Immersive sound with adaptive noise cancellation, 40-hour battery life and plush memory-foam ear cushions for all-day comfort.</p>

            {{-- Color --}}
            <div class="mt-5">
                <p class="mb-2 text-sm font-medium">Color: <span x-text="color" class="text-muted-foreground"></span></p>
                <div class="flex gap-2">
                    @foreach (['Graphite' => 'bg-neutral-800','Silver' => 'bg-neutral-300','Navy' => 'bg-blue-900','Rose' => 'bg-rose-400'] as $c => $bg)
                        <button @click="color = '{{ $c }}'" class="size-9 rounded-full {{ $bg }} ring-offset-2 ring-offset-background transition" :class="color === '{{ $c }}' ? 'ring-2 ring-primary' : ''"></button>
                    @endforeach
                </div>
            </div>

            {{-- Size --}}
            <div class="mt-5">
                <p class="mb-2 text-sm font-medium">Size</p>
                <div class="flex gap-2">
                    @foreach (['S','M','L','XL'] as $s)
                        <button @click="size = '{{ $s }}'" class="grid size-10 place-items-center rounded-lg border text-sm font-medium transition" :class="size === '{{ $s }}' ? 'border-primary bg-primary/10 text-primary' : 'border-border hover:bg-accent'">{{ $s }}</button>
                    @endforeach
                </div>
            </div>

            {{-- Qty + actions --}}
            <div class="mt-6 flex items-center gap-3">
                <div class="flex items-center rounded-lg border border-border">
                    <button @click="qty = Math.max(1, qty - 1)" class="grid size-10 place-items-center text-muted-foreground hover:text-foreground"><i data-lucide="minus" class="size-4"></i></button>
                    <span class="w-10 text-center text-sm font-semibold" x-text="qty"></span>
                    <button @click="qty++" class="grid size-10 place-items-center text-muted-foreground hover:text-foreground"><i data-lucide="plus" class="size-4"></i></button>
                </div>
                <x-ui.button class="flex-1" icon="shopping-cart" x-on:click="window.toast('Added to cart', { variant: 'success' })">Add to cart</x-ui.button>
                <x-ui.button variant="outline" size="icon" icon="heart" />
            </div>

            {{-- Tabs --}}
            <div class="mt-8">
                <div class="flex gap-1 border-b border-border">
                    @foreach (['desc' => 'Description','specs' => 'Specs','ship' => 'Shipping'] as $key => $label)
                        <button @click="tab = '{{ $key }}'" class="relative px-4 py-2.5 text-sm font-medium transition-colors" :class="tab === '{{ $key }}' ? 'text-primary' : 'text-muted-foreground hover:text-foreground'">{{ $label }}<span x-show="tab === '{{ $key }}'" class="absolute inset-x-2 -bottom-px h-0.5 rounded-full bg-primary"></span></button>
                    @endforeach
                </div>
                <div class="pt-4 text-sm text-muted-foreground">
                    <div x-show="tab === 'desc'">Premium over-ear headphones engineered for audiophiles. Adaptive ANC adjusts to your environment, while Bluetooth 5.3 keeps the connection rock-solid.</div>
                    <div x-show="tab === 'specs'" x-cloak><ul class="space-y-1.5">@foreach (['Driver: 40mm dynamic','Battery: 40 hours','Bluetooth: 5.3','Weight: 254g','Warranty: 2 years'] as $spec)<li class="flex justify-between border-b border-border py-1.5"><span>{{ Str::before($spec, ':') }}</span><span class="font-medium text-foreground">{{ Str::after($spec, ': ') }}</span></li>@endforeach</ul></div>
                    <div x-show="tab === 'ship'" x-cloak>Free shipping on orders over $50. Delivered in 3–5 business days. 30-day free returns, no questions asked.</div>
                </div>
            </div>
        </div>
    </div>
</div>
