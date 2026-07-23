<div>
    <x-page-header :title="$pageTitle" subtitle="Pages · searchable, categorized help center">
        <x-slot:actions>
            <x-ui.button variant="outline" icon="arrow-left" class="[&>svg]:rtl-flip" :href="route('dashboard')">Dashboard</x-ui.button>
        </x-slot:actions>
    </x-page-header>

    <div x-data="{ q: '', cat: 'all', open: 0 }">
        {{-- Search hero --}}
        <x-ui.card class="relative overflow-hidden">
            <div class="pointer-events-none absolute -end-10 -top-10 size-40 rounded-full bg-primary/10 blur-3xl"></div>
            <div class="relative flex flex-col items-center gap-3 py-4 text-center">
                <h2 class="text-xl font-bold">How can we help?</h2>
                <div class="w-full max-w-md"><x-ui.input x-model="q" placeholder="Search for answers…" icon="search" /></div>
            </div>
        </x-ui.card>

        {{-- Category filter --}}
        <div class="mt-4 flex flex-wrap gap-2">
            @foreach (['all' => 'All','account' => 'Account','billing' => 'Billing','security' => 'Security','api' => 'API'] as $key => $label)
                <button @click="cat = '{{ $key }}'" class="rounded-full border px-4 py-1.5 text-sm font-medium transition-colors" :class="cat === '{{ $key }}' ? 'border-primary bg-primary text-primary-foreground' : 'border-border hover:bg-accent'">{{ $label }}</button>
            @endforeach
        </div>

        {{-- FAQ list --}}
        <div class="mt-4 space-y-2.5">
            @php
                $faqs = [
                    ['account','How do I change my password?','Go to Settings → Security, enter your current password and choose a new one. You’ll be signed out of other devices.'],
                    ['account','Can I have multiple workspaces?','Yes. Use the workspace switcher in the top-left to create and switch between unlimited workspaces on paid plans.'],
                    ['billing','Do you offer refunds?','We offer a full refund within 30 days of purchase, no questions asked. Contact support to request one.'],
                    ['billing','How do I update my payment method?','Head to Settings → Billing → Payment methods to add or replace a card. Changes apply to your next invoice.'],
                    ['security','Is my data encrypted?','All data is encrypted in transit (TLS 1.3) and at rest (AES-256). We never share your data with third parties.'],
                    ['security','Do you support SSO?','SAML & OIDC single sign-on is available on the Enterprise plan, along with SCIM provisioning and audit logs.'],
                    ['api','How do I get an API key?','Generate keys under Settings → Developers → API keys. Each key can be scoped to specific permissions.'],
                    ['api','What are the rate limits?','The default limit is 1,000 requests/minute. Enterprise plans can request higher limits.'],
                ];
            @endphp
            @foreach ($faqs as $i => [$c, $q, $a])
                <div x-show="(cat === 'all' || cat === '{{ $c }}') && ('{{ strtolower($q) }}'.includes(q.toLowerCase()))"
                     class="overflow-hidden rounded-xl border border-border">
                    <button type="button" @click="open = open === {{ $i }} ? null : {{ $i }}" class="flex w-full items-center justify-between gap-3 px-4 py-3.5 text-start">
                        <span class="flex items-center gap-3">
                            <span class="grid size-8 shrink-0 place-items-center rounded-lg bg-primary/10 text-primary"><i data-lucide="help-circle" class="size-4"></i></span>
                            <span class="text-sm font-semibold">{{ $q }}</span>
                        </span>
                        <i data-lucide="chevron-down" class="size-4 shrink-0 text-muted-foreground transition-transform" :class="open === {{ $i }} && 'rotate-180'"></i>
                    </button>
                    <div x-show="open === {{ $i }}" x-collapse x-cloak>
                        <p class="px-4 pb-4 ps-15 text-sm leading-relaxed text-muted-foreground">{{ $a }}</p>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Still need help --}}
        <x-ui.card class="mt-4 bg-gradient-to-br from-primary/5 to-transparent">
            <div class="flex flex-col items-center gap-2 py-3 text-center sm:flex-row sm:justify-between sm:text-start">
                <div class="flex items-center gap-3">
                    <span class="grid size-11 place-items-center rounded-xl bg-primary/10 text-primary"><i data-lucide="life-buoy" class="size-5"></i></span>
                    <div><p class="font-semibold">Still need help?</p><p class="text-sm text-muted-foreground">Our team replies within a few hours.</p></div>
                </div>
                <x-ui.button icon="message-square">Contact support</x-ui.button>
            </div>
        </x-ui.card>
    </div>
</div>
