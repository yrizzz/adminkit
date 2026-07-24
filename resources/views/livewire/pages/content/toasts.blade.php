<div>
    <x-page-header :title="$pageTitle" subtitle="Ui Elements · transient notifications you can reposition">
        <x-slot:actions>
            <x-ui.badge variant="success" dot>6 positions</x-ui.badge>
            <x-ui.button variant="outline" icon="arrow-left" class="[&>svg]:rtl-flip" :href="route('ui.elements')">All elements</x-ui.button>
        </x-slot:actions>
    </x-page-header>

    {{-- ════════ Interactive playground ════════ --}}
    <x-demo-section title="Playground" desc="Pick a corner, tweak the message and fire — the toast lands exactly there." />
    <div x-data="{
            position: 'bottom-end',
            variant: 'success',
            title: 'Payment received',
            message: 'Your subscription is now active.',
            duration: 4200,
            fire() {
                window.toast(this.message || 'Hello from AdminKit', {
                    variant: this.variant,
                    title: this.title || undefined,
                    position: this.position,
                    duration: this.duration,
                });
            },
         }" class="grid grid-cols-1 gap-4 lg:grid-cols-[1fr_320px]">

        {{-- Position picker (a 3×2 grid mirroring the screen corners) --}}
        <x-ui.card title="Position" subtitle="Click a spot to aim the toast">
            <div class="relative aspect-video overflow-hidden rounded-xl border-2 border-dashed border-border bg-muted/30">
                <div class="absolute inset-x-0 top-0 flex items-center gap-1.5 border-b border-border/60 bg-card/60 px-3 py-2">
                    <span class="size-2 rounded-full bg-red-400"></span><span class="size-2 rounded-full bg-amber-400"></span><span class="size-2 rounded-full bg-green-400"></span>
                    <span class="ms-2 text-[0.65rem] text-muted-foreground">app.adminkit.test</span>
                </div>
                <div class="grid h-full grid-cols-3 grid-rows-2 gap-2 p-2 pt-9">
                    @foreach (['top-start'=>'Top left','top-center'=>'Top center','top-end'=>'Top right','bottom-start'=>'Bottom left','bottom-center'=>'Bottom center','bottom-end'=>'Bottom right'] as $pos => $label)
                        @php
                            [$v,$h] = explode('-', $pos);
                            $align = ['start'=>'items-start text-start','center'=>'items-center text-center','end'=>'items-end text-end'][$h];
                            $valign = $v === 'top' ? 'justify-start' : 'justify-end';
                        @endphp
                        <button @click="position = '{{ $pos }}'"
                                class="group flex flex-col {{ $align }} {{ $valign }} rounded-lg border-2 p-2 text-xs font-medium transition-all"
                                :class="position === '{{ $pos }}' ? 'border-primary bg-primary/10 text-primary' : 'border-transparent bg-card/60 text-muted-foreground hover:bg-accent'">
                            <span class="flex items-center gap-1.5">
                                <span class="size-2 rounded-full transition-colors" :class="position === '{{ $pos }}' ? 'bg-primary' : 'bg-muted-foreground/40'"></span>{{ $label }}
                            </span>
                        </button>
                    @endforeach
                </div>
            </div>
            <div class="mt-4 flex flex-wrap items-center gap-2">
                <x-ui.button icon="send" class="[&>svg]:rtl-flip" @click="fire()">Fire toast</x-ui.button>
                <x-ui.button variant="outline" icon="layers" @click="[0,1,2].forEach(i => setTimeout(() => fire(), i * 300))">Fire a stack of 3</x-ui.button>
                <span class="text-sm text-muted-foreground">Aiming at <code class="rounded bg-muted px-1.5 py-0.5 text-primary" x-text="position"></code></span>
            </div>
        </x-ui.card>

        {{-- Controls --}}
        <x-ui.card title="Options">
            <div class="space-y-4">
                <div>
                    <p class="mb-1.5 text-sm font-medium">Variant</p>
                    <div class="grid grid-cols-2 gap-2">
                        @foreach (['success'=>'Success','info'=>'Info','warning'=>'Warning','destructive'=>'Error','default'=>'Default'] as $v => $l)
                            <button @click="variant = '{{ $v }}'" class="rounded-lg border px-3 py-1.5 text-sm font-medium transition-colors" :class="variant === '{{ $v }}' ? 'border-primary bg-primary/10 text-primary' : 'border-border hover:bg-accent'">{{ $l }}</button>
                        @endforeach
                    </div>
                </div>
                <div>
                    <label class="mb-1.5 block text-sm font-medium">Title <span class="text-muted-foreground">(optional)</span></label>
                    <input x-model="title" class="h-10 w-full rounded-lg border border-input bg-background px-3 text-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring" placeholder="Leave blank for none">
                </div>
                <div>
                    <label class="mb-1.5 block text-sm font-medium">Message</label>
                    <textarea x-model="message" rows="2" class="w-full rounded-lg border border-input bg-background px-3 py-2 text-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring"></textarea>
                </div>
                <div>
                    <div class="mb-1.5 flex items-center justify-between text-sm"><span class="font-medium">Duration</span><span class="text-muted-foreground"><span x-text="(duration/1000).toFixed(1)"></span>s</span></div>
                    <input type="range" x-model.number="duration" min="1500" max="8000" step="500" class="w-full accent-primary">
                </div>
            </div>
        </x-ui.card>
    </div>

    {{-- ════════ Position presets ════════ --}}
    <x-demo-section title="All six positions" desc="One button per corner — fire and watch where it appears." />
    <x-ui.card>
        <div class="mx-auto grid max-w-md grid-cols-3 gap-3">
            @foreach (['top-start','top-center','top-end','bottom-start','bottom-center','bottom-end'] as $pos)
                @php [$v] = explode('-', $pos); @endphp
                <button @click="window.toast('Toast at {{ str_replace('-', ' ', $pos) }}', { variant: 'info', position: '{{ $pos }}' })"
                        class="flex flex-col items-center gap-1.5 rounded-xl border border-border p-4 text-xs font-medium capitalize text-muted-foreground transition-colors hover:border-primary hover:text-primary">
                    <i data-lucide="{{ $v === 'top' ? 'arrow-up' : 'arrow-down' }}" class="size-4"></i>{{ str_replace('-', ' ', $pos) }}
                </button>
            @endforeach
        </div>
    </x-ui.card>

    {{-- ════════ Variants ════════ --}}
    <x-demo-section title="Variants" desc="Four tones plus neutral." />
    <x-ui.card>
        <div class="flex flex-wrap gap-2">
            <x-ui.button variant="success" icon="check" @click="window.toast('Your changes have been saved', { variant: 'success' })">Success</x-ui.button>
            <x-ui.button icon="info" @click="window.toast('A new version is available', { variant: 'info' })">Info</x-ui.button>
            <x-ui.button variant="outline" icon="triangle-alert" @click="window.toast('Your storage is almost full', { variant: 'warning' })">Warning</x-ui.button>
            <x-ui.button variant="destructive" icon="circle-alert" @click="window.toast('Something went wrong', { variant: 'destructive' })">Error</x-ui.button>
            <x-ui.button variant="secondary" @click="window.toast('A plain, neutral message')">Default</x-ui.button>
        </div>
    </x-ui.card>

    {{-- ════════ Titles & durations ════════ --}}
    <x-demo-section title="With titles & durations" desc="A heading plus copy, and custom lifetimes." />
    <x-ui.card>
        <div class="flex flex-wrap gap-2">
            <x-ui.button variant="outline" @click="window.toast('Your invoice has been emailed.', { variant: 'success', title: 'Payment received' })">Titled toast</x-ui.button>
            <x-ui.button variant="outline" @click="window.toast('This one sticks around for 8 seconds.', { variant: 'info', title: 'Slow toast', duration: 8000 })">Long duration</x-ui.button>
            <x-ui.button variant="outline" @click="window.toast('Gone in a flash — 1.5s.', { variant: 'warning', duration: 1500 })">Short duration</x-ui.button>
            <x-ui.button variant="outline" @click="window.toast('Top-center announcement.', { variant: 'info', title: 'Heads up', position: 'top-center' })">Top-center titled</x-ui.button>
        </div>
    </x-ui.card>

    {{-- ════════ Real-world ════════ --}}
    <x-demo-section title="In a flow" desc="How toasts feel inside real interactions." />
    <div class="grid grid-cols-1 gap-4 lg:grid-cols-3">
        <x-ui.card title="Save a form">
            <div class="space-y-3">
                <x-ui.input label="Display name" placeholder="Yrizzz" />
                <x-ui.button class="w-full" icon="save" @click="window.toast('Profile updated', { variant: 'success', position: 'top-end' })">Save changes</x-ui.button>
            </div>
        </x-ui.card>
        <x-ui.card title="Copy to clipboard">
            <div class="flex items-center gap-2 rounded-lg border border-border bg-muted/40 p-2">
                <code class="flex-1 truncate ps-1 text-xs text-muted-foreground">https://app.adminkit.test/p/9f2a1c</code>
                <x-ui.button size="sm" icon="copy" @click="navigator.clipboard && navigator.clipboard.writeText('https://app.adminkit.test/p/9f2a1c'); window.toast('Link copied', { variant: 'success', position: 'bottom-center' })">Copy</x-ui.button>
            </div>
        </x-ui.card>
        <x-ui.card title="Destructive action">
            <p class="text-sm text-muted-foreground">Deleting fires a warning toast.</p>
            <x-ui.button variant="destructive" class="mt-3 w-full" icon="trash-2" @click="window.toast('Project moved to trash', { variant: 'destructive', title: 'Deleted', position: 'bottom-start' })">Delete project</x-ui.button>
        </x-ui.card>
    </div>
</div>
