<div>
    <x-page-header title="Icons" subtitle="Lucide — 1,900+ crisp, consistent SVG icons." />

    @php
        $icons = ['house','layout-dashboard','users','settings','bell','search','mail','calendar','folder','file-text',
            'chart-column','shopping-cart','credit-card','heart','star','bookmark','trash-2','pencil','download','upload',
            'lock','shield','key-round','globe','map-pin','phone','camera','image','video','music',
            'gem','zap','flame','rocket','trophy','gift','tag','filter','sliders-horizontal','layout-grid',
            'circle-check-big','circle-alert','triangle-alert','info','plus','minus','x','check','arrow-right','arrow-left',
            'chevron-right','chevron-down','sun','moon','monitor','languages','log-out','user-plus','message-square','git-commit-horizontal'];
    @endphp

    <div class="grid grid-cols-3 gap-3 sm:grid-cols-4 md:grid-cols-6 lg:grid-cols-8 xl:grid-cols-10">
        @foreach ($icons as $ico)
            <button type="button" @click="navigator.clipboard && navigator.clipboard.writeText('{{ $ico }}'); window.toast('Copied: {{ $ico }}', {variant:'success'})"
                    class="group flex aspect-square flex-col items-center justify-center gap-2 rounded-xl border border-border bg-card p-3 text-muted-foreground transition-all hover:-translate-y-0.5 hover:border-primary/40 hover:text-primary hover:shadow-md">
                <i data-lucide="{{ $ico }}" class="size-6"></i>
                <span class="w-full truncate text-center text-[0.6rem] text-muted-foreground/70 group-hover:text-primary">{{ $ico }}</span>
            </button>
        @endforeach
    </div>
</div>
