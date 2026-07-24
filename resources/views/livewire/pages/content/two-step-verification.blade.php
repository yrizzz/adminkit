<div>
    <x-page-header :title="'Two Step Verification'" subtitle="Authentication · one-time code entry">
        <x-slot:actions>
            <x-ui.button variant="outline" icon="arrow-left" class="[&>svg]:rtl-flip" :href="route('dashboard')">Dashboard</x-ui.button>
        </x-slot:actions>
    </x-page-header>

    <x-ui.card :padded="false" class="overflow-hidden">
        <div class="relative grid min-h-[68vh] place-items-center px-6 py-14">
            <div class="pointer-events-none absolute -end-24 -top-24 size-80 rounded-full bg-primary/10 blur-3xl"></div>

            <div x-data="{
                    code: ['', '', '', '', '', ''],
                    left: 30,
                    get filled() { return this.code.every(c => c !== '') },
                    onInput(i, e) {
                        const v = e.target.value.replace(/\D/g, '').slice(-1);
                        this.code[i] = v; e.target.value = v;
                        if (v && i < 5) e.target.parentElement.children[i + 1].focus();
                        if (this.filled) this.verify();
                    },
                    onKey(i, e) {
                        if (e.key === 'Backspace' && ! this.code[i] && i > 0) e.target.parentElement.children[i - 1].focus();
                    },
                    onPaste(e) {
                        const digits = (e.clipboardData.getData('text') || '').replace(/\D/g, '').slice(0, 6).split('');
                        if (! digits.length) return;
                        e.preventDefault();
                        const boxes = e.target.parentElement.children;
                        digits.forEach((d, i) => { this.code[i] = d; boxes[i].value = d });
                        boxes[Math.min(digits.length, 5)].focus();
                        if (this.filled) this.verify();
                    },
                    verify() { window.toast('Code verified — welcome back!', { variant: 'success' }) },
                    resend() { if (this.left > 0) return; this.left = 30; window.toast('A new code is on its way'); },
                 }"
                 x-init="setInterval(() => { if (left > 0) left-- }, 1000)"
                 class="relative w-full max-w-md text-center">

                <span class="mx-auto grid size-16 place-items-center rounded-2xl bg-primary/10 text-primary">
                    <i data-lucide="shield-check" class="size-8"></i>
                </span>

                <h1 class="mt-5 text-2xl font-bold tracking-tight">Two-step verification</h1>
                <p class="mx-auto mt-2 max-w-sm text-sm text-muted-foreground">
                    We sent a 6-digit code to <span class="font-medium text-foreground">•••• ••89</span>. Enter it below to continue.
                </p>

                {{-- OTP boxes --}}
                <div class="mt-7 flex items-center justify-center gap-2 sm:gap-3" @paste="onPaste($event)">
                    @for ($i = 0; $i < 6; $i++)
                        <input type="text" inputmode="numeric" maxlength="1" autocomplete="one-time-code"
                               @input="onInput({{ $i }}, $event)" @keydown="onKey({{ $i }}, $event)"
                               @if ($i === 0) autofocus @endif
                               class="size-12 rounded-xl border border-input bg-background text-center font-mono text-xl font-bold shadow-sm transition focus-visible:border-primary focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring sm:size-14 sm:text-2xl" />
                    @endfor
                </div>

                <x-ui.button class="mt-6 w-full" size="lg" icon="check" ::disabled="! filled" @click="verify()">Verify code</x-ui.button>

                <p class="mt-5 text-sm text-muted-foreground">
                    Didn't get it?
                    <button @click="resend()" :disabled="left > 0" class="font-medium text-primary hover:underline disabled:cursor-not-allowed disabled:text-muted-foreground disabled:no-underline">
                        <span x-show="left > 0">Resend in <span x-text="left"></span>s</span>
                        <span x-show="left === 0" x-cloak>Resend code</span>
                    </button>
                </p>

                <div class="mt-6 border-t border-border pt-5">
                    <a href="{{ route('login') }}" wire:navigate class="inline-flex items-center gap-1.5 text-sm text-muted-foreground hover:text-foreground">
                        <i data-lucide="arrow-left" class="rtl-flip size-4"></i>Back to sign in
                    </a>
                </div>
            </div>
        </div>
    </x-ui.card>
</div>
