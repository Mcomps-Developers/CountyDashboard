<?php

namespace App\Livewire\Municipalities;

use Livewire\Component;

class AddMunicipality extends Component
{
    public function render()
    {
        return view('livewire.municipalities.add-municipality')->layout('layouts.app');
    }
}
