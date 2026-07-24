<div>
    <x-page-header :title="$pageTitle" subtitle="Ui Elements · headings, text & inline styles">
        <x-slot:actions><x-ui.button variant="outline" icon="arrow-left" class="[&>svg]:rtl-flip" :href="route('ui.elements')">All elements</x-ui.button></x-slot:actions>
    </x-page-header>

    <x-demo-section title="Headings" desc="Six levels plus a display size." />
    <x-ui.card>
        <div class="space-y-3">
            <div class="flex flex-wrap items-baseline gap-4"><p class="text-5xl font-black tracking-tighter">Display</p><code class="text-xs text-muted-foreground">text-5xl font-black</code></div>
            <div class="flex flex-wrap items-baseline gap-4"><h1 class="text-4xl font-black tracking-tight">Heading 1</h1><code class="text-xs text-muted-foreground">text-4xl</code></div>
            <div class="flex flex-wrap items-baseline gap-4"><h2 class="text-3xl font-bold tracking-tight">Heading 2</h2><code class="text-xs text-muted-foreground">text-3xl</code></div>
            <div class="flex flex-wrap items-baseline gap-4"><h3 class="text-2xl font-bold">Heading 3</h3><code class="text-xs text-muted-foreground">text-2xl</code></div>
            <div class="flex flex-wrap items-baseline gap-4"><h4 class="text-xl font-semibold">Heading 4</h4><code class="text-xs text-muted-foreground">text-xl</code></div>
            <div class="flex flex-wrap items-baseline gap-4"><h5 class="text-lg font-semibold">Heading 5</h5><code class="text-xs text-muted-foreground">text-lg</code></div>
            <div class="flex flex-wrap items-baseline gap-4"><h6 class="text-base font-semibold">Heading 6</h6><code class="text-xs text-muted-foreground">text-base</code></div>
        </div>
    </x-ui.card>

    <x-demo-section title="Body text" desc="Lead, body, small and muted." />
    <div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
        <x-ui.card title="Paragraph scale">
            <p class="text-lg font-medium">A lead paragraph introduces the section with slightly larger text.</p>
            <p class="mt-3 text-sm">Regular body copy. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore.</p>
            <p class="mt-3 text-sm text-muted-foreground">Muted body copy for secondary information.</p>
            <p class="mt-3 text-xs text-muted-foreground">Small print — captions, metadata and footnotes.</p>
        </x-ui.card>

        <x-ui.card title="Inline styles">
            <p class="space-x-1 text-sm leading-loose">
                <strong class="font-semibold">Bold</strong>, <em class="italic">italic</em>, <u>underline</u>,
                <s class="text-muted-foreground">strikethrough</s>, <mark class="rounded bg-warning/30 px-1">highlighted</mark>,
                <a href="#" class="font-medium text-primary hover:underline">a link</a>,
                <code class="rounded bg-muted px-1.5 py-0.5 text-xs text-primary">inline code</code>,
                <kbd class="rounded border border-border bg-muted px-1.5 py-0.5 text-xs font-semibold">⌘K</kbd>,
                <span class="text-xs align-super">superscript</span> and <span class="text-xs align-sub">subscript</span>.
            </p>
        </x-ui.card>
    </div>

    <x-demo-section title="Lists" desc="Unordered, ordered and description." />
    <div class="grid grid-cols-1 gap-4 lg:grid-cols-3">
        <x-ui.card title="Unordered">
            <ul class="list-inside list-disc space-y-1 text-sm text-muted-foreground"><li>First item</li><li>Second item</li><li>Third item</li></ul>
        </x-ui.card>
        <x-ui.card title="Ordered">
            <ol class="list-inside list-decimal space-y-1 text-sm text-muted-foreground"><li>Install the package</li><li>Publish the config</li><li>Run the migrations</li></ol>
        </x-ui.card>
        <x-ui.card title="Description">
            <dl class="space-y-2 text-sm">
                @foreach (['Plan' => 'Pro (annual)', 'Status' => 'Active', 'Renews' => 'Jul 2027'] as $k => $v)
                    <div class="flex justify-between"><dt class="text-muted-foreground">{{ $k }}</dt><dd class="font-medium">{{ $v }}</dd></div>
                @endforeach
            </dl>
        </x-ui.card>
    </div>

    <x-demo-section title="Blockquote & code" desc="Long-form building blocks." />
    <div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
        <x-ui.card title="Blockquote">
            <blockquote class="border-s-4 border-primary bg-primary/5 px-5 py-3 text-sm italic">
                "Simplicity is the ultimate sophistication."
                <footer class="mt-1 text-xs not-italic text-muted-foreground">— Leonardo da Vinci</footer>
            </blockquote>
        </x-ui.card>
        <x-ui.card title="Code block">
            <pre class="overflow-x-auto rounded-xl bg-neutral-900 p-4 text-xs leading-relaxed text-neutral-200"><code>composer install
php artisan migrate
npm run build</code></pre>
        </x-ui.card>
    </div>

    <x-demo-section title="Alignment & transform" desc="Utility text classes." />
    <x-ui.card>
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <div class="space-y-1 text-sm">
                <p class="text-start">Start aligned</p><p class="text-center">Center aligned</p><p class="text-end">End aligned</p>
            </div>
            <div class="space-y-1 text-sm">
                <p class="uppercase tracking-wide">uppercase</p><p class="lowercase">LOWERCASE</p><p class="capitalize">capitalized text</p><p class="truncate">A very long line that will be truncated with an ellipsis when it runs out of room</p>
            </div>
        </div>
    </x-ui.card>
</div>
