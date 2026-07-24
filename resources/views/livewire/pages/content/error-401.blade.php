<div>
    <x-error-screen code="401" icon="key-round" tone="info"
        title="Unauthorized"
        message="You need to be signed in to view this page. Your session may have expired.">
        <a href="{{ route('page', ['path' => 'sign-in']) }}" wire:navigate
           class="inline-flex h-11 items-center justify-center gap-2 rounded-lg bg-primary px-6 text-sm font-semibold text-primary-foreground shadow-sm transition hover:bg-primary/90">
            <i data-lucide="log-in" class="size-4"></i>Sign in again
        </a>
    </x-error-screen>
</div>
