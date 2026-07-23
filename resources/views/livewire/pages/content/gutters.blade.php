<div>
    <x-page-header :title="'Gutters'" subtitle="Utilities · gaps, spacing scale & padding">
        <x-slot:actions>
            <x-ui.button variant="outline" icon="arrow-left" class="[&>svg]:rtl-flip" :href="route('dashboard')">Dashboard</x-ui.button>
        </x-slot:actions>
    </x-page-header>

    @php $item = 'grid h-12 flex-1 place-items-center rounded-lg bg-primary/10 text-xs font-semibold text-primary'; @endphp

    <x-demo-section title="Gap scale" desc="Spacing between grid & flex children." />
    <x-ui.card>
        <div class="space-y-4">
            @foreach (['gap-1' => '0.25rem','gap-2' => '0.5rem','gap-3' => '0.75rem','gap-4' => '1rem','gap-6' => '1.5rem','gap-8' => '2rem'] as $cls => $val)
                <div class="flex items-center gap-3">
                    <code class="w-16 shrink-0 text-xs text-muted-foreground">{{ $cls }}</code>
                    <div class="flex {{ $cls }} flex-1">@for($i=0;$i<4;$i++)<div class="{{ $item }}"></div>@endfor</div>
                    <span class="w-16 shrink-0 text-end text-xs text-muted-foreground">{{ $val }}</span>
                </div>
            @endforeach
        </div>
    </x-ui.card>

    <x-demo-section title="Row & column gaps" desc="Independent horizontal and vertical spacing." />
    <div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
        <x-ui.card title="gap-x-6 gap-y-2">
            <div class="grid grid-cols-3 gap-x-6 gap-y-2">@for($i=0;$i<6;$i++)<div class="grid h-12 place-items-center rounded-lg bg-primary/10 text-xs font-semibold text-primary">{{ $i+1 }}</div>@endfor</div>
        </x-ui.card>
        <x-ui.card title="gap-x-2 gap-y-6">
            <div class="grid grid-cols-3 gap-x-2 gap-y-6">@for($i=0;$i<6;$i++)<div class="grid h-12 place-items-center rounded-lg bg-primary/10 text-xs font-semibold text-primary">{{ $i+1 }}</div>@endfor</div>
        </x-ui.card>
    </div>

    <x-demo-section title="Spacing scale" desc="The base 0.25rem step used across all spacing utilities." />
    <x-ui.card>
        <div class="space-y-2">
            @foreach (['1' => '0.25rem','2' => '0.5rem','3' => '0.75rem','4' => '1rem','6' => '1.5rem','8' => '2rem','12' => '3rem','16' => '4rem'] as $n => $val)
                <div class="flex items-center gap-3">
                    <code class="w-10 shrink-0 text-xs text-muted-foreground">{{ $n }}</code>
                    <div class="h-4 rounded bg-gradient-to-r from-primary to-sidebar-primary" style="width: calc({{ $n }} * 0.25rem)"></div>
                    <span class="text-xs text-muted-foreground">{{ $val }}</span>
                </div>
            @endforeach
        </div>
    </x-ui.card>
</div>
