<div>
    <div class="mb-8 text-center lg:text-start">
        <h1 class="text-2xl font-bold tracking-tight">Welcome back 👋</h1>
        <p class="mt-1.5 text-sm text-muted-foreground">Sign in to your account to continue.</p>
    </div>

    @if (session('status'))
        <x-ui.alert variant="success" class="mb-4">{{ session('status') }}</x-ui.alert>
    @endif

    <div class="mb-5 flex items-center gap-3 rounded-xl border border-dashed border-primary/40 bg-primary/5 p-3 text-sm">
        <i data-lucide="key-round" class="size-5 shrink-0 text-primary"></i>
        <div class="flex-1">
            <p class="font-medium">Demo credentials</p>
            <p class="text-muted-foreground">admin@adminkit.test · password</p>
        </div>
        <button type="button" wire:click="$set('email', 'admin@adminkit.test')" x-on:click="$wire.set('password', 'password')"
                class="shrink-0 rounded-lg bg-primary/10 px-2.5 py-1 text-xs font-semibold text-primary hover:bg-primary/20">Fill</button>
    </div>

    <form wire:submit="login" class="space-y-4" x-data="{ show: false }">
        <x-ui.input label="Email address" name="email" wire:model="email" type="email" icon="mail" placeholder="you@example.com" autofocus required />

        <div class="space-y-1.5">
            <div class="flex items-center justify-between">
                <label for="password" class="text-sm font-medium">Password</label>
                <a href="{{ route('password.request') }}" wire:navigate class="text-xs font-medium text-primary hover:underline">Forgot password?</a>
            </div>
            <div class="relative">
                <span class="pointer-events-none absolute inset-y-0 start-0 flex items-center ps-3 text-muted-foreground"><i data-lucide="lock" class="size-4"></i></span>
                <input id="password" wire:model="password" :type="show ? 'text' : 'password'" placeholder="••••••••" required
                       class="flex h-10 w-full rounded-lg border {{ $errors->has('email') ? 'border-destructive' : 'border-input' }} bg-background px-3 ps-9 pe-10 text-sm shadow-sm placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-1 focus-visible:ring-offset-background">
                <button type="button" @click="show = !show" class="absolute inset-y-0 end-0 flex items-center pe-3 text-muted-foreground hover:text-foreground">
                    <i data-lucide="eye" class="size-4" x-show="!show"></i>
                    <i data-lucide="eye-off" class="size-4" x-show="show" x-cloak></i>
                </button>
            </div>
            @error('email')<p class="flex items-center gap-1 text-xs font-medium text-destructive"><i data-lucide="circle-alert" class="size-3.5"></i>{{ $message }}</p>@enderror
        </div>

        <label class="flex cursor-pointer items-center gap-2 text-sm">
            <input type="checkbox" wire:model="remember" class="size-4 rounded border-input text-primary focus:ring-primary">
            <span class="text-muted-foreground">Remember me for 30 days</span>
        </label>

        <x-ui.button type="submit" class="w-full" size="lg">
            <span wire:loading.remove wire:target="login">Sign in</span>
            <span wire:loading wire:target="login">Signing in…</span>
            <i data-lucide="arrow-right" class="rtl-flip" wire:loading.remove wire:target="login"></i>
        </x-ui.button>
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
        <a href="{{ route('register') }}" wire:navigate class="font-semibold text-primary hover:underline">Create one</a>
    </p>
</div>
