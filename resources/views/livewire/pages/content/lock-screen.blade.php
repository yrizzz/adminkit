<div>
    <x-page-header :title="'Lock Screen'" subtitle="Authentication · session locked, re-enter password">
        <x-slot:actions>
            <x-ui.button variant="outline" icon="arrow-left" class="[&>svg]:rtl-flip" :href="route('dashboard')">Dashboard</x-ui.button>
        </x-slot:actions>
    </x-page-header>

    <x-ui.card :padded="false" class="overflow-hidden">
        <div class="relative grid min-h-[68vh] place-items-center px-6 py-14">
            <div class="pointer-events-none absolute inset-0 bg-gradient-to-br from-primary/5 via-transparent to-sidebar-primary/10"></div>

            <div x-data="{
                    show: false, pw: '',
                    time: '', date: '',
                    clock() {
                        const n = new Date();
                        this.time = n.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
                        this.date = n.toLocaleDateString([], { weekday: 'long', day: 'numeric', month: 'long' });
                    },
                    unlock() {
                        if (! this.pw) { window.toast('Enter your password to unlock', { variant: 'warning' }); return }
                        window.toast('Welcome back, Yrizzz 👋', { variant: 'success' });
                        this.pw = '';
                    },
                 }"
                 x-init="clock(); setInterval(() => clock(), 1000)"
                 class="relative w-full max-w-sm text-center">

                {{-- Clock --}}
                <p class="font-mono text-5xl font-bold tabular-nums tracking-tight" x-text="time"></p>
                <p class="mt-1 text-sm text-muted-foreground" x-text="date"></p>

                {{-- Avatar + identity --}}
                <div class="mt-8 flex flex-col items-center">
                    <span class="relative">
                        <img src="https://api.dicebear.com/9.x/avataaars/svg?seed=Yrizzz&backgroundColor=b6e3f4,c0aede,d1d4f9" alt="" class="size-24 rounded-full bg-muted ring-4 ring-card shadow-lg" />
                        <span class="absolute -end-1 -bottom-1 grid size-8 place-items-center rounded-full border-4 border-card bg-muted text-muted-foreground">
                            <i data-lucide="lock" class="size-3.5"></i>
                        </span>
                    </span>
                    <h2 class="mt-4 text-lg font-bold">Yrizzz</h2>
                    <p class="text-sm text-muted-foreground">admin@adminkit.test</p>
                </div>

                {{-- Unlock form --}}
                <form @submit.prevent="unlock()" class="mt-6 space-y-3 text-start">
                    <div class="relative">
                        <i data-lucide="lock" class="pointer-events-none absolute inset-y-0 start-0 my-auto ms-3 size-4 text-muted-foreground"></i>
                        <input x-model="pw" :type="show ? 'text' : 'password'" placeholder="Enter your password"
                               class="h-11 w-full rounded-lg border border-input bg-background ps-9 pe-10 text-sm shadow-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring" />
                        <button type="button" @click="show = ! show" class="absolute inset-y-0 end-0 grid w-10 place-items-center text-muted-foreground hover:text-foreground">
                            <i data-lucide="eye" class="size-4" x-show="! show"></i>
                            <i data-lucide="eye-off" class="size-4" x-show="show" x-cloak></i>
                        </button>
                    </div>
                    <x-ui.button type="submit" class="w-full" size="lg" icon="unlock">Unlock</x-ui.button>
                </form>

                <p class="mt-5 text-sm text-muted-foreground">
                    Not you? <a href="{{ route('login') }}" wire:navigate class="font-medium text-primary hover:underline">Sign in as a different user</a>
                </p>
            </div>
        </div>
    </x-ui.card>
</div>
