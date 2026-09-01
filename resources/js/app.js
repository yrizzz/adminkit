import { createIcons } from 'lucide';
import * as lucideIcons from 'lucide';
import Chart from 'chart.js/auto';
import Alpine from 'alpinejs';
import collapse from '@alpinejs/collapse';
import focus from '@alpinejs/focus';
import persist from '@alpinejs/persist';

window.Chart = Chart;

// Attach plugins to Alpine
Alpine.plugin(collapse);
Alpine.plugin(focus);
Alpine.plugin(persist);

// In static HTML mode (no Livewire), assign Alpine to window.Alpine
if (typeof window.Livewire === 'undefined' && typeof window.Alpine === 'undefined') {
    window.Alpine = Alpine;
}

/* Give every value (linear) axis a little headroom so lines/bars never touch
   the plot edge. Applies globally to all line/bar/area charts; pie/doughnut
   (no scales) and radar (radialLinear) are unaffected. */
Chart.defaults.scales.linear.grace = '8%';

/* Reserve a little space around the plot so edge tick labels (e.g. the first
   and last week on a line chart) aren't clipped by the canvas bounds. */
Chart.defaults.layout.padding = { top: 6, right: 14, bottom: 0, left: 6 };

/* ---------------------------------------------------------------
 * Apply Chart.js global defaults based on current dark/light mode.
 * Called on boot and whenever the theme changes.
 * ------------------------------------------------------------- */
const applyChartDefaults = () => {
    const dark = document.documentElement.classList.contains('dark');
    const gridColor   = dark ? 'rgba(255,255,255,0.08)' : 'rgba(0,0,0,0.07)';
    const tickColor   = dark ? 'rgba(255,255,255,0.60)' : 'rgba(0,0,0,0.55)';
    const borderColor = dark ? 'rgba(255,255,255,0.10)' : 'rgba(0,0,0,0.10)';

    /* Scales */
    Chart.defaults.scale.grid.color        = gridColor;
    Chart.defaults.scale.grid.borderColor  = borderColor;
    Chart.defaults.scale.ticks.color       = tickColor;

    /* Plugins */
    Chart.defaults.plugins.legend.labels.color = tickColor;
    Chart.defaults.plugins.tooltip.backgroundColor = dark ? 'rgba(15,23,42,0.92)' : 'rgba(255,255,255,0.96)';
    Chart.defaults.plugins.tooltip.titleColor      = dark ? 'rgba(255,255,255,0.90)' : 'rgba(0,0,0,0.85)';
    Chart.defaults.plugins.tooltip.bodyColor       = dark ? 'rgba(255,255,255,0.65)' : 'rgba(0,0,0,0.60)';
    Chart.defaults.plugins.tooltip.borderColor     = dark ? 'rgba(255,255,255,0.12)' : 'rgba(0,0,0,0.10)';
    Chart.defaults.plugins.tooltip.borderWidth     = 1;
    Chart.defaults.plugins.tooltip.padding         = 10;
    Chart.defaults.plugins.tooltip.cornerRadius    = 10;
    Chart.defaults.plugins.tooltip.boxPadding      = 4;
};
window.applyChartDefaults = applyChartDefaults;
applyChartDefaults();

/* ---------------------------------------------------------------
 * Global Chart.js plugin: auto-apply dark/light theme colors to
 * ALL chart instances so each individual chart doesn't have to
 * hardcode them. Runs before every chart update.
 * ------------------------------------------------------------- */
