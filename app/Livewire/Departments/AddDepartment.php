<?php

namespace App\Livewire\Departments;

use App\Models\Department;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithFileUploads as LivewireWithFileUploads;
use Illuminate\Support\Str;

class AddDepartment extends Component
{
    use LivewireWithFileUploads;
    public $title;
    private $slug;
    public $cover_image;
    public $description;
    // CECM PROFILE
    public $cecm_name;
    public $cecm_photo;
    public $cecm_date_of_birth;
    public $cecm_department_phone;
    public $cecm_department_email;
    public $about_cecm;


    protected $rules = [
        // CECM
        'about_cecm' => 'nullable|string',
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
            $department = new Department();
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
        return view('livewire.departments.add-department')->layout('layouts.app');
    }
}
