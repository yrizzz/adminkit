<div>
    <x-page-header :title="$pageTitle" :subtitle="$subtitle">
        <x-slot:actions>
            <x-ui.button variant="outline" icon="calendar">This quarter</x-ui.button>
            <x-ui.button icon="plus" @click="window.toast('New deal form', {variant:'info'})">New deal</x-ui.button>
        </x-slot:actions>
    </x-page-header>

    {{-- Hero banner + goal gauge --}}
    <div class="grid grid-cols-1 gap-4 lg:grid-cols-3">
        <div class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-primary to-sidebar-primary p-6 text-white lg:col-span-2">
            <div class="pointer-events-none absolute -end-10 -top-10 size-48 rounded-full bg-white/10 blur-3xl"></div>
            <div class="relative flex flex-wrap items-start justify-between gap-6">
                <div>
                    <p class="text-sm text-white/70">Total revenue · this quarter</p>
                    <p class="mt-1 text-4xl font-bold tracking-tight sm:text-5xl">$284,540</p>
                    <div class="mt-3 inline-flex items-center gap-1.5 rounded-full bg-white/15 px-2.5 py-1 text-sm font-semibold">
                        <i data-lucide="trending-up" class="size-4"></i>+14.2% vs last quarter
                    </div>
                </div>
                <div class="grid grid-cols-3 gap-4 text-center">
                    @foreach ([['Deals','326'],['Win rate','63%'],['Avg','$4.1K']] as [$k,$v])
                        <div><p class="text-2xl font-bold">{{ $v }}</p><p class="text-xs text-white/70">{{ $k }}</p></div>
                    @endforeach
                </div>
            </div>
            <div class="relative mt-4 h-24"><canvas id="salesSpark"></canvas></div>
        </div>

        <x-ui.card title="Quarter Goal" subtitle="Revenue target $450K" class="flex flex-col items-center justify-center">
            <x-ui.gauge :value="63" tone="primary" sub="$284K / $450K" label="On track — 27 days left" :size="150" />
        </x-ui.card>
    </div>

    {{-- Funnel + leaderboard --}}
    <div class="mt-4 grid grid-cols-1 gap-4 lg:grid-cols-5">
        <x-ui.card title="Sales Funnel" subtitle="Conversion by stage" class="lg:col-span-2">
            <div class="space-y-4">
                @foreach ([['Leads','4,820','100','bg-chart-1'],['Qualified','2,140','44','bg-chart-2'],['Proposal','980','20','bg-chart-3'],['Negotiation','540','11','bg-chart-4'],['Won','326','7','bg-chart-5']] as [$stage,$n,$pct,$c])
                    <div>
                        <div class="mb-1 flex justify-between text-sm"><span class="font-medium">{{ $stage }}</span><span class="text-muted-foreground">{{ $n }}</span></div>
                        <div class="h-2.5 w-full overflow-hidden rounded-full bg-muted"><div class="h-full rounded-full {{ $c }}" style="width: {{ $pct }}%"></div></div>
                    </div>
                @endforeach
            </div>
        </x-ui.card>

        <x-ui.card title="Top Sales Reps" subtitle="By closed revenue" class="lg:col-span-3" :padded="false">
            <div class="divide-y divide-border">
                @foreach ([['Marcus Johnson','$92,400','96','🥇'],['Priya Sharma','$78,900','82','🥈'],['David Chen','$65,200','71','🥉'],['Layla Farouk','$48,040','60','4']] as [$n,$rev,$q,$medal])
                    <div class="flex items-center gap-4 px-5 py-3.5">
                        <span class="w-6 text-center text-lg">{{ $medal }}</span>
                        <x-ui.avatar :name="$n" size="sm" />
                        <div class="min-w-0 flex-1">
                            <p class="truncate text-sm font-semibold">{{ $n }}</p>
                            <div class="mt-1 h-1.5 w-full overflow-hidden rounded-full bg-muted"><div class="h-full rounded-full bg-primary" style="width: {{ $q }}%"></div></div>
                        </div>
                        <span class="shrink-0 font-semibold">{{ $rev }}</span>
                    </div>
                @endforeach
            </div>
        </x-ui.card>
    </div>

    {{-- Recent deals + region --}}
    <div class="mt-4 grid grid-cols-1 gap-4 lg:grid-cols-3">
        <x-ui.card title="Recent Deals" subtitle="Latest activity" class="lg:col-span-2">
            <div class="grid grid-cols-1 gap-3 sm:grid-cols-2">
                @foreach ([['Acme Corp','$24,000','Won','success'],['Globex','$12,500','Negotiation','warning'],['Initech','$8,200','Proposal','info'],['Umbrella','$18,900','Won','success'],['Soylent','$5,400','Lost','destructive'],['Stark Inc','$31,000','Won','success']] as [$co,$v,$st,$tone])
                    <div class="flex items-center gap-3 rounded-xl border border-border p-3">
                        <span class="grid size-10 shrink-0 place-items-center rounded-lg bg-primary/10 text-xs font-bold text-primary">{{ substr($co,0,2) }}</span>
                        <div class="min-w-0 flex-1"><p class="truncate text-sm font-medium">{{ $co }}</p><p class="text-xs text-muted-foreground">{{ $v }}</p></div>
                        <x-ui.badge :variant="$tone">{{ $st }}</x-ui.badge>
                    </div>
                @endforeach
            </div>
        </x-ui.card>

        <x-ui.card title="By Region" subtitle="Revenue split">
            <div class="space-y-4">
                @foreach ([['North America','48%','bg-chart-1'],['Europe','29%','bg-chart-2'],['Asia Pacific','16%','bg-chart-3'],['Other','7%','bg-chart-4']] as [$r,$p,$c])
                    <div>
                        <div class="mb-1.5 flex justify-between text-sm"><span class="font-medium">{{ $r }}</span><span class="text-muted-foreground">{{ $p }}</span></div>
                        <div class="h-2 w-full overflow-hidden rounded-full bg-muted"><div class="h-full rounded-full {{ $c }}" style="width: {{ $p }}"></div></div>
                    </div>
                @endforeach
            </div>
        </x-ui.card>
    </div>

    @script
    <script>
        {
            const t = window.akChartTheme();
            const el = document.getElementById('salesSpark');
            if (el) {
                const ctx = el.getContext('2d');
                const g = ctx.createLinearGradient(0, 0, 0, 96);
                g.addColorStop(0, 'rgba(255,255,255,.35)'); g.addColorStop(1, 'rgba(255,255,255,0)');
                new Chart(el, {
                    type: 'line',
                    data: { labels: Array.from({length:14}, (_,i)=>i), datasets: [{ data: [20,28,24,35,30,42,38,48,44,55,50,62,58,70], borderColor: '#fff', backgroundColor: g, fill: true, tension: .45, borderWidth: 2.5, pointRadius: 0 }] },
                    options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } }, scales: { x: { display: false }, y: { display: false } } },
                });
            }
        }
    </script>
    @endscript
</div>
