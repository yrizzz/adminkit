<?php

namespace App\Livewire;

use Livewire\Component;

class Icons extends Component
{
    public function render()
    {
        return view('livewire.pages.icons')->layout('components.layouts.app', [
            'title'       => 'Icons',
            'breadcrumbs' => [['label' => 'Pages'], ['label' => 'Icons']],
        ]);
    }
}
