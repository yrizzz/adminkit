<?php

namespace App\Livewire;

use Livewire\Component;

class Tables extends Component
{
    public function render()
    {
        return view('livewire.pages.tables')->layout('components.layouts.app', [
            'title'       => 'Tables',
            'breadcrumbs' => [['label' => 'Forms & Tables'], ['label' => 'Tables']],
        ]);
    }
}
