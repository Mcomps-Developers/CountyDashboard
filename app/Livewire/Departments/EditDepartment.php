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
    public function mount($slug)
    {
        $this->slug = $slug;
        $department = Department::Where('slug', $this->slug)->first();
        $this->description = $department->description;
        $this->title = $department->title;
    }

    protected $rules = [
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
