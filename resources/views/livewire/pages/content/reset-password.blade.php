<div>

        <div class="grid min-h-screen lg:grid-cols-2">
            @include('livewire.pages.content.partials.auth-brand', [
                'brandTitle'  => 'Choose a new password.',
                'brandText'   => 'For your security the reset link expires in 60 minutes and can only be used once.',
                'brandPoints' => ['Link expires in 60 minutes', 'Single-use reset token', 'All other sessions signed out'],
            ])

            <div class="flex items-center justify-center p-6 sm:p-10">
                <div x-data="{
                        show: false, pw: '', confirm: '',
                        get rules() {
                            return [
                                { t: 'At least 8 characters',     ok: this.pw.length >= 8 },
                                { t: 'One uppercase letter',      ok: /[A-Z]/.test(this.pw) },
                                { t: 'One number',                ok: /[0-9]/.test(this.pw) },
                                { t: 'One special character',     ok: /[^A-Za-z0-9]/.test(this.pw) },
                            ];
                        },
                        get score() { return this.rules.filter(r => r.ok).length },
                        get tone() { return ['bg-muted','bg-destructive','bg-[hsl(var(--warning))]','bg-info','bg-success'][this.score] },
                        get label() { return ['Too short','Weak','Fair','Good','Strong'][this.score] },
                        get matches() { return this.confirm.length > 0 && this.pw === this.confirm },
                        get valid() { return this.score === 4 && this.matches },
                        submit() {
                            if (! this.valid) { window.toast('Password does not meet the requirements', { variant: 'destructive' }); return }
                            window.toast('Password reset — you can sign in now', { variant: 'success' });
                        },
                     }" class="w-full max-w-sm">

                    <a href="{{ route('page', ['path' => 'sign-in']) }}" wire:navigate class="mb-6 inline-flex items-center gap-1.5 text-sm font-medium text-muted-foreground hover:text-foreground">
                        <i data-lucide="arrow-left" class="rtl-flip size-4"></i> Back to sign in
                    </a>

                    <span class="mb-4 grid size-12 place-items-center rounded-2xl bg-primary/10 text-primary"><i data-lucide="key-round" class="size-6"></i></span>
                    <h1 class="text-2xl font-bold tracking-tight">Reset your password</h1>
                    <p class="mt-1.5 text-sm text-muted-foreground">Resetting for <span class="font-medium text-foreground">admin@adminkit.test</span>. Choose something you haven't used before.</p>

                    <form @submit.prevent="submit()" class="mt-6 space-y-4">
                        {{-- new password --}}
                        <div class="space-y-1.5">
                            <label class="text-sm font-medium">New password</label>
                            <div class="relative">
                                <i data-lucide="lock" class="pointer-events-none absolute inset-y-0 start-0 my-auto ms-3 size-4 text-muted-foreground"></i>
                                <input x-model="pw" :type="show ? 'text' : 'password'" placeholder="Enter a new password"
                                       class="h-10 w-full rounded-lg border border-input bg-background ps-9 pe-10 text-sm shadow-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring">
                                <button type="button" @click="show = ! show" class="absolute inset-y-0 end-0 grid w-10 place-items-center text-muted-foreground hover:text-foreground">
                                    <i data-lucide="eye" class="size-4" x-show="! show"></i>
                                    <i data-lucide="eye-off" class="size-4" x-show="show" x-cloak></i>
                                </button>
                            </div>
                            <div x-show="pw.length" x-cloak class="pt-1">
                                <div class="flex gap-1">
                                    <template x-for="i in 4" :key="i"><span class="h-1 flex-1 rounded-full transition-colors" :class="i <= score ? tone : 'bg-muted'"></span></template>
                                </div>
                                <p class="mt-1 text-xs text-muted-foreground">Strength: <span class="font-medium text-foreground" x-text="label"></span></p>
                            </div>
                        </div>

                        {{-- confirm --}}
                        <div class="space-y-1.5">
                            <label class="text-sm font-medium">Confirm password</label>
                            <div class="relative">
                                <i data-lucide="lock" class="pointer-events-none absolute inset-y-0 start-0 my-auto ms-3 size-4 text-muted-foreground"></i>
                                <input x-model="confirm" :type="show ? 'text' : 'password'" placeholder="Re-enter the password"
                                       class="h-10 w-full rounded-lg border bg-background ps-9 pe-10 text-sm shadow-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring"
                                       :class="confirm.length && ! matches ? 'border-destructive' : 'border-input'">
                            </div>
                            <p x-show="confirm.length && ! matches" x-cloak class="flex items-center gap-1 text-xs font-medium text-destructive"><i data-lucide="circle-alert" class="size-3.5"></i>Passwords don't match</p>
                        </div>

                        {{-- requirements --}}
                        <div class="rounded-xl border border-border bg-muted/30 p-3">
                            <p class="mb-2 text-xs font-semibold uppercase tracking-wide text-muted-foreground">Requirements</p>
                            <ul class="space-y-1.5">
                                <template x-for="r in rules" :key="r.t">
                                    <li class="flex items-center gap-2 text-sm" :class="r.ok ? 'text-success' : 'text-muted-foreground'">
                                        <span class="grid size-4 shrink-0 place-items-center rounded-full text-[0.6rem]" :class="r.ok ? 'bg-success/15' : 'bg-muted'" x-text="r.ok ? '✓' : '•'"></span>
                                        <span x-text="r.t"></span>
                                    </li>
                                </template>
                            </ul>
                        </div>

                        <x-ui.button type="submit" class="w-full" size="lg" icon="check" ::disabled="! valid">Reset password</x-ui.button>
                    </form>
                </div>
            </div>
        </div>
</div>
