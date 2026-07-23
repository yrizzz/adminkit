<div>
    <x-page-header :title="'Avatars'" subtitle="Utilities · sizes, statuses, groups & shapes">
        <x-slot:actions>
            <x-ui.button variant="outline" icon="arrow-left" class="[&>svg]:rtl-flip" :href="route('dashboard')">Dashboard</x-ui.button>
        </x-slot:actions>
    </x-page-header>

    <x-demo-section title="Sizes" desc="From xs to xl, initials generated from the name." />
    <x-ui.card>
        <div class="flex flex-wrap items-end gap-6">
            @foreach (['xs','sm','md','lg','xl'] as $size)
                <div class="flex flex-col items-center gap-2"><x-ui.avatar name="Aisha Rahman" :size="$size" /><span class="text-xs text-muted-foreground">{{ $size }}</span></div>
            @endforeach
        </div>
    </x-ui.card>

    <x-demo-section title="With status" desc="Presence indicator in the corner." />
    <x-ui.card>
        <div class="flex flex-wrap items-center gap-6">
            @foreach (['online' => 'Online','away' => 'Away','busy' => 'Busy','offline' => 'Offline'] as $status => $label)
                <div class="flex flex-col items-center gap-2"><x-ui.avatar name="David Chen" size="lg" :status="$status" /><span class="text-xs text-muted-foreground">{{ $label }}</span></div>
            @endforeach
        </div>
    </x-ui.card>

    <x-demo-section title="Image & shapes" desc="Photo avatars, rounded and squared." />
    <x-ui.card>
        <div class="flex flex-wrap items-center gap-6">
            <div class="flex flex-col items-center gap-2"><img src="https://api.dicebear.com/9.x/avataaars/svg?seed=Sofia" class="size-12 rounded-full bg-muted" alt=""><span class="text-xs text-muted-foreground">Circle</span></div>
            <div class="flex flex-col items-center gap-2"><img src="https://api.dicebear.com/9.x/avataaars/svg?seed=Omar" class="size-12 rounded-xl bg-muted" alt=""><span class="text-xs text-muted-foreground">Rounded</span></div>
            <div class="flex flex-col items-center gap-2"><img src="https://api.dicebear.com/9.x/initials/svg?seed=Priya Sharma&backgroundType=gradientLinear" class="size-12 rounded-full" alt=""><span class="text-xs text-muted-foreground">Initials</span></div>
            <div class="flex flex-col items-center gap-2"><span class="grid size-12 place-items-center rounded-full bg-gradient-to-br from-primary to-sidebar-primary text-white"><i data-lucide="user" class="size-6"></i></span><span class="text-xs text-muted-foreground">Icon</span></div>
        </div>
    </x-ui.card>

    <x-demo-section title="Groups" desc="Stacked avatar groups with an overflow count." />
    <x-ui.card>
        <div class="flex flex-wrap items-center gap-8">
            <div class="flex -space-x-3">
                @foreach (['Aisha Rahman','David Chen','Sofia Martinez'] as $n)<x-ui.avatar :name="$n" size="md" class="ring-2 ring-card" />@endforeach
            </div>
            <div class="flex -space-x-3">
                @foreach (['Aisha Rahman','David Chen','Sofia Martinez','Omar Haddad'] as $n)<x-ui.avatar :name="$n" size="md" class="ring-2 ring-card" />@endforeach
                <span class="grid size-10 place-items-center rounded-full bg-muted text-xs font-bold text-muted-foreground ring-2 ring-card">+8</span>
            </div>
            <div class="flex -space-x-2">
                @foreach (['Priya Sharma','Kenji Tanaka','Layla Farouk','Marcus Johnson','Emily Watson'] as $n)<x-ui.avatar :name="$n" size="sm" class="ring-2 ring-card" />@endforeach
            </div>
        </div>
    </x-ui.card>
</div>
