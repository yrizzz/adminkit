<div>
    <x-page-header :title="'Timeline'" subtitle="Pages · vertical activity timelines">
        <x-slot:actions>
            <x-ui.badge variant="muted">Default</x-ui.badge>
            <x-ui.button variant="outline" icon="arrow-left" class="[&>svg]:rtl-flip" :href="route('dashboard')">Dashboard</x-ui.button>
        </x-slot:actions>
    </x-page-header>

    <div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
        {{-- Activity timeline --}}
        <x-ui.card title="Activity" subtitle="Recent events">
            <ol>
                @php
                    $events = [
                        ['user-plus','New member joined','Aisha Rahman accepted the invite to the workspace.','2 minutes ago','text-info bg-info/10'],
                        ['git-commit-horizontal','Deployed v1.4.2','Release pushed to production by the CI pipeline.','1 hour ago','text-primary bg-primary/10'],
                        ['check-check','Order completed','Order #4821 was fulfilled and shipped.','3 hours ago','text-success bg-success/10'],
                        ['message-square','New comment','“Great work on the dashboard!” on Q3 report.','5 hours ago','text-[hsl(var(--warning))] bg-warning/10'],
                        ['upload','Assets uploaded','12 new brand assets added to the library.','Yesterday','text-muted-foreground bg-muted'],
                    ];
                @endphp
                @foreach ($events as $i => [$ico,$title,$desc,$time,$tone])
                    <li class="flex gap-4">
                        <div class="flex flex-col items-center">
                            <span class="grid size-9 shrink-0 place-items-center rounded-full {{ $tone }}"><i data-lucide="{{ $ico }}" class="size-4"></i></span>
                            @unless ($loop->last)<span class="w-px flex-1 bg-border"></span>@endunless
                        </div>
                        <div class="flex-1 pb-6">
                            <div class="flex items-center justify-between gap-2">
                                <p class="text-sm font-semibold">{{ $title }}</p>
                                <span class="shrink-0 text-xs text-muted-foreground">{{ $time }}</span>
                            </div>
                            <p class="mt-0.5 text-sm text-muted-foreground">{{ $desc }}</p>
                        </div>
                    </li>
                @endforeach
            </ol>
        </x-ui.card>

        {{-- Order tracking --}}
        <x-ui.card title="Order tracking" subtitle="Shipment #4821">
            <ol>
                @php
                    $steps = [
                        ['package','Order placed','Jul 20, 09:14','done'],
                        ['credit-card','Payment confirmed','Jul 20, 09:15','done'],
                        ['box','Packed & ready','Jul 20, 16:40','done'],
                        ['truck','Out for delivery','Jul 22, 08:00','current'],
                        ['home','Delivered','Estimated Jul 22','pending'],
                    ];
                @endphp
                @foreach ($steps as $i => [$ico,$title,$time,$state])
                    <li class="flex gap-4">
                        <div class="flex flex-col items-center">
                            <span class="grid size-9 shrink-0 place-items-center rounded-full border-2
                                @if ($state === 'done') border-success bg-success text-white
                                @elseif ($state === 'current') border-primary bg-primary/10 text-primary animate-pulse
                                @else border-border bg-muted text-muted-foreground @endif">
                                <i data-lucide="{{ $state === 'done' ? 'check' : $ico }}" class="size-4"></i>
                            </span>
                            @unless ($loop->last)<span class="w-0.5 flex-1 {{ $state === 'done' ? 'bg-success' : 'bg-border' }}"></span>@endunless
                        </div>
                        <div class="flex-1 pb-6">
                            <p class="text-sm font-semibold {{ $state === 'pending' ? 'text-muted-foreground' : '' }}">{{ $title }}</p>
                            <p class="mt-0.5 text-xs text-muted-foreground">{{ $time }}</p>
                        </div>
                    </li>
                @endforeach
            </ol>
        </x-ui.card>
    </div>

    {{-- Grouped by date, with content cards --}}
    <x-demo-section title="With content cards" desc="Grouped by day, each entry carries a rich card." />
    <x-ui.card>
        @php
            $groups = [
                'Today' => [
                    ['rocket','text-primary bg-primary/10','Launched new onboarding','Reduced first-run setup from 12 to 4 steps. Early metrics look great.','10:24'],
                    ['bug','text-destructive bg-destructive/10','Fixed critical bug','Resolved the checkout race condition affecting 0.3% of orders.','08:02'],
                ],
                'Yesterday' => [
                    ['users','text-info bg-info/10','Team standup notes','Aligned on Q3 roadmap priorities and shipped the design tokens.','17:30'],
                    ['file-check','text-success bg-success/10','Contract signed','Northwind renewed for another 12 months on the Pro plan.','14:15'],
                ],
            ];
        @endphp
        @foreach ($groups as $day => $entries)
            <div class="mb-2 flex items-center gap-3 {{ ! $loop->first ? 'mt-6' : '' }}">
                <span class="rounded-full bg-muted px-3 py-1 text-xs font-semibold text-muted-foreground">{{ $day }}</span>
                <div class="h-px flex-1 bg-border"></div>
            </div>
            <ol>
                @foreach ($entries as $i => [$ico,$tone,$title,$desc,$time])
                    <li class="flex gap-4">
                        <div class="flex flex-col items-center">
                            <span class="grid size-9 shrink-0 place-items-center rounded-full {{ $tone }}"><i data-lucide="{{ $ico }}" class="size-4"></i></span>
                            @unless ($loop->last)<span class="w-px flex-1 bg-border"></span>@endunless
                        </div>
                        <div class="flex-1 pb-5">
                            <div class="rounded-xl border border-border p-3.5">
                                <div class="flex items-center justify-between gap-2">
                                    <p class="text-sm font-semibold">{{ $title }}</p>
                                    <span class="shrink-0 text-xs text-muted-foreground">{{ $time }}</span>
                                </div>
                                <p class="mt-1 text-sm text-muted-foreground">{{ $desc }}</p>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ol>
        @endforeach
    </x-ui.card>
</div>
