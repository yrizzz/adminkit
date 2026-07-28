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
                <h1 class="mt-4 text-2xl font-bold tracking-tight">Reset your password</h1>
                <p class="mt-1.5 text-sm text-muted-foreground">Enter your email and we'll send you a password reset link</p>
            </div>

            {{-- Form --}}
            <form @submit.prevent="window.toast('Password reset link sent to your email', { variant: 'success' })" class="space-y-4">
                <x-ui.input label="Email address" type="email" icon="mail" placeholder="you@example.com" value="admin@adminkit.test" required />

                <x-ui.button type="submit" class="w-full" size="lg" icon="send">Send Reset Link</x-ui.button>
            </form>

            <p class="mt-8 text-center text-sm text-muted-foreground">
                Remembered your password?
                <a href="{{ route('page', ['path' => 'sign-in-2']) }}" wire:navigate class="font-semibold text-primary hover:underline">Back to sign in</a>
            </p>
        </div>
    </div>
</div>