Chart.register({
    id: 'akTheme',
    beforeUpdate(chart) {
        const dark   = document.documentElement.classList.contains('dark');
        const text   = dark ? 'rgba(255,255,255,0.60)' : 'rgba(0,0,0,0.55)';
        const grid   = dark ? 'rgba(255,255,255,0.08)' : 'rgba(0,0,0,0.07)';
        const border = dark ? 'rgba(255,255,255,0.10)' : 'rgba(0,0,0,0.10)';

        // Dynamic color binding for datasets (so lines/bars/gradients update on theme/accent toggle)
        if (!chart._colorBindings) {
            chart._colorBindings = [];
            const css = getComputedStyle(document.documentElement);
            const getHSL = (name) => `hsl(${css.getPropertyValue(name).trim()})`;
            const vars = ['--primary', '--chart-1', '--chart-2', '--chart-3', '--chart-4', '--chart-5'];
            const varValues = {};
            vars.forEach(v => {
                varValues[v] = getHSL(v);
            });
            chart.data.datasets.forEach((dataset, i) => {
                const binding = {};
                if (typeof dataset.borderColor === 'string') {
                    const match = vars.find(v => varValues[v] === dataset.borderColor);
                    if (match) binding.borderColorVar = match;
                }
                if (typeof dataset.backgroundColor === 'string') {
                    const match = vars.find(v => varValues[v] === dataset.backgroundColor);
                    if (match) binding.backgroundColorVar = match;
                } else if (Array.isArray(dataset.backgroundColor)) {
                    binding.backgroundColorVars = dataset.backgroundColor.map(color => {
                        return vars.find(v => varValues[v] === color) || null;
                    });
                }
                if (dataset.backgroundColor && typeof dataset.backgroundColor === 'object') {
                    if (chart.canvas && chart.canvas.id === 'chartRevenue') {
                        binding.isRevenueGradient = true;
                    }
                }
                chart._colorBindings[i] = binding;
            });
        }

        if (chart._colorBindings) {
            const css = getComputedStyle(document.documentElement);
            const getHSL = (name) => `hsl(${css.getPropertyValue(name).trim()})`;
            chart.data.datasets.forEach((dataset, i) => {
                const binding = chart._colorBindings[i];
                if (!binding) return;
                if (binding.borderColorVar) {
                    dataset.borderColor = getHSL(binding.borderColorVar);
                }
                if (binding.backgroundColorVar) {
                    dataset.backgroundColor = getHSL(binding.backgroundColorVar);
                }
                if (binding.backgroundColorVars) {
                    dataset.backgroundColor = binding.backgroundColorVars.map((v, index) => {
                        return v ? getHSL(v) : dataset.backgroundColor[index];
                    });
                }
                if (binding.isRevenueGradient && chart.canvas) {
                    const ctx = chart.canvas.getContext('2d');
                    const primary = getHSL('--primary');
                    const g = ctx.createLinearGradient(0, 0, 0, 288);
                    g.addColorStop(0, primary.replace(')', ' / .35)').replace('hsl', 'hsla'));
                    g.addColorStop(1, primary.replace(')', ' / 0)').replace('hsl', 'hsla'));
                    dataset.backgroundColor = g;
                }
            });
        }

        /* ── Legend ── */
        const legendLabels = chart.config.options?.plugins?.legend?.labels;
        if (legendLabels) legendLabels.color = text;

        /* ── Scales (x, y, r, etc.) ── */
        const scales = chart.config.options?.scales ?? {};
        for (const scale of Object.values(scales)) {
            /* tick labels */
            if (scale.ticks) scale.ticks.color = text;
            /* grid lines */
            if (scale.grid) {
                if (scale.grid.display !== false) scale.grid.color = grid;
                scale.grid.borderColor = border;
            }
            /* radar: spoke lines */
            if (scale.angleLines) scale.angleLines.color = grid;
            /* radar: outer labels */
            if (scale.pointLabels) scale.pointLabels.color = text;
        }

        /* ── Tooltips ── */
        const tp = chart.config.options?.plugins?.tooltip;
        if (tp) {
            tp.backgroundColor = dark ? 'rgba(15,23,42,0.92)' : 'rgba(255,255,255,0.96)';
            tp.titleColor      = dark ? 'rgba(255,255,255,0.90)' : 'rgba(0,0,0,0.85)';
            tp.bodyColor       = dark ? 'rgba(255,255,255,0.65)' : 'rgba(0,0,0,0.60)';
            tp.borderColor     = dark ? 'rgba(255,255,255,0.12)' : 'rgba(0,0,0,0.10)';
        }
    },
});

