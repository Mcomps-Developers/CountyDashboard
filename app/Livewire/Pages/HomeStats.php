<?php

namespace App\Livewire\Pages;

use App\Models\HomeStats as ModelsHomeStats;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class HomeStats extends Component
{
    public $population;
    public $land_coverage;

    public function mount()
    {
        $stat = ModelsHomeStats::first();
        $this->population->$stat->population;
        $this->land_coverage = $stat->land_coverage;
    }
    public $rules = [
        'population' => 'required|numeric',
        'land_coverage' => 'required',
    ];
    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function saveChanges()
    {
        $this->validate();
        try {
            $category = ModelsHomeStats::first();
            $category->population = $this->population;
            $category->land_coverage = $this->land_coverage;
            $category->save();
            $this->reset();
            notyf()
                ->position('x', 'right')
                ->position('y', 'top')
                ->success('Changes saved');

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
        return view('livewire.pages.home-stats')->layout('layouts.app');
    }
}
