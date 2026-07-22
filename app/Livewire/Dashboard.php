<?php

namespace App\Livewire;

use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.dashboard')->layout('components.layouts.app', [
            'title'       => 'Dashboard',
            'breadcrumbs' => [['label' => 'Dashboards'], ['label' => 'Overview']],
        ]);
    }
}
