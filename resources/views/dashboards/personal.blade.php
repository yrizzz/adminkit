<x-layouts.app :title="$pageTitle" :breadcrumbs="$breadcrumbs">
    <x-page-header title="Good morning, Aisha ☀️" :subtitle="'Tuesday, '.now()->format('F j').' · you have 5 tasks today'">
        <x-slot:actions>
            <x-ui.button variant="outline" icon="plus">Quick add</x-ui.button>
        </x-slot:actions>
    </x-page-header>

    <div class="grid grid-cols-1 gap-4 lg:grid-cols-3">
        {{-- Weather --}}
        <x-ui.card class="relative overflow-hidden bg-gradient-to-br from-sky-500 to-indigo-600 text-white">
            <div class="pointer-events-none absolute -end-6 -top-6 size-28 rounded-full bg-white/10 blur-2xl"></div>
            <div class="relative flex items-start justify-between">
                <div><p class="text-sm text-white/80">Jakarta, ID</p><p class="mt-1 text-5xl font-bold">29°</p><p class="mt-1 text-sm text-white/80">Partly cloudy · H:32° L:25°</p></div>
                <i data-lucide="cloud-sun" class="size-14 text-white/90"></i>
            </div>
            <div class="relative mt-5 flex justify-between text-center text-xs text-white/85">
                @foreach ([['Wed','sun','31°'],['Thu','cloud','28°'],['Fri','cloud-rain','26°'],['Sat','cloud-lightning','25°'],['Sun','sun','30°']] as [$d,$ic,$tmp])
                    <div><p>{{ $d }}</p><i data-lucide="{{ $ic }}" class="mx-auto my-1.5 size-5"></i><p class="font-semibold">{{ $tmp }}</p></div>
                @endforeach
            </div>
        </x-ui.card>

        {{-- Quick stats --}}
        <div class="grid grid-cols-2 gap-4">
            <x-ui.stat label="Balance" value="$8,240" icon="wallet" tone="success" trend="+2.4%" />
            <x-ui.stat label="Steps" value="7,820" icon="footprints" tone="primary" trend="78%" />
            <x-ui.stat label="Focus" value="4h 20m" icon="brain" tone="info" trend="+35m" />
            <x-ui.stat label="Water" value="6 / 8" icon="droplet" tone="warning" trend="75%" />
        </div>

        {{-- Today's agenda --}}
        <x-ui.card title="Today's Agenda" subtitle="4 events">
            <div class="space-y-3">
                @foreach ([['09:00','Standup meeting','bg-chart-1'],['11:30','Design review','bg-chart-2'],['14:00','1:1 with David','bg-chart-3'],['16:30','Gym session','bg-chart-5']] as [$time,$event,$c])
                    <div class="flex items-center gap-3">
                        <span class="w-12 shrink-0 text-xs font-semibold text-muted-foreground">{{ $time }}</span>
                        <span class="h-8 w-1 rounded-full {{ $c }}"></span>
                        <span class="text-sm font-medium">{{ $event }}</span>
                    </div>
                @endforeach
            </div>
        </x-ui.card>
    </div>

    <div class="mt-4 grid grid-cols-1 gap-4 lg:grid-cols-3">
        {{-- To-do --}}
        <x-ui.card title="To-Do List" subtitle="Stay on track" class="lg:col-span-2"
            x-data="{ todos: [
                { t:'Finish Q2 report', done:false, tag:'Work' },
                { t:'Reply to client emails', done:true, tag:'Work' },
                { t:'Book flight tickets', done:false, tag:'Personal' },
                { t:'Review pull requests', done:false, tag:'Work' },
                { t:'Call the dentist', done:true, tag:'Health' },
            ]}">
            <div class="space-y-1">
                <template x-for="(todo, i) in todos" :key="i">
                    <label class="flex cursor-pointer items-center gap-3 rounded-lg px-2 py-2.5 hover:bg-accent/40">
                        <input type="checkbox" x-model="todo.done" class="size-4 rounded border-input text-primary focus:ring-primary">
                        <span class="flex-1 text-sm font-medium" :class="todo.done && 'text-muted-foreground line-through'" x-text="todo.t"></span>
                        <span class="rounded-full bg-muted px-2 py-0.5 text-[0.65rem] font-semibold text-muted-foreground" x-text="todo.tag"></span>
                    </label>
                </template>
            </div>
            <div class="mt-3 border-t border-border pt-3 text-sm text-muted-foreground">
                <span x-text="todos.filter(t=>t.done).length"></span> of <span x-text="todos.length"></span> completed
            </div>
        </x-ui.card>

        {{-- Habit tracker --}}
        <x-ui.card title="Habits" subtitle="This week">
            <div class="space-y-4">
                @foreach ([['Meditate','💆'],['Read','📚'],['Exercise','🏃'],['No sugar','🍎']] as [$habit,$emo])
                    <div>
                        <div class="mb-1.5 flex items-center gap-2 text-sm"><span>{{ $emo }}</span><span class="font-medium">{{ $habit }}</span></div>
                        <div class="flex gap-1.5">
                            @foreach (['M','T','W','T','F','S','S'] as $i => $day)
                                @php($active = ($i + crc32($habit)) % 3 !== 0)
                                <span class="grid size-7 place-items-center rounded-md text-[0.65rem] font-semibold {{ $active ? 'bg-primary text-primary-foreground' : 'bg-muted text-muted-foreground' }}">{{ $day }}</span>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </x-ui.card>
    </div>

    <div class="mt-4 grid grid-cols-1 gap-4 lg:grid-cols-3">
        <x-ui.card title="Spending" subtitle="This month" class="lg:col-span-1">
            <div class="h-44"><canvas id="perSpend"></canvas></div>
        </x-ui.card>
        <x-ui.card title="Goals" subtitle="Progress toward targets" class="lg:col-span-2">
            <div class="grid grid-cols-1 gap-4 lg:grid-cols-3">
                @foreach ([['Emergency fund','$8.2K / $12K','68','bg-success'],['New laptop','$1.4K / $2K','70','bg-primary'],['Vacation','$900 / $3K','30','bg-[hsl(var(--warning))]']] as [$goal,$val,$pct,$c])
                    <div class="rounded-xl border border-border p-4">
                        <p class="text-sm font-medium">{{ $goal }}</p>
                        <p class="mt-0.5 text-xs text-muted-foreground">{{ $val }}</p>
                        <div class="mt-3 h-2 w-full overflow-hidden rounded-full bg-muted"><div class="h-full rounded-full {{ $c }}" style="width:{{ $pct }}%"></div></div>
                    </div>
                @endforeach
            </div>
        </x-ui.card>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const t = window.akChartTheme();
            new Chart(perSpend, { type:'doughnut', data:{ labels:['Housing','Food','Transport','Fun','Other'], datasets:[{ data:[40,22,14,15,9], backgroundColor:[t.c1,t.c2,t.c3,t.c4,t.c5], borderWidth:0 }]},
                options:{ responsive:true, maintainAspectRatio:false, cutout:'62%', plugins:{legend:{position:'right',labels:{color:t.text,usePointStyle:true,boxWidth:8,font:{size:10}}}} } });
        });
    </script>
    @endpush
</x-layouts.app>
