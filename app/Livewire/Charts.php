<?php

namespace App\Livewire;

use Livewire\Component;

class Charts extends Component
{
    public function render()
    {
        return view('livewire.pages.charts')->layout('components.layouts.app', [
            'title'       => 'Charts',
            'breadcrumbs' => [['label' => 'Maps & Charts'], ['label' => 'Charts']],
        ]);
    }
}
