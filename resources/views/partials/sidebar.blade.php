@php($cfg = config('adminkit'))

{{-- Mobile backdrop --}}
<div x-show="$store.ui.sidebarMobileOpen" x-cloak x-transition.opacity
     @click="$store.ui.closeMobileSidebar()"
     class="fixed inset-0 z-40 bg-black/50 lg:hidden"></div>

<aside
    x-data="{ hovering: false }"
    @mouseenter="hovering = true" @mouseleave="hovering = false"
    class="fixed inset-y-0 start-0 z-50 flex w-64 flex-col bg-sidebar text-sidebar-foreground shadow-xl transition-[transform,width] duration-200 ease-in-out lg:shadow-none"
    :class="[
        $store.ui.sidebarMobileOpen ? 'translate-x-0' : 'max-lg:ltr:-translate-x-full max-lg:rtl:translate-x-full',
        ($store.ui.sidebarCollapsed && !hovering) ? 'lg:w-[76px] is-rail' : 'lg:w-64',
        $store.ui.layout === 'horizontal' ? 'lg:hidden' : ''
    ]"
>
    {{-- Brand --}}
    <div class="sidebar-brand flex h-16 items-center gap-2.5 px-4">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-2.5 overflow-hidden">
            <span class="grid size-9 shrink-0 place-items-center rounded-xl bg-gradient-to-br from-sidebar-primary to-primary text-white shadow-lg shadow-primary/30">
                <i data-lucide="gem" class="size-5"></i>
            </span>
            <span class="sidebar-brand-text text-lg font-bold tracking-tight text-white">{{ $cfg['name'] }}</span>
        </a>
        <button type="button" @click="$store.ui.toggleSidebar()"
                class="sidebar-brand-text ms-auto hidden rounded-lg p-1.5 text-sidebar-muted hover:bg-white/5 hover:text-white lg:block">
            <i data-lucide="chevrons-left" class="size-5 transition-transform duration-200" :class="{ 'rotate-180': $store.ui.sidebarCollapsed }"></i>
        </button>
        <button type="button" @click="$store.ui.closeMobileSidebar()"
                class="ms-auto rounded-lg p-1.5 text-sidebar-muted hover:bg-white/5 hover:text-white lg:hidden">
            <i data-lucide="x" class="size-5"></i>
        </button>
    </div>

    {{-- Search + Nav --}}
    <div class="flex flex-1 flex-col overflow-hidden px-3 pb-2" x-data="{
        q: '',
        filter() {
            const term = this.q.toLowerCase().trim();
            const nav = this.$refs.nav;
            nav.classList.toggle('is-searching', term.length > 0);
            nav.querySelectorAll('li').forEach(li => {
                li.style.display = (!term || li.textContent.toLowerCase().includes(term)) ? '' : 'none';
            });
        }
    }">
        <div class="sidebar-search relative">
            <i data-lucide="search" class="pointer-events-none absolute inset-y-0 start-0 my-auto ms-3 size-4 text-sidebar-muted"></i>
            <input x-model="q" @input="filter()" type="text" placeholder="Search menu…"
                   class="h-9 w-full rounded-lg border border-sidebar-border bg-white/5 ps-9 pe-3 text-sm text-white placeholder:text-sidebar-muted focus:border-sidebar-primary/50 focus:outline-none focus:ring-1 focus:ring-sidebar-primary/40" />
        </div>

        <nav x-ref="nav" class="scrollbar-sidebar -mx-1 mt-1 flex-1 space-y-0.5 overflow-y-auto px-1">
            @foreach ($cfg['menu'] as $group)
                <p class="nav-group-label">{{ $group['group'] }}</p>
                <ul class="space-y-0.5">
                    @foreach ($group['items'] as $item)
                        @include('partials.menu-item', ['item' => $item, 'level' => 0])
                    @endforeach
                </ul>
            @endforeach
            <div class="h-4"></div>
        </nav>
    </div>

    {{-- User card --}}
    <div class="mt-auto border-t border-sidebar-border p-3">
        <a href="{{ route('settings') }}" class="sidebar-usercard flex items-center gap-3 rounded-xl p-2 transition-colors hover:bg-white/5">
            <x-ui.avatar :name="auth()->user()?->name ?? 'Guest User'" size="sm" status="online" />
            <div class="sidebar-usercard-text min-w-0 flex-1">
                <p class="truncate text-sm font-semibold text-white">{{ auth()->user()?->name ?? 'Guest User' }}</p>
                <p class="truncate text-xs text-sidebar-muted">{{ auth()->user()?->email ?? 'guest@adminkit.test' }}</p>
            </div>
            <i data-lucide="settings" class="sidebar-usercard-text size-4 text-sidebar-muted"></i>
        </a>
    </div>
</aside>
