<div>
    <x-page-header title="UI Elements" subtitle="A shadcn-inspired component library — Blade + Alpine, zero React.">
        <x-slot:actions>
            <x-ui.badge variant="success" dot>24 groups</x-ui.badge>
        </x-slot:actions>
    </x-page-header>

    {{-- ═══════════ BUTTONS ═══════════ --}}
    <x-demo-section title="Buttons" desc="Eight variants, four sizes, icons and states." />
    <div class="grid grid-cols-1 gap-4 xl:grid-cols-2">
        <x-ui.card id="buttons" class="scroll-mt-24" title="Variants">
            <div class="flex flex-wrap gap-2">
                <x-ui.button>Primary</x-ui.button>
                <x-ui.button variant="secondary">Secondary</x-ui.button>
                <x-ui.button variant="outline">Outline</x-ui.button>
                <x-ui.button variant="ghost">Ghost</x-ui.button>
                <x-ui.button variant="destructive">Destructive</x-ui.button>
                <x-ui.button variant="success">Success</x-ui.button>
                <x-ui.button variant="soft">Soft</x-ui.button>
                <x-ui.button variant="link">Link</x-ui.button>
            </div>
        </x-ui.card>

        <x-ui.card title="Sizes & states">
            <div class="flex flex-wrap items-center gap-2">
                <x-ui.button size="sm" icon="plus">Small</x-ui.button>
                <x-ui.button icon="download">Default</x-ui.button>
                <x-ui.button size="lg" iconEnd="arrow-right" class="[&>svg]:rtl-flip">Large</x-ui.button>
                <x-ui.button size="icon" icon="heart" aria-label="Like" />
                <x-ui.button :loading="true">Loading</x-ui.button>
                <x-ui.button disabled>Disabled</x-ui.button>
            </div>
            <div class="mt-4">
                <p class="mb-2 text-xs font-semibold uppercase tracking-wide text-muted-foreground">Button group</p>
                <div class="inline-flex overflow-hidden rounded-lg border border-border">
                    @foreach (['align-left','align-center','align-right','align-justify'] as $i => $ic)
                        <button class="grid size-9 place-items-center transition-colors {{ $i === 0 ? 'bg-primary text-primary-foreground' : 'text-muted-foreground hover:bg-accent' }} {{ $i > 0 ? 'border-s border-border' : '' }}"><i data-lucide="{{ $ic }}" class="size-4"></i></button>
                    @endforeach
                </div>
                <x-ui.button class="ms-3 w-40" icon="check">Full width</x-ui.button>
            </div>
        </x-ui.card>
    </div>

    {{-- ═══════════ BADGES & CHIPS ═══════════ --}}
    <x-demo-section title="Badges & chips" desc="Status labels, counters and removable tags." />
    <div class="grid grid-cols-1 gap-4 xl:grid-cols-2">
        <x-ui.card id="badges" class="scroll-mt-24" title="Badges">
            <div class="flex flex-wrap gap-2">
                <x-ui.badge>Default</x-ui.badge>
                <x-ui.badge variant="solid">Solid</x-ui.badge>
                <x-ui.badge variant="secondary">Secondary</x-ui.badge>
                <x-ui.badge variant="success" dot>Success</x-ui.badge>
                <x-ui.badge variant="warning" dot>Warning</x-ui.badge>
                <x-ui.badge variant="destructive" dot>Error</x-ui.badge>
                <x-ui.badge variant="info">Info</x-ui.badge>
                <x-ui.badge variant="outline">Outline</x-ui.badge>
                <x-ui.badge variant="muted">Muted</x-ui.badge>
            </div>
            <div class="mt-4 flex flex-wrap items-center gap-3">
                <span class="relative inline-flex"><x-ui.button variant="outline" size="icon" icon="bell" /><span class="absolute -end-1 -top-1 grid size-5 place-items-center rounded-full bg-destructive text-[0.6rem] font-bold text-white">9</span></span>
                <span class="inline-flex items-center gap-1.5 rounded-full bg-success/12 px-2.5 py-1 text-xs font-semibold text-success"><i data-lucide="circle-check-big" class="size-3.5"></i>Verified</span>
                <span class="inline-flex items-center gap-1.5 rounded-full bg-muted px-2.5 py-1 text-xs font-semibold text-muted-foreground"><span class="size-1.5 animate-pulse rounded-full bg-current"></span>Syncing</span>
            </div>
        </x-ui.card>

        <x-ui.card title="Removable chips">
            <div x-data="{ chips: ['Design', 'Frontend', 'Laravel', 'Alpine', 'Tailwind'] }" class="flex flex-wrap gap-2">
                <template x-for="(c, i) in chips" :key="c">
                    <span class="inline-flex items-center gap-1.5 rounded-full border border-border bg-card px-3 py-1 text-sm">
                        <span x-text="c"></span>
                        <button @click="chips.splice(i, 1)" class="text-muted-foreground hover:text-destructive">&times;</button>
                    </span>
                </template>
                <button x-show="chips.length < 5" @click="chips.push('New tag')" class="rounded-full border border-dashed border-border px-3 py-1 text-sm text-muted-foreground hover:border-primary hover:text-primary">+ Add</button>
            </div>
        </x-ui.card>
    </div>

    {{-- ═══════════ ALERTS ═══════════ --}}
    <x-demo-section title="Alerts" desc="Contextual feedback, with an optional dismiss." />
    <div class="grid grid-cols-1 gap-4 xl:grid-cols-2">
        <x-ui.card id="alerts" class="scroll-mt-24" title="Variants">
            <div class="space-y-3">
                <x-ui.alert variant="info" title="Heads up!">This is an informational alert with a title.</x-ui.alert>
                <x-ui.alert variant="success" title="Payment received">Your subscription is now active.</x-ui.alert>
                <x-ui.alert variant="warning">Your storage is almost full — 92% used.</x-ui.alert>
                <x-ui.alert variant="destructive" title="Something went wrong">We couldn't process that request.</x-ui.alert>
            </div>
        </x-ui.card>

        <x-ui.card title="Dismissible & with actions">
            <div class="space-y-3">
                <div x-data="{ open: true }" x-show="open" x-transition>
                    <x-ui.alert variant="info" title="New version available" class="relative pe-10">
                        AdminKit v2.2 is ready to install.
                        <button @click="open = false" class="absolute end-3 top-3 text-muted-foreground hover:text-foreground"><i data-lucide="x" class="size-4"></i></button>
                    </x-ui.alert>
                </div>
                <x-ui.alert variant="warning" title="Confirm your email">
                    We sent a link to your inbox.
                    <div class="mt-2 flex gap-2">
                        <x-ui.button size="sm">Resend</x-ui.button>
                        <x-ui.button size="sm" variant="ghost">Dismiss</x-ui.button>
                    </div>
                </x-ui.alert>
            </div>
        </x-ui.card>
    </div>

    {{-- ═══════════ AVATARS ═══════════ --}}
    <x-demo-section title="Avatars" desc="Sizes, presence, shapes and groups." />
    <x-ui.card id="avatars" class="scroll-mt-24">
        <div class="flex flex-wrap items-end gap-8">
            <div>
                <p class="mb-2 text-xs font-semibold uppercase tracking-wide text-muted-foreground">Sizes</p>
                <div class="flex items-end gap-3">
                    @foreach (['xs','sm','md','lg','xl'] as $s)<x-ui.avatar name="Yrizzz Admin" :size="$s" />@endforeach
                </div>
            </div>
            <div>
                <p class="mb-2 text-xs font-semibold uppercase tracking-wide text-muted-foreground">Status</p>
                <div class="flex items-end gap-3">
                    @foreach (['online','away','busy','offline'] as $st)<x-ui.avatar name="David Chen" size="lg" :status="$st" />@endforeach
                </div>
            </div>
            <div>
                <p class="mb-2 text-xs font-semibold uppercase tracking-wide text-muted-foreground">Group</p>
                <div class="flex -space-x-3">
                    @foreach (['Aisha Rahman','David Chen','Sofia Martinez'] as $n)<x-ui.avatar :name="$n" size="md" class="ring-2 ring-card" />@endforeach
                    <span class="grid size-10 place-items-center rounded-full bg-muted text-xs font-bold text-muted-foreground ring-2 ring-card">+5</span>
                </div>
            </div>
        </div>
    </x-ui.card>

    {{-- ═══════════ FORM CONTROLS ═══════════ --}}
    <x-demo-section title="Form controls" desc="Inputs, selects, toggles and pickers." />
    <div class="grid grid-cols-1 gap-4 xl:grid-cols-2">
        <x-ui.card id="forms" class="scroll-mt-24" title="Text inputs">
            <div class="space-y-4">
                <x-ui.input label="Email address" type="email" icon="mail" placeholder="you@company.com" hint="We'll never share your email." />
                <x-ui.input label="Username" icon="at-sign" placeholder="yrizzz" error="That username is already taken." />
                <div>
                    <label class="mb-1.5 block text-sm font-medium">Search</label>
                    <div class="relative">
                        <i data-lucide="search" class="pointer-events-none absolute inset-y-0 start-0 my-auto ms-3 size-4 text-muted-foreground"></i>
                        <input placeholder="Search anything…" class="h-10 w-full rounded-lg border border-input bg-background ps-9 pe-16 text-sm shadow-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring">
                        <kbd class="absolute end-2 top-1/2 -translate-y-1/2 rounded border border-border bg-muted px-1.5 py-0.5 text-[0.65rem] font-semibold">⌘K</kbd>
                    </div>
                </div>
                <div>
                    <label class="mb-1.5 block text-sm font-medium">Amount</label>
                    <div class="flex">
                        <span class="grid place-items-center rounded-s-lg border border-e-0 border-input bg-muted px-3 text-sm text-muted-foreground">$</span>
                        <input value="1,250.00" class="h-10 w-full border border-input bg-background px-3 text-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring">
                        <span class="grid place-items-center rounded-e-lg border border-s-0 border-input bg-muted px-3 text-sm text-muted-foreground">USD</span>
                    </div>
                </div>
                <div>
                    <label class="mb-1.5 block text-sm font-medium">Message</label>
                    <textarea rows="3" placeholder="Write something…" class="w-full rounded-lg border border-input bg-background px-3 py-2 text-sm shadow-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring"></textarea>
                </div>
            </div>
        </x-ui.card>

        <x-ui.card title="Selection controls">
            <div class="space-y-5">
                <div>
                    <label class="mb-1.5 block text-sm font-medium">Role</label>
                    <select class="h-10 w-full rounded-lg border border-input bg-background px-3 text-sm shadow-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring"><option>Viewer</option><option>Editor</option><option>Admin</option></select>
                </div>

                <div>
                    <p class="mb-2 text-sm font-medium">Checkboxes</p>
                    <div class="space-y-2">
                        @foreach (['Email notifications' => true, 'SMS alerts' => false, 'Weekly digest' => true] as $l => $on)
                            <label class="flex cursor-pointer items-center gap-2.5 text-sm"><input type="checkbox" @checked($on) class="size-4 rounded border-input text-primary focus:ring-primary">{{ $l }}</label>
                        @endforeach
                    </div>
                </div>

                <div>
                    <p class="mb-2 text-sm font-medium">Radio</p>
                    <div class="flex gap-4">
                        @foreach (['Monthly' => true, 'Yearly' => false] as $l => $on)
                            <label class="flex cursor-pointer items-center gap-2 text-sm"><input type="radio" name="ui-plan" @checked($on) class="size-4 border-input text-primary focus:ring-primary">{{ $l }}</label>
                        @endforeach
                    </div>
                </div>

                <div x-data="{ on: true, on2: false }">
                    <p class="mb-2 text-sm font-medium">Switches</p>
                    <div class="flex items-center gap-6">
                        @foreach (['on' => 'Dark mode', 'on2' => 'Auto-save'] as $model => $label)
                            <label class="flex cursor-pointer items-center gap-2.5 text-sm">
                                <button type="button" role="switch" @click="{{ $model }} = ! {{ $model }}" :aria-checked="{{ $model }}"
                                        class="relative h-6 w-11 shrink-0 rounded-full transition-colors" :class="{{ $model }} ? 'bg-primary' : 'bg-muted'">
                                    <span class="absolute top-0.5 start-0.5 size-5 rounded-full bg-white shadow transition-transform" :class="{{ $model }} && 'translate-x-5 rtl:-translate-x-5'"></span>
                                </button>{{ $label }}
                            </label>
                        @endforeach
                    </div>
                </div>

                <div x-data="{ v: 65 }">
                    <div class="mb-1.5 flex justify-between text-sm"><span class="font-medium">Range</span><span class="text-muted-foreground" x-text="v"></span></div>
                    <input type="range" x-model="v" class="w-full accent-primary">
                </div>

                <div>
                    <p class="mb-2 text-sm font-medium">File upload</p>
                    <label class="flex cursor-pointer flex-col items-center gap-1.5 rounded-xl border-2 border-dashed border-border py-6 text-muted-foreground transition-colors hover:border-primary hover:text-primary">
                        <i data-lucide="upload-cloud" class="size-7"></i>
                        <span class="text-sm font-medium">Click to upload or drag &amp; drop</span>
                        <span class="text-xs">PNG, JPG up to 10MB</span>
                        <input type="file" class="hidden">
                    </label>
                </div>
            </div>
        </x-ui.card>
    </div>

    {{-- ═══════════ TABS & ACCORDION ═══════════ --}}
    <x-demo-section title="Tabs & accordion" desc="Two ways to condense content." />
    <div class="grid grid-cols-1 gap-4 xl:grid-cols-2">
        <x-ui.card title="Tabs">
            <div x-data="{ t: 'overview' }">
                <div class="flex gap-1 border-b border-border">
                    @foreach (['overview' => 'Overview','analytics' => 'Analytics','reports' => 'Reports'] as $k => $l)
                        <button @click="t = '{{ $k }}'" class="relative px-4 py-2.5 text-sm font-medium transition-colors" :class="t === '{{ $k }}' ? 'text-primary' : 'text-muted-foreground hover:text-foreground'">
                            {{ $l }}<span x-show="t === '{{ $k }}'" class="absolute inset-x-2 -bottom-px h-0.5 rounded-full bg-primary"></span>
                        </button>
                    @endforeach
                </div>
                <div class="pt-4 text-sm text-muted-foreground">
                    <p x-show="t === 'overview'">A high-level summary of everything happening in your workspace.</p>
                    <p x-show="t === 'analytics'" x-cloak>Traffic, engagement and conversion metrics live here.</p>
                    <p x-show="t === 'reports'" x-cloak>Generate and export scheduled reports.</p>
                </div>

                <p class="mb-2 mt-6 text-xs font-semibold uppercase tracking-wide text-muted-foreground">Pill tabs</p>
                <div x-data="{ p: 'day' }" class="inline-flex gap-1 rounded-lg bg-muted/60 p-1">
                    @foreach (['day' => 'Day','week' => 'Week','month' => 'Month'] as $k => $l)
                        <button @click="p = '{{ $k }}'" class="rounded-md px-3 py-1.5 text-sm font-medium transition-colors" :class="p === '{{ $k }}' ? 'bg-card text-foreground shadow-sm' : 'text-muted-foreground'">{{ $l }}</button>
                    @endforeach
                </div>
            </div>
        </x-ui.card>

        <x-ui.card title="Accordion">
            <div x-data="{ open: 0 }" class="divide-y divide-border overflow-hidden rounded-xl border border-border">
                @foreach ([['What is AdminKit?','A Laravel + Livewire admin scaffold with a themeable Tailwind design system.'],['Is it responsive?','Yes — every layout adapts from mobile to widescreen, with light/dark and RTL.'],['Can I customise it?','Accent, radius, density and layout are all configurable at runtime.']] as $i => [$q,$a])
                    <div>
                        <button @click="open = open === {{ $i }} ? null : {{ $i }}" class="flex w-full items-center justify-between gap-3 px-4 py-3.5 text-start text-sm font-semibold hover:bg-accent/40">
                            {{ $q }}<i data-lucide="chevron-down" class="size-4 shrink-0 text-muted-foreground transition-transform" :class="open === {{ $i }} && 'rotate-180'"></i>
                        </button>
                        <div x-show="open === {{ $i }}" x-collapse x-cloak><p class="px-4 pb-4 text-sm text-muted-foreground">{{ $a }}</p></div>
                    </div>
                @endforeach
            </div>
        </x-ui.card>
    </div>

    {{-- ═══════════ OVERLAYS ═══════════ --}}
    <x-demo-section title="Overlays" desc="Dropdowns, modals, tooltips and toasts." />
    <div class="grid grid-cols-1 gap-4 xl:grid-cols-2">
        <x-ui.card id="overlays" class="scroll-mt-24" title="Dropdown & tooltip">
            <div class="flex flex-wrap items-center gap-4">
                <x-ui.dropdown align="start" width="w-52">
                    <x-slot:trigger><x-ui.button variant="outline" iconEnd="chevron-down">Options</x-ui.button></x-slot:trigger>
                    <x-ui.dropdown-item icon="pencil">Edit</x-ui.dropdown-item>
                    <x-ui.dropdown-item icon="copy">Duplicate</x-ui.dropdown-item>
                    <x-ui.dropdown-item icon="share-2">Share</x-ui.dropdown-item>
                    <div class="my-1 border-t border-border"></div>
                    <x-ui.dropdown-item icon="trash-2" variant="destructive">Delete</x-ui.dropdown-item>
                </x-ui.dropdown>

                @foreach (['top' => '-top-9 start-1/2 -translate-x-1/2', 'bottom' => '-bottom-9 start-1/2 -translate-x-1/2'] as $pos => $cls)
                    <div x-data="{ show: false }" class="relative" @mouseenter="show = true" @mouseleave="show = false">
                        <x-ui.button variant="secondary">Hover ({{ $pos }})</x-ui.button>
                        <span x-show="show" x-cloak x-transition
                              class="absolute {{ $cls }} z-20 whitespace-nowrap rounded-md bg-foreground px-2 py-1 text-xs font-medium text-background shadow-lg rtl:translate-x-1/2">
                            Tooltip on {{ $pos }}
                        </span>
                    </div>
                @endforeach
            </div>
        </x-ui.card>

        <x-ui.card title="Modals & toasts">
            <div class="flex flex-wrap gap-2">
                <x-ui.button icon="square-mouse-pointer" x-on:click="$dispatch('open-modal', 'ui-demo')">Open modal</x-ui.button>
                <x-ui.button variant="outline" @click="window.toast('Saved successfully', { variant: 'success' })">Success toast</x-ui.button>
                <x-ui.button variant="outline" @click="window.toast('Heads up — check your settings', { variant: 'info' })">Info toast</x-ui.button>
                <x-ui.button variant="outline" @click="window.toast('Something went wrong', { variant: 'destructive' })">Error toast</x-ui.button>
            </div>
        </x-ui.card>
    </div>

    <x-ui.modal name="ui-demo" title="Example modal">
        <p class="text-sm text-muted-foreground">Modals teleport to the body, trap focus, and close on backdrop click or <kbd class="rounded border border-border bg-muted px-1.5 text-xs">Esc</kbd>.</p>
        <x-slot:footer>
            <x-ui.button variant="outline" x-on:click="$dispatch('close-modal', 'ui-demo')">Cancel</x-ui.button>
            <x-ui.button x-on:click="$dispatch('close-modal', 'ui-demo')">Confirm</x-ui.button>
        </x-slot:footer>
    </x-ui.modal>

    {{-- ═══════════ PROGRESS & LOADERS ═══════════ --}}
    <x-demo-section title="Progress & loaders" desc="Bars, rings, spinners and skeletons." />
    <div class="grid grid-cols-1 gap-4 lg:grid-cols-3">
        <x-ui.card id="progress" class="scroll-mt-24" title="Progress bars">
            <div class="space-y-4">
                @foreach ([['Primary',72,'bg-primary','h-2'],['Success',54,'bg-success','h-2'],['Warning',88,'bg-[hsl(var(--warning))]','h-1.5'],['Destructive',34,'bg-destructive','h-3']] as [$l,$p,$c,$h])
                    <div>
                        <div class="mb-1 flex justify-between text-xs"><span class="font-medium">{{ $l }}</span><span class="text-muted-foreground">{{ $p }}%</span></div>
                        <div class="{{ $h }} overflow-hidden rounded-full bg-muted"><div class="h-full rounded-full {{ $c }}" style="width: {{ $p }}%"></div></div>
                    </div>
                @endforeach
                <div>
                    <p class="mb-1 text-xs font-medium">Indeterminate</p>
                    <div class="h-2 overflow-hidden rounded-full bg-muted"><div class="skeleton h-full w-1/3 rounded-full bg-primary"></div></div>
                </div>
            </div>
        </x-ui.card>

        <x-ui.card title="Rings">
            <div class="flex items-center justify-around">
                <x-ui.gauge :value="72" tone="primary" :size="96" :stroke="8" />
                <x-ui.gauge :value="45" tone="warning" :size="96" :stroke="8" />
            </div>
        </x-ui.card>

        <x-ui.card title="Spinners & skeleton">
            <div class="flex items-center gap-5">
                <i data-lucide="loader-circle" class="size-7 animate-spin text-primary"></i>
                <div class="flex gap-1">
                    <span class="size-2 animate-bounce rounded-full bg-primary [animation-delay:-0.3s]"></span>
                    <span class="size-2 animate-bounce rounded-full bg-primary [animation-delay:-0.15s]"></span>
                    <span class="size-2 animate-bounce rounded-full bg-primary"></span>
                </div>
                <span class="size-6 animate-ping rounded-full bg-primary/60"></span>
            </div>
            <div class="mt-5 space-y-2">
                <div class="flex items-center gap-3"><div class="skeleton size-10 rounded-full"></div><div class="flex-1 space-y-2"><div class="skeleton h-3 w-2/3"></div><div class="skeleton h-3 w-1/3"></div></div></div>
                <div class="skeleton h-3 w-full"></div>
                <div class="skeleton h-3 w-4/5"></div>
            </div>
        </x-ui.card>
    </div>

    {{-- ═══════════ NAVIGATION ═══════════ --}}
    <x-demo-section title="Navigation" desc="Breadcrumbs, pagination and steppers." />
    <div class="grid grid-cols-1 gap-4 xl:grid-cols-2">
        <x-ui.card title="Breadcrumbs & pagination">
            <nav class="flex items-center gap-1.5 text-sm">
                <a href="#" class="text-muted-foreground hover:text-foreground"><i data-lucide="house" class="size-4"></i></a>
                <i data-lucide="chevron-right" class="rtl-flip size-4 text-muted-foreground/50"></i>
                <a href="#" class="text-muted-foreground hover:text-foreground">Pages</a>
                <i data-lucide="chevron-right" class="rtl-flip size-4 text-muted-foreground/50"></i>
                <span class="font-medium">UI Elements</span>
            </nav>

            <div x-data="{ page: 3, last: 8 }" class="mt-5 flex items-center gap-1">
                <button @click="page = Math.max(1, page - 1)" class="grid size-9 place-items-center rounded-lg border border-border text-muted-foreground hover:bg-accent"><i data-lucide="chevron-left" class="rtl-flip size-4"></i></button>
                <template x-for="n in last" :key="n">
                    <button @click="page = n" class="grid size-9 place-items-center rounded-lg text-sm font-medium transition-colors"
                            :class="page === n ? 'bg-primary text-primary-foreground' : 'border border-border text-muted-foreground hover:bg-accent'" x-text="n"></button>
                </template>
                <button @click="page = Math.min(last, page + 1)" class="grid size-9 place-items-center rounded-lg border border-border text-muted-foreground hover:bg-accent"><i data-lucide="chevron-right" class="rtl-flip size-4"></i></button>
            </div>
            <p class="mt-2 text-xs text-muted-foreground">Showing page <span x-data x-text="3"></span> of 8</p>
        </x-ui.card>

        <x-ui.card title="Stepper">
            @php $steps = [['Cart', true], ['Shipping', true], ['Payment', false], ['Done', false]]; @endphp
            <div class="flex items-center">
                @foreach ($steps as $i => [$label, $done])
                    <div class="flex flex-col items-center">
                        <span class="grid size-9 place-items-center rounded-full text-sm font-bold {{ $done ? 'bg-primary text-primary-foreground' : ($i === 2 ? 'border-2 border-primary text-primary' : 'border-2 border-border text-muted-foreground') }}">
                            @if ($done)<i data-lucide="check" class="size-4"></i>@else{{ $i + 1 }}@endif
                        </span>
                        <span class="mt-1.5 text-xs {{ $i <= 2 ? 'font-medium' : 'text-muted-foreground' }}">{{ $label }}</span>
                    </div>
                    @if (! $loop->last)<div class="mx-2 mb-5 h-0.5 flex-1 rounded-full {{ $done ? 'bg-primary' : 'bg-border' }}"></div>@endif
                @endforeach
            </div>
        </x-ui.card>
    </div>

    {{-- ═══════════ DATA DISPLAY ═══════════ --}}
    <x-demo-section title="Data display" desc="Tables, lists and timelines." />
    <div class="grid grid-cols-1 gap-4 xl:grid-cols-2">
        <x-ui.card title="Table" :padded="false">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-border text-xs uppercase tracking-wide text-muted-foreground">
                            <th class="p-4 text-start font-medium">Name</th><th class="p-4 text-start font-medium">Role</th><th class="p-4 text-start font-medium">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ([['Aisha Rahman','Admin','Active','success'],['David Chen','Editor','Active','success'],['Sofia Martinez','Viewer','Invited','warning']] as [$n,$r,$s,$tone])
                            <tr class="border-b border-border last:border-0 hover:bg-accent/40">
                                <td class="p-4"><div class="flex items-center gap-2.5"><x-ui.avatar :name="$n" size="xs" />{{ $n }}</div></td>
                                <td class="p-4 text-muted-foreground">{{ $r }}</td>
                                <td class="p-4"><x-ui.badge :variant="$tone">{{ $s }}</x-ui.badge></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </x-ui.card>

        <x-ui.card title="Timeline">
            <ol>
                @foreach ([['git-commit-horizontal','Deployed v2.2','10:24','text-primary bg-primary/10'],['check-check','Order completed','09:12','text-success bg-success/10'],['user-plus','New teammate joined','Yesterday','text-info bg-info/10']] as [$ic,$t,$time,$tone])
                    <li class="flex gap-4">
                        <div class="flex flex-col items-center">
                            <span class="grid size-9 shrink-0 place-items-center rounded-full {{ $tone }}"><i data-lucide="{{ $ic }}" class="size-4"></i></span>
                            @unless ($loop->last)<span class="w-px flex-1 bg-border"></span>@endunless
                        </div>
                        <div class="flex-1 pb-6"><div class="flex justify-between gap-2"><p class="text-sm font-semibold">{{ $t }}</p><span class="text-xs text-muted-foreground">{{ $time }}</span></div></div>
                    </li>
                @endforeach
            </ol>
        </x-ui.card>
    </div>

    {{-- ═══════════ TYPOGRAPHY & EMPTY ═══════════ --}}
    <x-demo-section title="Typography & empty state" desc="Text styles and a friendly placeholder." />
    <div class="grid grid-cols-1 gap-4 xl:grid-cols-2">
        <x-ui.card title="Typography">
            <div class="space-y-2">
                <h1 class="text-3xl font-black tracking-tight">Heading 1</h1>
                <h2 class="text-2xl font-bold">Heading 2</h2>
                <h3 class="text-xl font-semibold">Heading 3</h3>
                <p class="text-sm text-muted-foreground">Body copy — <strong class="font-semibold text-foreground">bold</strong>, <em class="italic">italic</em>, <a href="#" class="font-medium text-primary hover:underline">a link</a>, and <code class="rounded bg-muted px-1.5 py-0.5 text-xs text-primary">inline code</code>.</p>
                <blockquote class="border-s-4 border-primary bg-primary/5 px-4 py-2 text-sm italic">"Simplicity is the ultimate sophistication."</blockquote>
                <pre class="overflow-x-auto rounded-lg bg-neutral-900 p-3 text-xs text-neutral-200"><code>php artisan serve</code></pre>
            </div>
        </x-ui.card>

        <x-ui.card title="Empty state">
            <div class="flex flex-col items-center gap-3 py-8 text-center">
                <span class="grid size-16 place-items-center rounded-2xl bg-primary/10 text-primary"><i data-lucide="inbox" class="size-8"></i></span>
                <div><p class="font-semibold">No messages yet</p><p class="mt-1 text-sm text-muted-foreground">When you receive messages they'll appear here.</p></div>
                <x-ui.button size="sm" icon="plus">Start a chat</x-ui.button>
            </div>
        </x-ui.card>
    </div>
</div>
