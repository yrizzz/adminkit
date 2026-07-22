<x-layouts.app :title="$pageTitle" :breadcrumbs="$breadcrumbs">
    <x-page-header :title="$pageTitle" :subtitle="$subtitle">
        <x-slot:actions>
            <x-ui.button variant="outline" icon="graduation-cap">Students</x-ui.button>
            <x-ui.button icon="plus" @click="window.toast('Create course', {variant:'info'})">New course</x-ui.button>
        </x-slot:actions>
    </x-page-header>

    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
        <x-ui.stat label="Total Courses" value="148" icon="book-open" tone="primary" trend="+8" />
        <x-ui.stat label="Active Students" value="9,842" icon="graduation-cap" tone="info" trend="+412" />
        <x-ui.stat label="Enrollments" value="24,108" icon="user-plus" tone="success" trend="+6.2%" />
        <x-ui.stat label="Revenue" value="$68,240" icon="dollar-sign" tone="warning" trend="+11.4%" />
    </div>

    <div class="mt-4 grid grid-cols-1 gap-4 lg:grid-cols-3">
        <x-ui.card title="Enrollments" subtitle="Last 6 months" class="lg:col-span-2">
            <div class="h-72"><canvas id="crsEnroll"></canvas></div>
        </x-ui.card>

        <x-ui.card title="By Category" subtitle="Enrollment share">
            <div class="mx-auto h-52 max-w-52"><canvas id="crsCat"></canvas></div>
            <div class="mt-4 space-y-2">
                @foreach ([['Development','40%','chart-1'],['Business','25%','chart-2'],['Design','20%','chart-3'],['Marketing','15%','chart-4']] as [$l,$v,$c])
                    <div class="flex items-center gap-2 text-sm"><span class="size-2.5 rounded-full" style="background:hsl(var(--{{ $c }}))"></span><span class="flex-1 text-muted-foreground">{{ $l }}</span><span class="font-semibold">{{ $v }}</span></div>
                @endforeach
            </div>
        </x-ui.card>
    </div>

    <div class="mt-4 grid grid-cols-1 gap-4 lg:grid-cols-3">
        <x-ui.card title="Top Courses" subtitle="By enrollment" class="lg:col-span-2" :padded="false">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead><tr class="border-b border-border text-xs uppercase tracking-wide text-muted-foreground">
                        <th class="px-5 py-3 text-start font-semibold">Course</th><th class="px-5 py-3 text-end font-semibold">Students</th>
                        <th class="px-5 py-3 text-end font-semibold">Rating</th><th class="px-5 py-3 text-start font-semibold">Completion</th>
                    </tr></thead>
                    <tbody class="divide-y divide-border">
                        @foreach ([['Complete Laravel Bootcamp','code','4,210','4.9','82','from-red-500 to-orange-500'],['UI/UX Design Masterclass','palette','3,840','4.8','74','from-violet-500 to-purple-600'],['Python for Data Science','database','3,120','4.7','68','from-blue-500 to-cyan-500'],['Digital Marketing 101','megaphone','2,680','4.6','59','from-emerald-500 to-teal-500'],['Startup Fundamentals','rocket','1,940','4.8','71','from-amber-500 to-yellow-500']] as [$title,$ico,$students,$rating,$comp,$grad])
                            <tr class="hover:bg-muted/40">
                                <td class="px-5 py-3"><div class="flex items-center gap-3"><span class="grid size-9 place-items-center rounded-lg bg-gradient-to-br {{ $grad }} text-white"><i data-lucide="{{ $ico }}" class="size-4"></i></span><span class="font-medium">{{ $title }}</span></div></td>
                                <td class="px-5 py-3 text-end">{{ $students }}</td>
                                <td class="px-5 py-3 text-end"><span class="inline-flex items-center gap-1 font-semibold"><i data-lucide="star" class="size-3.5 text-amber-500"></i>{{ $rating }}</span></td>
                                <td class="px-5 py-3"><div class="flex items-center gap-2"><div class="h-1.5 w-20 overflow-hidden rounded-full bg-muted"><div class="h-full rounded-full bg-primary" style="width:{{ $comp }}%"></div></div><span class="text-xs text-muted-foreground">{{ $comp }}%</span></div></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </x-ui.card>

        <div class="space-y-4">
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
            <x-ui.card title="Recent Students">
                <div class="flex flex-wrap gap-2">
                    @foreach (['Aisha Rahman','David Chen','Sofia Martinez','Omar Haddad','Emily Watson','Kenji Tanaka','Priya Sharma'] as $n)
                        <x-ui.avatar :name="$n" size="sm" class="ring-2 ring-card" />
                    @endforeach
                    <span class="grid size-8 place-items-center rounded-full bg-muted text-xs font-semibold">+2K</span>
                </div>
            </x-ui.card>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const t = window.akChartTheme();
            const ctx = crsEnroll.getContext('2d'); const g = ctx.createLinearGradient(0,0,0,288);
            g.addColorStop(0,'hsla'+t.c1.slice(3,-1)+' / .3)'); g.addColorStop(1,'hsla'+t.c1.slice(3,-1)+' / 0)');
            new Chart(crsEnroll, { type:'line', data:{ labels:['Nov','Dec','Jan','Feb','Mar','Apr'], datasets:[
                { label:'Enrollments', data:[2800,3400,3100,4200,3900,4800], borderColor:t.c1, backgroundColor:g, fill:true, tension:.4, pointRadius:0, borderWidth:2.5 },
                { label:'Completions', data:[1900,2300,2100,2900,2700,3400], borderColor:t.c2, backgroundColor:'transparent', tension:.4, pointRadius:0, borderWidth:2 },
            ]}, options:{ responsive:true, maintainAspectRatio:false, plugins:{legend:{labels:{color:t.text,usePointStyle:true,boxWidth:8}}}, scales:{ x:{grid:{display:false},ticks:{color:t.text}}, y:{grid:{color:t.grid},ticks:{color:t.text}} } } });
            new Chart(crsCat, { type:'doughnut', data:{ labels:['Development','Business','Design','Marketing'], datasets:[{ data:[40,25,20,15], backgroundColor:[t.c1,t.c2,t.c3,t.c4], borderWidth:0, hoverOffset:6 }]},
                options:{ responsive:true, maintainAspectRatio:false, cutout:'70%', plugins:{legend:{display:false}} } });
        });
    </script>
    @endpush
</x-layouts.app>
