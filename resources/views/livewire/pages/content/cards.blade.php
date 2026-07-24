<div>
    <x-page-header :title="$pageTitle" subtitle="Ui Elements · containers for grouped content">
        <x-slot:actions><x-ui.button variant="outline" icon="arrow-left" class="[&>svg]:rtl-flip" :href="route('ui.elements')">All elements</x-ui.button></x-slot:actions>
    </x-page-header>

    <x-demo-section title="Basics" desc="Title, subtitle, actions and footer slots." />
    <div class="grid grid-cols-1 gap-4 lg:grid-cols-3">
        <x-ui.card title="Simple card"><p class="text-sm text-muted-foreground">Just a title and some body content.</p></x-ui.card>

        <x-ui.card title="With actions" subtitle="Header buttons on the right">
            <x-slot:actions><x-ui.button size="sm" variant="outline" icon="pencil">Edit</x-ui.button></x-slot:actions>
            <p class="text-sm text-muted-foreground">Actions live in the card header.</p>
        </x-ui.card>

        <x-ui.card title="With footer">
            <p class="text-sm text-muted-foreground">Footers are great for confirmation actions.</p>
            <x-slot:footer><x-ui.button size="sm" variant="ghost">Cancel</x-ui.button><x-ui.button size="sm">Save</x-ui.button></x-slot:footer>
        </x-ui.card>
    </div>

    <x-demo-section title="Media cards" desc="Cards with imagery." />
    <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
        <x-ui.card :padded="false" hover class="group overflow-hidden">
            <div class="h-40 overflow-hidden bg-muted"><img src="https://picsum.photos/seed/card-top/600/400" alt="" class="size-full object-cover transition-transform duration-300 group-hover:scale-105" /></div>
            <div class="p-4"><p class="font-semibold">Image on top</p><p class="mt-1 text-sm text-muted-foreground">A cover image above the content.</p></div>
        </x-ui.card>

        <x-ui.card :padded="false" class="overflow-hidden">
            <div class="flex">
                <img src="https://picsum.photos/seed/card-side/300/300" alt="" class="w-28 shrink-0 object-cover" />
                <div class="p-4"><p class="font-semibold">Horizontal</p><p class="mt-1 text-sm text-muted-foreground">Image beside the content.</p></div>
            </div>
        </x-ui.card>

        <div class="relative overflow-hidden rounded-xl">
            <img src="https://picsum.photos/seed/card-overlay/600/400" alt="" class="h-full min-h-44 w-full object-cover" />
            <div class="absolute inset-0 bg-gradient-to-t from-black/75 to-transparent"></div>
            <div class="absolute inset-x-0 bottom-0 p-4 text-white"><p class="font-semibold">Overlay card</p><p class="text-sm text-white/80">Text over the image.</p></div>
        </div>
    </div>

    <x-demo-section title="Specialised" desc="Stat, profile and pricing layouts." />
    <div class="grid grid-cols-1 gap-4 lg:grid-cols-3">
        <x-ui.stat label="Revenue" value="$48,290" icon="dollar-sign" tone="success" trend="+12.5%" />

        <x-ui.card :padded="false" class="overflow-hidden">
            <div class="h-16 bg-gradient-to-r from-primary to-sidebar-primary"></div>
            <div class="-mt-8 px-5 pb-5 text-center">
                <x-ui.avatar name="Yrizzz Admin" size="xl" class="mx-auto ring-4 ring-card" />
                <p class="mt-2 font-bold">Yrizzz</p><p class="text-sm text-muted-foreground">Product Designer</p>
                <x-ui.button size="sm" class="mt-3 w-full" icon="user-plus">Follow</x-ui.button>
            </div>
        </x-ui.card>

        <x-ui.card class="ring-1 ring-primary">
            <x-ui.badge variant="solid">Most popular</x-ui.badge>
            <div class="mt-3 flex items-end gap-1"><span class="text-3xl font-bold">$29</span><span class="mb-1 text-sm text-muted-foreground">/mo</span></div>
            <ul class="mt-4 space-y-2 text-sm">
                @foreach (['Unlimited projects','Priority support','Advanced analytics'] as $f)
                    <li class="flex items-center gap-2"><i data-lucide="check" class="size-4 text-success"></i>{{ $f }}</li>
                @endforeach
            </ul>
            <x-ui.button class="mt-4 w-full">Choose Pro</x-ui.button>
        </x-ui.card>
    </div>

    <x-demo-section title="States" desc="Hover lift, bordered accent and muted." />
    <div class="grid grid-cols-1 gap-4 lg:grid-cols-3">
        <x-ui.card hover title="Hover me"><p class="text-sm text-muted-foreground">Lifts on hover with a soft shadow.</p></x-ui.card>
        <x-ui.card title="Accent border" class="border-s-4 border-s-primary"><p class="text-sm text-muted-foreground">A coloured edge for emphasis.</p></x-ui.card>
        <x-ui.card title="Muted" class="bg-muted/40"><p class="text-sm text-muted-foreground">A subdued background variant.</p></x-ui.card>
    </div>
</div>
