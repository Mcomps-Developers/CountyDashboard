<?php

namespace App\Livewire\Projects;

use App\Models\Department;
use App\Models\Project;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Illuminate\Support\Str;

class EditProject extends Component
{
    use WithFileUploads;
    public $project_id;

    private $slug;
    public $description;
    public $title;
    public $new_cover_image;
    public $project_date;
    public $category_name;
    public $location;
    public $department;
    public $images;

    public function mount()
    {
        $project = Project::findOrFail($this->project_id);
        $this->description = $project->description;
        $this->title = $project->title;
        $this->project_date = $project->project_date;
        $this->category_name = $project->category_name;
        $this->location = $project->location;
        $this->department = $project->department_id;
    }
    protected $rules = [
        'description' => 'required|string',
        'title' => 'required',
        'new_cover_image' => 'nullable|mimes:png,jpg,jpeg|max:5120',
        'project_date' => 'nullable|date',
        'category_name' => 'nullable',
        'department' => 'nullable',
        'location' => 'required',
    ];

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }
    public function saveChanges()
    {
        $this->validate();
        try {
            $project = Project::findOrFail($this->project_id);
            $project->title = $this->title;
            $project->description = $this->description;
            $project->category_name = $this->category_name;
            $project->department_id = $this->department;
            $project->slug = Str::slug($this->title, '-');
            $project->created_at = empty($this->project_date) ? Carbon::now() : $this->project_date;
            if ($this->new_cover_image) {
                $photoName = Carbon::now()->addMinutes(2)->timestamp . '.' . $this->new_cover_image->extension();
                $this->new_cover_image->storeAs('assets/img/projects/covers', $photoName);
                $project->cover_image = $photoName;
            }
            $project->save();
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
        $departments = Department::orderBy('title')->get();
        return view('livewire.projects.edit-project', ['departments' => $departments])->layout('layouts.app');
    }
}
