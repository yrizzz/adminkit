<div>
    <x-page-header :title="$pageTitle" subtitle="Ui Elements · contextual feedback messages">
        <x-slot:actions><x-ui.button variant="outline" icon="arrow-left" class="[&>svg]:rtl-flip" :href="route('ui.elements')">All elements</x-ui.button></x-slot:actions>
    </x-page-header>

    <x-demo-section title="Variants" desc="Five tones, with an icon each." />
    <x-ui.card>
        <div class="space-y-3">
            <x-ui.alert variant="default">A neutral message with no particular tone.</x-ui.alert>
            <x-ui.alert variant="info">Informational — here's something you should know.</x-ui.alert>
            <x-ui.alert variant="success">Success — your changes have been saved.</x-ui.alert>
            <x-ui.alert variant="warning">Warning — your storage is almost full.</x-ui.alert>
            <x-ui.alert variant="destructive">Error — we couldn't process that request.</x-ui.alert>
        </div>
    </x-ui.card>

    <x-demo-section title="With titles" desc="A bold heading plus supporting copy." />
    <x-ui.card>
        <div class="space-y-3">
            <x-ui.alert variant="info" title="Heads up!">This alert has a title and a longer description underneath it.</x-ui.alert>
            <x-ui.alert variant="success" title="Payment received">Your Pro subscription is now active until July 2027.</x-ui.alert>
            <x-ui.alert variant="destructive" title="Upload failed">The file exceeds the 10 MB limit. Try compressing it first.</x-ui.alert>
        </div>
    </x-ui.card>

    <x-demo-section title="Dismissible" desc="Click the × to remove." />
    <x-ui.card>
        <div class="space-y-3">
            @foreach ([['info','New version available','AdminKit v2.2 is ready to install.'],['warning','Trial ending soon','Your trial expires in 3 days.']] as $i => [$v,$t,$m])
                <div x-data="{ open: true }" x-show="open" x-transition>
                    <x-ui.alert :variant="$v" :title="$t" class="relative pe-10">
                        {{ $m }}
                        <button @click="open = false" class="absolute end-3 top-3 text-muted-foreground hover:text-foreground"><i data-lucide="x" class="size-4"></i></button>
                    </x-ui.alert>
                </div>
            @endforeach
        </div>
    </x-ui.card>

    <x-demo-section title="With actions" desc="Alerts that ask for a decision." />
    <x-ui.card>
        <div class="space-y-3">
            <x-ui.alert variant="warning" title="Confirm your email address">
                We sent a verification link to admin@adminkit.test.
                <div class="mt-2.5 flex gap-2"><x-ui.button size="sm">Resend email</x-ui.button><x-ui.button size="sm" variant="ghost">I'll do it later</x-ui.button></div>
            </x-ui.alert>
            <x-ui.alert variant="destructive" title="Delete this workspace?">
                This removes all projects and cannot be undone.
                <div class="mt-2.5 flex gap-2"><x-ui.button size="sm" variant="destructive">Delete</x-ui.button><x-ui.button size="sm" variant="outline">Cancel</x-ui.button></div>
            </x-ui.alert>
        </div>
    </x-ui.card>

    <x-demo-section title="Banner" desc="Full-width, edge-to-edge announcements." />
    <div class="space-y-3">
        <div class="flex items-center gap-3 rounded-xl bg-gradient-to-r from-primary to-sidebar-primary px-4 py-3 text-sm text-white">
            <i data-lucide="megaphone" class="size-5 shrink-0"></i>
            <p class="flex-1"><span class="font-semibold">Black Friday</span> — 40% off all annual plans this week only.</p>
            <button class="rounded-lg bg-white/15 px-3 py-1 text-xs font-semibold backdrop-blur hover:bg-white/25">Claim offer</button>
        </div>
        <div class="flex items-center gap-3 rounded-xl border border-border bg-muted/40 px-4 py-3 text-sm">
            <i data-lucide="info" class="size-5 shrink-0 text-info"></i>
            <p class="flex-1">Scheduled maintenance this Sunday 02:00–04:00 WIB.</p>
            <button class="text-muted-foreground hover:text-foreground"><i data-lucide="x" class="size-4"></i></button>
        </div>
    </div>
</div>
