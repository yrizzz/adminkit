<div>
    {{-- Header Banner & Spotlight Actions --}}
    <x-page-header title="Welcome back, {{ auth()->user()?->name ?? 'Yrizzz' }}! 👋" subtitle="Real-time telemetries, revenue metrics & workspace activity.">
        <x-slot:actions>
            <div class="flex flex-wrap items-center gap-2">
                <span class="inline-flex items-center gap-1.5 rounded-full bg-success/15 px-3 py-1 text-xs font-semibold text-success">
                    <span class="relative flex size-2"><span class="absolute inline-flex size-full animate-ping rounded-full bg-success opacity-75"></span><span class="relative inline-flex size-2 rounded-full bg-success"></span></span>
                    Live Sync Active
                </span>
                <div class="inline-flex rounded-lg border border-border bg-card p-0.5 text-xs font-medium">
                    <button type="button" class="rounded-md bg-primary px-2.5 py-1 text-white shadow-xs">30 Days</button>
                    <button type="button" class="rounded-md px-2.5 py-1 text-muted-foreground hover:text-foreground">90 Days</button>
                    <button type="button" class="rounded-md px-2.5 py-1 text-muted-foreground hover:text-foreground">1 Year</button>
                </div>
            </div>
        </x-slot:actions>
    </x-page-header>

    {{-- Top 6 Stat Cards Grid --}}
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6">
        <x-ui.stat label="Total Revenue" value="$128,450" icon="dollar-sign" tone="primary" trend="+18.4%" :trend-up="true" />
        <x-ui.stat label="Monthly MRR" value="$42,120" icon="credit-card" tone="info" trend="+12.1%" :trend-up="true" />
        <x-ui.stat label="Active Paying" value="12,840" icon="users" tone="success" trend="+8.7%" :trend-up="true" />
        <x-ui.stat label="Conversion" value="4.82%" icon="trending-up" tone="warning" trend="+1.4%" :trend-up="true" />
        <x-ui.stat label="Avg Order Value" value="$348.50" icon="shopping-bag" tone="primary" trend="+3.2%" :trend-up="true" />
        <x-ui.stat label="System Health" value="99.99%" icon="activity" tone="success" trend="24ms latency" :trend-up="true" />
    </div>

    {{-- Live Cluster Telemetry Bar --}}
    <div class="mt-4 grid grid-cols-2 gap-3 sm:grid-cols-4">
        <div class="ak-card flex items-center gap-3.5 p-3.5">
            <span class="grid size-10 shrink-0 place-items-center rounded-xl bg-primary/10 text-primary">
                <i data-lucide="cpu" class="size-5"></i>
            </span>
            <div class="min-w-0 flex-1">
                <p class="text-xs text-muted-foreground">Cluster CPU</p>
                <div class="flex items-baseline gap-2">
                    <p class="font-mono text-base font-bold">32%</p>
                    <span class="text-[0.65rem] font-semibold text-success">Optimal</span>
                </div>
            </div>
        </div>
        <div class="ak-card flex items-center gap-3.5 p-3.5">
            <span class="grid size-10 shrink-0 place-items-center rounded-xl bg-info/10 text-info">
                <i data-lucide="hard-drive" class="size-5"></i>
            </span>
            <div class="min-w-0 flex-1">
                <p class="text-xs text-muted-foreground">RAM Memory</p>
                <div class="flex items-baseline gap-2">
                    <p class="font-mono text-base font-bold">6.8 GB</p>
                    <span class="text-[0.65rem] text-muted-foreground">/ 16 GB</span>
                </div>
            </div>
        </div>
        <div class="ak-card flex items-center gap-3.5 p-3.5">
            <span class="grid size-10 shrink-0 place-items-center rounded-xl bg-warning/10 text-warning">
                <i data-lucide="database" class="size-5"></i>
            </span>
            <div class="min-w-0 flex-1">
                <p class="text-xs text-muted-foreground">Database IOPS</p>
                <div class="flex items-baseline gap-2">
                    <p class="font-mono text-base font-bold">2,840</p>
                    <span class="text-[0.65rem] font-semibold text-success">req/sec</span>
                </div>
            </div>
        </div>
        <div class="ak-card flex items-center gap-3.5 p-3.5">
            <span class="grid size-10 shrink-0 place-items-center rounded-xl bg-success/10 text-success">
                <i data-lucide="globe" class="size-5"></i>
            </span>
            <div class="min-w-0 flex-1">
                <p class="text-xs text-muted-foreground">CDN Traffic</p>
                <div class="flex items-baseline gap-2">
                    <p class="font-mono text-base font-bold">94.2 TB</p>
                    <span class="text-[0.65rem] text-muted-foreground">served</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Main Charts Grid: Revenue & Traffic --}}
    <div class="mt-4 grid grid-cols-1 gap-4 lg:grid-cols-3">
        <x-ui.card title="Revenue & Profit Analytics" subtitle="Monthly financial breakdown vs target" class="lg:col-span-2">
            <x-slot:actions>
                <div class="flex items-center gap-2">
                    <span class="inline-flex items-center gap-1 text-xs font-semibold text-success"><i data-lucide="trending-up" class="size-3.5"></i>+24.8% YoY</span>
                    <x-ui.badge variant="primary">2026 Pro View</x-ui.badge>
                </div>
            </x-slot:actions>
            <div class="h-72"><canvas id="chartRevenue"></canvas></div>
        </x-ui.card>

        <x-ui.card title="Traffic Acquisition" subtitle="Where your customers come from">
            <div class="mx-auto h-52 max-w-52"><canvas id="chartTraffic"></canvas></div>
            <div class="mt-4 space-y-2">
                @foreach ([
                    ['Organic Search','42%','$53,940','chart-1'],
                    ['Direct Visit','28%','$35,960','chart-2'],
                    ['Referrals','18%','$23,120','chart-3'],
                    ['Social Ads','12%','$15,430','chart-4']
                ] as [$l,$v,$amt,$c])
                    <div class="flex items-center gap-2 text-sm">
                        <span class="size-2.5 rounded-full" style="background: hsl(var(--{{ $c }}))"></span>
                        <span class="flex-1 text-muted-foreground">{{ $l }}</span>
                        <span class="text-xs font-medium text-muted-foreground">{{ $amt }}</span>
                        <span class="font-semibold text-foreground">{{ $v }}</span>
                    </div>
                @endforeach
            </div>
        </x-ui.card>
    </div>

    {{-- Multi-Tab Workspace & Target Gauges Grid --}}
    <div class="mt-4 grid grid-cols-1 gap-4 lg:grid-cols-3" x-data="{ activeTab: 'transactions' }">
        {{-- Left 2 Columns: Multi-Tab Data Tables & Logs --}}
        <div class="lg:col-span-2 space-y-4">
            <x-ui.card :padded="false">
                {{-- Tab Headers --}}
                <div class="flex flex-wrap items-center justify-between border-b border-border px-5 py-3.5">
                    <div class="flex gap-2">
                        <button type="button" @click="activeTab = 'transactions'"
                                :class="activeTab === 'transactions' ? 'bg-primary text-white' : 'text-muted-foreground hover:bg-accent hover:text-foreground'"
                                class="rounded-lg px-3 py-1.5 text-xs font-semibold transition-all">
                            Recent Transactions
                        </button>
                        <button type="button" @click="activeTab = 'products'"
                                :class="activeTab === 'products' ? 'bg-primary text-white' : 'text-muted-foreground hover:bg-accent hover:text-foreground'"
                                class="rounded-lg px-3 py-1.5 text-xs font-semibold transition-all">
                            Top Selling Products
                        </button>
                        <button type="button" @click="activeTab = 'activity'"
                                :class="activeTab === 'activity' ? 'bg-primary text-white' : 'text-muted-foreground hover:bg-accent hover:text-foreground'"
                                class="rounded-lg px-3 py-1.5 text-xs font-semibold transition-all">
                            Activity Stream
                        </button>
                    </div>
                    <x-ui.button variant="ghost" size="sm" :href="route('tables')" wire:navigate iconEnd="arrow-right">View All</x-ui.button>
                </div>

                {{-- Tab 1: Transactions Table --}}
                <div x-show="activeTab === 'transactions'" class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="border-b border-border text-start text-xs uppercase tracking-wide text-muted-foreground">
                                <th class="px-5 py-3 text-start font-semibold">Order ID</th>
                                <th class="px-5 py-3 text-start font-semibold">Customer</th>
                                <th class="px-5 py-3 text-start font-semibold">Product</th>
                                <th class="px-5 py-3 text-start font-semibold">Amount</th>
                                <th class="px-5 py-3 text-start font-semibold">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-border">
                            @foreach ([
                                ['#ORD-8921','Emily Watson','Enterprise License','$2,490.00','Paid','success'],
                                ['#ORD-8920','Omar Haddad','Cloud Server Pack','$1,120.00','Pending','warning'],
                                ['#ORD-8919','Sofia Martinez','UI Components Kit','$289.00','Paid','success'],
                                ['#ORD-8918','David Chen','Tailwind Theme Pack','$540.00','Refunded','destructive'],
                                ['#ORD-8917','Priya Sharma','Consulting Addon','$820.00','Paid','success'],
                                ['#ORD-8916','Alex Rivera','SaaS Starter Pack','$490.00','Paid','success'],
                                ['#ORD-8915','Jessica Taylor','API Developer Key','$1,850.00','Paid','success'],
                                ['#ORD-8914','Marcus Vance','Enterprise Support','$750.00','Processing','info'],
                            ] as [$id,$name,$prod,$amt,$status,$tone])
                                <tr class="transition-colors hover:bg-muted/40">
                                    <td class="px-5 py-3 font-mono font-medium text-primary">{{ $id }}</td>
                                    <td class="px-5 py-3">
                                        <div class="flex items-center gap-2.5">
                                            <x-ui.avatar :name="$name" size="xs" />
                                            <span class="font-medium">{{ $name }}</span>
                                        </div>
                                    </td>
                                    <td class="px-5 py-3 text-muted-foreground">{{ $prod }}</td>
                                    <td class="px-5 py-3 font-semibold text-foreground">{{ $amt }}</td>
                                    <td class="px-5 py-3"><x-ui.badge :variant="$tone">{{ $status }}</x-ui.badge></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="flex flex-wrap items-center justify-between border-t border-border bg-muted/20 px-5 py-3 text-xs text-muted-foreground">
                        <span>Showing 8 of 142 transactions</span>
                        <div class="flex items-center gap-4 font-medium">
                            <span>Total Volume: <strong class="font-semibold text-foreground">$8,349.00</strong></span>
                            <span class="hidden sm:inline">·</span>
                            <span class="hidden sm:inline">Success Rate: <strong class="font-semibold text-success">94.2%</strong></span>
                        </div>
                    </div>
                </div>

                {{-- Tab 2: Top Selling Products --}}
                <div x-show="activeTab === 'products'" class="p-5 space-y-4">
                    @foreach ([
                        ['AdminKit Enterprise Pro Suite','$48,420','88','+24%','bg-primary','gem'],
                        ['Tailwind UI Components Kit','$28,890','74','+19%','bg-info','layers'],
                        ['Laravel Boilerplate License','$19,540','58','+12%','bg-success','box'],
                        ['Mobile App React Template','$14,440','42','+8%','bg-warning','smartphone'],
                        ['DevOps Infrastructure Kit','$9,210','30','-1%','bg-destructive','server']
                    ] as [$title,$sales,$pct,$trend,$bg,$ico])
                        <div>
                            <div class="mb-1.5 flex items-center justify-between text-sm">
                                <div class="flex items-center gap-2">
                                    <span class="grid size-7 place-items-center rounded-lg bg-muted text-muted-foreground"><i data-lucide="{{ $ico }}" class="size-4"></i></span>
                                    <span class="font-semibold text-foreground">{{ $title }}</span>
                                </div>
                                <div class="flex items-center gap-3">
                                    <span class="font-bold text-foreground">{{ $sales }}</span>
                                    <span class="text-xs font-semibold {{ str_starts_with($trend,'+') ? 'text-success' : 'text-destructive' }}">{{ $trend }}</span>
                                </div>
                            </div>
                            <div class="h-2 w-full overflow-hidden rounded-full bg-muted">
                                <div class="h-full rounded-full {{ $bg }} transition-all duration-500" style="width: {{ $pct }}%"></div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Tab 3: Activity Stream --}}
                <div x-show="activeTab === 'activity'" class="p-5">
                    <ul class="space-y-3">
                        @foreach ([
                            ['user-plus','Yrizzz added 3 new team members','2 minutes ago','text-info bg-info/10'],
                            ['check-check','Order #ORD-8921 payment verified ($2,490)','18 minutes ago','text-success bg-success/10'],
                            ['git-commit-horizontal','Deployed v1.2.0 to production cluster','1 hour ago','text-primary bg-primary/10'],
                            ['message-square','New customer review on Enterprise License','3 hours ago','text-warning bg-warning/10'],
                            ['upload','Uploaded 24 new design assets to Cloud CDN','Yesterday','text-muted-foreground bg-muted'],
                        ] as [$ico,$text,$time,$tone])
                            <li class="flex items-center gap-3.5 rounded-xl border border-border/50 p-3 transition-all hover:bg-accent/40">
                                <span class="grid size-9 shrink-0 place-items-center rounded-lg {{ $tone }}"><i data-lucide="{{ $ico }}" class="size-4"></i></span>
                                <div class="min-w-0 flex-1">
                                    <p class="truncate text-sm font-semibold text-foreground">{{ $text }}</p>
                                    <p class="text-xs text-muted-foreground">{{ $time }}</p>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </x-ui.card>

            {{-- Bottom Left Fill: Telemetry Node Status & Active Team Workload --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                {{-- Global Node Status & Latency --}}
                <x-ui.card title="Infrastructure Health" subtitle="Real-time node telemetry & latency">
                    <x-slot:actions>
                        <span class="inline-flex items-center gap-1.5 rounded-full bg-success/15 px-2.5 py-0.5 text-xs font-semibold text-success">
                            <span class="size-2 rounded-full bg-success animate-pulse"></span>
                            99.98% Operational
                        </span>
                    </x-slot:actions>
                    <div class="space-y-3">
                        @foreach ([
                            ['US-East (Virginia)', '18ms', '24%', 'bg-success', '4.2 GB / 16 GB'],
                            ['EU-Central (Frankfurt)', '42ms', '48%', 'bg-primary', '7.8 GB / 16 GB'],
                            ['AP-Southeast (Singapore)', '11ms', '15%', 'bg-success', '2.4 GB / 16 GB'],
                            ['AP-South (Tokyo)', '65ms', '82%', 'bg-warning', '13.1 GB / 16 GB']
                        ] as [$region, $ping, $load, $bg, $ram])
                            <div class="rounded-xl border border-border/60 p-3 bg-muted/20 hover:bg-accent/30 transition-colors">
                                <div class="flex items-center justify-between text-xs font-semibold">
                                    <span class="text-foreground flex items-center gap-1.5">
                                        <i data-lucide="server" class="size-3.5 text-muted-foreground"></i>
                                        {{ $region }}
                                    </span>
                                    <span class="text-muted-foreground font-mono text-[0.7rem]">{{ $ping }}</span>
                                </div>
                                <div class="mt-2 flex items-center gap-3">
                                    <div class="h-1.5 flex-1 overflow-hidden rounded-full bg-muted">
                                        <div class="h-full rounded-full {{ $bg }}" style="width: {{ $load }}"></div>
                                    </div>
                                    <span class="text-[0.7rem] font-bold text-foreground">{{ $load }}</span>
                                </div>
                                <div class="mt-1.5 flex justify-between text-[0.68rem] text-muted-foreground">
                                    <span>RAM: {{ $ram }}</span>
                                    <span>Load: 0.42</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </x-ui.card>

                {{-- Active Core Team Members --}}
                <x-ui.card title="Active Team Roster" subtitle="Real-time active workspace users">
                    <x-slot:actions>
                        <button type="button" @click="window.toast('Team invite link copied to clipboard', {variant:'success'})" class="text-xs font-semibold text-primary hover:underline">+ Invite</button>
                    </x-slot:actions>
                    <div class="space-y-2.5">
                        @foreach ([
                            ['Alex Rivera', 'Lead Architect', 'online', '98% Tasks'],
                            ['Jessica Taylor', 'API Specialist', 'online', '12 PRs'],
                            ['Marcus Vance', 'Cloud Security', 'busy', 'Deploying'],
                            ['Elena Rostova', 'UI/UX Designer', 'offline', 'Active 2h ago']
                        ] as [$name, $role, $status, $meta])
                            <div class="flex items-center gap-3 rounded-xl border border-border/60 p-2.5 bg-muted/20 hover:bg-accent/30 transition-colors">
                                <x-ui.avatar :name="$name" size="sm" :status="$status" />
                                <div class="min-w-0 flex-1">
                                    <p class="truncate text-xs font-bold text-foreground">{{ $name }}</p>
                                    <p class="truncate text-[0.7rem] text-muted-foreground">{{ $role }}</p>
                                </div>
                                <span class="text-[0.68rem] font-semibold text-muted-foreground px-2 py-0.5 rounded bg-muted/60">{{ $meta }}</span>
                            </div>
                        @endforeach
                    </div>
                </x-ui.card>
            </div>
        </div>

        {{-- Right Column Power Widgets: Quick Wire & Sprint Task Checklist --}}
        <div class="space-y-4">
            {{-- Goal Gauge Card --}}
            <x-ui.card title="Target Progress" subtitle="Monthly goal target $150,000" class="flex flex-col items-center justify-center">
                <x-ui.gauge :value="85" tone="primary" sub="$128.4K / $150K" label="On track — 3 days left" :size="160" />
                <div class="mt-4 flex w-full justify-around border-t border-border pt-4 text-center text-xs">
                    <div><p class="text-muted-foreground">Daily Avg</p><p class="mt-0.5 font-bold text-foreground">$4,280</p></div>
                    <div><p class="text-muted-foreground">Projected</p><p class="mt-0.5 font-bold text-success">$154,200</p></div>
                </div>
            </x-ui.card>

            {{-- Interactive Sprint Task List Widget --}}
            <x-ui.card title="Sprint Tasks" subtitle="Interactive team checklist" x-data="{
                tasks: [
                    { id: 1, text: 'Deploy v1.2.0 Dark Glassmorphism update', done: true },
                    { id: 2, text: 'Verify Webhook response latency (< 30ms)', done: true },
                    { id: 3, text: 'Audit Livewire 4 state performance', done: false },
                    { id: 4, text: 'Finalize Pro Mode dashboard showcases', done: false }
                ],
                toggle(task) {
                    task.done = !task.done;
                    window.toast(task.done ? 'Task completed! 🎉' : 'Task reopened', {variant: task.done ? 'success' : 'info'});
                }
            }">
                <x-slot:actions>
                    <button type="button" @click="window.toast('New task modal opened', {variant:'info'})" class="text-xs font-semibold text-primary hover:underline">+ Add Task</button>
                </x-slot:actions>
                <ul class="space-y-2.5">
                    <template x-for="task in tasks" :key="task.id">
                        <li @click="toggle(task)" class="flex cursor-pointer items-center gap-3 rounded-lg border border-border/60 p-2.5 transition-all hover:bg-accent/50">
                            <span class="grid size-5 place-items-center rounded border border-sidebar-border transition-colors" :class="task.done ? 'bg-primary border-primary text-white' : 'bg-transparent'">
                                <i data-lucide="check" class="size-3.5" x-show="task.done"></i>
                            </span>
                            <span class="text-sm font-medium transition-all" :class="task.done ? 'line-through text-muted-foreground' : 'text-foreground'" x-text="task.text"></span>
                        </li>
                    </template>
                </ul>
            </x-ui.card>

            {{-- Quick Wire Transfer Widget --}}
            <x-ui.card title="Quick Express Transfer" subtitle="Instant internal team payout" x-data="{ recipient: 'Alex Rivera (Lead Architect)', amount: '250', send() { window.toast('Sent $' + this.amount + ' to ' + this.recipient + '!', {variant:'success'}); } }">
                <div class="space-y-3">
                    <div>
                        <label class="text-xs font-semibold text-muted-foreground">Recipient</label>
                        <select x-model="recipient" class="mt-1 w-full rounded-lg border border-border bg-background px-3 py-2 text-xs font-medium text-foreground focus:outline-none focus:ring-2 focus:ring-primary">
                            <option>Alex Rivera (Lead Architect)</option>
                            <option>Sofia Martinez (UI/UX Designer)</option>
                            <option>Omar Haddad (DevOps Engineer)</option>
                            <option>Emily Watson (Product Manager)</option>
                        </select>
                    </div>
                    <div>
                        <label class="text-xs font-semibold text-muted-foreground">Amount (USD)</label>
                        <div class="relative mt-1">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-xs text-muted-foreground">$</span>
                            <input type="number" x-model="amount" class="w-full rounded-lg border border-border bg-background py-2 pl-7 pr-3 text-xs font-semibold text-foreground focus:outline-none focus:ring-2 focus:ring-primary" placeholder="0.00">
                        </div>
                    </div>
                    <x-ui.button @click="send()" size="sm" variant="primary" class="w-full" icon="send">Send Wire Transfer</x-ui.button>
                </div>
            </x-ui.card>
        </div>
    </div>

    @script
    <script>
        const t = window.akChartTheme();
        const rev = document.getElementById('chartRevenue');
        if (rev) {
            const ctx = rev.getContext('2d');
            const g = ctx.createLinearGradient(0, 0, 0, 288);
            g.addColorStop(0, t.primary.replace(')', ' / .35)').replace('hsl', 'hsla'));
            g.addColorStop(1, t.primary.replace(')', ' / 0)').replace('hsl', 'hsla'));
            new Chart(rev, {
                type: 'line',
                data: { labels: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'], datasets: [
                    { label: 'Revenue', data: [24,32,28,45,40,58,52,68,62,84,78,96], borderColor: t.primary, backgroundColor: g, fill: true, tension: .4, borderWidth: 2.5, pointRadius: 0, pointHoverRadius: 5 },
                    { label: 'Profit', data: [14,20,18,28,25,38,34,46,42,58,52,68], borderColor: t.c2, backgroundColor: 'transparent', tension: .4, borderWidth: 2, pointRadius: 0 },
                    { label: 'Expenses', data: [10,12,10,17,15,20,18,22,20,26,26,28], borderColor: t.c3, backgroundColor: 'transparent', borderDash: [5,5], fill: false, tension: .4, borderWidth: 1.5, pointRadius: 0 }
                ]},
                options: { responsive: true, maintainAspectRatio: false,
                    layout: { padding: { top: 8 } },
                    plugins: { legend: { labels: { color: t.text, usePointStyle: true, boxWidth: 8, padding: 20 } } },
                    scales: { x: { grid: { display: false }, ticks: { color: t.text } }, y: { grid: { color: t.grid }, ticks: { color: t.text, callback: v => '$' + v + 'k' } } } },
            });
        }
        const traf = document.getElementById('chartTraffic');
        if (traf) {
            new Chart(traf, { type: 'doughnut',
                data: { labels: ['Organic Search','Direct Visit','Referrals','Social Ads'], datasets: [{ data: [42,28,18,12], backgroundColor: [t.c1,t.c2,t.c3,t.c4], borderWidth: 0, hoverOffset: 6 }] },
                options: { responsive: true, maintainAspectRatio: false, cutout: '68%', plugins: { legend: { display: false } } },
            });
        }
    </script>
    @endscript
</div>
