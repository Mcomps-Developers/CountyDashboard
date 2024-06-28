<?php

namespace App\Livewire\Municipalities;

use App\Models\Municipality;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class ShowMunicipalities extends Component
{
    public function deleteMunicipality($rowID)
    {
        try {
            $municipality = Municipality::findOrFail($rowID);
            $municipality->delete();
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
        $municipalities = Municipality::orderBy('name')->get();
        return view('livewire.municipalities.show-municipalities', ['municipalities' => $municipalities])->layout('layouts.app');
    }
}
