<?php

namespace App\Livewire\Municipalities;

use App\Models\Municipality;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Illuminate\Support\Str;

class AddMunicipality extends Component
{
    public $name;
    public $pageContent;
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
            $municipality = new Municipality();
            $municipality->slug = Str::slug($this->name);
            $municipality->name = $this->name;
            $municipality->content = $this->pageContent;
            $municipality->save();
            notyf()
                ->position('x', 'right')
                ->position('y', 'top')
                ->success('Municipality created successfully.');
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
        return view('livewire.municipalities.add-municipality')->layout('layouts.app');
    }
}
