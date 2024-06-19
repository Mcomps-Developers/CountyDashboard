<?php

namespace App\Livewire\Pages;

use App\Models\WelcomeNote;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Intervention\Image\Laravel\Facades\Image;
use Livewire\WithFileUploads;

class HomeWelcome extends Component
{
    use WithFileUploads;
    public $title;
    public $message;
    public $name;
    public $designation;
    public $photo;
    public $quoted_text;
    public $currentPhoto;
    public function mount()
    {
        $note = WelcomeNote::first();
        $this->title = $note->title;
        $this->message = $note->message;
        $this->name = $note->name;
        $this->designation = $note->designation;
        $this->quoted_text = $note->quoted_text;
        $this->currentPhoto = $note->photo;
    }

    protected $rules = [
        'title' => 'required',
        'message' => 'required',
        'name' => 'required',
        'designation' => 'required',
        'quoted_text' => 'required',
    ];

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function saveChanges()
    {
        $this->validate();
        if ($this->photo) {
            $this->validate([
                'photo' => 'mimes:png,jpg,jpeg|max:5120',
            ]);
        }
        try {
            $note = WelcomeNote::first();
            $note->title = $this->title;
            $note->message = $this->message;
            $note->name = $this->name;
            $note->quoted_text = $this->quoted_text;
            $note->designation = $this->designation;
            if ($this->photo) {
                $photoName = Carbon::now()->addMinutes(2)->timestamp . '.' . $this->photo->extension();
                $resizedImage = Image::read($this->photo->getRealPath())->resize(650, 600);
                $destinationPath = base_path('assets/img/governors');
                $resizedImage->save($destinationPath . '/' . $photoName);
                $note->photo = $photoName;
            }
            $note->save();
            notyf()
                ->position('x', 'right')
                ->position('y', 'top')
                ->success('Changes saved successfully.');
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
        return view('livewire.pages.home-welcome')->layout('layouts.app');
    }
}