const lucideIconsMap = {};
Object.keys(lucideIcons).forEach((key) => {
    lucideIconsMap[key] = lucideIcons[key];
    const kebab = key.replace(/([a-z0-9])([A-Z])/g, '$1-$2').toLowerCase();
    lucideIconsMap[kebab] = lucideIcons[key];
});

let isRenderingIcons = false;
const renderIcons = () => {
    if (isRenderingIcons) return;
    isRenderingIcons = true;
    try {
        createIcons({ icons: lucideIconsMap, attrs: { 'stroke-width': 2 } });
    } catch (e) {
        console.warn('[Lucide] Error rendering icons:', e);
    } finally {
        setTimeout(() => { isRenderingIcons = false; }, 50);
    }
};
window.renderIcons = renderIcons;

/* Tiny localStorage + Cookie sync helper (mirrors the anti-FOUC keys in <head> & server Blade) */
const LS = {
    get(k, d) { try { const v = localStorage.getItem(k); return v === null ? d : JSON.parse(v); } catch (e) { return d; } },
    set(k, v) {
        try {
            localStorage.setItem(k, JSON.stringify(v));
            document.cookie = `${k}=${encodeURIComponent(v)};path=/;max-age=31536000;SameSite=Lax`;
        } catch (e) {}
    },
};

/* ---------------------------------------------------------------
 * Global UI store — theme, direction, layout, sidebar, accent…
 * Registered on Livewire's Alpine instance (survives wire:navigate).
 * ------------------------------------------------------------- */
