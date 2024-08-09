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


    public function mount($slug)
    {
        $this->slug = $slug;
        $department = Department::Where('slug', $this->slug)->first();
        $this->description = $department->description;
        $this->title = $department->title;
        $this->cecm_name = $department->cecm_name;
        $this->about_cecm = $department->about_cecm;
        $this->cecm_date_of_birth = $department->cecm_date_of_birth;
        $this->cecm_department_phone = $department->cecm_department_phone;
        $this->cecm_department_email = $department->cecm_department_email;
    }

    protected $rules = [

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

                $sourcePath = public_path('assets/img/departments/' . $photoName);
                $destinationDir = 'C:/inetpub/wwwroot/BusiaCounty/public/assets/img/departments/';
                $destinationPath = $destinationDir . $photoName;

                if (!file_exists($destinationDir)) {
                    mkdir($destinationDir, 0755, true);
                }
                if (file_exists($sourcePath)) {
                    if (copy($sourcePath, $destinationPath)) {
                    } else {
                        throw new \Exception("Failed to copy file to: " . $destinationPath);
                    }
                } else {
                    throw new \Exception("File not found at: " . $sourcePath);
                }
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

                $sourcePath = public_path('assets/img/departments/cecm/' . $photoName);
                $destinationDir = 'C:/inetpub/wwwroot/BusiaCounty/public/assets/img/departments/cecm/';
                $destinationPath = $destinationDir . $photoName;

                if (!file_exists($destinationDir)) {
                    mkdir($destinationDir, 0755, true);
                }
                if (file_exists($sourcePath)) {
                    if (copy($sourcePath, $destinationPath)) {
                    } else {
                        throw new \Exception("Failed to copy file to: " . $destinationPath);
                    }
                } else {
                    throw new \Exception("File not found at: " . $sourcePath);
                }
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
        return view('livewire.departments.edit-department')->layout('layouts.app');
    }
}
