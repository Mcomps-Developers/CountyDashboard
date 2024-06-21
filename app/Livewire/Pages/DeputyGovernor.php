<?php

namespace App\Livewire\Pages;

use App\Models\DeputyGovernor as ModelsDeputyGovernor;
use App\Models\Governor;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class DeputyGovernor extends Component
{
    use WithFileUploads;
    public $welcome_message;
    public $name;
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
        $deputyGovernor = ModelsDeputyGovernor::first();
        if ($deputyGovernor) {
            $this->welcome_message = $deputyGovernor->welcome_message;
            $this->name = $deputyGovernor->name;
            $this->date_of_birth = $deputyGovernor->date_of_birth;
            $this->facebook = $deputyGovernor->facebook;
            $this->office_email = $deputyGovernor->office_email;
            $this->office_phone = $deputyGovernor->office_phone;
            $this->linkedin = $deputyGovernor->linkedin;
            $this->twitter = $deputyGovernor->twitter;
            $this->instagram = $deputyGovernor->instagram;
            $this->about = $deputyGovernor->about;
            $this->currentPhoto = $deputyGovernor->photo;
        }
    }

    protected $rules = [
        'welcome_message' => 'required|string|max:750',
        'name' => 'required',
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
            $deputyGovernor = ModelsDeputyGovernor::first();
            if ($deputyGovernor) {
                $deputyGovernor->welcome_message = $this->welcome_message;
                $deputyGovernor->name = $this->name;
                $deputyGovernor->date_of_birth = $this->date_of_birth;
                $deputyGovernor->twitter = $this->twitter;
                $deputyGovernor->instagram = $this->instagram;
                $deputyGovernor->linkedin = $this->linkedin;
                $deputyGovernor->facebook = $this->facebook;
                $deputyGovernor->about = $this->about;
                $deputyGovernor->office_email = $this->office_email;
                $deputyGovernor->office_phone = $this->office_phone;
                if ($this->photo) {
                    $photoName = Carbon::now()->addMinutes(2)->timestamp . '.' . $this->photo->extension();
                    $this->photo->storeAs('assets/img/about/deputy-governor', $photoName);
                    $deputyGovernor->photo = $photoName;
                }
                $deputyGovernor->save();
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
        return view('livewire.pages.deputy-governor')->layout('layouts.app');
    }
}
