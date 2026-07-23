<div>
    <x-page-header :title="'Folders'" subtitle="Pages · browse folders with breadcrumb navigation">
        <x-slot:actions>
            <x-ui.button variant="outline" icon="arrow-left" class="[&>svg]:rtl-flip" :href="route('page', ['path' => 'files'])" wire:navigate>Files</x-ui.button>
            <x-ui.button icon="folder-plus">New folder</x-ui.button>
        </x-slot:actions>
    </x-page-header>

    {{-- Breadcrumb --}}
    <div class="mb-4 flex items-center gap-1.5 text-sm">
        @foreach (['My Drive','Projects','2026'] as $crumb)
            @if (! $loop->last)
                <a href="#" class="text-muted-foreground hover:text-foreground">{{ $crumb }}</a>
                <i data-lucide="chevron-right" class="rtl-flip size-4 text-muted-foreground/50"></i>
            @else
                <span class="font-medium">{{ $crumb }}</span>
            @endif
        @endforeach
    </div>

    {{-- Folders --}}
    <p class="mb-2 text-xs font-semibold uppercase tracking-wide text-muted-foreground">Folders</p>
    <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-4">
        @foreach ([['Design assets','48 files','shared'],['Marketing','126 files',null],['Q3 Planning','34 files','starred'],['Archive','512 files',null]] as [$name,$meta,$flag])
            <x-ui.card hover class="group cursor-pointer">
                <div class="flex items-start justify-between">
                    <span class="grid size-11 place-items-center rounded-xl bg-primary/10 text-primary"><i data-lucide="folder" class="size-6"></i></span>
                    @if ($flag === 'shared')<i data-lucide="users" class="size-4 text-muted-foreground"></i>
                    @elseif ($flag === 'starred')<i data-lucide="star" class="size-4 fill-amber-400 text-amber-400"></i>@endif
                </div>
                <p class="mt-3 truncate font-semibold">{{ $name }}</p>
                <p class="text-xs text-muted-foreground">{{ $meta }}</p>
            </x-ui.card>
        @endforeach
    </div>

    {{-- Files in folder --}}
    <p class="mb-2 mt-6 text-xs font-semibold uppercase tracking-wide text-muted-foreground">Files</p>
    <x-ui.card :padded="false">
        <div class="divide-y divide-border">
            @foreach ([['brief.docx','Word','320 KB','file-text','text-primary bg-primary/10'],['timeline.png','Image','1.1 MB','image','text-info bg-info/10'],['budget.xlsx','Excel','540 KB','sheet','text-success bg-success/10'],['notes.txt','Text','12 KB','file','text-muted-foreground bg-muted']] as [$name,$type,$size,$ico,$tone])
                <div class="group flex items-center gap-3 p-3.5 hover:bg-accent/40">
                    <span class="grid size-10 shrink-0 place-items-center rounded-lg {{ $tone }}"><i data-lucide="{{ $ico }}" class="size-5"></i></span>
                    <div class="min-w-0 flex-1"><p class="truncate text-sm font-medium">{{ $name }}</p><p class="text-xs text-muted-foreground">{{ $type }} · {{ $size }}</p></div>
                    <button class="rounded-lg p-1.5 text-muted-foreground opacity-0 transition hover:bg-accent group-hover:opacity-100"><i data-lucide="download" class="size-4"></i></button>
                    <button class="rounded-lg p-1.5 text-muted-foreground opacity-0 transition hover:bg-accent group-hover:opacity-100"><i data-lucide="ellipsis-vertical" class="size-4"></i></button>
                </div>
            @endforeach
        </div>
    </x-ui.card>
</div>
