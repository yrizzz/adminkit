<div>
    <x-page-header :title="$pageTitle" :subtitle="$subtitle">
        <x-slot:actions>
            <x-ui.button variant="outline" icon="calendar">Last 7 days</x-ui.button>
            <x-ui.button variant="outline" icon="download">Export</x-ui.button>
        </x-slot:actions>
    </x-page-header>

    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
        <x-ui.stat label="Visitors" value="128.4K" icon="users" tone="primary" trend="+9.2%" />
        <x-ui.stat label="Page Views" value="512.9K" icon="eye" tone="info" trend="+14.6%" />
        <x-ui.stat label="Avg. Session" value="3m 42s" icon="clock" tone="success" trend="+0:18" />
        <x-ui.stat label="Bounce Rate" value="38.2%" icon="log-out" tone="destructive" trend="-2.4%" :trend-up="false" />
    </div>

    <div class="mt-4 grid grid-cols-1 gap-4 lg:grid-cols-3">
        <x-ui.card title="Traffic Overview" subtitle="Sessions & page views" class="lg:col-span-2">
            <div class="h-72"><canvas id="anTraffic"></canvas></div>
        </x-ui.card>

        <div class="space-y-4">
            <x-ui.card>
                <div class="flex items-center justify-between">
                    <div><p class="text-sm text-muted-foreground">Active right now</p><p class="mt-1 text-3xl font-bold">1,284</p></div>
                    <span class="flex size-3"><span class="absolute inline-flex size-3 animate-ping rounded-full bg-success opacity-75"></span><span class="relative inline-flex size-3 rounded-full bg-success"></span></span>
                </div>
                <div class="mt-4 flex items-end gap-1">
                    @foreach ([40,65,50,80,55,70,90,60,75,85,45,95,70,60] as $h)
                        <div class="flex-1 rounded-sm bg-primary/70" style="height: {{ $h * 0.4 }}px"></div>
                    @endforeach
                </div>
            </x-ui.card>
            <x-ui.card title="Devices">
                <div class="h-40"><canvas id="anDevices"></canvas></div>
            </x-ui.card>
        </div>
    </div>

    <div class="mt-4 grid grid-cols-1 gap-4 lg:grid-cols-2">
        <x-ui.card title="Top Pages" subtitle="Most viewed" :padded="false">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead><tr class="border-b border-border text-xs uppercase tracking-wide text-muted-foreground">
                        <th class="px-5 py-3 text-start font-semibold">Page</th><th class="px-5 py-3 text-end font-semibold">Views</th><th class="px-5 py-3 text-end font-semibold">Bounce</th><th class="px-5 py-3 text-end font-semibold">Avg. Time</th>
                    </tr></thead>
                    <tbody class="divide-y divide-border">
                        @foreach ([['/','82,410','32%','4m 10s'],['/pricing','48,120','41%','2m 55s'],['/blog/getting-started','36,540','28%','6m 22s'],['/features','29,880','38%','3m 40s'],['/contact','18,220','52%','1m 48s']] as [$page,$views,$bounce,$time])
                            <tr class="hover:bg-muted/40">
                                <td class="px-5 py-3 font-mono text-primary">{{ $page }}</td><td class="px-5 py-3 text-end font-semibold">{{ $views }}</td>
                                <td class="px-5 py-3 text-end text-muted-foreground">{{ $bounce }}</td><td class="px-5 py-3 text-end text-muted-foreground">{{ $time }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </x-ui.card>

        <x-ui.card title="Visitors by Country" subtitle="Top locations">
            <div class="space-y-4">
                @foreach ([['🇺🇸','United States','42,180','42','bg-chart-1'],['🇬🇧','United Kingdom','21,540','22','bg-chart-2'],['🇮🇩','Indonesia','16,320','16','bg-chart-3'],['🇩🇪','Germany','11,090','11','bg-chart-4'],['🇯🇵','Japan','8,940','9','bg-chart-5']] as [$flag,$country,$n,$pct,$c])
                    <div>
                        <div class="mb-1.5 flex items-center gap-2 text-sm"><span class="text-base">{{ $flag }}</span><span class="flex-1 font-medium">{{ $country }}</span><span class="text-muted-foreground">{{ $n }}</span></div>
                        <div class="h-2 w-full overflow-hidden rounded-full bg-muted"><div class="h-full rounded-full {{ $c }}" style="width:{{ $pct }}%"></div></div>
                    </div>
                @endforeach
            </div>
        </x-ui.card>
    </div>

    @script
    <script>
        {
            const t = window.akChartTheme();
            const ctx = anTraffic.getContext('2d'); const g = ctx.createLinearGradient(0,0,0,288);
            g.addColorStop(0,'hsla'+t.c1.slice(3,-1)+' / .3)'); g.addColorStop(1,'hsla'+t.c1.slice(3,-1)+' / 0)');
            new Chart(anTraffic, { type:'line', data:{ labels:['Mon','Tue','Wed','Thu','Fri','Sat','Sun'], datasets:[
                { label:'Sessions', data:[12,19,15,22,25,18,28].map(v=>v*1000), borderColor:t.c1, backgroundColor:g, fill:true, tension:.4, pointRadius:0, borderWidth:2.5 },
                { label:'Page Views', data:[48,62,55,78,88,70,96].map(v=>v*1000), borderColor:t.c2, backgroundColor:'transparent', tension:.4, pointRadius:0, borderWidth:2 },
            ]}, options:{ responsive:true, maintainAspectRatio:false, plugins:{legend:{labels:{color:t.text,usePointStyle:true,boxWidth:8}}}, scales:{ x:{grid:{display:false},ticks:{color:t.text}}, y:{grid:{color:t.grid},ticks:{color:t.text,callback:v=>(v/1000)+'k'}} } } });
            new Chart(anDevices, { type:'doughnut', data:{ labels:['Desktop','Mobile','Tablet'], datasets:[{ data:[58,36,6], backgroundColor:[t.c1,t.c2,t.c3], borderWidth:0 }]},
                options:{ responsive:true, maintainAspectRatio:false, cutout:'65%', plugins:{legend:{position:'right',labels:{color:t.text,usePointStyle:true,boxWidth:8,font:{size:10}}}} } });
        }
    </script>
    @endscript
</div>
