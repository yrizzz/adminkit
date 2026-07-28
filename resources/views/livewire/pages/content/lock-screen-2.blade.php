<div>
    <div class="relative flex min-h-screen items-center justify-center p-4 sm:p-6 lg:p-8">
        {{-- Ambient background gradient circles & grid --}}
        <div class="pointer-events-none absolute inset-0 overflow-hidden">
            <div class="absolute -start-40 -top-40 size-[32rem] rounded-full bg-primary/20 blur-[120px]"></div>
            <div class="absolute -bottom-40 -end-40 size-[32rem] rounded-full bg-sidebar-primary/25 blur-[120px]"></div>
            <div class="absolute inset-0 opacity-[0.03] dark:opacity-[0.05]"
                 style="background-image: linear-gradient(currentColor 1px, transparent 1px), linear-gradient(90deg, currentColor 1px, transparent 1px); background-size: 32px 32px;"></div>
        </div>

        {{-- Centered Auth Card --}}
        <div class="relative z-10 w-full max-w-md rounded-2xl border border-border/80 bg-card/90 p-8 shadow-2xl backdrop-blur-xl">
            {{-- User Avatar & Header --}}
            <div class="mb-8 text-center">
                <div class="relative mx-auto mb-4 size-20">
                    <x-ui.avatar :name="auth()->user()?->name ?? 'Yrizzz'" size="xl" status="online" class="size-20 text-2xl shadow-xl ring-4 ring-primary/20" />
                </div>
                <h1 class="text-2xl font-bold tracking-tight">{{ auth()->user()?->name ?? 'Yrizzz' }}</h1>
                <p class="mt-1 text-sm text-muted-foreground">Session locked — enter password to unlock</p>
            </div>

            {{-- Form --}}
            <form @submit.prevent="window.toast('Screen unlocked', { variant: 'success' })" class="space-y-4" x-data="{ show: false }">
                <div class="space-y-1.5">
                    <label class="text-sm font-medium">Password</label>
                    <div class="relative">
                        <i data-lucide="lock" class="pointer-events-none absolute inset-y-0 start-0 my-auto ms-3 size-4 text-muted-foreground"></i>
                        <input :type="show ? 'text' : 'password'" value="password" placeholder="••••••••" required autofocus
                               class="h-10 w-full rounded-lg border border-input bg-background ps-9 pe-10 text-sm shadow-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring">
                        <button type="button" @click="show = ! show" class="absolute inset-y-0 end-0 grid w-10 place-items-center text-muted-foreground hover:text-foreground">
                            <i data-lucide="eye" class="size-4" x-show="! show"></i>
                            <i data-lucide="eye-off" class="size-4" x-show="show" x-cloak></i>
                        </button>
                    </div>
                </div>

                <x-ui.button type="submit" class="w-full" size="lg" icon="key-round">Unlock Screen</x-ui.button>
            </form>

            <p class="mt-8 text-center text-sm text-muted-foreground">
                Not {{ auth()->user()?->name ?? 'Yrizzz' }}?
                <a href="{{ route('page', ['path' => 'sign-in-2']) }}" wire:navigate class="font-semibold text-primary hover:underline">Switch account</a>
            </p>
        </div>
    </div>
</div>
