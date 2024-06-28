<?php

namespace App\Livewire\Municipalities;

use Livewire\Component;

class EditMunicipality extends Component
{
    public $municipality_id;
    public function render()
    {
        return view('livewire.municipalities.edit-municipality')->layout('layouts.app');
    }
}
