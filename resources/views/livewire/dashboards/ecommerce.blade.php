<div>
    <x-page-header :title="$pageTitle" :subtitle="$subtitle">
        <x-slot:actions>
            <x-ui.button variant="outline" icon="store">View store</x-ui.button>
            <x-ui.button icon="package-plus" @click="window.toast('Add product', {variant:'info'})">Add product</x-ui.button>
        </x-slot:actions>
    </x-page-header>

    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
        <x-ui.stat label="Revenue" value="$92,410" icon="dollar-sign" tone="primary" trend="+18.6%" />
        <x-ui.stat label="Orders" value="3,842" icon="shopping-bag" tone="info" trend="+12.1%" />
        <x-ui.stat label="Customers" value="12,908" icon="users" tone="success" trend="+6.4%" />
        <x-ui.stat label="Avg Order Value" value="$184" icon="receipt" tone="warning" trend="+2.3%" />
    </div>

    <div class="mt-4 grid grid-cols-1 gap-4 lg:grid-cols-3">
        <x-ui.card title="Revenue & Orders" subtitle="Last 12 months" class="lg:col-span-2">
            <div class="h-72"><canvas id="ecomRev"></canvas></div>
        </x-ui.card>

        <div class="space-y-4">
            <x-ui.card title="Order Status">
                <div class="space-y-3">
                    @foreach ([['Delivered','2,610','68','bg-success'],['Shipped','724','19','bg-info'],['Processing','382','10','bg-[hsl(var(--warning))]'],['Cancelled','126','3','bg-destructive']] as [$s,$n,$pct,$c])
                        <div><div class="mb-1 flex justify-between text-sm"><span class="font-medium">{{ $s }}</span><span class="text-muted-foreground">{{ $n }}</span></div>
                        <div class="h-2 w-full overflow-hidden rounded-full bg-muted"><div class="h-full rounded-full {{ $c }}" style="width:{{ $pct }}%"></div></div></div>
                    @endforeach
                </div>
            </x-ui.card>
            <x-ui.card title="Sales by Category">
                <div class="h-40"><canvas id="ecomCat"></canvas></div>
            </x-ui.card>
        </div>
    </div>

    <div class="mt-4 grid grid-cols-1 gap-4 lg:grid-cols-5">
        <x-ui.card title="Top Products" subtitle="Best sellers this month" class="lg:col-span-3" :padded="false">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead><tr class="border-b border-border text-xs uppercase tracking-wide text-muted-foreground">
                        <th class="px-5 py-3 text-start font-semibold">Product</th><th class="px-5 py-3 text-end font-semibold">Price</th>
                        <th class="px-5 py-3 text-end font-semibold">Sold</th><th class="px-5 py-3 text-end font-semibold">Stock</th><th class="px-5 py-3 text-end font-semibold">Revenue</th>
                    </tr></thead>
                    <tbody class="divide-y divide-border">
                        @foreach ([['Wireless Headphones','headphones','$129','1,204','82','$155K'],['Smart Watch Pro','watch','$249','864','38','$215K'],['Mechanical Keyboard','keyboard','$89','1,540','5','$137K'],['4K Webcam','webcam','$65','720','214','$46K'],['USB-C Hub','usb','$39','2,110','96','$82K']] as [$name,$ico,$price,$sold,$stock,$rev])
                            <tr class="hover:bg-muted/40">
                                <td class="px-5 py-3"><div class="flex items-center gap-3"><span class="grid size-9 place-items-center rounded-lg bg-muted text-muted-foreground"><i data-lucide="{{ $ico }}" class="size-4"></i></span><span class="font-medium">{{ $name }}</span></div></td>
                                <td class="px-5 py-3 text-end">{{ $price }}</td><td class="px-5 py-3 text-end">{{ $sold }}</td>
                                <td class="px-5 py-3 text-end">@if((int)str_replace(',','',$stock) < 10)<span class="font-semibold text-destructive">{{ $stock }}</span>@else{{ $stock }}@endif</td>
                                <td class="px-5 py-3 text-end font-semibold">{{ $rev }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </x-ui.card>

        <x-ui.card title="Recent Orders" subtitle="Live feed" class="lg:col-span-2">
            <div class="space-y-3">
                @foreach ([['#10482','Emily Watson','$249','Delivered','success'],['#10481','Omar Haddad','$1,120','Shipped','info'],['#10480','Sofia Martinez','$89','Processing','warning'],['#10479','David Chen','$540','Delivered','success'],['#10478','Priya Sharma','$320','Cancelled','destructive']] as [$id,$cust,$amt,$st,$tone])
                    <div class="flex items-center gap-3">
                        <span class="font-mono text-xs font-semibold text-primary">{{ $id }}</span>
                        <div class="min-w-0 flex-1"><p class="truncate text-sm font-medium">{{ $cust }}</p><p class="text-xs text-muted-foreground">{{ $amt }}</p></div>
                        <x-ui.badge :variant="$tone">{{ $st }}</x-ui.badge>
                    </div>
                @endforeach
            </div>
        </x-ui.card>
    </div>

    @script
    <script>
        {
            const t = window.akChartTheme();
            new Chart(ecomRev, { data:{ labels:['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'], datasets:[
                { type:'bar', label:'Orders', data:[210,260,240,300,280,340,320,380,360,420,400,460], backgroundColor:t.grid, borderRadius:5, maxBarThickness:16, yAxisID:'y1' },
                { type:'line', label:'Revenue ($k)', data:[42,52,48,60,56,68,64,76,72,84,80,92], borderColor:t.c1, backgroundColor:'transparent', tension:.4, borderWidth:2.5, pointRadius:0, yAxisID:'y' },
            ]}, options:{ responsive:true, maintainAspectRatio:false, plugins:{legend:{labels:{color:t.text,usePointStyle:true,boxWidth:8}}}, scales:{ x:{grid:{display:false},ticks:{color:t.text}}, y:{position:'left',grid:{color:t.grid},ticks:{color:t.text,callback:v=>'$'+v+'k'}}, y1:{position:'right',grid:{display:false},ticks:{color:t.text}} } } });
            new Chart(ecomCat, { type:'polarArea', data:{ labels:['Electronics','Fashion','Home','Sports','Books'], datasets:[{ data:[42,28,16,9,5], backgroundColor:[t.c1,t.c2,t.c3,t.c4,t.c5], borderWidth:0 }]},
                options:{ responsive:true, maintainAspectRatio:false, plugins:{legend:{position:'right',labels:{color:t.text,usePointStyle:true,boxWidth:8,font:{size:10}}}}, scales:{ r:{grid:{color:t.grid},ticks:{display:false}} } } });
        }
    </script>
    @endscript
</div>
