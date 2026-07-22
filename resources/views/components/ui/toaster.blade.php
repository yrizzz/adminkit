{{-- Global toast host. Trigger with window.toast('msg', {variant, title}) --}}
<div
    x-data="{
        toasts: [],
        add(detail) {
            const id = Date.now() + Math.random();
            this.toasts.push({ id, ...detail });
            setTimeout(() => this.remove(id), 4200);
        },
        remove(id) { this.toasts = this.toasts.filter(t => t.id !== id); },
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
        }
    }"
    @toast.window="add($event.detail); $nextTick(() => window.renderIcons && window.renderIcons())"
    class="pointer-events-none fixed bottom-4 end-4 z-[200] flex w-[calc(100%-2rem)] max-w-sm flex-col gap-2.5"
>
    <template x-for="t in toasts" :key="t.id">
        <div
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 translate-y-2"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0 translate-y-1"
            class="pointer-events-auto flex items-start gap-3 rounded-xl border bg-card p-4 text-card-foreground shadow-lg"
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
