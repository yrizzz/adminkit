@props([
    'title'       => 'Dashboard',
    'breadcrumbs' => [],
])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth" data-app-layout="true">
<head>
    @include('partials.head', ['title' => $title])
</head>
<body x-data class="min-h-screen bg-background font-sans text-foreground antialiased relative">
    @include('partials.sidebar')

    <div class="app-shift flex min-h-screen flex-col">
        <div class="app-curved-inner flex flex-col flex-1">
            @include('partials.navbar', ['breadcrumbs' => $breadcrumbs, 'title' => $title])
            @include('partials.topbar-horizontal')

            <main class="flex-1 pt-4 sm:pt-6 pb-0 flex flex-col justify-between gap-4">
                <div class="main-content-container w-full flex-grow px-4 sm:px-6">
                    {{ $slot }}
                </div>
                @include('partials.footer', ['class' => 'mt-4 rounded-b-[2.25rem]'])
            </main>
        </div>
    </div>

    @include('partials.customizer')
    @include('partials.command')
    <x-ui.toaster />

    @livewireScripts
    @stack('scripts')
</body>
</html>
