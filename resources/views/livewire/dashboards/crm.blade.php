<div>
    <x-page-header :title="$pageTitle" :subtitle="$subtitle">
        <x-slot:actions>
            <x-ui.button variant="outline" icon="upload">Import</x-ui.button>
            <x-ui.button icon="user-plus" @click="window.toast('Add lead', {variant:'info'})">Add lead</x-ui.button>
        </x-slot:actions>
    </x-page-header>

    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
        <x-ui.stat label="New Leads" value="892" icon="user-plus" tone="primary" trend="+12.4%" />
        <x-ui.stat label="Open Deals" value="$412K" icon="handshake" tone="info" trend="+7.8%" />
        <x-ui.stat label="Revenue Won" value="$186K" icon="badge-dollar-sign" tone="success" trend="+15.2%" />
        <x-ui.stat label="Conversion" value="24.6%" icon="percent" tone="warning" trend="+2.1%" />
    </div>

    <div class="mt-4 grid grid-cols-1 gap-4 lg:grid-cols-3">
        <x-ui.card title="Deal Pipeline" subtitle="Value by stage" class="lg:col-span-2">
            <div class="h-72"><canvas id="crmPipeline"></canvas></div>
        </x-ui.card>

        <x-ui.card title="Lead Sources" subtitle="Where leads come from">
            <div class="mx-auto h-52 max-w-52"><canvas id="crmSources"></canvas></div>
            <div class="mt-4 space-y-2">
                @foreach ([['Website','38%','chart-1'],['Referral','26%','chart-2'],['Social','20%','chart-3'],['Cold Call','16%','chart-4']] as [$l,$v,$c])
                    <div class="flex items-center gap-2 text-sm"><span class="size-2.5 rounded-full" style="background:hsl(var(--{{ $c }}))"></span><span class="flex-1 text-muted-foreground">{{ $l }}</span><span class="font-semibold">{{ $v }}</span></div>
                @endforeach
            </div>
        </x-ui.card>
    </div>

    <div class="mt-4 grid grid-cols-1 gap-4 lg:grid-cols-5">
        {{-- Kanban summary --}}
        <div class="grid grid-cols-2 gap-4 lg:col-span-2 xl:grid-cols-2">
            @foreach ([['New','24','$96K','chart-1'],['Contacted','18','$74K','chart-2'],['Proposal','11','$120K','chart-3'],['Won','9','$186K','chart-5']] as [$stage,$n,$v,$c])
                <div class="ak-card p-4">
                    <div class="mb-2 flex items-center justify-between"><span class="text-sm font-semibold">{{ $stage }}</span><span class="size-2.5 rounded-full" style="background:hsl(var(--{{ $c }}))"></span></div>
                    <p class="text-2xl font-bold">{{ $n }}</p><p class="text-xs text-muted-foreground">deals · {{ $v }}</p>
                </div>
            @endforeach
        </div>

        <x-ui.card title="Recent Activity" subtitle="Team touchpoints" class="lg:col-span-3">
            <ol class="relative space-y-5 border-s border-border ps-5">
                @foreach ([['phone','Called Acme Corp','Priya · 12m ago','text-info bg-info/10'],['mail','Sent proposal to Globex','David · 40m ago','text-primary bg-primary/10'],['check-check','Closed deal with Umbrella ($18.9K)','Marcus · 2h ago','text-success bg-success/10'],['calendar','Scheduled demo with Initech','Layla · 4h ago','text-[hsl(var(--warning))] bg-warning/10'],['user-plus','New lead: Soylent Inc','System · 6h ago','text-muted-foreground bg-muted']] as [$ico,$text,$meta,$tone])
                    <li class="relative">
                        <span class="absolute -start-[1.85rem] grid size-7 place-items-center rounded-full ring-4 ring-card {{ $tone }}"><i data-lucide="{{ $ico }}" class="size-3.5"></i></span>
                        <p class="text-sm font-medium">{{ $text }}</p><p class="text-xs text-muted-foreground">{{ $meta }}</p>
                    </li>
                @endforeach
            </ol>
        </x-ui.card>
    </div>

    @script
    <script>
        {
            const t = window.akChartTheme();
            new Chart(crmPipeline, { type:'bar', data:{ labels:['New','Contacted','Proposal','Negotiation','Won'], datasets:[{ label:'Value ($K)', data:[96,74,120,88,186], backgroundColor:[t.c1,t.c2,t.c3,t.c4,t.c5], borderRadius:8, maxBarThickness:44 }]},
                options:{ indexAxis:'y', responsive:true, maintainAspectRatio:false, plugins:{legend:{display:false}}, scales:{ x:{grid:{color:t.grid},ticks:{color:t.text,callback:v=>'$'+v+'K'}}, y:{grid:{display:false},ticks:{color:t.text}} } } });
            new Chart(crmSources, { type:'doughnut', data:{ labels:['Website','Referral','Social','Cold Call'], datasets:[{ data:[38,26,20,16], backgroundColor:[t.c1,t.c2,t.c3,t.c4], borderWidth:0, hoverOffset:6 }]},
                options:{ responsive:true, maintainAspectRatio:false, cutout:'70%', plugins:{legend:{display:false}} } });
        }
    </script>
    @endscript
</div>
