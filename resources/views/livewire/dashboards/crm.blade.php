<div>
    <x-page-header :title="$pageTitle" :subtitle="$subtitle">
        <x-slot:actions>
            <x-ui.button variant="outline" icon="upload">Import</x-ui.button>
            <x-ui.button icon="user-plus" @click="window.toast('Add lead', {variant:'info'})">Add lead</x-ui.button>
        </x-slot:actions>
    </x-page-header>

    <div class="grid grid-cols-2 gap-4 lg:grid-cols-4">
        <x-ui.stat label="New Leads" value="892" icon="user-plus" tone="primary" trend="+12.4%" />
        <x-ui.stat label="Open Deals" value="$412K" icon="handshake" tone="info" trend="+7.8%" />
        <x-ui.stat label="Revenue Won" value="$186K" icon="badge-dollar-sign" tone="success" trend="+15.2%" />
        <x-ui.stat label="Conversion" value="24.6%" icon="percent" tone="warning" trend="+2.1%" />
    </div>

    {{-- Deal pipeline kanban --}}
    <div class="mt-5 mb-2 flex items-center justify-between">
        <h3 class="text-sm font-semibold uppercase tracking-wide text-muted-foreground">Deal Pipeline</h3>
        <span class="text-xs text-muted-foreground">$412K in play</span>
    </div>
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
        @php
            $stages = [
                ['New', '$96K', 'chart-1', [['Acme Corp','$24K','Aisha Rahman'],['Globex','$18K','David Chen'],['Wayne Ent','$12K','Priya Sharma']]],
                ['Contacted', '$74K', 'chart-2', [['Initech','$32K','Marcus Johnson'],['Umbrella','$22K','Layla Farouk']]],
                ['Proposal', '$120K', 'chart-3', [['Stark Inc','$68K','Aisha Rahman'],['Soylent','$28K','David Chen']]],
                ['Won', '$186K', 'chart-5', [['Cyberdyne','$92K','Priya Sharma'],['Tyrell','$54K','Marcus Johnson']]],
            ];
        @endphp
        @foreach ($stages as [$stage, $sum, $c, $deals])
            <div class="rounded-2xl border border-border bg-muted/30 p-3">
                <div class="mb-3 flex items-center justify-between px-1">
                    <span class="flex items-center gap-2 text-sm font-semibold"><span class="size-2.5 rounded-full" style="background: hsl(var(--{{ $c }}))"></span>{{ $stage }}</span>
                    <span class="text-xs font-semibold text-muted-foreground">{{ $sum }}</span>
                </div>
                <div class="space-y-2.5">
                    @foreach ($deals as [$co,$val,$owner])
                        <div class="cursor-grab rounded-xl border border-border bg-card p-3 shadow-sm hover:shadow-md">
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-semibold">{{ $co }}</span>
                                <span class="text-sm font-bold text-primary">{{ $val }}</span>
                            </div>
                            <div class="mt-2.5 flex items-center gap-2">
                                <x-ui.avatar :name="$owner" size="xs" />
                                <span class="truncate text-xs text-muted-foreground">{{ $owner }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>

    {{-- Chart + activity + sources --}}
    <div class="mt-4 grid grid-cols-1 gap-4 lg:grid-cols-3">
        <x-ui.card title="Pipeline Value" subtitle="By stage" class="lg:col-span-2">
            <div class="h-64"><canvas id="crmPipeline"></canvas></div>
        </x-ui.card>
        <x-ui.card title="Recent Activity" subtitle="Team touchpoints">
            <ul class="space-y-1">
                @foreach ([['phone','Called Acme Corp','12m','text-info bg-info/10'],['mail','Proposal to Globex','40m','text-primary bg-primary/10'],['check-check','Closed Umbrella $18.9K','2h','text-success bg-success/10'],['calendar','Demo with Initech','4h','text-[hsl(var(--warning))] bg-warning/10']] as [$ico,$text,$t,$tone])
                    <li class="flex items-center gap-3 rounded-lg px-2 py-2 hover:bg-accent/50">
                        <span class="grid size-9 shrink-0 place-items-center rounded-lg {{ $tone }}"><i data-lucide="{{ $ico }}" class="size-4"></i></span>
                        <div class="min-w-0 flex-1">
                            <p class="truncate text-sm font-medium leading-snug">{{ $text }}</p>
                            <p class="text-xs text-muted-foreground">{{ $t }} ago</p>
                        </div>
                    </li>
                @endforeach
            </ul>
        </x-ui.card>
    </div>

    @script
    <script>
        {
            const t = window.akChartTheme();
            const el = document.getElementById('crmPipeline');
            if (el) new Chart(el, { type:'bar', data:{ labels:['New','Contacted','Proposal','Negotiation','Won'], datasets:[{ label:'Value ($K)', data:[96,74,120,88,186], backgroundColor:[t.c1,t.c2,t.c3,t.c4,t.c5], borderRadius:8, maxBarThickness:44 }]},
                options:{ indexAxis:'y', responsive:true, maintainAspectRatio:false, plugins:{legend:{display:false}}, scales:{ x:{grace:'6%',grid:{color:t.grid},ticks:{color:t.text,callback:v=>'$'+v+'K'}}, y:{grid:{display:false},ticks:{color:t.text}} } } });
        }
    </script>
    @endscript
</div>
