<div>
    <x-page-header :title="'Additional Content'" subtitle="Utilities · typography & content blocks">
        <x-slot:actions>
            <x-ui.button variant="outline" icon="arrow-left" class="[&>svg]:rtl-flip" :href="route('dashboard')">Dashboard</x-ui.button>
        </x-slot:actions>
    </x-page-header>

    <div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
        {{-- Headings --}}
        <x-ui.card title="Headings">
            <div class="space-y-3">
                <div class="flex items-baseline gap-3"><h1 class="text-4xl font-black tracking-tight">H1</h1><span class="text-xs text-muted-foreground">text-4xl · black</span></div>
                <div class="flex items-baseline gap-3"><h2 class="text-3xl font-bold tracking-tight">H2</h2><span class="text-xs text-muted-foreground">text-3xl · bold</span></div>
                <div class="flex items-baseline gap-3"><h3 class="text-2xl font-bold">H3</h3><span class="text-xs text-muted-foreground">text-2xl</span></div>
                <div class="flex items-baseline gap-3"><h4 class="text-xl font-semibold">H4</h4><span class="text-xs text-muted-foreground">text-xl</span></div>
                <div class="flex items-baseline gap-3"><h5 class="text-lg font-semibold">H5</h5><span class="text-xs text-muted-foreground">text-lg</span></div>
                <div class="flex items-baseline gap-3"><h6 class="text-base font-semibold">H6</h6><span class="text-xs text-muted-foreground">text-base</span></div>
            </div>
        </x-ui.card>

        {{-- Text --}}
        <x-ui.card title="Text styles">
            <div class="space-y-3 text-sm">
                <p class="text-lg font-medium">A lead paragraph stands out from the body text with a slightly larger size.</p>
                <p class="text-muted-foreground">Regular body copy in a muted tone. Lorem ipsum dolor sit amet, consectetur adipiscing elit sed do eiusmod tempor.</p>
                <p><strong class="font-semibold">Bold</strong>, <em class="italic">italic</em>, <u>underline</u>, <s class="text-muted-foreground">strikethrough</s>, and <mark class="rounded bg-warning/30 px-1">highlighted</mark> text.</p>
                <p>Inline <code class="rounded bg-muted px-1.5 py-0.5 text-xs text-primary">code snippets</code> and <a href="#" class="font-medium text-primary hover:underline">hyperlinks</a>.</p>
                <p class="text-xs text-muted-foreground">Small print · captions · metadata.</p>
            </div>
        </x-ui.card>

        {{-- Lists --}}
        <x-ui.card title="Lists">
            <div class="grid grid-cols-2 gap-6 text-sm">
                <div>
                    <p class="mb-2 text-xs font-semibold uppercase text-muted-foreground">Unordered</p>
                    <ul class="list-inside list-disc space-y-1 text-muted-foreground"><li>First item</li><li>Second item</li><li>Third item</li></ul>
                </div>
                <div>
                    <p class="mb-2 text-xs font-semibold uppercase text-muted-foreground">Checklist</p>
                    <ul class="space-y-1.5">
                        @foreach (['Design tokens' => true,'Components' => true,'Documentation' => false] as $t => $done)
                            <li class="flex items-center gap-2"><i data-lucide="{{ $done ? 'circle-check-big' : 'circle' }}" class="size-4 {{ $done ? 'text-success' : 'text-muted-foreground/40' }}"></i><span class="{{ $done ? 'text-muted-foreground line-through' : '' }}">{{ $t }}</span></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </x-ui.card>

        {{-- Blockquote & code --}}
        <x-ui.card title="Quote & code block">
            <blockquote class="border-s-4 border-primary bg-primary/5 px-4 py-3 text-sm italic">
                “Simplicity is the ultimate sophistication.”
                <footer class="mt-1 text-xs not-italic text-muted-foreground">— Leonardo da Vinci</footer>
            </blockquote>
            <pre class="mt-3 overflow-x-auto rounded-xl bg-neutral-900 p-4 text-xs leading-relaxed text-neutral-200"><code>php artisan migrate
npm run build
composer dev</code></pre>
        </x-ui.card>
    </div>

    {{-- Description list --}}
    <x-ui.card title="Description list" class="mt-4">
        <dl class="grid grid-cols-1 divide-y divide-border sm:grid-cols-2 sm:divide-y-0">
            @foreach (['Plan' => 'Pro (annual)','Status' => 'Active','Members' => '18 of 20 seats','Renews' => 'July 26, 2026','Storage' => '34.2 GB of 50 GB','Owner' => 'Yrizzz'] as $k => $v)
                <div class="flex items-center justify-between gap-4 py-2.5 sm:px-2"><dt class="text-sm text-muted-foreground">{{ $k }}</dt><dd class="text-sm font-medium">{{ $v }}</dd></div>
            @endforeach
        </dl>
    </x-ui.card>
</div>
