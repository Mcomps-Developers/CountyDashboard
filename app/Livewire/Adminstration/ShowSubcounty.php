<?php

namespace App\Livewire\Adminstration;

use App\Models\Subcounty;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class ShowSubcounty extends Component
{
    public function deleteSubCounty($rowID)
    {
        try {
            $subCounty = Subcounty::findOrFail($rowID);
            $subCounty->delete();
            notyf()
                ->position('x', 'right')
                ->position('y', 'top')
                ->success('Constituency Deleted');
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
        $subcounties = Subcounty::orderBy('name')->get();
        return view('livewire.adminstration.show-subcounty', ['subcounties' => $subcounties])->layout('layouts.app');
    }
}
