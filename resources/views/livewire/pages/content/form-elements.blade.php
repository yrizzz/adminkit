<div>
    <x-page-header :title="$pageTitle" subtitle="Forms · every input control, ready to use">
        <x-slot:actions><x-ui.button variant="outline" icon="arrow-left" class="[&>svg]:rtl-flip" :href="route('forms')">All forms</x-ui.button></x-slot:actions>
    </x-page-header>

    <div class="grid grid-cols-1 gap-4 xl:grid-cols-2">
        <x-ui.card title="Text inputs">
            <div class="space-y-4">
                <x-ui.input label="Full name" icon="user" placeholder="Yrizzz" />
                <x-ui.input label="Email" type="email" icon="mail" placeholder="you@company.com" hint="We'll never share it." />
                <div>
                    <label class="mb-1.5 block text-sm font-medium">Password</label>
                    <div x-data="{ show: false }" class="relative">
                        <i data-lucide="lock" class="pointer-events-none absolute inset-y-0 start-0 my-auto ms-3 size-4 text-muted-foreground"></i>
                        <input :type="show ? 'text' : 'password'" value="secret123" class="h-10 w-full rounded-lg border border-input bg-background ps-9 pe-10 text-sm shadow-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring">
                        <button type="button" @click="show = ! show" class="absolute inset-y-0 end-0 grid w-10 place-items-center text-muted-foreground hover:text-foreground"><i data-lucide="eye" class="size-4" x-show="! show"></i><i data-lucide="eye-off" class="size-4" x-show="show" x-cloak></i></button>
                    </div>
                </div>
                <div>
                    <label class="mb-1.5 block text-sm font-medium">Amount</label>
                    <div class="flex">
                        <span class="grid place-items-center rounded-s-lg border border-e-0 border-input bg-muted px-3 text-sm text-muted-foreground">$</span>
                        <input value="1,250.00" class="h-10 w-full border border-input bg-background px-3 text-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring">
                        <span class="grid place-items-center rounded-e-lg border border-s-0 border-input bg-muted px-3 text-sm text-muted-foreground">USD</span>
                    </div>
                </div>
                <div>
                    <label class="mb-1.5 block text-sm font-medium">Message</label>
                    <textarea rows="3" placeholder="Write something…" class="w-full rounded-lg border border-input bg-background px-3 py-2 text-sm shadow-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring"></textarea>
                </div>
            </div>
        </x-ui.card>

        <x-ui.card title="Selects & pickers">
            <div class="space-y-4">
                <div><label class="mb-1.5 block text-sm font-medium">Country</label><select class="h-10 w-full rounded-lg border border-input bg-background px-3 text-sm shadow-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring"><option>Indonesia</option><option>Singapore</option><option>Japan</option></select></div>
                <div><label class="mb-1.5 block text-sm font-medium">Skills (multiple)</label><select multiple size="4" class="w-full rounded-lg border border-input bg-background px-3 py-2 text-sm shadow-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring"><option selected>Design</option><option selected>Frontend</option><option>Backend</option><option>DevOps</option></select></div>
                <div class="grid grid-cols-3 gap-3">
                    <div><label class="mb-1.5 block text-sm font-medium">Date</label><input type="date" class="h-10 w-full rounded-lg border border-input bg-background px-3 text-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring"></div>
                    <div><label class="mb-1.5 block text-sm font-medium">Time</label><input type="time" class="h-10 w-full rounded-lg border border-input bg-background px-3 text-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring"></div>
                    <div><label class="mb-1.5 block text-sm font-medium">Colour</label><input type="color" value="#4f7cff" class="h-10 w-full rounded-lg border border-input bg-background p-1"></div>
                </div>
            </div>
        </x-ui.card>

        <x-ui.card title="Checkboxes, radios & switches">
            <div class="grid grid-cols-1 gap-5 sm:grid-cols-3">
                <div><p class="mb-2 text-sm font-medium">Notify me</p><div class="space-y-2">@foreach (['Email'=>true,'SMS'=>false,'Push'=>true] as $l => $on)<label class="flex cursor-pointer items-center gap-2.5 text-sm"><input type="checkbox" @checked($on) class="size-4 rounded border-input text-primary focus:ring-primary">{{ $l }}</label>@endforeach</div></div>
                <div><p class="mb-2 text-sm font-medium">Plan</p><div class="space-y-2">@foreach (['Monthly'=>true,'Yearly'=>false] as $l => $on)<label class="flex cursor-pointer items-center gap-2 text-sm"><input type="radio" name="fe-plan" @checked($on) class="size-4 border-input text-primary focus:ring-primary">{{ $l }}</label>@endforeach</div></div>
                <div x-data="{ a: true, b: false }"><p class="mb-2 text-sm font-medium">Toggles</p><div class="space-y-3">@foreach (['a'=>'Dark','b'=>'Beta'] as $m => $l)<label class="flex cursor-pointer items-center gap-2.5 text-sm"><button type="button" @click="{{ $m }} = ! {{ $m }}" class="relative h-6 w-11 shrink-0 rounded-full transition-colors" :class="{{ $m }} ? 'bg-primary' : 'bg-muted'"><span class="absolute top-0.5 start-0.5 size-5 rounded-full bg-white shadow transition-transform" :class="{{ $m }} && 'translate-x-5 rtl:-translate-x-5'"></span></button>{{ $l }}</label>@endforeach</div></div>
            </div>
        </x-ui.card>

        <x-ui.card title="Range, rating & tags">
            <div class="space-y-5">
                <div x-data="{ v: 65 }"><div class="mb-1.5 flex justify-between text-sm"><span class="font-medium">Volume</span><span class="text-muted-foreground" x-text="v + '%'"></span></div><input type="range" x-model="v" class="w-full accent-primary"></div>
                <div x-data="{ r: 3, h: 0 }"><p class="mb-1.5 text-sm font-medium">Rating</p><div class="flex gap-1" @mouseleave="h = 0"><template x-for="n in 5" :key="n"><button type="button" @click="r = n" @mouseenter="h = n"><i data-lucide="star" class="size-6" :class="(h || r) >= n ? 'fill-amber-400 text-amber-400' : 'text-muted-foreground/40'"></i></button></template></div></div>
                <div x-data="{ tags: ['Laravel','Alpine'], draft: '', add() { const t = this.draft.trim(); if (t) { this.tags.push(t); this.draft = '' } } }">
                    <p class="mb-1.5 text-sm font-medium">Tags</p>
                    <div class="flex flex-wrap items-center gap-1.5 rounded-lg border border-input bg-background p-2">
                        <template x-for="(t, i) in tags" :key="t"><span class="inline-flex items-center gap-1 rounded-full bg-primary/10 px-2 py-0.5 text-xs font-medium text-primary"><span x-text="t"></span><button @click="tags.splice(i, 1)">&times;</button></span></template>
                        <input x-model="draft" @keydown.enter.prevent="add()" @keydown.backspace="! draft && tags.pop()" placeholder="Add tag…" class="min-w-24 flex-1 bg-transparent text-sm focus:outline-none">
                    </div>
                </div>
            </div>
        </x-ui.card>

        <x-ui.card title="File upload" class="xl:col-span-2">
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <label class="flex cursor-pointer flex-col items-center gap-1.5 rounded-xl border-2 border-dashed border-border py-8 text-muted-foreground transition-colors hover:border-primary hover:text-primary">
                    <i data-lucide="upload-cloud" class="size-8"></i><span class="text-sm font-medium">Drag &amp; drop or click to upload</span><span class="text-xs">PNG, JPG, PDF up to 10MB</span><input type="file" class="hidden">
                </label>
                <div class="space-y-2">
                    @foreach ([['image','photo.png','2.4 MB',100],['file-text','resume.pdf','640 KB',72]] as [$ic,$name,$size,$pct])
                        <div class="flex items-center gap-3 rounded-lg border border-border p-3">
                            <span class="grid size-9 shrink-0 place-items-center rounded-lg bg-primary/10 text-primary"><i data-lucide="{{ $ic }}" class="size-4"></i></span>
                            <div class="min-w-0 flex-1"><p class="truncate text-sm font-medium">{{ $name }}</p><div class="mt-1 h-1.5 overflow-hidden rounded-full bg-muted"><div class="h-full rounded-full bg-primary" style="width: {{ $pct }}%"></div></div></div>
                            <span class="shrink-0 text-xs text-muted-foreground">{{ $size }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </x-ui.card>
    </div>
</div>
