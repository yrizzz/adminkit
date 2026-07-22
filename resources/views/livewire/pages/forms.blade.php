<div>
    <x-page-header title="Forms" subtitle="Form layouts, inputs, and a multi-step wizard." />

    <div class="grid grid-cols-1 gap-4 lg:grid-cols-3">
        {{-- Wizard --}}
        <x-ui.card title="Create Project" subtitle="A 3-step wizard" class="lg:col-span-2"
            x-data="{ step: 1, steps: ['Details','Team','Review'] }">
            <div class="mb-6 flex items-center">
                <template x-for="(s, i) in steps" :key="i">
                    <div class="flex flex-1 items-center" :class="i < steps.length - 1 ? 'after:mx-2 after:h-0.5 after:flex-1 after:rounded after:transition-colors' : ''"
                         :style="i < steps.length - 1 ? (step > i + 1 ? 'color: hsl(var(--primary))' : '') : ''"
                         >
                        <div class="flex items-center gap-2">
                            <span class="grid size-8 shrink-0 place-items-center rounded-full text-sm font-semibold transition-colors"
                                  :class="step > i + 1 ? 'bg-primary text-primary-foreground' : (step === i + 1 ? 'bg-primary/15 text-primary ring-2 ring-primary' : 'bg-muted text-muted-foreground')">
                                <span x-show="step > i + 1"><i data-lucide="check" class="size-4"></i></span>
                                <span x-show="step <= i + 1" x-text="i + 1"></span>
                            </span>
                            <span class="text-sm font-medium" :class="step >= i + 1 ? 'text-foreground' : 'text-muted-foreground'" x-text="s"></span>
                        </div>
                        <span x-show="i < steps.length - 1" class="mx-3 h-0.5 flex-1 rounded" :class="step > i + 1 ? 'bg-primary' : 'bg-border'"></span>
                    </div>
                </template>
            </div>

            <div x-show="step === 1" class="space-y-4">
                <x-ui.input label="Project name" placeholder="Acme Redesign" icon="folder" />
                <div class="space-y-1.5">
                    <label class="text-sm font-medium">Description</label>
                    <textarea rows="3" class="w-full rounded-lg border border-input bg-background p-3 text-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring" placeholder="What is this project about?"></textarea>
                </div>
            </div>
            <div x-show="step === 2" x-cloak class="space-y-4">
                <x-ui.input label="Team lead" placeholder="Aisha Rahman" icon="user" />
                <x-ui.input label="Members (comma separated)" placeholder="David, Sofia, Omar" icon="users" />
            </div>
            <div x-show="step === 3" x-cloak>
                <x-ui.alert variant="success" title="Ready to go!">Review your details and click finish to create the project.</x-ui.alert>
            </div>

            <div class="mt-6 flex justify-between">
                <x-ui.button variant="outline" icon="chevron-left" class="[&>svg]:rtl-flip" x-show="step > 1" @click="step--">Back</x-ui.button>
                <span x-show="step === 1"></span>
                <x-ui.button iconEnd="chevron-right" class="ms-auto [&>svg]:rtl-flip" x-show="step < 3" @click="step++">Continue</x-ui.button>
                <x-ui.button variant="success" icon="check" class="ms-auto" x-show="step === 3" @click="window.toast('Project created!', {variant:'success'}); step = 1">Finish</x-ui.button>
            </div>
        </x-ui.card>

        {{-- Field types --}}
        <x-ui.card title="Field Types" subtitle="Common inputs">
            <div class="space-y-4">
                <x-ui.input label="Text" placeholder="John Doe" />
                <x-ui.input label="Email" type="email" icon="mail" placeholder="john@example.com" />
                <x-ui.input label="Date" type="date" />
                <div class="space-y-1.5">
                    <label class="text-sm font-medium">Range</label>
                    <input type="range" class="w-full accent-[hsl(var(--primary))]" value="60">
                </div>
                <div class="flex flex-wrap gap-4 pt-1">
                    <label class="flex items-center gap-2 text-sm"><input type="checkbox" checked class="size-4 rounded border-input text-primary focus:ring-primary">Checkbox</label>
                    <label class="flex items-center gap-2 text-sm"><input type="radio" name="r" checked class="size-4 border-input text-primary focus:ring-primary">Radio</label>
                </div>
            </div>
        </x-ui.card>
    </div>
</div>
