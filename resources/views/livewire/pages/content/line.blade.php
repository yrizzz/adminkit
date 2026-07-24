<div>
    <x-page-header :title="'Line Charts'" subtitle="Charts · trends over time">
        <x-slot:actions><x-ui.button variant="outline" icon="arrow-left" class="[&>svg]:rtl-flip" :href="route('charts')">All charts</x-ui.button></x-slot:actions>
    </x-page-header>
    <div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
        <x-ui.card title="Basic"><div class="h-64"><canvas id="ln1"></canvas></div></x-ui.card>
        <x-ui.card title="Multi-series"><div class="h-64"><canvas id="ln2"></canvas></div></x-ui.card>
        <x-ui.card title="Smooth vs stepped"><div class="h-64"><canvas id="ln3"></canvas></div></x-ui.card>
        <x-ui.card title="Dashed with points"><div class="h-64"><canvas id="ln4"></canvas></div></x-ui.card>
    </div>
    @script
    <script>{
        const t = window.akChartTheme();
        const L = ['Mon','Tue','Wed','Thu','Fri','Sat','Sun'];
        const grid = { x:{grid:{display:false},ticks:{color:t.text}}, y:{grid:{color:t.grid},ticks:{color:t.text}} };
        const base = { responsive:true, maintainAspectRatio:false, plugins:{legend:{labels:{color:t.text,usePointStyle:true,boxWidth:8}}}, scales:grid };
        new Chart(ln1,{type:'line',data:{labels:L,datasets:[{label:'Sales',data:[12,19,13,25,22,30,28],borderColor:t.c1,tension:.4,borderWidth:2.5,pointRadius:0}]},options:{...base,plugins:{legend:{display:false}}}});
        new Chart(ln2,{type:'line',data:{labels:L,datasets:[{label:'Revenue',data:[30,25,35,28,40,38,48],borderColor:t.c1,tension:.4,borderWidth:2.5,pointRadius:0},{label:'Costs',data:[20,18,22,19,25,23,28],borderColor:t.c4,tension:.4,borderWidth:2.5,pointRadius:0}]},options:base});
        new Chart(ln3,{type:'line',data:{labels:L,datasets:[{label:'Smooth',data:[10,18,12,22,17,26,21],borderColor:t.c1,tension:.4,borderWidth:2.5,pointRadius:0},{label:'Stepped',data:[8,8,14,14,20,20,24],borderColor:t.c3,stepped:true,borderWidth:2,pointRadius:0}]},options:base});
        new Chart(ln4,{type:'line',data:{labels:L,datasets:[{label:'Target',data:[15,15,15,15,15,15,15],borderColor:t.c5,borderDash:[6,6],borderWidth:2,pointRadius:0},{label:'Actual',data:[9,14,11,18,16,24,20],borderColor:t.c1,borderWidth:2.5,pointRadius:4,pointBackgroundColor:t.c1,tension:.35}]},options:base});
    }</script>
    @endscript
</div>
