<div>
    <div class="mb-8 text-center lg:text-start">
        <h1 class="text-2xl font-bold tracking-tight">Create your account</h1>
        <p class="mt-1.5 text-sm text-muted-foreground">Start building with {{ config('adminkit.name') }} today.</p>
    </div>

    <form wire:submit="register" class="space-y-4" x-data="{ show: false }">
        <x-ui.input label="Full name" name="name" wire:model="name" icon="user" placeholder="Aisha Rahman" autofocus required />
        <x-ui.input label="Email address" name="email" wire:model="email" type="email" icon="mail" placeholder="you@example.com" required />

        <div class="space-y-1.5">
            <label for="password" class="text-sm font-medium">Password</label>
            <div class="relative">
                <span class="pointer-events-none absolute inset-y-0 start-0 flex items-center ps-3 text-muted-foreground"><i data-lucide="lock" class="size-4"></i></span>
                <input id="password" wire:model="password" :type="show ? 'text' : 'password'" placeholder="At least 8 characters" required
                       class="flex h-10 w-full rounded-lg border {{ $errors->has('password') ? 'border-destructive' : 'border-input' }} bg-background px-3 ps-9 pe-10 text-sm shadow-sm placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring">
                <button type="button" @click="show = !show" class="absolute inset-y-0 end-0 flex items-center pe-3 text-muted-foreground hover:text-foreground">
                    <i data-lucide="eye" class="size-4" x-show="!show"></i>
                    <i data-lucide="eye-off" class="size-4" x-show="show" x-cloak></i>
                </button>
            </div>
            @error('password')<p class="flex items-center gap-1 text-xs font-medium text-destructive"><i data-lucide="circle-alert" class="size-3.5"></i>{{ $message }}</p>@enderror
        </div>

        <x-ui.input label="Confirm password" name="password_confirmation" wire:model="password_confirmation" type="password" icon="lock" placeholder="Repeat your password" required />

        <label class="flex cursor-pointer items-start gap-2 text-sm">
            <input type="checkbox" wire:model="terms" required class="mt-0.5 size-4 rounded border-input text-primary focus:ring-primary">
            <span class="text-muted-foreground">I agree to the <a href="#" class="font-medium text-primary hover:underline">Terms of Service</a> and <a href="#" class="font-medium text-primary hover:underline">Privacy Policy</a>.</span>
        </label>
        @error('terms')<p class="text-xs font-medium text-destructive">{{ $message }}</p>@enderror

        <x-ui.button type="submit" class="w-full" size="lg">
            <span wire:loading.remove wire:target="register">Create account</span>
            <span wire:loading wire:target="register">Creating…</span>
            <i data-lucide="arrow-right" class="rtl-flip" wire:loading.remove wire:target="register"></i>
        </x-ui.button>
    </form>

    <p class="mt-8 text-center text-sm text-muted-foreground">
        Already have an account?
        <a href="{{ route('login') }}" wire:navigate class="font-semibold text-primary hover:underline">Sign in</a>
    </p>
</div>
