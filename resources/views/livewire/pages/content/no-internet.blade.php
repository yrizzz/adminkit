<div>

        <div class="relative grid min-h-screen place-items-center px-6 py-14 text-center">
            <div class="pointer-events-none absolute -end-24 -top-24 size-80 rounded-full bg-destructive/10 blur-3xl"></div>

            <div x-data="{
                    online: navigator.onLine,
                    checking: false,
                    retry() {
                        this.checking = true;
                        setTimeout(() => {
                            this.checking = false;
                            this.online = navigator.onLine;
                            this.online
                                ? window.toast('You\'re back online 🎉', { variant: 'success' })
                                : window.toast('Still offline — check your connection', { variant: 'destructive' });
                        }, 900);
                    },
                 }"
                 x-init="window.addEventListener('online', () => online = true); window.addEventListener('offline', () => online = false)"
                 class="relative mx-auto max-w-lg">

                <span class="mx-auto grid size-20 place-items-center rounded-3xl transition-colors"
                      :class="online ? 'bg-success/15 text-success' : 'bg-destructive/10 text-destructive'">
                    <i data-lucide="wifi-off" class="size-10" x-show="! online"></i>
                    <i data-lucide="wifi" class="size-10" x-show="online" x-cloak></i>
                </span>

                <h1 class="mt-6 text-3xl font-black tracking-tight sm:text-4xl" x-text="online ? 'You\'re back online' : 'No internet connection'"></h1>
                <p class="mx-auto mt-3 max-w-md text-muted-foreground" x-text="online
                    ? 'Your connection has been restored. You can continue where you left off.'
                    : 'We can\'t reach the server right now. Your changes are saved locally and will sync once you\'re back.'"></p>

                {{-- Live status pill --}}
                <div class="mt-5 inline-flex items-center gap-2 rounded-full border border-border bg-card px-3 py-1.5 text-xs font-semibold">
                    <span class="relative flex size-2">
                        <span class="absolute inline-flex size-2 animate-ping rounded-full opacity-75" :class="online ? 'bg-success' : 'bg-destructive'"></span>
                        <span class="relative inline-flex size-2 rounded-full" :class="online ? 'bg-success' : 'bg-destructive'"></span>
                    </span>
                    <span x-text="online ? 'Connected' : 'Offline'"></span>
                </div>

                {{-- Troubleshooting --}}
                <div class="mx-auto mt-8 max-w-sm space-y-2 text-start">
                    @foreach ([['router','Check your router or Wi-Fi is on'],['plane','Make sure airplane mode is off'],['refresh-cw','Reconnect, then retry the request']] as [$ic,$tip])
                        <div class="flex items-center gap-3 rounded-xl border border-border bg-card px-3 py-2.5 text-sm">
                            <span class="grid size-8 shrink-0 place-items-center rounded-lg bg-muted text-muted-foreground"><i data-lucide="{{ $ic }}" class="size-4"></i></span>
                            {{ $tip }}
                        </div>
                    @endforeach
                </div>

                <div class="mt-8 flex flex-wrap items-center justify-center gap-3">
                    <x-ui.button size="lg" icon="rotate-cw" @click="retry()" ::disabled="checking">
                        <span x-show="! checking">Try again</span>
                        <span x-show="checking" x-cloak>Checking…</span>
                    </x-ui.button>
                    <x-ui.button variant="outline" size="lg" icon="house" :href="route('dashboard')" wire:navigate>Go to dashboard</x-ui.button>
                </div>
            </div>
        </div>
</div>
