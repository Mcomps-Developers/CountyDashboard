<?php

namespace App\Livewire\Events;

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class EditEvent extends Component
{
    use WithFileUploads;
    public $slug;
    public $description;
    public $title;
    public $coverPhoto;
    public $start_date_and_time;
    public $end_date_and_time;
    public $categoryName;
    public $featured;
    public $location;

    public $reference;
    public function mount($reference)
    {
        $this->reference = $reference;
        $event = Event::where('reference', $this->reference)->first();
        $event->title = $this->title;
        $this->description = $event->description;
        $this->location = $event->location;
        $this->featured = $event->featured;
        $this->start_date_and_time = $event->start_date_and_time;
        $this->end_date_and_time = $event->end_date_and_time;

    }
    public $rules = [
        'description' => 'required',
        'title' => 'required',
        'start_date_and_time' => 'required',
        'end_date_and_time' => 'required',
        'location' => 'required',
    ];

    public function updated($fields)
    {
        $this->validateOnly($fields);

    }
    public function saveChanges()
    {
        $event = Event::where('reference', $this->reference)->first();
        $this->validate();
        if ($this->coverPhoto) {
            $this->validate([
                'coverPhoto' => 'mimes:png,jpg,jpeg|max:5120',
            ]);
        }
        try {
            $event = Event::where('reference', $this->reference)->first();
            $event->title = $this->title;
            $event->description = $this->description;
            $event->slug = Str::slug($this->title, '-');
            $event->location = $this->location;
            $event->featured = $this->featured;
            $event->start_date_and_time = $this->start_date_and_time;
            $event->end_date_and_time = $this->end_date_and_time;
            if ($this->coverPhoto) {
                $photoName = Carbon::now()->addMinutes(2)->timestamp . '.' . $this->coverPhoto->extension();
                $resizedImage = Image::read($this->coverPhoto->getRealPath())->resize(1200, 800);
                $destinationPath = base_path('assets/img/events');
                $resizedImage->save($destinationPath . '/' . $photoName);
                $event->image = $photoName;
            }
            $event->save();
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
        $event = Event::where('reference', $this->reference)->first();
        return view('livewire.events.edit-event', ['event' => $event])->layout('layouts.app');
    }
}
