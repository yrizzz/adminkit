<div>
    <x-page-header :title="$pageTitle" subtitle="Tables · styled static table variants">
        <x-slot:actions><x-ui.button variant="outline" icon="arrow-left" class="[&>svg]:rtl-flip" :href="route('tables')">All tables</x-ui.button></x-slot:actions>
    </x-page-header>

    @php
        $rows = [
            ['Aisha Rahman','Admin','Active','success'],
            ['David Chen','Editor','Active','success'],
            ['Sofia Martinez','Viewer','Invited','warning'],
            ['Omar Haddad','Manager','Suspended','destructive'],
        ];
    @endphp

    <x-demo-section title="Default & striped" desc="Clean rows, or zebra striping for scannability." />
    <div class="grid grid-cols-1 gap-4 xl:grid-cols-2">
        <x-ui.card title="Default" :padded="false">
            <table class="w-full text-sm">
                <thead><tr class="border-b border-border text-xs uppercase tracking-wide text-muted-foreground"><th class="p-4 text-start font-medium">Name</th><th class="p-4 text-start font-medium">Role</th><th class="p-4 text-start font-medium">Status</th></tr></thead>
                <tbody>@foreach ($rows as [$n,$r,$s,$t])<tr class="border-b border-border last:border-0"><td class="p-4 font-medium">{{ $n }}</td><td class="p-4 text-muted-foreground">{{ $r }}</td><td class="p-4"><x-ui.badge :variant="$t">{{ $s }}</x-ui.badge></td></tr>@endforeach</tbody>
            </table>
        </x-ui.card>
        <x-ui.card title="Striped & hover" :padded="false">
            <table class="w-full text-sm">
                <thead><tr class="border-b border-border text-xs uppercase tracking-wide text-muted-foreground"><th class="p-4 text-start font-medium">Name</th><th class="p-4 text-start font-medium">Role</th><th class="p-4 text-start font-medium">Status</th></tr></thead>
                <tbody>@foreach ($rows as $i => [$n,$r,$s,$t])<tr class="{{ $i % 2 ? 'bg-muted/30' : '' }} transition-colors hover:bg-accent/50"><td class="p-4 font-medium">{{ $n }}</td><td class="p-4 text-muted-foreground">{{ $r }}</td><td class="p-4"><x-ui.badge :variant="$t">{{ $s }}</x-ui.badge></td></tr>@endforeach</tbody>
            </table>
        </x-ui.card>
    </div>

    <x-demo-section title="Rich cells" desc="Avatars, progress and row actions." />
    <x-ui.card :padded="false">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead><tr class="border-b border-border text-xs uppercase tracking-wide text-muted-foreground"><th class="p-4 text-start font-medium">Member</th><th class="p-4 text-start font-medium">Role</th><th class="p-4 text-start font-medium">Progress</th><th class="p-4 text-start font-medium">Status</th><th class="p-4 text-end font-medium">Actions</th></tr></thead>
                <tbody>
                    @foreach ([['Aisha Rahman','aisha@','Admin',88,'Active','success'],['David Chen','david@','Editor',64,'Active','success'],['Sofia Martinez','sofia@','Viewer',42,'Invited','warning'],['Omar Haddad','omar@','Manager',12,'Suspended','destructive']] as [$n,$e,$r,$p,$s,$t])
                        <tr class="border-b border-border last:border-0 hover:bg-accent/40">
                            <td class="p-4"><div class="flex items-center gap-3"><x-ui.avatar :name="$n" size="sm" /><div><p class="font-medium">{{ $n }}</p><p class="text-xs text-muted-foreground">{{ $e }}company.com</p></div></div></td>
                            <td class="p-4 text-muted-foreground">{{ $r }}</td>
                            <td class="p-4"><div class="flex items-center gap-2"><div class="h-1.5 w-24 overflow-hidden rounded-full bg-muted"><div class="h-full rounded-full bg-primary" style="width: {{ $p }}%"></div></div><span class="text-xs text-muted-foreground">{{ $p }}%</span></div></td>
                            <td class="p-4"><x-ui.badge :variant="$t">{{ $s }}</x-ui.badge></td>
                            <td class="p-4 text-end">
                                <x-ui.dropdown align="end" width="w-36">
                                    <x-slot:trigger><button class="rounded-lg p-1.5 text-muted-foreground hover:bg-accent"><i data-lucide="ellipsis-vertical" class="size-4"></i></button></x-slot:trigger>
                                    <x-ui.dropdown-item icon="eye">View</x-ui.dropdown-item><x-ui.dropdown-item icon="pencil">Edit</x-ui.dropdown-item><x-ui.dropdown-item icon="trash-2" variant="destructive">Delete</x-ui.dropdown-item>
                                </x-ui.dropdown>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </x-ui.card>

    <x-demo-section title="Compact & bordered" desc="Dense data with grid lines." />
    <x-ui.card :padded="false">
        <div class="overflow-x-auto">
            <table class="w-full border-collapse text-sm">
                <thead><tr class="bg-muted/50 text-xs uppercase tracking-wide text-muted-foreground">@foreach (['Invoice','Client','Date','Amount','Status'] as $h)<th class="border border-border px-3 py-2 text-start font-medium">{{ $h }}</th>@endforeach</tr></thead>
                <tbody>
                    @foreach ([['INV-0148','Northwind','Jul 12','$627','Paid','success'],['INV-0147','Orbit Labs','Jul 10','$1,240','Pending','warning'],['INV-0146','Lumen Co','Jul 08','$480','Overdue','destructive']] as [$id,$c,$d,$a,$s,$t])
                        <tr class="hover:bg-accent/30">
                            <td class="border border-border px-3 py-2 font-semibold">{{ $id }}</td><td class="border border-border px-3 py-2">{{ $c }}</td><td class="border border-border px-3 py-2 text-muted-foreground">{{ $d }}</td><td class="border border-border px-3 py-2">{{ $a }}</td><td class="border border-border px-3 py-2"><x-ui.badge :variant="$t">{{ $s }}</x-ui.badge></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </x-ui.card>
</div>
