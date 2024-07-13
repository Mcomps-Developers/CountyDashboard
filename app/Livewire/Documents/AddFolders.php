<?php

namespace App\Livewire\Documents;

use App\Models\Folder;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class AddFolders extends Component
{
    public $name;
    public $rules = [
        'name' => 'required|unique:folders,name',
    ];
    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function saveChanges()
    {
        $this->validate();
        try {
            $folder = new Folder();
            $folder->name = $this->name;
            $folder->save();
            $this->reset();
            notyf()
                ->position('x', 'right')
                ->position('y', 'top')
                ->success('Folder Created successfully');

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
        return view('livewire.documents.add-folders')->layout('layouts.app');
    }
}
