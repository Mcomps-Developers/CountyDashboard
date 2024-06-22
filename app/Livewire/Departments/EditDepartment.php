<?php

namespace App\Livewire\Departments;

use App\Models\Department;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class EditDepartment extends Component
{
    use WithFileUploads;
    public $slug;
    public $cover_image;
    public $description;
    public $title;

    // CECM PROFILE
    public $cecm_name;
    public $cecm_photo;
    public $cecm_date_of_birth;
    public $cecm_department_phone;
    public $cecm_department_email;
    public $about_cecm;
    // CHIEF OFFICER PROFILE
    public $chief_officer_name;
    public $chief_officer_photo;
    public $chief_officer_date_of_birth;
    public $chief_officer_department_phone;
    public $chief_officer_department_email;
    public $about_chief_officer;

    public function mount($slug)
    {
        $this->slug = $slug;
        $department = Department::Where('slug', $this->slug)->first();
        $this->description = $department->description;
        $this->title = $department->title;
        $this->chief_officer_name = $department->chief_officer_name;
        $this->chief_officer_photo = $department->chief_officer_photo;
        $this->chief_officer_date_of_birth = $department->chief_officer_date_of_birth;
        $this->chief_officer_department_phone = $department->chief_officer_department_phone;
        $this->chief_officer_department_email = $department->chief_officer_department_email;
        $this->about_chief_officer = $department->about_chief_officer;
        $this->cecm_name = $department->cecm_name;
        $this->cecm_photo = $department->cecm_photo;
        $this->cecm_date_of_birth = $department->cecm_date_of_birth;
        $this->cecm_department_phone = $department->cecm_department_phone;
        $this->cecm_department_email = $department->cecm_department_email;
    }

    protected $rules = [
        // Chief officer
        'about_chief_officer' => 'nullable|string',
        'chief_officer_department_email' => 'nullable|email',
        'chief_officer_department_phone' => 'nullable|numeric|digits:12',
        'chief_officer_date_of_birth' => 'nullable|date',
        'chief_officer_photo' => 'nullable|mimes:jpg,png,jpeg|max:5120',
        'chief_officer_name' => 'nullable|string',
        // CECM
        'about_cecm' => 'nullable|string|max:750',
        'cecm_department_email' => 'nullable|email',
        'cecm_department_phone' => 'nullable|numeric|digits:12',
        'cecm_date_of_birth' => 'nullable|date',
        'cecm_photo' => 'nullable|mimes:jpg,png,jpeg|max:5120',
        'cecm_name' => 'nullable|string',
        // Department
        'title' => 'required',
        'description' => 'nullable|required',
        'cover_image' => 'nullable|mimes:jpg,png,jpeg|max:5120',
    ];

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function saveChanges()
    {
        $this->validate();
        try {
            $department = Department::Where('slug', $this->slug)->first();
            $department->title = $this->title;
            $department->description = $this->description;
            $department->slug = Str::slug($this->title, '-');
            if ($this->cover_image) {
                $photoName = Carbon::now()->addMinutes(2)->timestamp . '.' . $this->cover_image->extension();
                $this->cover_image->storeAs('assets/img/departments', $photoName);
                $department->cover_image = $photoName;
            }
            // CECM
            $department->about_cecm = $this->about_cecm;
            $department->cecm_department_email = $this->cecm_department_email;
            $department->cecm_department_phone = $this->cecm_department_phone;
            $department->cecm_date_of_birth = $this->cecm_date_of_birth;
            $department->cecm_name = $this->cecm_name;
            if ($this->cecm_photo) {
                $photoName = Carbon::now()->addMinutes(2)->timestamp . '.' . $this->cecm_photo->extension();
                $this->cecm_photo->storeAs('assets/img/departments/cecm', $photoName);
                $department->cecm_photo = $photoName;
            }
            // Chief Officer
            $department->about_chief_officer = $this->about_chief_officer;
            $department->chief_officer_department_email = $this->chief_officer_department_email;
            $department->chief_officer_department_phone = $this->chief_officer_department_phone;
            $department->chief_officer_date_of_birth = $this->chief_officer_date_of_birth;
            $department->chief_officer_name = $this->chief_officer_name;
            if ($this->chief_officer_photo) {
                $photoName = Carbon::now()->addMinutes(2)->timestamp . '.' . $this->chief_officer_photo->extension();
                $this->chief_officer_photo->storeAs('assets/img/departments/chief_officer', $photoName);
                $department->chief_officer_photo = $photoName;
            }
            $department->save();
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
        return view('livewire.departments.edit-department')->layout('layouts.app');
    }
}
