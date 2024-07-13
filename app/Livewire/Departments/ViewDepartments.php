<?php

namespace App\Livewire\Departments;

use App\Models\Department;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class ViewDepartments extends Component
{
    public function deleteDepartment($rowID) 
    {
        try {
            $department = Department::findOrFail($rowID);
            $department->delete();
            notyf()
                ->position('x', 'right')
                ->position('y', 'top')
                ->success('Department Deleted');
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
        $departments = Department::orderby('title')->get();
        return view('livewire.departments.view-departments', ['departments' => $departments])->layout('layouts.app');
    }
}
