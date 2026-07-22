<div>
    <x-page-header :title="$pageTitle" :subtitle="$subtitle">
        <x-slot:actions>
            <x-ui.button variant="outline" icon="filter">Departments</x-ui.button>
            <x-ui.button icon="plus" @click="window.toast('Post a new job', {variant:'info'})">Post job</x-ui.button>
        </x-slot:actions>
    </x-page-header>

    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
        <x-ui.stat label="Open Positions" value="34" icon="briefcase" tone="primary" trend="+6" />
        <x-ui.stat label="Total Applicants" value="1,286" icon="users" tone="info" trend="+128" />
        <x-ui.stat label="Interviews" value="72" icon="calendar-check" tone="warning" trend="+11" />
        <x-ui.stat label="Hires (MTD)" value="18" icon="user-check" tone="success" trend="+4" />
    </div>

    <div class="mt-4 grid grid-cols-1 gap-4 lg:grid-cols-3">
        <x-ui.card title="Applications" subtitle="Weekly volume" class="lg:col-span-2">
            <div class="h-72"><canvas id="jobsApps"></canvas></div>
        </x-ui.card>

        <x-ui.card title="Hiring Pipeline" subtitle="Candidates by stage">
            <div class="space-y-3">
                @foreach ([['Applied','1,286','list','bg-chart-1/15'],['Screening','642','filter','bg-chart-2/15'],['Interview','214','messages-square','bg-chart-3/15'],['Offer','46','file-check','bg-chart-4/15'],['Hired','18','party-popper','bg-chart-5/15']] as [$stage,$n,$ico,$c])
                    <div class="flex items-center gap-3 rounded-lg border border-border p-3">
                        <span class="grid size-9 place-items-center rounded-lg {{ $c }} text-foreground"><i data-lucide="{{ $ico }}" class="size-4"></i></span>
                        <span class="flex-1 text-sm font-medium">{{ $stage }}</span>
                        <span class="text-lg font-bold">{{ $n }}</span>
                    </div>
                @endforeach
            </div>
        </x-ui.card>
    </div>

    <div class="mt-4 grid grid-cols-1 gap-4 lg:grid-cols-5">
        <x-ui.card title="Open Positions" subtitle="Actively hiring" class="lg:col-span-3" :padded="false">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead><tr class="border-b border-border text-xs uppercase tracking-wide text-muted-foreground">
                        <th class="px-5 py-3 text-start font-semibold">Role</th><th class="px-5 py-3 text-start font-semibold">Dept</th>
                        <th class="px-5 py-3 text-start font-semibold">Applicants</th><th class="px-5 py-3 text-start font-semibold">Type</th><th class="px-5 py-3 text-start font-semibold">Status</th>
                    </tr></thead>
                    <tbody class="divide-y divide-border">
                        @foreach ([['Senior Frontend Engineer','Engineering','86','Full-time','Open','success'],['Product Designer','Design','54','Full-time','Open','success'],['Data Analyst','Analytics','120','Contract','Screening','warning'],['DevOps Engineer','Engineering','38','Full-time','Open','success'],['Marketing Lead','Growth','67','Full-time','On hold','muted']] as [$role,$dept,$app,$type,$st,$tone])
                            <tr class="hover:bg-muted/40">
                                <td class="px-5 py-3 font-medium">{{ $role }}</td><td class="px-5 py-3 text-muted-foreground">{{ $dept }}</td>
                                <td class="px-5 py-3">{{ $app }}</td><td class="px-5 py-3"><x-ui.badge variant="outline">{{ $type }}</x-ui.badge></td>
                                <td class="px-5 py-3"><x-ui.badge :variant="$tone">{{ $st }}</x-ui.badge></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </x-ui.card>

        <x-ui.card title="Recent Applicants" subtitle="Latest submissions" class="lg:col-span-2">
            <div class="space-y-3">
                @foreach ([['Nadia Ali','Product Designer','online'],['Tom Wright','Data Analyst','away'],['Chen Wei','Frontend Engineer','online'],['Sara Kim','DevOps Engineer','busy'],['Leo Martins','Marketing Lead','offline']] as [$n,$role,$s])
                    <div class="flex items-center gap-3">
                        <x-ui.avatar :name="$n" size="sm" :status="$s" />
                        <div class="min-w-0 flex-1"><p class="truncate text-sm font-medium">{{ $n }}</p><p class="truncate text-xs text-muted-foreground">{{ $role }}</p></div>
                        <button class="rounded-lg p-1.5 text-muted-foreground hover:bg-accent hover:text-foreground"><i data-lucide="eye" class="size-4"></i></button>
                    </div>
                @endforeach
            </div>
        </x-ui.card>
    </div>

    @script
    <script>
        {
            const t = window.akChartTheme();
            new Chart(jobsApps, { type:'bar', data:{ labels:['W1','W2','W3','W4','W5','W6','W7','W8'], datasets:[
                { label:'Applications', data:[120,180,150,220,190,260,240,310], backgroundColor:t.c1, borderRadius:6, maxBarThickness:24 },
                { label:'Interviews', data:[20,28,24,34,30,42,38,52], backgroundColor:t.c3, borderRadius:6, maxBarThickness:24 },
            ]}, options:{ responsive:true, maintainAspectRatio:false, plugins:{legend:{labels:{color:t.text,usePointStyle:true,boxWidth:8}}}, scales:{ x:{grid:{display:false},ticks:{color:t.text}}, y:{grid:{color:t.grid},ticks:{color:t.text}} } } });
        }
    </script>
    @endscript
</div>
