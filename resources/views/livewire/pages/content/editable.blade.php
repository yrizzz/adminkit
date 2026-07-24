<div>
    <x-page-header :title="$pageTitle" subtitle="Tables · edit cells inline, add & remove rows">
        <x-slot:actions><x-ui.button variant="outline" icon="arrow-left" class="[&>svg]:rtl-flip" :href="route('tables')">All tables</x-ui.button></x-slot:actions>
    </x-page-header>

    <x-ui.alert variant="info" title="Try it" class="mb-4">Click any <span class="font-medium">product</span>, <span class="font-medium">price</span> or <span class="font-medium">stock</span> cell to edit it inline. Totals update live.</x-ui.alert>

    {{-- ══ Click-to-edit cells ══ --}}
    <x-ui.card :padded="false"
        x-data="{
            editing: null,
            nextId: 100,
            rows: [
                { id:1, name:'Wireless Headphones', category:'Audio',       price:129, stock:342, active:true },
                { id:2, name:'Mechanical Keyboard',  category:'Accessories', price:89,  stock:521, active:true },
                { id:3, name:'4K Action Camera',     category:'Cameras',     price:199, stock:87,  active:false },
                { id:4, name:'USB-C Hub 7-in-1',     category:'Accessories', price:45,  stock:156, active:true },
                { id:5, name:'Smart Watch Series 7', category:'Wearables',   price:249, stock:0,   active:false },
            ],
            edit(id, field) { this.editing = id + ':' + field },
            isEditing(id, field) { return this.editing === id + ':' + field },
            addRow() { this.rows.push({ id: this.nextId++, name: 'New product', category: 'Uncategorised', price: 0, stock: 0, active: true }); this.$nextTick(() => window.renderIcons && window.renderIcons()) },
            remove(id) { this.rows = this.rows.filter(r => r.id !== id) },
            get total() { return this.rows.reduce((s, r) => s + r.price * r.stock, 0) },
            get units() { return this.rows.reduce((s, r) => s + Number(r.stock), 0) },
            fmt(n) { return '$' + Number(n).toLocaleString() },
        }"
        x-init="$nextTick(() => window.renderIcons && window.renderIcons())"
    >
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-border text-xs uppercase tracking-wide text-muted-foreground">
                        <th class="p-3 text-start font-medium">Product</th>
                        <th class="p-3 text-start font-medium">Category</th>
                        <th class="w-28 p-3 text-end font-medium">Price</th>
                        <th class="w-24 p-3 text-end font-medium">Stock</th>
                        <th class="w-28 p-3 text-end font-medium">Value</th>
                        <th class="w-24 p-3 text-center font-medium">Active</th>
                        <th class="w-12 p-3"></th>
                    </tr>
                </thead>
                <tbody>
                    <template x-for="r in rows" :key="r.id">
                        <tr class="group border-b border-border last:border-0 hover:bg-accent/30">
                            {{-- name --}}
                            <td class="p-2">
                                <template x-if="isEditing(r.id, 'name')">
                                    <input x-init="$nextTick(() => { $el.focus(); $el.select && $el.select() })" x-model="r.name" @blur="editing = null" @keydown.enter="editing = null" class="w-full rounded-md border border-primary bg-background px-2 py-1.5 text-sm focus:outline-none">
                                </template>
                                <template x-if="! isEditing(r.id, 'name')">
                                    <button @click="edit(r.id, 'name')" class="flex w-full items-center gap-1.5 rounded-md px-2 py-1.5 text-start font-medium hover:bg-accent"><span x-text="r.name"></span><i data-lucide="pencil" class="size-3 text-muted-foreground opacity-0 transition group-hover:opacity-100"></i></button>
                                </template>
                            </td>
                            {{-- category --}}
                            <td class="p-2">
                                <select x-model="r.category" class="w-full rounded-md border border-transparent bg-transparent px-2 py-1.5 text-sm text-muted-foreground hover:border-input focus:border-input focus:outline-none">
                                    <option>Audio</option><option>Accessories</option><option>Cameras</option><option>Wearables</option><option>Uncategorised</option>
                                </select>
                            </td>
                            {{-- price --}}
                            <td class="p-2 text-end">
                                <template x-if="isEditing(r.id, 'price')">
                                    <input type="number" min="0" x-init="$nextTick(() => { $el.focus(); $el.select && $el.select() })" x-model.number="r.price" @blur="editing = null" @keydown.enter="editing = null" class="w-full rounded-md border border-primary bg-background px-2 py-1.5 text-end text-sm focus:outline-none">
                                </template>
                                <template x-if="! isEditing(r.id, 'price')">
                                    <button @click="edit(r.id, 'price')" class="w-full rounded-md px-2 py-1.5 text-end hover:bg-accent" x-text="fmt(r.price)"></button>
                                </template>
                            </td>
                            {{-- stock --}}
                            <td class="p-2 text-end">
                                <template x-if="isEditing(r.id, 'stock')">
                                    <input type="number" min="0" x-init="$nextTick(() => { $el.focus(); $el.select && $el.select() })" x-model.number="r.stock" @blur="editing = null" @keydown.enter="editing = null" class="w-full rounded-md border border-primary bg-background px-2 py-1.5 text-end text-sm focus:outline-none">
                                </template>
                                <template x-if="! isEditing(r.id, 'stock')">
                                    <button @click="edit(r.id, 'stock')" class="w-full rounded-md px-2 py-1.5 text-end hover:bg-accent" :class="r.stock == 0 && 'text-destructive font-semibold'" x-text="r.stock"></button>
                                </template>
                            </td>
                            {{-- value --}}
                            <td class="p-3 text-end font-medium text-muted-foreground" x-text="fmt(r.price * r.stock)"></td>
                            {{-- active toggle --}}
                            <td class="p-3">
                                <div class="flex justify-center">
                                    <button type="button" @click="r.active = ! r.active" class="relative h-5 w-9 shrink-0 rounded-full transition-colors" :class="r.active ? 'bg-success' : 'bg-muted'">
                                        <span class="absolute top-0.5 start-0.5 size-4 rounded-full bg-white shadow transition-transform" :class="r.active && 'translate-x-4 rtl:-translate-x-4'"></span>
                                    </button>
                                </div>
                            </td>
                            {{-- delete --}}
                            <td class="p-2 text-center">
                                <button @click="remove(r.id)" class="rounded-lg p-1.5 text-muted-foreground opacity-0 transition hover:bg-accent hover:text-destructive group-hover:opacity-100"><i data-lucide="trash-2" class="size-4"></i></button>
                            </td>
                        </tr>
                    </template>
                </tbody>
                <tfoot>
                    <tr class="border-t-2 border-border bg-muted/30 font-semibold">
                        <td class="p-3" colspan="3">Totals</td>
                        <td class="p-3 text-end" x-text="units.toLocaleString()"></td>
                        <td class="p-3 text-end text-primary" x-text="fmt(total)"></td>
                        <td colspan="2"></td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="border-t border-border p-3">
            <button @click="addRow()" class="flex items-center gap-1.5 rounded-lg px-2.5 py-1.5 text-sm font-medium text-primary hover:bg-accent"><i data-lucide="plus" class="size-4"></i>Add row</button>
        </div>
    </x-ui.card>

    {{-- ══ Bulk edit form-in-table ══ --}}
    <x-demo-section title="Editable form rows" desc="A table where every row is a small form — great for line items." />
    <x-ui.card :padded="false"
        x-data="{
            lines: [ { desc:'Design services', qty:1, rate:1200 }, { desc:'Development', qty:40, rate:85 } ],
            add() { this.lines.push({ desc:'', qty:1, rate:0 }); this.$nextTick(() => window.renderIcons && window.renderIcons()) },
            get subtotal() { return this.lines.reduce((s, l) => s + l.qty * l.rate, 0) },
        }"
        x-init="$nextTick(() => window.renderIcons && window.renderIcons())"
    >
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead><tr class="border-b border-border text-xs uppercase tracking-wide text-muted-foreground"><th class="p-3 text-start font-medium">Description</th><th class="w-24 p-3 text-center font-medium">Qty</th><th class="w-32 p-3 text-end font-medium">Rate</th><th class="w-32 p-3 text-end font-medium">Amount</th><th class="w-12"></th></tr></thead>
                <tbody>
                    <template x-for="(l, i) in lines" :key="i">
                        <tr class="border-b border-border">
                            <td class="p-2"><input x-model="l.desc" placeholder="Item description" class="w-full rounded-md border border-transparent bg-transparent px-2 py-1.5 hover:border-input focus:border-input focus:outline-none"></td>
                            <td class="p-2"><input type="number" min="1" x-model.number="l.qty" class="w-full rounded-md border border-transparent bg-transparent px-2 py-1.5 text-center hover:border-input focus:border-input focus:outline-none"></td>
                            <td class="p-2"><input type="number" min="0" x-model.number="l.rate" class="w-full rounded-md border border-transparent bg-transparent px-2 py-1.5 text-end hover:border-input focus:border-input focus:outline-none"></td>
                            <td class="p-3 text-end font-medium" x-text="'$' + (l.qty * l.rate).toLocaleString()"></td>
                            <td class="p-2 text-center"><button @click="lines.splice(i, 1)" class="rounded-lg p-1.5 text-muted-foreground hover:bg-accent hover:text-destructive"><i data-lucide="trash-2" class="size-4"></i></button></td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>
        <div class="flex items-center justify-between border-t border-border p-3">
            <button @click="add()" class="flex items-center gap-1.5 rounded-lg px-2.5 py-1.5 text-sm font-medium text-primary hover:bg-accent"><i data-lucide="plus" class="size-4"></i>Add line</button>
            <p class="text-sm">Subtotal: <span class="text-lg font-bold text-primary" x-text="'$' + subtotal.toLocaleString()"></span></p>
        </div>
    </x-ui.card>
</div>
