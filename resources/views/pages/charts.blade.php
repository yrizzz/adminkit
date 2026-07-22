<x-layouts.app title="Charts" :breadcrumbs="[['label' => 'Maps & Charts'], ['label' => 'Charts']]">
    <x-page-header title="Charts" subtitle="Beautiful, theme-aware charts powered by Chart.js." />

    <div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
        <x-ui.card title="Line Chart"><div class="h-64"><canvas id="c_line"></canvas></div></x-ui.card>
        <x-ui.card title="Bar Chart"><div class="h-64"><canvas id="c_bar"></canvas></div></x-ui.card>
        <x-ui.card title="Area Chart"><div class="h-64"><canvas id="c_area"></canvas></div></x-ui.card>
        <x-ui.card title="Radar Chart"><div class="h-64"><canvas id="c_radar"></canvas></div></x-ui.card>
        <x-ui.card title="Pie Chart"><div class="mx-auto h-64 max-w-64"><canvas id="c_pie"></canvas></div></x-ui.card>
        <x-ui.card title="Doughnut Chart"><div class="mx-auto h-64 max-w-64"><canvas id="c_dough"></canvas></div></x-ui.card>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const t = window.akChartTheme();
            const base = { responsive: true, maintainAspectRatio: false, plugins: { legend: { labels: { color: t.text, usePointStyle: true, boxWidth: 8 } } } };
            const grid = { x: { grid: { display: false }, ticks: { color: t.text } }, y: { grid: { color: t.grid }, ticks: { color: t.text } } };
            const L = ['Mon','Tue','Wed','Thu','Fri','Sat','Sun'];

            new Chart(c_line, { type: 'line', data: { labels: L, datasets: [
                { label: 'Sales', data: [12,19,13,25,22,30,28], borderColor: t.c1, tension: .4, borderWidth: 2.5, pointRadius: 0 },
                { label: 'Visits', data: [8,14,10,18,15,22,20], borderColor: t.c2, tension: .4, borderWidth: 2.5, pointRadius: 0 },
            ]}, options: { ...base, scales: grid } });

            new Chart(c_bar, { type: 'bar', data: { labels: L, datasets: [
                { label: 'This week', data: [12,19,13,25,22,30,28], backgroundColor: t.c1, borderRadius: 6, maxBarThickness: 22 },
                { label: 'Last week', data: [8,14,10,18,15,22,20], backgroundColor: t.grid, borderRadius: 6, maxBarThickness: 22 },
            ]}, options: { ...base, scales: grid } });

            const ctx = c_area.getContext('2d');
            const g = ctx.createLinearGradient(0,0,0,256); g.addColorStop(0, 'hsla' + t.c2.slice(3,-1) + ' / .35)'); g.addColorStop(1, 'hsla' + t.c2.slice(3,-1) + ' / 0)');
            new Chart(c_area, { type: 'line', data: { labels: L, datasets: [{ label: 'Revenue', data: [30,25,35,28,40,38,48], borderColor: t.c2, backgroundColor: g, fill: true, tension: .4, borderWidth: 2.5, pointRadius: 0 }]}, options: { ...base, scales: grid } });

            new Chart(c_radar, { type: 'radar', data: { labels: ['Speed','Quality','Cost','Support','UX','Docs'], datasets: [
                { label: 'Product A', data: [80,90,70,85,95,75], borderColor: t.c1, backgroundColor: 'hsla' + t.c1.slice(3,-1) + ' / .2)', borderWidth: 2 },
                { label: 'Product B', data: [70,75,85,65,80,90], borderColor: t.c4, backgroundColor: 'hsla' + t.c4.slice(3,-1) + ' / .2)', borderWidth: 2 },
            ]}, options: { ...base, scales: { r: { grid: { color: t.grid }, angleLines: { color: t.grid }, pointLabels: { color: t.text }, ticks: { display: false } } } } });

            new Chart(c_pie, { type: 'pie', data: { labels: ['A','B','C','D'], datasets: [{ data: [30,25,25,20], backgroundColor: [t.c1,t.c2,t.c3,t.c4], borderWidth: 0 }]}, options: { ...base } });
            new Chart(c_dough, { type: 'doughnut', data: { labels: ['A','B','C','D'], datasets: [{ data: [40,30,20,10], backgroundColor: [t.c1,t.c2,t.c3,t.c5], borderWidth: 0 }]}, options: { ...base, cutout: '65%' } });
        });
    </script>
    @endpush
</x-layouts.app>
