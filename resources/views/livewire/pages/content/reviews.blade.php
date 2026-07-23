<div>
    <x-page-header :title="$pageTitle" subtitle="Pages · ratings summary & customer feedback">
        <x-slot:actions>
            <x-ui.button variant="outline" icon="arrow-left" class="[&>svg]:rtl-flip" :href="route('dashboard')">Dashboard</x-ui.button>
            <x-ui.button icon="pen-line">Write a review</x-ui.button>
        </x-slot:actions>
    </x-page-header>

    {{-- Summary --}}
    <x-ui.card class="mb-4">
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-3">
            <div class="flex flex-col items-center justify-center rounded-xl bg-gradient-to-br from-amber-50 to-orange-50 p-6 text-center dark:from-amber-950/30 dark:to-orange-950/20">
                <span class="text-5xl font-bold">4.6</span>
                <div class="mt-1.5 flex gap-0.5">@for ($n = 1; $n <= 5; $n++)<i data-lucide="star" class="size-4 {{ $n <= 4 ? 'fill-amber-400 text-amber-400' : 'fill-amber-400/50 text-amber-400/50' }}"></i>@endfor</div>
                <span class="mt-1.5 text-xs text-muted-foreground">1,204 reviews</span>
            </div>
            <div class="space-y-2.5 sm:col-span-2">
                @foreach ([['5',72],['4',18],['3',6],['2',2],['1',2]] as [$star, $pct])
                    <div class="flex items-center gap-3 text-sm">
                        <span class="flex w-8 items-center gap-1 text-muted-foreground">{{ $star }}<i data-lucide="star" class="size-3 fill-amber-400 text-amber-400"></i></span>
                        <div class="h-2.5 flex-1 overflow-hidden rounded-full bg-muted"><div class="h-full rounded-full bg-gradient-to-r from-amber-400 to-amber-500" style="width: {{ $pct }}%"></div></div>
                        <span class="w-10 text-end text-muted-foreground">{{ $pct }}%</span>
                    </div>
                @endforeach
            </div>
        </div>
    </x-ui.card>

    {{-- Filter --}}
    <div x-data="{ f: 'all' }">
        <div class="mb-4 flex flex-wrap gap-2">
            @foreach (['all' => 'All reviews','5' => '5 star','4' => '4 star','3' => '3 star','low' => 'Critical'] as $key => $label)
                <button @click="f = '{{ $key }}'" class="rounded-full border px-4 py-1.5 text-sm font-medium transition-colors" :class="f === '{{ $key }}' ? 'border-primary bg-primary text-primary-foreground' : 'border-border hover:bg-accent'">{{ $label }}</button>
            @endforeach
        </div>

        <div class="space-y-4">
            @php
                $reviews = [
                    ['Aisha Rahman',5,'2 days ago','Absolutely love it','Exceeded my expectations in every way. The build quality is fantastic and setup took less than five minutes.',42,true],
                    ['David Chen',4,'5 days ago','Great value for money','Works really well for the price. Docked one star because shipping took a bit longer than expected.',18,true],
                    ['Sofia Martinez',5,'1 week ago','Best purchase this year','I recommend this to everyone. The support team was also incredibly responsive.',31,false],
                    ['Omar Haddad',3,'2 weeks ago','Decent but has quirks','Does the job, though the app could use some polish. Hoping for updates soon.',7,false],
                    ['Priya Sharma',2,'3 weeks ago','Not quite for me','The concept is good but I ran into a few reliability issues. Returned it in the end.',4,false],
                ];
            @endphp
            @foreach ($reviews as [$name,$rating,$when,$title,$body,$helpful,$verified])
                <x-ui.card x-show="f === 'all' || f === '{{ $rating }}' || (f === 'low' && {{ $rating }} <= 3)" x-transition.opacity>
                    <div class="flex items-start gap-3">
                        <x-ui.avatar :name="$name" size="md" />
                        <div class="min-w-0 flex-1">
                            <div class="flex flex-wrap items-center gap-2">
                                <p class="font-semibold">{{ $name }}</p>
                                @if ($verified)<x-ui.badge variant="success">Verified</x-ui.badge>@endif
                                <span class="ms-auto text-xs text-muted-foreground">{{ $when }}</span>
                            </div>
                            <div class="mt-1 flex gap-0.5">@for ($n = 1; $n <= 5; $n++)<i data-lucide="star" class="size-3.5 {{ $n <= $rating ? 'fill-amber-400 text-amber-400' : 'text-muted-foreground/30' }}"></i>@endfor</div>
                            <p class="mt-2 font-semibold">{{ $title }}</p>
                            <p class="mt-1 text-sm text-muted-foreground">{{ $body }}</p>
                            <div class="mt-3 flex items-center gap-4 text-sm">
                                <button class="flex items-center gap-1.5 text-muted-foreground transition-colors hover:text-primary"><i data-lucide="thumbs-up" class="size-4"></i>Helpful ({{ $helpful }})</button>
                                <button class="text-muted-foreground transition-colors hover:text-foreground">Reply</button>
                            </div>
                        </div>
                    </div>
                </x-ui.card>
            @endforeach
        </div>
    </div>
</div>
