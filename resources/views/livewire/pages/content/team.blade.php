<div>
    <x-page-header :title="$pageTitle" subtitle="Pages · team directory, roles & invitations">
        <x-slot:actions>
            <x-ui.button variant="outline" icon="arrow-left" class="[&>svg]:rtl-flip" :href="route('dashboard')">Dashboard</x-ui.button>
            <x-ui.button icon="user-plus" x-on:click="$dispatch('open-modal', 'invite-member')">Invite member</x-ui.button>
        </x-slot:actions>
    </x-page-header>

    {{-- Stats --}}
    <div class="grid grid-cols-2 gap-4 lg:grid-cols-4">
        @foreach ([['users','Members','24','text-primary bg-primary/10'],['user-check','Active','21','text-success bg-success/10'],['clock','Pending','3','text-[hsl(var(--warning))] bg-warning/10'],['shield','Admins','4','text-info bg-info/10']] as [$ic,$label,$val,$tone])
            <x-ui.card>
                <div class="flex items-center justify-between"><span class="text-sm text-muted-foreground">{{ $label }}</span><span class="grid size-9 place-items-center rounded-xl {{ $tone }}"><i data-lucide="{{ $ic }}" class="size-4"></i></span></div>
                <p class="mt-2 text-2xl font-bold">{{ $val }}</p>
            </x-ui.card>
        @endforeach
    </div>

    <x-demo-section title="Members" desc="Your team at a glance." />
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
        @php
            $members = [
                ['Aisha Rahman','Team Lead','aisha@adminkit.test','online','Admin','success'],
                ['David Chen','Sr. Designer','david@adminkit.test','online','Editor','info'],
                ['Sofia Martinez','Marketing','sofia@adminkit.test','away','Editor','info'],
                ['Omar Haddad','Sales Exec','omar@adminkit.test','busy','Viewer','muted'],
                ['Priya Sharma','Analyst','priya@adminkit.test','online','Editor','info'],
                ['Kenji Tanaka','Backend Dev','kenji@adminkit.test','offline','Admin','success'],
            ];
        @endphp
        @foreach ($members as [$name,$role,$email,$status,$roleLabel,$roleTone])
            <x-ui.card hover class="group">
                <div class="flex items-start gap-3">
                    <x-ui.avatar :name="$name" size="lg" :status="$status" />
                    <div class="min-w-0 flex-1">
                        <div class="flex items-center justify-between gap-2">
                            <p class="truncate font-semibold">{{ $name }}</p>
                            <x-ui.dropdown align="end" width="w-40">
                                <x-slot:trigger><button class="rounded-lg p-1 text-muted-foreground opacity-0 transition hover:bg-accent group-hover:opacity-100"><i data-lucide="ellipsis-vertical" class="size-4"></i></button></x-slot:trigger>
                                <x-ui.dropdown-item icon="user">View profile</x-ui.dropdown-item>
                                <x-ui.dropdown-item icon="mail">Message</x-ui.dropdown-item>
                                <x-ui.dropdown-item icon="user-x" variant="destructive">Remove</x-ui.dropdown-item>
                            </x-ui.dropdown>
                        </div>
                        <p class="truncate text-sm text-muted-foreground">{{ $role }}</p>
                        <div class="mt-2 flex items-center gap-2">
                            <x-ui.badge :variant="$roleTone">{{ $roleLabel }}</x-ui.badge>
                            <span class="truncate text-xs text-muted-foreground">{{ $email }}</span>
                        </div>
                    </div>
                </div>
                <div class="mt-4 flex gap-2 border-t border-border pt-4">
                    <x-ui.button variant="outline" size="sm" icon="mail" class="flex-1">Message</x-ui.button>
                    <x-ui.button variant="soft" size="sm" icon="user" class="flex-1">Profile</x-ui.button>
                </div>
            </x-ui.card>
        @endforeach
    </div>

    {{-- Pending invites --}}
    <x-demo-section title="Pending invitations" desc="Awaiting acceptance." />
    <x-ui.card :padded="false">
        <div class="divide-y divide-border">
            @foreach ([['newhire@company.com','Editor','2 days ago'],['contractor@agency.io','Viewer','5 hours ago'],['lead@partner.co','Admin','1 hour ago']] as [$email,$role,$sent])
                <div class="flex items-center gap-3 p-4">
                    <span class="grid size-9 shrink-0 place-items-center rounded-full bg-muted text-muted-foreground"><i data-lucide="mail" class="size-4"></i></span>
                    <div class="min-w-0 flex-1"><p class="truncate text-sm font-medium">{{ $email }}</p><p class="text-xs text-muted-foreground">Invited as {{ $role }} · {{ $sent }}</p></div>
                    <x-ui.badge variant="warning">Pending</x-ui.badge>
                    <button class="rounded-lg p-1.5 text-muted-foreground hover:bg-accent hover:text-destructive"><i data-lucide="x" class="size-4"></i></button>
                </div>
            @endforeach
        </div>
    </x-ui.card>

    {{-- Invite modal --}}
    <x-ui.modal name="invite-member" title="Invite a team member" maxWidth="max-w-md">
        <div class="space-y-4">
            <div><label class="mb-1.5 block text-sm font-medium">Email address</label><x-ui.input type="email" placeholder="name@company.com" icon="mail" /></div>
            <div><label class="mb-1.5 block text-sm font-medium">Role</label>
                <select class="flex h-10 w-full rounded-lg border border-input bg-background px-3 text-sm shadow-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring"><option>Viewer</option><option>Editor</option><option>Admin</option></select>
            </div>
        </div>
        <x-slot:footer>
            <x-ui.button variant="outline" x-on:click="$dispatch('close-modal', 'invite-member')">Cancel</x-ui.button>
            <x-ui.button icon="send" x-on:click="$dispatch('close-modal', 'invite-member'); window.toast('Invitation sent', { variant: 'success' })">Send invite</x-ui.button>
        </x-slot:footer>
    </x-ui.modal>
</div>
