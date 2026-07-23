<div>
    <x-page-header :title="'Invoice #INV-2026-0148'" subtitle="Pages · invoice detail with line items & totals">
        <x-slot:actions>
            <x-ui.button variant="outline" icon="arrow-left" class="[&>svg]:rtl-flip" :href="route('dashboard')">Dashboard</x-ui.button>
            <x-ui.button variant="outline" icon="download">Download</x-ui.button>
            <x-ui.button icon="printer" onclick="window.print()">Print</x-ui.button>
        </x-slot:actions>
    </x-page-header>

    <x-ui.card class="mx-auto max-w-3xl">
        {{-- Header --}}
        <div class="flex flex-col justify-between gap-6 border-b border-border pb-6 sm:flex-row">
            <div class="flex items-center gap-3">
                <span class="grid size-12 place-items-center rounded-xl bg-gradient-to-br from-primary to-sidebar-primary text-white"><i data-lucide="gem" class="size-6"></i></span>
                <div><p class="text-lg font-bold">AdminKit Inc.</p><p class="text-sm text-muted-foreground">hello@adminkit.test</p></div>
            </div>
            <div class="sm:text-end">
                <p class="text-2xl font-bold tracking-tight">INVOICE</p>
                <p class="text-sm text-muted-foreground">#INV-2026-0148</p>
                <x-ui.badge variant="success" class="mt-1">Paid</x-ui.badge>
            </div>
        </div>

        {{-- Bill to / dates --}}
        <div class="grid grid-cols-1 gap-6 py-6 sm:grid-cols-2">
            <div>
                <p class="mb-1 text-xs font-semibold uppercase tracking-wide text-muted-foreground">Bill to</p>
                <p class="font-semibold">Northwind Traders</p>
                <p class="text-sm text-muted-foreground">Aisha Rahman</p>
                <p class="text-sm text-muted-foreground">Jl. Sudirman No. 45, Jakarta</p>
                <p class="text-sm text-muted-foreground">aisha@northwind.co</p>
            </div>
            <div class="space-y-1.5 sm:text-end">
                <div class="flex justify-between sm:justify-end sm:gap-6"><span class="text-sm text-muted-foreground">Issued</span><span class="text-sm font-medium">Jul 12, 2026</span></div>
                <div class="flex justify-between sm:justify-end sm:gap-6"><span class="text-sm text-muted-foreground">Due</span><span class="text-sm font-medium">Jul 26, 2026</span></div>
                <div class="flex justify-between sm:justify-end sm:gap-6"><span class="text-sm text-muted-foreground">Method</span><span class="text-sm font-medium">Visa ···· 4242</span></div>
            </div>
        </div>

        {{-- Line items --}}
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-y border-border text-start text-xs uppercase tracking-wide text-muted-foreground">
                        <th class="py-3 text-start font-medium">Description</th>
                        <th class="py-3 text-center font-medium">Qty</th>
                        <th class="py-3 text-end font-medium">Price</th>
                        <th class="py-3 text-end font-medium">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @php $items = [['Pro plan — annual subscription',1,279.00],['Additional seats',5,29.00],['Priority support add-on',1,49.00],['Custom onboarding',1,150.00]]; @endphp
                    @foreach ($items as [$desc,$qty,$price])
                        <tr class="border-b border-border">
                            <td class="py-3 font-medium">{{ $desc }}</td>
                            <td class="py-3 text-center text-muted-foreground">{{ $qty }}</td>
                            <td class="py-3 text-end text-muted-foreground">${{ number_format($price, 2) }}</td>
                            <td class="py-3 text-end font-medium">${{ number_format($qty * $price, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Totals --}}
        @php $subtotal = 279 + 5*29 + 49 + 150; $tax = round($subtotal * 0.11, 2); $total = $subtotal + $tax; @endphp
        <div class="mt-4 flex justify-end">
            <div class="w-full max-w-xs space-y-2">
                <div class="flex justify-between text-sm"><span class="text-muted-foreground">Subtotal</span><span class="font-medium">${{ number_format($subtotal, 2) }}</span></div>
                <div class="flex justify-between text-sm"><span class="text-muted-foreground">Tax (11%)</span><span class="font-medium">${{ number_format($tax, 2) }}</span></div>
                <div class="flex justify-between border-t border-border pt-2 text-base font-bold"><span>Total</span><span class="text-primary">${{ number_format($total, 2) }}</span></div>
            </div>
        </div>

        <div class="mt-6 rounded-xl bg-muted/40 p-4 text-sm text-muted-foreground">
            <p class="font-medium text-foreground">Notes</p>
            Thank you for your business! Payment was received in full. This invoice was generated automatically.
        </div>
    </x-ui.card>
</div>
