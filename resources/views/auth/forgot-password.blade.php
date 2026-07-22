<div>
    <a href="{{ route('login') }}" wire:navigate class="mb-6 inline-flex items-center gap-1.5 text-sm font-medium text-muted-foreground hover:text-foreground">
        <i data-lucide="arrow-left" class="rtl-flip size-4"></i> Back to sign in
    </a>

    <div class="mb-8">
        <span class="mb-4 grid size-12 place-items-center rounded-2xl bg-primary/10 text-primary"><i data-lucide="key-round" class="size-6"></i></span>
        <h1 class="text-2xl font-bold tracking-tight">Forgot your password?</h1>
        <p class="mt-1.5 text-sm text-muted-foreground">Enter your email and we'll send you a reset link.</p>
    </div>

    @if (session('status'))
        <x-ui.alert variant="success" class="mb-4">{{ session('status') }}</x-ui.alert>
    @endif

    <form wire:submit="sendReset" class="space-y-4">
        <x-ui.input label="Email address" name="email" wire:model="email" type="email" icon="mail" placeholder="you@example.com" autofocus required />
        <x-ui.button type="submit" class="w-full" size="lg">
            <span wire:loading.remove wire:target="sendReset">Send reset link</span>
            <span wire:loading wire:target="sendReset">Sending…</span>
            <i data-lucide="send" class="rtl-flip" wire:loading.remove wire:target="sendReset"></i>
        </x-ui.button>
    </form>

    <p class="mt-8 text-center text-sm text-muted-foreground">
        Remember it now?
        <a href="{{ route('login') }}" wire:navigate class="font-semibold text-primary hover:underline">Sign in</a>
    </p>
</div>