const registerUIStore = () => {
    if (typeof window.Alpine === 'undefined') return;

    const storeObj = {
        theme: LS.get('ak_theme', 'system'),
        direction: LS.get('ak_dir', 'ltr'),
        layout: LS.get('ak_layout', 'vertical'),
        accent: LS.get('ak_accent', 'blue'),
        radius: LS.get('ak_radius', 'lg'),
        sidebarCollapsed: LS.get('ak_sb_collapsed', false),
        navbarFixed: LS.get('ak_navbar_fixed', true),
        compact: LS.get('ak_compact', false),
        sidebarColor: LS.get('ak_sb_color', 'dark'),
        sidebarStyle: LS.get('ak_sb_style', 'tree'),
        navbarColor: LS.get('ak_nb_color', 'default'),
        cardAnimation: LS.get('ak_card_animation', 'fade-up'),
        pageLoading: LS.get('ak_page_loading', false),
        layoutFluid: LS.get('ak_layout_fluid', false),
        curvedLayout: LS.get('ak_curved_layout', true),

        sidebarGradientFrom: LS.get('ak_sb_grad_from', '#1e1b4b'),
        sidebarGradientTo: LS.get('ak_sb_grad_to', '#0f172a'),
        navbarGradientFrom: LS.get('ak_nb_grad_from', '#1e1b4b'),
        navbarGradientTo: LS.get('ak_nb_grad_to', '#0f172a'),

        // transient
        sidebarMobileOpen: false,
        customizerOpen: false,
        commandOpen: false,

        init() {
            this.apply();
            window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
                if (this.theme === 'system') this.apply();
            });
        },

        get isDark() {
            return this.theme === 'dark' || (this.theme === 'system' && window.matchMedia('(prefers-color-scheme: dark)').matches);
        },

        apply() {
            const html = document.documentElement;
            html.classList.toggle('dark', this.isDark);
            html.setAttribute('dir', this.direction);
            html.dataset.accent = this.accent;
            const blueToken = '221 83% 53%';
            const accMap = {
                blue: blueToken,
                violet: '262 83% 58%',
                green: '142 71% 45%',
                rose: '347 77% 50%',
                red: '347 77% 50%',
                orange: '25 95% 53%',
                amber: '38 92% 50%',
                teal: '173 80% 40%',
                midnight: '222 47% 11%',
                black: '222 47% 11%'
            };
            if (this.accent === 'midnight' || this.accent === 'black') {
                html.style.setProperty('--primary', '222 47% 11%');
                html.style.setProperty('--primary-foreground', '0 0% 100%');
                html.style.setProperty('--ring', '222 47% 11%');
                html.style.setProperty('--sidebar-primary', '222 47% 11%');
            } else if (accMap[this.accent]) {
                const colorVal = accMap[this.accent];
                html.style.setProperty('--primary', colorVal);
                html.style.setProperty('--ring', colorVal);
                html.style.setProperty('--sidebar-primary', colorVal);
                html.style.removeProperty('--primary-foreground');
            }
            html.dataset.radius = this.radius;

            html.dataset.layout = this.layout;
            html.dataset.sidebarColor = this.sidebarColor;
            html.dataset.sidebarStyle = this.sidebarStyle;
            html.dataset.navbarColor = this.navbarColor;
            html.dataset.cardAnimation = this.cardAnimation;
            html.dataset.pageLoading = this.pageLoading;
            html.dataset.layoutFluid = this.layoutFluid;
            html.dataset.curvedLayout = this.curvedLayout;
            html.classList.toggle('sidebar-collapsed', this.sidebarCollapsed);
            html.classList.toggle('is-compact', this.compact);

            html.style.setProperty('--custom-sb-grad-from', this.sidebarGradientFrom);
            html.style.setProperty('--custom-sb-grad-to', this.sidebarGradientTo);
            html.style.setProperty('--custom-nb-grad-from', this.navbarGradientFrom);
            html.style.setProperty('--custom-nb-grad-to', this.navbarGradientTo);

            /* Keep Chart.js global defaults in sync with dark/light mode */
            if (window.applyChartDefaults) window.applyChartDefaults();

            /* Force update all active Chart.js instances so they redraw with correct theme colors */
            if (window.Chart && window.Chart.instances) {
                Object.values(window.Chart.instances).forEach(chart => {
                    try {
                        chart.update();
                    } catch (e) {
                        console.warn('[Chart.js] Failed to update chart instance:', e);
                    }
                });
            }

            const aside = document.querySelector('aside.main-sidebar');
            if (aside) aside.setAttribute('data-sidebar-color', this.sidebarColor);
            const header = document.querySelector('header');
            if (header) header.setAttribute('data-navbar-color', this.navbarColor);
        },

        setSidebarStyle(v) { this.sidebarStyle = v; LS.set('ak_sb_style', v); this.apply(); },


        setTheme(v) { this.theme = v; LS.set('ak_theme', v); this.apply(); },
        toggleTheme(e) {
            const isDarkNext = !this.isDark;
            const nextTheme  = isDarkNext ? 'dark' : 'light';

            // No View Transition support or reduced motion — simple swap
            if (!document.startViewTransition || window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
                document.documentElement.classList.add('theme-transitioning');
                this.setTheme(nextTheme);
                setTimeout(() => document.documentElement.classList.remove('theme-transitioning'), 350);
                return;
            }

            // ── Mobile: clean top-to-bottom wipe ──────────────────────────
            const isMobile = window.matchMedia('(pointer: coarse)').matches;
            if (isMobile) {
                const mobileTransition = document.startViewTransition(() => {
                    this.setTheme(nextTheme);
                });
                mobileTransition.ready.then(() => {
                    // New theme: fade in + subtle scale up
                    document.documentElement.animate(
                        [
                            { opacity: 0, transform: 'scale(0.97)' },
                            { opacity: 1, transform: 'scale(1)' }
                        ],
                        {
                            duration: 550,
                            easing: 'cubic-bezier(0.16, 1, 0.3, 1)',
                            pseudoElement: '::view-transition-new(root)',
                            fill: 'both'
                        }
                    );
                    // Old theme: fade out + subtle scale down
                    document.documentElement.animate(
                        [
                            { opacity: 1, transform: 'scale(1)' },
                            { opacity: 0, transform: 'scale(1.03)' }
                        ],
                        {
                            duration: 400,
                            easing: 'cubic-bezier(0.4, 0, 1, 1)',
                            pseudoElement: '::view-transition-old(root)',
                            fill: 'both'
                        }
                    );
                });
                return;
            }

            // ── Desktop: circle ripple from click position ─────────────────
            let x = window.innerWidth / 2;
            let y = window.innerHeight / 2;

            if (window._lastPointerX !== null && window._lastPointerY !== null) {
                x = window._lastPointerX;
                y = window._lastPointerY;
                window._lastPointerX = null;
                window._lastPointerY = null;
            } else if (e && e.clientX !== undefined && e.clientX !== 0) {
                x = e.clientX;
                y = e.clientY;
            } else if (e) {
                const btn = (e.target && typeof e.target.closest === 'function')
                    ? e.target.closest('button') : (e.currentTarget || e.target);
                if (btn && typeof btn.getBoundingClientRect === 'function') {
                    const rect = btn.getBoundingClientRect();
                    if (rect.width > 0 && rect.height > 0) {
                        x = rect.left + rect.width / 2;
                        y = rect.top + rect.height / 2;
                    }
                }
            }

            const endRadius = Math.hypot(
                Math.max(x, window.innerWidth - x),
                Math.max(y, window.innerHeight - y)
            );

            if (!isDarkNext) document.documentElement.classList.add('theme-shrink');
            else document.documentElement.classList.remove('theme-shrink');

            const transition = document.startViewTransition(() => {
                this.setTheme(nextTheme);
            });

            transition.ready.then(() => {
                const clipPath = [
                    `circle(0px at ${x}px ${y}px)`,
                    `circle(${endRadius}px at ${x}px ${y}px)`
                ];
                document.documentElement.animate(
                    { clipPath: isDarkNext ? clipPath : [...clipPath].reverse() },
                    {
                        duration: 500,
                        easing: 'cubic-bezier(0.4, 0, 0.2, 1)',
                        pseudoElement: isDarkNext ? '::view-transition-new(root)' : '::view-transition-old(root)'
                    }
                ).onfinish = () => document.documentElement.classList.remove('theme-shrink');
            });
        },
        setDirection(v) { this.direction = v; LS.set('ak_dir', v); this.apply(); },
        toggleDirection() { this.setDirection(this.direction === 'rtl' ? 'ltr' : 'rtl'); },
        setLayout(v) { this.layout = v; LS.set('ak_layout', v); this.apply(); },
        setAccent(v) { this.accent = v; LS.set('ak_accent', v); this.apply(); },
        setRadius(v) { this.radius = v; LS.set('ak_radius', v); this.apply(); },
        setCompact(v) { this.compact = v; LS.set('ak_compact', v); this.apply(); },
        toggleCurvedLayout() { this.curvedLayout = !this.curvedLayout; LS.set('ak_curved_layout', this.curvedLayout); this.apply(); },
        setSidebarColor(v) {
            this.sidebarColor = v;
            LS.set('ak_sb_color', v);
            if (v === 'gradient1' || v === 'gradient') {
                this.sidebarGradientFrom = '#1e1b4b';
                this.sidebarGradientTo = '#0f172a';
                LS.set('ak_sb_grad_from', '#1e1b4b');
                LS.set('ak_sb_grad_to', '#0f172a');
            } else if (v === 'gradient2') {
                this.sidebarGradientFrom = '#0d9488';
                this.sidebarGradientTo = '#064e3b';
                LS.set('ak_sb_grad_from', '#0d9488');
                LS.set('ak_sb_grad_to', '#064e3b');
            } else if (v === 'gradient3') {
                this.sidebarGradientFrom = '#e11d48';
                this.sidebarGradientTo = '#4c0519';
                LS.set('ak_sb_grad_from', '#e11d48');
                LS.set('ak_sb_grad_to', '#4c0519');
            }
            this.apply();
        },
        setNavbarColor(v) {
            this.navbarColor = v;
            LS.set('ak_nb_color', v);
            if (v === 'gradient1' || v === 'gradient') {
                this.navbarGradientFrom = '#1e1b4b';
                this.navbarGradientTo = '#0f172a';
                LS.set('ak_nb_grad_from', '#1e1b4b');
                LS.set('ak_nb_grad_to', '#0f172a');
            } else if (v === 'gradient2') {
                this.navbarGradientFrom = '#0d9488';
                this.navbarGradientTo = '#064e3b';
                LS.set('ak_nb_grad_from', '#0d9488');
                LS.set('ak_nb_grad_to', '#064e3b');
            } else if (v === 'gradient3') {
                this.navbarGradientFrom = '#e11d48';
                this.navbarGradientTo = '#4c0519';
                LS.set('ak_nb_grad_from', '#e11d48');
                LS.set('ak_nb_grad_to', '#4c0519');
            }
            this.apply();
        },
        setSidebarGradient(from, to) {
            if (from) { this.sidebarGradientFrom = from; LS.set('ak_sb_grad_from', from); }
            if (to) { this.sidebarGradientTo = to; LS.set('ak_sb_grad_to', to); }
            this.sidebarColor = 'custom_gradient';
            LS.set('ak_sb_color', 'custom_gradient');
            this.apply();
        },
        setNavbarGradient(from, to) {
            if (from) { this.navbarGradientFrom = from; LS.set('ak_nb_grad_from', from); }
            if (to) { this.navbarGradientTo = to; LS.set('ak_nb_grad_to', to); }
            this.navbarColor = 'custom_gradient';
            LS.set('ak_nb_color', 'custom_gradient');
            this.apply();
        },
        toggleSidebar() { this.sidebarCollapsed = !this.sidebarCollapsed; LS.set('ak_sb_collapsed', this.sidebarCollapsed); this.apply(); },
        setNavbarFixed(v) { this.navbarFixed = v; LS.set('ak_navbar_fixed', v); },
        setCardAnimation(v) { this.cardAnimation = v; LS.set('ak_card_animation', v); this.apply(); },
        togglePageLoading() { this.pageLoading = !this.pageLoading; LS.set('ak_page_loading', this.pageLoading); this.apply(); },
        toggleLayoutFluid() {
            const html = document.documentElement;
            html.classList.add('layout-width-transitioning');
            this.layoutFluid = !this.layoutFluid;
            LS.set('ak_layout_fluid', this.layoutFluid);
            this.apply();
            setTimeout(() => {
                html.classList.remove('layout-width-transitioning');
            }, 300);
        },
        openMobileSidebar() { this.sidebarMobileOpen = true; },
        closeMobileSidebar() { this.sidebarMobileOpen = false; },
    };

    try {
        if (window.Alpine.store('ui')) {
            window.Alpine.store('ui').apply();
        } else {
            window.Alpine.store('ui', storeObj);
        }
    } catch (e) {
        if (!window.Alpine.store('ui')) {
            window.Alpine.store('ui', storeObj);
        }
    }
};

