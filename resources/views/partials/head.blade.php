@php
    $cfg = config('adminkit');
    $title = $title ?? 'Dashboard';
@endphp
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>{{ $title . ' — ' . $cfg['name'] }}</title>
<meta name="description" content="{{ $cfg['tagline'] }} — modern, themeable admin panel.">
<link rel="icon" type="image/svg+xml" href="/favicon.svg">
<link rel="icon" type="image/x-icon" href="/favicon.ico">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16.png">
<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">

{{-- Prevent theme/dark-mode flash before external CSS loads --}}
<script>
    (function () {
        try {
            var d = document.documentElement;
            var get = function (k, def) {
                try { var v = localStorage.getItem(k); return v === null ? def : JSON.parse(v); }
                catch (e) { return def; }
            };
            var theme = get('ak_theme', 'system');
            var dark  = theme === 'dark' || (theme === 'system' && matchMedia('(prefers-color-scheme: dark)').matches);
            d.classList.toggle('dark', dark);
            d.setAttribute('dir', get('ak_dir', 'ltr'));
            d.dataset.accent       = get('ak_accent',    'blue');
            d.dataset.radius       = get('ak_radius',    'lg');
            d.dataset.layout       = get('ak_layout',    'vertical');
            d.dataset.sidebarColor = get('ak_sb_color', 'dark');
            d.dataset.navbarColor  = get('ak_nb_color', 'default');
            d.style.setProperty('--custom-sb-grad-from', get('ak_sb_grad_from', '#1e1b4b'));
            d.style.setProperty('--custom-sb-grad-to',   get('ak_sb_grad_to',   '#0f172a'));
            d.style.setProperty('--custom-nb-grad-from', get('ak_nb_grad_from', '#1e1b4b'));
            d.style.setProperty('--custom-nb-grad-to',   get('ak_nb_grad_to',   '#0f172a'));
            d.classList.toggle('sidebar-collapsed', get('ak_sb_collapsed', false));
            if (get('ak_compact', false)) d.classList.add('is-compact');
        } catch (e) {}
    })();
</script>

@vite(['resources/css/app.css', 'resources/js/app.js'])
@livewireStyles
@stack('head')
