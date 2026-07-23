<div>
    <x-page-header :title="'Borders'" subtitle="Utilities · width, radius, style & dividers">
        <x-slot:actions>
            <x-ui.button variant="outline" icon="arrow-left" class="[&>svg]:rtl-flip" :href="route('dashboard')">Dashboard</x-ui.button>
        </x-slot:actions>
    </x-page-header>

    <x-demo-section title="Width" desc="From hairline to thick." />
    <x-ui.card>
        <div class="flex flex-wrap gap-6">
            @foreach (['border' => '1px','border-2' => '2px','border-4' => '4px','border-8' => '8px'] as $cls => $label)
                <div class="flex flex-col items-center gap-2"><div class="{{ $cls }} size-20 rounded-xl border-border"></div><code class="text-xs text-muted-foreground">{{ $cls }}</code></div>
            @endforeach
        </div>
    </x-ui.card>

    <x-demo-section title="Radius" desc="Corner rounding from none to full." />
    <x-ui.card>
        <div class="flex flex-wrap gap-6">
            @foreach (['rounded-none' => 'none','rounded' => 'sm','rounded-lg' => 'lg','rounded-2xl' => '2xl','rounded-full' => 'full'] as $cls => $label)
                <div class="flex flex-col items-center gap-2"><div class="{{ $cls }} size-20 border-2 border-primary/40 bg-primary/10"></div><code class="text-xs text-muted-foreground">{{ $label }}</code></div>
            @endforeach
        </div>
    </x-ui.card>

    <x-demo-section title="Style & color" desc="Solid, dashed and dotted borders in semantic colors." />
    <div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
        <x-ui.card title="Style">
            <div class="flex flex-wrap gap-6">
                @foreach (['border-solid' => 'solid','border-dashed' => 'dashed','border-dotted' => 'dotted'] as $cls => $label)
                    <div class="flex flex-col items-center gap-2"><div class="{{ $cls }} size-20 rounded-xl border-2 border-muted-foreground/50"></div><code class="text-xs text-muted-foreground">{{ $label }}</code></div>
                @endforeach
            </div>
        </x-ui.card>
        <x-ui.card title="Color">
            <div class="flex flex-wrap gap-6">
                @foreach (['border-primary' => 'primary','border-success' => 'success','border-destructive' => 'destructive','border-info' => 'info'] as $cls => $label)
                    <div class="flex flex-col items-center gap-2"><div class="{{ $cls }} size-20 rounded-xl border-2"></div><code class="text-xs text-muted-foreground">{{ $label }}</code></div>
                @endforeach
            </div>
        </x-ui.card>
    </div>

    <x-demo-section title="Dividers" desc="Horizontal and vertical separators." />
    <x-ui.card>
        <div class="space-y-3">
            <p class="text-sm">Content above</p>
            <div class="border-t border-border"></div>
            <p class="text-sm">Content below</p>
            <div class="flex items-center gap-4 pt-2">
                <span class="text-sm">Left</span>
                <div class="h-8 border-s border-border"></div>
                <span class="text-sm">Middle</span>
                <div class="h-8 border-s border-border"></div>
                <span class="text-sm">Right</span>
            </div>
            <div class="flex items-center gap-3 pt-2"><div class="h-px flex-1 bg-border"></div><span class="text-xs font-medium text-muted-foreground">OR</span><div class="h-px flex-1 bg-border"></div></div>
        </div>
    </x-ui.card>
</div>
