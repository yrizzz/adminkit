<div>
    <x-page-header :title="'Read Message'" subtitle="Pages · full email view with thread & reply">
        <x-slot:actions>
            <x-ui.button variant="outline" icon="arrow-left" class="[&>svg]:rtl-flip" :href="route('page', ['path' => 'inbox'])" wire:navigate>Back to inbox</x-ui.button>
        </x-slot:actions>
    </x-page-header>

    <x-ui.card class="mx-auto max-w-3xl">
        {{-- Subject + actions --}}
        <div class="flex flex-wrap items-start justify-between gap-3 border-b border-border pb-4">
            <div>
                <div class="flex items-center gap-2"><h1 class="text-xl font-bold">Q3 roadmap review</h1><x-ui.badge variant="info">Inbox</x-ui.badge><i data-lucide="star" class="size-4 fill-amber-400 text-amber-400"></i></div>
                <p class="mt-1 text-sm text-muted-foreground">2 messages · Jul 22, 2026</p>
            </div>
            <div class="flex gap-1">
                @foreach (['reply','forward','archive','trash-2'] as $ic)
                    <button class="rounded-lg p-2 text-muted-foreground hover:bg-accent {{ $ic === 'trash-2' ? 'hover:text-destructive' : '' }}"><i data-lucide="{{ $ic }}" class="size-4 {{ $ic === 'forward' ? 'rtl-flip' : '' }}"></i></button>
                @endforeach
            </div>
        </div>

        {{-- Thread --}}
        <div class="space-y-6 py-5">
            @foreach ([
                ['Aisha Rahman','aisha@northwind.co','09:41',"Hi team,\n\nI've put together the priorities for next quarter. Please review the attached doc and add your comments before Friday.\n\nHighlights:\n• Ship the new onboarding\n• Launch mobile beta\n• Revamp the billing flow\n\nThanks,\nAisha"],
                ['You','you@adminkit.test','10:02',"Thanks Aisha — this looks solid. I'll add notes on the billing flow by EOD. One question: are we still targeting the same launch date for the mobile beta?"],
            ] as $i => [$name,$email,$time,$body])
                <div class="flex gap-3">
                    <x-ui.avatar :name="$name" size="md" />
                    <div class="min-w-0 flex-1">
                        <div class="flex flex-wrap items-center justify-between gap-2">
                            <div><span class="text-sm font-semibold">{{ $name }}</span> <span class="text-xs text-muted-foreground">&lt;{{ $email }}&gt;</span></div>
                            <span class="text-xs text-muted-foreground">{{ $time }}</span>
                        </div>
                        <p class="mt-2 whitespace-pre-line text-sm leading-relaxed text-muted-foreground">{{ $body }}</p>
                        @if ($i === 0)
                            <div class="mt-3 flex items-center gap-2 rounded-lg border border-border p-2.5">
                                <span class="grid size-9 place-items-center rounded-lg bg-destructive/10 text-destructive"><i data-lucide="file-text" class="size-4"></i></span>
                                <div class="flex-1"><p class="text-sm font-medium">Q3-roadmap.pdf</p><p class="text-xs text-muted-foreground">248 KB</p></div>
                                <button class="rounded-lg p-1.5 text-muted-foreground hover:bg-accent"><i data-lucide="download" class="size-4"></i></button>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Reply box --}}
        <div class="border-t border-border pt-4">
            <textarea rows="3" placeholder="Reply to Aisha…" class="w-full rounded-lg border border-input bg-background px-3 py-2 text-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring"></textarea>
            <div class="mt-2 flex items-center justify-between">
                <div class="flex gap-1"><button class="rounded-lg p-2 text-muted-foreground hover:bg-accent"><i data-lucide="paperclip" class="size-4"></i></button><button class="rounded-lg p-2 text-muted-foreground hover:bg-accent"><i data-lucide="smile" class="size-4"></i></button></div>
                <x-ui.button icon="send" class="[&>svg]:rtl-flip" x-on:click="window.toast('Reply sent', { variant: 'success' })">Send</x-ui.button>
            </div>
        </div>
    </x-ui.card>
</div>
