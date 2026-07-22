<div>
    <x-page-header :title="$pageTitle" :subtitle="$subtitle">
        <x-slot:actions>
            <x-ui.button variant="outline" icon="store">View store</x-ui.button>
            <x-ui.button icon="package-plus" @click="window.toast('Add product', {variant:'info'})">Add product</x-ui.button>
        </x-slot:actions>
    </x-page-header>

    <div class="grid grid-cols-2 gap-4 lg:grid-cols-4">
        <x-ui.stat label="Revenue" value="$92,410" icon="dollar-sign" tone="primary" trend="+18.6%" />
        <x-ui.stat label="Orders" value="3,842" icon="shopping-bag" tone="info" trend="+12.1%" />
        <x-ui.stat label="Customers" value="12,908" icon="users" tone="success" trend="+6.4%" />
        <x-ui.stat label="Avg Order Value" value="$184" icon="receipt" tone="warning" trend="+2.3%" />
    </div>

    <div class="mt-4 grid grid-cols-1 gap-4 lg:grid-cols-3">
        <x-ui.card title="Revenue & Orders" subtitle="Last 12 months" class="lg:col-span-2">
            <div class="h-72"><canvas id="ecomRev"></canvas></div>
        </x-ui.card>
        <x-ui.card title="Order Status" subtitle="This week">
            <div class="space-y-4">
                @foreach ([['Delivered','2,610','68','bg-success'],['Shipped','724','19','bg-info'],['Processing','382','10','bg-[hsl(var(--warning))]'],['Cancelled','126','3','bg-destructive']] as [$s,$n,$pct,$c])
                    <div><div class="mb-1 flex justify-between text-sm"><span class="font-medium">{{ $s }}</span><span class="text-muted-foreground">{{ $n }}</span></div>
                    <div class="h-2 w-full overflow-hidden rounded-full bg-muted"><div class="h-full rounded-full {{ $c }}" style="width:{{ $pct }}%"></div></div></div>
                @endforeach
            </div>
            <div class="mt-5 rounded-xl bg-muted/40 p-4 text-center">
                <p class="text-3xl font-bold">4.8<span class="text-lg text-muted-foreground">/5</span></p>
                <div class="mt-1 flex justify-center gap-0.5 text-amber-500">@for($i=0;$i<5;$i++)<i data-lucide="star" class="size-4"></i>@endfor</div>
                <p class="mt-1 text-xs text-muted-foreground">2,410 reviews</p>
            </div>
        </x-ui.card>
    </div>

    {{-- Product grid signature --}}
    <div class="mt-5 mb-2 flex items-center justify-between">
        <h3 class="text-sm font-semibold uppercase tracking-wide text-muted-foreground">Best Sellers</h3>
        <x-ui.button variant="ghost" size="sm" iconEnd="arrow-right">All products</x-ui.button>
    </div>
    <div class="grid grid-cols-2 gap-4 md:grid-cols-3 xl:grid-cols-5">
        @foreach ([
            ['Wireless Headphones','headphones','$129','1,204','from-violet-500 to-indigo-500'],
            ['Smart Watch Pro','watch','$249','864','from-sky-500 to-cyan-500'],
            ['Mechanical Keyboard','keyboard','$89','1,540','from-amber-500 to-orange-500'],
            ['4K Webcam','webcam','$65','720','from-emerald-500 to-teal-500'],
            ['USB-C Hub','usb','$39','2,110','from-rose-500 to-pink-500'],
        ] as [$name,$ico,$price,$sold,$grad])
            <div class="ak-card overflow-hidden transition-all hover:-translate-y-1 hover:shadow-lg">
                <div class="relative grid aspect-[4/3] place-items-center bg-gradient-to-br {{ $grad }}">
                    <i data-lucide="{{ $ico }}" class="size-10 text-white/90"></i>
                    <span class="absolute end-2 top-2 rounded-full bg-black/30 px-2 py-0.5 text-[0.65rem] font-bold text-white backdrop-blur">{{ $sold }} sold</span>
                </div>
                <div class="p-3">
                    <p class="truncate text-sm font-semibold">{{ $name }}</p>
                    <div class="mt-1 flex items-center justify-between">
                        <span class="font-bold text-primary">{{ $price }}</span>
                        <button class="rounded-lg p-1.5 text-muted-foreground hover:bg-accent hover:text-foreground"><i data-lucide="pencil" class="size-4"></i></button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Recent orders + category --}}
    <div class="mt-4 grid grid-cols-1 gap-4 lg:grid-cols-3">
        <x-ui.card title="Recent Orders" subtitle="Live feed" class="lg:col-span-2" :padded="false">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead><tr class="border-b border-border text-xs uppercase tracking-wide text-muted-foreground">
                        <th class="px-5 py-3 text-start font-semibold">Order</th><th class="px-5 py-3 text-start font-semibold">Customer</th>
                        <th class="px-5 py-3 text-end font-semibold">Total</th><th class="px-5 py-3 text-start font-semibold">Status</th>
                    </tr></thead>
                    <tbody class="divide-y divide-border">
                        @foreach ([['#10482','Emily Watson','$249','Delivered','success'],['#10481','Omar Haddad','$1,120','Shipped','info'],['#10480','Sofia Martinez','$89','Processing','warning'],['#10479','David Chen','$540','Delivered','success'],['#10478','Priya Sharma','$320','Cancelled','destructive']] as [$id,$cust,$amt,$st,$tone])
                            <tr class="hover:bg-muted/40">
                                <td class="px-5 py-3 font-mono font-medium text-primary">{{ $id }}</td>
                                <td class="px-5 py-3"><div class="flex items-center gap-2.5"><x-ui.avatar :name="$cust" size="xs" /><span class="font-medium">{{ $cust }}</span></div></td>
                                <td class="px-5 py-3 text-end font-semibold">{{ $amt }}</td>
                                <td class="px-5 py-3"><x-ui.badge :variant="$tone">{{ $st }}</x-ui.badge></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </x-ui.card>
        <x-ui.card title="Sales by Category" subtitle="Revenue share">
            <div class="mx-auto h-52 max-w-52"><canvas id="ecomCat"></canvas></div>
        </x-ui.card>
    </div>

    @script
    <script>
        {
            const t = window.akChartTheme();
            const r = document.getElementById('ecomRev');
            if (r) new Chart(r, { data:{ labels:['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'], datasets:[
                { type:'bar', label:'Orders', data:[210,260,240,300,280,340,320,380,360,420,400,460], backgroundColor:t.grid, borderRadius:5, maxBarThickness:16, yAxisID:'y1' },
                { type:'line', label:'Revenue ($k)', data:[42,52,48,60,56,68,64,76,72,84,80,92], borderColor:t.c1, backgroundColor:'transparent', tension:.4, borderWidth:2.5, pointRadius:0, yAxisID:'y' },
            ]}, options:{ responsive:true, maintainAspectRatio:false, plugins:{legend:{labels:{color:t.text,usePointStyle:true,boxWidth:8}}}, scales:{ x:{grid:{display:false},ticks:{color:t.text}}, y:{position:'left',grid:{color:t.grid},ticks:{color:t.text,callback:v=>'$'+v+'k'}}, y1:{position:'right',grid:{display:false},ticks:{color:t.text}} } } });
            const c = document.getElementById('ecomCat');
            if (c) new Chart(c, { type:'doughnut', data:{ labels:['Electronics','Fashion','Home','Sports','Books'], datasets:[{ data:[42,28,16,9,5], backgroundColor:[t.c1,t.c2,t.c3,t.c4,t.c5], borderWidth:0, hoverOffset:6 }]}, options:{ responsive:true, maintainAspectRatio:false, cutout:'66%', plugins:{legend:{position:'bottom',labels:{color:t.text,usePointStyle:true,boxWidth:8,padding:12,font:{size:11}}}} } });
        }
    </script>
    @endscript
</div>
