<div>
    <x-page-header :title="$pageTitle" :subtitle="$subtitle">
        <x-slot:actions>
            <x-ui.button variant="outline" icon="users">Team</x-ui.button>
            <x-ui.button icon="plus" @click="window.toast('New project', {variant:'info'})">New project</x-ui.button>
        </x-slot:actions>
    </x-page-header>

    {{-- Kanban count board --}}
    <div class="grid grid-cols-2 gap-4 xl:grid-cols-4">
        @foreach ([['To Do','28','list-todo','chart-1'],['In Progress','16','loader','chart-3'],['In Review','9','eye','chart-4'],['Done','64','check-check','chart-2']] as [$col,$n,$ico,$c])
            <div class="ak-card p-5">
                <div class="flex items-center justify-between">
                    <span class="grid size-11 place-items-center rounded-xl" style="background: hsl(var(--{{ $c }})/.14); color: hsl(var(--{{ $c }}))"><i data-lucide="{{ $ico }}" class="size-5"></i></span>
                    <span class="text-3xl font-bold">{{ $n }}</span>
                </div>
                <p class="mt-3 text-sm font-medium text-muted-foreground">{{ $col }}</p>
            </div>
        @endforeach
    </div>

    <div class="mt-4 grid grid-cols-1 gap-4 lg:grid-cols-3">
        <x-ui.card title="Task Completion" subtitle="Last 8 weeks" class="lg:col-span-2">
            <div class="h-64"><canvas id="projTasks"></canvas></div>
        </x-ui.card>
        <x-ui.card title="Sprint Progress" class="flex flex-col items-center justify-center">
            <x-ui.gauge :value="72" tone="chart-2" sub="72 / 100 pts" label="Sprint 14 · 4 days left" :size="150" />
        </x-ui.card>
    </div>

    {{-- Active projects + milestones --}}
    <div class="mt-4 grid grid-cols-1 gap-4 lg:grid-cols-3">
        <x-ui.card title="Active Projects" subtitle="Progress & team" class="lg:col-span-2" :padded="false">
            <div class="divide-y divide-border">
                @foreach ([['Mobile App Redesign',['Aisha Rahman','David Chen','Sofia Martinez'],78,'On track','success'],['Payment Gateway',['Omar Haddad','Priya Sharma'],45,'At risk','warning'],['Data Migration',['Kenji Tanaka','Layla Farouk','Marcus Johnson'],92,'On track','success'],['Onboarding Flow',['Emily Watson'],23,'Delayed','destructive']] as [$name,$team,$prog,$st,$tone])
                    <div class="flex items-center gap-4 px-5 py-4">
                        <div class="min-w-0 flex-1">
                            <div class="flex items-center gap-2"><p class="truncate text-sm font-semibold">{{ $name }}</p><x-ui.badge :variant="$tone">{{ $st }}</x-ui.badge></div>
                            <div class="mt-2 flex items-center gap-3">
                                <div class="h-1.5 flex-1 overflow-hidden rounded-full bg-muted"><div class="h-full rounded-full bg-primary" style="width: {{ $prog }}%"></div></div>
                                <span class="text-xs font-medium text-muted-foreground">{{ $prog }}%</span>
                            </div>
                        </div>
                        <div class="flex -space-x-2 rtl:space-x-reverse">@foreach($team as $m)<x-ui.avatar :name="$m" size="xs" class="ring-2 ring-card" />@endforeach</div>
                    </div>
                @endforeach
            </div>
        </x-ui.card>

        <x-ui.card title="Upcoming Milestones" subtitle="Deadlines">
            <ul class="space-y-1">
                @foreach ([['Design system v2','Apr 24','2 days','text-destructive bg-destructive/10'],['API integration','Apr 28','6 days','text-[hsl(var(--warning))] bg-warning/10'],['Beta release','May 03','11 days','text-info bg-info/10'],['Marketing site','May 10','18 days','text-muted-foreground bg-muted']] as [$task,$date,$left,$tone])
                    <li class="flex items-center gap-3 rounded-lg px-2 py-2 hover:bg-accent/50">
                        <span class="grid size-9 shrink-0 place-items-center rounded-lg {{ $tone }}"><i data-lucide="flag" class="size-4"></i></span>
                        <div class="min-w-0 flex-1">
                            <p class="truncate text-sm font-medium">{{ $task }}</p>
                            <p class="text-xs text-muted-foreground">{{ $date }} · <span class="font-medium">{{ $left }}</span></p>
                        </div>
                    </li>
                @endforeach
            </ul>
        </x-ui.card>
    </div>

    @script
    <script>
        {
            const t = window.akChartTheme();
            const el = document.getElementById('projTasks');
            if (el) new Chart(el, { type:'line', data:{ labels:['W1','W2','W3','W4','W5','W6','W7','W8'], datasets:[
                { label:'Completed', data:[42,58,50,72,68,88,80,102], borderColor:t.c2, backgroundColor:'transparent', tension:.4, pointRadius:0, borderWidth:2.5 },
                { label:'Created', data:[60,72,64,86,80,98,92,110], borderColor:t.c4, borderDash:[5,5], backgroundColor:'transparent', tension:.4, pointRadius:0, borderWidth:2 },
            ]}, options:{ responsive:true, maintainAspectRatio:false, plugins:{legend:{labels:{color:t.text,usePointStyle:true,boxWidth:8}}}, scales:{ x:{grid:{display:false},ticks:{color:t.text}}, y:{grid:{color:t.grid},ticks:{color:t.text}} } } });
        }
    </script>
    @endscript
</div>
