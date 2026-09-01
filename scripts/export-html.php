<?php

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use App\Models\User;

require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// Clear compiled views so custom directives take effect
\Illuminate\Support\Facades\Artisan::call('view:clear');

// Override @script and @endscript directives for static HTML export
Blade::directive('script', function () {
    return '<?php ob_start(); ?>';
});
Blade::directive('endscript', function () {
    return '<?php $__scriptContent = ob_get_clean(); $__rawScript = preg_replace("/^\s*<script[^>]*>|<\/script>\s*$/i", "", $__scriptContent); echo "<script>document.addEventListener(\'DOMContentLoaded\', function() { " . $__rawScript . " });</script>"; ?>';
});

// Authenticate dummy user for Blade views expecting auth()->user()
$user = new User([
    'id' => 1,
    'name' => 'Yrizzz',
    'email' => 'admin@adminkit.io',
]);
Auth::setUser($user);

$distDir = __DIR__ . '/../dist';
if (File::exists($distDir)) {
    File::deleteDirectory($distDir);
}
File::makeDirectory($distDir, 0755, true);
File::makeDirectory($distDir . '/assets', 0755, true);
File::makeDirectory($distDir . '/dashboards', 0755, true);
File::makeDirectory($distDir . '/pages', 0755, true);
File::makeDirectory($distDir . '/pages/content', 0755, true);
File::makeDirectory($distDir . '/auth', 0755, true);

// 1. Copy build assets to dist/assets
$buildAssetDir = __DIR__ . '/../public/build/assets';
if (File::exists($buildAssetDir)) {
    File::copyDirectory($buildAssetDir, $distDir . '/assets');
}

// Find main CSS and JS files
$cssFile = '';
$jsFile = '';
$fontsCssFile = '';
foreach (File::files($distDir . '/assets') as $file) {
    $filename = $file->getFilename();
    if (str_starts_with($filename, 'app-') && str_ends_with($filename, '.css')) {
        $cssFile = $filename;
    }
    if (str_starts_with($filename, 'app-') && str_ends_with($filename, '.js')) {
        $jsFile = $filename;
    }
    if (str_starts_with($filename, 'fonts-') && str_ends_with($filename, '.css')) {
        $fontsCssFile = $filename;
    }
}

// Copy public icons & favicons if exist
foreach (['favicon.ico', 'favicon.svg', 'favicon-32.png', 'favicon-16.png', 'apple-touch-icon.png'] as $fav) {
    if (File::exists(__DIR__ . '/../public/' . $fav)) {
        File::copy(__DIR__ . '/../public/' . $fav, $distDir . '/' . $fav);
    }
}

echo "Assets prepared in dist/assets\n";

function getDepthPrefix($targetPath) {
    $parts = explode('/', trim($targetPath, '/'));
    $count = count($parts) - 1;
    return $count > 0 ? str_repeat('../', $count) : './';
}

