<?php

namespace App\Livewire\Pages;

use App\Models\CountyRevenueBoard as ModelsCountyRevenueBoard;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class CountyRevenueBoard extends Component
{
    public $content;

    public function mount()
    {
        $pageContent = ModelsCountyRevenueBoard::first();
        if ($pageContent) {
            $this->content = $pageContent->content;
        }
    }

    public function saveChanges()
    {
        $pageContent = ModelsCountyRevenueBoard::first();
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
                $pageContent = new ModelsCountyRevenueBoard();
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
        return view('livewire.pages.county-revenue-board')->layout('layouts.app');
    }
}
