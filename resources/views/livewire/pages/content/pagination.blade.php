<div>
    <x-page-header :title="$pageTitle" subtitle="Ui Elements · paging through results">
        <x-slot:actions><x-ui.button variant="outline" icon="arrow-left" class="[&>svg]:rtl-flip" :href="route('ui.elements')">All elements</x-ui.button></x-slot:actions>
    </x-page-header>

    <x-demo-section title="Numbered" desc="Fully interactive — click a page." />
    <x-ui.card>
        <div x-data="{ page: 3, last: 8 }">
            <div class="flex flex-wrap items-center gap-1">
                <button @click="page = Math.max(1, page - 1)" :disabled="page === 1" class="grid size-9 place-items-center rounded-lg border border-border text-muted-foreground hover:bg-accent disabled:opacity-40"><i data-lucide="chevron-left" class="rtl-flip size-4"></i></button>
                <template x-for="n in last" :key="n">
                    <button @click="page = n" class="grid size-9 place-items-center rounded-lg text-sm font-medium transition-colors"
                            :class="page === n ? 'bg-primary text-primary-foreground' : 'border border-border text-muted-foreground hover:bg-accent'" x-text="n"></button>
                </template>
                <button @click="page = Math.min(last, page + 1)" :disabled="page === last" class="grid size-9 place-items-center rounded-lg border border-border text-muted-foreground hover:bg-accent disabled:opacity-40"><i data-lucide="chevron-right" class="rtl-flip size-4"></i></button>
            </div>
            <p class="mt-3 text-sm text-muted-foreground">Showing page <span class="font-semibold text-foreground" x-text="page"></span> of <span x-text="last"></span></p>
        </div>
    </x-ui.card>

    <x-demo-section title="Simple & compact" desc="When space is tight." />
    <div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
        <x-ui.card title="Prev / Next">
            <div class="flex items-center justify-between">
                <x-ui.button variant="outline" icon="arrow-left" class="[&>svg]:rtl-flip">Previous</x-ui.button>
                <span class="text-sm text-muted-foreground">Page 3 of 8</span>
                <x-ui.button variant="outline" iconEnd="arrow-right" class="[&>svg]:rtl-flip">Next</x-ui.button>
            </div>
        </x-ui.card>

        <x-ui.card title="Compact with ellipsis">
            <div class="flex items-center gap-1">
                <button class="grid size-9 place-items-center rounded-lg border border-border text-muted-foreground hover:bg-accent"><i data-lucide="chevron-left" class="rtl-flip size-4"></i></button>
                @foreach (['1','2','…','7','8'] as $p)
                    @if ($p === '…')
                        <span class="grid size-9 place-items-center text-sm text-muted-foreground">…</span>
                    @else
                        <button class="grid size-9 place-items-center rounded-lg text-sm font-medium {{ $p === '2' ? 'bg-primary text-primary-foreground' : 'border border-border text-muted-foreground hover:bg-accent' }}">{{ $p }}</button>
                    @endif
                @endforeach
                <button class="grid size-9 place-items-center rounded-lg border border-border text-muted-foreground hover:bg-accent"><i data-lucide="chevron-right" class="rtl-flip size-4"></i></button>
            </div>
        </x-ui.card>
    </div>

    <x-demo-section title="Table footer" desc="Results count and page-size selector." />
    <x-ui.card :padded="false">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead><tr class="border-b border-border text-xs uppercase tracking-wide text-muted-foreground"><th class="p-4 text-start font-medium">Name</th><th class="p-4 text-start font-medium">Role</th></tr></thead>
                <tbody>
                    @foreach ([['Aisha Rahman','Admin'],['David Chen','Editor'],['Sofia Martinez','Viewer']] as [$n,$r])
                        <tr class="border-b border-border last:border-0"><td class="p-4">{{ $n }}</td><td class="p-4 text-muted-foreground">{{ $r }}</td></tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="flex flex-col items-center justify-between gap-3 border-t border-border p-4 sm:flex-row">
            <div class="flex items-center gap-2 text-sm text-muted-foreground">
                Rows per page
                <select class="h-8 rounded-lg border border-input bg-background px-2 text-sm"><option>10</option><option>25</option><option>50</option></select>
            </div>
            <p class="text-sm text-muted-foreground">1–3 of 248 results</p>
            <div class="flex gap-1">
                <button class="grid size-8 place-items-center rounded-lg border border-border text-muted-foreground hover:bg-accent"><i data-lucide="chevron-left" class="rtl-flip size-4"></i></button>
                <button class="grid size-8 place-items-center rounded-lg border border-border text-muted-foreground hover:bg-accent"><i data-lucide="chevron-right" class="rtl-flip size-4"></i></button>
            </div>
        </div>
    </x-ui.card>
</div>
