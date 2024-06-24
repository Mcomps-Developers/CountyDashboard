<?php

namespace App\Livewire\Pages;

use Livewire\Component;

class PublicService extends Component
{
    public $content;
    public function render()
    {
        return view('livewire.pages.public-service')->layout('layouts.app');
    }
}
