<div>
    <x-page-header :title="'Empty States'" subtitle="Pages · friendly placeholders for empty & error views">
        <x-slot:actions>
            <x-ui.button variant="outline" icon="arrow-left" class="[&>svg]:rtl-flip" :href="route('dashboard')">Dashboard</x-ui.button>
        </x-slot:actions>
    </x-page-header>

    <div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
        @php
            $states = [
                ['inbox','No messages yet','When you receive messages they’ll show up here. Start a conversation to get going.','Start a chat','plus','text-primary bg-primary/10'],
                ['search-x','No results found','We couldn’t find anything matching your search. Try different keywords or clear the filters.','Clear filters','x','text-info bg-info/10'],
                ['folder-open','This folder is empty','Drag and drop files here, or upload from your device to get started.','Upload files','upload','text-[hsl(var(--warning))] bg-warning/10'],
                ['wifi-off','You’re offline','Check your connection and try again. Your changes are saved locally in the meantime.','Retry','rotate-cw','text-destructive bg-destructive/10'],
            ];
        @endphp
        @foreach ($states as [$icon,$title,$desc,$action,$actionIcon,$tone])
            <x-ui.card>
                <div class="flex flex-col items-center gap-4 py-8 text-center">
                    <span class="grid size-20 place-items-center rounded-2xl {{ $tone }}"><i data-lucide="{{ $icon }}" class="size-9"></i></span>
                    <div class="max-w-xs">
                        <h3 class="text-lg font-semibold">{{ $title }}</h3>
                        <p class="mt-1.5 text-sm text-muted-foreground">{{ $desc }}</p>
                    </div>
                    <x-ui.button :icon="$actionIcon">{{ $action }}</x-ui.button>
                </div>
            </x-ui.card>
        @endforeach
    </div>

    {{-- Illustrative 404-style --}}
    <x-ui.card class="mt-4 overflow-hidden">
        <div class="relative flex flex-col items-center gap-4 py-12 text-center">
            <div class="pointer-events-none absolute inset-0 bg-gradient-to-br from-primary/5 to-transparent"></div>
            <span class="relative text-7xl font-black tracking-tighter text-primary/20">404</span>
            <div class="relative max-w-md">
                <h3 class="text-xl font-bold">This page wandered off</h3>
                <p class="mt-2 text-sm text-muted-foreground">The page you’re looking for doesn’t exist or has been moved. Let’s get you back on track.</p>
            </div>
            <div class="relative flex gap-2">
                <x-ui.button variant="outline" icon="arrow-left" class="[&>svg]:rtl-flip" :href="route('dashboard')">Go back</x-ui.button>
                <x-ui.button icon="house" :href="route('dashboard')">Home</x-ui.button>
            </div>
        </div>
    </x-ui.card>
</div>
