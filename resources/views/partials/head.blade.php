@php($cfg = config('adminkit'))
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>{{ ($title ?? 'Dashboard') . ' — ' . $cfg['name'] }}</title>
<meta name="description" content="{{ $cfg['tagline'] }} — modern, themeable admin panel.">

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
            if (get('ak_compact', false)) d.classList.add('is-compact');
        } catch (e) {}
    })();
</script>

@vite(['resources/css/app.css', 'resources/js/app.js'])
@stack('head')
