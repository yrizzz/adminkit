<div>
    <x-page-header :title="$pageTitle" subtitle="Advanced Ui · expandable panels, collapsible regions & FAQ patterns">
        <x-slot:actions>
            <x-ui.badge variant="success" dot>7 variants</x-ui.badge>
            <x-ui.button variant="outline" icon="arrow-left" class="[&>svg]:rtl-flip" :href="route('dashboard')">Dashboard</x-ui.button>
        </x-slot:actions>
    </x-page-header>

    <x-demo-section title="Bordered & Flush" desc="The two foundational styles — a boxed accordion and a borderless, divider-only variant." />
    <div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
        {{-- Bordered, single-open --}}
        <x-ui.card title="Bordered" subtitle="One panel open at a time">
            <div x-data="{ active: 1 }" class="divide-y divide-border overflow-hidden rounded-xl border border-border">
                @foreach ([
                    ['q' => 'What is AdminKit?', 'a' => 'A Laravel + Livewire admin scaffold with a themeable Tailwind design system, ready-made components and routing already wired up.'],
                    ['q' => 'Is it responsive?', 'a' => 'Yes — every layout, table and chart adapts from mobile to widescreen, with full light/dark and LTR/RTL support.'],
                    ['q' => 'Can I customize the theme?', 'a' => 'Open the customizer to change accent color, radius, density and layout. Values persist in localStorage.'],
                ] as $i => $item)
                    <div>
                        <button type="button" @click="active = active === {{ $i + 1 }} ? null : {{ $i + 1 }}"
                                class="flex w-full items-center justify-between gap-3 px-4 py-3.5 text-start text-sm font-semibold transition-colors hover:bg-accent/50"
                                :class="active === {{ $i + 1 }} && 'text-primary'">
                            <span>{{ $item['q'] }}</span>
                            <i data-lucide="chevron-down" class="size-4 shrink-0 text-muted-foreground transition-transform duration-200" :class="active === {{ $i + 1 }} && 'rotate-180 text-primary'"></i>
                        </button>
                        <div x-show="active === {{ $i + 1 }}" x-collapse x-cloak>
                            <p class="px-4 pb-4 text-sm leading-relaxed text-muted-foreground">{{ $item['a'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </x-ui.card>

        {{-- Flush --}}
        <x-ui.card title="Flush" subtitle="No outer border, dividers only">
            <div x-data="{ active: 1 }" class="divide-y divide-border">
                @foreach ([
                    ['q' => 'Billing & invoices', 'a' => 'Manage your subscription, download invoices and update payment methods from the billing settings.'],
                    ['q' => 'Team & permissions', 'a' => 'Invite teammates and assign roles. Each role maps to a granular set of permissions.'],
                    ['q' => 'API & webhooks', 'a' => 'Generate API keys and register webhook endpoints to integrate with your own systems.'],
                ] as $i => $item)
                    <div>
                        <button type="button" @click="active = active === {{ $i + 1 }} ? null : {{ $i + 1 }}"
                                class="flex w-full items-center justify-between gap-3 py-3.5 text-start text-sm font-semibold">
                            <span>{{ $item['q'] }}</span>
                            <i data-lucide="chevron-down" class="size-4 shrink-0 text-muted-foreground transition-transform duration-200" :class="active === {{ $i + 1 }} && 'rotate-180'"></i>
                        </button>
                        <div x-show="active === {{ $i + 1 }}" x-collapse x-cloak>
                            <p class="pb-4 text-sm leading-relaxed text-muted-foreground">{{ $item['a'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </x-ui.card>
    </div>

    <x-demo-section title="Separated & Filled" desc="Spaced cards with an icon leading each row, and a gradient-filled active header." />
    <div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
        {{-- Separated, multi-open with icons --}}
        <x-ui.card title="Separated (multi-open)" subtitle="Toggle panels independently">
            <div x-data="{ open: [true, false, false] }" class="space-y-2.5">
                @foreach ([['truck','Shipping details'],['credit-card','Payment methods'],['undo-2','Return policy']] as $i => [$ic, $label])
                    <div class="overflow-hidden rounded-xl border border-border transition-shadow" :class="open[{{ $i }}] && 'shadow-sm'">
                        <button type="button" @click="open[{{ $i }}] = ! open[{{ $i }}]"
                                class="flex w-full items-center justify-between gap-3 px-4 py-3.5 text-start text-sm font-semibold transition-colors"
                                :class="open[{{ $i }}] ? 'bg-primary/5 text-primary' : 'hover:bg-accent/50'">
                            <span class="flex items-center gap-2.5"><i data-lucide="{{ $ic }}" class="size-4"></i>{{ $label }}</span>
                            <span class="grid size-5 place-items-center rounded-full border border-current/20 text-current transition-transform" :class="open[{{ $i }}] && 'rotate-45'"><i data-lucide="plus" class="size-3.5"></i></span>
                        </button>
                        <div x-show="open[{{ $i }}]" x-collapse x-cloak>
                            <p class="px-4 pb-4 pt-1 text-sm leading-relaxed text-muted-foreground">Configurable content for “{{ $label }}”. Drop in your own markup, tables or forms.</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </x-ui.card>

        {{-- Filled active header --}}
        <x-ui.card title="Filled header" subtitle="Gradient highlight on the open panel">
            <div x-data="{ active: 1 }" class="space-y-2.5">
                @foreach ([['sparkles','Getting started','Set up your workspace in under five minutes with our guided onboarding.'],['workflow','Automations','Trigger actions automatically based on events and schedules.'],['bar-chart-3','Reporting','Build dashboards and export data in the formats your team needs.']] as $i => [$ic, $q, $a])
                    <div class="overflow-hidden rounded-xl border border-border">
                        <button type="button" @click="active = active === {{ $i + 1 }} ? null : {{ $i + 1 }}"
                                class="flex w-full items-center justify-between gap-3 px-4 py-3.5 text-start text-sm font-semibold transition-all"
                                :class="active === {{ $i + 1 }} ? 'bg-gradient-to-r from-primary to-sidebar-primary text-white' : 'hover:bg-accent/50'">
                            <span class="flex items-center gap-2.5"><i data-lucide="{{ $ic }}" class="size-4"></i>{{ $q }}</span>
                            <i data-lucide="chevron-down" class="size-4 shrink-0 transition-transform duration-200" :class="active === {{ $i + 1 }} && 'rotate-180'"></i>
                        </button>
                        <div x-show="active === {{ $i + 1 }}" x-collapse x-cloak>
                            <p class="px-4 pb-4 pt-3 text-sm leading-relaxed text-muted-foreground">{{ $a }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </x-ui.card>
    </div>

    <x-demo-section title="FAQ, Nested & Collapse" desc="A rich FAQ with badges, a nested accordion, and standalone collapse toggles." />
    <div class="grid grid-cols-1 gap-4 lg:grid-cols-3">
        {{-- FAQ with badges --}}
        <x-ui.card title="FAQ" subtitle="With category badges">
            <div x-data="{ active: null }" class="space-y-2">
                @foreach ([
                    ['q' => 'Do you offer refunds?', 'badge' => 'Billing', 'variant' => 'info', 'a' => 'Yes, within 30 days of purchase, no questions asked.'],
                    ['q' => 'Is my data encrypted?', 'badge' => 'Security', 'variant' => 'success', 'a' => 'All data is encrypted in transit and at rest using AES-256.'],
                    ['q' => 'Can I self-host?', 'badge' => 'Enterprise', 'variant' => 'warning', 'a' => 'Self-hosting is available on the Enterprise plan.'],
                ] as $i => $item)
                    <div class="rounded-lg border border-border">
                        <button type="button" @click="active = active === {{ $i }} ? null : {{ $i }}" class="flex w-full items-start justify-between gap-2 p-3 text-start">
                            <span class="text-sm font-medium">{{ $item['q'] }}</span>
                            <i data-lucide="chevron-down" class="mt-0.5 size-4 shrink-0 text-muted-foreground transition-transform" :class="active === {{ $i }} && 'rotate-180'"></i>
                        </button>
                        <div x-show="active === {{ $i }}" x-collapse x-cloak>
                            <div class="px-3 pb-3">
                                <x-ui.badge :variant="$item['variant']">{{ $item['badge'] }}</x-ui.badge>
                                <p class="mt-2 text-sm text-muted-foreground">{{ $item['a'] }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </x-ui.card>

        {{-- Nested accordion --}}
        <x-ui.card title="Nested" subtitle="Accordion inside an accordion">
            <div x-data="{ p: 'docs' }" class="space-y-2">
                <div class="rounded-lg border border-border">
                    <button type="button" @click="p = p === 'docs' ? null : 'docs'" class="flex w-full items-center justify-between gap-2 px-3 py-2.5 text-sm font-semibold">
                        <span class="flex items-center gap-2"><i data-lucide="folder" class="size-4 text-primary"></i>Documentation</span>
                        <i data-lucide="chevron-down" class="size-4 text-muted-foreground transition-transform" :class="p === 'docs' && 'rotate-180'"></i>
                    </button>
                    <div x-show="p === 'docs'" x-collapse x-cloak>
                        <div class="px-3 pb-3" x-data="{ c: null }">
                            <div class="ms-2 space-y-1.5 border-s border-border ps-3">
                                @foreach (['Installation','Configuration','Deployment'] as $j => $sub)
                                    <div>
                                        <button type="button" @click="c = c === {{ $j }} ? null : {{ $j }}" class="flex w-full items-center justify-between gap-2 text-start text-sm text-muted-foreground hover:text-foreground">
                                            <span>{{ $sub }}</span>
                                            <i data-lucide="chevron-down" class="size-3.5 transition-transform" :class="c === {{ $j }} && 'rotate-180'"></i>
                                        </button>
                                        <div x-show="c === {{ $j }}" x-collapse x-cloak><p class="py-1.5 text-xs text-muted-foreground">Details about {{ $sub }} go here.</p></div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="rounded-lg border border-border">
                    <button type="button" @click="p = p === 'api' ? null : 'api'" class="flex w-full items-center justify-between gap-2 px-3 py-2.5 text-sm font-semibold">
                        <span class="flex items-center gap-2"><i data-lucide="folder" class="size-4 text-primary"></i>API Reference</span>
                        <i data-lucide="chevron-down" class="size-4 text-muted-foreground transition-transform" :class="p === 'api' && 'rotate-180'"></i>
                    </button>
                    <div x-show="p === 'api'" x-collapse x-cloak><p class="px-3 pb-3 text-sm text-muted-foreground">REST & webhook endpoints reference.</p></div>
                </div>
            </div>
        </x-ui.card>

        {{-- Collapse toggles --}}
        <x-ui.card title="Collapse" subtitle="Standalone show / hide">
            <div class="space-y-4">
                <div x-data="{ show: false }">
                    <x-ui.button variant="soft" size="sm" icon="chevron-down" class="[&>svg]:transition-transform" ::class="show && '[&>svg]:rotate-180'" @click="show = ! show" x-text="show ? 'Hide details' : 'Show details'">Show details</x-ui.button>
                    <div x-show="show" x-collapse x-cloak class="mt-3">
                        <x-ui.alert variant="info" title="Collapsible region">Expands with a smooth height transition via <code class="rounded bg-muted px-1 text-xs">x-collapse</code>.</x-ui.alert>
                    </div>
                </div>
                <div x-data="{ show: false }" class="rounded-xl border border-border p-3">
                    <div class="flex items-center justify-between">
                        <p class="text-sm font-medium">Advanced options</p>
                        <button type="button" role="switch" @click="show = ! show" :aria-checked="show"
                                class="relative h-6 w-11 rounded-full transition-colors" :class="show ? 'bg-primary' : 'bg-muted'">
                            <span class="absolute top-0.5 start-0.5 size-5 rounded-full bg-white shadow transition-transform" :class="show && 'translate-x-5 rtl:-translate-x-5'"></span>
                        </button>
                    </div>
                    <div x-show="show" x-collapse x-cloak>
                        <p class="pt-3 text-sm text-muted-foreground">Toggle-driven collapse — great for optional form sections and settings.</p>
                    </div>
                </div>
            </div>
        </x-ui.card>
    </div>
</div>
