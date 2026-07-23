<div x-data="{ filter: 'all' }">
    <x-page-header :title="$pageTitle" :subtitle="$subtitle">
        <x-slot:actions>
            <x-ui.button variant="outline" icon="calendar">This week</x-ui.button>
            <x-ui.button icon="plus">New event</x-ui.button>
        </x-slot:actions>
    </x-page-header>

    {{-- Stats --}}
    <div class="grid grid-cols-2 gap-4 lg:grid-cols-4">
        <x-ui.stat label="Events today" value="128" icon="activity" tone="primary" trend="+18%" />
        <x-ui.stat label="Completed" value="86" icon="circle-check-big" tone="success" trend="+9%" />
        <x-ui.stat label="In progress" value="14" icon="loader" tone="warning" trend="+3" />
        <x-ui.stat label="Team online" value="9" icon="users" tone="info" trend="live" />
    </div>

    {{-- Activity chart --}}
    <x-ui.card title="Activity" subtitle="Events over the last 14 days" class="mt-4">
        <div class="h-56"><canvas id="tlActivity"></canvas></div>
    </x-ui.card>

    <div class="mt-4 grid grid-cols-1 gap-4 lg:grid-cols-3">
        {{-- Main activity stream --}}
        <x-ui.card :padded="false" class="lg:col-span-2">
            <x-slot:header>
                <h3 class="font-semibold leading-none tracking-tight">Activity stream</h3>
                <p class="mt-1.5 text-sm text-muted-foreground">Everything happening across the workspace</p>
            </x-slot:header>
            <x-slot:actions>
                <div class="flex gap-1 rounded-lg bg-muted/60 p-1">
                    @foreach (['all' => 'All','deploy' => 'Deploys','comment' => 'Comments','order' => 'Orders'] as $key => $label)
                        <button @click="filter = '{{ $key }}'" class="rounded-md px-2.5 py-1 text-xs font-medium transition-colors" :class="filter === '{{ $key }}' ? 'bg-card text-foreground shadow-sm' : 'text-muted-foreground hover:text-foreground'">{{ $label }}</button>
                    @endforeach
                </div>
            </x-slot:actions>

            <div class="p-5">
                @php
                    $groups = [
                        'Today' => [
                            ['deploy','git-commit-horizontal','text-primary bg-primary/10',null,'Deployed v2.1.0 to production','Release pushed by CI · 42 commits','10:24'],
                            ['comment',null,'',['Sofia Martinez'],'Sofia commented on “Q3 report”','“The new charts look fantastic 🎉”','09:58'],
                            ['order','shopping-cart','text-success bg-success/10',null,'New order #5821','Payment confirmed · $249.00','09:12'],
                            ['user','user-plus','text-info bg-info/10',null,'David joined the team','Invited as Editor by Aisha','08:40'],
                        ],
                        'Yesterday' => [
                            ['comment',null,'',['Omar Haddad'],'Omar mentioned you','“@you can you review the API spec?”','17:30'],
                            ['deploy','triangle-alert','text-[hsl(var(--warning))] bg-warning/10',null,'Rollback of v2.0.9','Reverted after error-rate spike','16:02'],
                            ['order','shopping-cart','text-success bg-success/10',null,'New order #5806','Payment confirmed · $89.00','14:15'],
                        ],
                    ];
                @endphp
                @foreach ($groups as $day => $entries)
                    <div class="mb-2 flex items-center gap-3 {{ ! $loop->first ? 'mt-4' : '' }}">
                        <span class="rounded-full bg-muted px-3 py-1 text-xs font-semibold text-muted-foreground">{{ $day }}</span>
                        <div class="h-px flex-1 bg-border"></div>
                    </div>
                    <ol>
                        @foreach ($entries as $i => [$type,$ico,$tone,$who,$title,$desc,$time])
                            <li class="flex gap-4" x-show="filter === 'all' || filter === '{{ $type }}'" x-transition.opacity>
                                <div class="flex flex-col items-center">
                                    @if ($who)
                                        <x-ui.avatar :name="$who[0]" size="sm" />
                                    @else
                                        <span class="grid size-8 shrink-0 place-items-center rounded-full {{ $tone }}"><i data-lucide="{{ $ico }}" class="size-4"></i></span>
                                    @endif
                                    @unless ($loop->last)<span class="w-px flex-1 bg-border"></span>@endunless
                                </div>
                                <div class="flex-1 pb-5">
                                    <div class="flex items-center justify-between gap-2">
                                        <p class="text-sm font-semibold">{{ $title }}</p>
                                        <span class="shrink-0 text-xs text-muted-foreground">{{ $time }}</span>
                                    </div>
                                    <p class="mt-0.5 text-sm text-muted-foreground">{{ $desc }}</p>
                                </div>
                            </li>
                        @endforeach
                    </ol>
                @endforeach
            </div>
        </x-ui.card>

        {{-- Side widgets --}}
        <div class="space-y-4">
            {{-- Upcoming --}}
            <x-ui.card title="Upcoming" subtitle="Scheduled events">
                <ol class="space-y-1">
                    @foreach ([['video','Product demo','In 2 hours','text-primary bg-primary/10'],['users','Team standup','Tomorrow · 09:00','text-info bg-info/10'],['rocket','Sprint 14 review','Fri · 15:00','text-success bg-success/10'],['file-text','Invoice due','Jul 26','text-[hsl(var(--warning))] bg-warning/10']] as [$ico,$title,$when,$tone])
                        <li class="flex items-center gap-3 rounded-lg px-2 py-2 hover:bg-accent/50">
                            <span class="grid size-9 shrink-0 place-items-center rounded-lg {{ $tone }}"><i data-lucide="{{ $ico }}" class="size-4"></i></span>
                            <div class="min-w-0 flex-1"><p class="truncate text-sm font-medium">{{ $title }}</p><p class="text-xs text-muted-foreground">{{ $when }}</p></div>
                        </li>
                    @endforeach
                </ol>
            </x-ui.card>

            {{-- Live now --}}
            <x-ui.card title="Live now" subtitle="Active this minute">
                <div class="space-y-3">
                    @foreach ([['Aisha Rahman','Editing “Roadmap”','online'],['David Chen','Reviewing PR #218','online'],['Priya Sharma','In a call','busy']] as [$name,$doing,$status])
                        <div class="flex items-center gap-3">
                            <x-ui.avatar :name="$name" size="sm" :status="$status" />
                            <div class="min-w-0 flex-1"><p class="truncate text-sm font-medium">{{ $name }}</p><p class="truncate text-xs text-muted-foreground">{{ $doing }}</p></div>
                            <span class="flex size-2 shrink-0"><span class="absolute inline-flex size-2 animate-ping rounded-full bg-success opacity-75"></span><span class="relative inline-flex size-2 rounded-full bg-success"></span></span>
                        </div>
                    @endforeach
                </div>
            </x-ui.card>
        </div>
    </div>

    @script
    <script>
        {
            const t = window.akChartTheme();
            const el = document.getElementById('tlActivity');
            if (el) {
                const ctx = el.getContext('2d');
                const g = ctx.createLinearGradient(0, 0, 0, 224);
                g.addColorStop(0, 'hsla' + t.primary.slice(3, -1) + ' / .30)');
                g.addColorStop(1, 'hsla' + t.primary.slice(3, -1) + ' / 0)');
                const labels = Array.from({ length: 14 }, (_, i) => 'D' + (i + 1));
                new Chart(el, { type: 'line', data: { labels, datasets: [{ label: 'Events', data: [42,58,50,72,64,88,80,96,84,110,102,120,114,128], borderColor: t.primary, backgroundColor: g, fill: true, tension: .4, borderWidth: 2.5, pointRadius: 0, pointHoverRadius: 5 }] },
                    options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } }, scales: { x: { grid: { display: false }, ticks: { color: t.text, maxTicksLimit: 7 } }, y: { grid: { color: t.grid }, ticks: { color: t.text } } } } });
            }
        }
    </script>
    @endscript
</div>
