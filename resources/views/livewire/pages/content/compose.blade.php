<div>
    <x-page-header :title="'Compose'" subtitle="Pages · write a new email">
        <x-slot:actions>
            <x-ui.button variant="outline" icon="arrow-left" class="[&>svg]:rtl-flip" :href="route('page', ['path' => 'inbox'])" wire:navigate>Back to inbox</x-ui.button>
        </x-slot:actions>
    </x-page-header>

    <x-ui.card :padded="false" class="mx-auto max-w-3xl" x-data="{ cc: false }">
        <div class="space-y-0 divide-y divide-border">
            <div class="flex items-center gap-3 px-4 py-2.5">
                <span class="w-14 text-sm text-muted-foreground">To</span>
                <input type="email" placeholder="recipient@example.com" class="flex-1 bg-transparent text-sm focus:outline-none">
                <button @click="cc = ! cc" class="text-xs font-medium text-primary hover:underline">Cc/Bcc</button>
            </div>
            <div x-show="cc" x-collapse x-cloak>
                <div class="flex items-center gap-3 px-4 py-2.5"><span class="w-14 text-sm text-muted-foreground">Cc</span><input type="email" class="flex-1 bg-transparent text-sm focus:outline-none"></div>
                <div class="flex items-center gap-3 border-t border-border px-4 py-2.5"><span class="w-14 text-sm text-muted-foreground">Bcc</span><input type="email" class="flex-1 bg-transparent text-sm focus:outline-none"></div>
            </div>
            <div class="flex items-center gap-3 px-4 py-2.5">
                <span class="w-14 text-sm text-muted-foreground">Subject</span>
                <input type="text" placeholder="Subject" class="flex-1 bg-transparent text-sm focus:outline-none">
            </div>
        </div>

        {{-- Toolbar --}}
        <div class="flex items-center gap-0.5 border-y border-border bg-muted/30 px-3 py-1.5">
            @foreach (['bold','italic','underline','list','link','image','code'] as $ic)
                <button class="rounded-md p-1.5 text-muted-foreground hover:bg-accent hover:text-foreground"><i data-lucide="{{ $ic }}" class="size-4"></i></button>
            @endforeach
        </div>

        {{-- Body --}}
        <textarea rows="10" placeholder="Write your message…" class="w-full resize-none border-0 bg-transparent px-4 py-3 text-sm focus:outline-none focus:ring-0"></textarea>

        {{-- Attachment chip --}}
        <div class="px-4 pb-2">
            <span class="inline-flex items-center gap-2 rounded-lg border border-border px-2.5 py-1.5 text-xs">
                <i data-lucide="paperclip" class="size-3.5 text-muted-foreground"></i>proposal.pdf
                <button class="text-muted-foreground hover:text-destructive"><i data-lucide="x" class="size-3.5"></i></button>
            </span>
        </div>

        {{-- Footer --}}
        <div class="flex items-center justify-between border-t border-border p-3">
            <div class="flex gap-1">
                <button class="rounded-lg p-2 text-muted-foreground hover:bg-accent"><i data-lucide="paperclip" class="size-4"></i></button>
                <button class="rounded-lg p-2 text-muted-foreground hover:bg-accent"><i data-lucide="image" class="size-4"></i></button>
                <button class="rounded-lg p-2 text-muted-foreground hover:bg-accent hover:text-destructive"><i data-lucide="trash-2" class="size-4"></i></button>
            </div>
            <div class="flex gap-2">
                <x-ui.button variant="outline">Save draft</x-ui.button>
                <x-ui.button icon="send" class="[&>svg]:rtl-flip" x-on:click="window.toast('Email sent', { variant: 'success' })">Send</x-ui.button>
            </div>
        </div>
    </x-ui.card>
</div>
