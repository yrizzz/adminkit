<div>
    <x-page-header :title="'Add Product'" subtitle="Pages · create a new catalog item">
        <x-slot:actions>
            <x-ui.button variant="outline" :href="route('page', ['path' => 'products'])" wire:navigate>Cancel</x-ui.button>
            <x-ui.button icon="check" x-on:click="window.toast('Product saved', { variant: 'success' })">Save product</x-ui.button>
        </x-slot:actions>
    </x-page-header>

    <div class="grid grid-cols-1 gap-4 lg:grid-cols-[1fr_340px]">
        <div class="space-y-4">
            <x-ui.card title="General">
                <div class="space-y-4">
                    <x-ui.input label="Product name" placeholder="e.g. Wireless Headphones" />
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-foreground">Description</label>
                        <textarea rows="4" placeholder="Describe your product…" class="w-full rounded-lg border border-input bg-background px-3 py-2 text-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring"></textarea>
                    </div>
                </div>
            </x-ui.card>

            <x-ui.card title="Media">
                <div class="grid grid-cols-2 gap-3 sm:grid-cols-4">
                    <label class="flex aspect-square cursor-pointer flex-col items-center justify-center gap-1.5 rounded-xl border-2 border-dashed border-border text-muted-foreground transition-colors hover:border-primary hover:text-primary">
                        <i data-lucide="upload" class="size-6"></i><span class="text-xs font-medium">Upload</span>
                        <input type="file" class="hidden">
                    </label>
                    @foreach (['a','b','c'] as $s)
                        <div class="group relative aspect-square overflow-hidden rounded-xl border border-border">
                            <img src="https://picsum.photos/seed/new-{{ $s }}/200/200" alt="" class="size-full object-cover" />
                            <button class="absolute end-1.5 top-1.5 grid size-6 place-items-center rounded-full bg-black/50 text-white opacity-0 transition group-hover:opacity-100"><i data-lucide="x" class="size-3.5"></i></button>
                        </div>
                    @endforeach
                </div>
            </x-ui.card>

            <x-ui.card title="Pricing">
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                    <x-ui.input label="Price" placeholder="0.00" icon="dollar-sign" />
                    <x-ui.input label="Compare at" placeholder="0.00" icon="dollar-sign" />
                    <x-ui.input label="Cost" placeholder="0.00" icon="dollar-sign" />
                </div>
            </x-ui.card>
        </div>

        {{-- Side --}}
        <div class="space-y-4">
            <x-ui.card title="Status">
                <select class="flex h-10 w-full rounded-lg border border-input bg-background px-3 text-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring"><option>Draft</option><option>Active</option><option>Archived</option></select>
                <label class="mt-3 flex items-center gap-2.5 text-sm"><input type="checkbox" checked class="size-4 rounded border-input text-primary focus:ring-primary">Featured product</label>
            </x-ui.card>
            <x-ui.card title="Organization">
                <div class="space-y-4">
                    <div><label class="mb-1.5 block text-sm font-medium">Category</label><select class="flex h-10 w-full rounded-lg border border-input bg-background px-3 text-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring"><option>Audio</option><option>Wearables</option><option>Accessories</option><option>Cameras</option></select></div>
                    <x-ui.input label="Vendor" placeholder="Brand name" />
                    <x-ui.input label="Tags" placeholder="new, sale, popular" />
                </div>
            </x-ui.card>
            <x-ui.card title="Inventory">
                <div class="grid grid-cols-2 gap-4">
                    <x-ui.input label="SKU" placeholder="ABC-123" />
                    <x-ui.input label="Stock" placeholder="0" />
                </div>
            </x-ui.card>
        </div>
    </div>
</div>
