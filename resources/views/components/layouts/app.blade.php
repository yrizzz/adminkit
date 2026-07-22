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

    <div class="flex min-h-screen flex-col transition-[padding] duration-200 ease-in-out"
         :class="$store.ui.layout === 'vertical' ? ($store.ui.sidebarCollapsed ? 'lg:ps-[76px]' : 'lg:ps-64') : ''">

        @include('partials.navbar', ['breadcrumbs' => $breadcrumbs, 'title' => $title])
        @include('partials.topbar-horizontal')

        <main class="flex-1 p-4 sm:p-6">
            <div class="mx-auto w-full max-w-[1600px] animate-in-up">
                {{ $slot }}
            </div>
        </main>

        @include('partials.footer')
    </div>

    @include('partials.customizer')
    @include('partials.command')
    <x-ui.toaster />

    @stack('scripts')
</body>
</html>
