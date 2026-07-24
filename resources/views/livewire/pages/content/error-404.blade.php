<div>
    <x-error-screen code="404" icon="compass" tone="primary"
        title="Page not found"
        message="The page you're looking for doesn't exist, or it may have been moved or renamed.">
        <form @submit.prevent="window.toast('Searching…')" class="mx-auto flex max-w-sm gap-2">
            <div class="relative flex-1">
                <i data-lucide="search" class="pointer-events-none absolute inset-y-0 start-0 my-auto ms-3 size-4 text-muted-foreground"></i>
                <input type="text" placeholder="Search for a page…"
                       class="h-10 w-full rounded-lg border border-input bg-background ps-9 pe-3 text-sm shadow-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring">
            </div>
            <x-ui.button type="submit">Search</x-ui.button>
        </form>
    </x-error-screen>
</div>
