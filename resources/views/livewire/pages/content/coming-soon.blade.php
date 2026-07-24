<div>
    <x-page-header :title="'Coming Soon'" subtitle="Authentication · pre-launch landing screen">
        <x-slot:actions>
            <x-ui.button variant="outline" icon="arrow-left" class="[&>svg]:rtl-flip" :href="route('dashboard')">Dashboard</x-ui.button>
        </x-slot:actions>
    </x-page-header>

    <x-ui.card :padded="false" class="overflow-hidden">
        <div class="relative grid min-h-[68vh] place-items-center px-6 py-14 text-center">
            {{-- ambient glow --}}
            <div class="pointer-events-none absolute -end-24 -top-24 size-80 rounded-full bg-primary/15 blur-3xl"></div>
            <div class="pointer-events-none absolute -bottom-24 -start-24 size-80 rounded-full bg-sidebar-primary/15 blur-3xl"></div>

            <div x-data="{
                    target: new Date(Date.now() + (18 * 864e5) + (7 * 36e5)),
                    d: '00', h: '00', m: '00', s: '00',
                    pad(n) { return String(Math.max(0, n)).padStart(2, '0') },
                    tick() {
                        const diff = this.target - new Date();
                        if (diff <= 0) { this.d = this.h = this.m = this.s = '00'; return }
                        this.d = this.pad(Math.floor(diff / 864e5));
                        this.h = this.pad(Math.floor(diff / 36e5) % 24);
                        this.m = this.pad(Math.floor(diff / 6e4) % 60);
                        this.s = this.pad(Math.floor(diff / 1e3) % 60);
                    },
                 }"
                 x-init="tick(); setInterval(() => tick(), 1000)"
                 class="relative mx-auto max-w-xl">

                <span class="inline-flex items-center gap-2 rounded-full border border-border bg-card px-3 py-1 text-xs font-semibold shadow-sm">
                    <span class="relative flex size-2"><span class="absolute inline-flex size-2 animate-ping rounded-full bg-primary opacity-75"></span><span class="relative inline-flex size-2 rounded-full bg-primary"></span></span>
                    Launching soon
                </span>

                <span class="mx-auto mt-6 grid size-20 place-items-center rounded-3xl bg-gradient-to-br from-primary to-sidebar-primary text-white shadow-xl shadow-primary/30">
                    <i data-lucide="rocket" class="size-10"></i>
                </span>

                <h1 class="mt-6 text-3xl font-black tracking-tight sm:text-4xl">Something great is on the way</h1>
                <p class="mx-auto mt-3 max-w-md text-muted-foreground">We're putting the finishing touches on the new experience. Leave your email and we'll let you know the moment it's live.</p>

                {{-- Countdown --}}
                <div class="mt-8 flex items-center justify-center gap-3 sm:gap-4">
                    @foreach ([['d','Days'],['h','Hours'],['m','Minutes'],['s','Seconds']] as [$key, $label])
                        <div class="w-[4.5rem] rounded-2xl border border-border bg-card p-3 shadow-sm sm:w-20">
                            <p class="font-mono text-2xl font-bold tabular-nums sm:text-3xl" x-text="{{ $key }}"></p>
                            <p class="mt-0.5 text-[0.65rem] font-semibold uppercase tracking-wide text-muted-foreground">{{ $label }}</p>
                        </div>
                    @endforeach
                </div>

                {{-- Subscribe --}}
                <form @submit.prevent="window.toast('You\'re on the list — we\'ll be in touch!', { variant: 'success' })"
                      class="mx-auto mt-8 flex max-w-md flex-col gap-2 sm:flex-row">
                    <div class="flex-1"><x-ui.input type="email" placeholder="you@company.com" icon="mail" required /></div>
                    <x-ui.button type="submit" icon="bell">Notify me</x-ui.button>
                </form>

                {{-- Socials --}}
                <div class="mt-7 flex items-center justify-center gap-2">
                    @foreach (['twitter','linkedin','github','instagram'] as $ic)
                        <a href="#" class="grid size-10 place-items-center rounded-full border border-border text-muted-foreground transition-colors hover:border-primary hover:text-primary"><i data-lucide="{{ $ic }}" class="size-4"></i></a>
                    @endforeach
                </div>
            </div>
        </div>
    </x-ui.card>
</div>
