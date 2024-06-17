<?php

namespace App\Livewire\Blog;

use App\Models\Blog;
use App\Models\BlogCategory as ModelBlogCategory;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;

class BlogCategory extends Component
{
    use WithPagination;
    public $slug;

    public function deleteBlog($rowID)
    {
        try {
            $blog = Blog::findOrFail($rowID);
            $blog->delete();
            notyf()
                ->position('x', 'right')
                ->position('y', 'top')
                ->success('Blog deleted successfully!');
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
        $category = ModelBlogCategory::where('slug', $this->slug)->first();
        $content = Blog::where('category_id', $category->id)->paginate(12);
        return view('livewire.blog.blog-category', ['category' => $category, 'content' => $content])->layout('layouts.app');
    }
}
