<x-layouts.app title="Dashboard" :breadcrumbs="[['label' => 'Dashboards'], ['label' => 'Overview']]">
    <x-page-header title="Welcome back, Aisha 👋" subtitle="Here's what's happening with your projects today.">
        <x-slot:actions>
            <x-ui.button variant="outline" icon="calendar">Last 30 days</x-ui.button>
            <x-ui.button icon="download" @click="window.toast('Exporting report…', {variant:'success', title:'Export started'})">Export</x-ui.button>
        </x-slot:actions>
    </x-page-header>

    {{-- Stat cards --}}
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
        <x-ui.stat label="Total Revenue" value="$48,290" icon="dollar-sign" tone="primary" trend="+12.5%" :trend-up="true" />
        <x-ui.stat label="Active Users" value="8,942" icon="users" tone="success" trend="+8.1%" :trend-up="true" />
        <x-ui.stat label="New Orders" value="1,304" icon="shopping-cart" tone="warning" trend="+3.4%" :trend-up="true" />
        <x-ui.stat label="Bounce Rate" value="24.8%" icon="trending-down" tone="destructive" trend="-1.2%" :trend-up="false" />
    </div>

    {{-- Charts row --}}
    <div class="mt-4 grid grid-cols-1 gap-4 lg:grid-cols-3">
        <x-ui.card title="Revenue Overview" subtitle="Monthly revenue vs. expenses" class="lg:col-span-2">
            <x-slot:actions>
                <x-ui.badge variant="success" dot>Live</x-ui.badge>
            </x-slot:actions>
            <div class="h-72"><canvas id="chartRevenue"></canvas></div>
        </x-ui.card>

        <x-ui.card title="Traffic Sources" subtitle="Where visitors come from">
            <div class="mx-auto h-56 max-w-56"><canvas id="chartTraffic"></canvas></div>
            <div class="mt-4 space-y-2">
                @foreach ([['Organic','42%','chart-1'],['Direct','28%','chart-2'],['Referral','18%','chart-3'],['Social','12%','chart-4']] as [$l,$v,$c])
                    <div class="flex items-center gap-2 text-sm">
                        <span class="size-2.5 rounded-full" style="background: hsl(var(--{{ $c }}))"></span>
                        <span class="flex-1 text-muted-foreground">{{ $l }}</span>
                        <span class="font-semibold">{{ $v }}</span>
                    </div>
                @endforeach
            </div>
        </x-ui.card>
    </div>

    {{-- Table + activity --}}
    <div class="mt-4 grid grid-cols-1 gap-4 lg:grid-cols-3">
        <x-ui.card title="Recent Orders" subtitle="Latest transactions" class="lg:col-span-2" :padded="false">
            <x-slot:actions>
                <x-ui.button variant="ghost" size="sm" :href="route('tables')" iconEnd="arrow-right">View all</x-ui.button>
            </x-slot:actions>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-border text-start text-xs uppercase tracking-wide text-muted-foreground">
                            <th class="px-5 py-3 text-start font-semibold">Order</th>
                            <th class="px-5 py-3 text-start font-semibold">Customer</th>
                            <th class="px-5 py-3 text-start font-semibold">Amount</th>
                            <th class="px-5 py-3 text-start font-semibold">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-border">
                        @foreach ([
                            ['#4821','Emily Watson','$249.00','Paid','success'],
                            ['#4820','Omar Haddad','$1,120.00','Pending','warning'],
                            ['#4819','Sofia Martinez','$89.00','Paid','success'],
                            ['#4818','David Chen','$540.00','Refunded','destructive'],
                            ['#4817','Priya Sharma','$320.00','Paid','success'],
                        ] as [$id,$name,$amt,$status,$tone])
                            <tr class="transition-colors hover:bg-muted/40">
                                <td class="px-5 py-3 font-mono font-medium text-primary">{{ $id }}</td>
                                <td class="px-5 py-3">
                                    <div class="flex items-center gap-2.5">
                                        <x-ui.avatar :name="$name" size="xs" />
                                        <span class="font-medium">{{ $name }}</span>
                                    </div>
                                </td>
                                <td class="px-5 py-3 font-semibold">{{ $amt }}</td>
                                <td class="px-5 py-3"><x-ui.badge :variant="$tone">{{ $status }}</x-ui.badge></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </x-ui.card>

        <x-ui.card title="Activity Feed" subtitle="Recent team activity">
            <ol class="relative space-y-5 border-s border-border ps-5">
                @foreach ([
                    ['user-plus','Aisha added a new user','2 minutes ago','text-info bg-info/10'],
                    ['check-check','Order #4821 completed','18 minutes ago','text-success bg-success/10'],
                    ['git-commit-horizontal','Deployed v1.4.2 to production','1 hour ago','text-primary bg-primary/10'],
                    ['message-square','New comment on “Q3 report”','3 hours ago','text-[hsl(var(--warning))] bg-warning/10'],
                    ['upload','Uploaded 12 new assets','Yesterday','text-muted-foreground bg-muted'],
                ] as [$ico,$text,$time,$tone])
                    <li class="relative">
                        <span class="absolute -start-[1.85rem] grid size-7 place-items-center rounded-full ring-4 ring-card {{ $tone }}"><i data-lucide="{{ $ico }}" class="size-3.5"></i></span>
                        <p class="text-sm font-medium">{{ $text }}</p>
                        <p class="text-xs text-muted-foreground">{{ $time }}</p>
                    </li>
                @endforeach
            </ol>
        </x-ui.card>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const t = window.akChartTheme();

            const rev = document.getElementById('chartRevenue');
            if (rev) {
                const ctx = rev.getContext('2d');
                const g = ctx.createLinearGradient(0, 0, 0, 288);
                g.addColorStop(0, t.primary.replace(')', ' / .35)').replace('hsl', 'hsla'));
                g.addColorStop(1, t.primary.replace(')', ' / 0)').replace('hsl', 'hsla'));
                new Chart(rev, {
                    type: 'line',
                    data: {
                        labels: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
                        datasets: [
                            { label: 'Revenue', data: [12,19,15,25,22,30,28,35,32,40,38,48], borderColor: t.primary, backgroundColor: g, fill: true, tension: .4, borderWidth: 2.5, pointRadius: 0, pointHoverRadius: 5 },
                            { label: 'Expenses', data: [8,11,9,14,12,16,15,18,17,20,19,24], borderColor: t.c3, backgroundColor: 'transparent', borderDash: [5,5], fill: false, tension: .4, borderWidth: 2, pointRadius: 0 },
                        ],
                    },
                    options: {
                        responsive: true, maintainAspectRatio: false,
                        plugins: { legend: { labels: { color: t.text, usePointStyle: true, boxWidth: 8 } } },
                        scales: {
                            x: { grid: { display: false }, ticks: { color: t.text } },
                            y: { grid: { color: t.grid }, ticks: { color: t.text, callback: v => '$' + v + 'k' } },
                        },
                    },
                });
            }

            const traf = document.getElementById('chartTraffic');
            if (traf) {
                new Chart(traf, {
                    type: 'doughnut',
                    data: { labels: ['Organic','Direct','Referral','Social'], datasets: [{ data: [42,28,18,12], backgroundColor: [t.c1,t.c2,t.c3,t.c4], borderWidth: 0, hoverOffset: 6 }] },
                    options: { responsive: true, maintainAspectRatio: false, cutout: '68%', plugins: { legend: { display: false } } },
                });
            }
        });
    </script>
    @endpush
</x-layouts.app>
