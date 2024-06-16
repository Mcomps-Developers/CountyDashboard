<?php

namespace App\Livewire\Blog;

use App\Models\Blog;
use App\Models\BlogCategory as ModelBlogCategory;
use Livewire\Component;
use Livewire\WithPagination;

class BlogCategory extends Component
{
    use WithPagination;
    public $slug;
    public function render()
    {
        $category = ModelBlogCategory::where('slug', $this->slug)->first();
        $content = Blog::where('category_id', $category->id)->paginate(12);
        return view('livewire.blog.blog-category', ['category' => $category, 'content' => $content])->layout('layouts.app');
    }
}
