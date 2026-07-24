<div>
    <x-page-header :title="$pageTitle" subtitle="Ui Elements · stacked, structured lists">
        <x-slot:actions><x-ui.button variant="outline" icon="arrow-left" class="[&>svg]:rtl-flip" :href="route('ui.elements')">All elements</x-ui.button></x-slot:actions>
    </x-page-header>

    <x-demo-section title="Basic & actionable" desc="Plain items and clickable rows." />
    <div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
        <x-ui.card title="Basic" :padded="false">
            <ul class="divide-y divide-border">
                @foreach (['First item','Second item','Third item','Fourth item'] as $l)
                    <li class="px-4 py-3 text-sm">{{ $l }}</li>
                @endforeach
            </ul>
        </x-ui.card>

        <x-ui.card title="Actionable" :padded="false">
            <ul class="divide-y divide-border">
                @foreach ([['Dashboard',true],['Reports',false],['Team',false],['Settings',false]] as [$l,$active])
                    <li><a href="#" class="flex items-center justify-between px-4 py-3 text-sm transition-colors {{ $active ? 'bg-primary/10 font-medium text-primary' : 'hover:bg-accent' }}">{{ $l }}<i data-lucide="chevron-right" class="rtl-flip size-4 opacity-50"></i></a></li>
                @endforeach
            </ul>
        </x-ui.card>
    </div>

    <x-demo-section title="With icons & badges" desc="Leading icons and trailing counts." />
    <div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
        <x-ui.card title="Icons + badges" :padded="false">
            <ul class="divide-y divide-border">
                @foreach ([['inbox','Inbox','12','default'],['send','Sent',null,null],['file','Drafts','3','muted'],['triangle-alert','Spam','8','destructive']] as [$ic,$l,$n,$tone])
                    <li class="flex items-center gap-3 px-4 py-3 text-sm hover:bg-accent/40">
                        <i data-lucide="{{ $ic }}" class="size-4 text-muted-foreground"></i>
                        <span class="flex-1">{{ $l }}</span>
                        @if ($n)<x-ui.badge :variant="$tone">{{ $n }}</x-ui.badge>@endif
                    </li>
                @endforeach
            </ul>
        </x-ui.card>

        <x-ui.card title="With avatars" :padded="false">
            <ul class="divide-y divide-border">
                @foreach ([['Aisha Rahman','Admin','online'],['David Chen','Editor','busy'],['Sofia Martinez','Viewer','away']] as [$n,$r,$s])
                    <li class="flex items-center gap-3 px-4 py-3">
                        <x-ui.avatar :name="$n" size="sm" :status="$s" />
                        <div class="min-w-0 flex-1"><p class="truncate text-sm font-medium">{{ $n }}</p><p class="text-xs text-muted-foreground">{{ $r }}</p></div>
                        <x-ui.button size="sm" variant="ghost">View</x-ui.button>
                    </li>
                @endforeach
            </ul>
        </x-ui.card>
    </div>

    <x-demo-section title="Checkable & numbered" desc="Selection lists and ordered steps." />
    <div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
        <x-ui.card title="Checkable" :padded="false">
            <ul x-data="{ picked: ['Email'] }" class="divide-y divide-border">
                @foreach (['Email','SMS','Push','Slack'] as $opt)
                    <li>
                        <label class="flex cursor-pointer items-center gap-3 px-4 py-3 text-sm hover:bg-accent/40">
                            <input type="checkbox" value="{{ $opt }}" x-model="picked" class="size-4 rounded border-input text-primary focus:ring-primary">
                            <span class="flex-1">{{ $opt }}</span>
                        </label>
                    </li>
                @endforeach
                <li class="px-4 py-2 text-xs text-muted-foreground"><span x-text="picked.length"></span> selected</li>
            </ul>
        </x-ui.card>

        <x-ui.card title="Numbered" :padded="false">
            <ol class="divide-y divide-border">
                @foreach (['Create your account','Verify your email','Invite your team','Publish a dashboard'] as $i => $l)
                    <li class="flex items-center gap-3 px-4 py-3 text-sm">
                        <span class="grid size-6 shrink-0 place-items-center rounded-full bg-primary/10 text-xs font-bold text-primary">{{ $i + 1 }}</span>{{ $l }}
                    </li>
                @endforeach
            </ol>
        </x-ui.card>
    </div>
</div>
