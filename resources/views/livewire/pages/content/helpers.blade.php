<div>
    <x-page-header :title="'Helpers'" subtitle="Utilities · shadows, opacity, ratio, truncate & more">
        <x-slot:actions>
            <x-ui.button variant="outline" icon="arrow-left" class="[&>svg]:rtl-flip" :href="route('dashboard')">Dashboard</x-ui.button>
        </x-slot:actions>
    </x-page-header>

    <x-demo-section title="Shadows" desc="Elevation from subtle to dramatic." />
    <x-ui.card>
        <div class="flex flex-wrap gap-6">
            @foreach (['shadow-sm' => 'sm','shadow' => 'base','shadow-md' => 'md','shadow-lg' => 'lg','shadow-xl' => 'xl','shadow-2xl' => '2xl'] as $cls => $label)
                <div class="flex flex-col items-center gap-2"><div class="{{ $cls }} size-20 rounded-xl border border-border bg-card"></div><code class="text-xs text-muted-foreground">{{ $cls }}</code></div>
            @endforeach
        </div>
    </x-ui.card>

    <x-demo-section title="Opacity" desc="Transparency levels." />
    <x-ui.card>
        <div class="flex flex-wrap gap-4">
            @foreach (['opacity-100' => '100','opacity-75' => '75','opacity-50' => '50','opacity-25' => '25','opacity-10' => '10'] as $cls => $label)
                <div class="flex flex-col items-center gap-2"><div class="{{ $cls }} size-16 rounded-xl bg-gradient-to-br from-primary to-sidebar-primary"></div><code class="text-xs text-muted-foreground">{{ $label }}%</code></div>
            @endforeach
        </div>
    </x-ui.card>

    <x-demo-section title="Aspect ratio" desc="Maintain proportions responsively." />
    <div class="grid grid-cols-2 gap-4 sm:grid-cols-4">
        @foreach (['aspect-square' => '1:1','aspect-video' => '16:9','aspect-[4/3]' => '4:3','aspect-[3/4]' => '3:4'] as $cls => $label)
            <div><div class="{{ $cls }} grid place-items-center rounded-xl bg-primary/10 font-semibold text-primary">{{ $label }}</div><code class="mt-1 block text-center text-xs text-muted-foreground">{{ $cls }}</code></div>
        @endforeach
    </div>

    <x-demo-section title="Text truncation" desc="Single-line and multi-line clamping." />
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
        <x-ui.card title="truncate"><p class="truncate text-sm text-muted-foreground">This is a very long line of text that will be truncated with an ellipsis when it overflows its container.</p></x-ui.card>
        <x-ui.card title="line-clamp-2"><p class="line-clamp-2 text-sm text-muted-foreground">This paragraph is clamped to exactly two lines. Any content beyond the second line is hidden and replaced with an ellipsis at the end.</p></x-ui.card>
        <x-ui.card title="line-clamp-3"><p class="line-clamp-3 text-sm text-muted-foreground">This paragraph is clamped to three lines. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p></x-ui.card>
    </div>

    <x-demo-section title="Ring & focus" desc="Focus rings and outline offsets." />
    <x-ui.card>
        <div class="flex flex-wrap gap-6">
            @foreach (['ring-1' => '1px','ring-2' => '2px','ring-4' => '4px'] as $cls => $label)
                <div class="flex flex-col items-center gap-2"><div class="{{ $cls }} size-16 rounded-xl bg-card ring-primary ring-offset-2 ring-offset-background"></div><code class="text-xs text-muted-foreground">{{ $cls }}</code></div>
            @endforeach
        </div>
    </x-ui.card>
</div>
