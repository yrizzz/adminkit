<div>
    <x-page-header :title="'Orders'" subtitle="Pages · order management with statuses & filters">
        <x-slot:actions>
            <x-ui.button variant="outline" icon="arrow-left" class="[&>svg]:rtl-flip" :href="route('dashboard')">Dashboard</x-ui.button>
            <x-ui.button icon="download">Export</x-ui.button>
        </x-slot:actions>
    </x-page-header>

    {{-- Stats --}}
    <div class="grid grid-cols-2 gap-4 lg:grid-cols-4">
        @foreach ([['shopping-bag','Total orders','1,284','text-primary bg-primary/10'],['clock','Pending','36','text-[hsl(var(--warning))] bg-warning/10'],['truck','Shipped','214','text-info bg-info/10'],['circle-check-big','Delivered','1,034','text-success bg-success/10']] as [$ic,$label,$val,$tone])
            <x-ui.card>
                <div class="flex items-center justify-between"><span class="text-sm text-muted-foreground">{{ $label }}</span><span class="grid size-9 place-items-center rounded-xl {{ $tone }}"><i data-lucide="{{ $ic }}" class="size-4"></i></span></div>
                <p class="mt-2 text-2xl font-bold">{{ $val }}</p>
            </x-ui.card>
        @endforeach
    </div>

    <x-ui.card :padded="false" class="mt-4" x-data="{ f: 'all' }">
        {{-- Toolbar --}}
        <div class="flex flex-col gap-3 border-b border-border p-4 sm:flex-row sm:items-center sm:justify-between">
            <div class="flex gap-1 rounded-lg bg-muted/60 p-1">
                @foreach (['all' => 'All','pending' => 'Pending','shipped' => 'Shipped','delivered' => 'Delivered'] as $key => $label)
                    <button @click="f = '{{ $key }}'" class="rounded-md px-3 py-1.5 text-xs font-medium transition-colors" :class="f === '{{ $key }}' ? 'bg-card text-foreground shadow-sm' : 'text-muted-foreground hover:text-foreground'">{{ $label }}</button>
                @endforeach
            </div>
            <div class="w-full sm:w-64"><x-ui.input placeholder="Search orders…" icon="search" /></div>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-border text-start text-xs uppercase tracking-wide text-muted-foreground">
                        <th class="p-4 text-start font-medium">Order</th>
                        <th class="p-4 text-start font-medium">Customer</th>
                        <th class="p-4 text-start font-medium">Date</th>
                        <th class="p-4 text-start font-medium">Status</th>
                        <th class="p-4 text-end font-medium">Total</th>
                        <th class="p-4"></th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $orders = [
                            ['#5821','Aisha Rahman','Jul 22, 2026','delivered','Delivered','success',249.00],
                            ['#5820','David Chen','Jul 22, 2026','shipped','Shipped','info',89.00],
                            ['#5819','Sofia Martinez','Jul 21, 2026','pending','Pending','warning',412.00],
                            ['#5818','Omar Haddad','Jul 21, 2026','delivered','Delivered','success',45.00],
                            ['#5817','Priya Sharma','Jul 20, 2026','shipped','Shipped','info',159.00],
                            ['#5816','Kenji Tanaka','Jul 20, 2026','pending','Cancelled','destructive',79.00],
                        ];
                    @endphp
                    @foreach ($orders as [$id,$customer,$date,$type,$status,$tone,$total])
                        <tr x-show="f === 'all' || f === '{{ $type }}'" class="border-b border-border last:border-0 hover:bg-accent/40">
                            <td class="p-4 font-semibold">{{ $id }}</td>
                            <td class="p-4"><div class="flex items-center gap-2.5"><x-ui.avatar :name="$customer" size="xs" /><span>{{ $customer }}</span></div></td>
                            <td class="p-4 text-muted-foreground">{{ $date }}</td>
                            <td class="p-4"><x-ui.badge :variant="$tone">{{ $status }}</x-ui.badge></td>
                            <td class="p-4 text-end font-semibold">${{ number_format($total, 2) }}</td>
                            <td class="p-4 text-end">
                                <x-ui.dropdown align="end" width="w-36">
                                    <x-slot:trigger><button class="rounded-lg p-1.5 text-muted-foreground hover:bg-accent"><i data-lucide="ellipsis-vertical" class="size-4"></i></button></x-slot:trigger>
                                    <x-ui.dropdown-item icon="eye">View</x-ui.dropdown-item>
                                    <x-ui.dropdown-item icon="truck">Track</x-ui.dropdown-item>
                                    <x-ui.dropdown-item icon="x" variant="destructive">Cancel</x-ui.dropdown-item>
                                </x-ui.dropdown>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </x-ui.card>
</div>
