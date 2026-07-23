<div x-data="{ view: 'grid', cat: 'All' }">
    <x-page-header :title="$pageTitle" subtitle="Pages · articles, categories & featured stories">
        <x-slot:actions>
            <x-ui.button variant="outline" icon="arrow-left" class="[&>svg]:rtl-flip" :href="route('dashboard')">Dashboard</x-ui.button>
            <x-ui.button icon="pen-line">Write post</x-ui.button>
        </x-slot:actions>
    </x-page-header>

    @php $detail = route('page', ['path' => 'blog-detail']); @endphp

    {{-- Featured --}}
    <a href="{{ $detail }}" wire:navigate class="ak-card group block overflow-hidden">
        <div class="grid grid-cols-1 md:grid-cols-2">
            <div class="relative min-h-56 overflow-hidden bg-muted">
                <img src="https://picsum.photos/seed/featured-post/800/600" alt="" loading="lazy" class="absolute inset-0 size-full object-cover transition-transform duration-500 group-hover:scale-105" />
                <span class="absolute start-4 top-4 rounded-full bg-black/40 px-3 py-1 text-xs font-semibold text-white backdrop-blur">Featured</span>
            </div>
            <div class="flex flex-col justify-center gap-3 p-6">
                <x-ui.badge variant="info">Engineering</x-ui.badge>
                <h2 class="text-2xl font-bold leading-tight transition-colors group-hover:text-primary">Building a design system that scales with your team</h2>
                <p class="text-sm text-muted-foreground">How we cut UI inconsistencies by 80% with tokens, a component library, and a culture of reuse across every product surface.</p>
                <div class="mt-1 flex items-center gap-3">
                    <x-ui.avatar name="Aisha Rahman" size="sm" />
                    <div class="text-sm"><p class="font-medium">Aisha Rahman</p><p class="text-xs text-muted-foreground">Jul 18, 2026 · 6 min read</p></div>
                </div>
            </div>
        </div>
    </a>

    {{-- Toolbar: categories + view toggle --}}
    <div class="mt-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div class="flex flex-wrap gap-2">
            @foreach (['All','Engineering','Design','Product','Company','Tutorials'] as $c)
                <button @click="cat = '{{ $c }}'" class="rounded-full border px-4 py-1.5 text-sm font-medium transition-colors" :class="cat === '{{ $c }}' ? 'border-primary bg-primary text-primary-foreground' : 'border-border hover:bg-accent'">{{ $c }}</button>
            @endforeach
        </div>
        <div class="flex items-center gap-1 self-start rounded-lg border border-border p-1 sm:self-auto">
            <button @click="view = 'grid'" aria-label="Grid view" class="grid size-8 place-items-center rounded-md transition-colors" :class="view === 'grid' ? 'bg-primary text-primary-foreground' : 'text-muted-foreground hover:bg-accent'"><i data-lucide="layout-grid" class="size-4"></i></button>
            <button @click="view = 'list'" aria-label="List view" class="grid size-8 place-items-center rounded-md transition-colors" :class="view === 'list' ? 'bg-primary text-primary-foreground' : 'text-muted-foreground hover:bg-accent'"><i data-lucide="list" class="size-4"></i></button>
        </div>
    </div>

    {{-- Posts --}}
    <div class="mt-4" :class="view === 'grid' ? 'grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3' : 'flex flex-col gap-3'">
        @php
            $posts = [
                ['Design','How we redesigned onboarding','A step-by-step look at cutting setup from 12 steps to 4.','David Chen','Jul 16','5 min','info'],
                ['Product','Shipping weekly without breaking things','Our release process, feature flags and safeguards.','Sofia Martinez','Jul 14','4 min','success'],
                ['Engineering','Taming N+1 queries at scale','Practical patterns for eager loading and caching.','Kenji Tanaka','Jul 11','8 min','default'],
                ['Company','We raised our Series A','What it means for our customers and roadmap.','Aisha Rahman','Jul 08','3 min','warning'],
                ['Tutorials','Dark mode done right','Theming with CSS variables and prefers-color-scheme.','Priya Sharma','Jul 05','6 min','info'],
                ['Design','Micro-interactions that delight','Small motion cues that make products feel alive.','Omar Haddad','Jul 02','5 min','default'],
            ];
        @endphp
        @foreach ($posts as [$cat,$title,$excerpt,$author,$date,$read,$tone])
            <a href="{{ $detail }}" wire:navigate class="ak-card group overflow-hidden transition-all hover:-translate-y-0.5 hover:shadow-md" :class="view === 'list' ? 'flex' : ''">
                <div class="relative overflow-hidden bg-muted" :class="view === 'grid' ? 'h-44' : 'w-32 shrink-0 self-stretch sm:w-56'">
                    <img src="https://picsum.photos/seed/{{ urlencode($title) }}/600/400" alt="" loading="lazy" class="absolute inset-0 size-full object-cover transition-transform duration-300 group-hover:scale-105" />
                    <span class="absolute start-3 top-3"><x-ui.badge :variant="$tone">{{ $cat }}</x-ui.badge></span>
                </div>
                <div class="flex-1 p-4">
                    <h3 class="font-semibold leading-snug transition-colors group-hover:text-primary">{{ $title }}</h3>
                    <p class="mt-1.5 text-sm text-muted-foreground line-clamp-2">{{ $excerpt }}</p>
                    <div class="mt-3 flex items-center gap-2.5 border-t border-border pt-3">
                        <x-ui.avatar :name="$author" size="xs" />
                        <span class="text-xs font-medium">{{ $author }}</span>
                        <span class="ms-auto text-xs text-muted-foreground">{{ $date }} · {{ $read }}</span>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
</div>
