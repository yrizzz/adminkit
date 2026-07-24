<div>
    <x-page-header :title="$pageTitle" subtitle="Ui Elements · variants, sizes, icons & states">
        <x-slot:actions><x-ui.button variant="outline" icon="arrow-left" class="[&>svg]:rtl-flip" :href="route('ui.elements')">All elements</x-ui.button></x-slot:actions>
    </x-page-header>

    <x-demo-section title="Variants" desc="Eight built-in looks." />
    <x-ui.card>
        <div class="flex flex-wrap gap-2">
            @foreach (['default'=>'Primary','secondary'=>'Secondary','outline'=>'Outline','ghost'=>'Ghost','destructive'=>'Destructive','success'=>'Success','soft'=>'Soft','link'=>'Link'] as $v => $l)
                <x-ui.button :variant="$v">{{ $l }}</x-ui.button>
            @endforeach
        </div>
    </x-ui.card>

    <x-demo-section title="Sizes" desc="From compact to prominent." />
    <x-ui.card>
        <div class="flex flex-wrap items-center gap-2">
            <x-ui.button size="sm">Small</x-ui.button>
            <x-ui.button>Default</x-ui.button>
            <x-ui.button size="lg">Large</x-ui.button>
            <x-ui.button size="icon" icon="heart" aria-label="Like" />
            <x-ui.button size="icon-sm" icon="star" aria-label="Star" />
        </div>
    </x-ui.card>

    <x-demo-section title="With icons" desc="Leading, trailing and icon-only." />
    <x-ui.card>
        <div class="flex flex-wrap items-center gap-2">
            <x-ui.button icon="download">Download</x-ui.button>
            <x-ui.button variant="outline" iconEnd="arrow-right" class="[&>svg]:rtl-flip">Continue</x-ui.button>
            <x-ui.button variant="secondary" icon="plus">Create new</x-ui.button>
            <x-ui.button variant="destructive" icon="trash-2">Delete</x-ui.button>
            <x-ui.button variant="success" icon="check">Approve</x-ui.button>
        </div>
    </x-ui.card>

    <x-demo-section title="States" desc="Loading, disabled and active." />
    <x-ui.card>
        <div class="flex flex-wrap items-center gap-2">
            <x-ui.button :loading="true">Saving…</x-ui.button>
            <x-ui.button variant="outline" :loading="true">Loading</x-ui.button>
            <x-ui.button disabled>Disabled</x-ui.button>
            <x-ui.button variant="outline" disabled>Disabled outline</x-ui.button>
            <x-ui.button class="ring-2 ring-ring ring-offset-2 ring-offset-background">Focused</x-ui.button>
        </div>
    </x-ui.card>

    <x-demo-section title="Shapes & block" desc="Pills, squares and full-width." />
    <div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
        <x-ui.card title="Rounded">
            <div class="flex flex-wrap items-center gap-2">
                <x-ui.button class="rounded-full">Pill button</x-ui.button>
                <x-ui.button variant="outline" class="rounded-full" icon="sparkles">Pill outline</x-ui.button>
                <x-ui.button variant="secondary" class="rounded-none">Square</x-ui.button>
                <x-ui.button size="icon" icon="plus" class="rounded-full" aria-label="Add" />
            </div>
        </x-ui.card>
        <x-ui.card title="Block & social">
            <div class="space-y-2">
                <x-ui.button class="w-full" icon="log-in">Full width</x-ui.button>
                <div class="grid grid-cols-2 gap-2">
                    <button class="inline-flex h-10 items-center justify-center gap-2 rounded-lg border border-input text-sm font-medium hover:bg-accent"><i data-lucide="chrome" class="size-4"></i>Google</button>
                    <button class="inline-flex h-10 items-center justify-center gap-2 rounded-lg bg-neutral-900 text-sm font-medium text-white hover:opacity-90"><i data-lucide="github" class="size-4"></i>GitHub</button>
                </div>
            </div>
        </x-ui.card>
    </div>

    <x-demo-section title="Gradient & elevated" desc="For hero actions." />
    <x-ui.card>
        <div class="flex flex-wrap items-center gap-3">
            <button class="inline-flex h-11 items-center gap-2 rounded-lg bg-gradient-to-r from-primary to-sidebar-primary px-6 text-sm font-semibold text-white shadow-lg shadow-primary/30 transition hover:opacity-95"><i data-lucide="rocket" class="size-4"></i>Get started</button>
            <button class="inline-flex h-11 items-center gap-2 rounded-lg bg-gradient-to-r from-fuchsia-500 to-pink-600 px-6 text-sm font-semibold text-white shadow-lg shadow-fuchsia-500/30 transition hover:opacity-95"><i data-lucide="sparkles" class="size-4"></i>Upgrade</button>
            <button class="grid size-12 place-items-center rounded-full bg-primary text-primary-foreground shadow-xl shadow-primary/40 transition hover:scale-105"><i data-lucide="plus" class="size-5"></i></button>
        </div>
    </x-ui.card>
</div>
