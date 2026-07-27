<div x-data="kanbanBoard()" x-init="init()" class="space-y-6">
    {{-- Page & Board Header --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div class="flex items-center gap-3">
            <div class="grid size-10 place-items-center rounded-xl bg-primary/10 text-primary">
                <i data-lucide="trello" class="size-6"></i>
            </div>
            <div>
                <div class="flex items-center gap-2">
                    <h1 class="text-xl font-bold text-foreground">Sprint 24 — AdminKit Development</h1>
                    <button class="text-muted-foreground hover:text-amber-500 transition-colors">
                        <i data-lucide="star" class="size-4 fill-amber-400 text-amber-400"></i>
                    </button>
                </div>
                <p class="text-xs text-muted-foreground">Trello-style Kanban board for agile project management & task tracking</p>
            </div>
        </div>

        <div class="flex flex-wrap items-center gap-2">
            {{-- Member Avatars --}}
            <div class="flex -space-x-2 overflow-hidden me-2">
                <img class="inline-block size-8 rounded-full ring-2 ring-background" src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=100&auto=format&fit=crop&q=80" alt="Sarah">
                <img class="inline-block size-8 rounded-full ring-2 ring-background" src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=100&auto=format&fit=crop&q=80" alt="Alex">
                <img class="inline-block size-8 rounded-full ring-2 ring-background" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=100&auto=format&fit=crop&q=80" alt="Elena">
                <img class="inline-block size-8 rounded-full ring-2 ring-background" src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=100&auto=format&fit=crop&q=80" alt="David">
                <span class="flex size-8 items-center justify-center rounded-full border border-border bg-muted text-xs font-medium text-muted-foreground ring-2 ring-background">+3</span>
            </div>

            <x-ui.button variant="outline" size="sm" icon="user-plus" @click="window.toast('Invite member modal', { variant: 'info' })">Invite</x-ui.button>
            <x-ui.button variant="outline" size="sm" icon="filter">Filter</x-ui.button>
            <x-ui.button size="sm" icon="plus" @click="addNewColumn()">Add Column</x-ui.button>
        </div>
    </div>

    {{-- Filter Search Bar & Stats Bar --}}
    <div class="flex flex-col gap-3 rounded-xl border border-border bg-card p-3 sm:flex-row sm:items-center sm:justify-between">
        <div class="relative max-w-xs flex-1">
            <i data-lucide="search" class="absolute start-3 top-1/2 size-4 -translate-y-1/2 text-muted-foreground"></i>
            <input type="text" x-model="searchQuery" placeholder="Filter tasks by name or tag..." class="flex h-9 w-full rounded-lg border border-input bg-background ps-9 pe-3 text-xs shadow-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring">
        </div>
        <div class="flex items-center gap-4 text-xs text-muted-foreground">
            <span>Total Tasks: <strong class="text-foreground" x-text="totalTasksCount()"></strong></span>
            <span>Completed: <strong class="text-success" x-text="completedTasksCount()"></strong></span>
            <div class="h-4 w-px bg-border"></div>
            <div class="flex items-center gap-1.5">
                <span class="size-2 rounded-full bg-success"></span>
                <span>Active Sprint</span>
            </div>
        </div>
    </div>

    {{-- Trello Board Columns Container --}}
    <div class="flex items-start gap-4 overflow-x-auto pb-6 pt-2" style="min-h: calc(100vh - 18rem);">
        <template x-for="(column, colIndex) in columns" :key="column.id">
            <div 
                class="flex w-80 shrink-0 flex-col rounded-2xl border border-border/80 bg-muted/40 p-3 shadow-xs transition-all"
                @dragover.prevent="dragOverColumn = column.id"
                @dragleave="dragOverColumn = null"
                @drop="dropCard(column.id)"
                :class="dragOverColumn === column.id ? 'ring-2 ring-primary/50 bg-accent/40' : ''"
            >
                {{-- Column Header --}}
                <div class="mb-3 flex items-center justify-between px-1">
                    <div class="flex items-center gap-2">
                        <span class="size-2.5 rounded-full" :class="column.color"></span>
                        <h3 class="text-sm font-semibold text-foreground" x-text="column.title"></h3>
                        <span class="rounded-full bg-muted px-2 py-0.5 text-xs font-semibold text-muted-foreground" x-text="getFilteredCards(column).length"></span>
                    </div>
                    <div class="flex items-center gap-1">
                        <button type="button" @click="openAddCardModal(column.id)" class="rounded-lg p-1 text-muted-foreground hover:bg-accent hover:text-foreground">
                            <i data-lucide="plus" class="size-4"></i>
                        </button>
                        <button type="button" @click="deleteColumn(colIndex)" class="rounded-lg p-1 text-muted-foreground hover:bg-destructive/10 hover:text-destructive">
                            <i data-lucide="more-horizontal" class="size-4"></i>
                        </button>
                    </div>
                </div>

                {{-- Column Cards List --}}
                <div class="flex flex-col gap-2.5 min-h-[120px]">
                    <template x-for="(card, cardIndex) in getFilteredCards(column)" :key="card.id">
                        <div 
                            draggable="true"
                            @dragstart="startDrag(card, column.id)"
                            @click="openCardDetail(card)"
                            class="group relative flex flex-col gap-2 rounded-xl border border-border/90 bg-card p-3.5 shadow-xs transition-all hover:-translate-y-0.5 hover:border-primary/40 hover:shadow-md cursor-grab active:cursor-grabbing"
                        >
                            {{-- Card Tags --}}
                            <div class="flex flex-wrap items-center gap-1.5" if="card.tags && card.tags.length">
                                <template x-for="tag in card.tags" :key="tag.label">
                                    <span class="inline-flex items-center rounded-md px-2 py-0.5 text-[10px] font-semibold" :class="tag.bgClass + ' ' + tag.textClass" x-text="tag.label"></span>
                                </template>
                            </div>

                            {{-- Card Title & Cover Image if any --}}
                            <template x-if="card.cover">
                                <img :src="card.cover" class="h-28 w-full rounded-lg object-cover" alt="Card cover">
                            </template>

                            <h4 class="text-xs font-semibold text-foreground leading-snug group-hover:text-primary transition-colors" x-text="card.title"></h4>

                            <template x-if="card.description">
                                <p class="line-clamp-2 text-[11px] text-muted-foreground" x-text="card.description"></p>
                            </template>

                            {{-- Checklist progress if any --}}
                            <template x-if="card.checklist && card.checklist.length > 0">
                                <div class="mt-1 space-y-1">
                                    <div class="flex items-center justify-between text-[10px] text-muted-foreground">
                                        <span class="flex items-center gap-1">
                                            <i data-lucide="check-square" class="size-3"></i>
                                            <span x-text="getCompletedChecklistCount(card) + '/' + card.checklist.length"></span>
                                        </span>
                                        <span x-text="Math.round((getCompletedChecklistCount(card)/card.checklist.length)*100) + '%'"></span>
                                    </div>
                                    <div class="h-1.5 w-full overflow-hidden rounded-full bg-muted">
                                        <div class="h-full bg-success transition-all duration-300" :style="'width: ' + ((getCompletedChecklistCount(card)/card.checklist.length)*100) + '%'"></div>
                                    </div>
                                </div>
                            </template>

                            {{-- Card Footer Metadata --}}
                            <div class="mt-1 flex items-center justify-between border-t border-border/60 pt-2 text-[11px] text-muted-foreground">
                                <div class="flex items-center gap-2.5">
                                    <template x-if="card.dueDate">
                                        <span class="flex items-center gap-1 font-medium" :class="isOverdue(card.dueDate) ? 'text-destructive font-semibold' : ''">
                                            <i data-lucide="clock" class="size-3"></i>
                                            <span x-text="card.dueDate"></span>
                                        </span>
                                    </template>
                                    <template x-if="card.commentsCount">
                                        <span class="flex items-center gap-1">
                                            <i data-lucide="message-square" class="size-3"></i>
                                            <span x-text="card.commentsCount"></span>
                                        </span>
                                    </template>
                                    <template x-if="card.attachmentsCount">
                                        <span class="flex items-center gap-1">
                                            <i data-lucide="paperclip" class="size-3"></i>
                                            <span x-text="card.attachmentsCount"></span>
                                        </span>
                                    </template>
                                </div>

                                {{-- Assignee Avatars --}}
                                <div class="flex -space-x-1.5 overflow-hidden">
                                    <template x-for="user in card.assignees" :key="user.name">
                                        <img :src="user.avatar" :title="user.name" class="inline-block size-5 rounded-full ring-1 ring-background object-cover" alt="Assignee">
                                    </template>
                                </div>
                            </div>
                        </div>
                    </template>

                    {{-- Empty State in Column --}}
                    <template x-if="getFilteredCards(column).length === 0">
                        <div class="flex flex-col items-center justify-center rounded-xl border border-dashed border-border py-8 text-center">
                            <i data-lucide="inbox" class="size-6 text-muted-foreground/60 mb-1"></i>
                            <span class="text-xs text-muted-foreground">No tasks here</span>
                        </div>
                    </template>

                    {{-- Add Card Form / Button --}}
                    <div x-data="{ adding: false, newTitle: '' }" class="mt-1">
                        <template x-if="!adding">
                            <button type="button" @click="adding = true" class="flex w-full items-center gap-2 rounded-xl p-2 text-xs font-medium text-muted-foreground hover:bg-accent hover:text-foreground transition-colors">
                                <i data-lucide="plus" class="size-4"></i>
                                <span>Add a card</span>
                            </button>
                        </template>

                        <template x-if="adding">
                            <div class="space-y-2 rounded-xl border border-border bg-card p-3 shadow-xs">
                                <textarea x-model="newTitle" placeholder="Enter task title..." class="w-full resize-none rounded-lg border border-input bg-background p-2 text-xs focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring" rows="2"></textarea>
                                <div class="flex items-center gap-2">
                                    <x-ui.button size="sm" @click="if(newTitle.trim()){ addCard(column.id, newTitle); newTitle = ''; adding = false; }">Add Card</x-ui.button>
                                    <button type="button" @click="adding = false; newTitle = ''" class="rounded-lg p-1.5 text-muted-foreground hover:bg-accent">
                                        <i data-lucide="x" class="size-4"></i>
                                    </button>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </template>

        {{-- Add Column Button --}}
        <div class="w-80 shrink-0">
            <button type="button" @click="addNewColumn()" class="flex w-full items-center justify-center gap-2 rounded-2xl border border-dashed border-border bg-muted/20 py-4 text-xs font-medium text-muted-foreground hover:border-primary/50 hover:bg-accent hover:text-foreground transition-all">
                <i data-lucide="plus-circle" class="size-4 text-primary"></i>
                <span>Add another list</span>
            </button>
        </div>
    </div>

    {{-- ===== Task Detail Modal (Trello Style) ===== --}}
    <template x-if="activeCard">
        <div class="fixed inset-0 z-[100] flex items-center justify-center p-4">
            <div class="absolute inset-0 bg-background/80 backdrop-blur-sm" @click="activeCard = null"></div>
            <div class="relative w-full max-w-2xl max-h-[90vh] overflow-y-auto rounded-2xl border border-border bg-card text-card-foreground shadow-2xl p-6 space-y-6">
                
                {{-- Modal Header --}}
                <div class="flex items-start justify-between gap-4">
                    <div class="flex items-start gap-3 flex-1">
                        <i data-lucide="layout" class="size-6 text-primary mt-1 shrink-0"></i>
                        <div class="flex-1">
                            <input type="text" x-model="activeCard.title" class="w-full text-lg font-bold bg-transparent border-0 focus:ring-1 focus:ring-ring rounded px-1 -ms-1">
                            <p class="text-xs text-muted-foreground mt-0.5">In list <span class="font-semibold text-foreground" x-text="getColumnTitle(activeCard.colId)"></span></p>
                        </div>
                    </div>
                    <button type="button" @click="activeCard = null" class="rounded-lg p-1.5 text-muted-foreground hover:bg-accent hover:text-foreground">
                        <i data-lucide="x" class="size-5"></i>
                    </button>
                </div>

                {{-- Modal Body Grid --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    {{-- Left Column: Details --}}
                    <div class="md:col-span-2 space-y-5">
                        {{-- Tags / Labels Section --}}
                        <div>
                            <h4 class="text-xs font-semibold uppercase text-muted-foreground tracking-wider mb-2">Labels</h4>
                            <div class="flex flex-wrap gap-1.5">
                                <template x-for="tag in activeCard.tags" :key="tag.label">
                                    <span class="inline-flex items-center gap-1 rounded-md px-2.5 py-1 text-xs font-semibold" :class="tag.bgClass + ' ' + tag.textClass">
                                        <span x-text="tag.label"></span>
                                    </span>
                                </template>
                            </div>
                        </div>

                        {{-- Description Section --}}
                        <div>
                            <div class="flex items-center gap-2 mb-2">
                                <i data-lucide="align-left" class="size-4 text-muted-foreground"></i>
                                <h4 class="text-xs font-semibold uppercase text-muted-foreground tracking-wider">Description</h4>
                            </div>
                            <textarea x-model="activeCard.description" placeholder="Add a detailed description..." class="w-full rounded-xl border border-input bg-background p-3 text-xs focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring min-h-[100px]"></textarea>
                        </div>

                        {{-- Checklist Section --}}
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <div class="flex items-center gap-2">
                                    <i data-lucide="check-square" class="size-4 text-muted-foreground"></i>
                                    <h4 class="text-xs font-semibold uppercase text-muted-foreground tracking-wider">Checklist</h4>
                                </div>
                            </div>
                            <div class="space-y-2 rounded-xl border border-border/80 bg-muted/20 p-3">
                                <template x-for="(item, idx) in activeCard.checklist" :key="idx">
                                    <label class="flex items-center gap-2.5 text-xs cursor-pointer hover:bg-accent/40 p-1.5 rounded-lg">
                                        <input type="checkbox" x-model="item.done" class="rounded border-input text-primary focus:ring-primary">
                                        <span :class="item.done ? 'line-through text-muted-foreground' : 'text-foreground'" x-text="item.text"></span>
                                    </label>
                                </template>
                                <div class="flex items-center gap-2 pt-2">
                                    <input type="text" x-model="newChecklistItem" @keydown.enter="addChecklistItem()" placeholder="Add checklist item..." class="flex-1 h-8 rounded-lg border border-input bg-background px-3 text-xs">
                                    <x-ui.button size="sm" @click="addChecklistItem()">Add</x-ui.button>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Right Column: Actions --}}
                    <div class="space-y-4 border-t md:border-t-0 md:border-s border-border pt-4 md:pt-0 md:ps-4">
                        <div>
                            <h4 class="text-xs font-semibold uppercase text-muted-foreground tracking-wider mb-2">Actions</h4>
                            <div class="space-y-2">
                                <button type="button" @click="deleteActiveCard()" class="flex w-full items-center gap-2 rounded-xl border border-destructive/30 bg-destructive/5 px-3 py-2 text-xs font-medium text-destructive hover:bg-destructive/10">
                                    <i data-lucide="trash-2" class="size-4"></i>
                                    <span>Delete Card</span>
                                </button>
                                <button type="button" @click="activeCard = null" class="flex w-full items-center justify-center gap-2 rounded-xl border border-border bg-muted/40 px-3 py-2 text-xs font-medium hover:bg-accent">
                                    <span>Close</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </template>
</div>

<script>
function kanbanBoard() {
    return {
        searchQuery: '',
        draggedCard: null,
        draggedFromCol: null,
        dragOverColumn: null,
        activeCard: null,
        newChecklistItem: '',
        columns: [
            {
                id: 'backlog',
                title: 'Backlog',
                color: 'bg-muted-foreground',
                cards: [
                    {
                        id: 'c1',
                        title: 'Design Dark Mode Customizer Drawer',
                        description: 'Create interactive color picker and radius preset controls for light/dark theme switcher.',
                        tags: [
                            { label: 'UI/UX', bgClass: 'bg-indigo-500/10', textClass: 'text-indigo-500' },
                            { label: 'Design System', bgClass: 'bg-purple-500/10', textClass: 'text-purple-500' }
                        ],
                        dueDate: 'Aug 2',
                        commentsCount: 3,
                        attachmentsCount: 1,
                        checklist: [
                            { text: 'Dark mode tokens HSL', done: true },
                            { text: 'Color swatch drawers', done: true },
                            { text: 'Persistence in localStorage', done: false }
                        ],
                        assignees: [
                            { name: 'Sarah', avatar: 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=100&auto=format&fit=crop&q=80' }
                        ]
                    },
                    {
                        id: 'c2',
                        title: 'Refactor Menu active-trail logic in Livewire',
                        description: 'Ensure nested sidebar menu highlights active parent nodes correctly when child route is selected.',
                        tags: [
                            { label: 'Backend', bgClass: 'bg-emerald-500/10', textClass: 'text-emerald-500' }
                        ],
                        dueDate: 'Aug 5',
                        commentsCount: 1,
                        attachmentsCount: 0,
                        checklist: [],
                        assignees: [
                            { name: 'Alex', avatar: 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=100&auto=format&fit=crop&q=80' }
                        ]
                    }
                ]
            },
            {
                id: 'in_progress',
                title: 'In Progress',
                color: 'bg-primary',
                cards: [
                    {
                        id: 'c3',
                        title: 'Build Trello-style Kanban Board App',
                        description: 'Interactive drag-and-drop board with columns, card tags, checklist progress, and card detail modal.',
                        tags: [
                            { label: 'Feature', bgClass: 'bg-primary/10', textClass: 'text-primary' },
                            { label: 'High Priority', bgClass: 'bg-rose-500/10', textClass: 'text-rose-500' }
                        ],
                        dueDate: 'Today',
                        commentsCount: 5,
                        attachmentsCount: 2,
                        checklist: [
                            { text: 'Column layout HTML/CSS', done: true },
                            { text: 'Drag and drop handlers', done: true },
                            { text: 'Task detail modal', done: true }
                        ],
                        assignees: [
                            { name: 'Elena', avatar: 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=100&auto=format&fit=crop&q=80' },
                            { name: 'David', avatar: 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=100&auto=format&fit=crop&q=80' }
                        ]
                    },
                    {
                        id: 'c4',
                        title: 'Add Searchable Combobox & OTP Input',
                        description: 'Enhance Form Elements page with searchable select dropdown and multi-box OTP verification component.',
                        tags: [
                            { label: 'Components', bgClass: 'bg-amber-500/10', textClass: 'text-amber-500' }
                        ],
                        dueDate: 'Tomorrow',
                        commentsCount: 2,
                        attachmentsCount: 0,
                        checklist: [
                            { text: 'Combobox search input', done: true },
                            { text: 'OTP auto focus next box', done: true }
                        ],
                        assignees: [
                            { name: 'Alex', avatar: 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=100&auto=format&fit=crop&q=80' }
                        ]
                    }
                ]
            },
            {
                id: 'in_review',
                title: 'Review / QA',
                color: 'bg-amber-500',
                cards: [
                    {
                        id: 'c5',
                        title: 'Modal Position & Alignment Props',
                        description: 'Support top, center, bottom, top-right, bottom-right, drawer-left, and drawer-right modal alignments.',
                        tags: [
                            { label: 'Enhancement', bgClass: 'bg-cyan-500/10', textClass: 'text-cyan-500' }
                        ],
                        dueDate: 'Jul 27',
                        commentsCount: 4,
                        attachmentsCount: 1,
                        checklist: [
                            { text: 'Add position prop', done: true },
                            { text: 'Test drawers & corner positions', done: true }
                        ],
                        assignees: [
                            { name: 'Sarah', avatar: 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=100&auto=format&fit=crop&q=80' }
                        ]
                    }
                ]
            },
            {
                id: 'done',
                title: 'Done',
                color: 'bg-success',
                cards: [
                    {
                        id: 'c6',
                        title: 'Publish AdminKit Packagist Package',
                        description: 'Configure composer.json, tag v1.0.0, connect GitHub webhook to Packagist.',
                        tags: [
                            { label: 'DevOps', bgClass: 'bg-success/10', textClass: 'text-success' }
                        ],
                        dueDate: 'Completed',
                        commentsCount: 8,
                        attachmentsCount: 3,
                        checklist: [
                            { text: 'Composer package name', done: true },
                            { text: 'Packagist submission', done: true },
                            { text: 'GitHub Webhook 202 OK', done: true }
                        ],
                        assignees: [
                            { name: 'David', avatar: 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=100&auto=format&fit=crop&q=80' }
                        ]
                    }
                ]
            }
        ],

        init() {
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }
        },

        getFilteredCards(column) {
            if (!this.searchQuery.trim()) return column.cards;
            const q = this.searchQuery.toLowerCase();
            return column.cards.filter(c => 
                c.title.toLowerCase().includes(q) || 
                (c.description && c.description.toLowerCase().includes(q)) ||
                (c.tags && c.tags.some(t => t.label.toLowerCase().includes(q)))
            );
        },

        totalTasksCount() {
            return this.columns.reduce((acc, col) => acc + col.cards.length, 0);
        },

        completedTasksCount() {
            const doneCol = this.columns.find(c => c.id === 'done');
            return doneCol ? doneCol.cards.length : 0;
        },

        getCompletedChecklistCount(card) {
            if (!card.checklist) return 0;
            return card.checklist.filter(i => i.done).length;
        },

        isOverdue(dueDate) {
            return dueDate === 'Overdue' || dueDate === 'Today';
        },

        startDrag(card, colId) {
            this.draggedCard = card;
            this.draggedFromCol = colId;
        },

        dropCard(targetColId) {
            if (!this.draggedCard || !this.draggedFromCol) return;
            if (this.draggedFromCol === targetColId) return;

            // Remove from source column
            const sourceCol = this.columns.find(c => c.id === this.draggedFromCol);
            if (sourceCol) {
                sourceCol.cards = sourceCol.cards.filter(c => c.id !== this.draggedCard.id);
            }

            // Add to target column
            const targetCol = this.columns.find(c => c.id === targetColId);
            if (targetCol) {
                targetCol.cards.push(this.draggedCard);
            }

            this.draggedCard = null;
            this.draggedFromCol = null;
            this.dragOverColumn = null;

            if (window.toast) {
                window.toast('Card moved to ' + targetCol.title, { variant: 'success' });
            }
        },

        addCard(colId, title) {
            const col = this.columns.find(c => c.id === colId);
            if (!col) return;

            const newCard = {
                id: 'c_' + Date.now(),
                title: title,
                description: '',
                tags: [{ label: 'New', bgClass: 'bg-primary/10', textClass: 'text-primary' }],
                dueDate: 'Soon',
                commentsCount: 0,
                attachmentsCount: 0,
                checklist: [],
                assignees: [{ name: 'You', avatar: 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=100&auto=format&fit=crop&q=80' }]
            };

            col.cards.push(newCard);
            if (window.toast) {
                window.toast('Card added', { variant: 'success' });
            }
        },

        addNewColumn() {
            const title = prompt('Enter new column title:');
            if (!title || !title.trim()) return;

            const colors = ['bg-purple-500', 'bg-indigo-500', 'bg-rose-500', 'bg-amber-500', 'bg-cyan-500'];
            const randomColor = colors[Math.floor(Math.random() * colors.length)];

            this.columns.push({
                id: 'col_' + Date.now(),
                title: title.trim(),
                color: randomColor,
                cards: []
            });

            if (window.toast) {
                window.toast('Column added', { variant: 'success' });
            }
        },

        deleteColumn(colIndex) {
            if (confirm('Delete this column and all its cards?')) {
                this.columns.splice(colIndex, 1);
            }
        },

        openCardDetail(card) {
            // Find which column card belongs to
            let colId = null;
            for (const col of this.columns) {
                if (col.cards.some(c => c.id === card.id)) {
                    colId = col.id;
                    break;
                }
            }
            card.colId = colId;
            this.activeCard = card;
        },

        getColumnTitle(colId) {
            const col = this.columns.find(c => c.id === colId);
            return col ? col.title : '';
        },

        addChecklistItem() {
            if (!this.newChecklistItem || !this.newChecklistItem.trim() || !this.activeCard) return;
            if (!this.activeCard.checklist) this.activeCard.checklist = [];
            
            this.activeCard.checklist.push({
                text: this.newChecklistItem.trim(),
                done: false
            });
            this.newChecklistItem = '';
        },

        deleteActiveCard() {
            if (!this.activeCard) return;
            const cardId = this.activeCard.id;
            const colId = this.activeCard.colId;

            const col = this.columns.find(c => c.id === colId);
            if (col) {
                col.cards = col.cards.filter(c => c.id !== cardId);
            }
            this.activeCard = null;

            if (window.toast) {
                window.toast('Card deleted', { variant: 'destructive' });
            }
        }
    }
}
</script>
