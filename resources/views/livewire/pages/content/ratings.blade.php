<div x-data x-init="$nextTick(() => window.renderIcons && window.renderIcons())">
    <x-page-header :title="$pageTitle" subtitle="Advanced Ui · stars, half-stars, emoji reactions & review summaries">
        <x-slot:actions>
            <x-ui.badge variant="success" dot>6 variants</x-ui.badge>
            <x-ui.button variant="outline" icon="arrow-left" class="[&>svg]:rtl-flip" :href="route('dashboard')">Dashboard</x-ui.button>
        </x-slot:actions>
    </x-page-header>

    <x-demo-section title="Interactive" desc="Hover to preview, click to set, and a segmented emoji reaction." />
    <div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
        {{-- Star rating --}}
        <x-ui.card title="Star rating" subtitle="Hover, click & reset">
            <div x-data="{ rating: 3, hover: 0 }" class="flex flex-col items-start gap-4">
                <div class="flex items-center gap-1.5" @mouseleave="hover = 0">
                    <template x-for="n in 5" :key="n">
                        <button type="button" @click="rating = n" @mouseenter="hover = n" class="transition-transform hover:scale-125">
                            <i data-lucide="star" class="size-9" :class="(hover || rating) >= n ? 'fill-amber-400 text-amber-400 drop-shadow-sm' : 'text-muted-foreground/30'"></i>
                        </button>
                    </template>
                </div>
                <div class="flex items-center gap-3 text-sm">
                    <span class="rounded-lg bg-muted px-2.5 py-1 font-bold" x-text="rating + '.0'"></span>
                    <span class="font-medium text-muted-foreground" x-text="['Terrible','Poor','Average','Good','Excellent'][rating - 1] ?? 'Not rated'"></span>
                    <button type="button" @click="rating = 0; hover = 0" class="text-primary hover:underline">Reset</button>
                </div>
            </div>
        </x-ui.card>

        {{-- Emoji reactions --}}
        <x-ui.card title="Emoji reaction" subtitle="Pick how you feel">
            <div x-data="{ sel: 3 }">
                <div class="flex items-center justify-between gap-2">
                    @foreach ([['😡','Awful'],['🙁','Bad'],['😐','Okay'],['🙂','Good'],['🤩','Love it']] as $i => [$emo, $label])
                        <button type="button" @click="sel = {{ $i + 1 }}"
                                class="flex flex-1 flex-col items-center gap-1.5 rounded-xl border-2 py-3 transition-all"
                                :class="sel === {{ $i + 1 }} ? 'border-primary bg-primary/5 scale-105' : 'border-transparent hover:bg-accent grayscale hover:grayscale-0'">
                            <span class="text-2xl">{{ $emo }}</span>
                            <span class="text-xs font-medium" :class="sel === {{ $i + 1 }} ? 'text-primary' : 'text-muted-foreground'">{{ $label }}</span>
                        </button>
                    @endforeach
                </div>
            </div>
        </x-ui.card>
    </div>

    <x-demo-section title="Display variants" desc="Read-only stars in different sizes, colors, half-values, and thumbs." />
    <div class="grid grid-cols-1 gap-4 lg:grid-cols-3">
        {{-- Sizes & colors --}}
        <x-ui.card title="Sizes & colors">
            <div class="space-y-4">
                @php $rows = [
                    ['val' => 5, 'cls' => 'fill-amber-400 text-amber-400', 'size' => 'size-4', 'label' => 'Small'],
                    ['val' => 4, 'cls' => 'fill-rose-500 text-rose-500',   'size' => 'size-5', 'label' => 'Medium'],
                    ['val' => 3, 'cls' => 'fill-emerald-500 text-emerald-500','size' => 'size-6', 'label' => 'Large'],
                ]; @endphp
                @foreach ($rows as $r)
                    <div class="flex items-center justify-between gap-4">
                        <div class="flex items-center gap-0.5">
                            @for ($n = 1; $n <= 5; $n++)
                                <i data-lucide="star" class="{{ $r['size'] }} {{ $n <= $r['val'] ? $r['cls'] : 'text-muted-foreground/25' }}"></i>
                            @endfor
                        </div>
                        <span class="text-sm text-muted-foreground">{{ $r['label'] }}</span>
                    </div>
                @endforeach
            </div>
        </x-ui.card>

        {{-- Half stars --}}
        <x-ui.card title="Half & fractional">
            <div class="space-y-4">
                @foreach ([['Product quality', 4.5],['Delivery speed', 3.5],['Support', 4.0]] as [$label, $val])
                    <div>
                        <div class="mb-1 flex items-center justify-between text-sm"><span class="font-medium">{{ $label }}</span><span class="text-muted-foreground">{{ number_format($val, 1) }}</span></div>
                        <div class="relative inline-flex">
                            <div class="flex gap-0.5 text-muted-foreground/25">@for($n=0;$n<5;$n++)<i data-lucide="star" class="size-5"></i>@endfor</div>
                            <div class="absolute inset-0 flex gap-0.5 overflow-hidden text-amber-400" style="width: {{ ($val / 5) * 100 }}%">@for($n=0;$n<5;$n++)<i data-lucide="star" class="size-5 shrink-0 fill-amber-400"></i>@endfor</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </x-ui.card>

        {{-- Thumbs --}}
        <x-ui.card title="Thumbs & useful">
            <div x-data="{ vote: null }" class="space-y-4">
                <p class="text-sm text-muted-foreground">Was this article helpful?</p>
                <div class="flex gap-2">
                    <button type="button" @click="vote = 'up'" class="flex flex-1 items-center justify-center gap-2 rounded-lg border py-2.5 text-sm font-medium transition-colors" :class="vote === 'up' ? 'border-success bg-success/10 text-success' : 'border-border hover:bg-accent'">
                        <i data-lucide="thumbs-up" class="size-4"></i>Yes
                    </button>
                    <button type="button" @click="vote = 'down'" class="flex flex-1 items-center justify-center gap-2 rounded-lg border py-2.5 text-sm font-medium transition-colors" :class="vote === 'down' ? 'border-destructive bg-destructive/10 text-destructive' : 'border-border hover:bg-accent'">
                        <i data-lucide="thumbs-down" class="size-4"></i>No
                    </button>
                </div>
                <p x-show="vote" x-cloak class="text-xs text-muted-foreground" x-text="vote === 'up' ? 'Thanks for your feedback! 🎉' : 'Sorry to hear that — we’ll improve.'"></p>
            </div>
        </x-ui.card>
    </div>

    <x-demo-section title="Review summary" desc="Aggregate score with a rating distribution breakdown." />
    <x-ui.card>
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-3">
            <div class="flex flex-col items-center justify-center rounded-xl bg-gradient-to-br from-amber-50 to-orange-50 p-6 text-center dark:from-amber-950/30 dark:to-orange-950/20">
                <span class="text-5xl font-bold">4.6</span>
                <div class="mt-1.5 flex gap-0.5">
                    @for ($n = 1; $n <= 5; $n++)
                        <i data-lucide="star" class="size-4 {{ $n <= 4 ? 'fill-amber-400 text-amber-400' : 'fill-amber-400/50 text-amber-400/50' }}"></i>
                    @endfor
                </div>
                <span class="mt-1.5 text-xs text-muted-foreground">Based on 2,481 reviews</span>
            </div>
            <div class="space-y-2.5 sm:col-span-2">
                @foreach ([['5',78],['4',15],['3',4],['2',2],['1',1]] as [$star, $pct])
                    <div class="flex items-center gap-3 text-sm">
                        <span class="flex w-8 items-center gap-1 text-muted-foreground">{{ $star }}<i data-lucide="star" class="size-3 fill-amber-400 text-amber-400"></i></span>
                        <div class="h-2.5 flex-1 overflow-hidden rounded-full bg-muted"><div class="h-full rounded-full bg-gradient-to-r from-amber-400 to-amber-500" style="width: {{ $pct }}%"></div></div>
                        <span class="w-10 text-end text-muted-foreground">{{ $pct }}%</span>
                    </div>
                @endforeach
            </div>
        </div>
    </x-ui.card>
</div>
