<div>
    <x-page-header :title="'Landing'" subtitle="Pages · marketing landing page preview">
        <x-slot:actions>
            <x-ui.button variant="outline" icon="arrow-left" class="[&>svg]:rtl-flip" :href="route('dashboard')">Dashboard</x-ui.button>
        </x-slot:actions>
    </x-page-header>

    {{-- Hero --}}
    <section class="relative overflow-hidden rounded-3xl border border-border bg-gradient-to-b from-primary/5 to-transparent px-6 py-14 text-center">
        <div class="pointer-events-none absolute -end-20 -top-20 size-72 rounded-full bg-primary/10 blur-3xl"></div>
        <div class="pointer-events-none absolute -bottom-24 -start-20 size-72 rounded-full bg-sidebar-primary/10 blur-3xl"></div>
        <div class="relative mx-auto max-w-3xl">
            <span class="inline-flex items-center gap-1.5 rounded-full border border-border bg-card px-3 py-1 text-xs font-semibold shadow-sm"><span class="flex size-2"><span class="absolute inline-flex size-2 animate-ping rounded-full bg-primary opacity-75"></span><span class="relative inline-flex size-2 rounded-full bg-primary"></span></span>&nbsp;v2.1 is here — meet Smart Insights</span>
            <h1 class="mt-5 text-4xl font-black leading-tight tracking-tight sm:text-5xl">Ship beautiful dashboards <span class="bg-gradient-to-r from-primary to-sidebar-primary bg-clip-text text-transparent">in minutes</span></h1>
            <p class="mx-auto mt-4 max-w-xl text-lg text-muted-foreground">Everything your team needs to build polished admin experiences — components, themes and layouts, ready out of the box.</p>
            <div class="mt-7 flex flex-wrap items-center justify-center gap-3">
                <x-ui.button size="lg" icon="rocket">Start free trial</x-ui.button>
                <x-ui.button size="lg" variant="outline" icon="play">Watch demo</x-ui.button>
            </div>
            <p class="mt-3 text-xs text-muted-foreground">No credit card required · 14-day free trial</p>
        </div>

        {{-- Browser mockup --}}
        <div class="relative mx-auto mt-12 max-w-4xl">
            <div class="overflow-hidden rounded-2xl border border-border bg-card shadow-2xl">
                <div class="flex items-center gap-2 border-b border-border bg-muted/50 px-4 py-2.5">
                    <span class="size-3 rounded-full bg-red-400"></span><span class="size-3 rounded-full bg-amber-400"></span><span class="size-3 rounded-full bg-green-400"></span>
                    <span class="mx-auto flex items-center gap-1.5 rounded-md bg-background px-3 py-1 text-xs text-muted-foreground"><i data-lucide="lock" class="size-3"></i>app.adminkit.test</span>
                </div>
                <img src="https://picsum.photos/seed/adminkit-dashboard/1200/620" alt="Product preview" loading="lazy" class="w-full object-cover" />
            </div>
        </div>
    </section>

    {{-- Logo cloud --}}
    <div class="mt-10 flex flex-col items-center gap-4">
        <p class="text-xs font-semibold uppercase tracking-wide text-muted-foreground">Powering teams at</p>
        <div class="flex flex-wrap items-center justify-center gap-x-8 gap-y-3 opacity-70">
            @foreach (['hexagon' => 'Nexus','box' => 'Console','layers' => 'Stack','command' => 'Vertex','aperture' => 'Orbit'] as $ico => $name)
                <span class="flex items-center gap-1.5 text-lg font-bold text-muted-foreground"><i data-lucide="{{ $ico }}" class="size-5"></i>{{ $name }}</span>
            @endforeach
        </div>
    </div>

    {{-- Stats --}}
    <div class="mt-10 grid grid-cols-2 gap-4 lg:grid-cols-4">
        @foreach ([['24K+','Active users'],['99.9%','Uptime'],['80+','Countries'],['4.9/5','Avg. rating']] as [$val,$label])
            <div class="rounded-2xl border border-border bg-card p-6 text-center"><p class="text-3xl font-black text-primary">{{ $val }}</p><p class="mt-1 text-sm text-muted-foreground">{{ $label }}</p></div>
        @endforeach
    </div>

    {{-- Features --}}
    <div class="mt-14 text-center">
        <span class="text-xs font-semibold uppercase tracking-wide text-primary">Features</span>
        <h2 class="mt-2 text-3xl font-bold tracking-tight">Everything you need to build</h2>
        <p class="mx-auto mt-2 max-w-md text-muted-foreground">Powerful, thoughtfully-designed features that scale with your product.</p>
    </div>
    <div class="mt-8 grid grid-cols-1 gap-4 md:grid-cols-3">
        @foreach ([
            ['palette','Themeable','Accent colors, radius, density and dark mode — all configurable in a click.','text-primary bg-primary/10'],
            ['zap','Blazing fast','SPA navigation with zero full reloads keeps everything feeling instant.','text-[hsl(var(--warning))] bg-warning/10'],
            ['shield-check','Secure by default','Auth, roles and security headers configured right out of the box.','text-success bg-success/10'],
            ['smartphone','Responsive','Looks flawless on every screen, from mobile to ultrawide.','text-info bg-info/10'],
            ['plug','Integrations','Connect the tools you already use with 200+ ready connectors.','text-primary bg-primary/10'],
            ['line-chart','Analytics','Beautiful, theme-aware charts and real-time metrics built in.','text-destructive bg-destructive/10'],
        ] as [$ico,$title,$desc,$tone])
            <x-ui.card hover>
                <span class="grid size-12 place-items-center rounded-xl {{ $tone }}"><i data-lucide="{{ $ico }}" class="size-6"></i></span>
                <h3 class="mt-4 font-semibold">{{ $title }}</h3>
                <p class="mt-1.5 text-sm text-muted-foreground">{{ $desc }}</p>
            </x-ui.card>
        @endforeach
    </div>

    {{-- Feature highlight --}}
    <div class="mt-14 grid grid-cols-1 items-center gap-8 lg:grid-cols-2">
        <div>
            <span class="text-xs font-semibold uppercase tracking-wide text-primary">Smart Insights</span>
            <h2 class="mt-2 text-2xl font-bold tracking-tight">Let your data tell the story</h2>
            <p class="mt-3 text-muted-foreground">Automatic anomaly detection and forecasting, built right into your dashboards. Spot trends before they happen and act with confidence.</p>
            <div class="mt-5 space-y-3">
                @foreach (['Real-time anomaly alerts','30-day forecasting out of the box','One-click export to any format'] as $point)
                    <div class="flex items-center gap-2.5 text-sm"><span class="grid size-5 shrink-0 place-items-center rounded-full bg-success/15 text-success"><i data-lucide="check" class="size-3"></i></span>{{ $point }}</div>
                @endforeach
            </div>
            <x-ui.button class="mt-6 [&>svg]:rtl-flip" icon="arrow-right">Learn more</x-ui.button>
        </div>
        <div class="overflow-hidden rounded-2xl border border-border shadow-lg">
            <img src="https://picsum.photos/seed/insights-panel/800/560" alt="" loading="lazy" class="w-full object-cover" />
        </div>
    </div>

    {{-- Testimonial --}}
    <x-ui.card class="mt-14 bg-gradient-to-br from-primary/5 to-transparent">
        <div class="mx-auto max-w-2xl py-4 text-center">
            <div class="flex justify-center gap-0.5">@for ($n = 0; $n < 5; $n++)<i data-lucide="star" class="size-5 fill-amber-400 text-amber-400"></i>@endfor</div>
            <p class="mt-4 text-xl font-medium">“This scaffold saved us weeks. The components are clean, the theming just works, and our whole dashboard shipped in days.”</p>
            <div class="mt-5 flex items-center justify-center gap-3">
                <x-ui.avatar name="Maya Wijaya" size="md" />
                <div class="text-start"><p class="text-sm font-semibold">Maya Wijaya</p><p class="text-xs text-muted-foreground">CTO, Northwind</p></div>
            </div>
        </div>
    </x-ui.card>

    {{-- CTA --}}
    <section class="mt-8 overflow-hidden rounded-3xl bg-gradient-to-br from-indigo-600 via-primary to-fuchsia-600 px-6 py-14 text-center text-white">
        <h2 class="text-3xl font-black tracking-tight">Ready to get started?</h2>
        <p class="mx-auto mt-3 max-w-md text-white/85">Join thousands of teams already building faster with AdminKit. Start your free trial today.</p>
        <div class="mt-6 flex flex-wrap justify-center gap-3">
            <button class="rounded-lg bg-white px-6 py-3 text-sm font-semibold text-primary shadow-lg transition hover:bg-white/90">Start free trial</button>
            <button class="rounded-lg bg-white/15 px-6 py-3 text-sm font-semibold backdrop-blur transition hover:bg-white/25">Talk to sales</button>
        </div>
    </section>
</div>
