<div>
    <x-page-header :title="$pageTitle" subtitle="Forms · vertical, horizontal, inline & grid arrangements">
        <x-slot:actions><x-ui.button variant="outline" icon="arrow-left" class="[&>svg]:rtl-flip" :href="route('forms')">All forms</x-ui.button></x-slot:actions>
    </x-page-header>

    <x-demo-section title="Vertical & horizontal" desc="Labels above vs beside the field." />
    <div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
        <x-ui.card title="Vertical">
            <form class="space-y-4">
                <x-ui.input label="Full name" placeholder="Yrizzz" />
                <x-ui.input label="Email" type="email" placeholder="you@company.com" />
                <div><label class="mb-1.5 block text-sm font-medium">Bio</label><textarea rows="2" class="w-full rounded-lg border border-input bg-background px-3 py-2 text-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring"></textarea></div>
                <x-ui.button>Save</x-ui.button>
            </form>
        </x-ui.card>
        <x-ui.card title="Horizontal">
            <form class="space-y-4">
                @foreach (['Full name'=>'Yrizzz','Email'=>'you@company.com','Company'=>'AdminKit Inc.'] as $l => $v)
                    <div class="grid grid-cols-3 items-center gap-3"><label class="text-sm font-medium">{{ $l }}</label><input value="{{ $v }}" class="col-span-2 h-10 rounded-lg border border-input bg-background px-3 text-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring"></div>
                @endforeach
                <div class="grid grid-cols-3 gap-3"><div></div><div class="col-span-2"><x-ui.button>Save</x-ui.button></div></div>
            </form>
        </x-ui.card>
    </div>

    <x-demo-section title="Inline & grid" desc="Compact rows and multi-column forms." />
    <x-ui.card title="Inline filter">
        <form class="flex flex-wrap items-end gap-3">
            <div class="flex-1 min-w-40"><label class="mb-1.5 block text-sm font-medium">Search</label><x-ui.input icon="search" placeholder="Keyword…" /></div>
            <div><label class="mb-1.5 block text-sm font-medium">Status</label><select class="h-10 rounded-lg border border-input bg-background px-3 text-sm"><option>All</option><option>Active</option><option>Archived</option></select></div>
            <div><label class="mb-1.5 block text-sm font-medium">Sort</label><select class="h-10 rounded-lg border border-input bg-background px-3 text-sm"><option>Newest</option><option>Oldest</option></select></div>
            <x-ui.button icon="filter">Apply</x-ui.button>
        </form>
    </x-ui.card>

    <x-ui.card title="Grid form" class="mt-4">
        <form class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <x-ui.input label="First name" placeholder="Yrizzz" />
            <x-ui.input label="Last name" placeholder="Admin" />
            <div class="sm:col-span-2"><x-ui.input label="Street address" icon="map-pin" placeholder="Jl. Sudirman No. 45" /></div>
            <x-ui.input label="City" placeholder="Jakarta" />
            <x-ui.input label="Postal code" placeholder="10220" />
            <div><label class="mb-1.5 block text-sm font-medium">Country</label><select class="h-10 w-full rounded-lg border border-input bg-background px-3 text-sm"><option>Indonesia</option><option>Singapore</option></select></div>
            <div><label class="mb-1.5 block text-sm font-medium">Phone</label><input class="h-10 w-full rounded-lg border border-input bg-background px-3 text-sm" value="+62 812 3456 7890"></div>
            <div class="flex gap-2 sm:col-span-2"><x-ui.button>Save address</x-ui.button><x-ui.button variant="outline">Cancel</x-ui.button></div>
        </form>
    </x-ui.card>

    <x-demo-section title="Sectioned & floating labels" desc="Grouped settings and modern floating labels." />
    <div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
        <x-ui.card title="Sectioned">
            <div class="space-y-6">
                <div><p class="mb-3 flex items-center gap-2 text-sm font-semibold"><i data-lucide="user" class="size-4 text-primary"></i>Personal</p><div class="grid grid-cols-2 gap-3"><x-ui.input label="Name" placeholder="Yrizzz" /><x-ui.input label="Email" placeholder="you@" /></div></div>
                <div class="border-t border-border pt-5"><p class="mb-3 flex items-center gap-2 text-sm font-semibold"><i data-lucide="bell" class="size-4 text-primary"></i>Notifications</p><div class="space-y-2">@foreach (['Product updates','Weekly digest'] as $l)<label class="flex items-center gap-2.5 text-sm"><input type="checkbox" checked class="size-4 rounded border-input text-primary focus:ring-primary">{{ $l }}</label>@endforeach</div></div>
            </div>
        </x-ui.card>
        <x-ui.card title="Floating labels">
            <div class="space-y-5">
                @foreach (['Email address'=>'email','Full name'=>'text'] as $label => $type)
                    <div class="relative">
                        <input type="{{ $type }}" id="fl-{{ $loop->index }}" placeholder=" " class="peer h-12 w-full rounded-lg border border-input bg-background px-3 pt-4 text-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring">
                        <label for="fl-{{ $loop->index }}" class="pointer-events-none absolute start-3 top-3.5 text-sm text-muted-foreground transition-all peer-focus:top-1.5 peer-focus:text-xs peer-focus:text-primary peer-[:not(:placeholder-shown)]:top-1.5 peer-[:not(:placeholder-shown)]:text-xs">{{ $label }}</label>
                    </div>
                @endforeach
            </div>
        </x-ui.card>
    </div>
</div>
