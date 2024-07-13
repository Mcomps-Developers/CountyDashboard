<?php

namespace App\Livewire\Pages;

use App\Models\Document;
use App\Models\Folder;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class EditDocuments extends Component
{
    use WithFileUploads;
    public $file_id;
    public $title;
    public $folder;
    public $type;
    public $newDocument;
    public function mount()
    {
        $file = Document::findOrFail($this->file_id);
        $this->title = $file->title;
        $this->type = $file->type;
        $this->folder = $file->folder_id;
    }
    protected $rules = [
        'type' => 'required',
        'title' => 'nullable',
        'folder' => 'nullable',
        'newDocument' => 'nullable|mimes:doc,docx,pdf,xlx,xlxs,pptx,ppt,pub,zip|max:1024000',
    ];
    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function saveChanges()
    {
        $this->validate();
        try {
            $document = Document::findOrFail($this->file_id);
            $document->title = $this->title;
            $document->type = $this->type;
            $document->folder_id = $this->folder;
            if ($this->newDocument) {
                $documentName = Str::random(5) . '.' . $this->newDocument->extension();
                $this->newDocument->storeAs('assets/documents/uploads', $this->title . '-' . $documentName);
                $document->document = $this->title . '-' . $documentName;
            }
            $document->save();

            notyf()
                ->position('x', 'right')
                ->position('y', 'top')
                ->success('Uploaded successfully.');
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
        return view('livewire.pages.edit-documents', ['folders' => $folders])->layout('layouts.app');
    }
}
