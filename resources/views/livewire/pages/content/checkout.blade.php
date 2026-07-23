<div>
    <x-page-header :title="'Checkout'" subtitle="Pages · shipping, payment & review">
        <x-slot:actions>
            <x-ui.button variant="outline" icon="arrow-left" class="[&>svg]:rtl-flip" :href="route('page', ['path' => 'cart'])" wire:navigate>Back to cart</x-ui.button>
        </x-slot:actions>
    </x-page-header>

    <div x-data="{ pay: 'card' }" class="grid grid-cols-1 gap-4 lg:grid-cols-[1fr_360px]">
        <div class="space-y-4">
            {{-- Steps --}}
            <div class="flex items-center gap-2 text-sm">
                @foreach ([['1','Shipping',true],['2','Payment',true],['3','Review',false]] as [$n,$label,$active])
                    <div class="flex items-center gap-2">
                        <span class="grid size-7 place-items-center rounded-full text-xs font-bold {{ $active ? 'bg-primary text-primary-foreground' : 'bg-muted text-muted-foreground' }}">{{ $n }}</span>
                        <span class="{{ $active ? 'font-medium' : 'text-muted-foreground' }}">{{ $label }}</span>
                    </div>
                    @if (! $loop->last)<div class="h-px w-8 bg-border"></div>@endif
                @endforeach
            </div>

            {{-- Shipping --}}
            <x-ui.card title="Shipping address">
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <x-ui.input label="First name" value="Aisha" />
                    <x-ui.input label="Last name" value="Rahman" />
                    <div class="sm:col-span-2"><x-ui.input label="Address" value="Jl. Sudirman No. 45" icon="map-pin" /></div>
                    <x-ui.input label="City" value="Jakarta" />
                    <x-ui.input label="Postal code" value="10220" />
                    <x-ui.input label="Phone" value="+62 812 3456 7890" icon="phone" />
                    <x-ui.input label="Email" type="email" value="aisha@northwind.co" icon="mail" />
                </div>
            </x-ui.card>

            {{-- Payment --}}
            <x-ui.card title="Payment method">
                <div class="space-y-2">
                    @foreach (['card' => ['Credit / debit card','credit-card'],'wallet' => ['Digital wallet','wallet'],'transfer' => ['Bank transfer','building-2']] as $key => [$label,$ico])
                        <label class="flex cursor-pointer items-center gap-3 rounded-xl border p-3.5 transition-colors" :class="pay === '{{ $key }}' ? 'border-primary bg-primary/5' : 'border-border hover:bg-accent/50'">
                            <input type="radio" name="pay" value="{{ $key }}" x-model="pay" class="size-4 text-primary focus:ring-primary">
                            <i data-lucide="{{ $ico }}" class="size-5 text-muted-foreground"></i>
                            <span class="text-sm font-medium">{{ $label }}</span>
                        </label>
                    @endforeach
                </div>
                <div x-show="pay === 'card'" x-collapse x-cloak class="mt-4 grid grid-cols-2 gap-4">
                    <div class="col-span-2"><x-ui.input label="Card number" placeholder="1234 5678 9012 3456" icon="credit-card" /></div>
                    <x-ui.input label="Expiry" placeholder="MM / YY" />
                    <x-ui.input label="CVC" placeholder="123" />
                </div>
            </x-ui.card>
        </div>

        {{-- Summary --}}
        <x-ui.card title="Your order" class="lg:sticky lg:top-32 lg:self-start">
            <div class="space-y-3">
                @foreach ([['Wireless Headphones','Graphite · M',129],['Mechanical Keyboard','×2',178],['USB-C Hub','Space Gray',45]] as [$name,$variant,$price])
                    <div class="flex items-center gap-3">
                        <img src="https://picsum.photos/seed/{{ urlencode($name) }}/80/80" alt="" class="size-12 shrink-0 rounded-lg object-cover" />
                        <div class="min-w-0 flex-1"><p class="truncate text-sm font-medium">{{ $name }}</p><p class="text-xs text-muted-foreground">{{ $variant }}</p></div>
                        <span class="text-sm font-semibold">${{ number_format($price, 2) }}</span>
                    </div>
                @endforeach
            </div>
            <div class="mt-4 space-y-2 border-t border-border pt-4 text-sm">
                <div class="flex justify-between"><span class="text-muted-foreground">Subtotal</span><span class="font-medium">$352.00</span></div>
                <div class="flex justify-between"><span class="text-muted-foreground">Shipping</span><span class="font-medium">$9.00</span></div>
                <div class="flex justify-between"><span class="text-muted-foreground">Tax</span><span class="font-medium">$39.00</span></div>
                <div class="flex justify-between border-t border-border pt-2 text-base font-bold"><span>Total</span><span class="text-primary">$400.00</span></div>
            </div>
            <x-ui.button class="mt-4 w-full" size="lg" icon="lock" x-on:click="window.toast('Order placed successfully!', { variant: 'success' })">Place order</x-ui.button>
            <p class="mt-2 flex items-center justify-center gap-1 text-xs text-muted-foreground"><i data-lucide="shield-check" class="size-3.5"></i>Secure encrypted payment</p>
        </x-ui.card>
    </div>
</div>
