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

const renderIcons = () => createIcons({ icons, attrs: { 'stroke-width': 2 } });
window.renderIcons = renderIcons;

/* Tiny localStorage helper (mirrors the anti-FOUC keys in <head>) */
const LS = {
    get(k, d) { try { const v = localStorage.getItem(k); return v === null ? d : JSON.parse(v); } catch (e) { return d; } },
    set(k, v) { try { localStorage.setItem(k, JSON.stringify(v)); } catch (e) {} },
};

/* ---------------------------------------------------------------
 * Global UI store — theme, direction, layout, sidebar, accent…
 * Registered on Livewire's Alpine instance (survives wire:navigate).
 * ------------------------------------------------------------- */
document.addEventListener('alpine:init', () => {
    Alpine.store('ui', {
        theme: LS.get('ak_theme', 'system'),
        direction: LS.get('ak_dir', 'ltr'),
        layout: LS.get('ak_layout', 'vertical'),
        accent: LS.get('ak_accent', 'blue'),
        radius: LS.get('ak_radius', 'lg'),
        sidebarCollapsed: LS.get('ak_sb_collapsed', false),
        navbarFixed: LS.get('ak_navbar_fixed', true),
        compact: LS.get('ak_compact', false),

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
            html.classList.toggle('sidebar-collapsed', this.sidebarCollapsed);
            html.classList.toggle('is-compact', this.compact);
        },

        setTheme(v) { this.theme = v; LS.set('ak_theme', v); this.apply(); },
        toggleTheme() { this.setTheme(this.isDark ? 'light' : 'dark'); },
        setDirection(v) { this.direction = v; LS.set('ak_dir', v); this.apply(); },
        toggleDirection() { this.setDirection(this.direction === 'rtl' ? 'ltr' : 'rtl'); },
        setLayout(v) { this.layout = v; LS.set('ak_layout', v); this.apply(); },
        setAccent(v) { this.accent = v; LS.set('ak_accent', v); this.apply(); },
        setRadius(v) { this.radius = v; LS.set('ak_radius', v); this.apply(); },
        setCompact(v) { this.compact = v; LS.set('ak_compact', v); this.apply(); },
        toggleSidebar() { this.sidebarCollapsed = !this.sidebarCollapsed; LS.set('ak_sb_collapsed', this.sidebarCollapsed); this.apply(); },
        setNavbarFixed(v) { this.navbarFixed = v; LS.set('ak_navbar_fixed', v); },
        openMobileSidebar() { this.sidebarMobileOpen = true; },
        closeMobileSidebar() { this.sidebarMobileOpen = false; },
    });
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
            // top-start | top-center | top-end | bottom-start | bottom-center | bottom-end
            position: opts.position || 'bottom-end',
            duration: opts.duration ?? 4200,
        },
    }));
};

/* ---------------------------------------------------------------
 * Chart theming helper used by dashboard/chart pages.
 * ------------------------------------------------------------- */
window.akChartTheme = () => {
    const css = getComputedStyle(document.documentElement);
    const hsl = (name) => `hsl(${css.getPropertyValue(name).trim()})`;
    const dark = document.documentElement.classList.contains('dark');
    return {
        primary: hsl('--primary'),
        grid: dark ? 'rgba(255,255,255,.06)' : 'rgba(0,0,0,.06)',
        text: dark ? 'rgba(255,255,255,.55)' : 'rgba(0,0,0,.5)',
        c1: hsl('--chart-1'), c2: hsl('--chart-2'), c3: hsl('--chart-3'),
        c4: hsl('--chart-4'), c5: hsl('--chart-5'),
    };
};

/* ---------------------------------------------------------------
 * Active menu sync — the server marks items active by PATH only, so
 * menu items that share a page and differ only by #hash (e.g. UI
 * Elements sections) can't be told apart server-side. Here we refine
 * the active state client-side using the full path + hash.
 * ------------------------------------------------------------- */
const normalize = (u) => (u.pathname.replace(/\/+$/, '') || '/') + u.hash;
window.syncMenuActive = () => {
    if (!location.hash) return; // path-only URLs: trust the server-rendered active state
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
 * Boot hooks: first load + after every SPA navigation + hash change.
 * ------------------------------------------------------------- */
document.addEventListener('DOMContentLoaded', () => { renderIcons(); syncMenuActive(); });
window.addEventListener('hashchange', () => syncMenuActive());

/* After each SPA navigation, re-apply theme/layout to <html> (Livewire's
   morph resets client-set attributes), re-render icons, refine active. */
document.addEventListener('livewire:navigated', () => {
    if (window.Alpine && Alpine.store('ui')) {
        Alpine.store('ui').apply();
        // On mobile, a nav link keeps the off-canvas sidebar open across the SPA
        // navigation — close it so the new page isn't hidden behind it.
        Alpine.store('ui').closeMobileSidebar();
    }
    renderIcons();
    syncMenuActive();
});
