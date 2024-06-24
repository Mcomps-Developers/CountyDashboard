<?php

namespace App\Livewire\Wards;

use App\Models\Subcounty;
use App\Models\Ward;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class ShowWards extends Component
{
    public $subCounty_id;
    public $subCountyName;
    public function mount()
    {
        $subCounty = Subcounty::findOrFail($this->subCounty_id);
        $this->subCountyName = $subCounty->name;
    }
    public function deleteWard($rowID)
    {
        try {
            $ward = Ward::findOrFail($rowID);
            $ward->delete();
            notyf()
                ->position('x', 'right')
                ->position('y', 'top')
                ->success('Ward Deleted');
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
        $wards = Ward::orderBy('name')->where('subcounty_id', $this->subCounty_id)->get();
        return view('livewire.wards.show-wards', ['wards' => $wards])->layout('layouts.app');
    }
}