document.addEventListener('alpine:init', registerUIStore);
if (window.Alpine) {
    registerUIStore();
}

// In static HTML mode ONLY (no Livewire), start Alpine automatically on DOMContentLoaded
document.addEventListener('DOMContentLoaded', () => {
    if (typeof window.Livewire === 'undefined') {
        if (typeof window.Alpine === 'undefined') {
            window.Alpine = Alpine;
        }
        registerUIStore();
        if (window.Alpine && !window.Alpine.started) {
            window.Alpine.start();
        }
    }
});

/* ---------------------------------------------------------------
 * Toast helper — window.toast('msg', { variant, title })
 * ------------------------------------------------------------- */
window.toast = (message, opts = {}) => {
    window.dispatchEvent(new CustomEvent('toast', {
        detail: {
            message,
            variant: opts.variant || 'default',
            title: opts.title,
            position: opts.position || 'bottom-end',
            duration: opts.duration ?? 4200,
        },
    }));
};

/* ---------------------------------------------------------------
 * Chart theming helper used by dashboard/chart pages.
 * ------------------------------------------------------------- */
window.akChartTheme = () => {
    let dark = document.documentElement.classList.contains('dark');
    if (window.Alpine && Alpine.store('ui')) {
        dark = Alpine.store('ui').isDark;
    } else {
        try {
            const stored = localStorage.getItem('ak_theme');
            if (stored) {
                const theme = JSON.parse(stored);
                dark = theme === 'dark' || (theme === 'system' && window.matchMedia('(prefers-color-scheme: dark)').matches);
            }
        } catch (e) {}
    }
    document.documentElement.classList.toggle('dark', dark);

    const css  = getComputedStyle(document.documentElement);
    const hsl  = (name) => `hsl(${css.getPropertyValue(name).trim()})`;
    return {
        primary : hsl('--primary'),
        grid    : dark ? 'rgba(255,255,255,0.08)' : 'rgba(0,0,0,0.07)',
        text    : dark ? 'rgba(255,255,255,0.60)' : 'rgba(0,0,0,0.55)',
        border  : dark ? 'rgba(255,255,255,0.10)' : 'rgba(0,0,0,0.10)',
        c1: hsl('--chart-1'), c2: hsl('--chart-2'), c3: hsl('--chart-3'),
        c4: hsl('--chart-4'), c5: hsl('--chart-5'),
    };
};

