<div>
    <x-page-header :title="'Create Invoice'" subtitle="Pages · build an invoice with live totals">
        <x-slot:actions>
            <x-ui.button variant="outline" :href="route('page', ['path' => 'list'])" wire:navigate>Cancel</x-ui.button>
            <x-ui.button icon="check" x-on:click="window.toast('Invoice saved', { variant: 'success' })">Save invoice</x-ui.button>
        </x-slot:actions>
    </x-page-header>

    <x-ui.card class="mx-auto max-w-3xl" x-data="{
            taxRate: 11,
            rows: [
                { desc: 'Pro plan — annual subscription', qty: 1, price: 279 },
                { desc: 'Additional seats', qty: 5, price: 29 },
            ],
            add() { this.rows.push({ desc: '', qty: 1, price: 0 }); this.$nextTick(() => window.renderIcons && window.renderIcons()); },
            remove(i) { this.rows.splice(i, 1); },
            get subtotal() { return this.rows.reduce((s, r) => s + (Number(r.qty) || 0) * (Number(r.price) || 0), 0); },
            get tax() { return Math.round(this.subtotal * this.taxRate / 100); },
            get total() { return this.subtotal + this.tax; },
         }">
        {{-- Header --}}
        <div class="grid grid-cols-1 gap-4 border-b border-border pb-6 sm:grid-cols-2">
            <div>
                <p class="mb-1.5 text-xs font-semibold uppercase tracking-wide text-muted-foreground">From</p>
                <x-ui.input value="AdminKit Inc." />
                <div class="mt-2"><x-ui.input value="hello@adminkit.test" /></div>
            </div>
            <div>
                <p class="mb-1.5 text-xs font-semibold uppercase tracking-wide text-muted-foreground">Bill to</p>
                <x-ui.input placeholder="Client name" />
                <div class="mt-2"><x-ui.input placeholder="client@email.com" /></div>
            </div>
        </div>

        {{-- Meta --}}
        <div class="grid grid-cols-2 gap-4 py-5 sm:grid-cols-3">
            <x-ui.input label="Invoice #" value="INV-0149" />
            <x-ui.input label="Issue date" type="date" />
            <x-ui.input label="Due date" type="date" />
        </div>

        {{-- Line items --}}
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-y border-border text-xs uppercase tracking-wide text-muted-foreground">
                        <th class="py-2 text-start font-medium">Description</th>
                        <th class="w-20 py-2 text-center font-medium">Qty</th>
                        <th class="w-28 py-2 text-end font-medium">Price</th>
                        <th class="w-28 py-2 text-end font-medium">Amount</th>
                        <th class="w-10"></th>
                    </tr>
                </thead>
                <tbody>
                    <template x-for="(row, i) in rows" :key="i">
                        <tr class="border-b border-border">
                            <td class="py-2 pe-2"><input x-model="row.desc" placeholder="Item description" class="w-full rounded-md border border-transparent bg-transparent px-2 py-1.5 text-sm hover:border-input focus:border-input focus:outline-none"></td>
                            <td class="py-2"><input x-model.number="row.qty" type="number" min="0" class="w-full rounded-md border border-transparent bg-transparent px-2 py-1.5 text-center text-sm hover:border-input focus:border-input focus:outline-none"></td>
                            <td class="py-2"><input x-model.number="row.price" type="number" min="0" class="w-full rounded-md border border-transparent bg-transparent px-2 py-1.5 text-end text-sm hover:border-input focus:border-input focus:outline-none"></td>
                            <td class="py-2 text-end font-medium" x-text="'$' + ((Number(row.qty)||0) * (Number(row.price)||0)).toFixed(2)"></td>
                            <td class="py-2 text-end"><button @click="remove(i)" class="rounded-lg p-1.5 text-muted-foreground hover:bg-accent hover:text-destructive"><i data-lucide="trash-2" class="size-4"></i></button></td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>
        <button @click="add()" class="mt-3 flex items-center gap-1.5 text-sm font-medium text-primary hover:underline"><i data-lucide="plus" class="size-4"></i>Add line item</button>

        {{-- Totals --}}
        <div class="mt-5 flex justify-end">
            <div class="w-full max-w-xs space-y-2">
                <div class="flex justify-between text-sm"><span class="text-muted-foreground">Subtotal</span><span class="font-medium" x-text="'$' + subtotal.toFixed(2)"></span></div>
                <div class="flex items-center justify-between text-sm"><span class="text-muted-foreground">Tax (<span x-text="taxRate"></span>%)</span><span class="font-medium" x-text="'$' + tax.toFixed(2)"></span></div>
                <div class="flex justify-between border-t border-border pt-2 text-base font-bold"><span>Total</span><span class="text-primary" x-text="'$' + total.toFixed(2)"></span></div>
            </div>
        </div>
    </x-ui.card>
</div>
