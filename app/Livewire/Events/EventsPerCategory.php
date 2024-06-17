<?php

namespace App\Livewire\Events;

use Livewire\Component;

class EventsPerCategory extends Component
{
    public $slug;
    public function render()
    {
        return view('livewire.events.events-per-category')->layout('layouts.app');
    }
}
