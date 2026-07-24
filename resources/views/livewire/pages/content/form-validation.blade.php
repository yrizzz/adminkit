<div>
    <x-page-header :title="$pageTitle" subtitle="Forms · live client-side validation states">
        <x-slot:actions><x-ui.button variant="outline" icon="arrow-left" class="[&>svg]:rtl-flip" :href="route('forms')">All forms</x-ui.button></x-slot:actions>
    </x-page-header>

    <x-demo-section title="States" desc="Error, success and disabled fields." />
    <x-ui.card>
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
            <div>
                <label class="mb-1.5 block text-sm font-medium">Invalid</label>
                <div class="relative"><input value="not-an-email" class="h-10 w-full rounded-lg border border-destructive bg-background px-3 pe-9 text-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-destructive/40"><i data-lucide="circle-alert" class="absolute end-3 top-1/2 size-4 -translate-y-1/2 text-destructive"></i></div>
                <p class="mt-1 flex items-center gap-1 text-xs font-medium text-destructive"><i data-lucide="circle-alert" class="size-3.5"></i>Enter a valid email address</p>
            </div>
            <div>
                <label class="mb-1.5 block text-sm font-medium">Valid</label>
                <div class="relative"><input value="you@company.com" class="h-10 w-full rounded-lg border border-success bg-background px-3 pe-9 text-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-success/40"><i data-lucide="check" class="absolute end-3 top-1/2 size-4 -translate-y-1/2 text-success"></i></div>
                <p class="mt-1 flex items-center gap-1 text-xs font-medium text-success"><i data-lucide="circle-check-big" class="size-3.5"></i>Looks good!</p>
            </div>
            <div>
                <label class="mb-1.5 block text-sm font-medium text-muted-foreground">Disabled</label>
                <input value="Read only" disabled class="h-10 w-full cursor-not-allowed rounded-lg border border-input bg-muted px-3 text-sm text-muted-foreground">
            </div>
        </div>
    </x-ui.card>

    <x-demo-section title="Live validation" desc="Validates as you type — the submit button unlocks when everything passes." />
    <x-ui.card class="mx-auto max-w-lg">
        <form x-data="{
                name: '', email: '', pw: '', confirm: '', agree: false,
                get eName() { return this.name.length && this.name.length < 2 ? 'Name is too short' : '' },
                get eEmail() { return this.email.length && ! /^[^@\s]+@[^@\s]+\.[^@\s]+$/.test(this.email) ? 'Enter a valid email' : '' },
                get ePw() { return this.pw.length && this.pw.length < 8 ? 'At least 8 characters' : '' },
                get eConfirm() { return this.confirm.length && this.confirm !== this.pw ? 'Passwords do not match' : '' },
                get valid() { return this.name.length >= 2 && ! this.eEmail && this.email && this.pw.length >= 8 && this.confirm === this.pw && this.agree },
                submit() { this.valid && window.toast('Account created — welcome!', { variant: 'success' }) },
             }" @submit.prevent="submit()" class="space-y-4">

            @php
                $fields = [
                    ['name','Full name','text','user','Yrizzz'],
                    ['email','Email','email','mail','you@company.com'],
                    ['pw','Password','password','lock','Min 8 characters'],
                    ['confirm','Confirm password','password','lock','Re-enter password'],
                ];
            @endphp
            @foreach ($fields as [$model,$label,$type,$icon,$ph])
                <div>
                    <label class="mb-1.5 block text-sm font-medium">{{ $label }}</label>
                    <div class="relative">
                        <i data-lucide="{{ $icon }}" class="pointer-events-none absolute inset-y-0 start-0 my-auto ms-3 size-4 text-muted-foreground"></i>
                        <input x-model="{{ $model }}" type="{{ $type }}" placeholder="{{ $ph }}"
                               class="h-10 w-full rounded-lg border bg-background ps-9 pe-9 text-sm focus-visible:outline-none focus-visible:ring-2"
                               :class="e{{ ucfirst($model) }} ? 'border-destructive focus-visible:ring-destructive/40' : ({{ $model }}.length ? 'border-success focus-visible:ring-success/40' : 'border-input focus-visible:ring-ring')">
                        <i x-show="{{ $model }}.length" x-cloak class="absolute end-3 top-1/2 size-4 -translate-y-1/2" :data-lucide="e{{ ucfirst($model) }} ? 'circle-alert' : 'check'" :class="e{{ ucfirst($model) }} ? 'text-destructive' : 'text-success'"></i>
                    </div>
                    <p x-show="e{{ ucfirst($model) }}" x-cloak class="mt-1 flex items-center gap-1 text-xs font-medium text-destructive"><i data-lucide="circle-alert" class="size-3.5"></i><span x-text="e{{ ucfirst($model) }}"></span></p>
                </div>
            @endforeach

            <label class="flex cursor-pointer items-start gap-2 text-sm text-muted-foreground">
                <input type="checkbox" x-model="agree" class="mt-0.5 size-4 rounded border-input text-primary focus:ring-primary">
                <span>I agree to the <a href="#" class="font-medium text-primary hover:underline">Terms</a> and <a href="#" class="font-medium text-primary hover:underline">Privacy Policy</a>.</span>
            </label>

            <x-ui.button type="submit" class="w-full" size="lg" ::disabled="! valid" x-init="$nextTick(() => window.renderIcons && window.renderIcons())">Create account</x-ui.button>
        </form>
    </x-ui.card>
</div>
