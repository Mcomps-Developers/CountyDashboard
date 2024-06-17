<?php

namespace App\Livewire\Events;

use App\Models\Event;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Illuminate\Support\Str;

class AddEventCategory extends Component
{
    public $name;
    public $rules = [
        'name' => 'required|unique:event_categories,name',
    ];
    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function addCategory()
    {
        $this->validate();
        try {
            $category = new Event();
            $category->name = $this->name;
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
        return view('livewire.events.add-event-category')->layout('layouts.app');
    }
}
