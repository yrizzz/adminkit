<x-layouts.app :title="$pageTitle" :breadcrumbs="$breadcrumbs">
    <x-page-header :title="$pageTitle" :subtitle="$subtitle">
        <x-slot:actions>
            <x-ui.button variant="outline" icon="arrow-left-right">Swap</x-ui.button>
            <x-ui.button variant="success" icon="plus" @click="window.toast('Deposit', {variant:'success'})">Deposit</x-ui.button>
        </x-slot:actions>
    </x-page-header>

    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
        <x-ui.stat label="Portfolio Value" value="$68,204" icon="wallet" tone="primary" trend="+5.8%" />
        <x-ui.stat label="24h Change" value="+$3,910" icon="trending-up" tone="success" trend="+6.1%" />
        <x-ui.stat label="Best Performer" value="SOL +18%" icon="rocket" tone="info" trend="+18%" />
        <x-ui.stat label="BTC Dominance" value="52.4%" icon="bitcoin" tone="warning" trend="-0.6%" :trend-up="false" />
    </div>

    <div class="mt-4 grid grid-cols-1 gap-4 lg:grid-cols-3">
        <x-ui.card title="Portfolio Performance" subtitle="Value over 30 days" class="lg:col-span-2">
            <x-slot:actions><x-ui.badge variant="success" dot>Live</x-ui.badge></x-slot:actions>
            <div class="h-72"><canvas id="cryptoPerf"></canvas></div>
        </x-ui.card>

        <x-ui.card title="Allocation" subtitle="By asset">
            <div class="mx-auto h-52 max-w-52"><canvas id="cryptoAlloc"></canvas></div>
            <div class="mt-4 space-y-2">
                @foreach ([['Bitcoin','48%','chart-1'],['Ethereum','29%','chart-2'],['Solana','14%','chart-3'],['Others','9%','chart-4']] as [$l,$v,$c])
                    <div class="flex items-center gap-2 text-sm"><span class="size-2.5 rounded-full" style="background:hsl(var(--{{ $c }}))"></span><span class="flex-1 text-muted-foreground">{{ $l }}</span><span class="font-semibold">{{ $v }}</span></div>
                @endforeach
            </div>
        </x-ui.card>
    </div>

    <div class="mt-4 grid grid-cols-1 gap-4 lg:grid-cols-3">
        <x-ui.card title="Market" subtitle="Top coins" class="lg:col-span-2" :padded="false">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead><tr class="border-b border-border text-xs uppercase tracking-wide text-muted-foreground">
                        <th class="px-5 py-3 text-start font-semibold">Coin</th><th class="px-5 py-3 text-end font-semibold">Price</th>
                        <th class="px-5 py-3 text-end font-semibold">24h</th><th class="px-5 py-3 text-end font-semibold">Market Cap</th><th class="px-5 py-3 text-end font-semibold">Holdings</th>
                    </tr></thead>
                    <tbody class="divide-y divide-border">
                        @foreach ([['BTC','Bitcoin','$67,412','+2.4%',1,'$1.32T','0.48'],['ETH','Ethereum','$3,540','+3.1%',1,'$425B','6.2'],['SOL','Solana','$182','+18.0%',1,'$84B','120'],['BNB','BNB','$598','-0.8%',0,'$88B','14'],['XRP','Ripple','$0.62','+1.2%',1,'$34B','8,400']] as [$sym,$name,$price,$chg,$up,$mc,$hold])
                            <tr class="hover:bg-muted/40">
                                <td class="px-5 py-3"><div class="flex items-center gap-2.5"><span class="grid size-8 place-items-center rounded-full bg-primary/10 text-xs font-bold text-primary">{{ $sym }}</span><div><p class="font-medium leading-tight">{{ $name }}</p><p class="text-xs text-muted-foreground">{{ $sym }}</p></div></div></td>
                                <td class="px-5 py-3 text-end font-semibold">{{ $price }}</td>
                                <td class="px-5 py-3 text-end font-semibold {{ $up ? 'text-success' : 'text-destructive' }}">{{ $chg }}</td>
                                <td class="px-5 py-3 text-end text-muted-foreground">{{ $mc }}</td>
                                <td class="px-5 py-3 text-end">{{ $hold }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </x-ui.card>

        <x-ui.card title="Quick Trade">
            <div x-data="{ side:'buy', amt: 500 }">
                <div class="grid grid-cols-2 gap-1 rounded-lg bg-muted p-1">
                    <button @click="side='buy'" :class="side==='buy' ? 'bg-success text-white' : 'text-muted-foreground'" class="rounded-md py-2 text-sm font-semibold transition-colors">Buy</button>
                    <button @click="side='sell'" :class="side==='sell' ? 'bg-destructive text-white' : 'text-muted-foreground'" class="rounded-md py-2 text-sm font-semibold transition-colors">Sell</button>
                </div>
                <div class="mt-4 space-y-3">
                    <div class="space-y-1.5"><label class="text-sm font-medium">Asset</label>
                        <select class="h-10 w-full rounded-lg border border-input bg-background px-3 text-sm"><option>Bitcoin (BTC)</option><option>Ethereum (ETH)</option><option>Solana (SOL)</option></select></div>
                    <div class="space-y-1.5"><label class="text-sm font-medium">Amount (USD)</label>
                        <input type="number" x-model="amt" class="h-10 w-full rounded-lg border border-input bg-background px-3 text-sm"></div>
                    <div class="rounded-lg bg-muted/50 p-3 text-sm"><div class="flex justify-between"><span class="text-muted-foreground">You receive</span><span class="font-semibold" x-text="(amt/67412).toFixed(6)+' BTC'"></span></div></div>
                    <button type="button" @click="window.toast(side==='buy'?'Order placed: Buy':'Order placed: Sell', {variant: side==='buy'?'success':'destructive'})"
                            :class="side==='buy' ? 'bg-success hover:brightness-110' : 'bg-destructive hover:brightness-110'"
                            class="w-full rounded-lg py-2.5 text-sm font-semibold text-white shadow-sm transition-all active:scale-[.98]">
                        <span x-text="side==='buy'?'Buy now':'Sell now'"></span>
                    </button>
                </div>
            </div>
        </x-ui.card>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const t = window.akChartTheme();
            const ctx = cryptoPerf.getContext('2d'); const g = ctx.createLinearGradient(0,0,0,288);
            g.addColorStop(0,'hsla'+t.c2.slice(3,-1)+' / .3)'); g.addColorStop(1,'hsla'+t.c2.slice(3,-1)+' / 0)');
            const d=[]; let v=52; for(let i=0;i<30;i++){ v += (Math.sin(i/3)+ (Math.random()-.4))*1.5; d.push(Math.max(40,v)); }
            new Chart(cryptoPerf, { type:'line', data:{ labels:d.map((_,i)=>i+1), datasets:[{ label:'Portfolio ($k)', data:d, borderColor:t.c2, backgroundColor:g, fill:true, tension:.4, pointRadius:0, borderWidth:2.5 }]},
                options:{ responsive:true, maintainAspectRatio:false, plugins:{legend:{display:false}}, scales:{ x:{grid:{display:false},ticks:{color:t.text,maxTicksLimit:8}}, y:{grid:{color:t.grid},ticks:{color:t.text,callback:v=>'$'+v+'k'}} } } });
            new Chart(cryptoAlloc, { type:'doughnut', data:{ labels:['BTC','ETH','SOL','Others'], datasets:[{ data:[48,29,14,9], backgroundColor:[t.c1,t.c2,t.c3,t.c4], borderWidth:0, hoverOffset:6 }]},
                options:{ responsive:true, maintainAspectRatio:false, cutout:'70%', plugins:{legend:{display:false}} } });
        });
    </script>
    @endpush
</x-layouts.app>
