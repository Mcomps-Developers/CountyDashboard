<?php

namespace App\Livewire\Blog;

use App\Models\BlogCategory as ModelBlogCategory;
use Livewire\Component;

class BlogCategory extends Component
{
    public $slug;
    public function render()
    {
        $category = ModelBlogCategory::where('slug', $this->slug)->first();
        return view('livewire.blog.blog-category', ['category' => $category])->layout('layouts.app');
    }
}
