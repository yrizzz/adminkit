<div>
    <x-page-header :title="'Inbox'" subtitle="Pages · Gmail-style mailbox">
        <x-slot:actions>
            <x-ui.button variant="outline" icon="arrow-left" class="[&>svg]:rtl-flip" :href="route('dashboard')">Dashboard</x-ui.button>
        </x-slot:actions>
    </x-page-header>

    <x-ui.card :padded="false" class="overflow-hidden" x-data="{
            view: 'list',
            selected: 0,
            tab: 'primary',
            avatar(name) { return 'https://api.dicebear.com/9.x/avataaars/svg?seed=' + encodeURIComponent(name) + '&backgroundColor=b6e3f4,c0aede,d1d4f9,ffd5dc,ffdfbf' },
            mails: [
                { from: 'Aisha Rahman', mono: null, cat: 'primary', subj: 'Q3 roadmap review', snippet: 'Hi team, I’ve put together the priorities for next quarter…', body: 'Hi team,\n\nI’ve put together the priorities for next quarter. Please review the attached doc and add your comments before Friday.\n\nHighlights:\n• Ship the new onboarding\n• Launch mobile beta\n• Revamp the billing flow\n\nThanks,\nAisha', at: '09:41', unread: true, star: true, attach: true },
                { from: 'GitHub', mono: ['G','bg-neutral-900 text-white'], cat: 'updates', subj: '[adminkit] PR #218 merged', snippet: 'Your pull request was merged into main by David Chen.', body: 'Your pull request #218 “Add timeline dashboard” was merged into main by David Chen.', at: '08:12', unread: true, star: false, attach: false },
                { from: 'Sofia Martinez', mono: null, cat: 'primary', subj: 'Campaign results are in 🎉', snippet: 'The July campaign beat its target by 24%. Full report inside.', body: 'The July campaign beat its target by 24%. Full report attached — great work everyone!', at: 'Jul 21', unread: false, star: true, attach: true },
                { from: 'Stripe', mono: ['S','bg-indigo-600 text-white'], cat: 'updates', subj: 'Your payout is on the way', snippet: 'A payout of $4,280.00 is expected to arrive by Jul 24.', body: 'A payout of $4,280.00 is on its way to your bank account ending in 4242.', at: 'Jul 21', unread: false, star: false, attach: false },
                { from: 'Notion', mono: ['N','bg-neutral-800 text-white'], cat: 'promotions', subj: '⚡ 50% off Notion AI — this week only', snippet: 'Upgrade your workspace with AI. Limited-time launch pricing.', body: 'Upgrade your workspace with Notion AI at 50% off — this week only.', at: 'Jul 20', unread: true, star: false, attach: false },
                { from: 'LinkedIn', mono: ['in','bg-blue-700 text-white'], cat: 'social', subj: 'David Chen and 3 others reacted to your post', snippet: 'See who’s engaging with your latest update.', body: 'David Chen, Priya Sharma and 2 others reacted to your recent post.', at: 'Jul 19', unread: false, star: false, attach: false },
                { from: 'Priya Sharma', mono: null, cat: 'primary', subj: 'Data export ready', snippet: 'The analytics export you requested is ready to download.', body: 'The analytics export you requested is ready. The link expires in 7 days.', at: 'Jul 18', unread: false, star: false, attach: false },
            ],
            get mail() { return this.mails[this.selected] },
            get unreadCount() { return this.mails.filter(m => m.unread).length },
            catCount(c) { return this.mails.filter(m => m.cat === c && m.unread).length },
            open(m) { this.selected = this.mails.indexOf(m); m.unread = false; this.view = 'read' },
         }"
         x-init="$nextTick(() => window.renderIcons && window.renderIcons())">
        <div class="grid grid-cols-1 lg:grid-cols-[240px_1fr]">
            {{-- Sidebar --}}
            <div class="border-b border-border p-3 lg:border-b-0 lg:border-e">
                <button @click="$dispatch('open-modal','gm-compose')" class="mb-3 inline-flex items-center gap-3 rounded-2xl bg-card px-5 py-3.5 text-sm font-semibold shadow-md ring-1 ring-border transition hover:shadow-lg">
                    <i data-lucide="pencil" class="size-5 text-primary"></i>Compose
                </button>
                <nav class="space-y-0.5">
                    @foreach (['inbox' => ['Inbox','inbox'],'starred' => ['Starred','star'],'snoozed' => ['Snoozed','clock'],'sent' => ['Sent','send'],'drafts' => ['Drafts','file'],'spam' => ['Spam','octagon-alert'],'trash' => ['Trash','trash-2']] as $key => [$label,$ico])
                        <button @click="tab = 'primary'" class="flex w-full items-center gap-4 rounded-e-full rounded-s-full px-4 py-2 text-sm transition-colors {{ $key === 'inbox' ? 'bg-primary/10 font-semibold text-primary' : 'text-foreground/80 hover:bg-accent' }}">
                            <i data-lucide="{{ $ico }}" class="size-[1.15rem]"></i>{{ $label }}
                            @if ($key === 'inbox')<span class="ms-auto text-xs font-semibold" x-text="unreadCount"></span>@endif
                        </button>
                    @endforeach
                </nav>
                <div class="mt-2 border-t border-border pt-2">
                    <p class="px-4 pb-1 pt-1 text-xs font-semibold text-muted-foreground">Labels</p>
                    @foreach ([['Work','bg-info'],['Marketing','bg-success'],['Finance','bg-warning']] as [$label,$dot])
                        <button class="flex w-full items-center gap-4 rounded-e-full rounded-s-full px-4 py-1.5 text-sm text-foreground/80 hover:bg-accent"><span class="size-3 rounded-full {{ $dot }}"></span>{{ $label }}</button>
                    @endforeach
                </div>
            </div>

            {{-- Main --}}
            <div class="min-w-0">
                {{-- ===== LIST VIEW ===== --}}
                <div x-show="view === 'list'">
                    {{-- Toolbar --}}
                    <div class="flex items-center gap-1 border-b border-border px-3 py-1.5">
                        <label class="grid size-9 cursor-pointer place-items-center rounded-full hover:bg-accent"><input type="checkbox" class="size-4 rounded border-input text-primary focus:ring-primary"></label>
                        <button class="grid size-9 place-items-center rounded-full text-muted-foreground hover:bg-accent" @click="window.renderIcons && window.renderIcons()"><i data-lucide="rotate-cw" class="size-4"></i></button>
                        <button class="grid size-9 place-items-center rounded-full text-muted-foreground hover:bg-accent"><i data-lucide="ellipsis-vertical" class="size-4"></i></button>
                        <div class="ms-auto flex items-center gap-1 text-xs text-muted-foreground">
                            <span>1–<span x-text="mails.length"></span> of <span x-text="mails.length"></span></span>
                            <button class="grid size-8 place-items-center rounded-full hover:bg-accent"><i data-lucide="chevron-left" class="rtl-flip size-4"></i></button>
                            <button class="grid size-8 place-items-center rounded-full hover:bg-accent"><i data-lucide="chevron-right" class="rtl-flip size-4"></i></button>
                        </div>
                    </div>

                    {{-- Category tabs --}}
                    <div class="flex border-b border-border">
                        @foreach (['primary' => ['Primary','inbox'],'promotions' => ['Promotions','tag'],'social' => ['Social','users'],'updates' => ['Updates','info']] as $key => [$label,$ico])
                            <button @click="tab = '{{ $key }}'" class="relative flex flex-1 items-center justify-center gap-2 px-3 py-3 text-sm font-medium transition-colors sm:justify-start" :class="tab === '{{ $key }}' ? 'text-primary' : 'text-muted-foreground hover:bg-accent/40'">
                                <i data-lucide="{{ $ico }}" class="size-4"></i>
                                <span class="hidden sm:inline">{{ $label }}</span>
                                <span x-show="catCount('{{ $key }}') > 0" class="rounded-full bg-primary/15 px-1.5 text-xs font-semibold text-primary" x-text="catCount('{{ $key }}')"></span>
                                <span x-show="tab === '{{ $key }}'" class="absolute inset-x-0 bottom-0 h-0.5 bg-primary"></span>
                            </button>
                        @endforeach
                    </div>

                    {{-- Rows --}}
                    <div class="divide-y divide-border">
                        <template x-for="(m, i) in mails" :key="i">
                            <div x-show="m.cat === tab" @click="open(m)"
                                 class="group flex cursor-pointer items-center gap-3 px-3 py-2.5 transition-colors"
                                 :class="m.unread ? 'bg-background hover:shadow-[inset_1px_0_0_hsl(var(--primary)),0_1px_2px_rgba(0,0,0,.08)] hover:z-10' : 'bg-muted/40 hover:bg-background hover:shadow-[0_1px_2px_rgba(0,0,0,.08)]'">
                                <input type="checkbox" @click.stop class="size-4 shrink-0 rounded border-input text-primary focus:ring-primary">
                                <button @click.stop="m.star = ! m.star" class="shrink-0"><i data-lucide="star" class="size-4" :class="m.star ? 'fill-amber-400 text-amber-400' : 'text-muted-foreground/40 hover:text-muted-foreground'"></i></button>
                                {{-- sender --}}
                                <div class="flex w-32 shrink-0 items-center gap-2 sm:w-44">
                                    <template x-if="m.mono"><span class="grid size-6 shrink-0 place-items-center rounded-full text-[0.6rem] font-bold" :class="m.mono[1]" x-text="m.mono[0]"></span></template>
                                    <template x-if="! m.mono"><img :src="avatar(m.from)" alt="" class="size-6 shrink-0 rounded-full bg-muted"></template>
                                    <span class="truncate text-sm" :class="m.unread ? 'font-bold text-foreground' : 'text-foreground/80'" x-text="m.from"></span>
                                </div>
                                {{-- subject + snippet --}}
                                <div class="min-w-0 flex-1 truncate text-sm">
                                    <span :class="m.unread ? 'font-semibold' : 'text-foreground/90'" x-text="m.subj"></span>
                                    <span class="text-muted-foreground"> — <span x-text="m.snippet"></span></span>
                                </div>
                                <i data-lucide="paperclip" class="size-3.5 shrink-0 text-muted-foreground" x-show="m.attach"></i>
                                {{-- date / hover actions --}}
                                <div class="w-16 shrink-0 text-end">
                                    <span class="text-xs group-hover:hidden" :class="m.unread ? 'font-semibold text-foreground' : 'text-muted-foreground'" x-text="m.at"></span>
                                    <div class="hidden items-center justify-end gap-0.5 group-hover:flex">
                                        <button @click.stop class="grid size-7 place-items-center rounded-full text-muted-foreground hover:bg-accent"><i data-lucide="archive" class="size-4"></i></button>
                                        <button @click.stop="mails.splice(i,1)" class="grid size-7 place-items-center rounded-full text-muted-foreground hover:bg-accent hover:text-destructive"><i data-lucide="trash-2" class="size-4"></i></button>
                                    </div>
                                </div>
                            </div>
                        </template>
                        <div x-show="mails.filter(m => m.cat === tab).length === 0" class="flex flex-col items-center gap-2 p-12 text-center text-muted-foreground">
                            <i data-lucide="inbox" class="size-10"></i><p class="text-sm">Nothing in this category.</p>
                        </div>
                    </div>
                </div>

                {{-- ===== READ VIEW ===== --}}
                <div x-show="view === 'read'" x-cloak>
                    <div class="flex items-center gap-1 border-b border-border px-3 py-1.5">
                        <button @click="view = 'list'" class="grid size-9 place-items-center rounded-full text-muted-foreground hover:bg-accent"><i data-lucide="arrow-left" class="rtl-flip size-4"></i></button>
                        @foreach (['archive','octagon-alert','trash-2','mail-open','clock'] as $ic)
                            <button class="grid size-9 place-items-center rounded-full text-muted-foreground hover:bg-accent {{ $ic === 'trash-2' ? 'hover:text-destructive' : '' }}"><i data-lucide="{{ $ic }}" class="size-4"></i></button>
                        @endforeach
                    </div>
                    <div class="p-5">
                        <div class="mb-4 flex items-start justify-between gap-3">
                            <h1 class="text-xl font-normal" x-text="mail.subj"></h1>
                            <button @click="mail.star = ! mail.star" class="shrink-0"><i data-lucide="star" class="size-5" :class="mail.star ? 'fill-amber-400 text-amber-400' : 'text-muted-foreground/40'"></i></button>
                        </div>
                        <div class="flex items-center gap-3">
                            <template x-if="mail.mono"><span class="grid size-10 place-items-center rounded-full text-sm font-bold" :class="mail.mono[1]" x-text="mail.mono[0]"></span></template>
                            <template x-if="! mail.mono"><img :src="avatar(mail.from)" alt="" class="size-10 rounded-full bg-muted"></template>
                            <div class="min-w-0 flex-1">
                                <p class="text-sm"><span class="font-semibold" x-text="mail.from"></span> <span class="text-muted-foreground text-xs">to me</span></p>
                                <p class="text-xs text-muted-foreground" x-text="mail.at"></p>
                            </div>
                            <div class="flex gap-1">
                                <button class="grid size-8 place-items-center rounded-full text-muted-foreground hover:bg-accent"><i data-lucide="reply" class="size-4"></i></button>
                                <button class="grid size-8 place-items-center rounded-full text-muted-foreground hover:bg-accent"><i data-lucide="ellipsis-vertical" class="size-4"></i></button>
                            </div>
                        </div>
                        <p class="mt-5 whitespace-pre-line text-sm leading-relaxed text-foreground/90" x-text="mail.body"></p>
                        <div class="mt-6 flex gap-2">
                            <x-ui.button variant="outline" icon="reply" class="rounded-full">Reply</x-ui.button>
                            <x-ui.button variant="outline" icon="forward" class="rounded-full [&>svg]:rtl-flip">Forward</x-ui.button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-ui.card>

    {{-- Compose modal (Gmail-style, opened from the button) --}}
    <x-ui.modal name="gm-compose" title="New message" maxWidth="max-w-lg">
        <div class="space-y-0 divide-y divide-border text-sm">
            <div class="flex items-center gap-2 py-2"><span class="text-muted-foreground">To</span><input class="flex-1 bg-transparent focus:outline-none" placeholder="recipients"></div>
            <div class="py-2"><input class="w-full bg-transparent focus:outline-none" placeholder="Subject"></div>
        </div>
        <textarea rows="6" class="mt-2 w-full resize-none bg-transparent text-sm focus:outline-none" placeholder="Compose your message…"></textarea>
        <x-slot:footer>
            <x-ui.button icon="send" class="[&>svg]:rtl-flip" x-on:click="$dispatch('close-modal','gm-compose'); window.toast('Email sent', { variant: 'success' })">Send</x-ui.button>
        </x-slot:footer>
    </x-ui.modal>
</div>
