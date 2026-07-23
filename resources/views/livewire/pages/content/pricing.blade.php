<div x-data="{ yearly: true }">
    <x-page-header :title="$pageTitle" subtitle="Pages · plans, billing toggle & feature comparison">
        <x-slot:actions>
            <x-ui.button variant="outline" icon="arrow-left" class="[&>svg]:rtl-flip" :href="route('dashboard')">Dashboard</x-ui.button>
        </x-slot:actions>
    </x-page-header>

    {{-- Hero --}}
    <div class="flex flex-col items-center gap-4 py-6 text-center">
        <span class="inline-flex items-center gap-1.5 rounded-full border border-border bg-card px-3 py-1 text-xs font-semibold text-muted-foreground"><i data-lucide="sparkles" class="size-3.5 text-primary"></i>Simple, transparent pricing</span>
        <h1 class="max-w-2xl text-3xl font-black tracking-tight sm:text-4xl">Pick a plan that grows with you</h1>
        <p class="max-w-md text-muted-foreground">Start free, upgrade anytime. No hidden fees, cancel whenever you like.</p>
        {{-- Toggle --}}
        <div class="mt-2 inline-flex items-center gap-3 rounded-full border border-border bg-card p-1 shadow-sm">
            <button @click="yearly = false" class="rounded-full px-5 py-2 text-sm font-semibold transition-colors" :class="! yearly ? 'bg-primary text-primary-foreground shadow' : 'text-muted-foreground'">Monthly</button>
            <button @click="yearly = true" class="flex items-center gap-1.5 rounded-full px-5 py-2 text-sm font-semibold transition-colors" :class="yearly ? 'bg-primary text-primary-foreground shadow' : 'text-muted-foreground'">Yearly <span class="rounded-full bg-success/20 px-1.5 text-xs font-bold text-success">Save 20%</span></button>
        </div>
    </div>

    {{-- Plans --}}
    <div class="mx-auto mt-10 grid w-full max-w-5xl grid-cols-1 gap-6 md:grid-cols-3 md:items-center">
        @php
            $plans = [
                ['name' => 'Starter', 'icon' => 'rocket', 'm' => 0, 'y' => 0, 'desc' => 'For individuals getting started', 'popular' => false, 'cta' => 'Get started', 'features' => ['1 project','Up to 3 members','Community support','1 GB storage']],
                ['name' => 'Pro', 'icon' => 'zap', 'm' => 29, 'y' => 279, 'desc' => 'For growing teams that need more', 'popular' => true, 'cta' => 'Start free trial', 'features' => ['Unlimited projects','Up to 20 members','Priority support','50 GB storage','Advanced analytics','Custom domains']],
                ['name' => 'Enterprise', 'icon' => 'building-2', 'm' => 99, 'y' => 949, 'desc' => 'For large organizations at scale', 'popular' => false, 'cta' => 'Contact sales', 'features' => ['Everything in Pro','Unlimited members','24/7 dedicated support','SSO & audit logs','SLA guarantee','Dedicated manager']],
            ];
        @endphp
        @foreach ($plans as $p)
            <div class="relative flex flex-col rounded-2xl border bg-card p-6 transition-all
                {{ $p['popular'] ? 'border-primary shadow-xl md:-my-4 md:py-10 ring-1 ring-primary/20' : 'border-border shadow-sm hover:shadow-md' }}">
                @if ($p['popular'])
                    <span class="absolute inset-x-0 -top-3 mx-auto w-fit rounded-full bg-gradient-to-r from-primary to-sidebar-primary px-3 py-1 text-xs font-bold text-white shadow">★ Most popular</span>
                @endif
                <div class="flex items-center gap-2.5">
                    <span class="grid size-11 place-items-center rounded-xl {{ $p['popular'] ? 'bg-gradient-to-br from-primary to-sidebar-primary text-white shadow-lg shadow-primary/30' : 'bg-primary/10 text-primary' }}"><i data-lucide="{{ $p['icon'] }}" class="size-5"></i></span>
                    <div><p class="font-bold">{{ $p['name'] }}</p><p class="text-xs text-muted-foreground">{{ $p['desc'] }}</p></div>
                </div>
                <div class="mt-6 flex items-end gap-1">
                    <span class="text-5xl font-black tracking-tight">$<span x-text="yearly ? Math.round({{ $p['y'] }} / 12) : {{ $p['m'] }}"></span></span>
                    <span class="mb-2 text-sm text-muted-foreground">/mo</span>
                </div>
                <p class="mt-1 h-4 text-xs text-muted-foreground" x-text="(yearly && {{ $p['y'] }} > 0) ? 'billed ${{ $p['y'] }} per year' : ''"></p>
                <x-ui.button class="mt-5 w-full" size="lg" :variant="$p['popular'] ? 'default' : 'outline'">{{ $p['cta'] }}</x-ui.button>
                <div class="mt-6 space-y-3 border-t border-border pt-6">
                    @foreach ($p['features'] as $f)
                        <div class="flex items-center gap-2.5 text-sm">
                            <span class="grid size-5 shrink-0 place-items-center rounded-full {{ $p['popular'] ? 'bg-primary/15 text-primary' : 'bg-success/15 text-success' }}"><i data-lucide="check" class="size-3"></i></span>{{ $f }}
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>

    {{-- Trust bar --}}
    <div class="mt-10 flex flex-col items-center gap-4">
        <p class="text-xs font-semibold uppercase tracking-wide text-muted-foreground">Trusted by teams at</p>
        <div class="flex flex-wrap items-center justify-center gap-x-8 gap-y-3 opacity-70">
            @foreach (['hexagon' => 'Nexus','box' => 'Console','layers' => 'Stack','command' => 'Vertex','aperture' => 'Orbit','anchor' => 'Northwind'] as $ico => $name)
                <span class="flex items-center gap-1.5 text-lg font-bold text-muted-foreground"><i data-lucide="{{ $ico }}" class="size-5"></i>{{ $name }}</span>
            @endforeach
        </div>
    </div>

    {{-- Comparison --}}
    <x-demo-section title="Compare all features" desc="A detailed breakdown across every tier." class="mt-12" />
    <x-ui.card :padded="false" class="overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full min-w-[560px] text-sm">
                <thead>
                    <tr class="border-b border-border">
                        <th class="p-4 text-start font-medium text-muted-foreground">Feature</th>
                        <th class="p-4 text-center font-semibold">Starter</th>
                        <th class="bg-primary/5 p-4 text-center font-semibold text-primary">Pro</th>
                        <th class="p-4 text-center font-semibold">Enterprise</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ([['Projects','1','Unlimited','Unlimited'],['Team members','3','20','Unlimited'],['Storage','1 GB','50 GB','1 TB'],['Analytics',false,true,true],['Custom domains',false,true,true],['SSO & audit logs',false,false,true],['Priority support',false,true,true],['SLA',false,false,true]] as [$feat,$s,$pr,$e])
                        <tr class="border-b border-border last:border-0">
                            <td class="p-4 font-medium">{{ $feat }}</td>
                            @foreach ([$s,$pr,$e] as $ci => $val)
                                <td class="p-4 text-center {{ $ci === 1 ? 'bg-primary/5' : '' }}">
                                    @if ($val === true)<i data-lucide="check" class="mx-auto size-4 text-success"></i>
                                    @elseif ($val === false)<i data-lucide="minus" class="mx-auto size-4 text-muted-foreground/40"></i>
                                    @else <span class="text-muted-foreground">{{ $val }}</span>@endif
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </x-ui.card>

    {{-- FAQ --}}
    <x-demo-section title="Frequently asked" desc="Everything you need to know about billing." class="mt-12" />
    <div x-data="{ open: 0 }" class="mx-auto max-w-2xl space-y-2.5">
        @foreach ([
            ['Can I change plans later?','Absolutely. Upgrade or downgrade anytime — changes are prorated automatically.'],
            ['Do you offer refunds?','Yes, a full refund within 30 days of purchase, no questions asked.'],
            ['Is there a free trial?','The Pro plan includes a 14-day free trial. No credit card required to start.'],
            ['What payment methods do you accept?','All major credit cards, digital wallets and bank transfer for annual plans.'],
        ] as $i => [$q, $a])
            <div class="overflow-hidden rounded-xl border border-border">
                <button @click="open = open === {{ $i }} ? null : {{ $i }}" class="flex w-full items-center justify-between gap-3 px-4 py-3.5 text-start text-sm font-semibold">
                    {{ $q }}<i data-lucide="chevron-down" class="size-4 shrink-0 text-muted-foreground transition-transform" :class="open === {{ $i }} && 'rotate-180'"></i>
                </button>
                <div x-show="open === {{ $i }}" x-collapse x-cloak><p class="px-4 pb-4 text-sm text-muted-foreground">{{ $a }}</p></div>
            </div>
        @endforeach
    </div>

    {{-- Guarantee CTA --}}
    <x-ui.card class="mt-8 overflow-hidden bg-gradient-to-br from-primary/10 via-card to-sidebar-primary/10">
        <div class="flex flex-col items-center gap-3 py-6 text-center">
            <span class="grid size-12 place-items-center rounded-2xl bg-success/15 text-success"><i data-lucide="shield-check" class="size-6"></i></span>
            <h2 class="text-xl font-bold">30-day money-back guarantee</h2>
            <p class="max-w-md text-sm text-muted-foreground">Try any paid plan risk-free. If it’s not the right fit, we’ll refund every cent.</p>
            <x-ui.button size="lg" class="mt-1" icon="rocket">Start your free trial</x-ui.button>
        </div>
    </x-ui.card>
</div>
