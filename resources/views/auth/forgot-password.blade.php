<x-layouts.guest title="Reset password">
    <a href="{{ route('login') }}" class="mb-6 inline-flex items-center gap-1.5 text-sm font-medium text-muted-foreground hover:text-foreground">
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

    <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
        @csrf
        <x-ui.input label="Email address" name="email" type="email" icon="mail" :value="old('email')" placeholder="you@example.com" autofocus required />
        <x-ui.button type="submit" class="w-full" size="lg">Send reset link <i data-lucide="send" class="rtl-flip"></i></x-ui.button>
    </form>

    <p class="mt-8 text-center text-sm text-muted-foreground">
        Remember it now?
        <a href="{{ route('login') }}" class="font-semibold text-primary hover:underline">Sign in</a>
    </p>
</x-layouts.guest>
