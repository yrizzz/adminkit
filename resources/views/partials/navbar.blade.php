@php($cfg = config('adminkit'))
@php($crumbs = $breadcrumbs ?? [])

<header
    class="sticky top-0 z-30 flex h-16 items-center gap-2 border-b border-border bg-background/80 px-4 backdrop-blur-lg supports-[backdrop-filter]:bg-background/60"
    :class="$store.ui.navbarFixed ? 'sticky top-0' : ''"
>
    {{-- Mobile: open sidebar --}}
    <button type="button" @click="$store.ui.openMobileSidebar()"
            class="rounded-lg p-2 text-muted-foreground hover:bg-accent hover:text-foreground lg:hidden">
        <i data-lucide="menu" class="size-5"></i>
    </button>

    {{-- Horizontal layout brand --}}
    <a href="{{ route('dashboard') }}" wire:navigate x-show="$store.ui.layout === 'horizontal'" x-cloak
       class="me-2 hidden items-center gap-2.5 lg:flex">
        <span class="grid size-9 place-items-center rounded-xl bg-gradient-to-br from-primary to-sidebar-primary text-white shadow-lg shadow-primary/30">
            <i data-lucide="gem" class="size-5"></i>
        </span>
        <span class="text-lg font-bold tracking-tight">{{ $cfg['name'] }}</span>
    </a>

    {{-- Desktop: sidebar collapse (vertical only) --}}
    <button type="button" @click="$store.ui.toggleSidebar()" x-show="$store.ui.layout === 'vertical'"
            class="hidden rounded-lg p-2 text-muted-foreground hover:bg-accent hover:text-foreground lg:inline-flex">
        <i data-lucide="panel-left" class="size-5"></i>
    </button>

    {{-- Breadcrumb --}}
    <nav aria-label="Breadcrumb" class="hidden min-w-0 items-center gap-1.5 text-sm sm:flex">
        <a href="{{ route('dashboard') }}" wire:navigate class="flex items-center text-muted-foreground hover:text-foreground">
            <i data-lucide="house" class="size-4"></i>
        </a>
        @foreach ($crumbs as $c)
            <i data-lucide="chevron-right" class="rtl-flip size-4 text-muted-foreground/50"></i>
            @if (! $loop->last && ! empty($c['href']))
                <a href="{{ $c['href'] }}" class="truncate text-muted-foreground hover:text-foreground">{{ $c['label'] }}</a>
            @else
                <span class="truncate font-medium text-foreground">{{ $c['label'] }}</span>
            @endif
        @endforeach
    </nav>

    <div class="flex flex-1 items-center justify-end gap-1">
        {{-- Command palette trigger --}}
        <button type="button" @click="$store.ui.commandOpen = true"
                class="me-1 hidden items-center gap-2 rounded-lg border border-border bg-muted/40 py-1.5 pe-2 ps-3 text-sm text-muted-foreground transition-colors hover:bg-muted md:flex">
            <i data-lucide="search" class="size-4"></i>
            <span>Search…</span>
            <kbd class="rounded border border-border bg-background px-1.5 py-0.5 text-[0.65rem] font-semibold">⌘K</kbd>
        </button>
        <button type="button" @click="$store.ui.commandOpen = true"
                class="rounded-lg p-2 text-muted-foreground hover:bg-accent hover:text-foreground md:hidden">
            <i data-lucide="search" class="size-5"></i>
        </button>

        {{-- Language / direction --}}
        <x-ui.dropdown align="end" width="w-52">
            <x-slot:trigger>
                <button type="button" class="rounded-lg p-2 text-muted-foreground hover:bg-accent hover:text-foreground">
                    <i data-lucide="languages" class="size-5"></i>
                </button>
            </x-slot:trigger>
            <p class="px-2.5 pb-1 pt-1.5 text-xs font-semibold text-muted-foreground">Language & Direction</p>
            <x-ui.dropdown-item icon="flag" @click="$store.ui.setDirection('ltr')">English <span class="ms-auto text-xs text-muted-foreground">LTR</span></x-ui.dropdown-item>
            <x-ui.dropdown-item icon="flag" @click="$store.ui.setDirection('rtl')">العربية <span class="ms-auto text-xs text-muted-foreground">RTL</span></x-ui.dropdown-item>
            <x-ui.dropdown-item icon="flag" @click="$store.ui.setDirection('rtl')">עברית <span class="ms-auto text-xs text-muted-foreground">RTL</span></x-ui.dropdown-item>
            <x-ui.dropdown-item icon="flag" @click="$store.ui.setDirection('ltr')">Español <span class="ms-auto text-xs text-muted-foreground">LTR</span></x-ui.dropdown-item>
            <div class="my-1 border-t border-border"></div>
            <button type="button" @click="$store.ui.toggleDirection()"
                    class="flex w-full items-center gap-2.5 rounded-lg px-2.5 py-2 text-sm font-medium text-foreground hover:bg-accent">
                <i data-lucide="arrow-left-right" class="size-4 text-muted-foreground"></i>
                Toggle RTL / LTR
                <span class="ms-auto text-xs font-semibold uppercase text-primary" x-text="$store.ui.direction"></span>
            </button>
        </x-ui.dropdown>

        {{-- Notifications --}}
        <x-ui.dropdown align="end" width="w-80">
            <x-slot:trigger>
                <button type="button" class="relative rounded-lg p-2 text-muted-foreground hover:bg-accent hover:text-foreground">
                    <i data-lucide="bell" class="size-5"></i>
                    <span class="absolute end-1.5 top-1.5 flex size-2">
                        <span class="absolute inline-flex size-full animate-ping rounded-full bg-primary opacity-75"></span>
                        <span class="relative inline-flex size-2 rounded-full bg-primary"></span>
                    </span>
                </button>
            </x-slot:trigger>
            <div class="flex items-center justify-between px-2.5 py-1.5">
                <p class="text-sm font-semibold">Notifications</p>
                <x-ui.badge variant="default">4 new</x-ui.badge>
            </div>
            <div class="my-1 border-t border-border"></div>
            <div class="max-h-72 space-y-0.5 overflow-y-auto">
                @foreach ([
                    ['i'=>'user-plus','t'=>'New user registered','d'=>'Aisha joined the workspace','a'=>'2m','tone'=>'text-info bg-info/10'],
                    ['i'=>'shopping-cart','t'=>'New order #4821','d'=>'Payment confirmed — $249.00','a'=>'18m','tone'=>'text-success bg-success/10'],
                    ['i'=>'triangle-alert','t'=>'Storage almost full','d'=>'92% of your quota is used','a'=>'1h','tone'=>'text-[hsl(var(--warning))] bg-warning/10'],
                    ['i'=>'message-square','t'=>'New comment','d'=>'“Great work on the dashboard!”','a'=>'3h','tone'=>'text-primary bg-primary/10'],
                ] as $n)
                    <a href="#" class="flex gap-3 rounded-lg p-2 hover:bg-accent">
                        <span class="grid size-9 shrink-0 place-items-center rounded-lg {{ $n['tone'] }}"><i data-lucide="{{ $n['i'] }}" class="size-4"></i></span>
                        <div class="min-w-0 flex-1">
                            <p class="truncate text-sm font-medium">{{ $n['t'] }}</p>
                            <p class="truncate text-xs text-muted-foreground">{{ $n['d'] }}</p>
                        </div>
                        <span class="shrink-0 text-xs text-muted-foreground">{{ $n['a'] }}</span>
                    </a>
                @endforeach
            </div>
            <div class="my-1 border-t border-border"></div>
            <a href="#" class="block rounded-lg px-2.5 py-2 text-center text-sm font-medium text-primary hover:bg-accent">View all notifications</a>
        </x-ui.dropdown>

        {{-- Theme toggle --}}
        <button type="button" @click="$store.ui.toggleTheme()"
                class="rounded-lg p-2 text-muted-foreground hover:bg-accent hover:text-foreground">
            <i data-lucide="sun" class="size-5" x-show="$store.ui.isDark" x-cloak></i>
            <i data-lucide="moon" class="size-5" x-show="!$store.ui.isDark"></i>
        </button>

        {{-- Customizer --}}
        <button type="button" @click="$store.ui.customizerOpen = true"
                class="rounded-lg p-2 text-muted-foreground hover:bg-accent hover:text-foreground">
            <i data-lucide="settings-2" class="size-5"></i>
        </button>

        {{-- Profile --}}
        <x-ui.dropdown align="end" width="w-60">
            <x-slot:trigger>
                <button type="button" class="ms-1 flex items-center gap-2 rounded-lg p-1 hover:bg-accent">
                    <x-ui.avatar :name="auth()->user()?->name ?? 'Guest User'" size="sm" />
                    <span class="hidden text-start sm:block">
                        <span class="block text-sm font-semibold leading-tight">{{ Str::of(auth()->user()?->name ?? 'Guest')->explode(' ')->first() }}</span>
                        <span class="block text-xs leading-tight text-muted-foreground">Administrator</span>
                    </span>
                    <i data-lucide="chevron-down" class="hidden size-4 text-muted-foreground sm:block"></i>
                </button>
            </x-slot:trigger>
            <div class="flex items-center gap-3 px-2 py-2">
                <x-ui.avatar :name="auth()->user()?->name ?? 'Guest User'" size="md" status="online" />
                <div class="min-w-0">
                    <p class="truncate text-sm font-semibold">{{ auth()->user()?->name ?? 'Guest User' }}</p>
                    <p class="truncate text-xs text-muted-foreground">{{ auth()->user()?->email ?? 'guest@adminkit.test' }}</p>
                </div>
            </div>
            <div class="my-1 border-t border-border"></div>
            <x-ui.dropdown-item icon="circle-user" :href="route('settings')" wire:navigate>Profile</x-ui.dropdown-item>
            <x-ui.dropdown-item icon="settings" :href="route('settings')" wire:navigate>Settings</x-ui.dropdown-item>
            <x-ui.dropdown-item icon="credit-card" href="#">Billing</x-ui.dropdown-item>
            <x-ui.dropdown-item icon="life-buoy" href="#">Support</x-ui.dropdown-item>
            <div class="my-1 border-t border-border"></div>
            @auth
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-ui.dropdown-item icon="log-out" variant="destructive" type="submit">Sign out</x-ui.dropdown-item>
                </form>
            @else
                <x-ui.dropdown-item icon="log-in" :href="route('login')">Sign in</x-ui.dropdown-item>
            @endauth
        </x-ui.dropdown>
    </div>
</header>
