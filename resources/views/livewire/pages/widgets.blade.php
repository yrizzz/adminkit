<div>
    <x-page-header title="Widgets" subtitle="Drop-in dashboard blocks — stats, charts, lists and utilities.">
        <x-slot:actions>
            <x-ui.badge variant="success" dot>45+ widgets</x-ui.badge>
        </x-slot:actions>
    </x-page-header>

    {{-- ═══ KPI stats ═══ --}}
    <x-demo-section title="KPI stats" desc="The classic metric tiles, in four tones." />
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
        <x-ui.stat label="Sessions" value="12,486" icon="activity" tone="primary" trend="+18%" />
        <x-ui.stat label="Conversion" value="3.24%" icon="target" tone="success" trend="+2.1%" />
        <x-ui.stat label="Avg. Order" value="$184" icon="shopping-bag" tone="info" trend="+5.4%" />
        <x-ui.stat label="Refunds" value="42" icon="rotate-ccw" tone="destructive" trend="-0.8%" :trend-up="false" />
    </div>

    {{-- ═══ Gradient stats ═══ --}}
    <x-demo-section title="Gradient tiles" desc="High-contrast cards for hero metrics." />
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
        @foreach ([
            ['Revenue','$48,290','trending-up','+12.5%','from-indigo-500 to-blue-600'],
            ['Customers','8,942','users','+8.1%','from-emerald-500 to-teal-600'],
            ['Orders','1,304','shopping-cart','+3.4%','from-fuchsia-500 to-pink-600'],
            ['Profit','$12,088','wallet','+9.7%','from-amber-500 to-orange-600'],
        ] as [$label,$value,$icon,$trend,$grad])
            <div class="relative overflow-hidden rounded-xl bg-gradient-to-br {{ $grad }} p-5 text-white shadow-lg">
                <div class="pointer-events-none absolute -end-6 -top-6 size-24 rounded-full bg-white/10 blur-2xl"></div>
                <div class="relative flex items-start justify-between">
                    <div>
                        <p class="text-sm text-white/80">{{ $label }}</p>
                        <p class="mt-1 text-2xl font-bold">{{ $value }}</p>
                    </div>
                    <span class="grid size-10 place-items-center rounded-xl bg-white/15 backdrop-blur"><i data-lucide="{{ $icon }}" class="size-5"></i></span>
                </div>
                <p class="relative mt-3 inline-flex items-center gap-1 rounded-full bg-white/15 px-2 py-0.5 text-xs font-semibold backdrop-blur">
                    <i data-lucide="arrow-up-right" class="size-3"></i>{{ $trend }} vs last month
                </p>
            </div>
        @endforeach
    </div>

    {{-- ═══ Sparkline stats ═══ --}}
    <x-demo-section title="Stats with sparklines" desc="A metric plus its recent trend at a glance." />
    <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
        @foreach ([['Visitors','24,108','+6.2%','wgSpark1','success'],['Bounce rate','24.8%','-1.2%','wgSpark2','destructive'],['Page views','86,420','+11.4%','wgSpark3','success']] as [$label,$value,$trend,$id,$tone])
            <x-ui.card>
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-sm text-muted-foreground">{{ $label }}</p>
                        <p class="mt-1 text-2xl font-bold">{{ $value }}</p>
                    </div>
                    <x-ui.badge :variant="$tone">{{ $trend }}</x-ui.badge>
                </div>
                <div class="mt-3 h-14"><canvas id="{{ $id }}"></canvas></div>
            </x-ui.card>
        @endforeach
    </div>

    {{-- ═══ Progress & gauges ═══ --}}
    <x-demo-section title="Progress & gauges" desc="Goal tracking, circular meters and storage." />
    <div class="grid grid-cols-1 gap-4 lg:grid-cols-3">
        <x-ui.card title="Monthly goals">
            <div class="space-y-5">
                @foreach ([['New customers','680 / 1,000','68','bg-primary'],['Revenue target','$48k / $60k','80','bg-success'],['Support tickets','92 / 100','92','bg-[hsl(var(--warning))]']] as [$l,$v,$p,$c])
                    <div>
                        <div class="mb-1.5 flex justify-between text-sm"><span class="font-medium">{{ $l }}</span><span class="text-muted-foreground">{{ $v }}</span></div>
                        <div class="h-2 w-full overflow-hidden rounded-full bg-muted"><div class="h-full rounded-full {{ $c }}" style="width: {{ $p }}%"></div></div>
                    </div>
                @endforeach
            </div>
        </x-ui.card>

        <x-ui.card title="Performance">
            <div class="flex items-center justify-around">
                <x-ui.gauge :value="82" tone="primary" :size="104" :stroke="9" label="Uptime" />
                <x-ui.gauge :value="64" tone="success" :size="104" :stroke="9" label="Capacity" />
            </div>
        </x-ui.card>

        <x-ui.card title="Storage">
            <div class="flex flex-col items-center">
                <x-ui.gauge :value="68" tone="info" :size="120" :stroke="10" sub="used" />
                <p class="mt-2 text-sm text-muted-foreground">34.2 GB of 50 GB</p>
            </div>
            <div class="mt-4 space-y-2">
                @foreach ([['Images','14.1 GB','bg-info'],['Videos','11.8 GB','bg-primary'],['Docs','5.2 GB','bg-success']] as [$l,$s,$b])
                    <div class="flex items-center gap-2.5 text-sm"><span class="size-2.5 rounded-full {{ $b }}"></span><span class="flex-1">{{ $l }}</span><span class="text-muted-foreground">{{ $s }}</span></div>
                @endforeach
            </div>
        </x-ui.card>
    </div>

    {{-- ═══ Charts ═══ --}}
    <x-demo-section title="Chart widgets" desc="Compact, theme-aware analytics blocks." />
    <div class="grid grid-cols-1 gap-4 lg:grid-cols-3">
        <x-ui.card title="Revenue" subtitle="Last 12 months" class="lg:col-span-2">
            <div class="h-56"><canvas id="wgRevenue"></canvas></div>
        </x-ui.card>
        <x-ui.card title="Traffic sources" subtitle="This month">
            <div class="mx-auto h-44 max-w-44"><canvas id="wgDonut"></canvas></div>
            <div class="mt-4 space-y-2">
                @foreach ([['Organic','42%','bg-primary'],['Direct','28%','bg-success'],['Referral','18%','bg-[hsl(var(--warning))]'],['Social','12%','bg-fuchsia-500']] as [$l,$v,$b])
                    <div class="flex items-center gap-2.5 text-sm"><span class="size-2.5 rounded-full {{ $b }}"></span><span class="flex-1">{{ $l }}</span><span class="font-semibold">{{ $v }}</span></div>
                @endforeach
            </div>
        </x-ui.card>
    </div>

    {{-- ═══ People & activity ═══ --}}
    <x-demo-section title="People & activity" desc="Team, feed and leaderboard blocks." />
    <div class="grid grid-cols-1 gap-4 lg:grid-cols-3">
        <x-ui.card title="Team members">
            <div class="space-y-1">
                @foreach ([['Aisha Rahman','Admin','online'],['David Chen','Editor','busy'],['Sofia Martinez','Viewer','away'],['Omar Haddad','Manager','offline']] as [$n,$r,$s])
                    <div class="flex items-center gap-3 rounded-lg p-2 hover:bg-accent/40">
                        <x-ui.avatar :name="$n" size="sm" :status="$s" />
                        <div class="min-w-0 flex-1"><p class="truncate text-sm font-medium">{{ $n }}</p><p class="truncate text-xs text-muted-foreground">{{ $r }}</p></div>
                        <button class="rounded-lg p-1.5 text-muted-foreground hover:bg-accent hover:text-foreground"><i data-lucide="ellipsis-vertical" class="size-4"></i></button>
                    </div>
                @endforeach
            </div>
        </x-ui.card>

        <x-ui.card title="Activity feed">
            <ul class="space-y-1">
                @foreach ([['user-plus','Yrizzz added a user','2m','text-info bg-info/10'],['check-check','Order #4821 completed','18m','text-success bg-success/10'],['git-commit-horizontal','Deployed v1.4.2','1h','text-primary bg-primary/10'],['message-square','New comment','3h','text-[hsl(var(--warning))] bg-warning/10']] as [$ic,$t,$a,$tone])
                    <li class="flex items-center gap-3 rounded-lg px-2 py-2 hover:bg-accent/40">
                        <span class="grid size-9 shrink-0 place-items-center rounded-lg {{ $tone }}"><i data-lucide="{{ $ic }}" class="size-4"></i></span>
                        <div class="min-w-0 flex-1"><p class="truncate text-sm font-medium">{{ $t }}</p></div>
                        <span class="shrink-0 text-xs text-muted-foreground">{{ $a }}</span>
                    </li>
                @endforeach
            </ul>
        </x-ui.card>

        <x-ui.card title="Top performers">
            <div class="space-y-3">
                @foreach ([['Aisha Rahman','$18.4k','🥇'],['David Chen','$14.2k','🥈'],['Sofia Martinez','$11.9k','🥉'],['Omar Haddad','$9.6k','4']] as $i => [$n,$v,$medal])
                    <div class="flex items-center gap-3">
                        <span class="grid size-7 shrink-0 place-items-center rounded-lg bg-muted text-sm font-bold">{{ $medal }}</span>
                        <x-ui.avatar :name="$n" size="xs" />
                        <span class="min-w-0 flex-1 truncate text-sm font-medium">{{ $n }}</span>
                        <span class="shrink-0 text-sm font-bold text-success">{{ $v }}</span>
                    </div>
                @endforeach
            </div>
        </x-ui.card>
    </div>

    {{-- ═══ Commerce ═══ --}}
    <x-demo-section title="Commerce" desc="Orders and best-selling products." />
    <div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
        <x-ui.card title="Recent orders" :padded="false">
            <div class="divide-y divide-border">
                @foreach ([['#5821','Aisha Rahman','$249.00','Delivered','success'],['#5820','David Chen','$89.00','Shipped','info'],['#5819','Sofia Martinez','$412.00','Pending','warning'],['#5818','Omar Haddad','$45.00','Delivered','success']] as [$id,$c,$amt,$st,$tone])
                    <div class="flex items-center gap-3 p-3.5">
                        <x-ui.avatar :name="$c" size="sm" />
                        <div class="min-w-0 flex-1"><p class="truncate text-sm font-medium">{{ $c }}</p><p class="text-xs text-muted-foreground">{{ $id }}</p></div>
                        <span class="text-sm font-semibold">{{ $amt }}</span>
                        <x-ui.badge :variant="$tone">{{ $st }}</x-ui.badge>
                    </div>
                @endforeach
            </div>
        </x-ui.card>

        <x-ui.card title="Top products" :padded="false">
            <div class="divide-y divide-border">
                @foreach ([['Wireless Headphones',342,'$44k',88],['Mechanical Keyboard',521,'$46k',96],['USB-C Hub',156,'$7k',42],['4K Action Camera',87,'$17k',34]] as [$name,$sold,$rev,$pct])
                    <div class="flex items-center gap-3 p-3.5">
                        <img src="https://picsum.photos/seed/{{ urlencode($name) }}/80/80" alt="" class="size-11 shrink-0 rounded-lg object-cover" />
                        <div class="min-w-0 flex-1">
                            <p class="truncate text-sm font-medium">{{ $name }}</p>
                            <div class="mt-1 h-1.5 overflow-hidden rounded-full bg-muted"><div class="h-full rounded-full bg-primary" style="width: {{ $pct }}%"></div></div>
                        </div>
                        <div class="shrink-0 text-end"><p class="text-sm font-semibold">{{ $rev }}</p><p class="text-xs text-muted-foreground">{{ $sold }} sold</p></div>
                    </div>
                @endforeach
            </div>
        </x-ui.card>
    </div>

    {{-- ═══ Utility widgets ═══ --}}
    <x-demo-section title="Utility widgets" desc="Weather, schedule, tasks, countdown and more." />
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
        {{-- Weather --}}
        <div class="relative overflow-hidden rounded-xl bg-gradient-to-br from-sky-500 to-indigo-600 p-5 text-white shadow-lg">
            <div class="pointer-events-none absolute -end-8 -top-8 size-28 rounded-full bg-white/10 blur-2xl"></div>
            <div class="relative flex items-start justify-between">
                <div><p class="text-sm text-white/80">Jakarta</p><p class="mt-1 text-4xl font-bold">31°</p><p class="text-sm text-white/80">Partly cloudy</p></div>
                <i data-lucide="cloud-sun" class="size-12"></i>
            </div>
            <div class="relative mt-4 flex justify-between border-t border-white/20 pt-3">
                @foreach ([['Mon','sun','32'],['Tue','cloud-rain','28'],['Wed','cloud','30'],['Thu','sun','33']] as [$d,$ic,$t])
                    <div class="text-center"><p class="text-[0.65rem] text-white/70">{{ $d }}</p><i data-lucide="{{ $ic }}" class="mx-auto my-1 size-4"></i><p class="text-xs font-semibold">{{ $t }}°</p></div>
                @endforeach
            </div>
        </div>

        {{-- Upcoming --}}
        <x-ui.card title="Upcoming">
            <div class="space-y-2.5">
                @foreach ([['video','Product demo','In 2 hours','text-primary bg-primary/10'],['users','Team standup','Tomorrow 09:00','text-info bg-info/10'],['rocket','Sprint review','Fri 15:00','text-success bg-success/10']] as [$ic,$t,$w,$tone])
                    <div class="flex items-center gap-3">
                        <span class="grid size-9 shrink-0 place-items-center rounded-lg {{ $tone }}"><i data-lucide="{{ $ic }}" class="size-4"></i></span>
                        <div class="min-w-0 flex-1"><p class="truncate text-sm font-medium">{{ $t }}</p><p class="text-xs text-muted-foreground">{{ $w }}</p></div>
                    </div>
                @endforeach
            </div>
        </x-ui.card>

        {{-- Task checklist (interactive) --}}
        <x-ui.card title="Today's tasks">
            <div x-data="{ tasks: [
                    { t: 'Review pull requests', d: true },
                    { t: 'Update documentation', d: false },
                    { t: 'Prepare demo slides', d: false },
                    { t: 'Reply to client email', d: true },
                 ],
                 get done() { return this.tasks.filter(t => t.d).length },
                 get pct() { return Math.round(this.done / this.tasks.length * 100) } }">
                <div class="mb-3 flex items-center justify-between text-sm">
                    <span class="text-muted-foreground"><span x-text="done"></span> of <span x-text="tasks.length"></span> done</span>
                    <span class="font-bold text-primary" x-text="pct + '%'"></span>
                </div>
                <div class="mb-3 h-1.5 overflow-hidden rounded-full bg-muted"><div class="h-full rounded-full bg-primary transition-all" :style="`width: ${pct}%`"></div></div>
                <div class="space-y-1.5">
                    <template x-for="(task, i) in tasks" :key="i">
                        <label class="flex cursor-pointer items-center gap-2.5 rounded-lg px-1.5 py-1 text-sm hover:bg-accent/40">
                            <input type="checkbox" x-model="task.d" class="size-4 rounded border-input text-primary focus:ring-primary">
                            <span :class="task.d && 'text-muted-foreground line-through'" x-text="task.t"></span>
                        </label>
                    </template>
                </div>
            </div>
        </x-ui.card>

        {{-- Countdown --}}
        <x-ui.card title="Next release">
            <div x-data="{
                    target: new Date(Date.now() + 3 * 864e5 + 5 * 36e5),
                    d:'00', h:'00', m:'00', s:'00',
                    pad(n){ return String(Math.max(0,n)).padStart(2,'0') },
                    tick(){ const x = this.target - new Date(); if (x<=0) return;
                        this.d=this.pad(Math.floor(x/864e5)); this.h=this.pad(Math.floor(x/36e5)%24);
                        this.m=this.pad(Math.floor(x/6e4)%60); this.s=this.pad(Math.floor(x/1e3)%60); },
                 }" x-init="tick(); setInterval(() => tick(), 1000)">
                <div class="grid grid-cols-4 gap-2 text-center">
                    @foreach ([['d','Days'],['h','Hrs'],['m','Min'],['s','Sec']] as [$k,$l])
                        <div class="rounded-lg bg-muted/60 py-2">
                            <p class="font-mono text-lg font-bold tabular-nums" x-text="{{ $k }}"></p>
                            <p class="text-[0.6rem] uppercase tracking-wide text-muted-foreground">{{ $l }}</p>
                        </div>
                    @endforeach
                </div>
                <p class="mt-3 text-center text-xs text-muted-foreground">v2.2 ships in a few days 🚀</p>
            </div>
        </x-ui.card>
    </div>

    {{-- ═══ Feedback & CTA ═══ --}}
    <x-demo-section title="Feedback & CTA" desc="Ratings, notifications and an upgrade block." />
    <div class="grid grid-cols-1 gap-4 lg:grid-cols-3">
        <x-ui.card title="Customer rating">
            <div class="flex items-center gap-4">
                <div class="text-center">
                    <p class="text-4xl font-bold">4.6</p>
                    <div class="mt-1 flex gap-0.5">@for($n=1;$n<=5;$n++)<i data-lucide="star" class="size-3.5 {{ $n<=4 ? 'fill-amber-400 text-amber-400' : 'fill-amber-400/50 text-amber-400/50' }}"></i>@endfor</div>
                    <p class="mt-1 text-xs text-muted-foreground">2,481 reviews</p>
                </div>
                <div class="flex-1 space-y-1.5">
                    @foreach ([['5',78],['4',15],['3',4],['2',2],['1',1]] as [$s,$p])
                        <div class="flex items-center gap-2 text-xs">
                            <span class="w-3 text-muted-foreground">{{ $s }}</span>
                            <div class="h-1.5 flex-1 overflow-hidden rounded-full bg-muted"><div class="h-full rounded-full bg-amber-400" style="width: {{ $p }}%"></div></div>
                            <span class="w-7 text-end text-muted-foreground">{{ $p }}%</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </x-ui.card>

        <x-ui.card title="Notifications" :padded="false">
            <div class="divide-y divide-border">
                @foreach ([['user-plus','New signup','2m',true],['triangle-alert','Storage 92% full','1h',true],['star','New 5-star review','3h',false]] as [$ic,$t,$a,$unread])
                    <div class="flex items-center gap-3 p-3 {{ $unread ? 'bg-primary/[0.03]' : '' }}">
                        <span class="grid size-8 shrink-0 place-items-center rounded-lg bg-primary/10 text-primary"><i data-lucide="{{ $ic }}" class="size-4"></i></span>
                        <p class="min-w-0 flex-1 truncate text-sm">{{ $t }}</p>
                        <span class="shrink-0 text-xs text-muted-foreground">{{ $a }}</span>
                        @if ($unread)<span class="size-2 shrink-0 rounded-full bg-primary"></span>@endif
                    </div>
                @endforeach
            </div>
        </x-ui.card>

        <x-ui.card title="Upgrade plan" class="relative overflow-hidden">
            <div class="pointer-events-none absolute -end-6 -top-6 size-24 rounded-full bg-primary/10 blur-2xl"></div>
            <div class="relative">
                <div class="flex items-baseline gap-1"><span class="text-3xl font-bold">$29</span><span class="text-muted-foreground">/month</span></div>
                <p class="mt-1 text-sm text-muted-foreground">Pro plan — everything you need to scale.</p>
                <ul class="mt-4 space-y-2 text-sm">
                    @foreach (['Unlimited projects','Priority support','Advanced analytics'] as $f)
                        <li class="flex items-center gap-2"><i data-lucide="circle-check-big" class="size-4 text-success"></i>{{ $f }}</li>
                    @endforeach
                </ul>
                <x-ui.button class="mt-5 w-full" icon="rocket" @click="window.toast('Redirecting to checkout…', {variant:'info'})">Upgrade now</x-ui.button>
            </div>
        </x-ui.card>
    </div>

    {{-- ═══ Compact metrics ═══ --}}
    <x-demo-section title="Compact metrics" desc="Radial rings, bar sparklines and period comparison." />
    <div class="grid grid-cols-1 gap-4 lg:grid-cols-3">
        <x-ui.card title="Completion rings">
            <div class="flex items-center justify-around">
                <x-ui.gauge :value="76" tone="primary" :size="92" :stroke="8" label="Tasks" />
                <x-ui.gauge :value="58" tone="warning" :size="92" :stroke="8" label="Budget" />
                <x-ui.gauge :value="91" tone="success" :size="92" :stroke="8" label="Quality" />
            </div>
        </x-ui.card>

        <x-ui.card title="Weekly volume">
            <div class="space-y-4">
                @foreach ([['Orders','1,304','wgBar1'],['Signups','842','wgBar2']] as [$l,$v,$id])
                    <div class="flex items-center gap-4">
                        <div class="w-24 shrink-0"><p class="text-xs text-muted-foreground">{{ $l }}</p><p class="text-lg font-bold">{{ $v }}</p></div>
                        <div class="h-12 flex-1"><canvas id="{{ $id }}"></canvas></div>
                    </div>
                @endforeach
            </div>
        </x-ui.card>

        <x-ui.card title="This vs last month">
            <div class="grid grid-cols-2 divide-x divide-border rtl:divide-x-reverse">
                <div class="pe-4 text-center">
                    <p class="text-xs text-muted-foreground">This month</p>
                    <p class="mt-1 text-2xl font-bold text-primary">$48.2k</p>
                    <span class="mt-1 inline-flex items-center gap-1 text-xs font-semibold text-success"><i data-lucide="arrow-up-right" class="size-3"></i>12.5%</span>
                </div>
                <div class="ps-4 text-center">
                    <p class="text-xs text-muted-foreground">Last month</p>
                    <p class="mt-1 text-2xl font-bold text-muted-foreground">$42.9k</p>
                    <span class="mt-1 inline-flex items-center gap-1 text-xs text-muted-foreground">baseline</span>
                </div>
            </div>
            <div class="mt-4 h-2 overflow-hidden rounded-full bg-muted"><div class="h-full w-[72%] rounded-full bg-gradient-to-r from-primary to-sidebar-primary"></div></div>
            <p class="mt-2 text-center text-xs text-muted-foreground">72% toward the $67k quarterly goal</p>
        </x-ui.card>
    </div>

    {{-- ═══ Analytics ═══ --}}
    <x-demo-section title="Analytics" desc="Funnel, contribution heatmap and geography." />
    <div class="grid grid-cols-1 gap-4 lg:grid-cols-3">
        <x-ui.card title="Conversion funnel">
            <div class="space-y-3">
                @foreach ([['Visitors','24,108',100,'bg-primary'],['Signups','8,942',62,'bg-info'],['Trials','3,120',34,'bg-[hsl(var(--warning))]'],['Paid','1,304',14,'bg-success']] as [$stage,$val,$pct,$bar])
                    <div>
                        <div class="mb-1 flex justify-between text-sm"><span class="font-medium">{{ $stage }}</span><span class="text-muted-foreground">{{ $val }}</span></div>
                        <div class="h-6 overflow-hidden rounded-lg bg-muted">
                            <div class="flex h-full items-center justify-end rounded-lg {{ $bar }} pe-2 text-[0.65rem] font-bold text-white" style="width: {{ $pct }}%">{{ $pct }}%</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </x-ui.card>

        <x-ui.card title="Activity heatmap" subtitle="Last 13 weeks">
            @php
                $heat = [];
                for ($i = 0; $i < 91; $i++) { $heat[] = (int) floor(abs(sin($i * 1.7)) * 4.99); }
                $heatTones = ['bg-muted', 'bg-success/30', 'bg-success/55', 'bg-success/75', 'bg-success'];
            @endphp
            <div class="grid grid-flow-col grid-rows-7 gap-1">
                @foreach ($heat as $lvl)
                    <span class="size-3 rounded-sm {{ $heatTones[$lvl] }}"></span>
                @endforeach
            </div>
            <div class="mt-3 flex items-center justify-end gap-1.5 text-xs text-muted-foreground">
                Less @foreach ($heatTones as $tone)<span class="size-3 rounded-sm {{ $tone }}"></span>@endforeach More
            </div>
        </x-ui.card>

        <x-ui.card title="Top countries">
            <div class="space-y-3">
                @foreach ([['🇮🇩','Indonesia','8,420',68],['🇺🇸','United States','4,180',34],['🇸🇬','Singapore','2,940',24],['🇯🇵','Japan','1,760',14]] as [$flag,$name,$v,$pct])
                    <div class="flex items-center gap-3">
                        <span class="text-lg">{{ $flag }}</span>
                        <div class="min-w-0 flex-1">
                            <div class="flex justify-between text-sm"><span class="truncate font-medium">{{ $name }}</span><span class="text-muted-foreground">{{ $v }}</span></div>
                            <div class="mt-1 h-1.5 overflow-hidden rounded-full bg-muted"><div class="h-full rounded-full bg-primary" style="width: {{ $pct }}%"></div></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </x-ui.card>
    </div>

    {{-- ═══ System & status ═══ --}}
    <x-demo-section title="System & status" desc="Health, live traffic and service uptime." />
    <div class="grid grid-cols-1 gap-4 lg:grid-cols-3">
        <x-ui.card title="Server health">
            <div class="space-y-4">
                @foreach ([['cpu','CPU','42%',42,'bg-success'],['memory-stick','Memory','68%',68,'bg-[hsl(var(--warning))]'],['hard-drive','Disk','86%',86,'bg-destructive']] as [$ic,$l,$v,$pct,$bar])
                    <div>
                        <div class="mb-1.5 flex items-center gap-2 text-sm">
                            <i data-lucide="{{ $ic }}" class="size-4 text-muted-foreground"></i>
                            <span class="flex-1 font-medium">{{ $l }}</span><span class="text-muted-foreground">{{ $v }}</span>
                        </div>
                        <div class="h-2 overflow-hidden rounded-full bg-muted"><div class="h-full rounded-full {{ $bar }}" style="width: {{ $pct }}%"></div></div>
                    </div>
                @endforeach
            </div>
        </x-ui.card>

        <x-ui.card title="Live visitors">
            <div x-data="{ n: 348 }" x-init="setInterval(() => n = Math.max(280, n + Math.round((Math.random() - .45) * 12)), 2000)">
                <div class="flex items-center gap-3">
                    <span class="relative flex size-3"><span class="absolute inline-flex size-3 animate-ping rounded-full bg-success opacity-75"></span><span class="relative inline-flex size-3 rounded-full bg-success"></span></span>
                    <p class="text-4xl font-bold tabular-nums" x-text="n"></p>
                    <span class="text-sm text-muted-foreground">on site now</span>
                </div>
                <div class="mt-4 space-y-2">
                    @foreach ([['/dashboard',124],['/products',86],['/pricing',72],['/blog',54]] as [$path,$c])
                        <div class="flex items-center gap-2 text-sm"><code class="flex-1 truncate text-muted-foreground">{{ $path }}</code><span class="font-semibold">{{ $c }}</span></div>
                    @endforeach
                </div>
            </div>
        </x-ui.card>

        <x-ui.card title="Service status">
            <div class="space-y-2.5">
                @foreach ([['API','Operational','bg-success','text-success'],['Database','Operational','bg-success','text-success'],['Queue','Degraded','bg-[hsl(var(--warning))]','text-[hsl(var(--warning))]'],['CDN','Operational','bg-success','text-success'],['Email','Outage','bg-destructive','text-destructive']] as [$svc,$st,$dot,$txt])
                    <div class="flex items-center gap-2.5 text-sm">
                        <span class="size-2.5 rounded-full {{ $dot }}"></span>
                        <span class="flex-1 font-medium">{{ $svc }}</span>
                        <span class="text-xs font-semibold {{ $txt }}">{{ $st }}</span>
                    </div>
                @endforeach
            </div>
            <p class="mt-4 border-t border-border pt-3 text-xs text-muted-foreground">Uptime last 30 days: <span class="font-semibold text-foreground">99.94%</span></p>
        </x-ui.card>
    </div>

    {{-- ═══ Social & media ═══ --}}
    <x-demo-section title="Social & media" desc="Follower counts, a media player and a profile card." />
    <div class="grid grid-cols-1 gap-4 lg:grid-cols-3">
        <x-ui.card title="Social reach">
            <div class="grid grid-cols-2 gap-3">
                @foreach ([['twitter','Twitter','18.2k','+312','bg-sky-500'],['facebook','Facebook','24.8k','+180','bg-blue-600'],['instagram','Instagram','42.1k','+920','bg-fuchsia-500'],['linkedin','LinkedIn','9.4k','+64','bg-blue-700']] as [$ic,$name,$count,$delta,$bg])
                    <div class="rounded-xl border border-border p-3">
                        <span class="grid size-9 place-items-center rounded-lg {{ $bg }} text-white"><i data-lucide="{{ $ic }}" class="size-4"></i></span>
                        <p class="mt-2 text-lg font-bold">{{ $count }}</p>
                        <p class="text-xs text-muted-foreground">{{ $name }} <span class="font-semibold text-success">{{ $delta }}</span></p>
                    </div>
                @endforeach
            </div>
        </x-ui.card>

        <x-ui.card title="Now playing">
            <div x-data="{ playing: true, pct: 38 }">
                <div class="flex items-center gap-3">
                    <img src="https://picsum.photos/seed/album-art/120/120" alt="" class="size-16 shrink-0 rounded-xl object-cover" />
                    <div class="min-w-0 flex-1">
                        <p class="truncate font-semibold">Midnight Drive</p>
                        <p class="truncate text-sm text-muted-foreground">Neon Skyline</p>
                    </div>
                </div>
                <div class="mt-4 h-1.5 overflow-hidden rounded-full bg-muted"><div class="h-full rounded-full bg-primary" :style="`width: ${pct}%`"></div></div>
                <div class="mt-1 flex justify-between text-xs text-muted-foreground"><span>1:24</span><span>3:42</span></div>
                <div class="mt-3 flex items-center justify-center gap-4">
                    <button class="text-muted-foreground hover:text-foreground"><i data-lucide="skip-back" class="size-5"></i></button>
                    <button @click="playing = ! playing" class="grid size-11 place-items-center rounded-full bg-primary text-primary-foreground shadow hover:bg-primary/90">
                        <i data-lucide="pause" class="size-5" x-show="playing"></i>
                        <i data-lucide="play" class="size-5" x-show="! playing" x-cloak></i>
                    </button>
                    <button class="text-muted-foreground hover:text-foreground"><i data-lucide="skip-forward" class="size-5"></i></button>
                </div>
            </div>
        </x-ui.card>

        <x-ui.card :padded="false" class="overflow-hidden">
            <div class="h-20 bg-gradient-to-r from-indigo-500 via-primary to-fuchsia-500"></div>
            <div class="-mt-10 px-5 pb-5 text-center">
                <img src="https://api.dicebear.com/9.x/avataaars/svg?seed=Yrizzz&backgroundColor=b6e3f4,c0aede,d1d4f9" alt="" class="mx-auto size-20 rounded-full bg-card ring-4 ring-card" />
                <p class="mt-2 font-bold">Yrizzz</p>
                <p class="text-sm text-muted-foreground">Product Designer</p>
                <div class="mt-4 grid grid-cols-3 divide-x divide-border rtl:divide-x-reverse">
                    @foreach ([['248','Posts'],['18.2k','Followers'],['312','Following']] as [$v,$l])
                        <div><p class="font-bold">{{ $v }}</p><p class="text-xs text-muted-foreground">{{ $l }}</p></div>
                    @endforeach
                </div>
                <x-ui.button size="sm" class="mt-4 w-full" icon="user-plus">Follow</x-ui.button>
            </div>
        </x-ui.card>
    </div>

    {{-- ═══ Workflow ═══ --}}
    <x-demo-section title="Workflow" desc="Onboarding, tickets and file activity." />
    <div class="grid grid-cols-1 gap-4 lg:grid-cols-3">
        <x-ui.card title="Setup progress">
            @php $steps = [['Create account', true], ['Verify email', true], ['Invite your team', true], ['Connect a data source', false], ['Publish first dashboard', false]]; @endphp
            <div class="mb-4 h-1.5 overflow-hidden rounded-full bg-muted"><div class="h-full w-[60%] rounded-full bg-success"></div></div>
            <ol class="space-y-3">
                @foreach ($steps as $i => [$label, $done])
                    <li class="flex items-center gap-3">
                        <span class="grid size-6 shrink-0 place-items-center rounded-full text-xs font-bold {{ $done ? 'bg-success text-white' : 'border-2 border-border text-muted-foreground' }}">
                            @if ($done)<i data-lucide="check" class="size-3.5"></i>@else{{ $i + 1 }}@endif
                        </span>
                        <span class="text-sm {{ $done ? 'text-muted-foreground line-through' : 'font-medium' }}">{{ $label }}</span>
                    </li>
                @endforeach
            </ol>
        </x-ui.card>

        <x-ui.card title="Support tickets">
            <div class="grid grid-cols-3 gap-2 text-center">
                @foreach ([['12','Open','text-destructive bg-destructive/10'],['8','Pending','text-[hsl(var(--warning))] bg-warning/10'],['64','Closed','text-success bg-success/10']] as [$n,$l,$tone])
                    <div class="rounded-xl {{ $tone }} p-3"><p class="text-xl font-bold">{{ $n }}</p><p class="text-xs">{{ $l }}</p></div>
                @endforeach
            </div>
            <div class="mt-4 space-y-2">
                @foreach ([['#4821','Login issue on mobile','high'],['#4820','Billing question','low'],['#4819','Export not working','high']] as [$id,$t,$prio])
                    <div class="flex items-center gap-2 text-sm">
                        <span class="size-2 shrink-0 rounded-full {{ $prio === 'high' ? 'bg-destructive' : 'bg-muted-foreground/40' }}"></span>
                        <span class="min-w-0 flex-1 truncate">{{ $t }}</span>
                        <code class="shrink-0 text-xs text-muted-foreground">{{ $id }}</code>
                    </div>
                @endforeach
            </div>
        </x-ui.card>

        <x-ui.card title="Recent files">
            <div class="space-y-2.5">
                @foreach ([['file-text','Q3-report.pdf','2.4 MB','text-destructive bg-destructive/10'],['sheet','budget.xlsx','640 KB','text-success bg-success/10'],['image','hero-banner.png','4.2 MB','text-info bg-info/10'],['video','promo.mp4','128 MB','text-primary bg-primary/10']] as [$ic,$name,$size,$tone])
                    <div class="flex items-center gap-3">
                        <span class="grid size-9 shrink-0 place-items-center rounded-lg {{ $tone }}"><i data-lucide="{{ $ic }}" class="size-4"></i></span>
                        <div class="min-w-0 flex-1"><p class="truncate text-sm font-medium">{{ $name }}</p><p class="text-xs text-muted-foreground">{{ $size }}</p></div>
                        <button class="rounded-lg p-1.5 text-muted-foreground hover:bg-accent"><i data-lucide="download" class="size-4"></i></button>
                    </div>
                @endforeach
            </div>
        </x-ui.card>
    </div>

    {{-- ═══ Engagement ═══ --}}
    <x-demo-section title="Engagement" desc="A live poll, achievements and a mini calendar." />
    <div class="grid grid-cols-1 gap-4 lg:grid-cols-3">
        {{-- Poll (interactive) --}}
        <x-ui.card title="Quick poll" subtitle="Which feature next?">
            <div x-data="{
                    voted: null,
                    options: [
                        { t: 'Dark mode themes', v: 42 },
                        { t: 'Mobile app', v: 31 },
                        { t: 'API webhooks', v: 18 },
                        { t: 'Offline mode', v: 9 },
                    ],
                    get total() { return this.options.reduce((s, o) => s + o.v, 0) },
                    pct(o) { return Math.round(o.v / this.total * 100) },
                    vote(i) { if (this.voted !== null) return; this.options[i].v++; this.voted = i; window.toast('Thanks for voting!', { variant: 'success' }) },
                 }" class="space-y-2">
                <template x-for="(o, i) in options" :key="o.t">
                    <button @click="vote(i)" class="relative w-full overflow-hidden rounded-lg border border-border p-2.5 text-start text-sm transition hover:border-primary"
                            :class="voted === i && 'border-primary'">
                        <span class="absolute inset-y-0 start-0 bg-primary/10 transition-all" :style="voted !== null ? `width: ${pct(o)}%` : 'width: 0%'"></span>
                        <span class="relative flex justify-between">
                            <span x-text="o.t"></span>
                            <span class="font-semibold" x-show="voted !== null" x-cloak x-text="pct(o) + '%'"></span>
                        </span>
                    </button>
                </template>
                <p class="pt-1 text-xs text-muted-foreground"><span x-text="total"></span> votes</p>
            </div>
        </x-ui.card>

        {{-- Achievements --}}
        <x-ui.card title="Achievements">
            <div class="grid grid-cols-4 gap-3">
                @foreach ([['🏆','Top seller',true],['⚡','Fast responder',true],['🎯','Goal crusher',true],['🌟','5-star pro',false],['🔥','30-day streak',true],['💎','Power user',false],['🚀','Early adopter',true],['🧠','Expert',false]] as [$emoji,$label,$earned])
                    <div class="flex flex-col items-center gap-1 text-center" title="{{ $label }}">
                        <span class="grid size-11 place-items-center rounded-xl text-xl {{ $earned ? 'bg-primary/10' : 'bg-muted grayscale opacity-40' }}">{{ $emoji }}</span>
                        <span class="text-[0.6rem] leading-tight text-muted-foreground">{{ $label }}</span>
                    </div>
                @endforeach
            </div>
        </x-ui.card>

        {{-- Mini calendar --}}
        <x-ui.card title="{{ now()->format('F Y') }}">
            @php
                $first = now()->startOfMonth();
                $offset = (int) $first->dayOfWeekIso - 1;   // Mon = 0
                $days = (int) now()->daysInMonth;
                $today = (int) now()->day;
                $events = [4, 12, 18, 23];
            @endphp
            <div class="grid grid-cols-7 gap-1 text-center text-xs">
                @foreach (['M','T','W','T','F','S','S'] as $d)
                    <span class="py-1 font-semibold text-muted-foreground">{{ $d }}</span>
                @endforeach
                @for ($i = 0; $i < $offset; $i++)<span></span>@endfor
                @for ($d = 1; $d <= $days; $d++)
                    <span class="relative grid aspect-square place-items-center rounded-lg
                        {{ $d === $today ? 'bg-primary font-bold text-primary-foreground' : 'hover:bg-accent' }}">
                        {{ $d }}
                        @if (in_array($d, $events) && $d !== $today)
                            <span class="absolute bottom-1 size-1 rounded-full bg-primary"></span>
                        @endif
                    </span>
                @endfor
            </div>
            <div class="mt-3 border-t border-border pt-3 text-xs text-muted-foreground">
                <span class="inline-flex items-center gap-1.5"><span class="size-1.5 rounded-full bg-primary"></span>{{ count($events) }} events this month</span>
            </div>
        </x-ui.card>
    </div>

    @script
    <script>
        {
            const t = window.akChartTheme();
            const miniBar = (id, data, color) => {
                const el = document.getElementById(id);
                if (! el) return;
                new Chart(el, {
                    type: 'bar',
                    data: { labels: data.map((_, i) => i), datasets: [{ data, backgroundColor: color, borderRadius: 3, maxBarThickness: 10 }] },
                    options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false }, tooltip: { enabled: false } },
                               scales: { x: { display: false }, y: { display: false } } },
                });
            };
            miniBar('wgBar1', [8,14,10,18,15,22,19], t.c1);
            miniBar('wgBar2', [5,9,7,12,10,15,13], t.c2);
            const spark = (id, data, color) => {
                const el = document.getElementById(id);
                if (! el) return;
                new Chart(el, {
                    type: 'line',
                    data: { labels: data.map((_, i) => i), datasets: [{ data, borderColor: color, borderWidth: 2, tension: .4, pointRadius: 0, fill: false }] },
                    options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false }, tooltip: { enabled: false } },
                               scales: { x: { display: false }, y: { display: false } } },
                });
            };
            spark('wgSpark1', [12,18,15,24,21,30,28,35], t.c2);
            spark('wgSpark2', [30,28,31,25,27,22,24,21], t.c5);
            spark('wgSpark3', [40,44,41,52,49,58,62,68], t.c1);

            const rev = document.getElementById('wgRevenue');
            if (rev) {
                const ctx = rev.getContext('2d');
                const g = ctx.createLinearGradient(0, 0, 0, 224);
                g.addColorStop(0, 'hsla' + t.primary.slice(3, -1) + ' / .30)');
                g.addColorStop(1, 'hsla' + t.primary.slice(3, -1) + ' / 0)');
                new Chart(rev, {
                    type: 'line',
                    data: { labels: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
                            datasets: [{ label: 'Revenue', data: [12,19,15,25,22,30,28,35,32,40,38,48], borderColor: t.primary, backgroundColor: g, fill: true, tension: .4, borderWidth: 2.5, pointRadius: 0, pointHoverRadius: 5 }] },
                    options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } },
                               scales: { x: { grid: { display: false }, ticks: { color: t.text } }, y: { grid: { color: t.grid }, ticks: { color: t.text, callback: v => '$' + v + 'k' } } } },
                });
            }

            const dn = document.getElementById('wgDonut');
            if (dn) new Chart(dn, {
                type: 'doughnut',
                data: { labels: ['Organic','Direct','Referral','Social'], datasets: [{ data: [42,28,18,12], backgroundColor: [t.c1,t.c2,t.c3,t.c4], borderWidth: 0, hoverOffset: 6 }] },
                options: { responsive: true, maintainAspectRatio: false, cutout: '68%', plugins: { legend: { display: false } } },
            });
        }
    </script>
    @endscript
</div>
