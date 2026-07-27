<?php

namespace App\Livewire;

use Livewire\Component;

class Kanban extends Component
{
    public function render()
    {
        return view('livewire.pages.kanban')->layout('components.layouts.app', [
            'title'       => 'Kanban Board',
            'breadcrumbs' => [['label' => 'Apps'], ['label' => 'Kanban Board']],
        ]);
    }
}
