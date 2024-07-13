<?php

namespace App\Livewire\Elements;

use App\Models\BlogCategory;
use App\Models\Department;
use App\Models\EventCategory;
use App\Models\Folder;
use App\Models\Municipality;
use App\Models\Subcounty;
use Livewire\Component;

class Sidebar extends Component
{
    public function render()
    {
        $categories = BlogCategory::orderBy('name')->get();
        $eventCategories = EventCategory::orderBy('name')->get();
        $departments = Department::orderBy('title')->get();
        $subCounties = Subcounty::orderBy('name')->get();
        $folders = Folder::orderBy('name')->get();
        $municipalities = Municipality::orderBy('name')->get();
        return view('livewire.elements.sidebar', ['municipalities'=>$municipalities,'folders' => $folders, 'categories' => $categories, 'eventCategories' => $eventCategories, 'departments' => $departments, 'subCounties' => $subCounties]);
    }
}
