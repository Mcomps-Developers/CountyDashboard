<?php

namespace App\Livewire\Departments\Directorates;

use App\Models\Department;
use App\Models\Directorate;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class ShowDirectorates extends Component
{
    public $slug;
    public function deleteDirectorate($rowID)
    {
        try {
            $directorate = Directorate::findOrFail($rowID);
            $directorate->delete();
            notyf()
                ->position('x', 'right')
                ->position('y', 'top')
                ->success('Directorate Deleted');
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
        $department = Department::where('slug', $this->slug)->first();
        $directorates = Directorate::where('department_id', $department->id)->get();
        return view('livewire.departments.directorates.show-directorates', ['department' => $department, 'directorates' => $directorates])->layout('layouts.app');
    }
}
