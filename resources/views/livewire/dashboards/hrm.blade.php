<div>
    <x-page-header :title="$pageTitle" :subtitle="$subtitle">
        <x-slot:actions>
            <x-ui.button variant="outline" icon="calendar-days">Attendance</x-ui.button>
            <x-ui.button icon="user-plus" @click="window.toast('Add employee', {variant:'info'})">Add employee</x-ui.button>
        </x-slot:actions>
    </x-page-header>

    <div class="grid grid-cols-2 gap-4 lg:grid-cols-4">
        <x-ui.stat label="Employees" value="248" icon="users" tone="primary" trend="+12" />
        <x-ui.stat label="Present Today" value="214" icon="user-check" tone="success" trend="86%" />
        <x-ui.stat label="On Leave" value="18" icon="palmtree" tone="warning" trend="+3" />
        <x-ui.stat label="New Hires (MTD)" value="9" icon="sparkles" tone="info" trend="+4" />
    </div>

    {{-- Attendance ring + breakdown + dept chart --}}
    <div class="mt-4 grid grid-cols-1 gap-4 lg:grid-cols-3">
        <x-ui.card title="Attendance Today" subtitle="Live status">
            <div class="flex flex-col items-center">
                <x-ui.gauge :value="86" tone="success" sub="214 / 248" label="Present rate" :size="140" />
                <div class="mt-4 grid w-full grid-cols-2 gap-2.5">
                    @foreach ([['Present','214','text-success','bg-success/10'],['Absent','16','text-destructive','bg-destructive/10'],['Late','12','text-[hsl(var(--warning))]','bg-warning/10'],['Leave','18','text-info','bg-info/10']] as [$l,$n,$tc,$bg])
                        <div class="flex items-center gap-2 rounded-lg {{ $bg }} p-2.5"><span class="{{ $tc }} text-lg font-bold">{{ $n }}</span><span class="text-xs font-medium text-muted-foreground">{{ $l }}</span></div>
                    @endforeach
                </div>
            </div>
        </x-ui.card>

        <x-ui.card title="Headcount by Department" subtitle="Distribution" class="lg:col-span-2">
            <div class="h-64"><canvas id="hrmDept"></canvas></div>
        </x-ui.card>
    </div>

    <div class="mt-4 grid grid-cols-1 gap-4 lg:grid-cols-3">
        <x-ui.card title="Employee Directory" subtitle="Recently active" class="lg:col-span-2" :padded="false">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead><tr class="border-b border-border text-xs uppercase tracking-wide text-muted-foreground">
                        <th class="px-5 py-3 text-start font-semibold">Employee</th><th class="px-5 py-3 text-start font-semibold">Department</th>
                        <th class="px-5 py-3 text-start font-semibold">Role</th><th class="px-5 py-3 text-start font-semibold">Status</th>
                    </tr></thead>
                    <tbody class="divide-y divide-border">
                        @foreach ([['Aisha Rahman','Engineering','Team Lead','Present','success'],['David Chen','Design','Sr. Designer','Present','success'],['Sofia Martinez','Marketing','Manager','Leave','info'],['Omar Haddad','Sales','Executive','Late','warning'],['Priya Sharma','Finance','Analyst','Present','success'],['Kenji Tanaka','Engineering','Backend Dev','Absent','destructive']] as [$n,$dept,$role,$st,$tone])
                            <tr class="hover:bg-muted/40">
                                <td class="px-5 py-3"><div class="flex items-center gap-2.5"><x-ui.avatar :name="$n" size="xs" /><span class="font-medium">{{ $n }}</span></div></td>
                                <td class="px-5 py-3 text-muted-foreground">{{ $dept }}</td><td class="px-5 py-3">{{ $role }}</td>
                                <td class="px-5 py-3"><x-ui.badge :variant="$tone">{{ $st }}</x-ui.badge></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </x-ui.card>

        <div class="space-y-4">
            <x-ui.card title="Leave Requests">
                <div class="space-y-3">
                    @foreach ([['Sofia Martinez','Annual · 3 days','pending'],['Marcus Johnson','Sick · 1 day','approved'],['Layla Farouk','Annual · 5 days','pending']] as [$n,$detail,$st])
                        <div class="flex items-center gap-3">
                            <x-ui.avatar :name="$n" size="sm" />
                            <div class="min-w-0 flex-1"><p class="truncate text-sm font-medium">{{ $n }}</p><p class="text-xs text-muted-foreground">{{ $detail }}</p></div>
                            <x-ui.badge :variant="$st === 'approved' ? 'success' : 'warning'">{{ ucfirst($st) }}</x-ui.badge>
                        </div>
                    @endforeach
                </div>
            </x-ui.card>
            <x-ui.card title="Upcoming Birthdays">
                <div class="space-y-2.5">
                    @foreach ([['Emily Watson','Apr 24','🎂'],['Kenji Tanaka','Apr 29','🎉'],['Priya Sharma','May 02','🎈']] as [$n,$date,$emo])
                        <div class="flex items-center gap-3 text-sm"><span class="text-lg">{{ $emo }}</span><span class="flex-1 font-medium">{{ $n }}</span><span class="text-muted-foreground">{{ $date }}</span></div>
                    @endforeach
                </div>
            </x-ui.card>
        </div>
    </div>

    @script
    <script>
        {
            const t = window.akChartTheme();
            const el = document.getElementById('hrmDept');
            if (el) new Chart(el, { type:'bar', data:{ labels:['Engineering','Sales','Design','Marketing','Finance','Support','HR'], datasets:[{ label:'Employees', data:[82,48,34,28,22,20,14], backgroundColor:t.c1, borderRadius:6, maxBarThickness:34 }]},
                options:{ responsive:true, maintainAspectRatio:false, plugins:{legend:{display:false}}, scales:{ x:{grid:{display:false},ticks:{color:t.text}}, y:{grid:{color:t.grid},ticks:{color:t.text}} } } });
        }
    </script>
    @endscript
</div>
