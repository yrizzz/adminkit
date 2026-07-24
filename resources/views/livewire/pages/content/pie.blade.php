<div>
    <x-page-header :title="'Pie & Doughnut'" subtitle="Charts · proportions of a whole">
        <x-slot:actions><x-ui.button variant="outline" icon="arrow-left" class="[&>svg]:rtl-flip" :href="route('charts')">All charts</x-ui.button></x-slot:actions>
    </x-page-header>
    <div class="grid grid-cols-1 gap-4 lg:grid-cols-3">
        <x-ui.card title="Pie"><div class="mx-auto h-56 max-w-56"><canvas id="pi1"></canvas></div></x-ui.card>
        <x-ui.card title="Doughnut"><div class="mx-auto h-56 max-w-56"><canvas id="pi2"></canvas></div></x-ui.card>
        <x-ui.card title="Half doughnut"><div class="mx-auto h-56 max-w-56"><canvas id="pi3"></canvas></div></x-ui.card>
    </div>
    <x-ui.card title="Doughnut with legend" class="mt-4">
        <div class="grid grid-cols-1 items-center gap-6 sm:grid-cols-[220px_1fr]">
            <div class="mx-auto h-52 max-w-52"><canvas id="pi4"></canvas></div>
            <div class="space-y-2">
                @foreach ([['Organic','42%','bg-primary'],['Direct','28%','bg-success'],['Referral','18%','bg-[hsl(var(--warning))]'],['Social','12%','bg-fuchsia-500']] as [$l,$v,$b])
                    <div class="flex items-center gap-2.5 text-sm"><span class="size-2.5 rounded-full {{ $b }}"></span><span class="flex-1">{{ $l }}</span><span class="font-semibold">{{ $v }}</span></div>
                @endforeach
            </div>
        </div>
    </x-ui.card>
    @script
    <script>{
        const t = window.akChartTheme();
        const base = { responsive:true, maintainAspectRatio:false, plugins:{legend:{display:false}} };
        const legendBase = { responsive:true, maintainAspectRatio:false, plugins:{legend:{position:'bottom',labels:{color:t.text,usePointStyle:true,boxWidth:8,padding:12}}} };
        new Chart(pi1,{type:'pie',data:{labels:['A','B','C','D'],datasets:[{data:[30,25,25,20],backgroundColor:[t.c1,t.c2,t.c3,t.c4],borderWidth:0}]},options:legendBase});
        new Chart(pi2,{type:'doughnut',data:{labels:['A','B','C','D'],datasets:[{data:[40,30,20,10],backgroundColor:[t.c1,t.c2,t.c3,t.c5],borderWidth:0}]},options:{...legendBase,cutout:'65%'}});
        new Chart(pi3,{type:'doughnut',data:{labels:['Used','Free'],datasets:[{data:[68,32],backgroundColor:[t.c1,t.grid],borderWidth:0}]},options:{...base,rotation:-90,circumference:180,cutout:'70%'}});
        new Chart(pi4,{type:'doughnut',data:{labels:['Organic','Direct','Referral','Social'],datasets:[{data:[42,28,18,12],backgroundColor:[t.c1,t.c2,t.c3,t.c4],borderWidth:0,hoverOffset:6}]},options:{...base,cutout:'68%'}});
    }</script>
    @endscript
</div>
