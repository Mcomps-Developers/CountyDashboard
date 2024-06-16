<?php

namespace App\Livewire\Blog;

use App\Models\Blog;
use App\Models\BlogCategory;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;

class AddBlog extends Component
{
    use WithFileUploads;
    public $slug;
    public $content;
    public $title;
    public $photo;
    public $publishing_date;
    public $categoryName;


    public function mount($slug)
    {
        $this->slug = $slug;
        $category = BlogCategory::where('slug', $this->slug)->first();
        $this->categoryName = $category->name;

    }
    public $tags;
    public $rules = [
        'content' => 'required',
        'title' => 'required',
    ];

    public function updated($fields)
    {
        $this->validateOnly($fields);

    }

    private function generateUniqueReference($model, $column, $length = 5)
    {
        do {
            $reference = Str::random($length);
            $exists = $model::where($column, $reference)->exists();
        } while ($exists);

        return $reference;
    }
    public function addSpeech()
    {
        $category = BlogCategory::where('slug', $this->slug)->first();
        $this->validate();
        if ($this->photo) {
            $this->validate([
                'photo' => 'mimes:png,jpg,jpeg|max:5120',
            ]);
        }
        if ($this->publishing_date) {
            $this->validate([
                'publishing_date' => 'date',
            ]);
        }
        try {
            $blog = new Blog();
            $blog->title = $this->title;
            $blog->content = $this->content;
            $blog->slug = Str::slug($this->title, '-');
            $blog->tags = $this->tags;
            $blog->created_at = empty($this->publishing_date) ? Carbon::now() : $this->publishing_date;
            $blog->user_id = Auth::id();

            $blog->category_id = $category->id;
            $blog->reference = $this->generateUniqueReference(Blog::class, 'reference', 5);
            if ($this->photo) {
                $photoName = Carbon::now()->addMinutes(2)->timestamp . '.' . $this->photo->extension();
                $resizedImage = Image::read($this->photo->getRealPath())->resize(295, 300);
                $destinationPath = public_path('assets/img/blogs');
                $resizedImage->save($destinationPath . '/' . $photoName);
                $blog->image = $photoName;
            }
            $blog->save();
            $this->reset();
            notyf()
                ->position('x', 'right')
                ->position('y', 'top')
                ->success('Created successfuly.');
            return redirect(request()->header('Referer'));
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
