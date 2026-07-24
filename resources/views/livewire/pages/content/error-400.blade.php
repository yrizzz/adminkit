<div>
    <x-error-screen code="400" icon="file-warning" tone="warning"
        title="Bad request"
        message="The server couldn't understand that request — it may be malformed or missing required information.">
        <div class="mx-auto max-w-sm rounded-xl border border-border bg-muted/30 p-3 text-start">
            <p class="text-xs font-semibold uppercase tracking-wide text-muted-foreground">What you can try</p>
            <ul class="mt-2 space-y-1.5 text-sm text-muted-foreground">
                @foreach (['Check the URL for typos or stray characters', 'Clear any stale filters and try again', 'Re-submit the form with all required fields'] as $tip)
                    <li class="flex items-start gap-2"><i data-lucide="dot" class="mt-0.5 size-4 shrink-0"></i>{{ $tip }}</li>
                @endforeach
            </ul>
        </div>
    </x-error-screen>
</div>
