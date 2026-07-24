<div>
    <x-page-header :title="$pageTitle" subtitle="Ui Elements · tabs, pills & vertical navs">
        <x-slot:actions><x-ui.button variant="outline" icon="arrow-left" class="[&>svg]:rtl-flip" :href="route('ui.elements')">All elements</x-ui.button></x-slot:actions>
    </x-page-header>

    <x-demo-section title="Underline tabs" desc="The classic bottom-border tab." />
    <x-ui.card>
        <div x-data="{ t: 'overview' }">
            <div class="flex gap-1 border-b border-border">
                @foreach (['overview'=>'Overview','analytics'=>'Analytics','reports'=>'Reports','settings'=>'Settings'] as $k => $l)
                    <button @click="t = '{{ $k }}'" class="relative px-4 py-2.5 text-sm font-medium transition-colors" :class="t === '{{ $k }}' ? 'text-primary' : 'text-muted-foreground hover:text-foreground'">
                        {{ $l }}<span x-show="t === '{{ $k }}'" class="absolute inset-x-2 -bottom-px h-0.5 rounded-full bg-primary"></span>
                    </button>
                @endforeach
            </div>
            <div class="pt-4 text-sm text-muted-foreground">
                @foreach (['overview'=>'A high-level summary of your workspace.','analytics'=>'Traffic, engagement and conversion metrics.','reports'=>'Generate and export scheduled reports.','settings'=>'Manage preferences and integrations.'] as $k => $copy)
                    <p x-show="t === '{{ $k }}'" @if(! $loop->first) x-cloak @endif>{{ $copy }}</p>
                @endforeach
            </div>
        </div>
    </x-ui.card>

    <x-demo-section title="Pills & segmented" desc="Soft, contained tab styles." />
    <div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
        <x-ui.card title="Pill tabs">
            <div x-data="{ t: 'all' }" class="flex flex-wrap gap-2">
                @foreach (['all'=>'All','active'=>'Active','draft'=>'Draft','archived'=>'Archived'] as $k => $l)
                    <button @click="t = '{{ $k }}'" class="rounded-full px-4 py-1.5 text-sm font-medium transition-colors" :class="t === '{{ $k }}' ? 'bg-primary text-primary-foreground' : 'bg-muted/60 text-muted-foreground hover:text-foreground'">{{ $l }}</button>
                @endforeach
            </div>
        </x-ui.card>

        <x-ui.card title="Segmented">
            <div x-data="{ t: 'week' }" class="inline-flex gap-1 rounded-lg bg-muted/60 p-1">
                @foreach (['day'=>'Day','week'=>'Week','month'=>'Month'] as $k => $l)
                    <button @click="t = '{{ $k }}'" class="rounded-md px-4 py-1.5 text-sm font-medium transition-colors" :class="t === '{{ $k }}' ? 'bg-card text-foreground shadow-sm' : 'text-muted-foreground'">{{ $l }}</button>
                @endforeach
            </div>
        </x-ui.card>
    </div>

    <x-demo-section title="With icons & badges" desc="Richer tab labels." />
    <x-ui.card>
        <div x-data="{ t: 'inbox' }">
            <div class="flex flex-wrap gap-1 border-b border-border">
                @foreach (['inbox'=>['Inbox','inbox','12'],'starred'=>['Starred','star',null],'sent'=>['Sent','send',null],'spam'=>['Spam','triangle-alert','3']] as $k => [$l,$ic,$n])
                    <button @click="t = '{{ $k }}'" class="relative flex items-center gap-2 px-4 py-2.5 text-sm font-medium transition-colors" :class="t === '{{ $k }}' ? 'text-primary' : 'text-muted-foreground hover:text-foreground'">
                        <i data-lucide="{{ $ic }}" class="size-4"></i>{{ $l }}
                        @if ($n)<x-ui.badge variant="muted">{{ $n }}</x-ui.badge>@endif
                        <span x-show="t === '{{ $k }}'" class="absolute inset-x-2 -bottom-px h-0.5 rounded-full bg-primary"></span>
                    </button>
                @endforeach
            </div>
        </div>
    </x-ui.card>

    <x-demo-section title="Vertical nav" desc="Side navigation with a content pane." />
    <x-ui.card :padded="false">
        <div x-data="{ t: 'profile' }" class="grid grid-cols-1 sm:grid-cols-[200px_1fr]">
            <nav class="space-y-1 border-b border-border p-3 sm:border-b-0 sm:border-e">
                @foreach (['profile'=>['Profile','user'],'account'=>['Account','settings'],'security'=>['Security','shield'],'billing'=>['Billing','credit-card']] as $k => [$l,$ic])
                    <button @click="t = '{{ $k }}'" class="flex w-full items-center gap-2.5 rounded-lg px-3 py-2 text-sm font-medium transition-colors" :class="t === '{{ $k }}' ? 'bg-primary/10 text-primary' : 'text-muted-foreground hover:bg-accent'">
                        <i data-lucide="{{ $ic }}" class="size-4"></i>{{ $l }}
                    </button>
                @endforeach
            </nav>
            <div class="p-5 text-sm text-muted-foreground">
                @foreach (['profile'=>'Update your name, photo and public details.','account'=>'Language, timezone and workspace preferences.','security'=>'Password, two-factor authentication and sessions.','billing'=>'Plan, invoices and payment methods.'] as $k => $copy)
                    <p x-show="t === '{{ $k }}'" @if(! $loop->first) x-cloak @endif>{{ $copy }}</p>
                @endforeach
            </div>
        </div>
    </x-ui.card>
</div>