/* ---------------------------------------------------------------
 * Active menu sync
 * ------------------------------------------------------------- */
const normalize = (u) => (u.pathname.replace(/\/+$/, '') || '/') + u.hash;
window.syncMenuActive = () => {
    if (!location.hash) return;
    const want = normalize(location);
    const links = [...document.querySelectorAll('aside a.nav-sub[href]')];
    const match = links.find((a) => {
        try { return normalize(new URL(a.href, location.origin)) === want; } catch (e) { return false; }
    });
    if (!match) return;
    document.querySelectorAll('aside .nav-sub.active').forEach((el) => el.classList.remove('active'));
    match.classList.add('active');
};

const triggerCardAnimations = () => {
    const mainContent = document.querySelector('main > div');
    if (mainContent) {
        const cards = mainContent.querySelectorAll('.ak-card');
        cards.forEach((card, index) => {
            card.style.animationDelay = `${index * 45}ms`;
        });
        mainContent.offsetHeight;
        mainContent.classList.add('animate-cards');
    }
};

/* ---------------------------------------------------------------
 * Global pointer coordinate tracker
 * pointerdown always fires with valid clientX/Y on BOTH touch and
 * mouse — even on real mobile Chrome where synthesized @click
 * events have clientX/Y = 0. This is more reliable than touchstart.
 * ------------------------------------------------------------- */
