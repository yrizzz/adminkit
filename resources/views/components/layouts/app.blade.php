@props([
    'title'       => 'Dashboard',
    'breadcrumbs' => [],
])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    @include('partials.head', ['title' => $title])
</head>
<body x-data class="min-h-screen bg-background font-sans text-foreground antialiased">
    @include('partials.sidebar')

    <div class="app-shift flex min-h-screen flex-col">

        @include('partials.navbar', ['breadcrumbs' => $breadcrumbs, 'title' => $title])
        @include('partials.topbar-horizontal')

        <main class="flex-1 p-4 sm:p-6">
            <div class="mx-auto w-full max-w-[1600px]">
                {{ $slot }}
            </div>
        </main>

        @include('partials.footer')
    </div>

    @include('partials.customizer')
    @include('partials.command')
    <x-ui.toaster />

    @livewireScripts
    @stack('scripts')
</body>
</html>
