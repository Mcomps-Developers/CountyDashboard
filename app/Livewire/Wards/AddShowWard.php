<?php

namespace App\Livewire\Wards;

use App\Models\Subcounty;
use App\Models\Ward;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class AddShowWard extends Component
{
    public $subCounty_id;
    public $name;
    public $short_description;
    public $mca_name;
    public $website_url;
    public $subCountyName;

    public function mount()
    {
        $subCounty = Subcounty::findOrFail($this->subCounty_id);
        $this->subCountyName = $subCounty->name;
    }

    public $rules = [
        'name' => 'required|unique:wards,name',
        'short_description' => 'nullable|string',
        'mca_name' => 'nullable|string|max:60',
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
            $ward = new Ward();
            $ward->subcounty_id = $subCounty->id;
            $ward->name = $this->name;
            $ward->mca_name = $this->mca_name;
            $ward->short_description = $this->short_description;
            $ward->website = $this->website_url;
            $ward->save();
            notyf()
                ->position('x', 'right')
                ->position('y', 'top')
                ->success('Ward Created');
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
        return view('livewire.wards.add-show-ward')->layout('layouts.app');
    }
}
