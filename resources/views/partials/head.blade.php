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

            var accent = get('ak_accent', 'blue');
            d.dataset.accent = accent;

            var accMap = {
                blue: '221 83% 53%',
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
            if (accent === 'midnight' || accent === 'black') {
                d.style.setProperty('--primary', '222 47% 11%');
                d.style.setProperty('--primary-foreground', '0 0% 100%');
                d.style.setProperty('--ring', '222 47% 11%');
                d.style.setProperty('--sidebar-primary', '222 47% 11%');
            } else if (accMap[accent]) {
                d.style.setProperty('--primary', accMap[accent]);
                d.style.setProperty('--ring', accMap[accent]);
                d.style.setProperty('--sidebar-primary', accMap[accent]);
            }

            d.dataset.radius       = get('ak_radius',    'lg');
            d.dataset.layout       = get('ak_layout',    'vertical');
            d.dataset.sidebarColor = get('ak_sb_color', 'dark');
            d.dataset.sidebarStyle = get('ak_sb_style', 'tree');
            d.dataset.navbarColor  = get('ak_nb_color', 'default');
            d.dataset.cardAnimation = get('ak_card_animation', 'fade-up');
            d.dataset.pageLoading  = get('ak_page_loading', false);
            d.dataset.layoutFluid = get('ak_layout_fluid', false);

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
