<?php

namespace App\Livewire\Pages;

use App\Models\Governor;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Intervention\Image\Laravel\Facades\Image;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class TheGovernor extends Component
{
    use WithFileUploads;
    public $welcome_message;
    public $name;
    public $main_manifesto;
    public $office_email;
    public $date_of_birth;
    public $photo;
    public $office_phone;
    public $facebook;
    public $linkedin;
    public $twitter;
    public $instagram;
    public $about;
    public $currentPhoto;
    public function mount()
    {
        $theGovernor = Governor::first();
        if ($theGovernor) {
            $this->welcome_message = $theGovernor->welcome_message;
            $this->name = $theGovernor->name;
            $this->main_manifesto = $theGovernor->main_manifesto;
            $this->date_of_birth = $theGovernor->date_of_birth;
            $this->facebook = $theGovernor->facebook;
            $this->office_email = $theGovernor->office_email;
            $this->office_phone = $theGovernor->office_phone;
            $this->linkedin = $theGovernor->linkedin;
            $this->twitter = $theGovernor->twitter;
            $this->instagram = $theGovernor->instagram;
            $this->about = $theGovernor->about;
            $this->currentPhoto = $theGovernor->photo;
        }
    }

    protected $rules = [
        'welcome_message' => 'required|string|max:750',
        'name' => 'required',
        'main_manifesto' => 'required',
        'date_of_birth' => 'required|date',
        'about' => 'required',
    ];

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function saveChanges()
    {
        $this->validate();
        if ($this->instagram) {
            $this->validate([
                'instagram' => 'url',
            ]);
        }
        if ($this->twitter) {
            $this->validate([
                'twitter' => 'url',
            ]);
        }
        if ($this->photo) {
            $this->validate([
                'photo' => 'mimes:png,jpg,jpeg|max:5120',
            ]);
        }
        if ($this->linkedin) {
            $this->validate([
                'linkedin' => 'url',
            ]);
        }
        if ($this->facebook) {
            $this->validate([
                'facebook' => 'url',
            ]);
        }
        if ($this->office_phone) {
            $this->validate([
                'office_phone' => 'numeric|digits:12',
            ]);
        }
        if ($this->office_email) {
            $this->validate([
                'office_email' => 'email',
            ]);
        }
        try {
            $theGovernor = Governor::first();
            if ($theGovernor) {
                $theGovernor->welcome_message = $this->welcome_message;
                $theGovernor->name = $this->name;
                $theGovernor->date_of_birth = $this->date_of_birth;
                $theGovernor->main_manifesto = $this->main_manifesto;
                $theGovernor->twitter = $this->twitter;
                $theGovernor->instagram = $this->instagram;
                $theGovernor->linkedin = $this->linkedin;
                $theGovernor->facebook = $this->facebook;
                $theGovernor->about = $this->about;
                $theGovernor->office_email = $this->office_email;
                $theGovernor->office_phone = $this->office_phone;
                if ($this->photo) {
                    $photoName = Carbon::now()->addMinutes(2)->timestamp . '.' . $this->photo->extension();
                    $destinationPath = base_path('assets/img/about/governor');
                    $this->photo->storeAs($destinationPath, $photoName);
                    $theGovernor->photo = $photoName;
                }
                $theGovernor->save();
                notyf()
                    ->position('x', 'right')
                    ->position('y', 'top')
                    ->success('Changes saved successfully.');
                return redirect(request()->header('Referer'));
            } else {
                notyf()
                    ->position('x', 'right')
                    ->position('y', 'top')
                    ->error('Ask admin to run seeders');
            }
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
        return view('livewire.pages.the-governor')->layout('layouts.app');
    }
}
