<?php

namespace App\Livewire\Departments\Directorates;

use App\Models\Department;
use App\Models\Directorate;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class AddDirectorates extends Component
{
    use WithFileUploads;
    public $slug;
    public $title;
    public $director_name;
    public $director_photo;
    public $director_date_of_birth;
    public $office_phone;
    public $office_email;
    public $about;

    public function mount($slug)
    {
        $this->slug = $slug;
    }
    protected $rules = [
        'director_photo' => 'nullable|mimes:jpg,png,jpeg|max:5120',
        'director_date_of_birth' => 'nullable|date',
        'office_phone' => 'nullable|numeric|digits:12',
        'office_email' => 'nullable|email',
        'about' => 'nullable|string',
        'director_name' => 'required',
        'title' => 'required',
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
            $directorate = new Directorate();
            $directorate->title = $this->title;
            $directorate->leader_name = $this->director_name;
            $directorate->leader_date_of_birth = $this->director_date_of_birth;
            $directorate->office_phone = $this->office_phone;
            $directorate->office_email = $this->office_email;
            $directorate->about = $this->about;
            $directorate->department_id = $department->id;
            if ($this->director_photo) {
                $photoName = Carbon::now()->addMinutes(2)->timestamp . '.' . $this->director_photo->extension();
                $this->director_photo->storeAs('assets/img/directors', $photoName);
                $directorate->leader_photo = $photoName;
            }
            $directorate->save();
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
        return view('livewire.departments.directorates.add-directorates')->layout('layouts.app');
    }
}
