<div>
    <x-page-header :title="$pageTitle" subtitle="Ui Elements · loading indicators & skeleton screens">
        <x-slot:actions>
            <x-ui.badge variant="success" dot>12 spinners · 15 skeletons</x-ui.badge>
            <x-ui.button variant="outline" icon="arrow-left" class="[&>svg]:rtl-flip" :href="route('ui.elements')">All elements</x-ui.button>
        </x-slot:actions>
    </x-page-header>

    <x-demo-section title="Spinner styles" desc="Twelve looks, each in its own tile." />
    @php
        $spinners = [
            ['Ring',   '<i data-lucide="loader-circle" class="size-8 animate-spin text-primary"></i>'],
            ['Border', '<span class="block size-8 animate-spin rounded-full border-4 border-muted border-t-primary"></span>'],
            ['Dual',   '<span class="relative block size-8"><span class="absolute inset-0 animate-spin rounded-full border-4 border-transparent border-t-primary"></span><span class="absolute inset-2 animate-spin rounded-full border-4 border-transparent border-b-sidebar-primary [animation-direction:reverse]"></span></span>'],
            ['Conic',  '<span class="block size-8 animate-spin rounded-full" style="background:conic-gradient(from 0deg,transparent,hsl(var(--primary)));-webkit-mask:radial-gradient(farthest-side,transparent calc(100% - 4px),#000 0);mask:radial-gradient(farthest-side,transparent calc(100% - 4px),#000 0)"></span>'],
            ['Dots',   '<span class="flex gap-1.5"><span class="size-2.5 animate-bounce rounded-full bg-primary [animation-delay:-0.3s]"></span><span class="size-2.5 animate-bounce rounded-full bg-primary [animation-delay:-0.15s]"></span><span class="size-2.5 animate-bounce rounded-full bg-primary"></span></span>'],
            ['Wave',   '<span class="flex items-end gap-1"><span class="h-3 w-1.5 animate-bounce rounded-full bg-primary [animation-delay:-0.4s]"></span><span class="h-5 w-1.5 animate-bounce rounded-full bg-primary [animation-delay:-0.3s]"></span><span class="h-7 w-1.5 animate-bounce rounded-full bg-primary [animation-delay:-0.2s]"></span><span class="h-5 w-1.5 animate-bounce rounded-full bg-primary [animation-delay:-0.1s]"></span><span class="h-3 w-1.5 animate-bounce rounded-full bg-primary"></span></span>'],
            ['Bars',   '<span class="flex items-end gap-1"><span class="h-7 w-1.5 animate-pulse rounded-full bg-primary" style="animation-delay:-0.4s"></span><span class="h-7 w-1.5 animate-pulse rounded-full bg-primary" style="animation-delay:-0.2s"></span><span class="h-7 w-1.5 animate-pulse rounded-full bg-primary"></span><span class="h-7 w-1.5 animate-pulse rounded-full bg-primary" style="animation-delay:-0.3s"></span></span>'],
            ['Pulse',  '<span class="block size-8 animate-ping rounded-full bg-primary/60"></span>'],
            ['Ripple', '<span class="relative grid size-8 place-items-center"><span class="absolute size-8 animate-ping rounded-full border-2 border-primary"></span><span class="absolute size-8 animate-ping rounded-full border-2 border-primary [animation-delay:-0.6s]"></span></span>'],
            ['Grow',   '<span class="block size-8 animate-pulse rounded-full bg-primary"></span>'],
            ['Orbit',  '<span class="relative block size-8 animate-spin"><span class="absolute start-1/2 top-0 size-2.5 -translate-x-1/2 rounded-full bg-primary"></span><span class="absolute start-1/2 bottom-0 size-2.5 -translate-x-1/2 rounded-full bg-sidebar-primary"></span></span>'],
            ['Square', '<span class="block size-7 animate-spin rounded-md bg-gradient-to-br from-primary to-sidebar-primary"></span>'],
        ];
    @endphp
    <div class="grid grid-cols-2 gap-3 sm:grid-cols-3 lg:grid-cols-6">
        @foreach ($spinners as [$label, $html])
            <div class="flex flex-col items-center justify-center gap-3 rounded-xl border border-border bg-card p-5">
                <div class="grid h-10 place-items-center">{!! $html !!}</div>
                <p class="text-xs font-medium text-muted-foreground">{{ $label }}</p>
            </div>
        @endforeach
    </div>

    <x-demo-section title="Sizes & colours" desc="Scale and tone to context." />
    <div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
        <x-ui.card title="Sizes">
            <div class="flex flex-wrap items-center gap-8">
                @foreach (['size-4'=>'xs','size-6'=>'sm','size-8'=>'md','size-10'=>'lg','size-14'=>'xl'] as $s => $l)
                    <div class="flex flex-col items-center gap-2"><i data-lucide="loader-circle" class="{{ $s }} animate-spin text-primary"></i><span class="text-xs text-muted-foreground">{{ $l }}</span></div>
                @endforeach
            </div>
        </x-ui.card>
        <x-ui.card title="Colours">
            <div class="flex flex-wrap items-center gap-8">
                @foreach (['text-primary'=>'Primary','text-success'=>'Success','text-[hsl(var(--warning))]'=>'Warning','text-destructive'=>'Danger','text-muted-foreground'=>'Muted'] as $c => $l)
                    <div class="flex flex-col items-center gap-2"><i data-lucide="loader-circle" class="size-8 animate-spin {{ $c }}"></i><span class="text-xs text-muted-foreground">{{ $l }}</span></div>
                @endforeach
            </div>
        </x-ui.card>
    </div>

    <x-demo-section title="Determinate & in context" desc="Percentage rings, buttons, inline and overlays." />
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
        <x-ui.card title="With percentage">
            <div class="flex items-center justify-around">
                <x-ui.gauge :value="68" tone="primary" :size="80" :stroke="7" />
                <x-ui.gauge :value="34" tone="success" :size="80" :stroke="7" />
            </div>
        </x-ui.card>
        <x-ui.card title="Buttons">
            <div class="space-y-2">
                <x-ui.button :loading="true" class="w-full">Saving…</x-ui.button>
                <x-ui.button variant="outline" :loading="true" class="w-full">Loading</x-ui.button>
            </div>
        </x-ui.card>
        <x-ui.card title="Inline">
            <div class="space-y-3 text-sm text-muted-foreground">
                <p class="flex items-center gap-2"><i data-lucide="loader-circle" class="size-4 animate-spin"></i>Fetching results…</p>
                <p class="flex items-center gap-2"><span class="flex gap-1"><span class="size-1.5 animate-bounce rounded-full bg-current [animation-delay:-0.3s]"></span><span class="size-1.5 animate-bounce rounded-full bg-current [animation-delay:-0.15s]"></span><span class="size-1.5 animate-bounce rounded-full bg-current"></span></span>Typing</p>
                <p class="flex items-center gap-2"><span class="size-2 animate-ping rounded-full bg-success"></span>Live syncing</p>
            </div>
        </x-ui.card>
        <x-ui.card title="Overlay" :padded="false">
            <div class="relative p-5">
                <div class="space-y-2 opacity-40"><div class="h-3 w-3/4 rounded bg-muted"></div><div class="h-3 w-full rounded bg-muted"></div><div class="h-3 w-2/3 rounded bg-muted"></div></div>
                <div class="absolute inset-0 grid place-items-center rounded-xl bg-card/70 backdrop-blur-[2px]">
                    <div class="flex flex-col items-center gap-2"><i data-lucide="loader-circle" class="size-7 animate-spin text-primary"></i><span class="text-xs font-medium text-muted-foreground">Loading…</span></div>
                </div>
            </div>
        </x-ui.card>
    </div>

    {{-- ═══════════════ SKELETONS ═══════════════ --}}
    <div x-data="{ loading: true }">
        <x-demo-section title="Skeleton screens" desc="Fifteen shimmer placeholders — toggle to compare against the real content." />

        <x-ui.card class="mb-4">
            <div class="flex flex-wrap items-center justify-between gap-3">
                <p class="text-sm text-muted-foreground">Every block below uses the same shimmer utility.</p>
                <div class="flex gap-2">
                    <x-ui.button size="sm" variant="soft" icon="rotate-cw" @click="loading = true; setTimeout(() => loading = false, 2200)">Simulate load</x-ui.button>
                    <x-ui.button size="sm" variant="outline" @click="loading = ! loading" x-text="loading ? 'Show content' : 'Show skeleton'">Toggle</x-ui.button>
                </div>
            </div>
        </x-ui.card>

        <div class="grid grid-cols-1 gap-4 lg:grid-cols-3">
            <x-ui.card title="Text lines">
                <div x-show="loading" class="space-y-2"><div class="skeleton h-3 w-full"></div><div class="skeleton h-3 w-11/12"></div><div class="skeleton h-3 w-4/5"></div><div class="skeleton h-3 w-2/3"></div></div>
                <p x-show="! loading" x-cloak class="text-sm text-muted-foreground">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            </x-ui.card>

            <x-ui.card title="List items">
                <div x-show="loading" class="space-y-3">
                    @for ($i = 0; $i < 3; $i++)<div class="flex items-center gap-3"><div class="skeleton size-10 rounded-full"></div><div class="flex-1 space-y-2"><div class="skeleton h-3 w-2/3"></div><div class="skeleton h-2.5 w-1/3"></div></div></div>@endfor
                </div>
                <div x-show="! loading" x-cloak class="space-y-3">
                    @foreach ([['Aisha Rahman','Admin'],['David Chen','Editor'],['Sofia Martinez','Viewer']] as [$n,$r])
                        <div class="flex items-center gap-3"><x-ui.avatar :name="$n" size="md" /><div><p class="text-sm font-medium">{{ $n }}</p><p class="text-xs text-muted-foreground">{{ $r }}</p></div></div>
                    @endforeach
                </div>
            </x-ui.card>

            <x-ui.card title="Media card">
                <div x-show="loading" class="space-y-3"><div class="skeleton h-32 w-full rounded-xl"></div><div class="skeleton h-3 w-3/4"></div><div class="skeleton h-3 w-1/2"></div></div>
                <div x-show="! loading" x-cloak class="space-y-3">
                    <img src="https://picsum.photos/seed/skel-media/600/400" alt="" class="h-32 w-full rounded-xl object-cover" />
                    <p class="font-medium">Mountain retreat</p><p class="text-sm text-muted-foreground">Uploaded 2 hours ago</p>
                </div>
            </x-ui.card>

            <x-ui.card title="Profile header">
                <div x-show="loading" class="flex flex-col items-center gap-3">
                    <div class="skeleton size-20 rounded-full"></div><div class="skeleton h-4 w-32"></div><div class="skeleton h-3 w-24"></div>
                    <div class="flex w-full gap-2"><div class="skeleton h-9 flex-1 rounded-lg"></div><div class="skeleton h-9 flex-1 rounded-lg"></div></div>
                </div>
                <div x-show="! loading" x-cloak class="flex flex-col items-center gap-1 text-center">
                    <x-ui.avatar name="Yrizzz Admin" size="xl" /><p class="mt-1 font-bold">Yrizzz</p><p class="text-sm text-muted-foreground">Product Designer</p>
                    <div class="mt-2 flex w-full gap-2"><x-ui.button size="sm" class="flex-1">Follow</x-ui.button><x-ui.button size="sm" variant="outline" class="flex-1">Message</x-ui.button></div>
                </div>
            </x-ui.card>

            <x-ui.card title="Stat tiles">
                <div x-show="loading" class="grid grid-cols-2 gap-3">
                    @for ($i = 0; $i < 4; $i++)<div class="space-y-2 rounded-xl border border-border p-3"><div class="skeleton size-8 rounded-lg"></div><div class="skeleton h-5 w-16"></div><div class="skeleton h-2.5 w-12"></div></div>@endfor
                </div>
                <div x-show="! loading" x-cloak class="grid grid-cols-2 gap-3">
                    @foreach ([['dollar-sign','$48k','Revenue'],['users','8,942','Users'],['shopping-cart','1,304','Orders'],['activity','24.8%','Bounce']] as [$ic,$v,$l])
                        <div class="rounded-xl border border-border p-3"><span class="grid size-8 place-items-center rounded-lg bg-primary/10 text-primary"><i data-lucide="{{ $ic }}" class="size-4"></i></span><p class="mt-1.5 text-lg font-bold">{{ $v }}</p><p class="text-xs text-muted-foreground">{{ $l }}</p></div>
                    @endforeach
                </div>
            </x-ui.card>

            <x-ui.card title="Table rows">
                <div x-show="loading" class="space-y-3">
                    @for ($i = 0; $i < 4; $i++)<div class="flex items-center gap-3"><div class="skeleton size-8 rounded-full"></div><div class="skeleton h-3 flex-1"></div><div class="skeleton h-3 w-14"></div><div class="skeleton h-5 w-16 rounded-full"></div></div>@endfor
                </div>
                <div x-show="! loading" x-cloak class="space-y-3">
                    @foreach ([['Aisha Rahman','Admin','success'],['David Chen','Editor','info'],['Sofia Martinez','Viewer','muted'],['Omar Haddad','Editor','info']] as [$n,$r,$t])
                        <div class="flex items-center gap-3"><x-ui.avatar :name="$n" size="sm" /><span class="flex-1 text-sm">{{ $n }}</span><span class="text-sm text-muted-foreground">{{ $r }}</span><x-ui.badge :variant="$t">Active</x-ui.badge></div>
                    @endforeach
                </div>
            </x-ui.card>

            <x-ui.card title="Article">
                <div x-show="loading" class="space-y-3">
                    <div class="skeleton h-5 w-20 rounded-full"></div><div class="skeleton h-5 w-full"></div><div class="skeleton h-5 w-4/5"></div>
                    <div class="flex items-center gap-2 pt-1"><div class="skeleton size-7 rounded-full"></div><div class="skeleton h-2.5 w-24"></div></div>
                    <div class="space-y-2 pt-1"><div class="skeleton h-3 w-full"></div><div class="skeleton h-3 w-11/12"></div><div class="skeleton h-3 w-3/4"></div></div>
                </div>
                <div x-show="! loading" x-cloak>
                    <x-ui.badge variant="info">Engineering</x-ui.badge>
                    <h3 class="mt-2 text-lg font-bold leading-snug">Building a design system that scales</h3>
                    <div class="mt-2 flex items-center gap-2"><x-ui.avatar name="Aisha Rahman" size="xs" /><span class="text-xs text-muted-foreground">Aisha · 6 min read</span></div>
                    <p class="mt-2 text-sm text-muted-foreground">How we cut UI inconsistencies by 80% with tokens and a shared library.</p>
                </div>
            </x-ui.card>

            <x-ui.card title="Chat">
                <div x-show="loading" class="space-y-3">
                    <div class="flex gap-2"><div class="skeleton size-7 shrink-0 rounded-full"></div><div class="skeleton h-10 w-2/3 rounded-2xl"></div></div>
                    <div class="flex justify-end"><div class="skeleton h-8 w-1/2 rounded-2xl"></div></div>
                    <div class="flex gap-2"><div class="skeleton size-7 shrink-0 rounded-full"></div><div class="skeleton h-8 w-3/5 rounded-2xl"></div></div>
                </div>
                <div x-show="! loading" x-cloak class="space-y-3 text-sm">
                    <div class="flex gap-2"><x-ui.avatar name="Aisha Rahman" size="xs" /><p class="rounded-2xl rounded-bl-sm border border-border bg-card px-3 py-2">Did you review the PR?</p></div>
                    <div class="flex justify-end"><p class="rounded-2xl rounded-br-sm bg-primary px-3 py-2 text-primary-foreground">Yep, left comments!</p></div>
                </div>
            </x-ui.card>

            <x-ui.card title="Form">
                <div x-show="loading" class="space-y-4">
                    @for ($i = 0; $i < 2; $i++)<div class="space-y-1.5"><div class="skeleton h-2.5 w-24"></div><div class="skeleton h-10 w-full rounded-lg"></div></div>@endfor
                    <div class="skeleton h-10 w-full rounded-lg"></div>
                </div>
                <div x-show="! loading" x-cloak class="space-y-4">
                    <x-ui.input label="Full name" placeholder="Yrizzz" />
                    <x-ui.input label="Email" type="email" placeholder="you@company.com" />
                    <x-ui.button class="w-full">Save changes</x-ui.button>
                </div>
            </x-ui.card>

            <x-ui.card title="Gallery">
                <div x-show="loading" class="grid grid-cols-3 gap-2">@for ($i = 0; $i < 6; $i++)<div class="skeleton aspect-square rounded-lg"></div>@endfor</div>
                <div x-show="! loading" x-cloak class="grid grid-cols-3 gap-2">@for ($i = 1; $i <= 6; $i++)<img src="https://picsum.photos/seed/skelgal-{{ $i }}/200/200" alt="" class="aspect-square rounded-lg object-cover" />@endfor</div>
            </x-ui.card>

            <x-ui.card title="Comments">
                <div x-show="loading" class="space-y-4">
                    @for ($i = 0; $i < 2; $i++)<div class="flex gap-3"><div class="skeleton size-9 shrink-0 rounded-full"></div><div class="flex-1 space-y-2"><div class="skeleton h-2.5 w-28"></div><div class="skeleton h-3 w-full"></div><div class="skeleton h-3 w-4/5"></div></div></div>@endfor
                </div>
                <div x-show="! loading" x-cloak class="space-y-4">
                    @foreach ([['David Chen','This resonates — great write-up!'],['Sofia Martinez','How do you version tokens?']] as [$n,$c])
                        <div class="flex gap-3"><x-ui.avatar :name="$n" size="sm" /><div><p class="text-sm font-semibold">{{ $n }}</p><p class="text-sm text-muted-foreground">{{ $c }}</p></div></div>
                    @endforeach
                </div>
            </x-ui.card>

            <x-ui.card title="Product card">
                <div x-show="loading" class="space-y-3">
                    <div class="skeleton aspect-square w-full rounded-xl"></div><div class="skeleton h-3 w-3/4"></div>
                    <div class="flex items-center justify-between"><div class="skeleton h-5 w-16"></div><div class="skeleton size-9 rounded-lg"></div></div>
                </div>
                <div x-show="! loading" x-cloak class="space-y-3">
                    <img src="https://picsum.photos/seed/skel-prod/400/400" alt="" class="aspect-square w-full rounded-xl object-cover" />
                    <p class="text-sm font-semibold">Wireless Headphones</p>
                    <div class="flex items-center justify-between"><span class="text-lg font-bold">$129.00</span><button class="grid size-9 place-items-center rounded-lg bg-primary text-primary-foreground"><i data-lucide="plus" class="size-4"></i></button></div>
                </div>
            </x-ui.card>

            <x-ui.card title="Chart">
                <div x-show="loading" class="space-y-3">
                    <div class="flex items-end gap-2">@foreach (['h-16','h-24','h-12','h-28','h-20','h-32','h-14'] as $h)<div class="skeleton flex-1 {{ $h }} rounded-md"></div>@endforeach</div>
                    <div class="flex justify-between"><div class="skeleton h-2.5 w-20"></div><div class="skeleton h-2.5 w-12"></div></div>
                </div>
                <div x-show="! loading" x-cloak>
                    <div class="flex items-end gap-2">@foreach (['h-16','h-24','h-12','h-28','h-20','h-32','h-14'] as $h)<div class="flex-1 {{ $h }} rounded-md bg-gradient-to-t from-primary to-sidebar-primary"></div>@endforeach</div>
                    <div class="mt-3 flex justify-between text-xs text-muted-foreground"><span>Last 7 days</span><span class="font-semibold text-success">+12.5%</span></div>
                </div>
            </x-ui.card>

            <x-ui.card title="Sidebar nav">
                <div x-show="loading" class="space-y-2">
                    @foreach (['w-2/3','w-1/2','w-3/4','w-2/5','w-3/5'] as $w)<div class="flex items-center gap-3"><div class="skeleton size-6 rounded-md"></div><div class="skeleton h-3 {{ $w }}"></div></div>@endforeach
                </div>
                <div x-show="! loading" x-cloak class="space-y-1">
                    @foreach ([['layout-dashboard','Dashboard'],['users','Team'],['folder','Projects'],['chart-line','Reports'],['settings','Settings']] as [$ic,$l])
                        <div class="flex items-center gap-3 rounded-lg px-2 py-1.5 text-sm hover:bg-accent"><i data-lucide="{{ $ic }}" class="size-4 text-muted-foreground"></i>{{ $l }}</div>
                    @endforeach
                </div>
            </x-ui.card>

            <x-ui.card title="Kanban column">
                <div x-show="loading" class="space-y-2">
                    <div class="skeleton h-3 w-24"></div>
                    @for ($i = 0; $i < 3; $i++)
                        <div class="space-y-2 rounded-lg border border-border p-2.5"><div class="skeleton h-1.5 w-10 rounded-full"></div><div class="skeleton h-3 w-full"></div><div class="flex justify-between"><div class="skeleton h-2.5 w-12"></div><div class="skeleton size-5 rounded-full"></div></div></div>
                    @endfor
                </div>
                <div x-show="! loading" x-cloak class="space-y-2">
                    <p class="text-sm font-semibold">In Progress</p>
                    @foreach ([['Build settings screen','Feature'],['Refactor auth guard','Backend'],['Audit contrast','A11y']] as [$t,$tag])
                        <div class="rounded-lg border border-border p-2.5">
                            <span class="block h-1.5 w-10 rounded-full bg-primary"></span>
                            <p class="mt-1.5 text-sm font-medium">{{ $t }}</p>
                            <div class="mt-1.5 flex items-center justify-between"><span class="text-xs text-muted-foreground">{{ $tag }}</span><x-ui.avatar name="David Chen" size="xs" /></div>
                        </div>
                    @endforeach
                </div>
            </x-ui.card>
        </div>

        <x-demo-section title="Full page skeleton" desc="A composite layout while a whole screen boots." />
        <x-ui.card>
            <div x-show="loading" class="space-y-4">
                <div class="flex items-center justify-between"><div class="space-y-2"><div class="skeleton h-5 w-40"></div><div class="skeleton h-3 w-56"></div></div><div class="skeleton h-9 w-28 rounded-lg"></div></div>
                <div class="grid grid-cols-2 gap-3 lg:grid-cols-4">
                    @for ($i = 0; $i < 4; $i++)<div class="space-y-2 rounded-xl border border-border p-4"><div class="skeleton h-2.5 w-16"></div><div class="skeleton h-6 w-24"></div><div class="skeleton h-2.5 w-20"></div></div>@endfor
                </div>
                <div class="grid grid-cols-1 gap-3 lg:grid-cols-3">
                    <div class="skeleton h-48 rounded-xl lg:col-span-2"></div>
                    <div class="space-y-3 rounded-xl border border-border p-4">
                        @for ($i = 0; $i < 4; $i++)<div class="flex items-center gap-3"><div class="skeleton size-9 rounded-lg"></div><div class="flex-1 space-y-1.5"><div class="skeleton h-2.5 w-3/4"></div><div class="skeleton h-2.5 w-1/3"></div></div></div>@endfor
                    </div>
                </div>
            </div>
            <div x-show="! loading" x-cloak class="grid place-items-center py-16 text-center">
                <div>
                    <span class="mx-auto grid size-14 place-items-center rounded-2xl bg-success/10 text-success"><i data-lucide="circle-check-big" class="size-7"></i></span>
                    <p class="mt-3 font-semibold">Dashboard loaded</p>
                    <p class="text-sm text-muted-foreground">Toggle above to see the skeleton again.</p>
                </div>
            </div>
        </x-ui.card>
    </div>
</div>
