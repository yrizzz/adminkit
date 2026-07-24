<div>
    <x-page-header :title="'Sign In'" subtitle="Authentication · sign-in screen">
        <x-slot:actions>
            <x-ui.badge variant="muted">Preview</x-ui.badge>
            <x-ui.button variant="outline" icon="arrow-left" class="[&>svg]:rtl-flip" :href="route('dashboard')">Dashboard</x-ui.button>
        </x-slot:actions>
    </x-page-header>

    <x-ui.card :padded="false" class="overflow-hidden">
        <div class="grid min-h-[68vh] lg:grid-cols-2">
            @include('livewire.pages.content.partials.auth-brand', [
                'brandTitle' => 'Welcome back to AdminKit.',
                'brandText'  => 'Sign in to pick up right where you left off — your dashboards, orders and reports are waiting.',
            ])

            {{-- Form --}}
            <div class="flex items-center justify-center p-6 sm:p-10">
                <div x-data="{ show: false }" class="w-full max-w-sm">
                    <div class="mb-8 text-center lg:text-start">
                        <h1 class="text-2xl font-bold tracking-tight">Welcome back 👋</h1>
                        <p class="mt-1.5 text-sm text-muted-foreground">Sign in to your account to continue.</p>
                    </div>

                    {{-- Social --}}
                    <div class="grid grid-cols-2 gap-3">
                        @foreach ([['Google','chrome'],['GitHub','github']] as [$name,$ic])
                            <button type="button" class="inline-flex h-10 items-center justify-center gap-2 rounded-lg border border-input text-sm font-medium transition-colors hover:bg-accent">
                                <i data-lucide="{{ $ic }}" class="size-4"></i>{{ $name }}
                            </button>
                        @endforeach
                    </div>
                    <div class="my-5 flex items-center gap-3"><div class="h-px flex-1 bg-border"></div><span class="text-xs text-muted-foreground">or continue with email</span><div class="h-px flex-1 bg-border"></div></div>

                    <form @submit.prevent="window.toast('Signed in successfully', { variant: 'success' })" class="space-y-4">
                        <x-ui.input label="Email address" type="email" icon="mail" placeholder="you@example.com" value="admin@adminkit.test" />

                        <div class="space-y-1.5">
                            <div class="flex items-center justify-between">
                                <label class="text-sm font-medium">Password</label>
                                <a href="{{ route('page', ['path' => 'reset-password']) }}" wire:navigate class="text-xs font-medium text-primary hover:underline">Forgot password?</a>
                            </div>
                            <div class="relative">
                                <i data-lucide="lock" class="pointer-events-none absolute inset-y-0 start-0 my-auto ms-3 size-4 text-muted-foreground"></i>
                                <input :type="show ? 'text' : 'password'" value="password" placeholder="••••••••"
                                       class="h-10 w-full rounded-lg border border-input bg-background ps-9 pe-10 text-sm shadow-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring">
                                <button type="button" @click="show = ! show" class="absolute inset-y-0 end-0 grid w-10 place-items-center text-muted-foreground hover:text-foreground">
                                    <i data-lucide="eye" class="size-4" x-show="! show"></i>
                                    <i data-lucide="eye-off" class="size-4" x-show="show" x-cloak></i>
                                </button>
                            </div>
                        </div>

                        <div class="flex items-center justify-between">
                            <label class="flex cursor-pointer items-center gap-2 text-sm"><input type="checkbox" class="size-4 rounded border-input text-primary focus:ring-primary">Remember me</label>
                        </div>

                        <x-ui.button type="submit" class="w-full" size="lg" icon="log-in">Sign in</x-ui.button>
                    </form>

                    <p class="mt-8 text-center text-sm text-muted-foreground">
                        Don't have an account?
                        <a href="{{ route('page', ['path' => 'sign-up']) }}" wire:navigate class="font-semibold text-primary hover:underline">Create one</a>
                    </p>
                </div>
            </div>
        </div>
    </x-ui.card>
</div>
