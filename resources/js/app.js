import { createIcons, icons } from 'lucide';
import Chart from 'chart.js/auto';

/* ---------------------------------------------------------------
 * Third-party globals. Alpine is provided by Livewire (bundled),
 * so we don't import/start it here — we register onto it instead.
 * ------------------------------------------------------------- */
window.Chart = Chart;

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

const renderIcons = () => createIcons({ icons, attrs: { 'stroke-width': 2 } });
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
        navbarColor: LS.get('ak_nb_color', 'default'),
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
            html.dataset.radius = this.radius;
            html.dataset.layout = this.layout;
            html.dataset.sidebarColor = this.sidebarColor;
            html.dataset.navbarColor = this.navbarColor;
            html.classList.toggle('sidebar-collapsed', this.sidebarCollapsed);
            html.classList.toggle('is-compact', this.compact);

            html.style.setProperty('--custom-sb-grad-from', this.sidebarGradientFrom);
            html.style.setProperty('--custom-sb-grad-to', this.sidebarGradientTo);
            html.style.setProperty('--custom-nb-grad-from', this.navbarGradientFrom);
            html.style.setProperty('--custom-nb-grad-to', this.navbarGradientTo);

            /* Keep Chart.js global defaults in sync with dark/light mode */
            if (window.applyChartDefaults) window.applyChartDefaults();

            const aside = document.querySelector('aside.main-sidebar');
            if (aside) aside.setAttribute('data-sidebar-color', this.sidebarColor);
            const header = document.querySelector('header');
            if (header) header.setAttribute('data-navbar-color', this.navbarColor);
        },

        setTheme(v) { this.theme = v; LS.set('ak_theme', v); this.apply(); },
        toggleTheme() { this.setTheme(this.isDark ? 'light' : 'dark'); },
        setDirection(v) { this.direction = v; LS.set('ak_dir', v); this.apply(); },
        toggleDirection() { this.setDirection(this.direction === 'rtl' ? 'ltr' : 'rtl'); },
        setLayout(v) { this.layout = v; LS.set('ak_layout', v); this.apply(); },
        setAccent(v) { this.accent = v; LS.set('ak_accent', v); this.apply(); },
        setRadius(v) { this.radius = v; LS.set('ak_radius', v); this.apply(); },
        setCompact(v) { this.compact = v; LS.set('ak_compact', v); this.apply(); },
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
        openMobileSidebar() { this.sidebarMobileOpen = true; },
        closeMobileSidebar() { this.sidebarMobileOpen = false; },
    };

    try {
        if (window.Alpine.store('ui')) {
            Object.assign(window.Alpine.store('ui'), storeObj);
            window.Alpine.store('ui').apply();
        } else {
            window.Alpine.store('ui', storeObj);
        }
    } catch (e) {
        window.Alpine.store('ui', storeObj);
    }
};

document.addEventListener('alpine:init', registerUIStore);
if (window.Alpine) {
    registerUIStore();
}

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
    const css  = getComputedStyle(document.documentElement);
    const hsl  = (name) => `hsl(${css.getPropertyValue(name).trim()})`;
    const dark = document.documentElement.classList.contains('dark');
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

/* ---------------------------------------------------------------
 * Boot & Livewire Navigation hooks for zero-FOUC transitions
 * ------------------------------------------------------------- */
document.addEventListener('DOMContentLoaded', () => {
    registerUIStore();
    renderIcons();
    syncMenuActive();
});
window.addEventListener('hashchange', () => syncMenuActive());

document.addEventListener('livewire:navigating', () => {
    /* Suppress transitions so the nav active state doesn't flash during page swap */
    document.documentElement.classList.add('no-transition');
    if (window.Alpine && Alpine.store('ui')) {
        const ui = Alpine.store('ui');
        document.documentElement.dataset.sidebarColor = ui.sidebarColor;
        document.documentElement.dataset.navbarColor = ui.navbarColor;
        document.documentElement.style.setProperty('--custom-sb-grad-from', ui.sidebarGradientFrom);
        document.documentElement.style.setProperty('--custom-sb-grad-to', ui.sidebarGradientTo);
        document.documentElement.style.setProperty('--custom-nb-grad-from', ui.navbarGradientFrom);
        document.documentElement.style.setProperty('--custom-nb-grad-to', ui.navbarGradientTo);
    }
});

document.addEventListener('livewire:navigated', () => {
    registerUIStore();
    if (window.Alpine && Alpine.store('ui')) {
        Alpine.store('ui').apply();
        Alpine.store('ui').closeMobileSidebar();
    }
    renderIcons();
    syncMenuActive();
    /* Re-enable transitions after the DOM has settled */
    requestAnimationFrame(() => {
        requestAnimationFrame(() => {
            document.documentElement.classList.remove('no-transition');
        });
    });
});
