<div>
    <x-page-header :title="'Article'" subtitle="Pages · blog post detail">
        <x-slot:actions>
            <x-ui.button variant="outline" icon="arrow-left" class="[&>svg]:rtl-flip" :href="route('page', ['path' => 'blog'])" wire:navigate>Back to blog</x-ui.button>
        </x-slot:actions>
    </x-page-header>

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-[1fr_300px]">
        {{-- Article --}}
        <article>
            <x-ui.card :padded="false" class="overflow-hidden">
                <div class="relative h-72 overflow-hidden bg-muted">
                    <img src="https://picsum.photos/seed/featured-post/1200/600" alt="" class="size-full object-cover" />
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    <div class="absolute inset-x-0 bottom-0 p-6">
                        <x-ui.badge variant="info">Engineering</x-ui.badge>
                        <h1 class="mt-2 text-2xl font-bold text-white sm:text-3xl">Building a design system that scales with your team</h1>
                    </div>
                </div>
                <div class="p-6">
                    {{-- Meta --}}
                    <div class="flex flex-wrap items-center justify-between gap-4 border-b border-border pb-5">
                        <div class="flex items-center gap-3">
                            <x-ui.avatar name="Aisha Rahman" size="md" />
                            <div><p class="text-sm font-semibold">Aisha Rahman</p><p class="text-xs text-muted-foreground">Jul 18, 2026 · 6 min read</p></div>
                        </div>
                        <div class="flex items-center gap-1">
                            @foreach ([['bookmark',null],['twitter',null],['linkedin',null],['link','Copy link']] as [$ic,$label])
                                <button class="rounded-lg p-2 text-muted-foreground hover:bg-accent hover:text-foreground" @if($label) x-on:click="window.toast('{{ $label }}')" @endif><i data-lucide="{{ $ic }}" class="size-4"></i></button>
                            @endforeach
                        </div>
                    </div>

                    {{-- Body --}}
                    <div class="mt-6 space-y-5 text-[0.95rem] leading-relaxed text-muted-foreground">
                        <p class="text-lg font-medium text-foreground">A design system is more than a component library — it’s a shared language that keeps a growing team moving fast without sacrificing consistency.</p>
                        <p>When we started, every team shipped its own buttons, spacing and colors. The result was a patchwork of subtly different UIs that confused users and slowed everyone down. Here’s how we turned that around.</p>

                        <h2 class="pt-2 text-xl font-bold text-foreground">Start with tokens, not components</h2>
                        <p>Design tokens are the atoms of your system — colors, spacing, radius, typography. By defining them once as CSS variables, every component inherits a single source of truth, and theming (light, dark, RTL) becomes trivial.</p>

                        <blockquote class="border-s-4 border-primary bg-primary/5 px-5 py-3 text-foreground">
                            “Consistency isn’t about making everything the same — it’s about making the right thing the easy thing.”
                        </blockquote>

                        <div class="overflow-hidden rounded-xl border border-border"><img src="https://picsum.photos/seed/system-diagram/1000/500" alt="" class="w-full object-cover" /></div>

                        <h2 class="pt-2 text-xl font-bold text-foreground">Make reuse the default</h2>
                        <p>We measured a <span class="font-semibold text-foreground">80% drop in UI inconsistencies</span> after moving to shared components. The keys were:</p>
                        <ul class="space-y-2 ps-1">
                            @foreach (['A single package every app imports from','Strict lint rules against one-off styles','A weekly office-hours session for the design system team','Clear documentation with copy-paste examples'] as $point)
                                <li class="flex items-start gap-2.5"><i data-lucide="check" class="mt-0.5 size-4 shrink-0 text-success"></i><span>{{ $point }}</span></li>
                            @endforeach
                        </ul>
                        <p>Six months in, new features ship faster, designers and engineers speak the same language, and our users get a product that feels cohesive end to end.</p>
                    </div>

                    {{-- Tags --}}
                    <div class="mt-6 flex flex-wrap gap-2 border-t border-border pt-5">
                        @foreach (['Design Systems','Frontend','Tailwind','Culture'] as $tag)
                            <span class="rounded-full bg-muted px-3 py-1 text-xs font-medium text-muted-foreground">#{{ $tag }}</span>
                        @endforeach
                    </div>
                </div>
            </x-ui.card>

            {{-- Comments --}}
            <x-ui.card class="mt-6" title="Comments (3)">
                <div class="space-y-5">
                    @foreach ([['David Chen','2 hours ago','This resonates so much. The tokens-first approach saved us months.',8],['Sofia Martinez','5 hours ago','Great write-up! How do you handle versioning when tokens change?',3],['Omar Haddad','1 day ago','Bookmarking this for our next design review. 🙌',12]] as [$name,$when,$text,$likes])
                        <div class="flex gap-3">
                            <x-ui.avatar :name="$name" size="sm" />
                            <div class="min-w-0 flex-1">
                                <div class="flex items-center gap-2"><span class="text-sm font-semibold">{{ $name }}</span><span class="text-xs text-muted-foreground">{{ $when }}</span></div>
                                <p class="mt-1 text-sm text-muted-foreground">{{ $text }}</p>
                                <div class="mt-1.5 flex items-center gap-4 text-xs text-muted-foreground">
                                    <button class="flex items-center gap-1 hover:text-primary"><i data-lucide="heart" class="size-3.5"></i>{{ $likes }}</button>
                                    <button class="hover:text-foreground">Reply</button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-5 flex gap-3 border-t border-border pt-5">
                    <x-ui.avatar name="Yrizzz" size="sm" />
                    <div class="flex-1">
                        <textarea rows="2" placeholder="Add a comment…" class="w-full rounded-lg border border-input bg-background px-3 py-2 text-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring"></textarea>
                        <div class="mt-2 flex justify-end"><x-ui.button size="sm" icon="send" class="[&>svg]:rtl-flip" x-on:click="window.toast('Comment posted', { variant: 'success' })">Post</x-ui.button></div>
                    </div>
                </div>
            </x-ui.card>
        </article>

        {{-- Sidebar --}}
        <aside class="space-y-4">
            <x-ui.card>
                <div class="flex flex-col items-center text-center">
                    <x-ui.avatar name="Aisha Rahman" size="xl" />
                    <p class="mt-3 font-semibold">Aisha Rahman</p>
                    <p class="text-sm text-muted-foreground">Product Designer</p>
                    <p class="mt-2 text-sm text-muted-foreground">Writing about design systems, UX and building products people love.</p>
                    <x-ui.button size="sm" class="mt-4 w-full" icon="user-plus">Follow</x-ui.button>
                </div>
            </x-ui.card>

            <x-ui.card :padded="false">
                <x-slot:header><h3 class="font-semibold">Related posts</h3></x-slot:header>
                <div class="divide-y divide-border">
                    @foreach ([['Dark mode done right','6 min','dark-mode'],['Taming N+1 queries','8 min','n-plus-one'],['Micro-interactions that delight','5 min','micro']] as [$title,$read,$seed])
                        <a href="{{ route('page', ['path' => 'blog-detail']) }}" wire:navigate class="flex items-center gap-3 p-3 hover:bg-accent/40">
                            <img src="https://picsum.photos/seed/{{ $seed }}/120/120" alt="" class="size-14 shrink-0 rounded-lg object-cover" />
                            <div class="min-w-0"><p class="line-clamp-2 text-sm font-medium">{{ $title }}</p><p class="mt-0.5 text-xs text-muted-foreground">{{ $read }} read</p></div>
                        </a>
                    @endforeach
                </div>
            </x-ui.card>
        </aside>
    </div>
</div>
