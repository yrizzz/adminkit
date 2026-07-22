<div>
    <x-page-header :title="$pageTitle" :subtitle="$subtitle">
        <x-slot:actions>
            <x-ui.button variant="outline" icon="calendar">Last 7 days</x-ui.button>
            <x-ui.button variant="outline" icon="download">Export</x-ui.button>
        </x-slot:actions>
    </x-page-header>

    {{-- Live hero + traffic --}}
    <div class="grid grid-cols-1 gap-4 lg:grid-cols-3">
        <div class="relative overflow-hidden rounded-2xl border border-border bg-card p-6">
            <div class="flex items-center gap-2 text-sm font-medium text-muted-foreground">
                <span class="relative flex size-2.5"><span class="absolute inline-flex size-full animate-ping rounded-full bg-success opacity-75"></span><span class="relative inline-flex size-2.5 rounded-full bg-success"></span></span>
                Active right now
            </div>
            <p class="mt-2 text-5xl font-bold tracking-tight">1,284</p>
            <p class="mt-1 text-sm text-muted-foreground">visitors on site</p>
            <div class="mt-4 flex items-end gap-1">
                @foreach ([40,65,50,80,55,70,90,60,75,85,45,95,70,60,88,52] as $h)
                    <div class="flex-1 rounded-sm bg-primary/70" style="height: {{ $h * 0.5 }}px"></div>
                @endforeach
            </div>
            <div class="mt-4 grid grid-cols-2 gap-3 border-t border-border pt-4 text-sm">
                <div><p class="text-muted-foreground">Top page</p><p class="font-semibold">/pricing</p></div>
                <div><p class="text-muted-foreground">Top source</p><p class="font-semibold">Google</p></div>
            </div>
        </div>

        <x-ui.card title="Traffic Overview" subtitle="Sessions & page views" class="lg:col-span-2">
            <div class="h-64"><canvas id="anTraffic"></canvas></div>
        </x-ui.card>
    </div>

    {{-- Metric tiles --}}
    <div class="mt-4 grid grid-cols-2 gap-4 lg:grid-cols-4">
        <x-ui.stat label="Visitors" value="128.4K" icon="users" tone="primary" trend="+9.2%" />
        <x-ui.stat label="Page Views" value="512.9K" icon="eye" tone="info" trend="+14.6%" />
        <x-ui.stat label="Avg. Session" value="3m 42s" icon="clock" tone="success" trend="+0:18" />
        <x-ui.stat label="Bounce Rate" value="38.2%" icon="log-out" tone="destructive" trend="-2.4%" :trend-up="false" />
    </div>

    <div class="mt-4 grid grid-cols-1 gap-4 lg:grid-cols-3">
        <x-ui.card title="Visitors by Country" subtitle="Top locations" class="lg:col-span-2">
            <div class="space-y-4">
                @foreach ([['🇺🇸','United States','42,180','42','bg-chart-1'],['🇬🇧','United Kingdom','21,540','22','bg-chart-2'],['🇮🇩','Indonesia','16,320','16','bg-chart-3'],['🇩🇪','Germany','11,090','11','bg-chart-4'],['🇯🇵','Japan','8,940','9','bg-chart-5']] as [$flag,$country,$n,$pct,$c])
                    <div>
                        <div class="mb-1.5 flex items-center gap-2 text-sm"><span class="text-base">{{ $flag }}</span><span class="flex-1 font-medium">{{ $country }}</span><span class="text-muted-foreground">{{ $n }}</span></div>
                        <div class="h-2 w-full overflow-hidden rounded-full bg-muted"><div class="h-full rounded-full {{ $c }}" style="width:{{ $pct }}%"></div></div>
                    </div>
                @endforeach
            </div>
        </x-ui.card>
        <x-ui.card title="Devices" subtitle="Sessions by device">
            <div class="mx-auto h-44 max-w-44"><canvas id="anDevices"></canvas></div>
            <div class="mt-4 space-y-2">
                @foreach ([['Desktop','58%','chart-1'],['Mobile','36%','chart-2'],['Tablet','6%','chart-3']] as [$l,$v,$c])
                    <div class="flex items-center gap-2 text-sm"><span class="size-2.5 rounded-full" style="background: hsl(var(--{{ $c }}))"></span><span class="flex-1 text-muted-foreground">{{ $l }}</span><span class="font-semibold">{{ $v }}</span></div>
                @endforeach
            </div>
        </x-ui.card>
    </div>

    @script
    <script>
        {
            const t = window.akChartTheme();
            const el = document.getElementById('anTraffic');
            if (el) {
                const ctx = el.getContext('2d'); const g = ctx.createLinearGradient(0,0,0,256);
                g.addColorStop(0,'hsla'+t.c1.slice(3,-1)+' / .3)'); g.addColorStop(1,'hsla'+t.c1.slice(3,-1)+' / 0)');
                new Chart(el, { type:'line', data:{ labels:['Mon','Tue','Wed','Thu','Fri','Sat','Sun'], datasets:[
                    { label:'Sessions', data:[12,19,15,22,25,18,28].map(v=>v*1000), borderColor:t.c1, backgroundColor:g, fill:true, tension:.4, pointRadius:0, borderWidth:2.5 },
                    { label:'Page Views', data:[48,62,55,78,88,70,96].map(v=>v*1000), borderColor:t.c2, backgroundColor:'transparent', tension:.4, pointRadius:0, borderWidth:2 },
                ]}, options:{ responsive:true, maintainAspectRatio:false, plugins:{legend:{labels:{color:t.text,usePointStyle:true,boxWidth:8}}}, scales:{ x:{grid:{display:false},ticks:{color:t.text}}, y:{grid:{color:t.grid},ticks:{color:t.text,callback:v=>(v/1000)+'k'}} } } });
            }
            const d = document.getElementById('anDevices');
            if (d) new Chart(d, { type:'doughnut', data:{ labels:['Desktop','Mobile','Tablet'], datasets:[{ data:[58,36,6], backgroundColor:[t.c1,t.c2,t.c3], borderWidth:0 }]}, options:{ responsive:true, maintainAspectRatio:false, cutout:'68%', plugins:{legend:{display:false}} } });
        }
    </script>
    @endscript
</div>
