<div>
    <x-page-header :title="'Bar Charts'" subtitle="Charts · comparisons & distributions">
        <x-slot:actions><x-ui.button variant="outline" icon="arrow-left" class="[&>svg]:rtl-flip" :href="route('charts')">All charts</x-ui.button></x-slot:actions>
    </x-page-header>
    <div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
        <x-ui.card title="Vertical"><div class="h-64"><canvas id="br1"></canvas></div></x-ui.card>
        <x-ui.card title="Grouped"><div class="h-64"><canvas id="br2"></canvas></div></x-ui.card>
        <x-ui.card title="Horizontal"><div class="h-64"><canvas id="br3"></canvas></div></x-ui.card>
        <x-ui.card title="Stacked"><div class="h-64"><canvas id="br4"></canvas></div></x-ui.card>
    </div>
    @script
    <script>{
        const t = window.akChartTheme();
        const L = ['Mon','Tue','Wed','Thu','Fri','Sat','Sun'];
        const grid = { x:{grid:{display:false},ticks:{color:t.text}}, y:{grid:{color:t.grid},ticks:{color:t.text}} };
        const base = { responsive:true, maintainAspectRatio:false, plugins:{legend:{labels:{color:t.text,usePointStyle:true,boxWidth:8}}}, scales:grid };
        new Chart(br1,{type:'bar',data:{labels:L,datasets:[{label:'Orders',data:[12,19,13,25,22,30,28],backgroundColor:t.c1,borderRadius:6,maxBarThickness:26}]},options:{...base,plugins:{legend:{display:false}}}});
        new Chart(br2,{type:'bar',data:{labels:L,datasets:[{label:'This week',data:[12,19,13,25,22,30,28],backgroundColor:t.c1,borderRadius:6,maxBarThickness:14},{label:'Last week',data:[8,14,10,18,15,22,20],backgroundColor:t.grid,borderRadius:6,maxBarThickness:14}]},options:base});
        new Chart(br3,{type:'bar',data:{labels:['New','Contacted','Proposal','Negotiation','Won'],datasets:[{label:'Value ($k)',data:[96,74,120,88,186],backgroundColor:[t.c1,t.c2,t.c3,t.c4,t.c5],borderRadius:6,maxBarThickness:26}]},options:{...base,indexAxis:'y',plugins:{legend:{display:false}}}});
        new Chart(br4,{type:'bar',data:{labels:L,datasets:[{label:'Desktop',data:[12,19,13,25,22,30,28],backgroundColor:t.c1,borderRadius:{topLeft:0,topRight:0},maxBarThickness:26},{label:'Mobile',data:[8,12,9,15,13,18,16],backgroundColor:t.c2,borderRadius:6,maxBarThickness:26}]},options:{...base,scales:{x:{...grid.x,stacked:true},y:{...grid.y,stacked:true}}}});
    }</script>
    @endscript
</div>
