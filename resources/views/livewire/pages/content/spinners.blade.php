<div>
    <x-page-header :title="$pageTitle" subtitle="Ui Elements · loading indicators">
        <x-slot:actions><x-ui.button variant="outline" icon="arrow-left" class="[&>svg]:rtl-flip" :href="route('ui.elements')">All elements</x-ui.button></x-slot:actions>
    </x-page-header>

    <x-demo-section title="Styles" desc="Ring, dots, bars and pulse." />
    <x-ui.card>
        <div class="flex flex-wrap items-center gap-10">
            <div class="text-center"><i data-lucide="loader-circle" class="mx-auto size-8 animate-spin text-primary"></i><p class="mt-2 text-xs text-muted-foreground">Ring</p></div>
            <div class="text-center">
                <div class="flex gap-1.5">
                    <span class="size-2.5 animate-bounce rounded-full bg-primary [animation-delay:-0.3s]"></span>
                    <span class="size-2.5 animate-bounce rounded-full bg-primary [animation-delay:-0.15s]"></span>
                    <span class="size-2.5 animate-bounce rounded-full bg-primary"></span>
                </div>
                <p class="mt-2 text-xs text-muted-foreground">Dots</p>
            </div>
            <div class="text-center">
                <div class="flex items-end gap-1">
                    @foreach (['-0.4s','-0.2s','0s','-0.3s'] as $d)
                        <span class="h-6 w-1.5 animate-pulse rounded-full bg-primary" style="animation-delay: {{ $d }}"></span>
                    @endforeach
                </div>
                <p class="mt-2 text-xs text-muted-foreground">Bars</p>
            </div>
            <div class="text-center"><span class="mx-auto block size-7 animate-ping rounded-full bg-primary/60"></span><p class="mt-2 text-xs text-muted-foreground">Pulse</p></div>
            <div class="text-center"><span class="mx-auto block size-8 animate-spin rounded-full border-4 border-muted border-t-primary"></span><p class="mt-2 text-xs text-muted-foreground">Border</p></div>
        </div>
    </x-ui.card>

    <x-demo-section title="Sizes & colours" desc="Scale and tone to context." />
    <div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
        <x-ui.card title="Sizes">
            <div class="flex items-center gap-6">
                @foreach (['size-4','size-6','size-8','size-12'] as $s)
                    <i data-lucide="loader-circle" class="{{ $s }} animate-spin text-primary"></i>
                @endforeach
            </div>
        </x-ui.card>
        <x-ui.card title="Colours">
            <div class="flex items-center gap-6">
                @foreach (['text-primary','text-success','text-[hsl(var(--warning))]','text-destructive','text-muted-foreground'] as $c)
                    <i data-lucide="loader-circle" class="size-7 animate-spin {{ $c }}"></i>
                @endforeach
            </div>
        </x-ui.card>
    </div>

    <x-demo-section title="In context" desc="Buttons, cards and overlays." />
    <div class="grid grid-cols-1 gap-4 lg:grid-cols-3">
        <x-ui.card title="Buttons">
            <div class="space-y-2">
                <x-ui.button :loading="true" class="w-full">Saving…</x-ui.button>
                <x-ui.button variant="outline" :loading="true" class="w-full">Loading</x-ui.button>
            </div>
        </x-ui.card>

        <x-ui.card title="Inline / with text">
            <div class="space-y-3">
                <p class="flex items-center gap-2 text-sm text-muted-foreground"><i data-lucide="loader-circle" class="size-4 animate-spin"></i>Fetching results…</p>
                <p class="flex items-center gap-2 text-sm text-muted-foreground"><i data-lucide="loader-circle" class="size-4 animate-spin text-primary"></i>Syncing your workspace</p>
            </div>
        </x-ui.card>

        <x-ui.card title="Overlay" :padded="false">
            <div class="relative p-5">
                <div class="space-y-2 opacity-40">
                    <div class="h-3 w-3/4 rounded bg-muted"></div>
                    <div class="h-3 w-full rounded bg-muted"></div>
                    <div class="h-3 w-2/3 rounded bg-muted"></div>
                </div>
                <div class="absolute inset-0 grid place-items-center rounded-xl bg-card/60 backdrop-blur-[1px]">
                    <i data-lucide="loader-circle" class="size-7 animate-spin text-primary"></i>
                </div>
            </div>
        </x-ui.card>
    </div>

    <x-demo-section title="Skeleton loading" desc="Shape placeholders while content arrives." />
    <x-ui.card>
        <div class="space-y-3">
            <div class="flex items-center gap-3"><div class="skeleton size-12 rounded-full"></div><div class="flex-1 space-y-2"><div class="skeleton h-3 w-1/3"></div><div class="skeleton h-3 w-1/4"></div></div></div>
            <div class="skeleton h-28 w-full rounded-xl"></div>
            <div class="skeleton h-3 w-full"></div>
            <div class="skeleton h-3 w-4/5"></div>
        </div>
    </x-ui.card>
</div>
