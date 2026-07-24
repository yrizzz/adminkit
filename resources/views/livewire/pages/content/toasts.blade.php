<div>
    <x-page-header :title="$pageTitle" subtitle="Ui Elements · transient notifications">
        <x-slot:actions><x-ui.button variant="outline" icon="arrow-left" class="[&>svg]:rtl-flip" :href="route('ui.elements')">All elements</x-ui.button></x-slot:actions>
    </x-page-header>

    <x-ui.alert variant="info" title="Try it" class="mb-4">Click any button below — real toasts fire through <code class="rounded bg-muted px-1">window.toast()</code>.</x-ui.alert>

    <x-demo-section title="Variants" desc="Four tones for four situations." />
    <x-ui.card>
        <div class="flex flex-wrap gap-2">
            <x-ui.button @click="window.toast('Your changes have been saved', { variant: 'success' })" variant="success" icon="check">Success</x-ui.button>
            <x-ui.button @click="window.toast('A new version is available', { variant: 'info' })" icon="info">Info</x-ui.button>
            <x-ui.button @click="window.toast('Your storage is almost full', { variant: 'warning' })" variant="outline" icon="triangle-alert">Warning</x-ui.button>
            <x-ui.button @click="window.toast('Something went wrong', { variant: 'destructive' })" variant="destructive" icon="circle-alert">Error</x-ui.button>
            <x-ui.button @click="window.toast('A plain, neutral message')" variant="secondary">Default</x-ui.button>
        </div>
    </x-ui.card>

    <x-demo-section title="With titles" desc="A heading plus a description." />
    <x-ui.card>
        <div class="flex flex-wrap gap-2">
            <x-ui.button variant="outline" @click="window.toast('Your invoice has been emailed to you.', { variant: 'success', title: 'Payment received' })">Titled success</x-ui.button>
            <x-ui.button variant="outline" @click="window.toast('We could not reach the server. Retrying…', { variant: 'destructive', title: 'Connection lost' })">Titled error</x-ui.button>
            <x-ui.button variant="outline" @click="window.toast('Maintenance is scheduled for Sunday 02:00.', { variant: 'info', title: 'Heads up' })">Titled info</x-ui.button>
        </div>
    </x-ui.card>

    <x-demo-section title="Real-world triggers" desc="How they feel inside a flow." />
    <div class="grid grid-cols-1 gap-4 lg:grid-cols-3">
        <x-ui.card title="Save a form">
            <div class="space-y-3">
                <x-ui.input label="Display name" placeholder="Yrizzz" />
                <x-ui.button class="w-full" icon="save" @click="window.toast('Profile updated', { variant: 'success' })">Save changes</x-ui.button>
            </div>
        </x-ui.card>

        <x-ui.card title="Copy to clipboard">
            <div class="flex items-center gap-2 rounded-lg border border-border bg-muted/40 p-2">
                <code class="flex-1 truncate ps-1 text-xs text-muted-foreground">https://app.adminkit.test/p/9f2a1c</code>
                <x-ui.button size="sm" icon="copy" @click="navigator.clipboard && navigator.clipboard.writeText('https://app.adminkit.test/p/9f2a1c'); window.toast('Link copied to clipboard', { variant: 'success' })">Copy</x-ui.button>
            </div>
        </x-ui.card>

        <x-ui.card title="Destructive action">
            <p class="text-sm text-muted-foreground">Deleting shows a warning toast.</p>
            <x-ui.button variant="destructive" class="mt-3 w-full" icon="trash-2" @click="window.toast('Project moved to trash', { variant: 'destructive', title: 'Deleted' })">Delete project</x-ui.button>
        </x-ui.card>
    </div>

    <x-demo-section title="Stacking" desc="Fire several — they queue up." />
    <x-ui.card>
        <x-ui.button icon="layers" @click="['First notification','Second notification','Third notification'].forEach((m, i) => setTimeout(() => window.toast(m, { variant: 'info' }), i * 350))">Fire three toasts</x-ui.button>
    </x-ui.card>
</div>
