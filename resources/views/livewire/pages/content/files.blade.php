<div>
    <x-page-header :title="'Files'" subtitle="Pages · file manager with storage & quick actions">
        <x-slot:actions>
            <x-ui.button variant="outline" icon="arrow-left" class="[&>svg]:rtl-flip" :href="route('dashboard')">Dashboard</x-ui.button>
            <x-ui.button icon="upload">Upload</x-ui.button>
        </x-slot:actions>
    </x-page-header>

    <div class="grid grid-cols-1 gap-4 lg:grid-cols-[1fr_300px]">
        <div class="space-y-4">
            {{-- Quick folders --}}
            <div class="grid grid-cols-2 gap-4 sm:grid-cols-4">
                @foreach ([['Images','1,204','image','text-info bg-info/10'],['Documents','486','file-text','text-primary bg-primary/10'],['Videos','92','video','text-destructive bg-destructive/10'],['Music','318','music','text-success bg-success/10']] as [$name,$count,$ico,$tone])
                    <x-ui.card hover class="cursor-pointer">
                        <span class="grid size-11 place-items-center rounded-xl {{ $tone }}"><i data-lucide="{{ $ico }}" class="size-5"></i></span>
                        <p class="mt-3 font-semibold">{{ $name }}</p>
                        <p class="text-xs text-muted-foreground">{{ $count }} files</p>
                    </x-ui.card>
                @endforeach
            </div>

            {{-- Recent files --}}
            <x-ui.card :padded="false">
                <x-slot:header><h3 class="font-semibold">Recent files</h3></x-slot:header>
                <div class="divide-y divide-border">
                    @php
                        $files = [
                            ['Q3-roadmap.pdf','PDF','2.4 MB','Jul 22','file-text','text-destructive bg-destructive/10'],
                            ['dashboard-mockup.fig','Figma','8.1 MB','Jul 21','pen-tool','text-fuchsia-500 bg-fuchsia-500/10'],
                            ['analytics-export.xlsx','Excel','640 KB','Jul 20','sheet','text-success bg-success/10'],
                            ['hero-banner.png','Image','4.2 MB','Jul 19','image','text-info bg-info/10'],
                            ['launch-video.mp4','Video','128 MB','Jul 18','video','text-primary bg-primary/10'],
                        ];
                    @endphp
                    @foreach ($files as [$name,$type,$size,$date,$ico,$tone])
                        <div class="group flex items-center gap-3 p-3.5 hover:bg-accent/40">
                            <span class="grid size-10 shrink-0 place-items-center rounded-lg {{ $tone }}"><i data-lucide="{{ $ico }}" class="size-5"></i></span>
                            <div class="min-w-0 flex-1"><p class="truncate text-sm font-medium">{{ $name }}</p><p class="text-xs text-muted-foreground">{{ $type }} · {{ $size }} · {{ $date }}</p></div>
                            <x-ui.dropdown align="end" width="w-36">
                                <x-slot:trigger><button class="rounded-lg p-1.5 text-muted-foreground opacity-0 transition hover:bg-accent group-hover:opacity-100"><i data-lucide="ellipsis-vertical" class="size-4"></i></button></x-slot:trigger>
                                <x-ui.dropdown-item icon="download">Download</x-ui.dropdown-item>
                                <x-ui.dropdown-item icon="share-2">Share</x-ui.dropdown-item>
                                <x-ui.dropdown-item icon="trash-2" variant="destructive">Delete</x-ui.dropdown-item>
                            </x-ui.dropdown>
                        </div>
                    @endforeach
                </div>
            </x-ui.card>
        </div>

        {{-- Storage --}}
        <div class="space-y-4">
            <x-ui.card title="Storage">
                <div class="flex flex-col items-center">
                    <x-ui.gauge :value="68" tone="primary" :size="128" :stroke="10" display="68%" sub="used" />
                    <p class="mt-2 text-sm text-muted-foreground">34.2 GB of 50 GB used</p>
                </div>
                <div class="mt-4 space-y-2.5">
                    @foreach ([['Images','14.1 GB','bg-info'],['Videos','11.8 GB','bg-primary'],['Documents','5.2 GB','bg-success'],['Other','3.1 GB','bg-muted-foreground']] as [$label,$size,$bar])
                        <div class="flex items-center gap-2.5 text-sm"><span class="size-2.5 rounded-full {{ $bar }}"></span><span class="flex-1">{{ $label }}</span><span class="text-muted-foreground">{{ $size }}</span></div>
                    @endforeach
                </div>
                <x-ui.button variant="outline" class="mt-4 w-full" icon="zap">Upgrade storage</x-ui.button>
            </x-ui.card>
        </div>
    </div>
</div>
