@props([
    'name'      => 'modal',
    'title'     => null,
    'maxWidth'  => 'max-w-lg',
    'position'  => 'center',
    'maxHeight' => 'max-h-[85vh]',
    'scrollable'=> true,
    'showClose' => true,
])

@php
$wrapperPositions = [
    'center'       => 'items-center justify-center p-4',
    'top'          => 'items-start justify-center p-4 pt-10 sm:pt-14',
    'top-start'    => 'items-start justify-start p-4 pt-10 sm:pt-14 sm:ps-6',
    'top-left'     => 'items-start justify-start p-4 pt-10 sm:pt-14 sm:ps-6',
    'top-end'      => 'items-start justify-end p-4 pt-10 sm:pt-14 sm:pe-6',
    'top-right'    => 'items-start justify-end p-4 pt-10 sm:pt-14 sm:pe-6',
    'bottom'       => 'items-end justify-center p-4 pb-10 sm:pb-14',
    'bottom-start' => 'items-end justify-start p-4 pb-10 sm:pb-14 sm:ps-6',
    'bottom-left'  => 'items-end justify-start p-4 pb-10 sm:pb-14 sm:ps-6',
    'bottom-end'   => 'items-end justify-end p-4 pb-10 sm:pb-14 sm:pe-6',
    'bottom-right' => 'items-end justify-end p-4 pb-10 sm:pb-14 sm:pe-6',
    'drawer-left'  => 'items-stretch justify-start p-0',
    'drawer-right' => 'items-stretch justify-end p-0',
];

$enterTransitions = [
    'center'       => 'opacity-0 translate-y-3 scale-95',
    'top'          => 'opacity-0 -translate-y-8 scale-95',
    'top-start'    => 'opacity-0 -translate-y-8 -translate-x-4 scale-95',
    'top-left'     => 'opacity-0 -translate-y-8 -translate-x-4 scale-95',
    'top-end'      => 'opacity-0 -translate-y-8 translate-x-4 scale-95',
    'top-right'    => 'opacity-0 -translate-y-8 translate-x-4 scale-95',
    'bottom'       => 'opacity-0 translate-y-8 scale-95',
    'bottom-start' => 'opacity-0 translate-y-8 -translate-x-4 scale-95',
    'bottom-left'  => 'opacity-0 translate-y-8 -translate-x-4 scale-95',
    'bottom-end'   => 'opacity-0 translate-y-8 translate-x-4 scale-95',
    'bottom-right' => 'opacity-0 translate-y-8 translate-x-4 scale-95',
    'drawer-left'  => 'opacity-0 -translate-x-full',
    'drawer-right' => 'opacity-0 translate-x-full',
];

$leaveTransitions = [
    'center'       => 'opacity-0 scale-95',
    'top'          => 'opacity-0 -translate-y-6 scale-95',
    'top-start'    => 'opacity-0 -translate-y-6 -translate-x-4 scale-95',
    'top-left'     => 'opacity-0 -translate-y-6 -translate-x-4 scale-95',
    'top-end'      => 'opacity-0 -translate-y-6 translate-x-4 scale-95',
    'top-right'    => 'opacity-0 -translate-y-6 translate-x-4 scale-95',
    'bottom'       => 'opacity-0 translate-y-6 scale-95',
    'bottom-start' => 'opacity-0 translate-y-6 -translate-x-4 scale-95',
    'bottom-left'  => 'opacity-0 translate-y-6 -translate-x-4 scale-95',
    'bottom-end'   => 'opacity-0 translate-y-6 translate-x-4 scale-95',
    'bottom-right' => 'opacity-0 translate-y-6 translate-x-4 scale-95',
    'drawer-left'  => 'opacity-0 -translate-x-full',
    'drawer-right' => 'opacity-0 translate-x-full',
];

$isDrawer = in_array($position, ['drawer-left', 'drawer-right']);
$wrapperClass = $wrapperPositions[$position] ?? $wrapperPositions['center'];
$enterClass = $enterTransitions[$position] ?? $enterTransitions['center'];
$leaveClass = $leaveTransitions[$position] ?? $leaveTransitions['center'];

$drawerClasses = [
    'drawer-left'  => 'modal-drawer-left-panel h-full h-screen rounded-none border-y-0 border-l-0 shadow-2xl',
    'drawer-right' => 'modal-drawer-right-panel h-full h-screen rounded-none border-y-0 border-r-0 shadow-2xl',
];
$drawerWrapperClasses = [
    'drawer-left'  => 'modal-drawer-portal modal-drawer-left-wrapper',
    'drawer-right' => 'modal-drawer-portal modal-drawer-right-wrapper',
];
$drawerExtra = $drawerClasses[$position] ?? 'h-full rounded-none border-y-0 shadow-2xl';
$extraWrapper = $drawerWrapperClasses[$position] ?? 'modal-drawer-portal';
@endphp

<div
    x-data="{ open: false }"
    x-on:open-modal.window="$event.detail === '{{ $name }}' && (open = true)"
    x-on:close-modal.window="$event.detail === '{{ $name }}' && (open = false)"
    x-on:keydown.escape.window="open = false; $dispatch('close-modal', '{{ $name }}')"
>
    <template x-teleport="body">
        <div x-show="open" x-cloak class="fixed inset-0 z-[100] flex {{ $wrapperClass }} {{ $extraWrapper }}">
            <div
                x-show="open"
                x-transition:enter="ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                x-transition:leave="ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                class="absolute inset-0 bg-black/60 backdrop-blur-md" @click="open = false; $dispatch('close-modal', '{{ $name }}')"
            ></div>

            <div
                x-show="open"
                x-trap.noscroll="open"
                x-transition:enter="ease-out duration-200" x-transition:enter-start="{{ $enterClass }}" x-transition:enter-end="opacity-100 translate-y-0 translate-x-0 scale-100"
                x-transition:leave="ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0 translate-x-0 scale-100" x-transition:leave-end="{{ $leaveClass }}"
                class="relative w-full {{ $isDrawer ? $drawerExtra : 'rounded-2xl shadow-2xl ' . $maxHeight }} {{ $maxWidth }} overflow-hidden border border-border bg-card text-card-foreground flex flex-col"
            >
                @if ($title || isset($header) || $showClose)
                    <div class="flex items-center justify-between gap-4 border-b border-border bg-card px-6 py-4 shrink-0 z-10">
                        <div>
                            @if ($title)<h3 class="text-lg font-semibold">{{ $title }}</h3>@endif
                            {{ $header ?? '' }}
                        </div>
                        @if ($showClose)
                            <button type="button" @click="open = false; $dispatch('close-modal', '{{ $name }}')" class="rounded-lg p-1.5 text-muted-foreground hover:bg-accent hover:text-foreground transition-colors cursor-pointer ms-auto">
                                <i data-lucide="x" class="size-5"></i>
                            </button>
                        @endif
                    </div>
                @endif

                <div class="px-6 py-5 flex-1 min-h-0 {{ $scrollable ? 'overflow-y-auto' : '' }}">{{ $slot }}</div>

                @isset($footer)
                    <div class="flex items-center justify-end gap-3 border-t border-border bg-muted/30 px-6 py-4 shrink-0 z-10">{{ $footer }}</div>
                @endisset
            </div>
        </div>
    </template>
</div>
