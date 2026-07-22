<x-layouts.app :title="$pageTitle" :breadcrumbs="$crumbs">
    <x-page-header :title="$pageTitle" :subtitle="$section.' · this page is part of the AdminKit scaffold'">
        <x-slot:actions>
            <x-ui.button variant="outline" icon="arrow-left" class="[&>svg]:rtl-flip" :href="route('dashboard')">Dashboard</x-ui.button>
            <x-ui.button icon="sparkles" :href="route('ui.elements')">Explore components</x-ui.button>
        </x-slot:actions>
    </x-page-header>

    {{-- Hero --}}
    <x-ui.card class="relative overflow-hidden">
        <div class="pointer-events-none absolute -end-10 -top-10 size-40 rounded-full bg-primary/10 blur-3xl"></div>
        <div class="pointer-events-none absolute -bottom-16 -start-10 size-40 rounded-full bg-chart-4/10 blur-3xl"></div>

        <div class="relative flex flex-col items-center gap-4 py-10 text-center">
            <span class="grid size-16 place-items-center rounded-2xl bg-gradient-to-br from-primary to-sidebar-primary text-white shadow-lg shadow-primary/30">
                <i data-lucide="layout-grid" class="size-8"></i>
            </span>
            <div class="max-w-lg">
                <h2 class="text-xl font-bold tracking-tight">{{ $pageTitle }}</h2>
                <p class="mt-2 text-sm text-muted-foreground">
                    This is a ready-to-fill page in the <span class="font-semibold text-foreground">{{ $section }}</span> section.
                    Drop in your Livewire component, table, or form here — the shell, theming, breadcrumb and routing are already wired up.
                </p>
            </div>
            <div class="mt-1 flex flex-wrap items-center justify-center gap-2">
                <x-ui.badge variant="default" dot>Routed</x-ui.badge>
                <x-ui.badge variant="success" dot>Themeable</x-ui.badge>
                <x-ui.badge variant="info" dot>RTL / LTR</x-ui.badge>
                <x-ui.badge variant="muted">{{ '/' . request()->path() }}</x-ui.badge>
            </div>
        </div>
    </x-ui.card>

    {{-- Placeholder content grid --}}
    <div class="mt-4 grid grid-cols-1 gap-4 lg:grid-cols-3">
        @foreach ([
            ['clipboard-list', 'Content block', 'Add your primary content, list or grid here.'],
            ['bar-chart-3', 'Analytics', 'Charts and stats for this section go here.'],
            ['settings-2', 'Configuration', 'Section-specific settings and actions.'],
        ] as [$ico, $t, $d])
            <x-ui.card hover>
                <div class="flex items-start gap-3">
                    <span class="grid size-10 shrink-0 place-items-center rounded-xl bg-primary/10 text-primary"><i data-lucide="{{ $ico }}" class="size-5"></i></span>
                    <div>
                        <p class="font-semibold">{{ $t }}</p>
                        <p class="mt-0.5 text-sm text-muted-foreground">{{ $d }}</p>
                    </div>
                </div>
                <div class="mt-4 space-y-2.5">
                    <div class="h-2.5 w-full rounded-full bg-muted"></div>
                    <div class="h-2.5 w-4/5 rounded-full bg-muted"></div>
                    <div class="h-2.5 w-3/5 rounded-full bg-muted"></div>
                </div>
            </x-ui.card>
        @endforeach
    </div>
</x-layouts.app>
