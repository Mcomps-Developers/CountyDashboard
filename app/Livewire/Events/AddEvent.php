<?php

namespace App\Livewire\Events;

use App\Models\Event;
use App\Models\EventCategory;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class AddEvent extends Component
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


    public function mount($slug)
    {
        $this->slug = $slug;
        $category = EventCategory::where('slug', $this->slug)->first();
        $this->categoryName = $category->name;

    }
    public $tags;
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
        $category = EventCategory::where('slug', $this->slug)->first();
        $this->validate();
        if ($this->coverPhoto) {
            $this->validate([
                'coverPhoto' => 'mimes:png,jpg,jpeg|max:5120',
            ]);
        }
        if ($this->start_date_and_time) {
            $this->validate([
                'start_date_and_time' => 'date',
            ]);
        }
        try {
            $event = new Event();
            $event->title = $this->title;
            $event->description = $this->description;
            $event->slug = Str::slug($this->title, '-');
            $event->location = $this->location;
            $event->featured = $this->featured;
            $event->start_date_and_time = $this->start_date_and_time;
            $event->end_date_and_time = $this->end_date_and_time;
            $event->user_id = Auth::id();
            $event->cat_id = $category->id;
            $event->reference = $this->generateUniqueReference(Event::class, 'reference', 5);
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
        return view('livewire.events.add-event')->layout('layouts.app');
    }
}
