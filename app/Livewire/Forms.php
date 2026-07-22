<?php

namespace App\Livewire;

use Livewire\Component;

class Forms extends Component
{
    public function render()
    {
        return view('livewire.pages.forms')->layout('components.layouts.app', [
            'title'       => 'Forms',
            'breadcrumbs' => [['label' => 'Forms & Tables'], ['label' => 'Forms']],
        ]);
    }
}
