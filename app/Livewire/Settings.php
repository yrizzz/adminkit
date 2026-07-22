<?php

namespace App\Livewire;

use Livewire\Component;

class Settings extends Component
{
    public function render()
    {
        return view('livewire.pages.settings')->layout('components.layouts.app', [
            'title'       => 'Settings',
            'breadcrumbs' => [['label' => 'Pages'], ['label' => 'Settings']],
        ]);
    }
}
