<div>
    <x-page-header title="Settings" subtitle="Manage your profile, appearance and preferences." />

    <div x-data="{ tab: 'profile' }" class="grid grid-cols-1 gap-6 lg:grid-cols-[220px_1fr]">
        {{-- Side nav --}}
        <nav class="flex gap-1 overflow-x-auto lg:flex-col">
            @foreach (['profile' => ['Profile','user'], 'appearance' => ['Appearance','palette'], 'notifications' => ['Notifications','bell'], 'security' => ['Security','shield']] as $k => [$l, $ico])
                <button @click="tab = '{{ $k }}'" :class="tab === '{{ $k }}' ? 'bg-accent text-foreground' : 'text-muted-foreground hover:bg-accent/50'"
                        class="flex items-center gap-2.5 whitespace-nowrap rounded-lg px-3 py-2 text-sm font-medium transition-colors">
                    <i data-lucide="{{ $ico }}" class="size-4"></i>{{ $l }}
                </button>
            @endforeach
        </nav>

        <div>
            {{-- Profile --}}
            <div x-show="tab === 'profile'">
                <x-ui.card title="Profile" subtitle="Update your personal information">
                    <div class="mb-6 flex items-center gap-4">
                        <x-ui.avatar :name="auth()->user()?->name ?? 'Aisha Rahman'" size="xl" />
                        <div>
                            <x-ui.button variant="outline" size="sm" icon="upload">Change photo</x-ui.button>
                            <p class="mt-1.5 text-xs text-muted-foreground">JPG, PNG or GIF. Max 2MB.</p>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <x-ui.input label="Full name" :value="auth()->user()?->name ?? 'Aisha Rahman'" icon="user" />
                        <x-ui.input label="Email" type="email" :value="auth()->user()?->email ?? 'admin@adminkit.test'" icon="mail" />
                        <x-ui.input label="Phone" value="+62 812 3456 7890" icon="phone" />
                        <x-ui.input label="Location" value="Jakarta, Indonesia" icon="map-pin" />
                    </div>
                    <x-slot:footer>
                        <div class="flex justify-end gap-2">
                            <x-ui.button variant="outline">Cancel</x-ui.button>
                            <x-ui.button icon="check" @click="window.toast('Profile updated', {variant:'success'})">Save changes</x-ui.button>
                        </div>
                    </x-slot:footer>
                </x-ui.card>
            </div>

            {{-- Appearance --}}
            <div x-show="tab === 'appearance'" x-cloak>
                <x-ui.card title="Appearance" subtitle="Customize how the panel looks">
                    <div class="space-y-6">
                        <div>
                            <p class="mb-2 text-sm font-medium">Theme</p>
                            <div class="grid grid-cols-3 gap-3">
                                @foreach (['light' => 'sun', 'dark' => 'moon', 'system' => 'monitor'] as $m => $i)
                                    <button @click="$store.ui.setTheme('{{ $m }}')" :class="$store.ui.theme === '{{ $m }}' ? 'border-primary ring-2 ring-primary/30' : 'border-border'" class="flex flex-col items-center gap-2 rounded-xl border p-4 text-sm font-medium capitalize">
                                        <i data-lucide="{{ $i }}" class="size-5"></i>{{ $m }}
                                    </button>
                                @endforeach
                            </div>
                        </div>
                        <div>
                            <p class="mb-2 text-sm font-medium">Accent color</p>
                            <div class="flex flex-wrap gap-2.5">
                                @foreach (['blue' => '#2563eb','violet' => '#7c3aed','green' => '#16a34a','rose' => '#e11d48','orange' => '#f97316','amber' => '#f59e0b','teal' => '#14b8a6'] as $n => $hex)
                                    <button @click="$store.ui.setAccent('{{ $n }}')" :class="$store.ui.accent === '{{ $n }}' ? 'ring-2 ring-primary ring-offset-2 ring-offset-card' : ''" class="grid size-9 place-items-center rounded-full" style="background: {{ $hex }}">
                                        <i data-lucide="check" class="size-4 text-white" x-show="$store.ui.accent === '{{ $n }}'"></i>
                                    </button>
                                @endforeach
                            </div>
                        </div>
                        <div class="flex items-center justify-between">
                            <div><p class="text-sm font-medium">Open customizer</p><p class="text-xs text-muted-foreground">Fine-tune layout, radius & direction.</p></div>
                            <x-ui.button variant="outline" icon="settings-2" @click="$store.ui.customizerOpen = true">Customize</x-ui.button>
                        </div>
                    </div>
                </x-ui.card>
            </div>

            {{-- Notifications --}}
            <div x-show="tab === 'notifications'" x-cloak>
                <x-ui.card title="Notifications" subtitle="Choose what you want to hear about">
                    <div class="space-y-1">
                        @foreach (['Email notifications' => true, 'Push notifications' => true, 'SMS alerts' => false, 'Weekly digest' => true, 'Product updates' => false] as $label => $on)
                            <label class="flex cursor-pointer items-center justify-between rounded-lg px-2 py-3 hover:bg-accent/40" x-data="{ on: @js($on) }">
                                <span class="text-sm font-medium">{{ $label }}</span>
                                <button type="button" @click="on = !on" :class="on ? 'bg-primary' : 'bg-muted'" class="relative inline-flex h-6 w-11 items-center rounded-full transition-colors">
                                    <span class="inline-block size-4 rounded-full bg-white shadow transition-transform" :class="on ? 'ltr:translate-x-6 rtl:-translate-x-6' : 'ltr:translate-x-1 rtl:-translate-x-1'"></span>
                                </button>
                            </label>
                        @endforeach
                    </div>
                </x-ui.card>
            </div>

            {{-- Security --}}
            <div x-show="tab === 'security'" x-cloak>
                <x-ui.card title="Security" subtitle="Keep your account safe">
                    <div class="space-y-4">
                        <x-ui.input label="Current password" type="password" icon="lock" placeholder="••••••••" />
                        <x-ui.input label="New password" type="password" icon="lock" placeholder="••••••••" />
                        <x-ui.alert variant="info">Enable two-factor authentication for an extra layer of security.</x-ui.alert>
                        <div class="flex items-center justify-between rounded-xl border border-border p-4">
                            <div class="flex items-center gap-3"><i data-lucide="smartphone" class="size-5 text-primary"></i><div><p class="text-sm font-medium">Two-factor authentication</p><p class="text-xs text-muted-foreground">Currently disabled</p></div></div>
                            <x-ui.button variant="outline" size="sm">Enable</x-ui.button>
                        </div>
                    </div>
                    <x-slot:footer>
                        <div class="flex justify-end"><x-ui.button icon="check" @click="window.toast('Password updated', {variant:'success'})">Update password</x-ui.button></div>
                    </x-slot:footer>
                </x-ui.card>
            </div>
        </div>
    </div>
</div>
