<?php

namespace App\Livewire;

use Livewire\Component;

class Widgets extends Component
{
    public function render()
    {
        return view('livewire.pages.widgets')->layout('components.layouts.app', [
            'title'       => 'Widgets',
            'breadcrumbs' => [['label' => 'Pages'], ['label' => 'Widgets']],
        ]);
    }
}
