<?php

namespace App\Livewire\Departments;

use App\Models\ChiefOfficer;
use App\Models\Department;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class AddChiefOfficer extends Component
{
    use WithFileUploads;
    public $name;
    public $photo;
    public $profile;
    public $designation;

    protected $rules = [
        'photo' => 'nullable|mimes:jpg,png,jpeg|max:5120',
        'name' => 'required',
        'profile' => 'nullable|string',
        'designation' => 'nullable|string',
    ];

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function saveChanges()
    {
        $department = Department::where('slug', $this->slug)->first();
        $this->validate();
        try {
            $officer = new ChiefOfficer();
            $officer->name = $this->name;
            $officer->profile = $this->profile;
            $officer->designation = $this->designation;
            $officer->department_id = $department->id;
            if ($this->photo) {
                $photoName = Carbon::now()->addMinutes(2)->timestamp . '.' . $this->photo->extension();
                $this->photo->storeAs('assets/img/departments/chief_officer', $photoName);
                $officer->photo = $photoName;
            }
            $officer->save();
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
        return view('livewire.departments.add-chief-officer')->layout('layouts.app');
    }
}
