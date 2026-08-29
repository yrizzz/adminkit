<?php

namespace App\Livewire;

use App\Support\Menu;
use Illuminate\Support\Str;
use Livewire\Component;

class GenericPage extends Component
{
    public string $path;

    public function mount(string $path): void
    {
        $this->path = $path;
    }

    public function render()
    {
        $trail = Menu::trail($this->path);
        $title = $trail ? end($trail) : (string) Str::of($this->path)->replace('-', ' ')->title();

        $crumbs = Menu::breadcrumbs($this->path);
        if (empty($crumbs)) {
            $crumbs = [['label' => $title, 'href' => null]];
        }

        // Use a real, hand-built page when one exists for this slug; otherwise
        // fall back to the ready-to-fill scaffold.
        $custom = 'livewire.pages.content.'.$this->path;
        $view = view()->exists($custom) ? $custom : 'livewire.pages.generic';

        $section = $trail[0] ?? 'Pages';

        $page = view($view, [
            'pageTitle' => $title,
            'section'   => $section,
        ]);

        // Authentication and Error screens get their own standalone, full-screen
        // layout — no sidebar or navbar, the page paints the whole viewport itself.
        $standalonePaths = [
            'landing',
            'docs',
            'sign-in', 'sign-in-2', 'sign-up', 'sign-up-2',
            'lock-screen', 'lock-screen-2', 'reset-password', 'reset-password-2',
            'create-password', 'two-step-verification', 'coming-soon',
            'under-maintenance', 'no-internet',
        ];

        if (in_array($section, ['Authentication', 'Error'], true)
            || in_array($this->path, $standalonePaths, true)
            || str_starts_with($this->path, 'error-')) {
            return $page->layout('components.layouts.auth', ['title' => $title]);
        }


        return $page->layout('components.layouts.app', [
            'title'       => $title,
            'breadcrumbs' => $crumbs,
        ]);
    }
}
