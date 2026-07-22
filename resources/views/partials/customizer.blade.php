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
           class="fixed inset-y-0 end-0 z-[95] flex w-[22rem] max-w-[90vw] flex-col bg-card text-card-foreground shadow-2xl">

        <div class="flex items-center justify-between border-b border-border px-5 py-4">
            <div class="flex items-center gap-2">
                <i data-lucide="palette" class="size-5 text-primary"></i>
                <div>
                    <h2 class="font-semibold leading-none">Customizer</h2>
                    <p class="mt-1 text-xs text-muted-foreground">Preview & tweak the theme live</p>
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
