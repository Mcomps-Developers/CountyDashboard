<?php

namespace App\Livewire\Pages;

use App\Models\Department;
use App\Models\Document;
use App\Models\Folder;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Illuminate\Support\Str;

class AddDocuments extends Component
{
    use WithFileUploads;

    public $title;
    public $document;
    public $folder_id;
    public $folder_name;
    public $type;

    public function mount()
    {
        $folder = Folder::findOrFail($this->folder_id);
        $this->folder_name = $folder->name;

    }
    protected $rules = [
        'type'=>'required',
        'title' => 'required',
        'document' => 'required|mimes:doc,docx,pdf,xlx,xlxs,pptx,ppt,pub,zip|max:1024000',
    ];
    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function saveChanges()
    {
        $this->validate();
        try {
            $document = new Document();
            $document->title = $this->title;
            $document->type = $this->type;
            $document->folder_id = $this->folder_id;
            if ($this->document) {
                $documentName = Str::random(5) . '.' . $this->document->extension();
                $this->document->storeAs('assets/documents/uploads', $this->title . '-' . $documentName);

                $sourcePath = public_path('assets/documents/uploads/' . $documentName);
                $destinationDir = 'C:/inetpub/wwwroot/BusiaCounty/public/assets/documents/uploads/';
                $destinationPath = $destinationDir . $documentName;

                if (!file_exists($destinationDir)) {
                    mkdir($destinationDir, 0755, true);
                }
                if (file_exists($sourcePath)) {
                    if (copy($sourcePath, $destinationPath)) {
                    } else {
                        throw new \Exception("Failed to copy file to: " . $destinationPath);
                    }
                } else {
                    throw new \Exception("File not found at: " . $sourcePath);
                }
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
        $departments = Department::orderBy('title')->get();
        return view('livewire.pages.add-documents', ['departments' => $departments])->layout('layouts.app');
    }
}
