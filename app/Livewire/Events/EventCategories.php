<?php

namespace App\Livewire\Events;

use Livewire\Component;

class EventCategories extends Component
{
    public function render()
    {
        return view('livewire.events.event-categories')->layout('layouts.app');
    }
}
