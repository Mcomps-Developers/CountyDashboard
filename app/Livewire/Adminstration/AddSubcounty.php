<?php

namespace App\Livewire\Adminstration;

use App\Models\Subcounty;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class AddSubcounty extends Component
{
    public $name;
    public $short_description;
    public $MPName;
    public $website_url;
    public $rules = [
        'name' => 'required|unique:subcounties,name',
        'short_description' => 'required|string',
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
            $subcounty = new Subcounty();
            $subcounty->name = $this->name;
            $subcounty->mp_name = $this->MPName;
            $subcounty->short_description = $this->short_description;
            $subcounty->website_url = $this->website_url;
            $subcounty->save();
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
        return view('livewire.adminstration.add-subcounty')->layout('layouts.app');
    }
}
