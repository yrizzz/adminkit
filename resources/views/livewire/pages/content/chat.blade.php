<div>
    <x-page-header :title="$pageTitle" subtitle="Pages · conversations & live message thread">
        <x-slot:actions>
            <x-ui.button variant="outline" icon="arrow-left" class="[&>svg]:rtl-flip" :href="route('dashboard')">Dashboard</x-ui.button>
        </x-slot:actions>
    </x-page-header>

    <div x-data="{
            active: 0,
            draft: '',
            q: '',
            avatar(name) { return 'https://api.dicebear.com/9.x/avataaars/svg?seed=' + encodeURIComponent(name) + '&backgroundColor=b6e3f4,c0aede,d1d4f9,ffd5dc,ffdfbf'; },
            chats: [
                { name: 'Aisha Rahman', role: 'Product Designer', status: 'online', unread: 2, msgs: [
                    { me: false, t: 'Hey! Did you get a chance to review the PR?', at: '09:41' },
                    { me: true, t: 'Yep, just left a couple of comments.', at: '09:43', read: true },
                    { me: false, t: 'Awesome, I’ll fix those now.', at: '09:44' },
                    { me: false, t: 'Sounds good, let’s ship it 🚀', at: '09:45' },
                ]},
                { name: 'David Chen', role: 'Engineering Lead', status: 'online', unread: 0, msgs: [
                    { me: false, t: 'The mockups are in Figma whenever you’re ready', at: '08:12' },
                    { me: true, t: 'Perfect, taking a look 👀', at: '08:15', read: true },
                ]},
                { name: 'Sofia Martinez', role: 'Marketing', status: 'away', unread: 0, msgs: [
                    { me: true, t: 'Campaign is live 🎉', at: 'Yesterday', read: true },
                    { me: false, t: 'Thanks for the update!', at: 'Yesterday' },
                ]},
                { name: 'Design Team', role: '6 members', status: 'online', unread: 5, msgs: [
                    { me: false, t: 'Omar: pushed the new icon set', at: 'Mon' },
                ]},
            ],
            get chat() { return this.chats[this.active] },
            get list() { const t = this.q.toLowerCase(); return this.chats.filter(c => c.name.toLowerCase().includes(t)) },
            open(c) { this.active = this.chats.indexOf(c); c.unread = 0 },
            send() {
                const t = this.draft.trim(); if (! t) return;
                this.chat.msgs.push({ me: true, t, at: 'now', read: false }); this.draft = '';
                this.$nextTick(() => { window.renderIcons && window.renderIcons(); const b = this.$refs.thread; if (b) b.scrollTop = b.scrollHeight });
            },
         }"
         x-init="$nextTick(() => { window.renderIcons && window.renderIcons(); const b = $refs.thread; if (b) b.scrollTop = b.scrollHeight })"
         class="ak-card overflow-hidden">
        <div class="grid grid-cols-1 lg:grid-cols-[340px_1fr]">
            {{-- Conversation list --}}
            <div class="flex flex-col border-b border-border lg:h-[36rem] lg:border-b-0 lg:border-e">
                <div class="flex items-center justify-between px-4 pt-4">
                    <h2 class="text-lg font-bold">Messages</h2>
                    <button class="grid size-8 place-items-center rounded-lg text-muted-foreground hover:bg-accent hover:text-foreground"><i data-lucide="square-pen" class="size-4"></i></button>
                </div>
                <div class="p-3">
                    <div class="relative">
                        <i data-lucide="search" class="pointer-events-none absolute inset-y-0 start-0 my-auto ms-3 size-4 text-muted-foreground"></i>
                        <input x-model="q" type="text" placeholder="Search conversations…" class="h-10 w-full rounded-lg border border-input bg-muted/40 ps-9 pe-3 text-sm focus:bg-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring">
                    </div>
                </div>
                <div class="max-h-80 flex-1 space-y-0.5 overflow-y-auto px-2 pb-2 lg:max-h-none">
                    <template x-for="c in list" :key="c.name">
                        <button @click="open(c)" class="relative flex w-full items-center gap-3 rounded-xl p-2.5 text-start transition-colors" :class="chat === c ? 'bg-primary/10' : 'hover:bg-accent/60'">
                            <span x-show="chat === c" class="absolute inset-y-2 start-0 w-1 rounded-full bg-primary"></span>
                            <span class="relative shrink-0">
                                <img :src="avatar(c.name)" alt="" class="size-11 rounded-full bg-muted" />
                                <span class="absolute -end-0.5 -bottom-0.5 size-3 rounded-full border-2 border-card" :class="c.status === 'online' ? 'bg-success' : c.status === 'away' ? 'bg-warning' : 'bg-muted-foreground'"></span>
                            </span>
                            <div class="min-w-0 flex-1">
                                <div class="flex items-center justify-between gap-2">
                                    <p class="truncate text-sm font-semibold" x-text="c.name"></p>
                                    <span class="shrink-0 text-[0.7rem] text-muted-foreground" x-text="c.msgs[c.msgs.length - 1].at"></span>
                                </div>
                                <div class="flex items-center justify-between gap-2">
                                    <p class="truncate text-xs text-muted-foreground" x-text="c.msgs[c.msgs.length - 1].t"></p>
                                    <span x-show="c.unread > 0" class="grid size-5 shrink-0 place-items-center rounded-full bg-primary text-[0.65rem] font-bold text-primary-foreground" x-text="c.unread"></span>
                                </div>
                            </div>
                        </button>
                    </template>
                </div>
            </div>

            {{-- Thread --}}
            <div class="flex h-[36rem] flex-col">
                {{-- header --}}
                <div class="flex items-center gap-3 border-b border-border px-4 py-3">
                    <span class="relative shrink-0">
                        <img :src="avatar(chat.name)" alt="" class="size-10 rounded-full bg-muted" />
                        <span class="absolute -end-0.5 -bottom-0.5 size-3 rounded-full border-2 border-card" :class="chat.status === 'online' ? 'bg-success' : 'bg-warning'"></span>
                    </span>
                    <div class="min-w-0 flex-1">
                        <p class="text-sm font-semibold" x-text="chat.name"></p>
                        <p class="text-xs" :class="chat.status === 'online' ? 'text-success' : 'text-muted-foreground'" x-text="chat.status === 'online' ? 'Active now' : chat.role"></p>
                    </div>
                    @foreach (['phone','video','info'] as $ic)
                        <button class="grid size-9 place-items-center rounded-lg text-muted-foreground hover:bg-accent hover:text-foreground"><i data-lucide="{{ $ic }}" class="size-4"></i></button>
                    @endforeach
                </div>

                {{-- messages --}}
                <div x-ref="thread" class="flex-1 space-y-1 overflow-y-auto bg-muted/20 p-4">
                    <div class="my-3 flex justify-center"><span class="rounded-full bg-card px-3 py-1 text-xs font-medium text-muted-foreground shadow-sm">Today</span></div>
                    <template x-for="(m, i) in chat.msgs" :key="i">
                        <div class="flex items-end gap-2" :class="m.me ? 'justify-end' : 'justify-start'">
                            <img x-show="! m.me" :src="avatar(chat.name)" alt="" class="size-7 shrink-0 rounded-full bg-muted" />
                            <div class="max-w-[75%] rounded-2xl px-3.5 py-2 shadow-sm" :class="m.me ? 'rounded-br-md bg-primary text-primary-foreground' : 'rounded-bl-md border border-border bg-card'">
                                <p class="text-sm" x-text="m.t"></p>
                                <div class="mt-1 flex items-center justify-end gap-1">
                                    <span class="text-[0.65rem]" :class="m.me ? 'text-primary-foreground/70' : 'text-muted-foreground'" x-text="m.at"></span>
                                    <i x-show="m.me" data-lucide="check-check" class="size-3.5" :class="m.read ? 'text-sky-300' : 'text-primary-foreground/60'"></i>
                                </div>
                            </div>
                        </div>
                    </template>
                    {{-- typing --}}
                    <div class="flex items-end gap-2">
                        <img :src="avatar(chat.name)" alt="" class="size-7 shrink-0 rounded-full bg-muted" />
                        <div class="flex items-center gap-1 rounded-2xl rounded-bl-md border border-border bg-card px-3.5 py-3">
                            <span class="size-1.5 animate-bounce rounded-full bg-muted-foreground/60 [animation-delay:-0.3s]"></span>
                            <span class="size-1.5 animate-bounce rounded-full bg-muted-foreground/60 [animation-delay:-0.15s]"></span>
                            <span class="size-1.5 animate-bounce rounded-full bg-muted-foreground/60"></span>
                        </div>
                    </div>
                </div>

                {{-- input --}}
                <form @submit.prevent="send()" class="flex items-center gap-2 border-t border-border p-3">
                    <button type="button" class="grid size-9 shrink-0 place-items-center rounded-full text-muted-foreground hover:bg-accent"><i data-lucide="paperclip" class="size-5"></i></button>
                    <div class="flex flex-1 items-center rounded-full border border-input bg-muted/40 pe-2 focus-within:bg-background focus-within:ring-2 focus-within:ring-ring">
                        <input x-model="draft" type="text" placeholder="Type a message…" class="h-10 flex-1 bg-transparent px-4 text-sm focus:outline-none">
                        <button type="button" class="grid size-8 place-items-center rounded-full text-muted-foreground hover:text-foreground"><i data-lucide="smile" class="size-5"></i></button>
                    </div>
                    <button type="submit" class="grid size-10 shrink-0 place-items-center rounded-full bg-primary text-primary-foreground transition hover:bg-primary/90 active:scale-95"><i data-lucide="send" class="size-4 rtl-flip"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>
