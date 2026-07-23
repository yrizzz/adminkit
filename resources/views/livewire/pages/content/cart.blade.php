<div>
    <x-page-header :title="'Cart'" subtitle="Pages · line items, quantities & order summary">
        <x-slot:actions>
            <x-ui.button variant="outline" icon="arrow-left" class="[&>svg]:rtl-flip" :href="route('dashboard')">Continue shopping</x-ui.button>
        </x-slot:actions>
    </x-page-header>

    <div x-data="{
            items: [
                { id: 1, name: 'Wireless Headphones', variant: 'Graphite · M', price: 129, qty: 1, seed: 'Wireless Headphones' },
                { id: 2, name: 'Mechanical Keyboard', variant: 'Brown switches', price: 89, qty: 2, seed: 'Mechanical Keyboard' },
                { id: 3, name: 'USB-C Hub 7-in-1', variant: 'Space Gray', price: 45, qty: 1, seed: 'USB-C Hub 7-in-1' },
            ],
            remove(id) { this.items = this.items.filter(i => i.id !== id); },
            get subtotal() { return this.items.reduce((s, i) => s + i.price * i.qty, 0); },
            get shipping() { return this.items.length ? 9 : 0; },
            get tax() { return Math.round(this.subtotal * 0.11); },
            get total() { return this.subtotal + this.shipping + this.tax; },
         }"
         x-init="$watch('items', () => $nextTick(() => window.renderIcons && window.renderIcons()))"
         class="grid grid-cols-1 gap-4 lg:grid-cols-[1fr_360px]">
        {{-- Items --}}
        <x-ui.card :padded="false">
            <div class="divide-y divide-border">
                <template x-for="item in items" :key="item.id">
                    <div class="flex items-center gap-4 p-4">
                        <img :src="`https://picsum.photos/seed/${item.seed}/120/120`" alt="" class="size-20 shrink-0 rounded-xl object-cover" />
                        <div class="min-w-0 flex-1">
                            <p class="truncate font-semibold" x-text="item.name"></p>
                            <p class="text-sm text-muted-foreground" x-text="item.variant"></p>
                            <p class="mt-1 font-bold" x-text="'$' + item.price.toFixed(2)"></p>
                        </div>
                        <div class="flex items-center rounded-lg border border-border">
                            <button @click="item.qty = Math.max(1, item.qty - 1)" class="grid size-8 place-items-center text-muted-foreground hover:text-foreground"><i data-lucide="minus" class="size-3.5"></i></button>
                            <span class="w-8 text-center text-sm font-semibold" x-text="item.qty"></span>
                            <button @click="item.qty++" class="grid size-8 place-items-center text-muted-foreground hover:text-foreground"><i data-lucide="plus" class="size-3.5"></i></button>
                        </div>
                        <button @click="remove(item.id)" class="rounded-lg p-2 text-muted-foreground hover:bg-accent hover:text-destructive"><i data-lucide="trash-2" class="size-4"></i></button>
                    </div>
                </template>
                <div x-show="items.length === 0" class="flex flex-col items-center gap-2 p-12 text-center text-muted-foreground">
                    <i data-lucide="shopping-cart" class="size-10"></i><p class="text-sm">Your cart is empty.</p>
                </div>
            </div>
        </x-ui.card>

        {{-- Summary --}}
        <div class="space-y-4">
            <x-ui.card title="Order summary">
                <div class="space-y-2.5 text-sm">
                    <div class="flex justify-between"><span class="text-muted-foreground">Subtotal</span><span class="font-medium" x-text="'$' + subtotal.toFixed(2)"></span></div>
                    <div class="flex justify-between"><span class="text-muted-foreground">Shipping</span><span class="font-medium" x-text="'$' + shipping.toFixed(2)"></span></div>
                    <div class="flex justify-between"><span class="text-muted-foreground">Tax (11%)</span><span class="font-medium" x-text="'$' + tax.toFixed(2)"></span></div>
                    <div class="flex justify-between border-t border-border pt-2.5 text-base font-bold"><span>Total</span><span class="text-primary" x-text="'$' + total.toFixed(2)"></span></div>
                </div>
                <x-ui.button class="mt-4 w-full" icon="credit-card" :href="route('page', ['path' => 'checkout'])" wire:navigate>Checkout</x-ui.button>
            </x-ui.card>
            <x-ui.card title="Promo code">
                <div class="flex gap-2">
                    <x-ui.input placeholder="Enter code" />
                    <x-ui.button variant="outline">Apply</x-ui.button>
                </div>
            </x-ui.card>
        </div>
    </div>
</div>
