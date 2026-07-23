<div x-data="{ side: null }">
    <x-page-header :title="$pageTitle" subtitle="Advanced Ui · slide-in panels from any edge, each with real content">
        <x-slot:actions>
            <x-ui.badge variant="success" dot>4 edges</x-ui.badge>
            <x-ui.button variant="outline" icon="arrow-left" class="[&>svg]:rtl-flip" :href="route('dashboard')">Dashboard</x-ui.button>
        </x-slot:actions>
    </x-page-header>

    <div class="grid grid-cols-2 gap-4 sm:grid-cols-4">
        @foreach ([['left','panel-left','Filters','Left drawer'],['right','panel-right','Cart','Right drawer'],['top','panel-top','Notifications','Top sheet'],['bottom','panel-bottom','Settings','Bottom sheet']] as [$s, $ic, $t, $d])
            <button type="button" @click="side = '{{ $s }}'" class="group flex flex-col items-start gap-3 rounded-xl border border-border bg-card p-4 text-start transition-all hover:-translate-y-0.5 hover:shadow-md">
                <span class="grid size-10 place-items-center rounded-xl bg-primary/10 text-primary"><i data-lucide="{{ $ic }}" class="size-5"></i></span>
                <span><span class="block text-sm font-semibold">{{ $t }}</span><span class="block text-xs text-muted-foreground">{{ $d }}</span></span>
            </button>
        @endforeach
    </div>

    <template x-teleport="body">
        <div x-show="side !== null" x-cloak class="fixed inset-0 z-[100]" @keydown.escape.window="side = null">
            <div x-show="side !== null" x-transition:enter="ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                 x-transition:leave="ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                 class="absolute inset-0 bg-background/70 backdrop-blur-sm" @click="side = null"></div>

            {{-- Left: Filters --}}
            <div x-show="side === 'left'" x-trap="side === 'left'"
                 x-transition:enter="transition duration-300" x-transition:enter-start="-translate-x-full rtl:translate-x-full" x-transition:enter-end="translate-x-0"
                 x-transition:leave="transition duration-200" x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full rtl:translate-x-full"
                 class="absolute inset-y-0 start-0 flex w-80 max-w-[85vw] flex-col border-e border-border bg-card shadow-2xl">
                <div class="flex items-center justify-between border-b border-border p-5"><h3 class="text-lg font-semibold">Filters</h3><button @click="side = null" class="rounded-lg p-1.5 text-muted-foreground hover:bg-accent"><i data-lucide="x" class="size-5"></i></button></div>
                <div class="flex-1 space-y-5 overflow-y-auto p-5">
                    <div><p class="mb-2 text-sm font-medium">Category</p><div class="space-y-2">@foreach (['Electronics','Apparel','Home','Toys'] as $c)<label class="flex items-center gap-2.5 text-sm text-muted-foreground"><input type="checkbox" class="size-4 rounded border-input text-primary focus:ring-primary" @checked($loop->first)>{{ $c }}</label>@endforeach</div></div>
                    <div><p class="mb-2 text-sm font-medium">Price range</p><input type="range" class="w-full accent-primary" value="60"><div class="flex justify-between text-xs text-muted-foreground"><span>$0</span><span>$500+</span></div></div>
                    <div><p class="mb-2 text-sm font-medium">Rating</p><div class="flex gap-1">@for($n=0;$n<5;$n++)<i data-lucide="star" class="size-5 {{ $n<4?'fill-amber-400 text-amber-400':'text-muted-foreground/30' }}"></i>@endfor</div></div>
                </div>
                <div class="flex gap-2 border-t border-border p-5"><x-ui.button variant="outline" class="flex-1" @click="side = null">Reset</x-ui.button><x-ui.button class="flex-1" @click="side = null">Apply</x-ui.button></div>
            </div>

            {{-- Right: Cart --}}
            <div x-show="side === 'right'" x-trap="side === 'right'"
                 x-transition:enter="transition duration-300" x-transition:enter-start="translate-x-full rtl:-translate-x-full" x-transition:enter-end="translate-x-0"
                 x-transition:leave="transition duration-200" x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full rtl:-translate-x-full"
                 class="absolute inset-y-0 end-0 flex w-80 max-w-[85vw] flex-col border-s border-border bg-card shadow-2xl">
                <div class="flex items-center justify-between border-b border-border p-5"><h3 class="flex items-center gap-2 text-lg font-semibold"><i data-lucide="shopping-cart" class="size-5"></i>Cart <x-ui.badge variant="solid">3</x-ui.badge></h3><button @click="side = null" class="rounded-lg p-1.5 text-muted-foreground hover:bg-accent"><i data-lucide="x" class="size-5"></i></button></div>
                <div class="flex-1 space-y-3 overflow-y-auto p-5">
                    @foreach ([['Wireless headphones','$129.00','headphones','from-indigo-500 to-blue-500'],['Mechanical keyboard','$89.00','keyboard','from-emerald-500 to-teal-500'],['USB-C hub','$45.00','usb','from-fuchsia-500 to-pink-500']] as [$name,$price,$ic,$grad])
                        <div class="flex items-center gap-3">
                            <div class="grid size-14 shrink-0 place-items-center rounded-lg bg-gradient-to-br {{ $grad }} text-white"><i data-lucide="{{ $ic }}" class="size-6"></i></div>
                            <div class="min-w-0 flex-1"><p class="truncate text-sm font-medium">{{ $name }}</p><p class="text-sm text-muted-foreground">{{ $price }}</p></div>
                            <button class="rounded-lg p-1.5 text-muted-foreground hover:bg-accent hover:text-destructive"><i data-lucide="trash-2" class="size-4"></i></button>
                        </div>
                    @endforeach
                </div>
                <div class="space-y-3 border-t border-border p-5">
                    <div class="flex justify-between text-sm"><span class="text-muted-foreground">Subtotal</span><span class="font-semibold">$263.00</span></div>
                    <x-ui.button class="w-full" icon="credit-card" @click="side = null">Checkout</x-ui.button>
                </div>
            </div>

            {{-- Top: Notifications --}}
            <div x-show="side === 'top'" x-trap="side === 'top'"
                 x-transition:enter="transition duration-300" x-transition:enter-start="-translate-y-full" x-transition:enter-end="translate-y-0"
                 x-transition:leave="transition duration-200" x-transition:leave-start="translate-y-0" x-transition:leave-end="-translate-y-full"
                 class="absolute inset-x-0 top-0 border-b border-border bg-card p-5 shadow-2xl">
                <div class="mx-auto max-w-3xl">
                    <div class="mb-3 flex items-center justify-between"><h3 class="text-lg font-semibold">Notifications</h3><button @click="side = null" class="rounded-lg p-1.5 text-muted-foreground hover:bg-accent"><i data-lucide="x" class="size-5"></i></button></div>
                    <div class="grid gap-2 sm:grid-cols-2">
                        @foreach ([['user-plus','New user registered','2m','text-info bg-info/10'],['shopping-cart','Order #4821 confirmed','18m','text-success bg-success/10'],['triangle-alert','Storage almost full','1h','text-[hsl(var(--warning))] bg-warning/10'],['message-square','New comment','3h','text-primary bg-primary/10']] as [$ic,$t,$a,$tone])
                            <div class="flex items-center gap-3 rounded-lg p-2 hover:bg-accent"><span class="grid size-9 place-items-center rounded-lg {{ $tone }}"><i data-lucide="{{ $ic }}" class="size-4"></i></span><p class="flex-1 text-sm font-medium">{{ $t }}</p><span class="text-xs text-muted-foreground">{{ $a }}</span></div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Bottom: Settings --}}
            <div x-show="side === 'bottom'" x-trap="side === 'bottom'"
                 x-transition:enter="transition duration-300" x-transition:enter-start="translate-y-full" x-transition:enter-end="translate-y-0"
                 x-transition:leave="transition duration-200" x-transition:leave-start="translate-y-0" x-transition:leave-end="translate-y-full"
                 class="absolute inset-x-0 bottom-0 rounded-t-2xl border-t border-border bg-card p-5 pb-8 shadow-2xl">
                <div class="mx-auto max-w-lg">
                    <div class="mx-auto mb-4 h-1.5 w-12 rounded-full bg-muted"></div>
                    <h3 class="text-lg font-semibold">Quick settings</h3>
                    <div class="mt-3 space-y-1">
                        @foreach ([['moon','Dark mode',true],['bell','Notifications',true],['wifi','Sync over Wi-Fi only',false]] as [$ic,$label,$on])
                            <div class="flex items-center justify-between rounded-lg px-2 py-2.5">
                                <span class="flex items-center gap-3 text-sm font-medium"><i data-lucide="{{ $ic }}" class="size-4 text-muted-foreground"></i>{{ $label }}</span>
                                <span class="relative h-6 w-11 rounded-full {{ $on ? 'bg-primary' : 'bg-muted' }}"><span class="absolute top-0.5 size-5 rounded-full bg-white shadow {{ $on ? 'end-0.5' : 'start-0.5' }}"></span></span>
                            </div>
                        @endforeach
                    </div>
                    <x-ui.button class="mt-4 w-full" icon="check" @click="side = null">Done</x-ui.button>
                </div>
            </div>
        </div>
    </template>
</div>
