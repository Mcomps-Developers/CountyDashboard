<?php

namespace App\Livewire\Elements;

use App\Models\BlogCategory;
use Livewire\Component;

class Sidebar extends Component
{
    public function render()
    {
        $categories = BlogCategory::orderBy('name')->get();
        return view('livewire.elements.sidebar', ['categories' => $categories]);
    }
}
