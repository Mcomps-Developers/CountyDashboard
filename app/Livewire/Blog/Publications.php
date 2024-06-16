<?php

namespace App\Livewire\Blog;

use Livewire\Component;

class Publications extends Component
{
    public function render()
    {
        return view('livewire.blog.publications')->layout('layouts.app');
    }
}
