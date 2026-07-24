<div>
    <x-page-header :title="$pageTitle" subtitle="Ui Elements · rich click-triggered overlays">
        <x-slot:actions><x-ui.button variant="outline" icon="arrow-left" class="[&>svg]:rtl-flip" :href="route('ui.elements')">All elements</x-ui.button></x-slot:actions>
    </x-page-header>

    <x-demo-section title="Placements" desc="Open above, below, left or right of the trigger." />
    <x-ui.card>
        <div class="flex flex-wrap items-center justify-center gap-8 py-10">
            @foreach ([
                ['Top','-top-2 start-1/2 -translate-x-1/2 -translate-y-full rtl:translate-x-1/2'],
                ['Bottom','-bottom-2 start-1/2 -translate-x-1/2 translate-y-full rtl:translate-x-1/2'],
                ['Start','-start-2 top-1/2 -translate-y-1/2 -translate-x-full rtl:translate-x-full'],
                ['End','-end-2 top-1/2 -translate-y-1/2 translate-x-full rtl:-translate-x-full'],
            ] as [$label,$pos])
                <div x-data="{ open: false }" @click.outside="open = false" class="relative">
                    <x-ui.button variant="outline" @click="open = ! open">{{ $label }}</x-ui.button>
                    <div x-show="open" x-cloak x-transition class="absolute {{ $pos }} z-30 w-56 rounded-xl border border-border bg-popover p-3 shadow-xl">
                        <p class="text-sm font-semibold">Popover {{ $label }}</p>
                        <p class="mt-1 text-xs text-muted-foreground">Anchored to the {{ strtolower($label) }} of the trigger.</p>
                    </div>
                </div>
            @endforeach
        </div>
    </x-ui.card>

    <x-demo-section title="With content & actions" desc="Popovers can hold anything." />
    <div class="grid grid-cols-1 gap-4 lg:grid-cols-3">
        <x-ui.card title="Confirmation">
            <div x-data="{ open: false }" @click.outside="open = false" class="relative inline-block">
                <x-ui.button variant="destructive" icon="trash-2" @click="open = ! open">Delete</x-ui.button>
                <div x-show="open" x-cloak x-transition class="absolute start-0 top-full z-30 mt-2 w-60 rounded-xl border border-border bg-popover p-4 shadow-xl">
                    <p class="text-sm font-semibold">Delete this item?</p>
                    <p class="mt-1 text-xs text-muted-foreground">This action can't be undone.</p>
                    <div class="mt-3 flex gap-2">
                        <x-ui.button size="sm" variant="destructive" @click="open = false; window.toast('Deleted', { variant: 'destructive' })">Delete</x-ui.button>
                        <x-ui.button size="sm" variant="ghost" @click="open = false">Cancel</x-ui.button>
                    </div>
                </div>
            </div>
        </x-ui.card>

        <x-ui.card title="User card">
            <div x-data="{ open: false }" @click.outside="open = false" class="relative inline-block">
                <button @click="open = ! open" class="inline-flex items-center gap-2 rounded-lg px-2 py-1 hover:bg-accent"><x-ui.avatar name="Aisha Rahman" size="sm" /><span class="text-sm font-medium">Aisha</span></button>
                <div x-show="open" x-cloak x-transition class="absolute start-0 top-full z-30 mt-2 w-64 rounded-xl border border-border bg-popover p-4 shadow-xl">
                    <div class="flex items-center gap-3"><x-ui.avatar name="Aisha Rahman" size="lg" status="online" /><div><p class="font-semibold">Aisha Rahman</p><p class="text-xs text-muted-foreground">Product Designer</p></div></div>
                    <p class="mt-3 text-xs text-muted-foreground">Working on the design system and onboarding flows.</p>
                    <div class="mt-3 flex gap-2"><x-ui.button size="sm" class="flex-1" icon="mail">Message</x-ui.button><x-ui.button size="sm" variant="outline" class="flex-1">Profile</x-ui.button></div>
                </div>
            </div>
        </x-ui.card>

        <x-ui.card title="Form">
            <div x-data="{ open: false }" @click.outside="open = false" class="relative inline-block">
                <x-ui.button variant="outline" icon="filter" @click="open = ! open">Filters</x-ui.button>
                <div x-show="open" x-cloak x-transition class="absolute start-0 top-full z-30 mt-2 w-64 rounded-xl border border-border bg-popover p-4 shadow-xl">
                    <p class="text-sm font-semibold">Filter results</p>
                    <div class="mt-3 space-y-2">
                        @foreach (['Active','Draft','Archived'] as $opt)
                            <label class="flex cursor-pointer items-center gap-2 text-sm"><input type="checkbox" class="size-4 rounded border-input text-primary focus:ring-primary">{{ $opt }}</label>
                        @endforeach
                    </div>
                    <x-ui.button size="sm" class="mt-3 w-full" @click="open = false">Apply</x-ui.button>
                </div>
            </div>
        </x-ui.card>
    </div>
</div>
