<div>
    <x-page-header :title="$pageTitle" subtitle="Forms · every input control, ready to drop in">
        <x-slot:actions>
            <x-ui.badge variant="success" dot>20+ controls</x-ui.badge>
            <x-ui.button variant="outline" icon="arrow-left" class="[&>svg]:rtl-flip" :href="route('forms')">All forms</x-ui.button>
        </x-slot:actions>
    </x-page-header>

    {{-- ═══ TEXT ═══ --}}
    <x-demo-section title="Text inputs" desc="Basic, with icons, addons, sizes and states." />
    <div class="grid grid-cols-1 gap-4 xl:grid-cols-2">
        <x-ui.card title="Standard">
            <div class="space-y-4">
                <x-ui.input label="Full name" placeholder="Yrizzz" />
                <x-ui.input label="Email" type="email" icon="mail" placeholder="you@company.com" hint="We'll never share it." />
                <div>
                    <label class="mb-1.5 block text-sm font-medium">Password</label>
                    <div x-data="{ show: false }" class="relative">
                        <i data-lucide="lock" class="pointer-events-none absolute inset-y-0 start-0 my-auto ms-3 size-4 text-muted-foreground"></i>
                        <input :type="show ? 'text' : 'password'" value="secret123" class="h-10 w-full rounded-lg border border-input bg-background ps-9 pe-10 text-sm shadow-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring">
                        <button type="button" @click="show = ! show" class="absolute inset-y-0 end-0 grid w-10 place-items-center text-muted-foreground hover:text-foreground"><i data-lucide="eye" class="size-4" x-show="! show"></i><i data-lucide="eye-off" class="size-4" x-show="show" x-cloak></i></button>
                    </div>
                </div>
                <div x-data="{ v: '' }">
                    <div class="mb-1.5 flex items-center justify-between text-sm"><label class="font-medium">Bio</label><span class="text-xs text-muted-foreground"><span x-text="v.length"></span>/160</span></div>
                    <textarea x-model="v" maxlength="160" rows="3" placeholder="Tell us about yourself…" class="w-full rounded-lg border border-input bg-background px-3 py-2 text-sm shadow-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring"></textarea>
                </div>
            </div>
        </x-ui.card>

        <x-ui.card title="Addons, sizes & states">
            <div class="space-y-4">
                <div>
                    <label class="mb-1.5 block text-sm font-medium">Website</label>
                    <div class="flex">
                        <span class="grid place-items-center rounded-s-lg border border-e-0 border-input bg-muted px-3 text-sm text-muted-foreground">https://</span>
                        <input value="adminkit.test" class="h-10 w-full border border-input bg-background px-3 text-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring">
                        <button class="rounded-e-lg border border-s-0 border-input bg-muted px-3 text-sm text-muted-foreground hover:bg-accent">Copy</button>
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
                <div class="space-y-2">
                    <input placeholder="Small (h-8)" class="h-8 w-full rounded-lg border border-input bg-background px-2.5 text-xs shadow-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring">
                    <input placeholder="Default (h-10)" class="h-10 w-full rounded-lg border border-input bg-background px-3 text-sm shadow-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring">
                    <input placeholder="Large (h-12)" class="h-12 w-full rounded-lg border border-input bg-background px-3.5 text-base shadow-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring">
                </div>
                <div class="grid grid-cols-3 gap-2">
                    <div><input value="Valid" class="h-9 w-full rounded-lg border border-success bg-background px-3 text-sm focus:outline-none"><p class="mt-1 text-xs text-success">Looks good</p></div>
                    <div><input value="Error" class="h-9 w-full rounded-lg border border-destructive bg-background px-3 text-sm focus:outline-none"><p class="mt-1 text-xs text-destructive">Required</p></div>
                    <div><input value="Disabled" disabled class="h-9 w-full cursor-not-allowed rounded-lg border border-input bg-muted px-3 text-sm text-muted-foreground"></div>
                </div>
            </div>
        </x-ui.card>
    </div>

    {{-- ═══ SELECTS & PICKERS ═══ --}}
    <x-demo-section title="Selects & pickers" desc="Native selects, a custom searchable combobox, plus date/time/colour." />
    <div class="grid grid-cols-1 gap-4 xl:grid-cols-2">
        <x-ui.card title="Selects">
            <div class="space-y-4">
                <div><label class="mb-1.5 block text-sm font-medium">Country</label><select class="h-10 w-full rounded-lg border border-input bg-background px-3 text-sm shadow-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring"><option>Indonesia</option><option>Singapore</option><option>Japan</option></select></div>
                {{-- custom searchable combobox --}}
                <div x-data="{
                        open:false, q:'', sel:'Laravel',
                        items:['Laravel','Livewire','Alpine.js','Tailwind CSS','Vue','React'],
                        get filtered(){ return this.items.filter(i => i.toLowerCase().includes(this.q.toLowerCase())) },
                     }" @click.outside="open=false" class="relative">
                    <label class="mb-1.5 block text-sm font-medium">Framework (searchable)</label>
                    <button @click="open=!open" class="flex h-10 w-full items-center justify-between rounded-lg border border-input bg-background px-3 text-sm shadow-sm hover:bg-accent/40"><span x-text="sel"></span><i data-lucide="chevron-down" class="size-4 text-muted-foreground"></i></button>
                    <div x-show="open" x-cloak x-transition class="absolute z-20 mt-1 w-full rounded-xl border border-border bg-popover p-1.5 shadow-xl">
                        <input x-model="q" placeholder="Search…" class="mb-1 h-9 w-full rounded-lg border border-input bg-background px-2.5 text-sm focus:outline-none">
                        <div class="max-h-44 overflow-y-auto">
                            <template x-for="i in filtered" :key="i"><button @click="sel=i; open=false; q=''" class="flex w-full items-center gap-2 rounded-lg px-2.5 py-2 text-sm hover:bg-accent" :class="sel===i && 'font-semibold text-primary'"><i data-lucide="check" class="size-4" x-show="sel===i"></i><span :class="sel!==i && 'ms-6'" x-text="i"></span></button></template>
                            <p x-show="!filtered.length" class="px-2.5 py-2 text-sm text-muted-foreground">No matches</p>
                        </div>
                    </div>
                </div>
                <div><label class="mb-1.5 block text-sm font-medium">Skills (multiple)</label><select multiple size="4" class="w-full rounded-lg border border-input bg-background px-3 py-2 text-sm shadow-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring"><option selected>Design</option><option selected>Frontend</option><option>Backend</option><option>DevOps</option></select></div>
            </div>
        </x-ui.card>

        <x-ui.card title="Date, time & colour">
            <div class="space-y-4">
                <div class="grid grid-cols-2 gap-3">
                    <div><label class="mb-1.5 block text-sm font-medium">Date</label><input type="date" class="h-10 w-full rounded-lg border border-input bg-background px-3 text-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring"></div>
                    <div><label class="mb-1.5 block text-sm font-medium">Time</label><input type="time" class="h-10 w-full rounded-lg border border-input bg-background px-3 text-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring"></div>
                    <div><label class="mb-1.5 block text-sm font-medium">Month</label><input type="month" class="h-10 w-full rounded-lg border border-input bg-background px-3 text-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring"></div>
                    <div><label class="mb-1.5 block text-sm font-medium">Datetime</label><input type="datetime-local" class="h-10 w-full rounded-lg border border-input bg-background px-2 text-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring"></div>
                </div>
                <div x-data="{ c: '#4f7cff' }">
                    <label class="mb-1.5 block text-sm font-medium">Accent colour</label>
                    <div class="flex items-center gap-3">
                        <input type="color" x-model="c" class="h-10 w-14 rounded-lg border border-input bg-background p-1">
                        <input x-model="c" class="h-10 flex-1 rounded-lg border border-input bg-background px-3 font-mono text-sm">
                        <span class="size-10 rounded-lg border border-border" :style="`background:${c}`"></span>
                    </div>
                </div>
                <div>
                    <label class="mb-1.5 block text-sm font-medium">Quick pick</label>
                    <div class="flex gap-2">@foreach (['bg-primary','bg-success','bg-[hsl(var(--warning))]','bg-destructive','bg-fuchsia-500','bg-sky-500'] as $c)<button class="size-8 rounded-full {{ $c }} ring-offset-2 ring-offset-card transition hover:ring-2 hover:ring-primary"></button>@endforeach</div>
                </div>
            </div>
        </x-ui.card>
    </div>

    {{-- ═══ CHOICE ═══ --}}
    <x-demo-section title="Choice controls" desc="Checkboxes, radios, switches and choice cards." />
    <div class="grid grid-cols-1 gap-4 xl:grid-cols-2">
        <x-ui.card title="Checkboxes, radios & switches">
            <div class="grid grid-cols-1 gap-5 sm:grid-cols-3">
                <div><p class="mb-2 text-sm font-medium">Notify me</p><div class="space-y-2">@foreach (['Email'=>true,'SMS'=>false,'Push'=>true] as $l => $on)<label class="flex cursor-pointer items-center gap-2.5 text-sm"><input type="checkbox" @checked($on) class="size-4 rounded border-input text-primary focus:ring-primary">{{ $l }}</label>@endforeach<label class="flex items-center gap-2.5 text-sm text-muted-foreground"><input type="checkbox" disabled class="size-4 rounded border-input">Disabled</label></div></div>
                <div><p class="mb-2 text-sm font-medium">Plan</p><div class="space-y-2">@foreach (['Monthly'=>true,'Yearly'=>false] as $l => $on)<label class="flex cursor-pointer items-center gap-2 text-sm"><input type="radio" name="fe-plan" @checked($on) class="size-4 border-input text-primary focus:ring-primary">{{ $l }}</label>@endforeach</div></div>
                <div x-data="{ a: true, b: false, c: true }"><p class="mb-2 text-sm font-medium">Toggles</p><div class="space-y-3">@foreach (['a'=>'Dark','b'=>'Beta','c'=>'Emails'] as $m => $l)<label class="flex cursor-pointer items-center gap-2.5 text-sm"><button type="button" @click="{{ $m }} = ! {{ $m }}" class="relative h-6 w-11 shrink-0 rounded-full transition-colors" :class="{{ $m }} ? 'bg-primary' : 'bg-muted'"><span class="absolute top-0.5 start-0.5 size-5 rounded-full bg-white shadow transition-transform" :class="{{ $m }} && 'translate-x-5 rtl:-translate-x-5'"></span></button>{{ $l }}</label>@endforeach</div></div>
            </div>
        </x-ui.card>

        <x-ui.card title="Choice cards & segmented">
            <div x-data="{ plan: 'pro', view: 'grid' }" class="space-y-5">
                <div>
                    <p class="mb-2 text-sm font-medium">Select a plan</p>
                    <div class="grid grid-cols-3 gap-2">
                        @foreach (['starter'=>['Starter','rocket'],'pro'=>['Pro','zap'],'team'=>['Team','users']] as $k => [$name,$ic])
                            <button @click="plan = '{{ $k }}'" class="flex flex-col items-center gap-1.5 rounded-xl border-2 p-3 transition-colors" :class="plan === '{{ $k }}' ? 'border-primary bg-primary/5 text-primary' : 'border-border text-muted-foreground hover:bg-accent'"><i data-lucide="{{ $ic }}" class="size-5"></i><span class="text-sm font-medium">{{ $name }}</span></button>
                        @endforeach
                    </div>
                </div>
                <div>
                    <p class="mb-2 text-sm font-medium">View</p>
                    <div class="inline-flex gap-1 rounded-lg bg-muted/60 p-1">
                        @foreach (['grid'=>'layout-grid','list'=>'list','board'=>'columns-3'] as $k => $ic)
                            <button @click="view = '{{ $k }}'" class="grid size-8 place-items-center rounded-md transition-colors" :class="view === '{{ $k }}' ? 'bg-card text-foreground shadow-sm' : 'text-muted-foreground'"><i data-lucide="{{ $ic }}" class="size-4"></i></button>
                        @endforeach
                    </div>
                </div>
            </div>
        </x-ui.card>
    </div>

    {{-- ═══ ADVANCED ═══ --}}
    <x-demo-section title="Advanced" desc="Range, dual range, rating, stepper, tags and OTP." />
    <div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
        <x-ui.card title="Range, rating & stepper">
            <div class="space-y-5">
                <div x-data="{ v: 65 }"><div class="mb-1.5 flex justify-between text-sm"><span class="font-medium">Volume</span><span class="text-muted-foreground" x-text="v + '%'"></span></div><input type="range" x-model="v" class="w-full accent-primary"></div>
                <div x-data="{ min: 30, max: 70 }">
                    <p class="mb-1.5 text-sm font-medium">Price range: <span class="text-muted-foreground">$<span x-text="min"></span> – $<span x-text="max"></span></span></p>
                    <div class="flex gap-2"><input type="range" x-model.number="min" max="100" class="w-full accent-primary"><input type="range" x-model.number="max" max="100" class="w-full accent-primary"></div>
                </div>
                <div x-data="{ r: 3, h: 0 }"><p class="mb-1.5 text-sm font-medium">Rating</p><div class="flex gap-1" @mouseleave="h = 0"><template x-for="n in 5" :key="n"><button type="button" @click="r = n" @mouseenter="h = n"><i data-lucide="star" class="size-6" :class="(h || r) >= n ? 'fill-amber-400 text-amber-400' : 'text-muted-foreground/40'"></i></button></template></div></div>
                <div x-data="{ n: 2 }">
                    <p class="mb-1.5 text-sm font-medium">Quantity</p>
                    <div class="inline-flex items-center rounded-lg border border-input">
                        <button @click="n = Math.max(0, n - 1)" class="grid size-9 place-items-center text-muted-foreground hover:text-foreground"><i data-lucide="minus" class="size-4"></i></button>
                        <span class="w-10 text-center text-sm font-semibold" x-text="n"></span>
                        <button @click="n++" class="grid size-9 place-items-center text-muted-foreground hover:text-foreground"><i data-lucide="plus" class="size-4"></i></button>
                    </div>
                </div>
            </div>
        </x-ui.card>

        <x-ui.card title="Tags & OTP">
            <div class="space-y-5">
                <div x-data="{ tags: ['Laravel','Alpine'], draft: '', add() { const t = this.draft.trim(); if (t && ! this.tags.includes(t)) { this.tags.push(t); this.draft = '' } } }">
                    <p class="mb-1.5 text-sm font-medium">Tags <span class="text-muted-foreground">(Enter to add)</span></p>
                    <div class="flex flex-wrap items-center gap-1.5 rounded-lg border border-input bg-background p-2 focus-within:ring-2 focus-within:ring-ring">
                        <template x-for="(t, i) in tags" :key="t"><span class="inline-flex items-center gap-1 rounded-full bg-primary/10 px-2 py-0.5 text-xs font-medium text-primary"><span x-text="t"></span><button @click="tags.splice(i, 1)">&times;</button></span></template>
                        <input x-model="draft" @keydown.enter.prevent="add()" @keydown.backspace="! draft && tags.pop()" placeholder="Add tag…" class="min-w-24 flex-1 bg-transparent text-sm focus:outline-none">
                    </div>
                </div>
                <div x-data="{ onInput(i, e) { const v = e.target.value.replace(/\D/g, '').slice(-1); e.target.value = v; if (v && i < 4) e.target.parentElement.children[i + 1].focus() } }">
                    <p class="mb-1.5 text-sm font-medium">Verification code</p>
                    <div class="flex gap-2">
                        @for ($i = 0; $i < 5; $i++)
                            <input inputmode="numeric" maxlength="1" @input="onInput({{ $i }}, $event)" class="size-11 rounded-lg border border-input bg-background text-center font-mono text-lg font-bold shadow-sm focus-visible:border-primary focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring">
                        @endfor
                    </div>
                </div>
            </div>
        </x-ui.card>
    </div>

    {{-- ═══ FILE UPLOAD ═══ --}}
    <x-demo-section title="File upload" desc="Drop zone, avatar picker and uploaded-file states." />
    <div class="grid grid-cols-1 gap-4 lg:grid-cols-3">
        <x-ui.card title="Drop zone" class="lg:col-span-2">
            <label class="flex cursor-pointer flex-col items-center gap-1.5 rounded-xl border-2 border-dashed border-border py-8 text-muted-foreground transition-colors hover:border-primary hover:text-primary">
                <i data-lucide="upload-cloud" class="size-8"></i><span class="text-sm font-medium">Drag &amp; drop or click to upload</span><span class="text-xs">PNG, JPG, PDF up to 10MB</span><input type="file" class="hidden">
            </label>
            <div class="mt-3 space-y-2">
                @foreach ([['image','photo.png','2.4 MB',100,'text-info bg-info/10'],['file-text','resume.pdf','640 KB',72,'text-destructive bg-destructive/10']] as [$ic,$name,$size,$pct,$tone])
                    <div class="flex items-center gap-3 rounded-lg border border-border p-3">
                        <span class="grid size-9 shrink-0 place-items-center rounded-lg {{ $tone }}"><i data-lucide="{{ $ic }}" class="size-4"></i></span>
                        <div class="min-w-0 flex-1"><p class="truncate text-sm font-medium">{{ $name }}</p><div class="mt-1 h-1.5 overflow-hidden rounded-full bg-muted"><div class="h-full rounded-full bg-primary" style="width: {{ $pct }}%"></div></div></div>
                        <span class="shrink-0 text-xs text-muted-foreground">{{ $size }}</span>
                        <button class="shrink-0 rounded-lg p-1.5 text-muted-foreground hover:bg-accent hover:text-destructive"><i data-lucide="x" class="size-4"></i></button>
                    </div>
                @endforeach
            </div>
        </x-ui.card>

        <x-ui.card title="Avatar">
            <div class="flex flex-col items-center gap-3 py-2">
                <label class="group relative cursor-pointer">
                    <x-ui.avatar name="Yrizzz Admin" size="xl" />
                    <span class="absolute inset-0 grid place-items-center rounded-full bg-black/50 opacity-0 transition group-hover:opacity-100"><i data-lucide="camera" class="size-5 text-white"></i></span>
                    <input type="file" accept="image/*" class="hidden">
                </label>
                <p class="text-sm font-medium">Yrizzz</p>
                <x-ui.button size="sm" variant="outline" icon="upload">Change photo</x-ui.button>
            </div>
        </x-ui.card>
    </div>
</div>
