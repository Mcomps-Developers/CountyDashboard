<?php

namespace App\Livewire\Events;

use App\Models\Event;
use App\Models\EventCategory;
use Livewire\Component;
use Livewire\WithPagination;

class EventsPerCategory extends Component
{
    use WithPagination;
    public $slug;
    public function render()
    {
        $category = EventCategory::where('slug', $this->slug)->first();
        $events = Event::orderByDesc('created_at')->where('category_id', $category->id)->paginate(12);
        return view('livewire.events.events-per-category', ['events' => $events])->layout('layouts.app');
    }
}
