<x-layouts.app :title="$pageTitle" :breadcrumbs="$breadcrumbs">
    <x-page-header :title="$pageTitle" :subtitle="$subtitle">
        <x-slot:actions>
            <x-ui.button variant="outline" icon="calendar">This quarter</x-ui.button>
            <x-ui.button icon="plus" @click="window.toast('New deal form', {variant:'info'})">New deal</x-ui.button>
        </x-slot:actions>
    </x-page-header>

    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
        <x-ui.stat label="Total Sales" value="$284,540" icon="dollar-sign" tone="primary" trend="+14.2%" />
        <x-ui.stat label="Deals Won" value="326" icon="handshake" tone="success" trend="+9.4%" />
        <x-ui.stat label="Avg Deal Size" value="$4,180" icon="receipt" tone="info" trend="+3.1%" />
        <x-ui.stat label="Win Rate" value="62.8%" icon="target" tone="warning" trend="-1.5%" :trend-up="false" />
    </div>

    <div class="mt-4 grid grid-cols-1 gap-4 lg:grid-cols-3">
        <x-ui.card title="Revenue vs Target" subtitle="Monthly performance" class="lg:col-span-2">
            <div class="h-72"><canvas id="salesTrend"></canvas></div>
        </x-ui.card>

        <x-ui.card title="Sales Funnel" subtitle="Conversion by stage">
            <div class="space-y-4">
                @foreach ([['Leads','4,820','100','bg-chart-1'],['Qualified','2,140','44','bg-chart-2'],['Proposal','980','20','bg-chart-3'],['Negotiation','540','11','bg-chart-4'],['Won','326','7','bg-chart-5']] as [$stage,$n,$pct,$c])
                    <div>
                        <div class="mb-1 flex justify-between text-sm"><span class="font-medium">{{ $stage }}</span><span class="text-muted-foreground">{{ $n }}</span></div>
                        <div class="h-2.5 w-full overflow-hidden rounded-full bg-muted"><div class="h-full rounded-full {{ $c }}" style="width: {{ $pct }}%"></div></div>
                    </div>
                @endforeach
            </div>
        </x-ui.card>
    </div>

    <div class="mt-4 grid grid-cols-1 gap-4 lg:grid-cols-5">
        <x-ui.card title="Top Sales Reps" subtitle="By closed revenue" class="lg:col-span-3" :padded="false">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead><tr class="border-b border-border text-xs uppercase tracking-wide text-muted-foreground">
                        <th class="px-5 py-3 text-start font-semibold">Rep</th><th class="px-5 py-3 text-start font-semibold">Deals</th>
                        <th class="px-5 py-3 text-start font-semibold">Revenue</th><th class="px-5 py-3 text-start font-semibold">Quota</th>
                    </tr></thead>
                    <tbody class="divide-y divide-border">
                        @foreach ([['Marcus Johnson','48','$92,400','96'],['Priya Sharma','41','$78,900','82'],['David Chen','37','$65,200','71'],['Layla Farouk','29','$48,040','60']] as [$n,$d,$r,$q])
                            <tr class="hover:bg-muted/40">
                                <td class="px-5 py-3"><div class="flex items-center gap-2.5"><x-ui.avatar :name="$n" size="xs" /><span class="font-medium">{{ $n }}</span></div></td>
                                <td class="px-5 py-3">{{ $d }}</td><td class="px-5 py-3 font-semibold">{{ $r }}</td>
                                <td class="px-5 py-3"><div class="flex items-center gap-2"><div class="h-1.5 w-20 overflow-hidden rounded-full bg-muted"><div class="h-full rounded-full bg-primary" style="width: {{ $q }}%"></div></div><span class="text-xs text-muted-foreground">{{ $q }}%</span></div></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </x-ui.card>

        <x-ui.card title="Recent Deals" subtitle="Latest activity" class="lg:col-span-2">
            <div class="space-y-3">
                @foreach ([['Acme Corp','$24,000','Won','success'],['Globex','$12,500','Negotiation','warning'],['Initech','$8,200','Proposal','info'],['Umbrella','$18,900','Won','success'],['Soylent','$5,400','Lost','destructive']] as [$co,$v,$st,$tone])
                    <div class="flex items-center gap-3">
                        <span class="grid size-9 shrink-0 place-items-center rounded-lg bg-primary/10 text-xs font-bold text-primary">{{ substr($co,0,2) }}</span>
                        <div class="min-w-0 flex-1"><p class="truncate text-sm font-medium">{{ $co }}</p><p class="text-xs text-muted-foreground">{{ $v }}</p></div>
                        <x-ui.badge :variant="$tone">{{ $st }}</x-ui.badge>
                    </div>
                @endforeach
            </div>
        </x-ui.card>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const t = window.akChartTheme();
            new Chart(salesTrend, {
                type: 'bar',
                data: { labels: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep'], datasets: [
                    { label: 'Revenue', data: [32,41,38,52,48,61,58,72,68].map(v=>v*1000), backgroundColor: t.c1, borderRadius: 6, maxBarThickness: 26 },
                    { type: 'line', label: 'Target', data: [40,42,44,46,50,55,60,65,70].map(v=>v*1000), borderColor: t.c3, borderDash:[5,5], tension:.4, pointRadius:0, borderWidth: 2 },
                ]},
                options: { responsive:true, maintainAspectRatio:false, plugins:{ legend:{ labels:{ color:t.text, usePointStyle:true, boxWidth:8 } } },
                    scales:{ x:{ grid:{display:false}, ticks:{color:t.text} }, y:{ grid:{color:t.grid}, ticks:{color:t.text, callback:v=>'$'+(v/1000)+'k'} } } },
            });
        });
    </script>
    @endpush
</x-layouts.app>
