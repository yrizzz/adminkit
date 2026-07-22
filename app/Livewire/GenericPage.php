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

        $crumbs = ! empty($trail)
            ? array_map(fn ($label) => ['label' => $label], $trail)
            : [['label' => $title]];

        return view('livewire.pages.generic', [
            'pageTitle' => $title,
            'section'   => $trail[0] ?? 'Pages',
        ])->layout('components.layouts.app', [
            'title'       => $title,
            'breadcrumbs' => $crumbs,
        ]);
    }
}