function processHtmlContent($html, $targetRelativePath, $cssFile, $jsFile, $fontsCssFile) {
    $prefix = getDepthPrefix($targetRelativePath);
    
    // Replace Vite asset injection with static CSS/JS references in head (no defer for instant JS boot)
    $headAssets = '';
    if ($fontsCssFile) {
        $headAssets .= '<link rel="stylesheet" href="' . $prefix . 'assets/' . $fontsCssFile . '">' . "\n";
    }
    if ($cssFile) {
        $headAssets .= '<link rel="stylesheet" href="' . $prefix . 'assets/' . $cssFile . '">' . "\n";
    }
    if ($jsFile) {
        $headAssets .= '<script src="' . $prefix . 'assets/' . $jsFile . '"></script>' . "\n";
    }
    
    // Clean up Vite development tags & injection
    $html = preg_replace('/<script type="module" src="http:\/\/localhost:[0-9]+\/@vite\/client"><\/script>/i', '', $html);
    $html = preg_replace('/<script type="module" src="[^"]+resources\/js\/app\.js"><\/script>/i', '', $html);
    $html = preg_replace('/<link rel="stylesheet" href="[^"]+resources\/css\/app\.css">/i', '', $html);
    
    // Inject generated CSS and JS assets before </head>
    $html = str_replace('</head>', $headAssets . '</head>', $html);
    
    // Clean up Livewire script/style tags & attributes
    $html = preg_replace('/<script [^>]*livewire[^>]*>.*?<\/script>/is', '', $html);
    $html = preg_replace('/<style [^>]*livewire[^>]*>.*?<\/style>/is', '', $html);
    $html = preg_replace('/wire:id="[^"]*"/', '', $html);
    $html = preg_replace('/wire:snapshot="[^"]*"/', '', $html);

    // Update internal routes to relative static HTML filenames
    $urlReplacements = [
        'http://localhost:8000/dashboard' => $prefix . 'index.html',
        'http://localhost/dashboard' => $prefix . 'index.html',
        'href="/dashboard"' => 'href="' . $prefix . 'index.html"',
        'href="/"' => 'href="' . $prefix . 'pages/content/landing.html"',
        'href="/ui/elements"' => 'href="' . $prefix . 'pages/ui-elements.html"',
        'href="/ui/icons"' => 'href="' . $prefix . 'pages/icons.html"',
        'href="/widgets"' => 'href="' . $prefix . 'pages/widgets.html"',
        'href="/tables"' => 'href="' . $prefix . 'pages/tables.html"',
        'href="/charts"' => 'href="' . $prefix . 'pages/charts.html"',
        'href="/forms"' => 'href="' . $prefix . 'pages/forms.html"',
        'href="/settings"' => 'href="' . $prefix . 'pages/settings.html"',
        'href="/apps/kanban"' => 'href="' . $prefix . 'pages/kanban.html"',
        'href="/docs"' => 'href="' . $prefix . 'pages/content/docs.html"',
        'href="/login"' => 'href="' . $prefix . 'auth/login.html"',
        'href="/register"' => 'href="' . $prefix . 'auth/register.html"',
        'href="/forgot-password"' => 'href="' . $prefix . 'auth/forgot-password.html"',
    ];

    // Dynamic routes: /dashboards/{name} -> dashboards/{name}.html
    $html = preg_replace_callback('/href="\/dashboards\/([a-zA-Z0-9_\-]+)"/', function($matches) use ($prefix) {
        return 'href="' . $prefix . 'dashboards/' . $matches[1] . '.html"';
    }, $html);

    // Dynamic routes: /page/{path} -> pages/content/{path}.html
    $html = preg_replace_callback('/href="\/page\/([a-zA-Z0-9_\-\/]+)"/', function($matches) use ($prefix) {
        $cleanPath = str_replace('/', '-', $matches[1]);
        return 'href="' . $prefix . 'pages/content/' . $cleanPath . '.html"';
    }, $html);

    foreach ($urlReplacements as $from => $to) {
        $html = str_replace($from, $to, $html);
    }

    $html = preg_replace('/<meta name="csrf-token" content="[^"]*">/', '<meta name="csrf-token" content="static-html-token">', $html);

    // Inject icon rendering trigger at bottom of body
    $iconInit = '<script>document.addEventListener("DOMContentLoaded", function() { if (window.renderIcons) window.renderIcons(); });</script>';
    $html = str_replace('</body>', $iconInit . '</body>', $html);

    return $html;
}

function renderFullPageFromView($viewName, $data = [], $title = 'Dashboard') {
    $data['pageTitle'] = $data['pageTitle'] ?? $title;
    $data['subtitle'] = $data['subtitle'] ?? 'Real-time telemetries, revenue metrics & workspace activity.';
    $data['pageDesc'] = $data['pageDesc'] ?? 'Overview & activity metrics.';
    $data['breadcrumbs'] = $data['breadcrumbs'] ?? [['label' => 'Pages'], ['label' => $title]];
    $data['path'] = $data['path'] ?? 'overview';
    $data['section'] = $data['section'] ?? 'Main';

    $content = View::make($viewName, $data)->render();
    $layout = View::make('components.layouts.app', ['title' => $title, 'slot' => new \Illuminate\Support\HtmlString($content)])->render();
    return $layout;
}

$renderedCount = 0;

// 1. Dashboard Main -> index.html & dashboard.html
echo "Rendering Main Dashboard...\n";
$mainDashHtml = renderFullPageFromView('livewire.dashboard', [], 'Dashboard');
$processedMain = processHtmlContent($mainDashHtml, 'index.html', $cssFile, $jsFile, $fontsCssFile);
File::put($distDir . '/index.html', $processedMain);
File::put($distDir . '/dashboard.html', processHtmlContent($mainDashHtml, 'dashboard.html', $cssFile, $jsFile, $fontsCssFile));
$renderedCount += 2;

