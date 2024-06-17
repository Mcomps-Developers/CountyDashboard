<?php

namespace App\Livewire\Blog;

use App\Models\Blog;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Intervention\Image\Laravel\Facades\Image;

class EditBlog extends Component
{
    public $reference;
    public $title;
    public $content;
    public $tags;
    public $publishing_date;
    public $image;
    public $photo;
    private $slug;
    public function mount($reference)
    {
        $this->reference = $reference;
        $blog = Blog::where('reference', $this->reference)->first();
        $this->title = $blog->title;
        $this->content = $blog->content;
        $this->tags = $blog->tags;
        $this->publishing_date = $blog->created_at;
    }
    public $rules = [
        'content' => 'required',
        'title' => 'required',
    ];

    public function updated($fields)
    {
        $this->validateOnly($fields);

    }

    public function updateBlog()
    {
        $blog = Blog::where('reference', $this->reference)->first();
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
            $blog = Blog::where('reference', $this->reference)->first();
            $blog->title = $this->title;
            $blog->content = $this->content;
            $blog->tags = $this->tags;
            $blog->created_at = empty($this->publishing_date) ? Carbon::now() : $this->publishing_date;
            $blog->reference = $this->generateUniqueReference(Blog::class, 'reference', 5);
            if ($this->photo) {
                $photoName = Carbon::now()->addMinutes(2)->timestamp . '.' . $this->photo->extension();
                $resizedImage = Image::read($this->photo->getRealPath())->resize(1200, 800);
                $destinationPath = base_path('assets/img/blogs');
                $resizedImage->save($destinationPath . '/' . $photoName);
                $blog->image = $photoName;
            }
            $blog->save();
            $this->reset();
            notyf()
                ->position('x', 'right')
                ->position('y', 'top')
                ->success('Updated successfuly.');
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

        return view('livewire.blog.edit-blog')->layout('layouts.app');
    }
}
