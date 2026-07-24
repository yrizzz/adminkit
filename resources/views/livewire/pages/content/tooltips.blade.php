<div>
    <x-page-header :title="$pageTitle" subtitle="Ui Elements · small hover hints">
        <x-slot:actions><x-ui.button variant="outline" icon="arrow-left" class="[&>svg]:rtl-flip" :href="route('ui.elements')">All elements</x-ui.button></x-slot:actions>
    </x-page-header>

    <x-demo-section title="Placements" desc="Hover each button." />
    <x-ui.card>
        <div class="flex flex-wrap items-center justify-center gap-10 py-12">
            @foreach ([
                ['Top','-top-2 start-1/2 -translate-x-1/2 -translate-y-full rtl:translate-x-1/2'],
                ['Bottom','-bottom-2 start-1/2 -translate-x-1/2 translate-y-full rtl:translate-x-1/2'],
                ['Start','-start-2 top-1/2 -translate-y-1/2 -translate-x-full rtl:translate-x-full'],
                ['End','-end-2 top-1/2 -translate-y-1/2 translate-x-full rtl:-translate-x-full'],
            ] as [$label,$pos])
                <div x-data="{ show: false }" @mouseenter="show = true" @mouseleave="show = false" class="relative">
                    <x-ui.button variant="outline">{{ $label }}</x-ui.button>
                    <span x-show="show" x-cloak x-transition
                          class="absolute {{ $pos }} z-30 whitespace-nowrap rounded-md bg-foreground px-2 py-1 text-xs font-medium text-background shadow-lg">
                        Tooltip on {{ strtolower($label) }}
                    </span>
                </div>
            @endforeach
        </div>
    </x-ui.card>

    <x-demo-section title="On icons" desc="The most common use — explaining icon-only controls." />
    <x-ui.card>
        <div class="flex flex-wrap items-center gap-3">
            @foreach ([['pencil','Edit'],['copy','Duplicate'],['share-2','Share'],['archive','Archive'],['trash-2','Delete']] as [$ic,$tip])
                <div x-data="{ show: false }" @mouseenter="show = true" @mouseleave="show = false" class="relative">
                    <button class="grid size-10 place-items-center rounded-lg border border-border text-muted-foreground transition-colors hover:bg-accent hover:text-foreground"><i data-lucide="{{ $ic }}" class="size-4"></i></button>
                    <span x-show="show" x-cloak x-transition
                          class="absolute -top-2 start-1/2 z-30 -translate-x-1/2 -translate-y-full whitespace-nowrap rounded-md bg-foreground px-2 py-1 text-xs font-medium text-background shadow-lg rtl:translate-x-1/2">{{ $tip }}</span>
                </div>
            @endforeach
        </div>
    </x-ui.card>

    <x-demo-section title="Rich & inline" desc="Multi-line hints and help cues in text." />
    <div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
        <x-ui.card title="Rich tooltip">
            <div x-data="{ show: false }" @mouseenter="show = true" @mouseleave="show = false" class="relative inline-block">
                <x-ui.button variant="secondary" icon="shield">Security score</x-ui.button>
                <div x-show="show" x-cloak x-transition class="absolute -top-2 start-0 z-30 w-56 -translate-y-full rounded-xl bg-foreground p-3 text-background shadow-xl">
                    <p class="text-xs font-bold">Security score: 82/100</p>
                    <p class="mt-1 text-[0.7rem] opacity-80">Enable two-factor authentication to gain 10 more points.</p>
                </div>
            </div>
        </x-ui.card>

        <x-ui.card title="Inline help">
            <p class="text-sm text-muted-foreground">
                Monthly recurring revenue
                <span x-data="{ show: false }" @mouseenter="show = true" @mouseleave="show = false" class="relative inline-flex">
                    <i data-lucide="circle-help" class="ms-1 size-3.5 cursor-help text-muted-foreground"></i>
                    <span x-show="show" x-cloak x-transition
                          class="absolute -top-2 start-1/2 z-30 w-48 -translate-x-1/2 -translate-y-full rounded-md bg-foreground px-2 py-1.5 text-[0.7rem] font-medium text-background shadow-lg rtl:translate-x-1/2">
                        Normalised monthly value of all active subscriptions.
                    </span>
                </span>
                grew 12% this quarter.
            </p>
        </x-ui.card>
    </div>
</div>
