import Alpine from 'alpinejs';
import focus from '@alpinejs/focus';
import collapse from '@alpinejs/collapse';
import persist from '@alpinejs/persist';
import { createIcons, icons } from 'lucide';
import Chart from 'chart.js/auto';

/* ---------------------------------------------------------------
 * Third-party globals
 * ------------------------------------------------------------- */
window.Chart = Chart;
window.Alpine = Alpine;

Alpine.plugin(focus);
Alpine.plugin(collapse);
Alpine.plugin(persist);

/* Render / refresh Lucide icons ([data-lucide] -> <svg>) */
const renderIcons = () => createIcons({ icons, attrs: { 'stroke-width': 2 } });
window.renderIcons = renderIcons;

/* ---------------------------------------------------------------
 * Global UI store — theme, direction, layout, sidebar, accent…
 * Persisted to localStorage so preferences survive reloads.
 * ------------------------------------------------------------- */
Alpine.store('ui', {
    theme: Alpine.$persist('system').as('ak_theme'), // light | dark | system
    direction: Alpine.$persist('ltr').as('ak_dir'), // ltr | rtl
    layout: Alpine.$persist('vertical').as('ak_layout'), // vertical | horizontal
    accent: Alpine.$persist('blue').as('ak_accent'),
    radius: Alpine.$persist('lg').as('ak_radius'),
    sidebarCollapsed: Alpine.$persist(false).as('ak_sb_collapsed'),
    navbarFixed: Alpine.$persist(true).as('ak_navbar_fixed'),
    compact: Alpine.$persist(false).as('ak_compact'),

    // transient (not persisted)
    sidebarMobileOpen: false,
    customizerOpen: false,
    commandOpen: false,

    init() {
        this.apply();
        // React to OS theme changes when in "system" mode
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
        html.classList.toggle('is-compact', this.compact);
    },

    setTheme(v) { this.theme = v; this.apply(); },
    toggleTheme() { this.setTheme(this.isDark ? 'light' : 'dark'); },

    setDirection(v) { this.direction = v; this.apply(); },
    toggleDirection() { this.setDirection(this.direction === 'rtl' ? 'ltr' : 'rtl'); },

    setLayout(v) { this.layout = v; this.apply(); },
    setAccent(v) { this.accent = v; this.apply(); },
    setRadius(v) { this.radius = v; this.apply(); },
    setCompact(v) { this.compact = v; this.apply(); },

    toggleSidebar() { this.sidebarCollapsed = !this.sidebarCollapsed; },
    openMobileSidebar() { this.sidebarMobileOpen = true; },
    closeMobileSidebar() { this.sidebarMobileOpen = false; },
});

/* ---------------------------------------------------------------
 * Toast helper (window.toast(...)) dispatched to the toaster.
 * ------------------------------------------------------------- */
window.toast = (message, opts = {}) => {
    window.dispatchEvent(new CustomEvent('toast', {
        detail: { message, variant: opts.variant || 'default', title: opts.title },
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
 * Boot
 * ------------------------------------------------------------- */
Alpine.start();
renderIcons();
document.addEventListener('livewire:navigated', renderIcons);
