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
            {{-- Brand Logo & Header --}}
            <div class="mb-8 text-center">
                <a href="{{ route('dashboard') }}" wire:navigate class="inline-flex items-center justify-center gap-3">
                    <span class="grid size-12 place-items-center rounded-2xl bg-gradient-to-br from-primary to-sidebar-primary text-white shadow-lg shadow-primary/30">
                        <i data-lucide="gem" class="size-6"></i>
                    </span>
                </a>
                <h1 class="mt-4 text-2xl font-bold tracking-tight">Sign in to AdminKit</h1>
                <p class="mt-1.5 text-sm text-muted-foreground">Enter your credentials to access your dashboard</p>
            </div>

            {{-- Demo Credentials Notice --}}
            <div class="mb-6 flex items-center gap-3 rounded-xl border border-dashed border-primary/40 bg-primary/5 p-3 text-sm">
                <i data-lucide="key-round" class="size-5 shrink-0 text-primary"></i>
                <div class="flex-1">
                    <p class="text-xs font-semibold text-primary uppercase tracking-wider">Demo Credentials</p>
                    <p class="text-xs text-muted-foreground">admin@adminkit.test · password</p>
                </div>
            </div>

            {{-- Form --}}
            <form @submit.prevent="window.toast('Signed in successfully', { variant: 'success' })" class="space-y-4" x-data="{ show: false }">
                <x-ui.input label="Email address" type="email" icon="mail" placeholder="you@example.com" value="admin@adminkit.test" required />

                <div class="space-y-1.5">
                    <div class="flex items-center justify-between">
                        <label class="text-sm font-medium">Password</label>
                        <a href="{{ route('page', ['path' => 'reset-password-2']) }}" wire:navigate class="text-xs font-medium text-primary hover:underline">Forgot password?</a>
                    </div>
                    <div class="relative">
                        <i data-lucide="lock" class="pointer-events-none absolute inset-y-0 start-0 my-auto ms-3 size-4 text-muted-foreground"></i>
                        <input :type="show ? 'text' : 'password'" value="password" placeholder="••••••••" required
                               class="h-10 w-full rounded-lg border border-input bg-background ps-9 pe-10 text-sm shadow-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring">
                        <button type="button" @click="show = ! show" class="absolute inset-y-0 end-0 grid w-10 place-items-center text-muted-foreground hover:text-foreground">
                            <i data-lucide="eye" class="size-4" x-show="! show"></i>
                            <i data-lucide="eye-off" class="size-4" x-show="show" x-cloak></i>
                        </button>
                    </div>
                </div>

                <div class="flex items-center justify-between pt-1">
                    <label class="flex cursor-pointer items-center gap-2 text-sm">
                        <input type="checkbox" checked class="size-4 rounded border-input text-primary focus:ring-primary">
                        <span class="text-muted-foreground">Remember me for 30 days</span>
                    </label>
                </div>

                <x-ui.button type="submit" class="w-full" size="lg" icon="log-in">Sign in</x-ui.button>
            </form>

            <div class="my-6 flex items-center gap-3 text-xs text-muted-foreground">
                <span class="h-px flex-1 bg-border"></span>OR CONTINUE WITH<span class="h-px flex-1 bg-border"></span>
            </div>

            <div class="grid grid-cols-2 gap-3">
                <x-ui.button variant="outline" type="button" @click="window.toast('Social login is a demo', {variant:'info'})"><i data-lucide="chrome"></i> Google</x-ui.button>
                <x-ui.button variant="outline" type="button" @click="window.toast('Social login is a demo', {variant:'info'})"><i data-lucide="github"></i> GitHub</x-ui.button>
            </div>

            <p class="mt-8 text-center text-sm text-muted-foreground">
                Don't have an account?
                <a href="{{ route('page', ['path' => 'sign-up-2']) }}" wire:navigate class="font-semibold text-primary hover:underline">Create an account</a>
            </p>
        </div>
    </div>
</div>
