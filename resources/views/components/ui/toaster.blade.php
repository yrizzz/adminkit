{{-- Global toast host — window.toast('msg', { variant, title, position, duration }) --}}
<div
    x-data="{
        toasts: [],
        add(detail) {
            const id = Date.now() + Math.random();
            const pos = detail.position || 'bottom-end';
            this.toasts.push({ id, position: pos, ...detail });
            const d = detail.duration ?? 4200;
            if (d > 0) setTimeout(() => this.remove(id), d);
        },
        remove(id) { this.toasts = this.toasts.filter(t => t.id !== id); },
        at(pos) { return this.toasts.filter(t => t.position === pos); },
        style(v) {
            return {
                success: 'border-success/30 text-success',
                warning: 'border-warning/40 text-[hsl(var(--warning))]',
                destructive: 'border-destructive/30 text-destructive',
                info: 'border-info/30 text-info',
                default: 'border-border text-foreground',
            }[v] || 'border-border text-foreground';
        },
        icon(v) {
            return { success:'circle-check-big', warning:'triangle-alert', destructive:'circle-alert', info:'info', default:'bell' }[v] || 'bell';
        },
    }"
    @toast.window="add($event.detail); $nextTick(() => window.renderIcons && window.renderIcons())"
>
    @php
        // Each region: fixed anchor + the axis toasts should fly in from.
        $regions = [
            'top-start'     => ['top-4 start-4 items-start',                  '-translate-y-2'],
            'top-center'    => ['top-4 start-1/2 -translate-x-1/2 items-center rtl:translate-x-1/2', '-translate-y-2'],
            'top-end'       => ['top-4 end-4 items-end',                      '-translate-y-2'],
            'bottom-start'  => ['bottom-4 start-4 items-start',               'translate-y-2'],
            'bottom-center' => ['bottom-4 start-1/2 -translate-x-1/2 items-center rtl:translate-x-1/2', 'translate-y-2'],
            'bottom-end'    => ['bottom-4 end-4 items-end',                   'translate-y-2'],
        ];
    @endphp

    @foreach ($regions as $pos => [$anchor, $enterFrom])
        <div class="pointer-events-none fixed {{ $anchor }} z-[200] flex w-[calc(100%-2rem)] max-w-sm flex-col gap-2.5 {{ str_starts_with($pos, 'bottom') ? 'flex-col-reverse' : '' }}">
            <template x-for="t in at('{{ $pos }}')" :key="t.id">
                <div
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 {{ $enterFrom }}"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0 {{ $enterFrom }}"
                    class="pointer-events-auto flex w-full items-start gap-3 rounded-xl border bg-card p-4 text-card-foreground shadow-lg"
                    :class="style(t.variant)"
                >
                    <i :data-lucide="icon(t.variant)" class="mt-0.5 size-5 shrink-0"></i>
                    <div class="min-w-0 flex-1">
                        <p x-show="t.title" class="font-semibold" x-text="t.title"></p>
                        <p class="text-sm text-muted-foreground" x-text="t.message"></p>
                    </div>
                    <button type="button" @click="remove(t.id)" class="text-muted-foreground hover:text-foreground">
                        <i data-lucide="x" class="size-4"></i>
                    </button>
                </div>
            </template>
        </div>
    @endforeach
</div>
