<?php

namespace App\Livewire;

use Livewire\Component;

class UiElements extends Component
{
    public function render()
    {
        return view('livewire.pages.ui-elements')->layout('components.layouts.app', [
            'title'       => 'UI Elements',
            'breadcrumbs' => [['label' => 'Web Apps'], ['label' => 'UI Elements']],
        ]);
    }
}
