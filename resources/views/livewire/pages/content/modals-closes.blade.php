<div>
    <x-page-header :title="$pageTitle" subtitle="Advanced Ui · dialogs, sizes, confirmations, sheets & close behaviors">
        <x-slot:actions>
            <x-ui.badge variant="success" dot>11 variants</x-ui.badge>
            <x-ui.button variant="outline" icon="arrow-left" class="[&>svg]:rtl-flip" :href="route('dashboard')">Dashboard</x-ui.button>
        </x-slot:actions>
    </x-page-header>

    <x-demo-section title="Sizes" desc="From compact confirmations to wide content dialogs — every modal is centered, focus-trapped and closes on backdrop or Esc." />
    <x-ui.card>
        <div class="flex flex-wrap gap-3">
            <x-ui.button variant="outline" icon="minimize-2" x-on:click="$dispatch('open-modal', 'm-sm')">Small</x-ui.button>
            <x-ui.button variant="outline" icon="square" x-on:click="$dispatch('open-modal', 'm-md')">Medium</x-ui.button>
            <x-ui.button variant="outline" icon="maximize-2" x-on:click="$dispatch('open-modal', 'm-lg')">Large</x-ui.button>
            <x-ui.button variant="outline" icon="scan" x-on:click="$dispatch('open-modal', 'm-xl')">Extra large</x-ui.button>
            <x-ui.button variant="outline" icon="fullscreen" x-on:click="$dispatch('open-modal', 'm-full')">Fullscreen</x-ui.button>
        </div>
    </x-ui.card>

    <x-demo-section title="Common patterns" desc="The dialogs you reach for every day." />
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
        @foreach ([
            ['m-form','user-plus','Form dialog','Invite a teammate','text-primary bg-primary/10'],
            ['m-confirm','triangle-alert','Danger confirm','Destructive action','text-destructive bg-destructive/10'],
            ['m-success','party-popper','Success','Celebration state','text-success bg-success/10'],
            ['m-scroll','scroll-text','Scrollable','Long content','text-info bg-info/10'],
            ['m-sheet','panel-bottom','Bottom sheet','Mobile-style','text-[hsl(var(--warning))] bg-warning/10'],
            ['m-feature','sparkles','Feature','Hero banner','text-primary bg-primary/10'],
            ['m-loading','loader','Loading','Async pending','text-info bg-info/10'],
            ['m-share','share-2','Share','Copy & socials','text-success bg-success/10'],
        ] as [$name, $ic, $t, $d, $tone])
            <button type="button" x-on:click="$dispatch('open-modal', '{{ $name }}')"
                    class="group flex items-start gap-3 rounded-xl border border-border bg-card p-4 text-start transition-all hover:-translate-y-0.5 hover:shadow-md">
                <span class="grid size-10 shrink-0 place-items-center rounded-xl {{ $tone }}"><i data-lucide="{{ $ic }}" class="size-5"></i></span>
                <span class="min-w-0"><span class="block text-sm font-semibold">{{ $t }}</span><span class="block text-xs text-muted-foreground">{{ $d }}</span></span>
            </button>
        @endforeach
    </div>

    {{-- ===== Size modals ===== --}}
    <x-ui.modal name="m-sm" title="Small modal" maxWidth="max-w-sm">
        <p class="text-sm text-muted-foreground">Great for quick confirmations and short messages.</p>
        <x-slot:footer><x-ui.button variant="outline" x-on:click="$dispatch('close-modal', 'm-sm')">Close</x-ui.button></x-slot:footer>
    </x-ui.modal>

    <x-ui.modal name="m-md" title="Medium modal" maxWidth="max-w-md">
        <p class="text-sm text-muted-foreground">A balanced width for most forms and content dialogs.</p>
        <x-slot:footer>
            <x-ui.button variant="outline" x-on:click="$dispatch('close-modal', 'm-md')">Cancel</x-ui.button>
            <x-ui.button x-on:click="$dispatch('close-modal', 'm-md')">Confirm</x-ui.button>
        </x-slot:footer>
    </x-ui.modal>

    <x-ui.modal name="m-lg" title="Large modal" maxWidth="max-w-2xl">
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <div class="rounded-xl bg-muted/40 p-4"><i data-lucide="layout-dashboard" class="size-5 text-primary"></i><p class="mt-2 text-sm font-semibold">Roomy layout</p><p class="text-xs text-muted-foreground">Two-column content fits comfortably.</p></div>
            <div class="rounded-xl bg-muted/40 p-4"><i data-lucide="table" class="size-5 text-primary"></i><p class="mt-2 text-sm font-semibold">Tables & lists</p><p class="text-xs text-muted-foreground">Enough room for data-dense UIs.</p></div>
        </div>
        <x-slot:footer><x-ui.button x-on:click="$dispatch('close-modal', 'm-lg')">Done</x-ui.button></x-slot:footer>
    </x-ui.modal>

    <x-ui.modal name="m-xl" title="Extra large modal" maxWidth="max-w-4xl">
        <div class="grid grid-cols-2 gap-4 sm:grid-cols-4">
            @foreach (['image','video','music','file'] as $ic)
                <div class="flex flex-col items-center gap-2 rounded-xl border border-border p-4 text-center">
                    <i data-lucide="{{ $ic }}" class="size-6 text-primary"></i><span class="text-xs font-medium capitalize">{{ $ic }}</span>
                </div>
            @endforeach
        </div>
        <x-slot:footer><x-ui.button x-on:click="$dispatch('close-modal', 'm-xl')">Close</x-ui.button></x-slot:footer>
    </x-ui.modal>

    {{-- Fullscreen (custom) --}}
    <div x-data="{ open: false }" x-on:open-modal.window="$event.detail === 'm-full' && (open = true)" x-on:keydown.escape.window="open = false">
        <template x-teleport="body">
            <div x-show="open" x-cloak class="fixed inset-0 z-[100] bg-card"
                 x-transition:enter="ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
                <div class="flex h-16 items-center justify-between border-b border-border px-6">
                    <div class="flex items-center gap-2 font-semibold"><i data-lucide="fullscreen" class="size-5 text-primary"></i>Fullscreen modal</div>
                    <button type="button" @click="open = false" class="rounded-lg p-2 text-muted-foreground hover:bg-accent hover:text-foreground"><i data-lucide="x" class="size-5"></i></button>
                </div>
                <div class="grid h-[calc(100vh-4rem)] place-items-center p-6">
                    <div class="max-w-md text-center">
                        <span class="mx-auto grid size-16 place-items-center rounded-2xl bg-gradient-to-br from-primary to-sidebar-primary text-white"><i data-lucide="maximize" class="size-8"></i></span>
                        <h3 class="mt-4 text-xl font-bold">Immersive full-screen surface</h3>
                        <p class="mt-2 text-sm text-muted-foreground">Ideal for editors, media viewers and step-by-step wizards that need the whole viewport.</p>
                        <x-ui.button class="mt-5" @click="open = false">Close editor</x-ui.button>
                    </div>
                </div>
            </div>
        </template>
    </div>

    {{-- ===== Patterns ===== --}}
    <x-ui.modal name="m-form" title="Invite teammate" maxWidth="max-w-md">
        <div class="space-y-4">
            <div><label class="mb-1.5 block text-sm font-medium">Email address</label><x-ui.input type="email" placeholder="name@company.com" icon="mail" /></div>
            <div><label class="mb-1.5 block text-sm font-medium">Role</label>
                <select class="flex h-10 w-full rounded-lg border border-input bg-background px-3 text-sm shadow-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring"><option>Viewer</option><option>Editor</option><option>Admin</option></select>
            </div>
        </div>
        <x-slot:footer>
            <x-ui.button variant="outline" x-on:click="$dispatch('close-modal', 'm-form')">Cancel</x-ui.button>
            <x-ui.button icon="send" x-on:click="$dispatch('close-modal', 'm-form'); window.toast('Invitation sent', { variant: 'success' })">Send invite</x-ui.button>
        </x-slot:footer>
    </x-ui.modal>

    <x-ui.modal name="m-confirm" maxWidth="max-w-md">
        <div class="flex flex-col items-center gap-3 text-center">
            <span class="grid size-14 place-items-center rounded-full bg-destructive/10 text-destructive"><i data-lucide="triangle-alert" class="size-7"></i></span>
            <h3 class="text-lg font-semibold">Delete project?</h3>
            <p class="text-sm text-muted-foreground">This action cannot be undone. All files and history will be permanently removed.</p>
        </div>
        <x-slot:footer>
            <x-ui.button variant="outline" class="flex-1" x-on:click="$dispatch('close-modal', 'm-confirm')">Cancel</x-ui.button>
            <x-ui.button variant="destructive" class="flex-1" icon="trash-2" x-on:click="$dispatch('close-modal', 'm-confirm'); window.toast('Project deleted', { variant: 'destructive' })">Delete</x-ui.button>
        </x-slot:footer>
    </x-ui.modal>

    <x-ui.modal name="m-success" maxWidth="max-w-sm">
        <div class="flex flex-col items-center gap-3 py-2 text-center">
            <span class="grid size-16 place-items-center rounded-full bg-success/10 text-success"><i data-lucide="check" class="size-8"></i></span>
            <h3 class="text-lg font-semibold">Payment successful</h3>
            <p class="text-sm text-muted-foreground">Your subscription is now active. A receipt has been emailed to you.</p>
        </div>
        <x-slot:footer><x-ui.button class="w-full" variant="success" x-on:click="$dispatch('close-modal', 'm-success')">Continue</x-ui.button></x-slot:footer>
    </x-ui.modal>

    <x-ui.modal name="m-scroll" title="Terms of Service">
        <div class="max-h-[50vh] space-y-3 overflow-y-auto pe-1 text-sm text-muted-foreground">
            @for ($i = 1; $i <= 14; $i++)
                <p><span class="font-semibold text-foreground">{{ $i }}.</span> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
            @endfor
        </div>
        <x-slot:footer>
            <x-ui.button variant="outline" x-on:click="$dispatch('close-modal', 'm-scroll')">Decline</x-ui.button>
            <x-ui.button x-on:click="$dispatch('close-modal', 'm-scroll'); window.toast('Terms accepted', { variant: 'success' })">Accept</x-ui.button>
        </x-slot:footer>
    </x-ui.modal>

    <x-ui.modal name="m-feature" maxWidth="max-w-md">
        <div class="-mx-6 -mt-5 mb-4 flex h-36 items-center justify-center bg-gradient-to-br from-fuchsia-500 via-primary to-sidebar-primary text-white">
            <i data-lucide="sparkles" class="size-12"></i>
        </div>
        <h3 class="text-lg font-semibold">Introducing Smart Insights</h3>
        <p class="mt-1.5 text-sm text-muted-foreground">Automatic anomaly detection and forecasting, built right into your dashboards. Available now on all paid plans.</p>
        <x-slot:footer>
            <x-ui.button variant="ghost" x-on:click="$dispatch('close-modal', 'm-feature')">Maybe later</x-ui.button>
            <x-ui.button icon="arrow-right" class="[&>svg]:rtl-flip" x-on:click="$dispatch('close-modal', 'm-feature')">Explore</x-ui.button>
        </x-slot:footer>
    </x-ui.modal>

    <x-ui.modal name="m-loading" maxWidth="max-w-sm">
        <div class="flex flex-col items-center gap-3 py-4 text-center">
            <i data-lucide="loader-circle" class="size-10 animate-spin text-primary"></i>
            <h3 class="text-base font-semibold">Processing payment…</h3>
            <p class="text-sm text-muted-foreground">Please don’t close this window.</p>
        </div>
    </x-ui.modal>

    <x-ui.modal name="m-share" title="Share this project" maxWidth="max-w-md">
        <div class="space-y-4">
            <div class="flex items-center gap-2 rounded-lg border border-border bg-muted/40 p-1.5">
                <span class="truncate ps-2 text-sm text-muted-foreground">https://app.adminkit.test/p/9f2a1c</span>
                <x-ui.button size="sm" icon="copy" class="ms-auto" x-on:click="window.toast('Link copied', { variant: 'success' })">Copy</x-ui.button>
            </div>
            <div class="flex items-center justify-center gap-3">
                @foreach ([['twitter','bg-sky-500'],['facebook','bg-blue-600'],['linkedin','bg-blue-700'],['send','bg-cyan-500']] as [$ic, $bg])
                    <button class="grid size-11 place-items-center rounded-full {{ $bg }} text-white transition hover:opacity-90"><i data-lucide="{{ $ic }}" class="size-5"></i></button>
                @endforeach
            </div>
        </div>
        <x-slot:footer><x-ui.button variant="outline" class="w-full" x-on:click="$dispatch('close-modal', 'm-share')">Done</x-ui.button></x-slot:footer>
    </x-ui.modal>

    {{-- Bottom sheet (custom) --}}
    <div x-data="{ open: false }" x-on:open-modal.window="$event.detail === 'm-sheet' && (open = true)" x-on:keydown.escape.window="open = false">
        <template x-teleport="body">
            <div x-show="open" x-cloak class="fixed inset-0 z-[100] flex items-end justify-center">
                <div x-show="open" x-transition:enter="ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                     x-transition:leave="ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                     class="absolute inset-0 bg-background/70 backdrop-blur-sm" @click="open = false"></div>
                <div x-show="open" x-trap.noscroll="open"
                     x-transition:enter="ease-out duration-300" x-transition:enter-start="translate-y-full" x-transition:enter-end="translate-y-0"
                     x-transition:leave="ease-in duration-200" x-transition:leave-start="translate-y-0" x-transition:leave-end="translate-y-full"
                     class="relative w-full max-w-lg rounded-t-2xl border border-border bg-card p-5 pb-8 shadow-2xl">
                    <div class="mx-auto mb-4 h-1.5 w-12 rounded-full bg-muted"></div>
                    <h3 class="text-lg font-semibold">Quick actions</h3>
                    <div class="mt-3 grid grid-cols-4 gap-3">
                        @foreach ([['pencil','Edit'],['copy','Duplicate'],['star','Favorite'],['trash-2','Delete']] as [$ic, $label])
                            <button @click="open = false" class="flex flex-col items-center gap-1.5 rounded-xl p-3 text-xs font-medium hover:bg-accent">
                                <span class="grid size-11 place-items-center rounded-full bg-muted"><i data-lucide="{{ $ic }}" class="size-5"></i></span>{{ $label }}
                            </button>
                        @endforeach
                    </div>
                </div>
            </div>
        </template>
    </div>
</div>
