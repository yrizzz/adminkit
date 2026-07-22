<x-layouts.app :title="$pageTitle" :breadcrumbs="$breadcrumbs">
    <x-page-header :title="$pageTitle" :subtitle="$subtitle">
        <x-slot:actions>
            <x-ui.button variant="outline" icon="users">Team</x-ui.button>
            <x-ui.button icon="plus" @click="window.toast('New project', {variant:'info'})">New project</x-ui.button>
        </x-slot:actions>
    </x-page-header>

    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
        <x-ui.stat label="Active Projects" value="18" icon="folder-kanban" tone="primary" trend="+3" />
        <x-ui.stat label="Tasks Done" value="1,284" icon="circle-check-big" tone="success" trend="+124" />
        <x-ui.stat label="Overdue" value="12" icon="clock-alert" tone="destructive" trend="+2" :trend-up="false" />
        <x-ui.stat label="Team Members" value="42" icon="users" tone="info" trend="+5" />
    </div>

    {{-- Kanban summary --}}
    <div class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
        @foreach ([['To Do','28','list-todo','text-muted-foreground','bg-muted'],['In Progress','16','loader','text-info','bg-info/10'],['In Review','9','eye','text-[hsl(var(--warning))]','bg-warning/10'],['Done','64','check-check','text-success','bg-success/10']] as [$col,$n,$ico,$tc,$bg])
            <x-ui.card>
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2.5"><span class="grid size-9 place-items-center rounded-lg {{ $bg }} {{ $tc }}"><i data-lucide="{{ $ico }}" class="size-4"></i></span><span class="text-sm font-semibold">{{ $col }}</span></div>
                    <span class="text-2xl font-bold">{{ $n }}</span>
                </div>
            </x-ui.card>
        @endforeach
    </div>

    <div class="mt-4 grid grid-cols-1 gap-4 lg:grid-cols-3">
        <x-ui.card title="Task Completion" subtitle="Last 8 weeks" class="lg:col-span-2">
            <div class="h-72"><canvas id="projTasks"></canvas></div>
        </x-ui.card>

        <x-ui.card title="Upcoming Deadlines" subtitle="Next milestones">
            <div class="space-y-3">
                @foreach ([['Design system v2','Apr 24','2 days','text-destructive'],['API integration','Apr 28','6 days','text-[hsl(var(--warning))]'],['Beta release','May 03','11 days','text-info'],['Marketing site','May 10','18 days','text-muted-foreground']] as [$task,$date,$left,$tc])
                    <div class="flex items-center gap-3 rounded-lg border border-border p-3">
                        <span class="grid size-9 place-items-center rounded-lg bg-primary/10 text-primary"><i data-lucide="flag" class="size-4"></i></span>
                        <div class="min-w-0 flex-1"><p class="truncate text-sm font-medium">{{ $task }}</p><p class="text-xs text-muted-foreground">{{ $date }}</p></div>
                        <span class="text-xs font-semibold {{ $tc }}">{{ $left }}</span>
                    </div>
                @endforeach
            </div>
        </x-ui.card>
    </div>

    <x-ui.card title="Active Projects" subtitle="Progress & team" class="mt-4" :padded="false">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead><tr class="border-b border-border text-xs uppercase tracking-wide text-muted-foreground">
                    <th class="px-5 py-3 text-start font-semibold">Project</th><th class="px-5 py-3 text-start font-semibold">Team</th>
                    <th class="px-5 py-3 text-start font-semibold">Progress</th><th class="px-5 py-3 text-start font-semibold">Deadline</th><th class="px-5 py-3 text-start font-semibold">Status</th>
                </tr></thead>
                <tbody class="divide-y divide-border">
                    @foreach ([['Mobile App Redesign',['Aisha Rahman','David Chen','Sofia Martinez'],78,'Apr 30','On track','success'],['Payment Gateway',['Omar Haddad','Priya Sharma'],45,'May 12','At risk','warning'],['Data Migration',['Kenji Tanaka','Layla Farouk','Marcus Johnson'],92,'Apr 22','On track','success'],['Onboarding Flow',['Emily Watson'],23,'Jun 01','Delayed','destructive']] as [$name,$team,$prog,$deadline,$st,$tone])
                        <tr class="hover:bg-muted/40">
                            <td class="px-5 py-3 font-medium">{{ $name }}</td>
                            <td class="px-5 py-3"><div class="flex -space-x-2 rtl:space-x-reverse">@foreach($team as $m)<x-ui.avatar :name="$m" size="xs" class="ring-2 ring-card" />@endforeach</div></td>
                            <td class="px-5 py-3"><div class="flex items-center gap-2"><div class="h-1.5 w-24 overflow-hidden rounded-full bg-muted"><div class="h-full rounded-full bg-primary" style="width:{{ $prog }}%"></div></div><span class="text-xs text-muted-foreground">{{ $prog }}%</span></div></td>
                            <td class="px-5 py-3 text-muted-foreground">{{ $deadline }}</td>
                            <td class="px-5 py-3"><x-ui.badge :variant="$tone">{{ $st }}</x-ui.badge></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </x-ui.card>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const t = window.akChartTheme();
            new Chart(projTasks, { type:'line', data:{ labels:['W1','W2','W3','W4','W5','W6','W7','W8'], datasets:[
                { label:'Completed', data:[42,58,50,72,68,88,80,102], borderColor:t.c2, backgroundColor:'transparent', tension:.4, pointRadius:0, borderWidth:2.5 },
                { label:'Created', data:[60,72,64,86,80,98,92,110], borderColor:t.c4, borderDash:[5,5], backgroundColor:'transparent', tension:.4, pointRadius:0, borderWidth:2 },
            ]}, options:{ responsive:true, maintainAspectRatio:false, plugins:{legend:{labels:{color:t.text,usePointStyle:true,boxWidth:8}}}, scales:{ x:{grid:{display:false},ticks:{color:t.text}}, y:{grid:{color:t.grid},ticks:{color:t.text}} } } });
        });
    </script>
    @endpush
</x-layouts.app>
