<div>
    <x-page-header :title="$pageTitle" subtitle="Pages · activity, mentions & system alerts">
        <x-slot:actions>
            <x-ui.button variant="outline" icon="arrow-left" class="[&>svg]:rtl-flip" :href="route('dashboard')">Dashboard</x-ui.button>
            <x-ui.button variant="soft" icon="check-check" x-on:click="window.toast('All marked as read')">Mark all read</x-ui.button>
        </x-slot:actions>
    </x-page-header>

    <div x-data="{ tab: 'all' }" class="mx-auto max-w-2xl">
        {{-- Tabs --}}
        <div class="mb-4 flex gap-1 rounded-xl border border-border bg-card p-1">
            @foreach (['all' => 'All','mention' => 'Mentions','system' => 'System','order' => 'Orders'] as $key => $label)
                <button @click="tab = '{{ $key }}'" class="flex-1 rounded-lg px-3 py-2 text-sm font-medium transition-colors" :class="tab === '{{ $key }}' ? 'bg-primary text-primary-foreground shadow-sm' : 'text-muted-foreground hover:bg-accent'">{{ $label }}</button>
            @endforeach
        </div>

        @php
            $groups = [
                'New' => [
                    ['mention',null,'',['Sofia Martinez'],'mentioned you in “Q3 report”','“@you can you review the charts?”','2m',true],
                    ['order','shopping-cart','text-success bg-success/10',null,'New order #5821','Payment confirmed · $249.00','18m',true],
                    ['system','shield-check','text-info bg-info/10',null,'New login detected','Chrome on macOS · Jakarta','1h',true],
                ],
                'Earlier' => [
                    ['mention',null,'',['David Chen'],'commented on your pull request','“LGTM, nice work! 🚀”','3h',false],
                    ['system','triangle-alert','text-[hsl(var(--warning))] bg-warning/10',null,'Storage almost full','92% of your quota is used','5h',false],
                    ['order','package','text-primary bg-primary/10',null,'Order #5806 shipped','Tracking number added','Yesterday',false],
                ],
            ];
        @endphp

        @foreach ($groups as $label => $items)
            <p class="mb-2 mt-4 text-xs font-semibold uppercase tracking-wide text-muted-foreground first:mt-0">{{ $label }}</p>
            <x-ui.card :padded="false">
                <div class="divide-y divide-border">
                    @foreach ($items as [$type,$ico,$tone,$who,$title,$desc,$time,$unread])
                        <div x-show="tab === 'all' || tab === '{{ $type }}'" x-transition.opacity class="flex items-start gap-3 p-4 {{ $unread ? 'bg-primary/[0.03]' : '' }}">
                            @if ($who)
                                <x-ui.avatar :name="$who[0]" size="md" />
                            @else
                                <span class="grid size-10 shrink-0 place-items-center rounded-full {{ $tone }}"><i data-lucide="{{ $ico }}" class="size-5"></i></span>
                            @endif
                            <div class="min-w-0 flex-1">
                                <p class="text-sm">@if ($who)<span class="font-semibold">{{ $who[0] }}</span> @endif{{ $title }}</p>
                                <p class="mt-0.5 truncate text-sm text-muted-foreground">{{ $desc }}</p>
                            </div>
                            <div class="flex shrink-0 flex-col items-end gap-1.5">
                                <span class="text-xs text-muted-foreground">{{ $time }}</span>
                                @if ($unread)<span class="size-2 rounded-full bg-primary"></span>@endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </x-ui.card>
        @endforeach
    </div>
</div>
