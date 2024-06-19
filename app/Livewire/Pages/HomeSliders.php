<?php

namespace App\Livewire\Pages;

use App\Models\Slider;
use Livewire\Component;
use Livewire\WithPagination;

class HomeSliders extends Component
{
    use WithPagination;
    public function render()
    {
        $sliders = Slider::orderByDesc('created_at')->paginate(12);
        return view('livewire.pages.home-sliders', ['sliders' => $sliders])->layout('layouts.app');
    }
}
