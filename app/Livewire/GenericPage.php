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

        return view($view, [
            'pageTitle' => $title,
            'section'   => $trail[0] ?? 'Pages',
        ])->layout('components.layouts.app', [
            'title'       => $title,
            'breadcrumbs' => $crumbs,
        ]);
    }
}
