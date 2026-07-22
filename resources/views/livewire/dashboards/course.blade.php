<div>
    <x-page-header :title="$pageTitle" :subtitle="$subtitle">
        <x-slot:actions>
            <x-ui.button variant="outline" icon="graduation-cap">Students</x-ui.button>
            <x-ui.button icon="plus" @click="window.toast('Create course', {variant:'info'})">New course</x-ui.button>
        </x-slot:actions>
    </x-page-header>

    <div class="grid grid-cols-2 gap-4 lg:grid-cols-4">
        <x-ui.stat label="Total Courses" value="148" icon="book-open" tone="primary" trend="+8" />
        <x-ui.stat label="Active Students" value="9,842" icon="graduation-cap" tone="info" trend="+412" />
        <x-ui.stat label="Enrollments" value="24,108" icon="user-plus" tone="success" trend="+6.2%" />
        <x-ui.stat label="Revenue" value="$68,240" icon="dollar-sign" tone="warning" trend="+11.4%" />
    </div>

    {{-- Course cards with progress rings --}}
    <div class="mt-5 mb-2 flex items-center justify-between">
        <h3 class="text-sm font-semibold uppercase tracking-wide text-muted-foreground">Popular Courses</h3>
        <x-ui.button variant="ghost" size="sm" iconEnd="arrow-right">All courses</x-ui.button>
    </div>
    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-3">
        @foreach ([
            ['Complete Laravel Bootcamp','code','4,210','4.9','82','chart-1','from-red-500 to-orange-500'],
            ['UI/UX Design Masterclass','palette','3,840','4.8','74','chart-4','from-violet-500 to-purple-600'],
            ['Python for Data Science','database','3,120','4.7','68','chart-3','from-blue-500 to-cyan-500'],
        ] as [$title,$ico,$students,$rating,$comp,$tone,$grad])
            <div class="ak-card overflow-hidden">
                <div class="flex items-center gap-4 p-4">
                    <span class="grid size-12 shrink-0 place-items-center rounded-xl bg-gradient-to-br {{ $grad }} text-white"><i data-lucide="{{ $ico }}" class="size-6"></i></span>
                    <div class="min-w-0 flex-1">
                        <p class="truncate font-semibold">{{ $title }}</p>
                        <p class="mt-0.5 flex items-center gap-3 text-xs text-muted-foreground">
                            <span class="inline-flex items-center gap-1"><i data-lucide="users" class="size-3.5"></i>{{ $students }}</span>
                            <span class="inline-flex items-center gap-1"><i data-lucide="star" class="size-3.5 text-amber-500"></i>{{ $rating }}</span>
                        </p>
                    </div>
                    <x-ui.gauge :value="(int) $comp" :tone="$tone" :size="64" :stroke="6" />
                </div>
            </div>
        @endforeach
    </div>

    {{-- Enrollment chart + category + leaderboard --}}
    <div class="mt-4 grid grid-cols-1 gap-4 lg:grid-cols-3">
        <x-ui.card title="Enrollments" subtitle="Last 6 months" class="lg:col-span-2">
            <div class="h-64"><canvas id="crsEnroll"></canvas></div>
        </x-ui.card>
        <x-ui.card title="By Category" subtitle="Enrollment share">
            <div class="mx-auto h-44 max-w-44"><canvas id="crsCat"></canvas></div>
            <div class="mt-4 space-y-2">
                @foreach ([['Development','40%','chart-1'],['Business','25%','chart-2'],['Design','20%','chart-3'],['Marketing','15%','chart-4']] as [$l,$v,$c])
                    <div class="flex items-center gap-2 text-sm"><span class="size-2.5 rounded-full" style="background:hsl(var(--{{ $c }}))"></span><span class="flex-1 text-muted-foreground">{{ $l }}</span><span class="font-semibold">{{ $v }}</span></div>
                @endforeach
            </div>
        </x-ui.card>
    </div>

    <div class="mt-4 grid grid-cols-1 gap-4 lg:grid-cols-3">
        <x-ui.card title="Top Students" subtitle="By completed courses" class="lg:col-span-2" :padded="false">
            <div class="divide-y divide-border">
                @foreach ([['Aisha Rahman','12 courses','2,480 XP','🥇'],['David Chen','10 courses','2,190 XP','🥈'],['Sofia Martinez','9 courses','1,940 XP','🥉'],['Omar Haddad','7 courses','1,620 XP','4']] as [$n,$courses,$xp,$medal])
                    <div class="flex items-center gap-4 px-5 py-3.5">
                        <span class="w-6 text-center text-lg">{{ $medal }}</span>
                        <x-ui.avatar :name="$n" size="sm" />
                        <div class="min-w-0 flex-1"><p class="truncate text-sm font-semibold">{{ $n }}</p><p class="text-xs text-muted-foreground">{{ $courses }}</p></div>
                        <span class="shrink-0 font-semibold text-primary">{{ $xp }}</span>
                    </div>
                @endforeach
            </div>
        </x-ui.card>
        <x-ui.card title="Upcoming Live" subtitle="Scheduled sessions">
            <div class="space-y-3">
                @foreach ([['Advanced React Patterns','Today · 19:00','text-destructive bg-destructive/10'],['SQL Deep Dive','Tomorrow · 15:00','text-info bg-info/10'],['Figma Workshop','Apr 25 · 18:00','text-primary bg-primary/10']] as [$title,$when,$tone])
                    <div class="flex items-center gap-3">
                        <span class="grid size-9 shrink-0 place-items-center rounded-lg {{ $tone }}"><i data-lucide="radio" class="size-4"></i></span>
                        <div class="min-w-0 flex-1"><p class="truncate text-sm font-medium">{{ $title }}</p><p class="text-xs text-muted-foreground">{{ $when }}</p></div>
                    </div>
                @endforeach
            </div>
        </x-ui.card>
    </div>

    @script
    <script>
        {
            const t = window.akChartTheme();
            const e = document.getElementById('crsEnroll');
            if (e) { const ctx=e.getContext('2d'); const g=ctx.createLinearGradient(0,0,0,256); g.addColorStop(0,'hsla'+t.c1.slice(3,-1)+' / .3)'); g.addColorStop(1,'hsla'+t.c1.slice(3,-1)+' / 0)');
                new Chart(e, { type:'line', data:{ labels:['Nov','Dec','Jan','Feb','Mar','Apr'], datasets:[
                    { label:'Enrollments', data:[2800,3400,3100,4200,3900,4800], borderColor:t.c1, backgroundColor:g, fill:true, tension:.4, pointRadius:0, borderWidth:2.5 },
                    { label:'Completions', data:[1900,2300,2100,2900,2700,3400], borderColor:t.c2, backgroundColor:'transparent', tension:.4, pointRadius:0, borderWidth:2 },
                ]}, options:{ responsive:true, maintainAspectRatio:false, plugins:{legend:{labels:{color:t.text,usePointStyle:true,boxWidth:8}}}, scales:{ x:{grid:{display:false},ticks:{color:t.text}}, y:{grid:{color:t.grid},ticks:{color:t.text}} } } }); }
            const c = document.getElementById('crsCat');
            if (c) new Chart(c, { type:'doughnut', data:{ labels:['Development','Business','Design','Marketing'], datasets:[{ data:[40,25,20,15], backgroundColor:[t.c1,t.c2,t.c3,t.c4], borderWidth:0, hoverOffset:6 }]}, options:{ responsive:true, maintainAspectRatio:false, cutout:'70%', plugins:{legend:{display:false}} } });
        }
    </script>
    @endscript
</div>
