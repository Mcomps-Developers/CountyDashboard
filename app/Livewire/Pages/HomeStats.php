<?php

namespace App\Livewire\Pages;

use Livewire\Component;

class HomeStats extends Component
{
    public function render()
    {
        return view('livewire.pages.home-stats')->layout('layouts.app');
    }
}
