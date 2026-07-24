<div>
    <x-page-header :title="$pageTitle" subtitle="Ui Elements · bars, rings & meters">
        <x-slot:actions><x-ui.button variant="outline" icon="arrow-left" class="[&>svg]:rtl-flip" :href="route('ui.elements')">All elements</x-ui.button></x-slot:actions>
    </x-page-header>

    <x-demo-section title="Colours & sizes" desc="Semantic tones and four thicknesses." />
    <div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
        <x-ui.card title="Tones">
            <div class="space-y-4">
                @foreach ([['Primary',72,'bg-primary'],['Success',54,'bg-success'],['Warning',88,'bg-[hsl(var(--warning))]'],['Destructive',34,'bg-destructive'],['Info',61,'bg-info']] as [$l,$p,$c])
                    <div>
                        <div class="mb-1 flex justify-between text-xs"><span class="font-medium">{{ $l }}</span><span class="text-muted-foreground">{{ $p }}%</span></div>
                        <div class="h-2 overflow-hidden rounded-full bg-muted"><div class="h-full rounded-full {{ $c }}" style="width: {{ $p }}%"></div></div>
                    </div>
                @endforeach
            </div>
        </x-ui.card>

        <x-ui.card title="Thickness">
            <div class="space-y-4">
                @foreach ([['h-1','Extra small'],['h-2','Small'],['h-3','Medium'],['h-4','Large']] as [$h,$l])
                    <div>
                        <p class="mb-1 text-xs font-medium">{{ $l }} <code class="text-muted-foreground">{{ $h }}</code></p>
                        <div class="{{ $h }} overflow-hidden rounded-full bg-muted"><div class="h-full w-[65%] rounded-full bg-primary"></div></div>
                    </div>
                @endforeach
            </div>
        </x-ui.card>
    </div>

    <x-demo-section title="Labelled, striped & indeterminate" desc="Extra styles for different states." />
    <div class="grid grid-cols-1 gap-4 lg:grid-cols-3">
        <x-ui.card title="Inside label">
            <div class="h-6 overflow-hidden rounded-full bg-muted">
                <div class="flex h-full items-center justify-end rounded-full bg-primary pe-2 text-[0.65rem] font-bold text-primary-foreground" style="width: 68%">68%</div>
            </div>
            <div class="mt-3 h-6 overflow-hidden rounded-full bg-muted">
                <div class="flex h-full items-center justify-end rounded-full bg-success pe-2 text-[0.65rem] font-bold text-white" style="width: 42%">42%</div>
            </div>
        </x-ui.card>

        <x-ui.card title="Striped">
            <div class="h-3 overflow-hidden rounded-full bg-muted">
                <div class="h-full w-[70%] rounded-full bg-primary" style="background-image: linear-gradient(45deg, rgba(255,255,255,.25) 25%, transparent 25%, transparent 50%, rgba(255,255,255,.25) 50%, rgba(255,255,255,.25) 75%, transparent 75%, transparent); background-size: 1rem 1rem;"></div>
            </div>
            <div class="mt-3 h-3 overflow-hidden rounded-full bg-muted">
                <div class="h-full w-[45%] rounded-full bg-success" style="background-image: linear-gradient(45deg, rgba(255,255,255,.25) 25%, transparent 25%, transparent 50%, rgba(255,255,255,.25) 50%, rgba(255,255,255,.25) 75%, transparent 75%, transparent); background-size: 1rem 1rem;"></div>
            </div>
        </x-ui.card>

        <x-ui.card title="Indeterminate">
            <div class="h-2 overflow-hidden rounded-full bg-muted"><div class="skeleton h-full w-1/3 rounded-full bg-primary"></div></div>
            <p class="mt-2 text-xs text-muted-foreground">For unknown durations.</p>
            <div class="mt-4 h-2 overflow-hidden rounded-full bg-muted"><div class="skeleton h-full w-1/2 rounded-full bg-success"></div></div>
        </x-ui.card>
    </div>

    <x-demo-section title="Multi-segment & stepped" desc="Several values in one track." />
    <div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
        <x-ui.card title="Stacked segments">
            <div class="flex h-3 overflow-hidden rounded-full bg-muted">
                <div class="bg-primary" style="width: 40%"></div>
                <div class="bg-success" style="width: 25%"></div>
                <div class="bg-[hsl(var(--warning))]" style="width: 20%"></div>
            </div>
            <div class="mt-3 flex flex-wrap gap-4 text-xs">
                @foreach ([['Images','40%','bg-primary'],['Videos','25%','bg-success'],['Docs','20%','bg-[hsl(var(--warning))]'],['Free','15%','bg-muted']] as [$l,$v,$c])
                    <span class="inline-flex items-center gap-1.5"><span class="size-2.5 rounded-full {{ $c }}"></span>{{ $l }} {{ $v }}</span>
                @endforeach
            </div>
        </x-ui.card>

        <x-ui.card title="Stepped">
            <div class="flex gap-1.5">
                @for ($i = 1; $i <= 10; $i++)
                    <span class="h-2.5 flex-1 rounded-full {{ $i <= 7 ? 'bg-primary' : 'bg-muted' }}"></span>
                @endfor
            </div>
            <p class="mt-2 text-xs text-muted-foreground">7 of 10 steps complete</p>
        </x-ui.card>
    </div>

    <x-demo-section title="Circular" desc="Gauges for compact dashboards." />
    <x-ui.card>
        <div class="flex flex-wrap items-center justify-around gap-6">
            <x-ui.gauge :value="82" tone="primary" :size="112" :stroke="9" label="Uptime" />
            <x-ui.gauge :value="64" tone="success" :size="112" :stroke="9" label="Capacity" />
            <x-ui.gauge :value="45" tone="warning" :size="112" :stroke="9" label="Budget" />
            <x-ui.gauge :value="23" tone="destructive" :size="112" :stroke="9" label="Errors" />
        </div>
    </x-ui.card>
</div>
