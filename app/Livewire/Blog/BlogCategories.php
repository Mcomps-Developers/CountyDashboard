<?php

namespace App\Livewire\Blog;

use App\Models\BlogCategory;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class BlogCategories extends Component
{
    public function deleteCategory($rowID)
    {
        try {
            $category = BlogCategory::findOrFail($rowID);
            $category->delete();
            notyf()
                ->position('x', 'right')
                ->position('y', 'top')
                ->success('Category Deleted');
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
        }
    }
    public function render()
    {
        $categories = BlogCategory::orderBy('name')->get();
        return view('livewire.blog.blog-categories', ['categories' => $categories])->layout('layouts.app');
    }
}
