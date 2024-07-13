<?php

namespace App\Livewire\Projects;

use App\Models\Project;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;

class ShowProjects extends Component
{
    use WithPagination;
    public function deleteProject($rowID)
    {
        try {
            $department = Project::findOrFail($rowID);
            $department->delete();
            notyf()
                ->position('x', 'right')
                ->position('y', 'top')
                ->success('Project Deleted');
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
        }
    }
    public function render()
    {
        $projects = Project::orderBy('created_at')->paginate(12);
        return view('livewire.projects.show-projects', ['projects' => $projects])->layout('layouts.app');
    }
}
