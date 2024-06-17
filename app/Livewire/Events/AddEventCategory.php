<?php

namespace App\Livewire\Events;

use Livewire\Component;

class AddEventCategory extends Component
{
    public function render()
    {
        return view('livewire.events.add-event-category')->layout('layouts.app');
    }
}
