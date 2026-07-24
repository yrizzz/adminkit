<div>
    <x-page-header :title="'Sign Up'" subtitle="Authentication · account registration screen">
        <x-slot:actions>
            <x-ui.badge variant="muted">Preview</x-ui.badge>
            <x-ui.button variant="outline" icon="arrow-left" class="[&>svg]:rtl-flip" :href="route('dashboard')">Dashboard</x-ui.button>
        </x-slot:actions>
    </x-page-header>

    <x-ui.card :padded="false" class="overflow-hidden">
        <div class="grid min-h-[68vh] lg:grid-cols-2">
            @include('livewire.pages.content.partials.auth-brand', [
                'brandTitle'  => 'Start building in minutes.',
                'brandText'   => 'Create your free account — no credit card required, and you can invite your whole team later.',
                'brandPoints' => ['Free 14-day trial', 'Unlimited projects on Pro', 'Cancel anytime'],
            ])

            <div class="flex items-center justify-center p-6 sm:p-10">
                <div x-data="{
                        show: false, pw: '',
                        get score() {
                            let s = 0;
                            if (this.pw.length >= 8) s++;
                            if (/[A-Z]/.test(this.pw)) s++;
                            if (/[0-9]/.test(this.pw)) s++;
                            if (/[^A-Za-z0-9]/.test(this.pw)) s++;
                            return s;
                        },
                        get label() { return ['Too short', 'Weak', 'Fair', 'Good', 'Strong'][this.score] },
                        get tone() { return ['bg-muted','bg-destructive','bg-[hsl(var(--warning))]','bg-info','bg-success'][this.score] },
                     }" class="w-full max-w-sm">

                    <div class="mb-7 text-center lg:text-start">
                        <h1 class="text-2xl font-bold tracking-tight">Create your account</h1>
                        <p class="mt-1.5 text-sm text-muted-foreground">Get started free — takes less than a minute.</p>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        @foreach ([['Google','chrome'],['GitHub','github']] as [$name,$ic])
                            <button type="button" class="inline-flex h-10 items-center justify-center gap-2 rounded-lg border border-input text-sm font-medium transition-colors hover:bg-accent"><i data-lucide="{{ $ic }}" class="size-4"></i>{{ $name }}</button>
                        @endforeach
                    </div>
                    <div class="my-5 flex items-center gap-3"><div class="h-px flex-1 bg-border"></div><span class="text-xs text-muted-foreground">or sign up with email</span><div class="h-px flex-1 bg-border"></div></div>

                    <form @submit.prevent="window.toast('Account created — welcome aboard!', { variant: 'success' })" class="space-y-4">
                        <x-ui.input label="Full name" icon="user" placeholder="Yrizzz" />
                        <x-ui.input label="Email address" type="email" icon="mail" placeholder="you@company.com" />

                        <div class="space-y-1.5">
                            <label class="text-sm font-medium">Password</label>
                            <div class="relative">
                                <i data-lucide="lock" class="pointer-events-none absolute inset-y-0 start-0 my-auto ms-3 size-4 text-muted-foreground"></i>
                                <input x-model="pw" :type="show ? 'text' : 'password'" placeholder="Create a strong password"
                                       class="h-10 w-full rounded-lg border border-input bg-background ps-9 pe-10 text-sm shadow-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring">
                                <button type="button" @click="show = ! show" class="absolute inset-y-0 end-0 grid w-10 place-items-center text-muted-foreground hover:text-foreground">
                                    <i data-lucide="eye" class="size-4" x-show="! show"></i>
                                    <i data-lucide="eye-off" class="size-4" x-show="show" x-cloak></i>
                                </button>
                            </div>
                            {{-- strength meter --}}
                            <div x-show="pw.length" x-cloak class="pt-1">
                                <div class="flex gap-1">
                                    <template x-for="i in 4" :key="i">
                                        <span class="h-1 flex-1 rounded-full transition-colors" :class="i <= score ? tone : 'bg-muted'"></span>
                                    </template>
                                </div>
                                <p class="mt-1 text-xs text-muted-foreground">Strength: <span class="font-medium text-foreground" x-text="label"></span></p>
                            </div>
                        </div>

                        <label class="flex cursor-pointer items-start gap-2 text-sm text-muted-foreground">
                            <input type="checkbox" class="mt-0.5 size-4 rounded border-input text-primary focus:ring-primary">
                            <span>I agree to the <a href="{{ route('page', ['path' => 'terms-conditions']) }}" wire:navigate class="font-medium text-primary hover:underline">Terms</a> and <a href="#" class="font-medium text-primary hover:underline">Privacy Policy</a>.</span>
                        </label>

                        <x-ui.button type="submit" class="w-full" size="lg" icon="user-plus">Create account</x-ui.button>
                    </form>

                    <p class="mt-7 text-center text-sm text-muted-foreground">
                        Already have an account?
                        <a href="{{ route('page', ['path' => 'sign-in']) }}" wire:navigate class="font-semibold text-primary hover:underline">Sign in</a>
                    </p>
                </div>
            </div>
        </div>
    </x-ui.card>
</div>
