<?php

namespace App\Livewire\Blog;

use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class AddBlog extends Component
{
    use WithFileUploads;
    public $slug;
    public $content;
    public $title;
    public $photo;
    public $publishing_date;
    private $category_id;
    public $categoryName;


    public function mount($slug)
    {
        $this->slug = $slug;
        $category = BlogCategory::where('slug', $this->slug)->first();
        $this->category_id = $category->id;
        $this->categoryName = $category->name;
    }
    public $tags;
    public $rules = [
        'content' => 'required',
        'title' => 'required',
        'photo' => 'mimes:png,jpg,jpeg|max:5120',
    ];

    public function updated($fields)
    {
        $this->validateOnly($fields);

    }
    public function addSpeech()
    {
        $this->validate();
        try {
            $blog = new Blog();
            $blog->title = $this->title;
            $blog->content = $this->content;
            $blog->slug = Str::slug($this->title, '-');
            $blog->tags = $this->tags;
            $blog->user_id = Auth::id();
            $blog->category_id = $this->category_id;
            $blog->save();
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
        return view('livewire.blog.add-blog')->layout('layouts.app');
    }
}
