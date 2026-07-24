<div>
    <x-error-screen code="503" icon="plug-zap" tone="warning"
        title="Service unavailable"
        message="We're temporarily offline for maintenance. Everything should be back within a few minutes.">
        <div class="mx-auto max-w-sm">
            <div class="mb-1.5 flex items-center justify-between text-xs font-medium">
                <span class="text-muted-foreground">Estimated progress</span><span class="font-semibold">72%</span>
            </div>
            <div class="h-2.5 overflow-hidden rounded-full bg-muted">
                <div class="h-full w-[72%] rounded-full bg-gradient-to-r from-[hsl(var(--warning))] to-primary"></div>
            </div>
            <div class="mt-4 flex justify-center gap-2">
                <x-ui.button variant="outline" size="sm" icon="rotate-cw" onclick="window.location.reload()">Retry now</x-ui.button>
                <x-ui.button variant="outline" size="sm" icon="activity">Status page</x-ui.button>
            </div>
        </div>
    </x-error-screen>
</div>
