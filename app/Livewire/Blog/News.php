<?php

namespace App\Livewire\Blog;

use Livewire\Component;

class News extends Component
{
    public function render()
    {
        return view('livewire.blog.news')->layout('layouts.app');
    }
}
