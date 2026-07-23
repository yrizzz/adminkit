<div>
    <x-page-header :title="'Breakpoints'" subtitle="Utilities · responsive breakpoints & live indicator">
        <x-slot:actions>
            <x-ui.button variant="outline" icon="arrow-left" class="[&>svg]:rtl-flip" :href="route('dashboard')">Dashboard</x-ui.button>
        </x-slot:actions>
    </x-page-header>

    <x-demo-section title="Current breakpoint" desc="Resize your window — the active breakpoint updates live." />
    <x-ui.card>
        <div class="flex flex-col items-center gap-3 py-4">
            <span class="grid size-20 place-items-center rounded-3xl bg-gradient-to-br from-primary to-sidebar-primary text-2xl font-black text-white shadow-lg shadow-primary/30">
                <span class="sm:hidden">XS</span>
                <span class="hidden sm:inline md:hidden">SM</span>
                <span class="hidden md:inline lg:hidden">MD</span>
                <span class="hidden lg:inline xl:hidden">LG</span>
                <span class="hidden xl:inline 2xl:hidden">XL</span>
                <span class="hidden 2xl:inline">2XL</span>
            </span>
            <p class="text-sm font-medium text-muted-foreground">
                <span class="sm:hidden">Base · below 640px</span>
                <span class="hidden sm:inline md:hidden"><code>sm:</code> · 640px and up</span>
                <span class="hidden md:inline lg:hidden"><code>md:</code> · 768px and up</span>
                <span class="hidden lg:inline xl:hidden"><code>lg:</code> · 1024px and up</span>
                <span class="hidden xl:inline 2xl:hidden"><code>xl:</code> · 1280px and up</span>
                <span class="hidden 2xl:inline"><code>2xl:</code> · 1536px and up</span>
            </p>
        </div>
    </x-ui.card>

    <x-demo-section title="Reference" desc="Tailwind's default responsive breakpoints." />
    <x-ui.card :padded="false" class="overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-border text-start text-xs uppercase tracking-wide text-muted-foreground">
                        <th class="p-4 text-start font-medium">Prefix</th>
                        <th class="p-4 text-start font-medium">Min width</th>
                        <th class="p-4 text-start font-medium">CSS</th>
                        <th class="p-4 text-start font-medium">Typical device</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ([['sm','640px','@media (min-width: 640px)','Large phones'],['md','768px','@media (min-width: 768px)','Tablets'],['lg','1024px','@media (min-width: 1024px)','Laptops'],['xl','1280px','@media (min-width: 1280px)','Desktops'],['2xl','1536px','@media (min-width: 1536px)','Large screens']] as [$prefix,$min,$css,$device])
                        <tr class="border-b border-border last:border-0">
                            <td class="p-4"><code class="rounded bg-muted px-1.5 py-0.5 text-primary">{{ $prefix }}:</code></td>
                            <td class="p-4 font-medium">{{ $min }}</td>
                            <td class="p-4"><code class="text-xs text-muted-foreground">{{ $css }}</code></td>
                            <td class="p-4 text-muted-foreground">{{ $device }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </x-ui.card>

    <x-demo-section title="Responsive grid" desc="1 column on mobile → 4 on desktop." />
    <x-ui.card>
        <div class="grid grid-cols-1 gap-3 sm:grid-cols-2 lg:grid-cols-4">
            @for ($i = 1; $i <= 4; $i++)
                <div class="grid h-20 place-items-center rounded-xl bg-primary/10 font-semibold text-primary">{{ $i }}</div>
            @endfor
        </div>
        <p class="mt-3 text-center text-xs text-muted-foreground"><code>grid-cols-1 sm:grid-cols-2 lg:grid-cols-4</code></p>
    </x-ui.card>
</div>
