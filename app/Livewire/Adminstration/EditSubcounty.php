<?php

namespace App\Livewire\Adminstration;

use App\Models\Subcounty;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class EditSubcounty extends Component
{
    public $subCounty_id;
    public $name;
    public $short_description;
    public $MPName;
    public $website_url;
    public function mount()
    {
        $subCounty = Subcounty::findOrFail($this->subCounty_id);
        $this->name = $subCounty->name;
        $this->short_description = $subCounty->short_description;
        $this->MPName = $subCounty->MPName;
        $this->website_url = $subCounty->website_url;
    }

    public $rules = [
        'name' => 'required|unique:subcounties,name',
        'short_description' => 'nullable|string',
        'MPName' => 'required',
        'website_url' => 'nullable|url',
    ];
    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function saveChanges()
    {
        $this->validate();
        try {
            $subCounty = Subcounty::findOrFail($this->subCounty_id);
            $subCounty->name = $this->name;
            $subCounty->mp_name = $this->MPName;
            $subCounty->short_description = $this->short_description;
            $subCounty->website_url = $this->website_url;
            $subCounty->save();
            notyf()
                ->position('x', 'right')
                ->position('y', 'top')
                ->success('Constituency Created');
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
        return view('livewire.adminstration.edit-subcounty')->layout('layouts.app');
    }
}
