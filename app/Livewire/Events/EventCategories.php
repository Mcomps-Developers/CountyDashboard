<?php

namespace App\Livewire\Events;

use App\Models\EventCategory;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class EventCategories extends Component
{
    public function deleteCategory($rowID)
    {
        try {
            $category = EventCategory::findOrFail($rowID);
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
        $categories = EventCategory::orderBy('name')->get();
        return view('livewire.events.event-categories', ['categories' => $categories])->layout('layouts.app');
    }
}
