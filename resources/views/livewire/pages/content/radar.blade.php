<div>
    <x-page-header :title="'Radar & Polar'" subtitle="Charts · multi-axis comparisons">
        <x-slot:actions><x-ui.button variant="outline" icon="arrow-left" class="[&>svg]:rtl-flip" :href="route('charts')">All charts</x-ui.button></x-slot:actions>
    </x-page-header>
    <div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
        <x-ui.card title="Radar — single"><div class="mx-auto h-72 max-w-md"><canvas id="rd1"></canvas></div></x-ui.card>
        <x-ui.card title="Radar — comparison"><div class="mx-auto h-72 max-w-md"><canvas id="rd2"></canvas></div></x-ui.card>
        <x-ui.card title="Polar area"><div class="mx-auto h-72 max-w-sm"><canvas id="rd3"></canvas></div></x-ui.card>
        <x-ui.card title="Skills profile"><div class="mx-auto h-72 max-w-md"><canvas id="rd4"></canvas></div></x-ui.card>
    </div>
    @script
    <script>{
        const t = window.akChartTheme();
        const rOpts = { responsive:true, maintainAspectRatio:false, plugins:{legend:{labels:{color:t.text,usePointStyle:true,boxWidth:8}}}, scales:{ r:{ grid:{color:t.grid}, angleLines:{color:t.grid}, pointLabels:{color:t.text}, ticks:{display:false} } } };
        const A = ['Speed','Quality','Cost','Support','UX','Docs'];
        new Chart(rd1,{type:'radar',data:{labels:A,datasets:[{label:'Product A',data:[80,90,70,85,95,75],borderColor:t.c1,backgroundColor:'hsla'+t.c1.slice(3,-1)+' / .2)',borderWidth:2,pointBackgroundColor:t.c1}]},options:{...rOpts,plugins:{legend:{display:false}}}});
        new Chart(rd2,{type:'radar',data:{labels:A,datasets:[{label:'Product A',data:[80,90,70,85,95,75],borderColor:t.c1,backgroundColor:'hsla'+t.c1.slice(3,-1)+' / .2)',borderWidth:2},{label:'Product B',data:[70,75,85,65,80,90],borderColor:t.c4,backgroundColor:'hsla'+t.c4.slice(3,-1)+' / .2)',borderWidth:2}]},options:rOpts});
        new Chart(rd3,{type:'polarArea',data:{labels:['Design','Dev','Marketing','Sales','Support'],datasets:[{data:[11,16,7,14,9],backgroundColor:[t.c1,t.c2,t.c3,t.c4,t.c5]}]},options:{responsive:true,maintainAspectRatio:false,plugins:{legend:{position:'bottom',labels:{color:t.text,usePointStyle:true,boxWidth:8,padding:12}}},scales:{r:{grid:{color:t.grid},ticks:{display:false}}}}});
        new Chart(rd4,{type:'radar',data:{labels:['HTML','CSS','JS','PHP','SQL','DevOps'],datasets:[{label:'Yrizzz',data:[95,92,88,80,72,65],borderColor:t.c2,backgroundColor:'hsla'+t.c2.slice(3,-1)+' / .2)',borderWidth:2,pointBackgroundColor:t.c2}]},options:{...rOpts,plugins:{legend:{display:false}}}});
    }</script>
    @endscript
</div>
