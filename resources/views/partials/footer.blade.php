@php($cfg = config('adminkit'))
@php($ms = defined('LARAVEL_START') ? round((microtime(true) - LARAVEL_START) * 1000) : null)

<footer class="mt-auto border-t border-border bg-background/50 px-4 py-4 sm:px-6">
    <div class="flex flex-col items-center justify-between gap-2 text-sm text-muted-foreground sm:flex-row">
        <p>
            © {{ date('Y') }} <span class="font-semibold text-foreground">{{ $cfg['name'] }}</span> ·
            <span class="hidden sm:inline">Crafted with</span>
            <i data-lucide="heart" class="inline size-3.5 text-rose-500"></i>
            using Laravel + Livewire
        </p>
        <div class="flex flex-wrap items-center justify-center gap-x-4 gap-y-1 text-xs">
            <span class="inline-flex items-center gap-1"><i data-lucide="tag" class="size-3.5"></i>v{{ $cfg['version'] }}</span>
            <span class="inline-flex items-center gap-1"><i data-lucide="flame" class="size-3.5"></i>Laravel {{ app()->version() }}</span>
            <span class="inline-flex items-center gap-1"><i data-lucide="code" class="size-3.5"></i>PHP {{ PHP_VERSION }}</span>
            @if ($ms !== null)
                <span class="inline-flex items-center gap-1"><i data-lucide="timer" class="size-3.5"></i>{{ $ms }} ms</span>
            @endif
        </div>
    </div>
</footer>
