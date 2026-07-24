<div>
    <x-error-screen code="500" icon="server-crash" tone="destructive"
        title="Internal server error"
        message="Something went wrong on our end. The team has been notified and is looking into it.">
        <div class="mx-auto flex max-w-sm items-center gap-3 rounded-xl border border-border bg-muted/30 p-3 text-start"
             x-data="{ id: 'ERR-' + Math.random().toString(36).slice(2, 8).toUpperCase() }">
            <span class="grid size-9 shrink-0 place-items-center rounded-lg bg-destructive/10 text-destructive"><i data-lucide="bug" class="size-4"></i></span>
            <div class="min-w-0 flex-1">
                <p class="text-xs text-muted-foreground">Reference ID</p>
                <p class="truncate font-mono text-sm font-semibold" x-text="id"></p>
            </div>
            <button type="button" @click="navigator.clipboard && navigator.clipboard.writeText(id); window.toast('Reference copied')"
                    class="shrink-0 rounded-lg p-2 text-muted-foreground hover:bg-accent hover:text-foreground"><i data-lucide="copy" class="size-4"></i></button>
        </div>
    </x-error-screen>
</div>
