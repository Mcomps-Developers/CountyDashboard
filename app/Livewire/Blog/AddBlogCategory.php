<?php

namespace App\Livewire\Blog;

use App\Models\BlogCategory;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Illuminate\Support\Str;

class AddBlogCategory extends Component
{
    public $name;
    public $description;
    public $rules = [
        'name' => 'required|unique:blog_categories,name',
        'description'=>'required',
    ];
    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function addCategory()
    {
        $this->validate();
        try {
            $category = new BlogCategory();
            $category->name = $this->name;
            $category->description = $this->description;
            $category->slug = Str::slug($this->name, '-');
            $category->save();
            $this->reset();
            notyf()
                ->position('x', 'right')
                ->position('y', 'top')
                ->success('Category Created');

        } catch (\Throwable $th) {
            Log::error('An unexpected error occurred.', [
                'error_message' => $th->getMessage(),
                'file' => $th->getFile(),
                'line' => $th->getLine(),
                'stack_trace' => $th->getTraceAsString()
            ]);
            notyf()
                ->position('x', 'right')
                ->position('y', 'top')
                ->error('Error occurred. Try later');
            return redirect(request()->header('Referer'));
        } catch (\Exception $ex) {
            Log::warning('An exception occurred.', [
                'error_message' => $ex->getMessage(),
                'file' => $ex->getFile(),
                'line' => $ex->getLine(),
                'stack_trace' => $ex->getTraceAsString()
            ]);
            notyf()
                ->position('x', 'right')
                ->position('y', 'top')
                ->error('Error occurred. Try later');
            return redirect(request()->header('Referer'));
        }

    }
    public function render()
    {
        return view('livewire.blog.add-blog-category')->layout('layouts.app');
    }

}
