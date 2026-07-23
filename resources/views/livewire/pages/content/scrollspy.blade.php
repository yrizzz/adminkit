<div>
    <x-page-header :title="$pageTitle" subtitle="Advanced Ui · navigation that tracks the section in view">
        <x-slot:actions>
            <x-ui.badge variant="success" dot>2 variants</x-ui.badge>
            <x-ui.button variant="outline" icon="arrow-left" class="[&>svg]:rtl-flip" :href="route('dashboard')">Dashboard</x-ui.button>
        </x-slot:actions>
    </x-page-header>

    @php
        $sections = [
            ['id' => 'introduction', 'icon' => 'book-open',  'title' => 'Introduction'],
            ['id' => 'installation', 'icon' => 'download',   'title' => 'Installation'],
            ['id' => 'configuration','icon' => 'settings-2', 'title' => 'Configuration'],
            ['id' => 'theming',      'icon' => 'palette',    'title' => 'Theming'],
            ['id' => 'deployment',   'icon' => 'rocket',     'title' => 'Deployment'],
        ];
    @endphp

    <x-demo-section title="Sidebar scrollspy" desc="Scroll the page — the left nav highlights the current section; click to jump." />
    <div x-data="{ active: 'introduction' }" class="grid grid-cols-1 gap-4 lg:grid-cols-[220px_1fr]">
        <aside class="lg:sticky lg:top-32 lg:self-start">
            <x-ui.card :padded="false">
                <nav class="space-y-1 p-2">
                    @foreach ($sections as $s)
                        <a href="#sec-{{ $s['id'] }}" class="flex items-center gap-2.5 rounded-lg px-3 py-2 text-sm font-medium transition-colors"
                           :class="active === '{{ $s['id'] }}' ? 'bg-primary/10 text-primary' : 'text-muted-foreground hover:bg-accent hover:text-foreground'">
                            <i data-lucide="{{ $s['icon'] }}" class="size-4"></i>{{ $s['title'] }}
                        </a>
                    @endforeach
                </nav>
            </x-ui.card>
        </aside>
        <div class="space-y-4">
            @foreach ($sections as $s)
                <section id="sec-{{ $s['id'] }}" class="scroll-mt-32" x-intersect.margin.0px.0px.-72%.0px="active = '{{ $s['id'] }}'">
                    <x-ui.card :title="$s['title']">
                        <x-slot:header><div class="mt-1 flex items-center gap-2 text-primary"><i data-lucide="{{ $s['icon'] }}" class="size-4"></i><span class="text-xs font-semibold uppercase tracking-wide">Section</span></div></x-slot:header>
                        <div class="space-y-3 text-sm text-muted-foreground">
                            <p>Scroll and watch the left navigation highlight the section currently in view. Clicking a link smoothly jumps to its section.</p>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.</p>
                            <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident.</p>
                        </div>
                    </x-ui.card>
                </section>
            @endforeach
        </div>
    </div>

    <x-demo-section title="Sticky tab scrollspy" desc="A horizontal tab bar that follows the scrolled section." />
    <div x-data="{ active: 'overview' }">
        @php
            $tabs = [
                ['id' => 'overview',  'title' => 'Overview'],
                ['id' => 'features',  'title' => 'Features'],
                ['id' => 'pricing',   'title' => 'Pricing'],
                ['id' => 'faq',       'title' => 'FAQ'],
            ];
        @endphp
        <div class="sticky top-32 z-10 mb-4 flex gap-1 overflow-x-auto rounded-xl border border-border bg-card/80 p-1.5 backdrop-blur no-scrollbar">
            @foreach ($tabs as $t)
                <a href="#tab-{{ $t['id'] }}" class="shrink-0 rounded-lg px-4 py-2 text-sm font-medium transition-colors"
                   :class="active === '{{ $t['id'] }}' ? 'bg-primary text-primary-foreground shadow-sm' : 'text-muted-foreground hover:bg-accent'">{{ $t['title'] }}</a>
            @endforeach
        </div>
        <div class="space-y-4">
            @foreach ($tabs as $t)
                <section id="tab-{{ $t['id'] }}" class="scroll-mt-44" x-intersect.margin.0px.0px.-72%.0px="active = '{{ $t['id'] }}'">
                    <x-ui.card :title="$t['title']" subtitle="Section content">
                        <p class="text-sm text-muted-foreground">This is the “{{ $t['title'] }}” section. As it scrolls into view, its tab above becomes active and stays pinned to the top.</p>
                        <div class="mt-3 grid grid-cols-2 gap-3 sm:grid-cols-3">
                            @for ($i = 0; $i < 3; $i++)<div class="h-20 rounded-xl bg-muted/50"></div>@endfor
                        </div>
                    </x-ui.card>
                </section>
            @endforeach
        </div>
    </div>
</div>
