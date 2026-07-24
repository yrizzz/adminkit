<div>
    <x-page-header :title="$pageTitle" subtitle="Ui Elements · contextual menus">
        <x-slot:actions><x-ui.button variant="outline" icon="arrow-left" class="[&>svg]:rtl-flip" :href="route('ui.elements')">All elements</x-ui.button></x-slot:actions>
    </x-page-header>

    <x-demo-section title="Basic & with icons" desc="The standard menu." />
    <x-ui.card>
        <div class="flex flex-wrap items-center gap-4">
            <x-ui.dropdown align="start" width="w-44">
                <x-slot:trigger><x-ui.button variant="outline" iconEnd="chevron-down">Plain menu</x-ui.button></x-slot:trigger>
                <x-ui.dropdown-item>Profile</x-ui.dropdown-item>
                <x-ui.dropdown-item>Settings</x-ui.dropdown-item>
                <x-ui.dropdown-item>Billing</x-ui.dropdown-item>
            </x-ui.dropdown>

            <x-ui.dropdown align="start" width="w-52">
                <x-slot:trigger><x-ui.button iconEnd="chevron-down">With icons</x-ui.button></x-slot:trigger>
                <x-ui.dropdown-item icon="pencil">Edit</x-ui.dropdown-item>
                <x-ui.dropdown-item icon="copy">Duplicate</x-ui.dropdown-item>
                <x-ui.dropdown-item icon="share-2">Share</x-ui.dropdown-item>
                <div class="my-1 border-t border-border"></div>
                <x-ui.dropdown-item icon="trash-2" variant="destructive">Delete</x-ui.dropdown-item>
            </x-ui.dropdown>

            <x-ui.dropdown align="end" width="w-40">
                <x-slot:trigger><x-ui.button variant="ghost" size="icon" icon="ellipsis-vertical" aria-label="More" /></x-slot:trigger>
                <x-ui.dropdown-item icon="eye">View</x-ui.dropdown-item>
                <x-ui.dropdown-item icon="download">Download</x-ui.dropdown-item>
                <x-ui.dropdown-item icon="archive">Archive</x-ui.dropdown-item>
            </x-ui.dropdown>
        </div>
    </x-ui.card>

    <x-demo-section title="Rich menus" desc="Headers, user cards and selectable items." />
    <div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
        <x-ui.card title="With header">
            <x-ui.dropdown align="start" width="w-60">
                <x-slot:trigger><x-ui.button variant="outline" iconEnd="chevron-down">Account menu</x-ui.button></x-slot:trigger>
                <div class="flex items-center gap-3 px-2 py-2">
                    <x-ui.avatar name="Yrizzz Admin" size="md" status="online" />
                    <div class="min-w-0"><p class="truncate text-sm font-semibold">Yrizzz</p><p class="truncate text-xs text-muted-foreground">admin@adminkit.test</p></div>
                </div>
                <div class="my-1 border-t border-border"></div>
                <x-ui.dropdown-item icon="circle-user">Profile</x-ui.dropdown-item>
                <x-ui.dropdown-item icon="settings">Settings</x-ui.dropdown-item>
                <div class="my-1 border-t border-border"></div>
                <x-ui.dropdown-item icon="log-out" variant="destructive">Sign out</x-ui.dropdown-item>
            </x-ui.dropdown>
        </x-ui.card>

        <x-ui.card title="Selectable">
            <div x-data="{ sel: 'Newest' }" class="flex items-center gap-3">
                <x-ui.dropdown align="start" width="w-48">
                    <x-slot:trigger><x-ui.button variant="outline" iconEnd="chevron-down"><span x-text="sel"></span></x-ui.button></x-slot:trigger>
                    @foreach (['Newest','Oldest','Price: low to high','Price: high to low'] as $opt)
                        <button @click="sel = '{{ $opt }}'" class="flex w-full items-center gap-2.5 rounded-lg px-2.5 py-2 text-sm hover:bg-accent" :class="sel === '{{ $opt }}' && 'font-semibold text-primary'">
                            <i data-lucide="check" class="size-4" x-show="sel === '{{ $opt }}'"></i>
                            <span :class="sel !== '{{ $opt }}' && 'ms-6'">{{ $opt }}</span>
                        </button>
                    @endforeach
                </x-ui.dropdown>
                <p class="text-sm text-muted-foreground">Sorting by <span class="font-medium text-foreground" x-text="sel"></span></p>
            </div>
        </x-ui.card>
    </div>

    <x-demo-section title="Alignment" desc="Anchored to the start or end of the trigger." />
    <x-ui.card>
        <div class="flex flex-wrap items-center justify-between gap-4">
            <x-ui.dropdown align="start" width="w-44">
                <x-slot:trigger><x-ui.button variant="secondary" iconEnd="chevron-down">Align start</x-ui.button></x-slot:trigger>
                <x-ui.dropdown-item icon="arrow-left" class="[&>svg]:rtl-flip">Opens left-aligned</x-ui.dropdown-item>
            </x-ui.dropdown>
            <x-ui.dropdown align="end" width="w-44">
                <x-slot:trigger><x-ui.button variant="secondary" iconEnd="chevron-down">Align end</x-ui.button></x-slot:trigger>
                <x-ui.dropdown-item icon="arrow-right" class="[&>svg]:rtl-flip">Opens right-aligned</x-ui.dropdown-item>
            </x-ui.dropdown>
        </div>
    </x-ui.card>
</div>
