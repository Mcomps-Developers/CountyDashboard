<?php

namespace App\Livewire\Pages;

use App\Models\Document;
use App\Models\Folder;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;

class ShowDocuments extends Component
{
    use WithPagination;
    public $folder_id;
    public $folder_name;

    public function mount()
    {
        $folder = Folder::findOrFail($this->folder_id);
        $this->folder_name = $folder->name;
    }
    public function deleteDocument($rowID)
    {
        try {
            $document = Document::findOrFail($rowID);
            $document->delete();
            notyf()
                ->position('x', 'right')
                ->position('y', 'top')
                ->success('Document Deleted');
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
        $documents = Document::orderByDesc('created_at')->where('folder_id', $this->folder_id)->paginate(12);
        return view('livewire.pages.show-documents', ['documents' => $documents])->layout('layouts.app');
    }
}
