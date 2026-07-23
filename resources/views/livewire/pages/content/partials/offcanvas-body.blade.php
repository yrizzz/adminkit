<div class="flex h-full flex-col">
    <div class="flex items-center justify-between gap-4 pb-4">
        <h3 class="text-lg font-semibold">{{ $title }}</h3>
        <button type="button" @click="side = null" class="rounded-lg p-1.5 text-muted-foreground hover:bg-accent hover:text-foreground">
            <i data-lucide="x" class="size-5"></i>
        </button>
    </div>
    <div class="flex-1 space-y-2 overflow-y-auto">
        @foreach ([['layout-dashboard','Overview'],['users','Team members'],['folder','Projects'],['settings','Settings'],['life-buoy','Support']] as [$ic, $label])
            <a href="#" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium hover:bg-accent">
                <i data-lucide="{{ $ic }}" class="size-4 text-muted-foreground"></i>{{ $label }}
            </a>
        @endforeach
    </div>
    <div class="border-t border-border pt-4">
        <x-ui.button class="w-full" icon="check" @click="side = null">Done</x-ui.button>
    </div>
</div>
