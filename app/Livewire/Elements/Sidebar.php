<?php

namespace App\Livewire\Elements;

use App\Models\BlogCategory;
use App\Models\Department;
use App\Models\EventCategory;
use Livewire\Component;

class Sidebar extends Component
{
    public function render()
    {
        $categories = BlogCategory::orderBy('name')->get();
        $eventCategories = EventCategory::orderBy('name')->get();
        $departments = Department::orderBy('title')->get();
        return view('livewire.elements.sidebar', ['categories' => $categories, 'eventCategories' => $eventCategories, 'departments' => $departments]);
    }
}
