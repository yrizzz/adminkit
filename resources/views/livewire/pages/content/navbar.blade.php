<div>
    <x-page-header :title="$pageTitle" subtitle="Advanced Ui · navbar patterns — brand, search, mega-menu, tabs & glass">
        <x-slot:actions>
            <x-ui.badge variant="success" dot>6 variants</x-ui.badge>
            <x-ui.button variant="outline" icon="arrow-left" class="[&>svg]:rtl-flip" :href="route('dashboard')">Dashboard</x-ui.button>
        </x-slot:actions>
    </x-page-header>

    <div class="space-y-4">
        {{-- Default --}}
        <x-ui.card title="Default" subtitle="Brand, links and actions" :padded="false">
            <nav class="flex items-center gap-4 px-5 py-3">
                <a href="#" class="flex items-center gap-2 font-bold"><span class="grid size-8 place-items-center rounded-lg bg-primary text-primary-foreground"><i data-lucide="gem" class="size-4"></i></span>Brand</a>
                <div class="mx-2 hidden items-center gap-1 md:flex">
                    @foreach (['Home' => true, 'Features' => false, 'Pricing' => false, 'About' => false] as $label => $active)
                        <a href="#" class="rounded-lg px-3 py-2 text-sm font-medium {{ $active ? 'bg-accent text-primary' : 'text-muted-foreground hover:bg-accent hover:text-foreground' }}">{{ $label }}</a>
                    @endforeach
                </div>
                <div class="ms-auto flex items-center gap-2"><x-ui.button variant="ghost" size="sm">Sign in</x-ui.button><x-ui.button size="sm">Get started</x-ui.button></div>
            </nav>
        </x-ui.card>

        {{-- Search --}}
        <x-ui.card title="With search" subtitle="Centered search field" :padded="false">
            <nav class="flex items-center gap-3 px-5 py-3">
                <a href="#" class="flex items-center gap-2 font-bold"><i data-lucide="box" class="size-5 text-primary"></i>Console</a>
                <div class="mx-auto w-full max-w-md"><x-ui.input placeholder="Search projects, docs, people…" icon="search" /></div>
                <div class="flex items-center gap-1"><button class="rounded-lg p-2 text-muted-foreground hover:bg-accent"><i data-lucide="bell" class="size-5"></i></button><x-ui.avatar name="Aisha Rahman" size="sm" status="online" /></div>
            </nav>
        </x-ui.card>

        {{-- Mega menu --}}
        <x-ui.card title="Mega menu" subtitle="Dropdown with grouped links" :padded="false" class="relative overflow-visible">
            <nav class="flex items-center gap-4 px-5 py-3" x-data="{ open: false }">
                <a href="#" class="flex items-center gap-2 font-bold"><i data-lucide="grid-3x3" class="size-5 text-primary"></i>Platform</a>
                <div class="relative mx-2 hidden md:block" @mouseenter="open = true" @mouseleave="open = false">
                    <button class="flex items-center gap-1.5 rounded-lg px-3 py-2 text-sm font-medium text-muted-foreground hover:bg-accent hover:text-foreground">Products <i data-lucide="chevron-down" class="size-3.5 transition-transform" :class="open && 'rotate-180'"></i></button>
                    <div x-show="open" x-cloak x-transition.origin.top class="absolute start-0 top-full z-30 mt-1 w-[34rem] rounded-xl border border-border bg-popover p-3 shadow-xl">
                        <div class="grid grid-cols-2 gap-1">
                            @foreach ([['line-chart','Analytics','Real-time metrics','text-info bg-info/10'],['shield','Security','SSO, audit logs','text-success bg-success/10'],['workflow','Automations','Rules & triggers','text-primary bg-primary/10'],['plug','Integrations','200+ connectors','text-[hsl(var(--warning))] bg-warning/10']] as [$ic,$t,$d,$tone])
                                <a href="#" class="flex items-start gap-3 rounded-lg p-2.5 hover:bg-accent">
                                    <span class="grid size-9 shrink-0 place-items-center rounded-lg {{ $tone }}"><i data-lucide="{{ $ic }}" class="size-4"></i></span>
                                    <span><span class="block text-sm font-semibold">{{ $t }}</span><span class="block text-xs text-muted-foreground">{{ $d }}</span></span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
                <a href="#" class="hidden rounded-lg px-3 py-2 text-sm font-medium text-muted-foreground hover:bg-accent hover:text-foreground md:block">Pricing</a>
                <div class="ms-auto"><x-ui.button size="sm" icon="arrow-right" class="[&>svg]:rtl-flip">Start free</x-ui.button></div>
            </nav>
        </x-ui.card>

        {{-- App tabs --}}
        <x-ui.card title="App navbar with tabs" subtitle="Two-tier: brand row + tab row" :padded="false">
            <div x-data="{ tab: 'overview' }">
                <nav class="flex items-center gap-3 border-b border-border px-5 py-3">
                    <a href="#" class="flex items-center gap-2 font-bold"><i data-lucide="layers" class="size-5 text-primary"></i>Stack</a>
                    <div class="ms-auto flex items-center gap-2">
                        <button class="rounded-lg p-2 text-muted-foreground hover:bg-accent"><i data-lucide="search" class="size-5"></i></button>
                        <button class="rounded-lg p-2 text-muted-foreground hover:bg-accent"><i data-lucide="bell" class="size-5"></i></button>
                        <x-ui.avatar name="Aisha Rahman" size="sm" />
                    </div>
                </nav>
                <div class="flex items-center gap-1 px-4">
                    @foreach (['overview' => 'Overview','activity' => 'Activity','settings' => 'Settings','members' => 'Members'] as $key => $label)
                        <button @click="tab = '{{ $key }}'" class="relative px-3 py-2.5 text-sm font-medium transition-colors" :class="tab === '{{ $key }}' ? 'text-primary' : 'text-muted-foreground hover:text-foreground'">
                            {{ $label }}
                            <span x-show="tab === '{{ $key }}'" class="absolute inset-x-2 -bottom-px h-0.5 rounded-full bg-primary"></span>
                        </button>
                    @endforeach
                </div>
            </div>
        </x-ui.card>

        {{-- Glass / gradient --}}
        <x-ui.card title="Branded glass" subtitle="Gradient background with glass actions" :padded="false" class="overflow-hidden">
            <nav class="flex items-center gap-4 bg-gradient-to-r from-indigo-600 via-primary to-fuchsia-600 px-5 py-3.5 text-white">
                <a href="#" class="flex items-center gap-2 font-bold"><i data-lucide="rocket" class="size-5"></i>Launch</a>
                <div class="mx-2 hidden items-center gap-1 md:flex">
                    @foreach (['Product','Solutions','Docs','Contact'] as $label)<a href="#" class="rounded-lg px-3 py-2 text-sm font-medium text-white/85 hover:bg-white/15 hover:text-white">{{ $label }}</a>@endforeach
                </div>
                <div class="ms-auto flex items-center gap-2">
                    <button class="rounded-lg bg-white/10 p-2 backdrop-blur hover:bg-white/20"><i data-lucide="search" class="size-5"></i></button>
                    <button class="rounded-lg bg-white/15 px-4 py-2 text-sm font-semibold backdrop-blur hover:bg-white/25">Upgrade</button>
                </div>
            </nav>
        </x-ui.card>

        {{-- Responsive --}}
        <x-ui.card title="Responsive" subtitle="Collapses into a toggle on mobile" :padded="false">
            <div x-data="{ open: false }">
                <nav class="flex items-center gap-4 px-5 py-3">
                    <a href="#" class="flex items-center gap-2 font-bold"><i data-lucide="hexagon" class="size-5 text-primary"></i>Nexus</a>
                    <div class="ms-auto hidden items-center gap-1 sm:flex">@foreach (['Dashboard','Reports','Team'] as $label)<a href="#" class="rounded-lg px-3 py-2 text-sm font-medium text-muted-foreground hover:bg-accent hover:text-foreground">{{ $label }}</a>@endforeach</div>
                    <button @click="open = ! open" class="ms-auto rounded-lg p-2 text-muted-foreground hover:bg-accent sm:hidden"><i data-lucide="menu" class="size-5" x-show="!open"></i><i data-lucide="x" class="size-5" x-show="open" x-cloak></i></button>
                </nav>
                <div x-show="open" x-collapse x-cloak class="border-t border-border sm:hidden"><div class="space-y-1 p-3">@foreach (['Dashboard','Reports','Team'] as $label)<a href="#" class="block rounded-lg px-3 py-2 text-sm font-medium hover:bg-accent">{{ $label }}</a>@endforeach</div></div>
            </div>
        </x-ui.card>
    </div>
</div>
