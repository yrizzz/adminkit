<div>
    <x-page-header :title="$pageTitle" subtitle="Ui Elements · hierarchy & wayfinding">
        <x-slot:actions><x-ui.button variant="outline" icon="arrow-left" class="[&>svg]:rtl-flip" :href="route('ui.elements')">All elements</x-ui.button></x-slot:actions>
    </x-page-header>

    <x-demo-section title="Separators" desc="Chevron, slash and arrow." />
    <x-ui.card>
        <div class="space-y-4">
            <nav class="flex items-center gap-1.5 text-sm">
                <a href="#" class="text-muted-foreground hover:text-foreground">Home</a>
                <i data-lucide="chevron-right" class="rtl-flip size-4 text-muted-foreground/50"></i>
                <a href="#" class="text-muted-foreground hover:text-foreground">Pages</a>
                <i data-lucide="chevron-right" class="rtl-flip size-4 text-muted-foreground/50"></i>
                <span class="font-medium">Breadcrumb</span>
            </nav>
            <nav class="flex items-center gap-2 text-sm">
                <a href="#" class="text-muted-foreground hover:text-foreground">Home</a><span class="text-muted-foreground/50">/</span>
                <a href="#" class="text-muted-foreground hover:text-foreground">Pages</a><span class="text-muted-foreground/50">/</span>
                <span class="font-medium">Breadcrumb</span>
            </nav>
            <nav class="flex items-center gap-2 text-sm">
                <a href="#" class="text-muted-foreground hover:text-foreground">Home</a>
                <i data-lucide="arrow-right" class="rtl-flip size-3.5 text-muted-foreground/50"></i>
                <a href="#" class="text-muted-foreground hover:text-foreground">Pages</a>
                <i data-lucide="arrow-right" class="rtl-flip size-3.5 text-muted-foreground/50"></i>
                <span class="font-medium">Breadcrumb</span>
            </nav>
        </div>
    </x-ui.card>

    <x-demo-section title="With icons" desc="An icon per level." />
    <x-ui.card>
        <nav class="flex flex-wrap items-center gap-1.5 text-sm">
            @foreach ([['house','Home',false],['folder','Projects',false],['file-text','Q3 Report',true]] as [$ic,$l,$last])
                @if (! $loop->first)<i data-lucide="chevron-right" class="rtl-flip size-4 text-muted-foreground/50"></i>@endif
                <span class="inline-flex items-center gap-1.5 {{ $last ? 'font-medium' : 'text-muted-foreground hover:text-foreground' }}">
                    <i data-lucide="{{ $ic }}" class="size-4"></i>{{ $l }}
                </span>
            @endforeach
        </nav>
    </x-ui.card>

    <x-demo-section title="Filled & collapsed" desc="A contained bar and a truncated trail." />
    <div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
        <x-ui.card title="Filled">
            <nav class="inline-flex items-center gap-1.5 rounded-lg bg-muted/60 px-3 py-2 text-sm">
                <a href="#" class="text-muted-foreground hover:text-foreground"><i data-lucide="house" class="size-4"></i></a>
                <i data-lucide="chevron-right" class="rtl-flip size-4 text-muted-foreground/50"></i>
                <a href="#" class="text-muted-foreground hover:text-foreground">Library</a>
                <i data-lucide="chevron-right" class="rtl-flip size-4 text-muted-foreground/50"></i>
                <span class="font-medium">Data</span>
            </nav>
        </x-ui.card>
        <x-ui.card title="Collapsed">
            <nav class="flex items-center gap-1.5 text-sm">
                <a href="#" class="text-muted-foreground hover:text-foreground">Home</a>
                <i data-lucide="chevron-right" class="rtl-flip size-4 text-muted-foreground/50"></i>
                <button class="rounded px-1.5 text-muted-foreground hover:bg-accent hover:text-foreground">…</button>
                <i data-lucide="chevron-right" class="rtl-flip size-4 text-muted-foreground/50"></i>
                <a href="#" class="text-muted-foreground hover:text-foreground">Reports</a>
                <i data-lucide="chevron-right" class="rtl-flip size-4 text-muted-foreground/50"></i>
                <span class="font-medium">Q3</span>
            </nav>
        </x-ui.card>
    </div>
</div>
