<div>
    <x-page-header :title="'Terms & Conditions'" subtitle="Pages · legal document with table of contents">
        <x-slot:actions>
            <x-ui.button variant="outline" icon="arrow-left" class="[&>svg]:rtl-flip" :href="route('dashboard')">Dashboard</x-ui.button>
            <x-ui.button variant="outline" icon="printer" onclick="window.print()">Print</x-ui.button>
        </x-slot:actions>
    </x-page-header>

    @php
        $sections = [
            ['acceptance','Acceptance of terms','By accessing and using this service, you accept and agree to be bound by these terms. If you do not agree, please discontinue use of the platform immediately.'],
            ['accounts','User accounts','You are responsible for safeguarding your account credentials and for any activity that occurs under your account. Notify us immediately of any unauthorized use.'],
            ['usage','Acceptable use','You agree not to misuse the service, including attempting to access it using a method other than the interfaces and instructions we provide, or interfering with its normal operation.'],
            ['payments','Payments & billing','Paid plans are billed in advance on a recurring basis. All fees are non-refundable except where required by law or explicitly stated in our refund policy.'],
            ['privacy','Privacy','Your use of the service is also governed by our Privacy Policy, which describes how we collect, use and protect your personal information.'],
            ['liability','Limitation of liability','To the maximum extent permitted by law, we shall not be liable for any indirect, incidental or consequential damages arising from your use of the service.'],
            ['changes','Changes to terms','We may revise these terms from time to time. The most current version will always be posted here, and material changes will be communicated in advance.'],
        ];
    @endphp

    <div x-data="{ active: 'acceptance' }" class="grid grid-cols-1 gap-4 lg:grid-cols-[240px_1fr]">
        {{-- TOC --}}
        <aside class="lg:sticky lg:top-32 lg:self-start">
            <x-ui.card :padded="false">
                <div class="border-b border-border p-4"><p class="text-sm font-semibold">On this page</p></div>
                <nav class="space-y-0.5 p-2">
                    @foreach ($sections as $i => [$id,$title,$body])
                        <a href="#sec-{{ $id }}" class="block rounded-lg px-3 py-2 text-sm transition-colors" :class="active === '{{ $id }}' ? 'bg-primary/10 font-medium text-primary' : 'text-muted-foreground hover:bg-accent hover:text-foreground'">{{ $i + 1 }}. {{ $title }}</a>
                    @endforeach
                </nav>
            </x-ui.card>
        </aside>

        {{-- Content --}}
        <x-ui.card>
            <div class="mb-6 flex items-center gap-3 border-b border-border pb-5">
                <span class="grid size-11 place-items-center rounded-xl bg-primary/10 text-primary"><i data-lucide="scroll-text" class="size-5"></i></span>
                <div><p class="font-semibold">AdminKit Terms of Service</p><p class="text-sm text-muted-foreground">Last updated: July 20, 2026</p></div>
            </div>
            <div class="space-y-8">
                @foreach ($sections as $i => [$id,$title,$body])
                    <section id="sec-{{ $id }}" class="scroll-mt-32" x-intersect.margin.0px.0px.-72%.0px="active = '{{ $id }}'">
                        <h2 class="text-lg font-bold">{{ $i + 1 }}. {{ $title }}</h2>
                        <p class="mt-2 text-sm leading-relaxed text-muted-foreground">{{ $body }}</p>
                        <p class="mt-2 text-sm leading-relaxed text-muted-foreground">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip.</p>
                    </section>
                @endforeach
            </div>
            <div class="mt-8 rounded-xl bg-muted/40 p-4 text-sm text-muted-foreground">
                Questions about these terms? Contact us at <span class="font-medium text-foreground">legal@adminkit.test</span>.
            </div>
        </x-ui.card>
    </div>
</div>
