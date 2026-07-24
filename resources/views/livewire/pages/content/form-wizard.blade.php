<div>
    <x-page-header :title="$pageTitle" subtitle="Forms · a guided multi-step form">
        <x-slot:actions><x-ui.button variant="outline" icon="arrow-left" class="[&>svg]:rtl-flip" :href="route('forms')">All forms</x-ui.button></x-slot:actions>
    </x-page-header>

    <x-ui.card class="mx-auto max-w-2xl" x-data="{
            step: 1, last: 4,
            steps: [
                { n: 1, t: 'Account',  i: 'user' },
                { n: 2, t: 'Profile',  i: 'id-card' },
                { n: 3, t: 'Plan',     i: 'credit-card' },
                { n: 4, t: 'Review',   i: 'check-check' },
            ],
            plan: 'pro',
            next() { if (this.step < this.last) { this.step++; window.renderIcons && this.$nextTick(() => window.renderIcons()) } },
            prev() { if (this.step > 1) this.step-- },
            go(n) { if (n <= this.step) this.step = n },
            finish() { window.toast('Setup complete — welcome aboard! 🎉', { variant: 'success' }) },
         }" x-init="$nextTick(() => window.renderIcons && window.renderIcons())">

        {{-- Stepper --}}
        <div class="flex items-center">
            <template x-for="(s, idx) in steps" :key="s.n">
                <div class="flex flex-1 items-center" :class="idx === steps.length - 1 && 'flex-none'">
                    <div class="flex flex-col items-center">
                        <button @click="go(s.n)" class="grid size-10 place-items-center rounded-full text-sm font-bold transition-colors"
                                :class="step > s.n ? 'bg-primary text-primary-foreground' : (step === s.n ? 'bg-primary/15 text-primary ring-2 ring-primary' : 'border-2 border-border text-muted-foreground')">
                            <i x-show="step > s.n" data-lucide="check" class="size-4"></i>
                            <span x-show="step <= s.n" x-text="s.n"></span>
                        </button>
                        <span class="mt-1.5 text-xs font-medium" :class="step >= s.n ? 'text-foreground' : 'text-muted-foreground'" x-text="s.t"></span>
                    </div>
                    <div x-show="idx < steps.length - 1" class="mx-2 mb-5 h-0.5 flex-1 rounded-full transition-colors" :class="step > s.n ? 'bg-primary' : 'bg-border'"></div>
                </div>
            </template>
        </div>

        <div class="mt-8 min-h-56">
            {{-- Step 1 --}}
            <div x-show="step === 1" class="space-y-4">
                <h3 class="text-lg font-semibold">Create your account</h3>
                <x-ui.input label="Email" type="email" icon="mail" placeholder="you@company.com" />
                <x-ui.input label="Password" type="password" icon="lock" placeholder="••••••••" />
            </div>
            {{-- Step 2 --}}
            <div x-show="step === 2" x-cloak class="space-y-4">
                <h3 class="text-lg font-semibold">Tell us about you</h3>
                <div class="grid grid-cols-2 gap-3"><x-ui.input label="First name" placeholder="Yrizzz" /><x-ui.input label="Last name" placeholder="Admin" /></div>
                <div><label class="mb-1.5 block text-sm font-medium">Role</label><select class="h-10 w-full rounded-lg border border-input bg-background px-3 text-sm"><option>Designer</option><option>Developer</option><option>Manager</option></select></div>
            </div>
            {{-- Step 3 --}}
            <div x-show="step === 3" x-cloak class="space-y-4">
                <h3 class="text-lg font-semibold">Choose a plan</h3>
                <div class="grid grid-cols-1 gap-3 sm:grid-cols-3">
                    @foreach (['starter'=>['Starter','$0'],'pro'=>['Pro','$29'],'team'=>['Team','$99']] as $k => [$name,$price])
                        <button @click="plan = '{{ $k }}'" class="rounded-xl border-2 p-4 text-start transition-colors" :class="plan === '{{ $k }}' ? 'border-primary bg-primary/5' : 'border-border hover:bg-accent'">
                            <div class="flex items-center justify-between"><span class="font-semibold">{{ $name }}</span><span class="grid size-5 place-items-center rounded-full" :class="plan === '{{ $k }}' ? 'bg-primary text-primary-foreground' : 'border border-border'"><i data-lucide="check" class="size-3" x-show="plan === '{{ $k }}'"></i></span></div>
                            <p class="mt-2 text-2xl font-bold">{{ $price }}<span class="text-sm font-normal text-muted-foreground">/mo</span></p>
                        </button>
                    @endforeach
                </div>
            </div>
            {{-- Step 4 --}}
            <div x-show="step === 4" x-cloak class="space-y-3">
                <h3 class="text-lg font-semibold">Review &amp; confirm</h3>
                <div class="divide-y divide-border rounded-xl border border-border">
                    @foreach (['Email'=>'you@company.com','Name'=>'Yrizzz Admin','Role'=>'Designer'] as $k => $v)
                        <div class="flex justify-between px-4 py-2.5 text-sm"><span class="text-muted-foreground">{{ $k }}</span><span class="font-medium">{{ $v }}</span></div>
                    @endforeach
                    <div class="flex justify-between px-4 py-2.5 text-sm"><span class="text-muted-foreground">Plan</span><span class="font-medium capitalize" x-text="plan"></span></div>
                </div>
                <label class="flex items-center gap-2 text-sm text-muted-foreground"><input type="checkbox" checked class="size-4 rounded border-input text-primary focus:ring-primary">Everything looks correct</label>
            </div>
        </div>

        {{-- Nav --}}
        <div class="mt-6 flex items-center justify-between border-t border-border pt-5">
            <x-ui.button variant="outline" icon="arrow-left" class="[&>svg]:rtl-flip" ::disabled="step === 1" @click="prev()">Back</x-ui.button>
            <span class="text-sm text-muted-foreground">Step <span x-text="step"></span> of <span x-text="last"></span></span>
            <x-ui.button x-show="step < last" iconEnd="arrow-right" class="[&>svg]:rtl-flip" @click="next()">Continue</x-ui.button>
            <x-ui.button x-show="step === last" x-cloak variant="success" icon="check" @click="finish()">Finish setup</x-ui.button>
        </div>
    </x-ui.card>
</div>
