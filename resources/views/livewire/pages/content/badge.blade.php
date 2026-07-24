<div>
    <x-page-header :title="$pageTitle" subtitle="Ui Elements · labels, counters & status pills">
        <x-slot:actions><x-ui.button variant="outline" icon="arrow-left" class="[&>svg]:rtl-flip" :href="route('ui.elements')">All elements</x-ui.button></x-slot:actions>
    </x-page-header>

    <x-demo-section title="Variants" desc="Every built-in tone." />
    <x-ui.card>
        <div class="flex flex-wrap gap-2">
            @foreach (['default'=>'Default','solid'=>'Solid','secondary'=>'Secondary','success'=>'Success','warning'=>'Warning','destructive'=>'Destructive','info'=>'Info','outline'=>'Outline','muted'=>'Muted'] as $v => $l)
                <x-ui.badge :variant="$v">{{ $l }}</x-ui.badge>
            @endforeach
        </div>
    </x-ui.card>

    <x-demo-section title="With dot & icon" desc="Status indicators." />
    <x-ui.card>
        <div class="flex flex-wrap items-center gap-2">
            <x-ui.badge variant="success" dot>Online</x-ui.badge>
            <x-ui.badge variant="warning" dot>Pending</x-ui.badge>
            <x-ui.badge variant="destructive" dot>Offline</x-ui.badge>
            <span class="inline-flex items-center gap-1.5 rounded-full bg-success/12 px-2.5 py-0.5 text-xs font-semibold text-success"><i data-lucide="circle-check-big" class="size-3.5"></i>Verified</span>
            <span class="inline-flex items-center gap-1.5 rounded-full bg-info/12 px-2.5 py-0.5 text-xs font-semibold text-info"><i data-lucide="shield" class="size-3.5"></i>Secured</span>
            <span class="inline-flex items-center gap-1.5 rounded-full bg-muted px-2.5 py-0.5 text-xs font-semibold text-muted-foreground"><span class="size-1.5 animate-pulse rounded-full bg-current"></span>Syncing</span>
        </div>
    </x-ui.card>

    <x-demo-section title="Counters & positioning" desc="Notification bubbles on other elements." />
    <x-ui.card>
        <div class="flex flex-wrap items-center gap-6">
            <span class="relative inline-flex"><x-ui.button variant="outline" size="icon" icon="bell" /><span class="absolute -end-1 -top-1 grid size-5 place-items-center rounded-full bg-destructive text-[0.6rem] font-bold text-white">9</span></span>
            <span class="relative inline-flex"><x-ui.button variant="outline" size="icon" icon="mail" /><span class="absolute -end-1 -top-1 grid min-w-5 place-items-center rounded-full bg-primary px-1 text-[0.6rem] font-bold text-primary-foreground">99+</span></span>
            <span class="relative inline-flex"><x-ui.avatar name="Yrizzz Admin" size="lg" /><span class="absolute -end-0.5 -bottom-0.5 size-3.5 rounded-full border-2 border-card bg-success"></span></span>
            <span class="inline-flex items-center gap-2 text-sm">Inbox <x-ui.badge variant="solid">12</x-ui.badge></span>
        </div>
    </x-ui.card>

    <x-demo-section title="In context" desc="Badges inside lists and tables." />
    <x-ui.card :padded="false">
        <div class="divide-y divide-border">
            @foreach ([['Order #5821','Delivered','success'],['Order #5820','Shipped','info'],['Order #5819','Pending','warning'],['Order #5818','Cancelled','destructive']] as [$t,$s,$tone])
                <div class="flex items-center gap-3 p-4"><span class="flex-1 text-sm font-medium">{{ $t }}</span><x-ui.badge :variant="$tone">{{ $s }}</x-ui.badge></div>
            @endforeach
        </div>
    </x-ui.card>
</div>
