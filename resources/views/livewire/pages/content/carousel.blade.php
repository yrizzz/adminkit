<div>
    <x-page-header :title="$pageTitle" subtitle="Advanced Ui · autoplay, progress, fade, thumbnails & testimonials">
        <x-slot:actions>
            <x-ui.badge variant="success" dot>4 variants</x-ui.badge>
            <x-ui.button variant="outline" icon="arrow-left" class="[&>svg]:rtl-flip" :href="route('dashboard')">Dashboard</x-ui.button>
        </x-slot:actions>
    </x-page-header>

    @php
        $slides = [
            ['from' => 'from-indigo-500', 'to' => 'to-blue-500',   'icon' => 'rocket',      't' => 'Ship faster',      'd' => 'Prebuilt pages, components and layouts out of the box.'],
            ['from' => 'from-emerald-500','to' => 'to-teal-500',   'icon' => 'shield-check','t' => 'Secure by default','d' => 'Auth, roles and security headers already configured.'],
            ['from' => 'from-fuchsia-500','to' => 'to-pink-500',   'icon' => 'palette',     't' => 'Fully themeable',  'd' => 'Accent, radius, density and dark mode in one click.'],
            ['from' => 'from-amber-500',  'to' => 'to-orange-500', 'icon' => 'zap',         't' => 'Blazing fast',     'd' => 'Livewire SPA navigation with zero full reloads.'],
        ];
    @endphp

    <x-demo-section title="Hero carousel" desc="Autoplay with a progress bar, arrows, dots and pause-on-hover." />
    <x-ui.card :padded="false" class="overflow-hidden">
        <div x-data="{
                i: 0, count: {{ count($slides) }}, playing: true, timer: null, DUR: 4000,
                go(n) { this.i = (n + this.count) % this.count; this.restart(); },
                next() { this.go(this.i + 1); }, prev() { this.go(this.i - 1); },
                start() { this.stop(); if (this.playing) this.timer = setInterval(() => this.i = (this.i + 1) % this.count, this.DUR); },
                stop() { if (this.timer) clearInterval(this.timer); },
                restart() { if (this.playing) this.start(); },
             }"
             x-init="start()" @mouseenter="stop()" @mouseleave="restart()" class="relative">
            <div class="relative h-72 sm:h-96">
                @foreach ($slides as $k => $s)
                    <div x-show="i === {{ $k }}" x-cloak
                         x-transition:enter="transition duration-500" x-transition:enter-start="opacity-0 scale-105" x-transition:enter-end="opacity-100 scale-100"
                         class="absolute inset-0">
                        <div class="flex h-full flex-col items-center justify-center gap-3 bg-gradient-to-br {{ $s['from'] }} {{ $s['to'] }} px-6 text-center text-white">
                            <span class="grid size-16 place-items-center rounded-2xl bg-white/15 backdrop-blur"><i data-lucide="{{ $s['icon'] }}" class="size-8"></i></span>
                            <h3 class="text-2xl font-bold sm:text-3xl">{{ $s['t'] }}</h3>
                            <p class="max-w-md text-sm text-white/90">{{ $s['d'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            <button type="button" @click="prev()" aria-label="Previous" class="absolute start-3 top-1/2 grid size-10 -translate-y-1/2 place-items-center rounded-full bg-white/20 text-white backdrop-blur transition hover:bg-white/35"><i data-lucide="chevron-left" class="rtl-flip size-5"></i></button>
            <button type="button" @click="next()" aria-label="Next" class="absolute end-3 top-1/2 grid size-10 -translate-y-1/2 place-items-center rounded-full bg-white/20 text-white backdrop-blur transition hover:bg-white/35"><i data-lucide="chevron-right" class="rtl-flip size-5"></i></button>

            <div class="absolute inset-x-0 bottom-4 flex items-center justify-center gap-2">
                @foreach ($slides as $k => $s)
                    <button type="button" @click="go({{ $k }})" :class="i === {{ $k }} ? 'w-7 bg-white' : 'w-2.5 bg-white/50'" class="h-2.5 rounded-full transition-all"></button>
                @endforeach
            </div>
            <button type="button" @click="playing = ! playing; playing ? start() : stop()" class="absolute end-4 bottom-4 grid size-8 place-items-center rounded-full bg-white/20 text-white backdrop-blur hover:bg-white/35"><i data-lucide="pause" class="size-4" x-show="playing"></i><i data-lucide="play" class="size-4" x-show="! playing" x-cloak></i></button>

            {{-- progress bar --}}
            <div class="absolute inset-x-0 top-0 h-1 bg-white/20">
                <div class="h-full bg-white" :style="playing ? `animation: ak-cbar ${DUR}ms linear infinite` : ''" :key="i + '-' + playing"></div>
            </div>
        </div>
    </x-ui.card>

    <x-demo-section title="Fade & Thumbnails" desc="A crossfade slider and a thumbnail-navigation gallery." />
    <div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
        {{-- Fade --}}
        <x-ui.card title="Crossfade" subtitle="One slide fades into the next">
            <div x-data="{ i: 0, n: {{ count($slides) }} }">
                <div class="relative h-48 overflow-hidden rounded-xl">
                    @foreach ($slides as $k => $s)
                        <div x-show="i === {{ $k }}" x-cloak x-transition:enter="transition duration-500" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                             class="absolute inset-0 flex flex-col items-center justify-center gap-2 bg-gradient-to-br {{ $s['from'] }} {{ $s['to'] }} text-white">
                            <i data-lucide="{{ $s['icon'] }}" class="size-8"></i><p class="font-semibold">{{ $s['t'] }}</p>
                        </div>
                    @endforeach
                </div>
                <div class="mt-3 flex items-center justify-between">
                    <x-ui.button variant="outline" size="sm" icon="chevron-left" class="[&>svg]:rtl-flip" @click="i = (i - 1 + n) % n">Prev</x-ui.button>
                    <div class="flex gap-1.5">@foreach ($slides as $k => $s)<button @click="i = {{ $k }}" class="size-2 rounded-full" :class="i === {{ $k }} ? 'bg-primary' : 'bg-muted-foreground/30'"></button>@endforeach</div>
                    <x-ui.button variant="outline" size="sm" iconEnd="chevron-right" class="[&>svg]:rtl-flip" @click="i = (i + 1) % n">Next</x-ui.button>
                </div>
            </div>
        </x-ui.card>

        {{-- Thumbnails --}}
        <x-ui.card title="Thumbnail nav" subtitle="Click a thumb to jump">
            <div x-data="{ i: 0 }">
                <div class="relative overflow-hidden rounded-xl border border-border">
                    @foreach ($slides as $k => $s)
                        <div x-show="i === {{ $k }}" x-cloak class="flex h-48 items-center justify-center bg-gradient-to-br {{ $s['from'] }} {{ $s['to'] }} text-white"><div class="text-center"><i data-lucide="{{ $s['icon'] }}" class="mx-auto size-8"></i><p class="mt-2 font-semibold">{{ $s['t'] }}</p></div></div>
                    @endforeach
                </div>
                <div class="mt-3 grid grid-cols-4 gap-2">
                    @foreach ($slides as $k => $s)
                        <button type="button" @click="i = {{ $k }}" class="flex h-14 items-center justify-center rounded-lg bg-gradient-to-br {{ $s['from'] }} {{ $s['to'] }} text-white ring-offset-2 ring-offset-card transition" :class="i === {{ $k }} ? 'ring-2 ring-primary' : 'opacity-60 hover:opacity-100'"><i data-lucide="{{ $s['icon'] }}" class="size-5"></i></button>
                    @endforeach
                </div>
            </div>
        </x-ui.card>
    </div>

    <x-demo-section title="Testimonials" desc="A content carousel for quotes and reviews." />
    <x-ui.card>
        <div x-data="{ i: 0, n: 3 }" class="relative">
            <div class="relative min-h-40">
                @foreach ([
                    ['q' => 'This scaffold saved us weeks. The components are clean and the theming just works.', 'name' => 'Maya Wijaya', 'role' => 'CTO, Northwind', 'ini' => 'Maya Wijaya'],
                    ['q' => 'Best admin starter we’ve used. Livewire + Alpine is a joy and the UX is polished.', 'name' => 'Rian Kusuma', 'role' => 'Lead Dev, Orbit', 'ini' => 'Rian Kusuma'],
                    ['q' => 'Dark mode, RTL and accessibility out of the box. Shipped our dashboard in days.', 'name' => 'Sinta Dewi', 'role' => 'PM, Lumen', 'ini' => 'Sinta Dewi'],
                ] as $k => $t)
                    <div x-show="i === {{ $k }}" x-cloak x-transition:enter="transition duration-300" x-transition:enter-start="opacity-0 translate-x-4 rtl:-translate-x-4" x-transition:enter-end="opacity-100 translate-x-0" class="absolute inset-0 text-center">
                        <i data-lucide="quote" class="mx-auto size-8 text-primary/30"></i>
                        <p class="mx-auto mt-3 max-w-xl text-lg font-medium">“{{ $t['q'] }}”</p>
                        <div class="mt-4 flex items-center justify-center gap-3"><x-ui.avatar :name="$t['ini']" size="sm" /><div class="text-start"><p class="text-sm font-semibold">{{ $t['name'] }}</p><p class="text-xs text-muted-foreground">{{ $t['role'] }}</p></div></div>
                    </div>
                @endforeach
            </div>
            <div class="mt-4 flex items-center justify-center gap-2">
                @for ($k = 0; $k < 3; $k++)<button @click="i = {{ $k }}" class="size-2.5 rounded-full transition-all" :class="i === {{ $k }} ? 'w-6 bg-primary' : 'bg-muted-foreground/30'"></button>@endfor
            </div>
        </div>
    </x-ui.card>
</div>
