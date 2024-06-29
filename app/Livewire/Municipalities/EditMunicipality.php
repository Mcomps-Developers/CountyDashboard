<?php

namespace App\Livewire\Municipalities;

use App\Models\Municipality;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Illuminate\Support\Str;

class EditMunicipality extends Component
{
    public $municipality_id;
    public $name;
    public $pageContent;

    public function mount()
    {
        $municipality = Municipality::findOrFail($this->municipality_id);
        $this->name = $municipality->name;
        $this->pageContent = $municipality->content;
    }
    public $rules = [
        'name' => 'required|unique:municipalities,name',
        'pageContent' => 'required|string',
    ];
    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function saveChanges()
    {
        $this->validate();
        try {
            $municipality = Municipality::findOrFail($this->municipality_id);
            $municipality->slug = Str::slug($this->name);
            $municipality->name = $this->name;
            $municipality->content = $this->pageContent;
            $municipality->save();
            notyf()
                ->position('x', 'right')
                ->position('y', 'top')
                ->success('Municipality updated successfully.');
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
        return view('livewire.municipalities.edit-municipality')->layout('layouts.app');
    }
}
