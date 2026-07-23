<div>
    <x-page-header :title="$pageTitle" subtitle="Advanced Ui · touch sliders — multi-view, autoplay, fade & pagination">
        <x-slot:actions>
            <x-ui.badge variant="success" dot>3 variants</x-ui.badge>
            <x-ui.button variant="outline" icon="arrow-left" class="[&>svg]:rtl-flip" :href="route('dashboard')">Dashboard</x-ui.button>
        </x-slot:actions>
    </x-page-header>

    @php
        $cards = [
            ['icon' => 'mountain',  'from' => 'from-sky-500',     'to' => 'to-indigo-500', 't' => 'Alpine Trails',  's' => '12 routes'],
            ['icon' => 'waves',     'from' => 'from-cyan-500',    'to' => 'to-blue-500',   't' => 'Coastal Drive',  's' => '8 routes'],
            ['icon' => 'trees',     'from' => 'from-emerald-500', 'to' => 'to-green-600',  't' => 'Forest Loop',    's' => '5 routes'],
            ['icon' => 'sun',       'from' => 'from-amber-500',   'to' => 'to-orange-500', 't' => 'Desert Run',     's' => '9 routes'],
            ['icon' => 'snowflake', 'from' => 'from-indigo-500',  'to' => 'to-violet-500', 't' => 'Winter Pass',    's' => '6 routes'],
            ['icon' => 'flower-2',  'from' => 'from-rose-500',    'to' => 'to-pink-500',   't' => 'Valley Bloom',   's' => '7 routes'],
        ];
    @endphp

    <x-demo-section title="Slides per view" desc="Drag, swipe or use the arrows — snaps to each card." />
    <x-ui.card>
        <div x-data="{
                slide(dir) { const t = this.$refs.track; const first = t.querySelector('[data-slide]'); const step = first ? first.offsetWidth + 16 : t.clientWidth; t.scrollBy({ left: dir * step * 2, behavior: 'smooth' }); },
             }">
            <div class="mb-3 flex justify-end gap-2">
                <button type="button" @click="slide(-1)" class="grid size-9 place-items-center rounded-lg border border-border text-muted-foreground hover:bg-accent"><i data-lucide="chevron-left" class="rtl-flip size-5"></i></button>
                <button type="button" @click="slide(1)" class="grid size-9 place-items-center rounded-lg border border-border text-muted-foreground hover:bg-accent"><i data-lucide="chevron-right" class="rtl-flip size-5"></i></button>
            </div>
            <div x-ref="track" class="no-scrollbar flex snap-x snap-mandatory gap-4 overflow-x-auto scroll-smooth pb-1">
                @foreach ($cards as $c)
                    <div data-slide class="w-[70%] shrink-0 snap-start sm:w-[45%] lg:w-[31%]">
                        <div class="flex h-40 flex-col justify-end rounded-2xl bg-gradient-to-br {{ $c['from'] }} {{ $c['to'] }} p-4 text-white">
                            <i data-lucide="{{ $c['icon'] }}" class="mb-auto size-7"></i>
                            <p class="text-lg font-bold">{{ $c['t'] }}</p><p class="text-sm text-white/85">{{ $c['s'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </x-ui.card>

    <x-demo-section title="Autoplay banner" desc="Auto-advancing full-width slider with progress dots." />
    <x-ui.card :padded="false" class="overflow-hidden">
        <div x-data="{
                i: 0, n: {{ count($cards) }}, timer: null,
                start() { this.stop(); this.timer = setInterval(() => this.i = (this.i + 1) % this.n, 3000); }, stop() { if (this.timer) clearInterval(this.timer); },
             }" x-init="start()" @mouseenter="stop()" @mouseleave="start()" class="relative">
            <div class="relative h-52 sm:h-64">
                @foreach ($cards as $k => $c)
                    <div x-show="i === {{ $k }}" x-cloak x-transition:enter="transition duration-500" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                         class="absolute inset-0 flex flex-col items-center justify-center gap-2 bg-gradient-to-br {{ $c['from'] }} {{ $c['to'] }} text-white">
                        <i data-lucide="{{ $c['icon'] }}" class="size-10"></i><p class="text-2xl font-bold">{{ $c['t'] }}</p><p class="text-sm text-white/85">{{ $c['s'] }}</p>
                    </div>
                @endforeach
            </div>
            <div class="absolute inset-x-0 bottom-4 flex items-center justify-center gap-2">
                @foreach ($cards as $k => $c)<button @click="i = {{ $k }}" class="h-2 rounded-full bg-white transition-all" :class="i === {{ $k }} ? 'w-6' : 'w-2 opacity-50'"></button>@endforeach
            </div>
        </div>
    </x-ui.card>

    <x-demo-section title="Fade effect" desc="One slide at a time with arrow + dot pagination." />
    <x-ui.card>
        <div x-data="{ i: 0, n: {{ count($cards) }} }" class="mx-auto max-w-xl">
            <div class="relative h-56 overflow-hidden rounded-2xl">
                @foreach ($cards as $k => $c)
                    <div x-show="i === {{ $k }}" x-cloak x-transition:enter="transition duration-500" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                         class="absolute inset-0 flex flex-col items-center justify-center gap-2 bg-gradient-to-br {{ $c['from'] }} {{ $c['to'] }} text-white">
                        <i data-lucide="{{ $c['icon'] }}" class="size-10"></i><p class="text-xl font-bold">{{ $c['t'] }}</p><p class="text-sm text-white/85">{{ $c['s'] }}</p>
                    </div>
                @endforeach
            </div>
            <div class="mt-4 flex items-center justify-center gap-3">
                <button type="button" @click="i = (i - 1 + n) % n" class="grid size-9 place-items-center rounded-full border border-border hover:bg-accent"><i data-lucide="chevron-left" class="rtl-flip size-5"></i></button>
                <div class="flex items-center gap-2">@foreach ($cards as $k => $c)<button @click="i = {{ $k }}" class="size-2.5 rounded-full transition-all" :class="i === {{ $k }} ? 'w-6 bg-primary' : 'bg-muted-foreground/30'"></button>@endforeach</div>
                <button type="button" @click="i = (i + 1) % n" class="grid size-9 place-items-center rounded-full border border-border hover:bg-accent"><i data-lucide="chevron-right" class="rtl-flip size-5"></i></button>
            </div>
        </div>
    </x-ui.card>
</div>
