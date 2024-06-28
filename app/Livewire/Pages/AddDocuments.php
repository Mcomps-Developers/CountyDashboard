<?php

namespace App\Livewire\Pages;

use App\Models\Department;
use App\Models\Document;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class AddDocuments extends Component
{
    use WithFileUploads;

    public $title;
    public $document;
    public $category_name;
    public $department;
    public $type;
    protected $rules = [
        'title' => 'required',
        'document' => 'required|mimes:doc,docx,pdf,xlx,xlxs,pptx,ppt,pub,zip|max:1024000',
        'category_name' => 'nullable',
        'department' => 'nullable',
        'type' => 'required',
    ];
    private function generateUniqueReference($length = 5)
    {
        $reference = Str::random($length);
        return $reference;
    }
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
            $document->category_name = $this->category_name;
            $document->department_id = $this->department;
            $document->type = $this->type;

            if ($this->document) {
                $documentName = $this->generateUniqueReference(5) . '.' . $this->document->extension();
                $this->document->storeAs('assets/documents/uploads', $documentName);
                $document->document = $this->title . $documentName;
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
