<?php

namespace App\Livewire\Pages;

use App\Models\Slider;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;

class HomeSliders extends Component
{
    use WithPagination;
    public function deleteSlider($rowID)
    {
        try {
            $slider = Slider::findOrFail($rowID);
            $slider->delete();
            notyf()
                ->position('x', 'right')
                ->position('y', 'top')
                ->success('Slider Deleted');
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
        $sliders = Slider::orderByDesc('created_at')->paginate(12);
        return view('livewire.pages.home-sliders', ['sliders' => $sliders])->layout('layouts.app');
    }
}
