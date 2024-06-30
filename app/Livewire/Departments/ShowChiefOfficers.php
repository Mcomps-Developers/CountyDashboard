<?php

namespace App\Livewire\Departments;

use App\Models\ChiefOfficer;
use App\Models\Department;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class ShowChiefOfficers extends Component
{
    public $slug;
    public function deleteOfficer($rowID)
    {
        try {
            $officer = ChiefOfficer::findOrFail($rowID);
            $officer->delete();
            notyf()
                ->position('x', 'right')
                ->position('y', 'top')
                ->success('Chief Officer Deleted');
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
        $officers = ChiefOfficer::where('department_id', $department->id)->get();
        return view('livewire.departments.show-chief-officers', ['officers' => $officers, 'department' => $department])->layout('layouts.app');
    }
}
