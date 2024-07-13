<?php

namespace App\Livewire\Documents;

use App\Models\Folder;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class ShowFolders extends Component
{
    public function deleteFolder($rowID)
    {
        try {
            $folder = Folder::findOrFail($rowID);
            $folder->delete();
            notyf()
                ->position('x', 'right')
                ->position('y', 'top')
                ->success('Folder deleted successfully!');
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
        $folders = Folder::orderBy('name')->get();
        return view('livewire.documents.show-folders', ['folders' => $folders])->layout('layouts.app');
    }
}
