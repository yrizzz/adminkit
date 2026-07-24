<div>
    <x-page-header :title="$pageTitle" subtitle="Ui Elements · grouped and segmented actions">
        <x-slot:actions><x-ui.button variant="outline" icon="arrow-left" class="[&>svg]:rtl-flip" :href="route('ui.elements')">All elements</x-ui.button></x-slot:actions>
    </x-page-header>

    <x-demo-section title="Horizontal group" desc="Joined buttons that act as one control." />
    <x-ui.card>
        <div class="flex flex-wrap items-center gap-6">
            <div class="inline-flex overflow-hidden rounded-lg border border-border">
                @foreach (['Left','Center','Right'] as $i => $l)
                    <button class="px-4 py-2 text-sm font-medium transition-colors {{ $i === 0 ? 'bg-primary text-primary-foreground' : 'hover:bg-accent' }} {{ $i > 0 ? 'border-s border-border' : '' }}">{{ $l }}</button>
                @endforeach
            </div>
            <div class="inline-flex overflow-hidden rounded-lg border border-border">
                @foreach (['align-left','align-center','align-right','align-justify'] as $i => $ic)
                    <button class="grid size-9 place-items-center transition-colors {{ $i === 1 ? 'bg-primary text-primary-foreground' : 'text-muted-foreground hover:bg-accent' }} {{ $i > 0 ? 'border-s border-border' : '' }}"><i data-lucide="{{ $ic }}" class="size-4"></i></button>
                @endforeach
            </div>
        </div>
    </x-ui.card>

    <x-demo-section title="Segmented control" desc="A soft, pill-style toggle group." />
    <x-ui.card>
        <div x-data="{ tab: 'week' }" class="flex flex-wrap items-center gap-6">
            <div class="inline-flex gap-1 rounded-lg bg-muted/60 p-1">
                @foreach (['day'=>'Day','week'=>'Week','month'=>'Month','year'=>'Year'] as $k => $l)
                    <button @click="tab = '{{ $k }}'" class="rounded-md px-3.5 py-1.5 text-sm font-medium transition-colors" :class="tab === '{{ $k }}' ? 'bg-card text-foreground shadow-sm' : 'text-muted-foreground hover:text-foreground'">{{ $l }}</button>
                @endforeach
            </div>
            <p class="text-sm text-muted-foreground">Selected: <span class="font-semibold text-foreground" x-text="tab"></span></p>
        </div>
    </x-ui.card>

    <x-demo-section title="Vertical group" desc="Stacked actions." />
    <div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
        <x-ui.card title="Vertical">
            <div class="inline-flex w-44 flex-col overflow-hidden rounded-lg border border-border">
                @foreach (['Profile','Settings','Billing','Sign out'] as $i => $l)
                    <button class="px-4 py-2 text-start text-sm font-medium transition-colors hover:bg-accent {{ $i > 0 ? 'border-t border-border' : '' }}">{{ $l }}</button>
                @endforeach
            </div>
        </x-ui.card>

        <x-ui.card title="Split button">
            <div class="inline-flex overflow-hidden rounded-lg">
                <button class="bg-primary px-4 py-2 text-sm font-medium text-primary-foreground hover:bg-primary/90">Save</button>
                <x-ui.dropdown align="end" width="w-44">
                    <x-slot:trigger>
                        <button class="grid size-9 place-items-center border-s border-white/20 bg-primary text-primary-foreground hover:bg-primary/90"><i data-lucide="chevron-down" class="size-4"></i></button>
                    </x-slot:trigger>
                    <x-ui.dropdown-item icon="save">Save &amp; close</x-ui.dropdown-item>
                    <x-ui.dropdown-item icon="copy">Save as copy</x-ui.dropdown-item>
                    <x-ui.dropdown-item icon="file-down">Save as draft</x-ui.dropdown-item>
                </x-ui.dropdown>
            </div>
        </x-ui.card>
    </div>

    <x-demo-section title="Toolbar" desc="Multiple groups side by side." />
    <x-ui.card>
        <div class="flex flex-wrap items-center gap-2">
            @foreach ([['bold','italic','underline'], ['list','list-ordered'], ['link','image','code']] as $group)
                <div class="inline-flex overflow-hidden rounded-lg border border-border">
                    @foreach ($group as $i => $ic)
                        <button class="grid size-9 place-items-center text-muted-foreground transition-colors hover:bg-accent hover:text-foreground {{ $i > 0 ? 'border-s border-border' : '' }}"><i data-lucide="{{ $ic }}" class="size-4"></i></button>
                    @endforeach
                </div>
            @endforeach
        </div>
    </x-ui.card>
</div>
