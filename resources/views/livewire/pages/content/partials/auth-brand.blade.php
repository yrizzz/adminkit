{{-- Brand panel used by the auth preview pages (mirrors components/layouts/guest) --}}
@php($cfg = config('adminkit'))

<div class="relative hidden overflow-hidden bg-sidebar p-10 text-white lg:flex lg:flex-col lg:justify-between">
    <div class="pointer-events-none absolute inset-0 opacity-90"
         style="background:
            radial-gradient(60rem 60rem at 110% -10%, hsl(var(--primary)/0.45), transparent 60%),
            radial-gradient(40rem 40rem at -10% 110%, hsl(var(--sidebar-primary)/0.35), transparent 60%);"></div>
    <div class="pointer-events-none absolute inset-0"
         style="background-image: linear-gradient(hsl(0 0% 100% / .04) 1px, transparent 1px), linear-gradient(90deg, hsl(0 0% 100% / .04) 1px, transparent 1px); background-size: 42px 42px;"></div>

    <div class="relative z-10 flex items-center gap-3">
        <span class="grid size-11 place-items-center rounded-2xl bg-white/10 backdrop-blur-sm"><i data-lucide="gem" class="size-6"></i></span>
        <span class="text-xl font-bold tracking-tight">{{ $cfg['name'] }}</span>
    </div>

    <div class="relative z-10 max-w-sm">
        <h2 class="text-3xl font-bold leading-tight">{{ $brandTitle ?? 'Build beautiful admin apps, faster.' }}</h2>
        <p class="mt-3 text-white/70">{{ $brandText ?? 'A modern, themeable Laravel + Livewire admin panel — components, RTL/LTR, dark mode and layouts out of the box.' }}</p>
        <ul class="mt-7 space-y-3">
            @foreach ($brandPoints ?? ['40+ ready-made components', 'Light / dark / system themes', 'RTL & LTR ready'] as $f)
                <li class="flex items-center gap-3 text-sm text-white/85">
                    <span class="grid size-6 shrink-0 place-items-center rounded-full bg-white/10"><i data-lucide="check" class="size-3.5"></i></span>{{ $f }}
                </li>
            @endforeach
        </ul>
    </div>

    <div class="relative z-10 text-sm text-white/50">© {{ date('Y') }} {{ $cfg['name'] }} — v{{ $cfg['version'] }}</div>
</div>
