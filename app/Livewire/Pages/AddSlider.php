<?php

namespace App\Livewire\Pages;

use App\Models\Slider;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class AddSlider extends Component
{
    use WithFileUploads;
    public $title;
    public $paragraph_text;
    public $button_text;
    public $button_url;
    public $image;
    public $start_date;
    public $end_date;
    public $status;

    protected $rules = [
        'title' => 'required',
        'start_date' => 'required|date',
        'end_date' => 'required|date',
        'image' => 'required|mimes:png,jpg,jpeg|max:5120',
        'status' => 'required',
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
    public function saveChanges()
    {
        $this->validate();
        if ($this->button_text) {
            $this->validate([
                'button_url' => 'required|url',
            ]);
        }
        try {
            $slider = new Slider();
            $slider->heading = $this->title;
            $slider->start_date = $this->start_date;
            $slider->end_date = $this->end_date;
            $slider->paragraph_text = $this->paragraph_text;
            $slider->button_url = $this->button_url;
            $slider->button_text = $this->button_text;
            $slider->status = $this->status;
            $slider->reference = $this->generateUniqueReference(Slider::class, 'reference', 5);
            if ($this->image) {
                $photoName = Carbon::now()->addMinutes(2)->timestamp . '.' . $this->image->extension();
                $this->image->storeAs('assets/img/sliders', $photoName);
                $slider->image = $photoName;
            }
            $slider->save();
            notyf()
                ->position('x', 'right')
                ->position('y', 'top')
                ->success('Created successfully.');
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
        return view('livewire.pages.add-slider')->layout('layouts.app');
    }
}
