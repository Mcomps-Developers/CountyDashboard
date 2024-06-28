<?php

namespace App\Livewire\Documents;

use App\Models\Document;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;

class AllDocuments extends Component
{
    use WithPagination;

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
        $files = Document::orderBy('folder_id')->paginate(12);
        return view('livewire.documents.all-documents',['files'=>$files])->layout('layouts.app');
    }
}
