<div>
    <x-page-header :title="$pageTitle" :subtitle="$subtitle">
        <x-slot:actions>
            <x-ui.button variant="outline" icon="search">Find symbol</x-ui.button>
            <x-ui.button variant="success" icon="trending-up" @click="window.toast('Trade', {variant:'success'})">Trade</x-ui.button>
        </x-slot:actions>
    </x-page-header>

    {{-- Indices --}}
    <div class="grid grid-cols-1 gap-4 lg:grid-cols-3">
        @foreach ([['S&P 500','5,204.34','+0.82%',1],['Nasdaq','16,384.47','+1.14%',1],['Dow Jones','38,904.04','-0.21%',0]] as [$name,$val,$chg,$up])
            <x-ui.card>
                <div class="flex items-center justify-between">
                    <div><p class="text-sm text-muted-foreground">{{ $name }}</p><p class="mt-1 text-2xl font-bold">{{ $val }}</p></div>
                    <div class="text-end">
                        <span class="inline-flex items-center gap-1 font-semibold {{ $up ? 'text-success' : 'text-destructive' }}"><i data-lucide="{{ $up ? 'trending-up' : 'trending-down' }}" class="size-4"></i>{{ $chg }}</span>
                        <div class="mt-2 flex items-end gap-0.5">
                            @foreach ([6,9,7,11,8,12,10,14] as $h)<span class="w-1 rounded-sm {{ $up ? 'bg-success/60' : 'bg-destructive/60' }}" style="height:{{ $h * 1.6 }}px"></span>@endforeach
                        </div>
                    </div>
                </div>
            </x-ui.card>
        @endforeach
    </div>

    <div class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
        <x-ui.stat label="Portfolio Value" value="$124,820" icon="wallet" tone="primary" trend="+3.4%" />
        <x-ui.stat label="Day's Gain" value="+$2,140" icon="trending-up" tone="success" trend="+1.7%" />
        <x-ui.stat label="Total Return" value="+$38,420" icon="chart-line" tone="info" trend="+44.5%" />
        <x-ui.stat label="Buying Power" value="$12,600" icon="banknote" tone="warning" trend="Cash" />
    </div>

    <div class="mt-4 grid grid-cols-1 gap-4 lg:grid-cols-3">
        <x-ui.card title="Portfolio Performance" subtitle="1 year" class="lg:col-span-2">
            <div class="h-72"><canvas id="stkPerf"></canvas></div>
        </x-ui.card>

        <x-ui.card title="Allocation" subtitle="By sector">
            <div class="mx-auto h-52 max-w-52"><canvas id="stkAlloc"></canvas></div>
            <div class="mt-4 space-y-2">
                @foreach ([['Technology','44%','chart-1'],['Healthcare','21%','chart-2'],['Finance','18%','chart-3'],['Energy','17%','chart-4']] as [$l,$v,$c])
                    <div class="flex items-center gap-2 text-sm"><span class="size-2.5 rounded-full" style="background:hsl(var(--{{ $c }}))"></span><span class="flex-1 text-muted-foreground">{{ $l }}</span><span class="font-semibold">{{ $v }}</span></div>
                @endforeach
            </div>
        </x-ui.card>
    </div>

    <div class="mt-4 grid grid-cols-1 gap-4 lg:grid-cols-2">
        <x-ui.card title="Holdings" subtitle="Your positions" :padded="false">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead><tr class="border-b border-border text-xs uppercase tracking-wide text-muted-foreground">
                        <th class="px-5 py-3 text-start font-semibold">Symbol</th><th class="px-5 py-3 text-end font-semibold">Shares</th>
                        <th class="px-5 py-3 text-end font-semibold">Value</th><th class="px-5 py-3 text-end font-semibold">Gain/Loss</th>
                    </tr></thead>
                    <tbody class="divide-y divide-border">
                        @foreach ([['AAPL','Apple Inc.','120','$22,440','+18.4%',1],['MSFT','Microsoft','80','$34,120','+24.1%',1],['NVDA','NVIDIA','40','$36,800','+62.8%',1],['TSLA','Tesla','60','$10,560','-12.3%',0],['AMZN','Amazon','50','$9,240','+8.9%',1]] as [$sym,$name,$sh,$val,$gl,$up])
                            <tr class="hover:bg-muted/40">
                                <td class="px-5 py-3"><div><p class="font-semibold leading-tight">{{ $sym }}</p><p class="text-xs text-muted-foreground">{{ $name }}</p></div></td>
                                <td class="px-5 py-3 text-end">{{ $sh }}</td><td class="px-5 py-3 text-end font-semibold">{{ $val }}</td>
                                <td class="px-5 py-3 text-end font-semibold {{ $up ? 'text-success' : 'text-destructive' }}">{{ $gl }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </x-ui.card>

        <x-ui.card title="Market Movers" subtitle="Today's top gainers & losers">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <p class="mb-2 text-xs font-semibold uppercase tracking-wide text-success">Gainers</p>
                    <div class="space-y-2">
                        @foreach ([['NVDA','+8.4%'],['AMD','+6.1%'],['META','+4.7%'],['NFLX','+3.9%']] as [$s,$c])
                            <div class="flex items-center justify-between rounded-lg bg-success/8 px-3 py-2 text-sm"><span class="font-semibold">{{ $s }}</span><span class="font-semibold text-success">{{ $c }}</span></div>
                        @endforeach
                    </div>
                </div>
                <div>
                    <p class="mb-2 text-xs font-semibold uppercase tracking-wide text-destructive">Losers</p>
                    <div class="space-y-2">
                        @foreach ([['TSLA','-5.2%'],['INTC','-3.8%'],['BA','-2.9%'],['DIS','-1.6%']] as [$s,$c])
                            <div class="flex items-center justify-between rounded-lg bg-destructive/8 px-3 py-2 text-sm"><span class="font-semibold">{{ $s }}</span><span class="font-semibold text-destructive">{{ $c }}</span></div>
                        @endforeach
                    </div>
                </div>
            </div>
        </x-ui.card>
    </div>

    @script
    <script>
        {
            const t = window.akChartTheme();
            const ctx = stkPerf.getContext('2d'); const g = ctx.createLinearGradient(0,0,0,288);
            g.addColorStop(0,'hsla'+t.c1.slice(3,-1)+' / .3)'); g.addColorStop(1,'hsla'+t.c1.slice(3,-1)+' / 0)');
            const d=[]; let v=86; for(let i=0;i<52;i++){ v += (Math.sin(i/5)*2 + (Math.random()-.35)*2); d.push(Math.max(70,v)); }
            new Chart(stkPerf, { type:'line', data:{ labels:d.map((_,i)=>i+1), datasets:[{ label:'Value ($k)', data:d, borderColor:t.c1, backgroundColor:g, fill:true, tension:.4, pointRadius:0, borderWidth:2.5 }]},
                options:{ responsive:true, maintainAspectRatio:false, plugins:{legend:{display:false}}, scales:{ x:{grid:{display:false},ticks:{color:t.text,maxTicksLimit:10}}, y:{grid:{color:t.grid},ticks:{color:t.text,callback:v=>'$'+Math.round(v)+'k'}} } } });
            new Chart(stkAlloc, { type:'doughnut', data:{ labels:['Tech','Health','Finance','Energy'], datasets:[{ data:[44,21,18,17], backgroundColor:[t.c1,t.c2,t.c3,t.c4], borderWidth:0, hoverOffset:6 }]},
                options:{ responsive:true, maintainAspectRatio:false, cutout:'70%', plugins:{legend:{display:false}} } });
        }
    </script>
    @endscript
</div>
