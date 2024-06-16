<?php

namespace App\Livewire\Blog;

use App\Models\BlogCategory;
use Livewire\Component;

class Speeches extends Component
{
    public $slug;
    public function render()
    {
        $category = BlogCategory::where('slug', $this->slug)->first();
        return view('livewire.blog.speeches', ['category' => $category])->layout('layouts.app');
    }
}