// 2. Dashboards (dashboards/*.blade.php)
$dashFiles = File::files(__DIR__ . '/../resources/views/livewire/dashboards');
foreach ($dashFiles as $file) {
    $name = str_replace('.blade.php', '', $file->getFilename());
    $title = ucfirst($name) . ' Dashboard';
    echo "Rendering Dashboard: {$name}...\n";
    try {
        $html = renderFullPageFromView('livewire.dashboards.' . $name, ['path' => $name, 'subtitle' => "Real-time {$name} telemetries and analytics."], $title);
        $processed = processHtmlContent($html, 'dashboards/' . $name . '.html', $cssFile, $jsFile, $fontsCssFile);
        File::put($distDir . '/dashboards/' . $name . '.html', $processed);
        $renderedCount++;
    } catch (\Throwable $e) {
        echo "Warning: Error rendering dashboard {$name}: " . $e->getMessage() . "\n";
    }
}

// 3. Main Livewire Pages
$pageFiles = File::files(__DIR__ . '/../resources/views/livewire/pages');
foreach ($pageFiles as $file) {
    $name = str_replace('.blade.php', '', $file->getFilename());
    $title = ucfirst(str_replace('-', ' ', $name));
    echo "Rendering Page: {$name}...\n";
    try {
        $html = renderFullPageFromView('livewire.pages.' . $name, ['path' => $name], $title);
        $processed = processHtmlContent($html, 'pages/' . $name . '.html', $cssFile, $jsFile, $fontsCssFile);
        File::put($distDir . '/pages/' . $name . '.html', $processed);
        $renderedCount++;
    } catch (\Throwable $e) {
        echo "Warning: Error rendering page {$name}: " . $e->getMessage() . "\n";
    }
}

// 4. Content pages (pages/content/*.blade.php)
$contentFiles = File::files(__DIR__ . '/../resources/views/livewire/pages/content');
foreach ($contentFiles as $file) {
    $name = str_replace('.blade.php', '', $file->getFilename());
    $title = ucfirst(str_replace('-', ' ', $name));
    echo "Rendering Content Page: {$name}...\n";
    try {
        $html = renderFullPageFromView('livewire.pages.content.' . $name, ['path' => $name], $title);
        $targetFile = 'pages/content/' . $name . '.html';
        $processed = processHtmlContent($html, $targetFile, $cssFile, $jsFile, $fontsCssFile);
        File::put($distDir . '/' . $targetFile, $processed);
        $renderedCount++;
    } catch (\Throwable $e) {
        echo "Warning: Error rendering content page {$name}: " . $e->getMessage() . "\n";
    }
}

// 5. Auth pages
$authViews = [
    'login' => ['view' => 'livewire.pages.content.sign-in', 'title' => 'Sign In'],
    'register' => ['view' => 'livewire.pages.content.sign-up', 'title' => 'Sign Up'],
    'forgot-password' => ['view' => 'livewire.pages.content.reset-password', 'title' => 'Reset Password'],
    'lock-screen' => ['view' => 'livewire.pages.content.lock-screen', 'title' => 'Lock Screen'],
];
foreach ($authViews as $key => $conf) {
    echo "Rendering Auth: {$key}...\n";
    try {
        if (View::exists($conf['view'])) {
            $content = View::make($conf['view'], ['pageTitle' => $conf['title'], 'path' => $key])->render();
            $html = View::exists('components.layouts.guest')
                ? View::make('components.layouts.guest', ['title' => $conf['title'], 'slot' => new \Illuminate\Support\HtmlString($content)])->render()
                : $content;
            $processed = processHtmlContent($html, 'auth/' . $key . '.html', $cssFile, $jsFile, $fontsCssFile);
            File::put($distDir . '/auth/' . $key . '.html', $processed);
            $renderedCount++;
        }
    } catch (\Throwable $e) {
        echo "Warning: Error rendering auth page {$key}: " . $e->getMessage() . "\n";
    }
}

echo "\nSUCCESS! Successfully generated {$renderedCount} static HTML pages in dist/\n";
