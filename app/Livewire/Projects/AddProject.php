<?php

namespace App\Livewire\Projects;

use App\Models\Department;
use App\Models\Project;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class AddProject extends Component
{
    use WithFileUploads;
    private $slug;
    public $description;
    public $title;
    public $cover_image;
    public $project_date;
    public $category_name;
    public $location;
    public $department;
    public $images;
    protected $rules = [
        'description' => 'required|string',
        'title' => 'required',
        'cover_image' => 'nullable|mimes:png,jpg,jpeg|max:5120',
        'project_date' => 'nullable|date',
        'category_name' => 'nullable',
        'department' => 'nullable',
        'location' => 'required',
    ];

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    private function generateUniqueReference($model, $column, $length = 5)
    {
        do {
            $reference = Str::random($length);
            $exists = $model::where($column, $reference)->exists();
        } while ($exists);

        return $reference;
    }
    public function saveChanges()
    {
        $this->validate();
        try {
            $project = new Project();
            $project->title = $this->title;
            $project->description = $this->description;
            $project->slug = Str::slug($this->title, '-');
            $project->category_name = $this->category_name;
            $project->department_id = $this->department;
            $project->images = 'null';
            $project->reference = $this->generateUniqueReference(Project::class, 'reference', 5);
            $project->created_at = empty($this->project_date) ? Carbon::now() : $this->project_date;
            if ($this->cover_image) {
                $photoName = Carbon::now()->addMinutes(2)->timestamp . '.' . $this->cover_image->extension();
                $this->cover_image->storeAs('assets/img/projects/covers', $photoName);

                $sourcePath = public_path('assets/img/projects/covers/' . $photoName);
                $destinationDir = 'C:/inetpub/wwwroot/BusiaCounty/public/assets/img/projects/covers/';
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
                $project->cover_image = $photoName;
            }
            $project->save();
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
        $departments = Department::orderBy('title')->get();
        return view('livewire.projects.add-project', ['departments' => $departments])->layout('layouts.app');
    }
}
