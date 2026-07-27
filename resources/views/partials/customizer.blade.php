{{-- Theme customizer drawer (opens from the inline-end edge) --}}
<div x-cloak>
    {{-- Backdrop --}}
    <div x-show="$store.ui.customizerOpen" x-transition.opacity
         @click="$store.ui.customizerOpen = false"
         class="fixed inset-0 z-[90] bg-black/40"></div>

    <aside x-show="$store.ui.customizerOpen"
           x-transition:enter="transition ease-out duration-300"
           x-transition:enter-start="ltr:translate-x-full rtl:-translate-x-full"
           x-transition:enter-end="translate-x-0"
           x-transition:leave="transition ease-in duration-200"
           x-transition:leave-start="translate-x-0"
           x-transition:leave-end="ltr:translate-x-full rtl:-translate-x-full"
           class="customizer-drawer fixed inset-y-0 end-0 z-[95] flex w-[24rem] max-w-[92vw] flex-col bg-card text-card-foreground shadow-2xl">

        <div class="flex items-center justify-between border-b border-border px-5 py-4">
            <div class="flex items-center gap-2">
                <i data-lucide="palette" class="size-5 text-primary"></i>
                <div>
                    <h2 class="font-semibold leading-none">Customizer</h2>
                    <p class="mt-1 text-xs text-muted-foreground">Preview & tweak theme, sidebar, & navbar live</p>
                </div>
            </div>
            <button type="button" @click="$store.ui.customizerOpen = false" class="rounded-lg p-1.5 text-muted-foreground hover:bg-accent hover:text-foreground">
                <i data-lucide="x" class="size-5"></i>
            </button>
        </div>

        <div class="flex-1 space-y-6 overflow-y-auto p-5">
            {{-- Theme mode --}}
            <section>
                <h3 class="mb-2.5 text-xs font-semibold uppercase tracking-wide text-muted-foreground">Appearance</h3>
                <div class="grid grid-cols-3 gap-2">
                    @foreach (['light' => 'sun', 'dark' => 'moon', 'system' => 'monitor'] as $mode => $ico)
                        <button type="button" @click="$store.ui.setTheme('{{ $mode }}')"
                                :class="$store.ui.theme === '{{ $mode }}' ? 'border-primary ring-2 ring-primary/30 text-primary' : 'border-border text-muted-foreground hover:border-primary/40'"
                                class="flex flex-col items-center gap-1.5 rounded-xl border p-3 text-xs font-medium capitalize transition-all">
                            <i data-lucide="{{ $ico }}" class="size-5"></i>{{ $mode }}
                        </button>
                    @endforeach
                </div>
            </section>

            {{-- Sidebar Theme & Background Images --}}
            <section>
                <h3 class="mb-2.5 text-xs font-semibold uppercase tracking-wide text-muted-foreground">Sidebar Style & Colors</h3>
                <div class="grid grid-cols-4 gap-2 mb-2">
                    @foreach ([
                        'dark' => ['lbl' => 'Dark', 'dot' => 'bg-slate-900 border border-slate-700'],
                        'light' => ['lbl' => 'Light', 'dot' => 'bg-white border border-slate-300'],
                        'primary' => ['lbl' => 'Primary', 'dot' => 'bg-primary'],
                        'transparent' => ['lbl' => 'Glass', 'dot' => 'bg-slate-500/30 border border-slate-400'],
                    ] as $sc => $cfg)
                        <button type="button" @click="$store.ui.setSidebarColor ? $store.ui.setSidebarColor('{{ $sc }}') : ($store.ui.sidebarColor = '{{ $sc }}', $store.ui.apply && $store.ui.apply())"
                                :class="$store.ui.sidebarColor === '{{ $sc }}' ? 'border-primary ring-2 ring-primary/30 text-primary font-semibold' : 'border-border text-muted-foreground hover:border-primary/40'"
                                class="flex items-center justify-center gap-1.5 rounded-xl border p-2 text-center text-xs transition-all">
                            <span class="size-2.5 shrink-0 rounded-full {{ $cfg['dot'] }}"></span>
                            <span>{{ $cfg['lbl'] }}</span>
                        </button>
                    @endforeach
                </div>
                {{-- Sidebar Gradients --}}
                <div class="grid grid-cols-3 gap-2 mb-2">
                    @foreach ([
                        'gradient1' => ['lbl' => 'Grad 1', 'dot' => 'bg-gradient-to-br from-indigo-900 to-slate-900'],
                        'gradient2' => ['lbl' => 'Grad 2', 'dot' => 'bg-gradient-to-br from-teal-600 to-emerald-900'],
                        'gradient3' => ['lbl' => 'Grad 3', 'dot' => 'bg-gradient-to-br from-rose-600 to-rose-950'],
                    ] as $gKey => $gCfg)
                        <button type="button" @click="$store.ui.setSidebarColor ? $store.ui.setSidebarColor('{{ $gKey }}') : ($store.ui.sidebarColor = '{{ $gKey }}', $store.ui.apply && $store.ui.apply())"
                                :class="($store.ui.sidebarColor === '{{ $gKey }}' || ($store.ui.sidebarColor === 'gradient' && '{{ $gKey }}' === 'gradient1')) ? 'border-primary ring-2 ring-primary/30 text-primary font-semibold' : 'border-border text-muted-foreground hover:border-primary/40'"
                                class="flex items-center justify-center gap-1.5 rounded-xl border p-2 text-center text-xs transition-all">
                            <span class="size-2.5 shrink-0 rounded-full {{ $gCfg['dot'] }}"></span>
                            <span>{{ $gCfg['lbl'] }}</span>
                        </button>
                    @endforeach
                </div>
                {{-- Sidebar Images --}}
                <div class="grid grid-cols-3 gap-2">
                    @foreach (['image1' => 'Img 1', 'image2' => 'Img 2', 'image3' => 'Img 3'] as $imgKey => $imgLbl)
                        <button type="button" @click="$store.ui.setSidebarColor ? $store.ui.setSidebarColor('{{ $imgKey }}') : ($store.ui.sidebarColor = '{{ $imgKey }}', $store.ui.apply && $store.ui.apply())"
                                :class="$store.ui.sidebarColor === '{{ $imgKey }}' ? 'border-primary ring-2 ring-primary/30 text-primary font-semibold' : 'border-border text-muted-foreground hover:border-primary/40'"
                                class="flex items-center justify-center gap-1.5 rounded-xl border p-2 text-center text-xs transition-all">
                            <i data-lucide="image" class="size-3 shrink-0"></i>
                            <span>{{ $imgLbl }}</span>
                        </button>
                    @endforeach
                </div>
            </section>

            {{-- Header / Navbar Theme & Background Images --}}
            <section>
                <h3 class="mb-2.5 text-xs font-semibold uppercase tracking-wide text-muted-foreground">Header / Navbar Style</h3>
                <div class="grid grid-cols-4 gap-2 mb-2">
                    @foreach ([
                        'default' => ['lbl' => 'Default', 'dot' => 'bg-slate-400/40 border border-slate-400'],
                        'light' => ['lbl' => 'Light', 'dot' => 'bg-white border border-slate-300'],
                        'dark' => ['lbl' => 'Dark', 'dot' => 'bg-slate-900 border border-slate-700'],
                        'primary' => ['lbl' => 'Primary', 'dot' => 'bg-primary'],
                    ] as $nc => $cfg)
                        <button type="button" @click="$store.ui.setNavbarColor ? $store.ui.setNavbarColor('{{ $nc }}') : ($store.ui.navbarColor = '{{ $nc }}', $store.ui.apply && $store.ui.apply())"
                                :class="$store.ui.navbarColor === '{{ $nc }}' ? 'border-primary ring-2 ring-primary/30 text-primary font-semibold' : 'border-border text-muted-foreground hover:border-primary/40'"
                                class="flex items-center justify-center gap-1.5 rounded-xl border p-2 text-center text-xs transition-all">
                            <span class="size-2.5 shrink-0 rounded-full {{ $cfg['dot'] }}"></span>
                            <span>{{ $cfg['lbl'] }}</span>
                        </button>
                    @endforeach
                </div>
                {{-- Header Gradients --}}
                <div class="grid grid-cols-3 gap-2 mb-2">
                    @foreach ([
                        'gradient1' => ['lbl' => 'Grad 1', 'dot' => 'bg-gradient-to-r from-indigo-900 to-slate-900'],
                        'gradient2' => ['lbl' => 'Grad 2', 'dot' => 'bg-gradient-to-r from-teal-600 to-emerald-900'],
                        'gradient3' => ['lbl' => 'Grad 3', 'dot' => 'bg-gradient-to-r from-rose-600 to-rose-950'],
                    ] as $gKey => $gCfg)
                        <button type="button" @click="$store.ui.setNavbarColor ? $store.ui.setNavbarColor('{{ $gKey }}') : ($store.ui.navbarColor = '{{ $gKey }}', $store.ui.apply && $store.ui.apply())"
                                :class="($store.ui.navbarColor === '{{ $gKey }}' || ($store.ui.navbarColor === 'gradient' && '{{ $gKey }}' === 'gradient1')) ? 'border-primary ring-2 ring-primary/30 text-primary font-semibold' : 'border-border text-muted-foreground hover:border-primary/40'"
                                class="flex items-center justify-center gap-1.5 rounded-xl border p-2 text-center text-xs transition-all">
                            <span class="size-2.5 shrink-0 rounded-full {{ $gCfg['dot'] }}"></span>
                            <span>{{ $gCfg['lbl'] }}</span>
                        </button>
                    @endforeach
                </div>
                {{-- Header Images & Glass --}}
                <div class="grid grid-cols-3 gap-2">
                    <button type="button" @click="$store.ui.setNavbarColor ? $store.ui.setNavbarColor('transparent') : ($store.ui.navbarColor = 'transparent', $store.ui.apply && $store.ui.apply())"
                            :class="$store.ui.navbarColor === 'transparent' ? 'border-primary ring-2 ring-primary/30 text-primary font-semibold' : 'border-border text-muted-foreground hover:border-primary/40'"
                            class="flex items-center justify-center gap-1.5 rounded-xl border p-2 text-center text-xs transition-all">
                        <span class="size-2.5 shrink-0 rounded-full border border-slate-400 bg-slate-500/20"></span>
                        <span>Glass</span>
                    </button>
                    <button type="button" @click="$store.ui.setNavbarColor ? $store.ui.setNavbarColor('image1') : ($store.ui.navbarColor = 'image1', $store.ui.apply && $store.ui.apply())"
                            :class="$store.ui.navbarColor === 'image1' ? 'border-primary ring-2 ring-primary/30 text-primary font-semibold' : 'border-border text-muted-foreground hover:border-primary/40'"
                            class="flex items-center justify-center gap-1.5 rounded-xl border p-2 text-center text-xs transition-all">
                        <i data-lucide="image" class="size-3 shrink-0"></i>
                        <span>Img 1</span>
                    </button>
                    <button type="button" @click="$store.ui.setNavbarColor ? $store.ui.setNavbarColor('image2') : ($store.ui.navbarColor = 'image2', $store.ui.apply && $store.ui.apply())"
                            :class="$store.ui.navbarColor === 'image2' ? 'border-primary ring-2 ring-primary/30 text-primary font-semibold' : 'border-border text-muted-foreground hover:border-primary/40'"
                            class="flex items-center justify-center gap-1.5 rounded-xl border p-2 text-center text-xs transition-all">
                        <i data-lucide="image" class="size-3 shrink-0"></i>
                        <span>Img 2</span>
                    </button>
                </div>
            </section>

            {{-- Layout --}}
            <section>
                <h3 class="mb-2.5 text-xs font-semibold uppercase tracking-wide text-muted-foreground">Layout</h3>
                <div class="grid grid-cols-2 gap-2">
                    @foreach (['vertical' => 'panel-left', 'horizontal' => 'panel-top'] as $l => $ico)
                        <button type="button" @click="$store.ui.setLayout('{{ $l }}')"
                                :class="$store.ui.layout === '{{ $l }}' ? 'border-primary ring-2 ring-primary/30 text-primary' : 'border-border text-muted-foreground hover:border-primary/40'"
                                class="flex items-center justify-center gap-2 rounded-xl border p-3 text-sm font-medium capitalize transition-all">
                            <i data-lucide="{{ $ico }}" class="size-4"></i>{{ $l }}
                        </button>
                    @endforeach
                </div>
            </section>

            {{-- Direction --}}
            <section>
                <h3 class="mb-2.5 text-xs font-semibold uppercase tracking-wide text-muted-foreground">Direction</h3>
                <div class="grid grid-cols-2 gap-2">
                    @foreach (['ltr' => 'Left to Right', 'rtl' => 'Right to Left'] as $d => $lbl)
                        <button type="button" @click="$store.ui.setDirection('{{ $d }}')"
                                :class="$store.ui.direction === '{{ $d }}' ? 'border-primary ring-2 ring-primary/30 text-primary' : 'border-border text-muted-foreground hover:border-primary/40'"
                                class="rounded-xl border p-3 text-sm font-medium transition-all">
                            <span class="block text-base font-bold uppercase">{{ $d }}</span>
                            <span class="text-xs text-muted-foreground">{{ $lbl }}</span>
                        </button>
                    @endforeach
                </div>
            </section>

            {{-- Accent color --}}
            <section>
                <h3 class="mb-2.5 text-xs font-semibold uppercase tracking-wide text-muted-foreground">Accent color</h3>
                <div class="flex flex-wrap gap-2.5">
                    @foreach (['blue' => '#2563eb', 'violet' => '#7c3aed', 'green' => '#16a34a', 'rose' => '#e11d48', 'orange' => '#f97316', 'amber' => '#f59e0b', 'teal' => '#14b8a6'] as $name => $hex)
                        <button type="button" @click="$store.ui.setAccent('{{ $name }}')" title="{{ ucfirst($name) }}"
                                class="grid size-9 place-items-center rounded-full ring-offset-2 ring-offset-card transition-all"
                                :class="$store.ui.accent === '{{ $name }}' ? 'ring-2 ring-primary' : ''"
                                style="background: {{ $hex }}">
                            <i data-lucide="check" class="size-4 text-white" x-show="$store.ui.accent === '{{ $name }}'"></i>
                        </button>
                    @endforeach
                </div>
            </section>

            {{-- Radius --}}
            <section>
                <h3 class="mb-2.5 text-xs font-semibold uppercase tracking-wide text-muted-foreground">Border radius</h3>
                <div class="grid grid-cols-5 gap-2">
                    @foreach (['none', 'sm', 'md', 'lg', 'xl'] as $r)
                        <button type="button" @click="$store.ui.setRadius('{{ $r }}')"
                                :class="$store.ui.radius === '{{ $r }}' ? 'border-primary ring-2 ring-primary/30 text-primary' : 'border-border text-muted-foreground hover:border-primary/40'"
                                class="rounded-lg border py-2 text-xs font-semibold uppercase transition-all">{{ $r }}</button>
                    @endforeach
                </div>
            </section>

            {{-- Toggles --}}
            <section class="space-y-3">
                <h3 class="text-xs font-semibold uppercase tracking-wide text-muted-foreground">Options</h3>
                <label class="flex cursor-pointer items-center justify-between">
                    <span class="text-sm font-medium">Collapse sidebar</span>
                    <button type="button" role="switch" @click="$store.ui.toggleSidebar()"
                            :class="$store.ui.sidebarCollapsed ? 'bg-primary' : 'bg-muted'"
                            class="relative inline-flex h-6 w-11 items-center rounded-full transition-colors">
                        <span class="inline-block size-4 rounded-full bg-white shadow transition-transform"
                              :class="$store.ui.sidebarCollapsed ? 'ltr:translate-x-6 rtl:-translate-x-6' : 'ltr:translate-x-1 rtl:-translate-x-1'"></span>
                    </button>
                </label>
                <label class="flex cursor-pointer items-center justify-between">
                    <span class="text-sm font-medium">Sticky navbar</span>
                    <button type="button" role="switch" @click="$store.ui.navbarFixed = !$store.ui.navbarFixed"
                            :class="$store.ui.navbarFixed ? 'bg-primary' : 'bg-muted'"
                            class="relative inline-flex h-6 w-11 items-center rounded-full transition-colors">
                        <span class="inline-block size-4 rounded-full bg-white shadow transition-transform"
                              :class="$store.ui.navbarFixed ? 'ltr:translate-x-6 rtl:-translate-x-6' : 'ltr:translate-x-1 rtl:-translate-x-1'"></span>
                    </button>
                </label>
            </section>
        </div>

        <div class="border-t border-border p-4">
            <button type="button"
                    @click="localStorage.clear(); location.reload()"
                    class="flex w-full items-center justify-center gap-2 rounded-lg border border-border py-2.5 text-sm font-medium text-muted-foreground transition-colors hover:bg-accent hover:text-foreground">
                <i data-lucide="rotate-ccw" class="size-4"></i>Reset to defaults
            </button>
        </div>
    </aside>
</div>
