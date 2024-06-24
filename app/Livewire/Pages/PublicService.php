<?php

namespace App\Livewire\Pages;

use App\Models\PublicService as ModelsPublicService;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class PublicService extends Component
{
    public $content;

    public function mount()
    {
        $pageContent = ModelsPublicService::first();
        if ($pageContent) {
            $this->content = $pageContent->content;
        }
    }

    public function saveChanges()
    {
        $pageContent = ModelsPublicService::first();
        if ($pageContent) {
            try {
                $pageContent->content = $this->content;
                $pageContent->save();
                notyf()
                    ->position('x', 'right')
                    ->position('y', 'top')
                    ->success('Changes saved successfully.');
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
        } else {
            try {
                $pageContent = new ModelsPublicService();
                $pageContent->content = $this->content;
                $pageContent->save();
                notyf()
                    ->position('x', 'right')
                    ->position('y', 'top')
                    ->success('Changes saved successfully.');
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
    }
    public function render()
    {
        return view('livewire.pages.public-service')->layout('layouts.app');
    }
}
