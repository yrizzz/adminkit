<div>
    <x-page-header :title="'Area Charts'" subtitle="Charts · filled trends & volume">
        <x-slot:actions><x-ui.button variant="outline" icon="arrow-left" class="[&>svg]:rtl-flip" :href="route('charts')">All charts</x-ui.button></x-slot:actions>
    </x-page-header>
    <div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
        <x-ui.card title="Gradient area" class="lg:col-span-2"><div class="h-64"><canvas id="ar1"></canvas></div></x-ui.card>
        <x-ui.card title="Stacked area"><div class="h-64"><canvas id="ar2"></canvas></div></x-ui.card>
        <x-ui.card title="Two-tone"><div class="h-64"><canvas id="ar3"></canvas></div></x-ui.card>
    </div>
    @script
    <script>{
        const t = window.akChartTheme();
        const M = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
        const grid = { x:{grid:{display:false},ticks:{color:t.text}}, y:{grid:{color:t.grid},ticks:{color:t.text}} };
        const base = { responsive:true, maintainAspectRatio:false, plugins:{legend:{labels:{color:t.text,usePointStyle:true,boxWidth:8}}}, scales:grid };
        const grad = (cv, color) => { const g = cv.getContext('2d').createLinearGradient(0,0,0,256); g.addColorStop(0,'hsla'+color.slice(3,-1)+' / .35)'); g.addColorStop(1,'hsla'+color.slice(3,-1)+' / 0)'); return g; };
        new Chart(ar1,{type:'line',data:{labels:M,datasets:[{label:'Revenue',data:[12,19,15,25,22,30,28,35,32,40,38,48],borderColor:t.c1,backgroundColor:grad(ar1,t.c1),fill:true,tension:.4,borderWidth:2.5,pointRadius:0}]},options:{...base,plugins:{legend:{display:false}}}});
        new Chart(ar2,{type:'line',data:{labels:M.slice(0,7),datasets:[{label:'Direct',data:[10,14,12,18,16,22,20],borderColor:t.c1,backgroundColor:'hsla'+t.c1.slice(3,-1)+' / .3)',fill:true,tension:.4,pointRadius:0,borderWidth:2},{label:'Organic',data:[6,9,8,12,11,15,14],borderColor:t.c2,backgroundColor:'hsla'+t.c2.slice(3,-1)+' / .3)',fill:true,tension:.4,pointRadius:0,borderWidth:2}]},options:{...base,scales:{...grid,y:{...grid.y,stacked:true}}}});
        new Chart(ar3,{type:'line',data:{labels:M.slice(0,7),datasets:[{label:'This week',data:[18,22,19,26,24,30,28],borderColor:t.c1,backgroundColor:grad(ar3,t.c1),fill:true,tension:.4,pointRadius:0,borderWidth:2.5},{label:'Last week',data:[14,16,15,19,18,22,20],borderColor:t.c4,backgroundColor:grad(ar3,t.c4),fill:true,tension:.4,pointRadius:0,borderWidth:2.5}]},options:base});
    }</script>
    @endscript
</div>
