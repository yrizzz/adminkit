@php($cfg = config('adminkit'))
@php($ms = defined('LARAVEL_START') ? round((microtime(true) - LARAVEL_START) * 1000) : null)

<footer class="{{ $class ?? '' }} mt-auto border-t border-border/60 bg-card/60 backdrop-blur-md py-2.5 sm:py-3">
    <div class="main-content-container flex flex-col items-center justify-between gap-3 px-4 sm:px-6 sm:flex-row">
        <p class="text-xs text-muted-foreground sm:text-sm">
            © {{ date('Y') }} <span class="font-semibold text-foreground">{{ $cfg['name'] }}</span> ·
            <span class="hidden sm:inline">Crafted with</span>
            <i data-lucide="heart" class="inline size-3.5 text-rose-500 fill-rose-500/20"></i>
            using Laravel + Livewire
        </p>
        <div class="flex flex-wrap items-center justify-center gap-1.5 text-[11px] font-medium text-muted-foreground">
            <span class="inline-flex items-center gap-1 rounded-md border border-border/50 bg-muted/40 px-2 py-0.5 font-mono dark:bg-slate-800/50">
                <i data-lucide="tag" class="size-3 text-muted-foreground"></i>v{{ $cfg['version'] }}
            </span>
            <span class="inline-flex items-center gap-1 rounded-md border border-border/50 bg-muted/40 px-2 py-0.5 font-mono dark:bg-slate-800/50">
                <i data-lucide="flame" class="size-3 text-amber-500"></i>Laravel {{ app()->version() }}
            </span>
            <span class="inline-flex items-center gap-1 rounded-md border border-border/50 bg-muted/40 px-2 py-0.5 font-mono dark:bg-slate-800/50">
                <i data-lucide="code-2" class="size-3 text-indigo-400"></i>PHP {{ PHP_VERSION }}
            </span>
            @if ($ms !== null)
                <span class="inline-flex items-center gap-1 rounded-md border border-emerald-500/20 bg-emerald-500/10 px-2 py-0.5 font-mono text-emerald-600 dark:text-emerald-400">
                    <span class="size-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                    {{ $ms }} ms
                </span>
            @endif
        </div>
    </div>
</footer>

