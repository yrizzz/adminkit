<div>
    <x-page-header :title="$pageTitle" :subtitle="$subtitle">
        <x-slot:actions>
            <x-ui.button variant="outline" icon="filter">Departments</x-ui.button>
            <x-ui.button icon="plus" @click="window.toast('Post a new job', {variant:'info'})">Post job</x-ui.button>
        </x-slot:actions>
    </x-page-header>

    {{-- Compact stat strip --}}
    <div class="grid grid-cols-2 gap-4 lg:grid-cols-4">
        <x-ui.stat label="Open Positions" value="34" icon="briefcase" tone="primary" trend="+6" />
        <x-ui.stat label="Total Applicants" value="1,286" icon="users" tone="info" trend="+128" />
        <x-ui.stat label="Interviews" value="72" icon="calendar-check" tone="warning" trend="+11" />
        <x-ui.stat label="Hires (MTD)" value="18" icon="user-check" tone="success" trend="+4" />
    </div>

    {{-- Kanban hiring pipeline --}}
    <div class="mt-5 mb-2 flex items-center justify-between">
        <h3 class="text-sm font-semibold uppercase tracking-wide text-muted-foreground">Hiring Pipeline</h3>
        <span class="text-xs text-muted-foreground">Drag-and-drop board · demo</span>
    </div>
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-5">
        @php
            $board = [
                ['Applied', '1,286', 'chart-1', [['Nadia Ali','Product Designer','away'],['Tom Wright','Data Analyst','online'],['Chen Wei','Frontend Eng','online']]],
                ['Screening', '642', 'chart-2', [['Sara Kim','DevOps Eng','busy'],['Leo Martins','Marketing Lead','offline']]],
                ['Interview', '214', 'chart-3', [['Maya Chen','Backend Eng','online'],['Ivan Petrov','QA Engineer','away']]],
                ['Offer', '46', 'chart-4', [['Grace Lee','UX Researcher','online']]],
                ['Hired', '18', 'chart-5', [['Omar Haddad','Sales Exec','online'],['Aisha Rahman','Team Lead','online']]],
            ];
        @endphp
        @foreach ($board as [$col, $count, $c, $cards])
            <div class="rounded-2xl border border-border bg-muted/30 p-3">
                <div class="mb-3 flex items-center justify-between px-1">
                    <span class="flex items-center gap-2 text-sm font-semibold"><span class="size-2.5 rounded-full" style="background: hsl(var(--{{ $c }}))"></span>{{ $col }}</span>
                    <span class="rounded-full bg-background px-2 py-0.5 text-xs font-semibold text-muted-foreground">{{ $count }}</span>
                </div>
                <div class="space-y-2.5">
                    @foreach ($cards as [$n,$role,$s])
                        <div class="cursor-grab rounded-xl border border-border bg-card p-3 shadow-sm transition-shadow hover:shadow-md">
                            <div class="flex items-center gap-2.5">
                                <x-ui.avatar :name="$n" size="sm" :status="$s" />
                                <div class="min-w-0"><p class="truncate text-sm font-medium">{{ $n }}</p><p class="truncate text-xs text-muted-foreground">{{ $role }}</p></div>
                            </div>
                            <div class="mt-2.5 flex items-center gap-2 text-xs text-muted-foreground">
                                <span class="inline-flex items-center gap-1"><i data-lucide="paperclip" class="size-3.5"></i>CV</span>
                                <span class="inline-flex items-center gap-1"><i data-lucide="star" class="size-3.5 text-amber-500"></i>{{ number_format(3.8 + ($loop->index * 0.3), 1) }}</span>
                            </div>
                        </div>
                    @endforeach
                    <button class="w-full rounded-xl border border-dashed border-border py-2 text-xs font-medium text-muted-foreground hover:border-primary/40 hover:text-primary">+ Add candidate</button>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Charts + open roles --}}
    <div class="mt-4 grid grid-cols-1 gap-4 lg:grid-cols-3">
        <x-ui.card title="Applications" subtitle="Weekly volume" class="lg:col-span-2">
            <div class="h-64"><canvas id="jobsApps"></canvas></div>
        </x-ui.card>
        <x-ui.card title="Applicants by Source" subtitle="This month">
            <div class="mx-auto h-52 max-w-52"><canvas id="jobsSrc"></canvas></div>
            <div class="mt-4 space-y-2">
                @foreach ([['LinkedIn','44%','chart-1'],['Referral','26%','chart-2'],['Job Board','20%','chart-3'],['Direct','10%','chart-4']] as [$l,$v,$c])
                    <div class="flex items-center gap-2 text-sm"><span class="size-2.5 rounded-full" style="background: hsl(var(--{{ $c }}))"></span><span class="flex-1 text-muted-foreground">{{ $l }}</span><span class="font-semibold">{{ $v }}</span></div>
                @endforeach
            </div>
        </x-ui.card>
    </div>

    @script
    <script>
        {
            const t = window.akChartTheme();
            const a = document.getElementById('jobsApps');
            if (a) new Chart(a, { type:'bar', data:{ labels:['W1','W2','W3','W4','W5','W6','W7','W8'], datasets:[
                { label:'Applications', data:[120,180,150,220,190,260,240,310], backgroundColor:t.c1, borderRadius:6, maxBarThickness:22 },
                { label:'Interviews', data:[20,28,24,34,30,42,38,52], backgroundColor:t.c3, borderRadius:6, maxBarThickness:22 },
            ]}, options:{ responsive:true, maintainAspectRatio:false, plugins:{legend:{labels:{color:t.text,usePointStyle:true,boxWidth:8}}}, scales:{ x:{grid:{display:false},ticks:{color:t.text}}, y:{grid:{color:t.grid},ticks:{color:t.text}} } } });
            const s = document.getElementById('jobsSrc');
            if (s) new Chart(s, { type:'doughnut', data:{ labels:['LinkedIn','Referral','Job Board','Direct'], datasets:[{ data:[44,26,20,10], backgroundColor:[t.c1,t.c2,t.c3,t.c4], borderWidth:0, hoverOffset:6 }]}, options:{ responsive:true, maintainAspectRatio:false, cutout:'70%', plugins:{legend:{display:false}} } });
        }
    </script>
    @endscript
</div>