window._lastPointerX = null;
window._lastPointerY = null;
document.addEventListener('pointerdown', (e) => {
    if (e.clientX !== 0 || e.clientY !== 0) {
        window._lastPointerX = e.clientX;
        window._lastPointerY = e.clientY;
    }
}, { passive: true });

const initAos = () => {
    if (typeof IntersectionObserver === 'undefined') return;
    const aosElements = document.querySelectorAll('[data-aos]');
    if (!aosElements.length) return;

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('aos-animate');
            }
        });
    }, { threshold: 0.05, rootMargin: '0px 0px -20px 0px' });

    aosElements.forEach(el => observer.observe(el));
};
window.initAos = initAos;

/* ---------------------------------------------------------------
 * Boot & Livewire Navigation hooks for zero-FOUC transitions
 * ------------------------------------------------------------- */
document.addEventListener('DOMContentLoaded', () => {
    registerUIStore();
    renderIcons();
    syncMenuActive();
    triggerCardAnimations();
    initAos();

    if (typeof MutationObserver !== 'undefined') {
        const observer = new MutationObserver((mutations) => {
            if (isRenderingIcons) return;
            let hasLucide = false;
            for (const m of mutations) {
                for (const node of m.addedNodes) {
                    if (node.nodeType === 1) {
                        if (node.hasAttribute?.('data-lucide') || node.querySelector?.('[data-lucide]')) {
                            hasLucide = true;
                            break;
                        }
                    }
                }
                if (hasLucide) break;
            }
            if (hasLucide) renderIcons();
        });
        observer.observe(document.body, { childList: true, subtree: true });
    }
});
window.addEventListener('hashchange', () => syncMenuActive());

