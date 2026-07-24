<div>
    <x-error-screen code="403" icon="shield-x" tone="destructive"
        title="Access forbidden"
        message="You're signed in, but this area is restricted. Ask an administrator to grant you access.">
        <div class="mx-auto flex max-w-sm items-center gap-3 rounded-xl border border-border bg-muted/30 p-3 text-start">
            <img src="https://api.dicebear.com/9.x/initials/svg?seed=Yrizzz&backgroundType=gradientLinear" alt="" class="size-10 shrink-0 rounded-full" />
            <div class="min-w-0 flex-1">
                <p class="truncate text-sm font-semibold">Yrizzz</p>
                <p class="text-xs text-muted-foreground">Role: <span class="font-medium text-foreground">Viewer</span> — needs <span class="font-medium text-foreground">Admin</span></p>
            </div>
            <x-ui.badge variant="destructive">No access</x-ui.badge>
        </div>
    </x-error-screen>
</div>
