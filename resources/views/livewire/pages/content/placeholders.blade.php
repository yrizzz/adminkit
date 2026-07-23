<div x-data="{ loading: true }">
    <x-page-header :title="$pageTitle" subtitle="Advanced Ui · skeleton loaders with a real shimmer sweep">
        <x-slot:actions>
            <x-ui.button variant="soft" size="sm" icon="rotate-cw" @click="loading = true; setTimeout(() => loading = false, 2000)">Simulate load</x-ui.button>
            <x-ui.button variant="outline" size="sm" @click="loading = ! loading" x-text="loading ? 'Show content' : 'Show skeleton'">Toggle</x-ui.button>
        </x-slot:actions>
    </x-page-header>

    {{-- Stat row --}}
    <div class="grid grid-cols-2 gap-4 lg:grid-cols-4">
        @foreach ([['dollar-sign','Revenue','$48,290','text-primary bg-primary/10'],['users','Users','8,942','text-info bg-info/10'],['shopping-cart','Orders','1,304','text-success bg-success/10'],['trending-down','Bounce','24.8%','text-destructive bg-destructive/10']] as [$ic,$label,$val,$tone])
            <x-ui.card>
                <div x-show="loading" class="space-y-3">
                    <div class="flex items-center justify-between"><div class="skeleton h-3 w-16"></div><div class="skeleton size-9 rounded-xl"></div></div>
                    <div class="skeleton h-6 w-24"></div>
                </div>
                <div x-show="! loading" x-cloak>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-muted-foreground">{{ $label }}</span>
                        <span class="grid size-9 place-items-center rounded-xl {{ $tone }}"><i data-lucide="{{ $ic }}" class="size-4"></i></span>
                    </div>
                    <p class="mt-2 text-2xl font-bold">{{ $val }}</p>
                </div>
            </x-ui.card>
        @endforeach
    </div>

    <x-demo-section title="Content blocks" desc="Profile, media and list skeletons swap to real content." />
    <div class="grid grid-cols-1 gap-4 lg:grid-cols-3">
        {{-- Profile --}}
        <x-ui.card title="Profile">
            <div x-show="loading" class="space-y-4">
                <div class="flex items-center gap-3"><div class="skeleton size-12 rounded-full"></div><div class="flex-1 space-y-2"><div class="skeleton h-3 w-2/3"></div><div class="skeleton h-3 w-1/3"></div></div></div>
                <div class="space-y-2"><div class="skeleton h-3 w-full"></div><div class="skeleton h-3 w-4/5"></div></div>
                <div class="skeleton h-9 w-28 rounded-lg"></div>
            </div>
            <div x-show="! loading" x-cloak class="space-y-4">
                <div class="flex items-center gap-3"><x-ui.avatar name="Aisha Rahman" size="md" status="online" /><div><p class="font-semibold">Aisha Rahman</p><p class="text-sm text-muted-foreground">Product Designer</p></div></div>
                <p class="text-sm text-muted-foreground">Crafting delightful interfaces and design systems for internal tools.</p>
                <x-ui.button size="sm" icon="user-plus">Follow</x-ui.button>
            </div>
        </x-ui.card>

        {{-- Media --}}
        <x-ui.card title="Media">
            <div x-show="loading" class="space-y-3"><div class="skeleton h-28 w-full rounded-xl"></div><div class="skeleton h-3 w-3/4"></div><div class="skeleton h-3 w-1/2"></div></div>
            <div x-show="! loading" x-cloak class="space-y-3">
                <div class="flex h-28 w-full items-center justify-center rounded-xl bg-gradient-to-br from-primary to-sidebar-primary text-white"><i data-lucide="image" class="size-8"></i></div>
                <p class="font-medium">Mountain retreat</p><p class="text-sm text-muted-foreground">Uploaded 2 hours ago · 4.2 MB</p>
            </div>
        </x-ui.card>

        {{-- List --}}
        <x-ui.card title="Activity">
            <div x-show="loading" class="space-y-3">
                @for ($i = 0; $i < 4; $i++)<div class="flex items-center gap-3"><div class="skeleton size-8 rounded-lg"></div><div class="flex-1 space-y-1.5"><div class="skeleton h-3 w-4/5"></div><div class="skeleton h-2.5 w-1/3"></div></div></div>@endfor
            </div>
            <div x-show="! loading" x-cloak class="space-y-3">
                @foreach ([['user-plus','New signup','2m'],['shopping-cart','Order placed','18m'],['star','New review','1h'],['git-merge','PR merged','3h']] as [$ic, $t, $a])
                    <div class="flex items-center gap-3"><span class="grid size-8 place-items-center rounded-lg bg-primary/10 text-primary"><i data-lucide="{{ $ic }}" class="size-4"></i></span><div class="flex-1"><p class="text-sm font-medium">{{ $t }}</p></div><span class="text-xs text-muted-foreground">{{ $a }}</span></div>
                @endforeach
            </div>
        </x-ui.card>
    </div>

    <x-demo-section title="Table & chart" desc="Data-dense skeletons for tables and analytics widgets." />
    <div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
        {{-- Table --}}
        <x-ui.card title="Table" :padded="false">
            <div class="p-5">
                <div x-show="loading" class="space-y-3">
                    @for ($i = 0; $i < 5; $i++)
                        <div class="flex items-center gap-3">
                            <div class="skeleton size-8 rounded-full"></div>
                            <div class="skeleton h-3 flex-1"></div>
                            <div class="skeleton h-3 w-16"></div>
                            <div class="skeleton h-5 w-14 rounded-full"></div>
                        </div>
                    @endfor
                </div>
                <div x-show="! loading" x-cloak class="space-y-1">
                    @foreach ([['Aisha Rahman','Admin','success'],['Budi Santoso','Editor','info'],['Citra Dewi','Viewer','muted'],['Dani Pratama','Editor','info'],['Eka Putri','Admin','success']] as [$name, $role, $v])
                        <div class="flex items-center gap-3 py-1.5">
                            <x-ui.avatar :name="$name" size="sm" />
                            <span class="flex-1 text-sm font-medium">{{ $name }}</span>
                            <span class="text-sm text-muted-foreground">{{ $role }}</span>
                            <x-ui.badge :variant="$v">Active</x-ui.badge>
                        </div>
                    @endforeach
                </div>
            </div>
        </x-ui.card>

        {{-- Chart --}}
        <x-ui.card title="Analytics">
            <div x-show="loading" class="space-y-4">
                <div class="flex items-end gap-2">
                    @foreach (['h-16','h-24','h-12','h-32','h-20','h-28','h-14'] as $h)<div class="skeleton flex-1 {{ $h }} rounded-md"></div>@endforeach
                </div>
                <div class="flex justify-between"><div class="skeleton h-3 w-20"></div><div class="skeleton h-3 w-12"></div></div>
            </div>
            <div x-show="! loading" x-cloak>
                <div class="flex items-end gap-2">
                    @foreach ([['h-16',40],['h-24',60],['h-12',30],['h-32',82],['h-20',52],['h-28',72],['h-14',36]] as [$h, $pct])
                        <div class="flex-1 {{ $h }} rounded-md bg-gradient-to-t from-primary to-sidebar-primary"></div>
                    @endforeach
                </div>
                <div class="mt-3 flex justify-between text-xs text-muted-foreground"><span>Last 7 days</span><span class="font-semibold text-success">+12.5%</span></div>
            </div>
        </x-ui.card>
    </div>
</div>
