<div>
    <x-page-header :title="'Timeline — Vertical'" subtitle="Pages · centered alternating timeline">
        <x-slot:actions>
            <x-ui.badge variant="muted">Vertical</x-ui.badge>
            <x-ui.button variant="outline" icon="arrow-left" class="[&>svg]:rtl-flip" :href="route('dashboard')">Dashboard</x-ui.button>
        </x-slot:actions>
    </x-page-header>

    <x-ui.card>
        <div class="relative py-2">
            {{-- center spine (desktop) / left spine (mobile) --}}
            <div class="absolute inset-y-0 start-4 w-0.5 bg-border sm:start-1/2 sm:-translate-x-1/2 rtl:sm:translate-x-1/2"></div>

            @php
                $milestones = [
                    ['calendar-plus','Project kickoff','Q1 · Jan 2026','Scope defined, team assembled and the repo bootstrapped.','text-primary bg-primary/10'],
                    ['palette','Design system','Q1 · Feb 2026','Tokens, components and the full Figma library shipped.','text-info bg-info/10'],
                    ['code','Beta release','Q2 · Apr 2026','First public beta with core features and feedback loop.','text-[hsl(var(--warning))] bg-warning/10'],
                    ['rocket','Public launch','Q2 · Jun 2026','v1.0 shipped to production — 10k signups in week one.','text-success bg-success/10'],
                    ['trophy','Series A','Q3 · Aug 2026','Raised funding to scale the team and platform.','text-primary bg-primary/10'],
                ];
            @endphp

            <ol class="space-y-6 sm:space-y-2">
                @foreach ($milestones as $i => [$ico,$title,$date,$desc,$tone])
                    @php $left = $i % 2 === 0; @endphp
                    <li class="relative flex items-start gap-4 sm:grid sm:grid-cols-2 sm:gap-0">
                        {{-- node --}}
                        <span class="absolute start-4 top-1 z-10 grid size-8 -translate-x-1/2 place-items-center rounded-full ring-4 ring-card {{ $tone }} rtl:translate-x-1/2 sm:start-1/2">
                            <i data-lucide="{{ $ico }}" class="size-4"></i>
                        </span>

                        {{-- content: alternates sides on sm+ --}}
                        <div class="ms-12 sm:ms-0 {{ $left ? 'sm:col-start-1 sm:pe-10 sm:text-end' : 'sm:col-start-2 sm:ps-10' }}">
                            <div class="rounded-xl border border-border p-4 transition-shadow hover:shadow-md">
                                <div class="flex items-center gap-2 {{ $left ? 'sm:justify-end' : '' }}">
                                    <x-ui.badge variant="muted">{{ $date }}</x-ui.badge>
                                </div>
                                <p class="mt-2 font-semibold">{{ $title }}</p>
                                <p class="mt-1 text-sm text-muted-foreground">{{ $desc }}</p>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ol>
        </div>
    </x-ui.card>
</div>
