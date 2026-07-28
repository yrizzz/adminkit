@php($cfg = config('adminkit'))
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>{{ ($title ?? 'Dashboard') . ' — ' . $cfg['name'] }}</title>
<meta name="description" content="{{ $cfg['tagline'] }} — modern, themeable admin panel.">

@php
/* ── Server-side FOUC fix: bake the correct active-nav colour into a <style>
   tag using cookies so it's correct even on wire:navigate (Livewire SPA)
   without waiting for any client-side JavaScript to run.               ── */
$_accentMap = [
    'blue'   => '221 83% 53%', 'violet' => '262 83% 58%', 'green'  => '142 71% 45%',
    'rose'   => '347 77% 50%', 'orange' => '25 95% 53%',  'amber'  => '38 92% 50%',
    'teal'   => '173 80% 40%',
];
$_ac  = $_COOKIE['ak_accent']   ?? 'blue';
$_sb  = $_COOKIE['ak_sb_color'] ?? 'dark';
$_p   = $_accentMap[$_ac]       ?? '221 83% 53%';
$_isColored = ($_sb === 'primary' || str_starts_with($_sb, 'gradient') || str_starts_with($_sb, 'image') || $_sb === 'custom_gradient');
$_isLight   = ($_sb === 'light');
if ($_isColored) {
    $_foucCss = ".nav-link.active:not(.nav-sub){background:rgba(255,255,255,.95)!important;color:hsl({$_p})!important}"
              . ".nav-link.active:not(.nav-sub)::before{background:hsl({$_p})!important}";
} elseif ($_isLight) {
    $_foucCss = ".nav-link.active:not(.nav-sub){background:hsl({$_p})!important;color:#fff!important}"
              . ".nav-link.active:not(.nav-sub)::before{background:hsl({$_p})!important}";
} else {
    $_foucCss = ".nav-link.active:not(.nav-sub){background:hsl({$_p}/.15)!important;color:hsl({$_p})!important}"
              . ".nav-link.active:not(.nav-sub)::before{background:hsl({$_p})!important}";
}
@endphp
{{-- Inline active-nav style: server-rendered so it's correct on hard reload AND wire:navigate --}}
<style id="ak-fouc">{{ $_foucCss }}</style>

{{-- Prevent theme flash: apply persisted preferences before first paint --}}
<script>
    (function () {
        try {
            var d = document.documentElement;
            var get = function (k, def) {
                try { var v = localStorage.getItem(k); return v === null ? def : JSON.parse(v); }
                catch (e) { return def; }
            };
            var theme = get('ak_theme', 'system');
            var dark = theme === 'dark' || (theme === 'system' && matchMedia('(prefers-color-scheme: dark)').matches);
            d.classList.toggle('dark', dark);
            d.setAttribute('dir', get('ak_dir', 'ltr'));
            d.dataset.accent = get('ak_accent', 'blue');
            d.dataset.radius = get('ak_radius', 'lg');
            d.dataset.layout = get('ak_layout', 'vertical');
            d.dataset.sidebarColor = get('ak_sb_color', 'dark');
            d.dataset.navbarColor = get('ak_nb_color', 'default');
            d.style.setProperty('--custom-sb-grad-from', get('ak_sb_grad_from', '#1e1b4b'));
            d.style.setProperty('--custom-sb-grad-to',   get('ak_sb_grad_to',   '#0f172a'));
            d.style.setProperty('--custom-nb-grad-from', get('ak_nb_grad_from', '#1e1b4b'));
            d.style.setProperty('--custom-nb-grad-to',   get('ak_nb_grad_to',   '#0f172a'));
            d.classList.toggle('sidebar-collapsed', get('ak_sb_collapsed', false));
            if (get('ak_compact', false)) d.classList.add('is-compact');

            /* Fallback: also update #ak-fouc via JS in case localStorage differs from cookie */
            var accentMap = {
                blue:'221 83% 53%',violet:'262 83% 58%',green:'142 71% 45%',
                rose:'347 77% 50%',orange:'25 95% 53%',amber:'38 92% 50%',teal:'173 80% 40%',
            };
            var ac = get('ak_accent', 'blue'), p = accentMap[ac] || '221 83% 53%';
            var sb = get('ak_sb_color', 'dark');
            var isColored = (sb === 'primary' || sb.indexOf('gradient') === 0 || sb.indexOf('image') === 0 || sb === 'custom_gradient');
            var isLight   = (sb === 'light');
            var css = isColored
                ? '.nav-link.active:not(.nav-sub){background:rgba(255,255,255,.95)!important;color:hsl('+p+')!important}.nav-link.active:not(.nav-sub)::before{background:hsl('+p+')!important}'
                : isLight
                ? '.nav-link.active:not(.nav-sub){background:hsl('+p+')!important;color:#fff!important}.nav-link.active:not(.nav-sub)::before{background:hsl('+p+')!important}'
                : '.nav-link.active:not(.nav-sub){background:hsl('+p+'/.15)!important;color:hsl('+p+')!important}.nav-link.active:not(.nav-sub)::before{background:hsl('+p+')!important}';
            var el = document.getElementById('ak-fouc');
            if (el) el.textContent = css;

            /* Suppress transitions on first paint */
            d.classList.add('no-transition');
            requestAnimationFrame(function () {
                requestAnimationFrame(function () { d.classList.remove('no-transition'); });
            });
        } catch (e) {}
    })();
</script>

@vite(['resources/css/app.css', 'resources/js/app.js'])
@livewireStyles
@stack('head')
