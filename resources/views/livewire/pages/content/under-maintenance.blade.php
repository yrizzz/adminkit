<div>

        <div class="relative grid min-h-screen place-items-center px-6 py-14 text-center">
            <div class="pointer-events-none absolute -start-24 -top-24 size-80 rounded-full bg-warning/15 blur-3xl"></div>
            <div class="pointer-events-none absolute -bottom-24 -end-24 size-80 rounded-full bg-primary/10 blur-3xl"></div>

            <div class="relative mx-auto max-w-xl">
                <span class="mx-auto grid size-20 place-items-center rounded-3xl bg-warning/15 text-[hsl(var(--warning))]">
                    <i data-lucide="wrench" class="size-10"></i>
                </span>

                <h1 class="mt-6 text-3xl font-black tracking-tight sm:text-4xl">We'll be right back</h1>
                <p class="mx-auto mt-3 max-w-md text-muted-foreground">
                    We're performing scheduled maintenance to make things faster and more reliable. The dashboard will be available again shortly.
                </p>

                {{-- Progress --}}
                <div x-data="{ pct: 68 }" class="mx-auto mt-8 max-w-sm">
                    <div class="mb-1.5 flex items-center justify-between text-xs font-medium">
                        <span class="text-muted-foreground">Upgrade progress</span>
                        <span class="font-semibold" x-text="pct + '%'"></span>
                    </div>
                    <div class="h-2.5 overflow-hidden rounded-full bg-muted">
                        <div class="h-full rounded-full bg-gradient-to-r from-[hsl(var(--warning))] to-primary transition-all duration-700" :style="`width: ${pct}%`"></div>
                    </div>
                </div>

                {{-- Meta --}}
                <div class="mx-auto mt-8 grid max-w-md grid-cols-1 gap-3 sm:grid-cols-3">
                    @foreach ([['clock','Started','09:00 WIB'],['timer','Est. duration','~45 min'],['calendar-check','Back by','09:45 WIB']] as [$ic,$label,$val])
                        <div class="rounded-xl border border-border bg-card p-3">
                            <i data-lucide="{{ $ic }}" class="mx-auto size-4 text-muted-foreground"></i>
                            <p class="mt-1.5 text-xs text-muted-foreground">{{ $label }}</p>
                            <p class="text-sm font-semibold">{{ $val }}</p>
                        </div>
                    @endforeach
                </div>

                <div class="mt-8 flex flex-wrap items-center justify-center gap-3">
                    <x-ui.button icon="rotate-cw" onclick="window.location.reload()">Try again</x-ui.button>
                    <x-ui.button variant="outline" icon="activity">Status page</x-ui.button>
                </div>

                <p class="mt-6 text-sm text-muted-foreground">
                    Need help right now? <a href="#" class="font-medium text-primary hover:underline">Contact support</a>
                </p>
            </div>
        </div>
</div>
