<x-layouts.app :title="$pageTitle" :breadcrumbs="$breadcrumbs">
    <x-page-header :title="$pageTitle" :subtitle="$subtitle">
        <x-slot:actions>
            <x-ui.button variant="outline" icon="wallet">0x7a…4f9</x-ui.button>
            <x-ui.button icon="sparkles" @click="window.toast('Create NFT', {variant:'info'})">Create</x-ui.button>
        </x-slot:actions>
    </x-page-header>

    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
        <x-ui.stat label="Total Volume" value="842 ETH" icon="chart-candlestick" tone="primary" trend="+22.4%" />
        <x-ui.stat label="Floor Price" value="1.84 ETH" icon="triangle" tone="info" trend="+8.1%" />
        <x-ui.stat label="Owners" value="6,204" icon="users" tone="success" trend="+312" />
        <x-ui.stat label="Listed" value="1,428" icon="tag" tone="warning" trend="-64" :trend-up="false" />
    </div>

    <div class="mt-4 grid grid-cols-1 gap-4 lg:grid-cols-3">
        <x-ui.card title="Trading Volume" subtitle="30-day volume in ETH" class="lg:col-span-2">
            <div class="h-72"><canvas id="nftVol"></canvas></div>
        </x-ui.card>

        <x-ui.card title="Live Auctions" subtitle="Ending soon">
            <div class="space-y-3">
                @foreach ([['Cosmic Ape #482','2.4 ETH','01:24:08','from-violet-500 to-fuchsia-500'],['Neon Punk #119','1.8 ETH','03:52:41','from-cyan-500 to-blue-500'],['Pixel Cat #77','0.9 ETH','06:10:22','from-amber-500 to-orange-500'],['Meta Bot #305','3.1 ETH','12:05:59','from-emerald-500 to-teal-500']] as [$name,$bid,$time,$grad])
                    <div class="flex items-center gap-3">
                        <span class="size-11 shrink-0 rounded-xl bg-gradient-to-br {{ $grad }}"></span>
                        <div class="min-w-0 flex-1"><p class="truncate text-sm font-medium">{{ $name }}</p><p class="text-xs text-muted-foreground">Current bid · {{ $bid }}</p></div>
                        <span class="rounded-md bg-muted px-2 py-1 font-mono text-xs font-semibold">{{ $time }}</span>
                    </div>
                @endforeach
            </div>
        </x-ui.card>
    </div>

    {{-- NFT cards grid --}}
    <h3 class="mb-3 mt-6 text-sm font-semibold uppercase tracking-wide text-muted-foreground">Trending Items</h3>
    <div class="grid grid-cols-2 gap-4 md:grid-cols-3 xl:grid-cols-6">
        @foreach ([['Azuki #1204','4.2','from-rose-500 to-pink-500'],['Bored Ape #88','12.8','from-amber-400 to-yellow-500'],['Doodle #542','2.1','from-sky-400 to-indigo-500'],['Clone X #77','3.6','from-fuchsia-500 to-purple-600'],['Moonbird #310','5.9','from-emerald-400 to-cyan-500'],['Meebit #920','1.4','from-orange-400 to-red-500']] as [$name,$price,$grad])
            <div class="ak-card overflow-hidden transition-all hover:-translate-y-1 hover:shadow-lg">
                <div class="relative aspect-square bg-gradient-to-br {{ $grad }}">
                    <span class="absolute end-2 top-2 rounded-full bg-black/30 px-2 py-0.5 text-[0.65rem] font-bold text-white backdrop-blur">#{{ $loop->iteration }}</span>
                </div>
                <div class="p-3">
                    <p class="truncate text-sm font-semibold">{{ $name }}</p>
                    <div class="mt-1 flex items-center justify-between">
                        <span class="text-xs text-muted-foreground">Price</span>
                        <span class="inline-flex items-center gap-1 text-sm font-bold"><i data-lucide="gem" class="size-3.5 text-primary"></i>{{ $price }}</span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const t = window.akChartTheme();
            const ctx = nftVol.getContext('2d'); const g = ctx.createLinearGradient(0,0,0,288);
            g.addColorStop(0,'hsla'+t.c4.slice(3,-1)+' / .35)'); g.addColorStop(1,'hsla'+t.c4.slice(3,-1)+' / 0)');
            const d=[]; for(let i=0;i<30;i++){ d.push(15 + Math.round(Math.abs(Math.sin(i/2)*20) + Math.random()*10)); }
            new Chart(nftVol, { type:'bar', data:{ labels:d.map((_,i)=>i+1), datasets:[{ label:'Volume (ETH)', data:d, backgroundColor:g, borderColor:t.c4, borderWidth:1.5, borderRadius:4, maxBarThickness:14 }]},
                options:{ responsive:true, maintainAspectRatio:false, plugins:{legend:{display:false}}, scales:{ x:{grid:{display:false},ticks:{color:t.text,maxTicksLimit:8}}, y:{grid:{color:t.grid},ticks:{color:t.text}} } } });
        });
    </script>
    @endpush
</x-layouts.app>
