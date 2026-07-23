<div>
    <x-page-header :title="'Invoices'" subtitle="Pages · invoice list with statuses & totals">
        <x-slot:actions>
            <x-ui.button variant="outline" icon="arrow-left" class="[&>svg]:rtl-flip" :href="route('dashboard')">Dashboard</x-ui.button>
            <x-ui.button icon="plus" :href="route('page', ['path' => 'create'])" wire:navigate>New invoice</x-ui.button>
        </x-slot:actions>
    </x-page-header>

    {{-- Stats --}}
    <div class="grid grid-cols-2 gap-4 lg:grid-cols-4">
        @foreach ([['file-text','Total','$84,290','text-primary bg-primary/10'],['circle-check-big','Paid','$61,120','text-success bg-success/10'],['clock','Pending','$18,450','text-[hsl(var(--warning))] bg-warning/10'],['circle-alert','Overdue','$4,720','text-destructive bg-destructive/10']] as [$ic,$label,$val,$tone])
            <x-ui.card>
                <div class="flex items-center justify-between"><span class="text-sm text-muted-foreground">{{ $label }}</span><span class="grid size-9 place-items-center rounded-xl {{ $tone }}"><i data-lucide="{{ $ic }}" class="size-4"></i></span></div>
                <p class="mt-2 text-2xl font-bold">{{ $val }}</p>
            </x-ui.card>
        @endforeach
    </div>

    <x-ui.card :padded="false" class="mt-4" x-data="{ f: 'all' }">
        <div class="flex flex-col gap-3 border-b border-border p-4 sm:flex-row sm:items-center sm:justify-between">
            <div class="flex gap-1 rounded-lg bg-muted/60 p-1">
                @foreach (['all' => 'All','paid' => 'Paid','pending' => 'Pending','overdue' => 'Overdue'] as $key => $label)
                    <button @click="f = '{{ $key }}'" class="rounded-md px-3 py-1.5 text-xs font-medium transition-colors" :class="f === '{{ $key }}' ? 'bg-card text-foreground shadow-sm' : 'text-muted-foreground hover:text-foreground'">{{ $label }}</button>
                @endforeach
            </div>
            <div class="w-full sm:w-64"><x-ui.input placeholder="Search invoices…" icon="search" /></div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-border text-start text-xs uppercase tracking-wide text-muted-foreground">
                        <th class="p-4 text-start font-medium">Invoice</th>
                        <th class="p-4 text-start font-medium">Client</th>
                        <th class="p-4 text-start font-medium">Issued</th>
                        <th class="p-4 text-start font-medium">Due</th>
                        <th class="p-4 text-start font-medium">Status</th>
                        <th class="p-4 text-end font-medium">Amount</th>
                        <th class="p-4"></th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $invoices = [
                            ['INV-0148','Northwind Traders','Jul 12','Jul 26','paid','Paid','success',627.00],
                            ['INV-0147','Orbit Labs','Jul 10','Jul 24','pending','Pending','warning',1240.00],
                            ['INV-0146','Lumen Co','Jul 08','Jul 22','overdue','Overdue','destructive',480.00],
                            ['INV-0145','Vertex Inc','Jul 05','Jul 19','paid','Paid','success',2100.00],
                            ['INV-0144','Cobalt Studio','Jul 02','Jul 16','paid','Paid','success',356.00],
                        ];
                    @endphp
                    @foreach ($invoices as [$id,$client,$issued,$due,$type,$status,$tone,$amount])
                        <tr x-show="f === 'all' || f === '{{ $type }}'" class="border-b border-border last:border-0 hover:bg-accent/40">
                            <td class="p-4 font-semibold">{{ $id }}</td>
                            <td class="p-4">{{ $client }}</td>
                            <td class="p-4 text-muted-foreground">{{ $issued }}</td>
                            <td class="p-4 text-muted-foreground">{{ $due }}</td>
                            <td class="p-4"><x-ui.badge :variant="$tone">{{ $status }}</x-ui.badge></td>
                            <td class="p-4 text-end font-semibold">${{ number_format($amount, 2) }}</td>
                            <td class="p-4 text-end">
                                <x-ui.dropdown align="end" width="w-36">
                                    <x-slot:trigger><button class="rounded-lg p-1.5 text-muted-foreground hover:bg-accent"><i data-lucide="ellipsis-vertical" class="size-4"></i></button></x-slot:trigger>
                                    <x-ui.dropdown-item icon="eye" :href="route('page', ['path' => 'detail'])">View</x-ui.dropdown-item>
                                    <x-ui.dropdown-item icon="download">Download</x-ui.dropdown-item>
                                    <x-ui.dropdown-item icon="send">Send</x-ui.dropdown-item>
                                </x-ui.dropdown>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </x-ui.card>
</div>
