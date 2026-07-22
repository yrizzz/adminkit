<x-layouts.app title="Widgets" :breadcrumbs="[['label' => 'Pages'], ['label' => 'Widgets']]">
    <x-page-header title="Widgets" subtitle="Drop-in dashboard blocks.">
        <x-slot:actions>
            <x-ui.badge variant="warning" dot>Hot</x-ui.badge>
        </x-slot:actions>
    </x-page-header>

    {{-- Stat variants --}}
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
        <x-ui.stat label="Sessions" value="12,486" icon="activity" tone="primary" trend="+18%" />
        <x-ui.stat label="Conversion" value="3.24%" icon="target" tone="success" trend="+2.1%" />
        <x-ui.stat label="Avg. Order" value="$184" icon="shopping-bag" tone="info" trend="+5.4%" />
        <x-ui.stat label="Refunds" value="42" icon="rotate-ccw" tone="destructive" trend="-0.8%" :trend-up="false" />
    </div>

    <div class="mt-4 grid grid-cols-1 gap-4 lg:grid-cols-3">
        {{-- Progress goals --}}
        <x-ui.card title="Monthly Goals">
            <div class="space-y-5">
                @foreach ([['New customers','680 / 1,000','68','bg-primary'],['Revenue target','$48k / $60k','80','bg-success'],['Support tickets','92 / 100','92','bg-[hsl(var(--warning))]']] as [$l,$v,$p,$c])
                    <div>
                        <div class="mb-1.5 flex justify-between text-sm"><span class="font-medium">{{ $l }}</span><span class="text-muted-foreground">{{ $v }}</span></div>
                        <div class="h-2 w-full overflow-hidden rounded-full bg-muted"><div class="h-full rounded-full {{ $c }}" style="width: {{ $p }}%"></div></div>
                    </div>
                @endforeach
            </div>
        </x-ui.card>

        {{-- Team members --}}
        <x-ui.card title="Team Members">
            <div class="space-y-1">
                @foreach ([['Aisha Rahman','Admin','online'],['David Chen','Editor','busy'],['Sofia Martinez','Viewer','away'],['Omar Haddad','Manager','offline']] as [$n,$r,$s])
                    <div class="flex items-center gap-3 rounded-lg p-2 hover:bg-accent/40">
                        <x-ui.avatar :name="$n" size="sm" :status="$s" />
                        <div class="min-w-0 flex-1"><p class="truncate text-sm font-medium">{{ $n }}</p><p class="truncate text-xs text-muted-foreground">{{ $r }}</p></div>
                        <button class="rounded-lg p-1.5 text-muted-foreground hover:bg-accent hover:text-foreground"><i data-lucide="ellipsis-vertical" class="size-4"></i></button>
                    </div>
                @endforeach
            </div>
        </x-ui.card>

        {{-- Pricing widget --}}
        <x-ui.card title="Upgrade Plan" class="relative overflow-hidden">
            <div class="pointer-events-none absolute -end-6 -top-6 size-24 rounded-full bg-primary/10 blur-2xl"></div>
            <div class="relative">
                <div class="flex items-baseline gap-1"><span class="text-3xl font-bold">$29</span><span class="text-muted-foreground">/month</span></div>
                <p class="mt-1 text-sm text-muted-foreground">Pro plan — everything you need to scale.</p>
                <ul class="mt-4 space-y-2 text-sm">
                    @foreach (['Unlimited projects','Priority support','Advanced analytics','Custom domains'] as $f)
                        <li class="flex items-center gap-2"><i data-lucide="circle-check-big" class="size-4 text-success"></i>{{ $f }}</li>
                    @endforeach
                </ul>
                <x-ui.button class="mt-5 w-full" icon="rocket" @click="window.toast('Redirecting to checkout…', {variant:'info'})">Upgrade now</x-ui.button>
            </div>
        </x-ui.card>
    </div>
</x-layouts.app>