document.addEventListener('livewire:navigating', () => {
    window.lastNavigateStart = Date.now();
    if (window.Alpine && Alpine.store('ui')) {
        const ui = Alpine.store('ui');
        document.documentElement.dataset.sidebarColor = ui.sidebarColor;
        document.documentElement.dataset.navbarColor = ui.navbarColor;
        document.documentElement.style.setProperty('--custom-sb-grad-from', ui.sidebarGradientFrom);
        document.documentElement.style.setProperty('--custom-sb-grad-to', ui.sidebarGradientTo);
        document.documentElement.style.setProperty('--custom-nb-grad-from', ui.navbarGradientFrom);
        document.documentElement.style.setProperty('--custom-nb-grad-to', ui.navbarGradientTo);

        // Inject fullscreen loader immediately on navigate start
        if (ui.pageLoading) {
            let loader = document.getElementById('global-page-loader');
            if (!loader) {
                loader = document.createElement('div');
                loader.id = 'global-page-loader';
                loader.style.opacity = '0';
                loader.innerHTML = `
                    <div class="loader-content">
                        <div class="relative flex items-center justify-center">
                            <div class="size-12 animate-spin rounded-full border-4 border-muted border-t-primary"></div>
                        </div>
                        <p class="mt-4 text-xs font-semibold tracking-wide text-muted-foreground uppercase animate-pulse text-center">Preparing Workspace...</p>
                    </div>
                `;
                document.documentElement.appendChild(loader);
                // Trigger a reflow
                loader.offsetHeight;
            }
            loader.style.opacity = '1';
            const content = loader.querySelector('.loader-content');
            if (content) {
                content.style.transform = 'scale(1)';
                content.style.opacity = '1';
            }
        }
    }
});

document.addEventListener('livewire:navigated', () => {
    registerUIStore();
    if (window.Alpine && Alpine.store('ui')) {
        const ui = Alpine.store('ui');
        ui.apply();
        ui.closeMobileSidebar();

        if (ui.pageLoading && window.lastNavigateStart) {
            const elapsed = Date.now() - window.lastNavigateStart;
            const minDelay = 750; // minimum loading show time in ms
            const loader = document.getElementById('global-page-loader');

            const hideLoader = () => {
                if (loader) {
                    const content = loader.querySelector('.loader-content');
                    if (content) {
                        content.style.transform = 'scale(0.92)';
                        content.style.opacity = '0';
                    }
                    loader.style.opacity = '0';
                    setTimeout(() => {
                        loader.remove();
                        triggerCardAnimations();
                    }, 350);
                } else {
                    triggerCardAnimations();
                }
                window.lastNavigateStart = null;
            };

            if (elapsed < minDelay) {
                setTimeout(hideLoader, minDelay - elapsed);
            } else {
                hideLoader();
            }
        } else {
            triggerCardAnimations();
        }
    } else {
        triggerCardAnimations();
    }
    renderIcons();
    syncMenuActive();
    initAos();
});

document.addEventListener('livewire:init', () => {
    Livewire.hook('request', ({ component, succeed, fail, respond }) => {
        const requestStart = Date.now();
        if (window.Alpine && Alpine.store('ui') && Alpine.store('ui').pageLoading) {
            if (component.el) component.el.classList.add('livewire-loading');
        }
        return ({ succeed, fail, respond }) => {
            const elapsed = Date.now() - requestStart;
            const minComponentDelay = 650; // minimum component loading state time in ms
            if (elapsed < minComponentDelay) {
                setTimeout(() => {
                    if (component.el) component.el.classList.remove('livewire-loading');
                }, minComponentDelay - elapsed);
            } else {
                if (component.el) component.el.classList.remove('livewire-loading');
            }
        }
    });
});
