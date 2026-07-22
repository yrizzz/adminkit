<x-layouts.app title="UI Elements" :breadcrumbs="[['label' => 'Web Apps'], ['label' => 'UI Elements']]">
    <x-page-header title="UI Elements" subtitle="A shadcn-inspired component library — Blade + Alpine, zero React." />

    <div class="grid grid-cols-1 gap-4 xl:grid-cols-2">
        {{-- Buttons --}}
        <x-ui.card title="Buttons" subtitle="Variants, sizes & states">
            <div class="flex flex-wrap gap-2">
                <x-ui.button>Primary</x-ui.button>
                <x-ui.button variant="secondary">Secondary</x-ui.button>
                <x-ui.button variant="outline">Outline</x-ui.button>
                <x-ui.button variant="ghost">Ghost</x-ui.button>
                <x-ui.button variant="destructive">Destructive</x-ui.button>
                <x-ui.button variant="success">Success</x-ui.button>
                <x-ui.button variant="soft">Soft</x-ui.button>
                <x-ui.button variant="link">Link</x-ui.button>
            </div>
            <div class="mt-3 flex flex-wrap items-center gap-2">
                <x-ui.button size="sm" icon="plus">Small</x-ui.button>
                <x-ui.button icon="download">Default</x-ui.button>
                <x-ui.button size="lg" iconEnd="arrow-right" class="[&>svg]:rtl-flip">Large</x-ui.button>
                <x-ui.button size="icon" icon="heart" aria-label="Like" />
                <x-ui.button :loading="true">Loading</x-ui.button>
                <x-ui.button disabled>Disabled</x-ui.button>
            </div>
        </x-ui.card>

        {{-- Badges --}}
        <x-ui.card title="Badges" subtitle="Status & labels">
            <div class="flex flex-wrap gap-2">
                <x-ui.badge>Default</x-ui.badge>
                <x-ui.badge variant="solid">Solid</x-ui.badge>
                <x-ui.badge variant="secondary">Secondary</x-ui.badge>
                <x-ui.badge variant="success" dot>Success</x-ui.badge>
                <x-ui.badge variant="warning" dot>Warning</x-ui.badge>
                <x-ui.badge variant="destructive" dot>Error</x-ui.badge>
                <x-ui.badge variant="info">Info</x-ui.badge>
                <x-ui.badge variant="outline">Outline</x-ui.badge>
                <x-ui.badge variant="muted">Muted</x-ui.badge>
            </div>
        </x-ui.card>

        {{-- Alerts --}}
        <x-ui.card title="Alerts" subtitle="Contextual feedback">
            <div class="space-y-3">
                <x-ui.alert variant="info" title="Heads up!">This is an informational alert with a title.</x-ui.alert>
                <x-ui.alert variant="success" title="Success">Your changes have been saved successfully.</x-ui.alert>
                <x-ui.alert variant="warning" title="Warning">Your subscription is about to expire.</x-ui.alert>
                <x-ui.alert variant="destructive" title="Error">Something went wrong. Please try again.</x-ui.alert>
            </div>
        </x-ui.card>

        {{-- Form inputs --}}
        <x-ui.card title="Inputs" subtitle="Text fields, selects & more">
            <div class="space-y-4">
                <x-ui.input label="Email" type="email" icon="mail" placeholder="you@example.com" hint="We'll never share your email." />
                <x-ui.input label="With error" icon="lock" placeholder="Password" :error="'Password is too short.'" />
                <div class="space-y-1.5">
                    <label class="text-sm font-medium">Select</label>
                    <select class="h-10 w-full rounded-lg border border-input bg-background px-3 text-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring">
                        <option>Choose an option…</option><option>Design</option><option>Engineering</option><option>Product</option>
                    </select>
                </div>
                <div class="space-y-1.5">
                    <label class="text-sm font-medium">Textarea</label>
                    <textarea rows="3" class="w-full rounded-lg border border-input bg-background p-3 text-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring" placeholder="Type your message…"></textarea>
                </div>
            </div>
        </x-ui.card>

        {{-- Avatars --}}
        <x-ui.card title="Avatars" subtitle="Users, groups & status">
            <div class="flex flex-wrap items-end gap-4">
                <x-ui.avatar name="Aisha Rahman" size="xs" />
                <x-ui.avatar name="David Chen" size="sm" status="online" />
                <x-ui.avatar name="Sofia Martinez" size="md" status="busy" />
                <x-ui.avatar name="Omar Haddad" size="lg" status="away" />
                <x-ui.avatar name="Emily Watson" size="xl" />
                <div class="flex -space-x-3 rtl:space-x-reverse">
                    @foreach (['Aisha Rahman','David Chen','Sofia Martinez','Omar Haddad'] as $n)
                        <x-ui.avatar :name="$n" size="md" class="ring-2 ring-card" />
                    @endforeach
                    <span class="grid size-10 place-items-center rounded-full bg-muted text-xs font-semibold ring-2 ring-card">+9</span>
                </div>
            </div>
        </x-ui.card>

        {{-- Dropdown + Modal + Toast --}}
        <x-ui.card title="Overlays" subtitle="Dropdown, modal & toast">
            <div class="flex flex-wrap gap-2">
                <x-ui.dropdown align="start">
                    <x-slot:trigger>
                        <x-ui.button variant="outline" iconEnd="chevron-down">Dropdown</x-ui.button>
                    </x-slot:trigger>
                    <x-ui.dropdown-item icon="user">Profile</x-ui.dropdown-item>
                    <x-ui.dropdown-item icon="settings">Settings</x-ui.dropdown-item>
                    <x-ui.dropdown-item icon="credit-card">Billing</x-ui.dropdown-item>
                    <div class="my-1 border-t border-border"></div>
                    <x-ui.dropdown-item icon="log-out" variant="destructive">Sign out</x-ui.dropdown-item>
                </x-ui.dropdown>

                <x-ui.button variant="outline" icon="square" x-on:click="$dispatch('open-modal', 'demo-modal')">Open Modal</x-ui.button>
                <x-ui.button variant="outline" icon="bell" @click="window.toast('This is a toast notification', {variant:'success', title:'Nice!'})">Show Toast</x-ui.button>
            </div>

            {{-- Tabs --}}
            <div class="mt-6" x-data="{ tab: 'account' }">
                <div class="inline-flex rounded-lg bg-muted p-1 text-sm">
                    @foreach (['account' => 'Account', 'password' => 'Password', 'team' => 'Team'] as $k => $l)
                        <button @click="tab = '{{ $k }}'" :class="tab === '{{ $k }}' ? 'bg-card text-foreground shadow-sm' : 'text-muted-foreground'" class="rounded-md px-4 py-1.5 font-medium transition-all">{{ $l }}</button>
                    @endforeach
                </div>
                <div class="mt-3 rounded-lg border border-border p-4 text-sm text-muted-foreground">
                    <p x-show="tab === 'account'">Manage your account details and preferences here.</p>
                    <p x-show="tab === 'password'" x-cloak>Change your password and enable 2FA.</p>
                    <p x-show="tab === 'team'" x-cloak>Invite teammates and manage roles.</p>
                </div>
            </div>
        </x-ui.card>

        {{-- Progress --}}
        <x-ui.card title="Progress & Toggles" subtitle="Bars, spinners & switches">
            <div class="space-y-4">
                @foreach ([['Storage','72','bg-primary'],['CPU','45','bg-success'],['Memory','88','bg-[hsl(var(--warning))]']] as [$l,$v,$c])
                    <div>
                        <div class="mb-1.5 flex justify-between text-sm"><span class="font-medium">{{ $l }}</span><span class="text-muted-foreground">{{ $v }}%</span></div>
                        <div class="h-2 w-full overflow-hidden rounded-full bg-muted"><div class="h-full rounded-full {{ $c }}" style="width: {{ $v }}%"></div></div>
                    </div>
                @endforeach
                <div class="flex items-center gap-4 pt-1">
                    <span class="size-6 animate-spin rounded-full border-[3px] border-primary border-e-transparent"></span>
                    <div x-data="{ on: true }" class="flex items-center gap-3">
                        <button @click="on = !on" :class="on ? 'bg-primary' : 'bg-muted'" class="relative inline-flex h-6 w-11 items-center rounded-full transition-colors">
                            <span class="inline-block size-4 rounded-full bg-white shadow transition-transform" :class="on ? 'ltr:translate-x-6 rtl:-translate-x-6' : 'ltr:translate-x-1 rtl:-translate-x-1'"></span>
                        </button>
                        <span class="text-sm text-muted-foreground">Notifications</span>
                    </div>
                </div>
            </div>
        </x-ui.card>
    </div>

    <x-ui.modal name="demo-modal" title="Confirm action">
        <p class="text-sm text-muted-foreground">This is a fully accessible modal dialog with focus trapping, backdrop blur, and RTL-aware transitions. Press <kbd class="rounded border border-border bg-muted px-1 text-xs">Esc</kbd> to close.</p>
        <x-slot:footer>
            <x-ui.button variant="outline" x-on:click="$dispatch('close-modal', 'demo-modal')">Cancel</x-ui.button>
            <x-ui.button variant="destructive" icon="trash-2" x-on:click="$dispatch('close-modal', 'demo-modal'); window.toast('Item deleted', {variant:'destructive'})">Delete</x-ui.button>
        </x-slot:footer>
    </x-ui.modal>
</x-layouts.app>
