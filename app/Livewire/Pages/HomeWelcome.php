<?php

namespace App\Livewire\Pages;

use App\Models\WelcomeNote;
use Livewire\Component;

class HomeWelcome extends Component
{
    public $title;
    public $message;
    public $name;
    public $designation;
    public $photo;
    public $quoted_text;
    public function mount()
    {
        $note = WelcomeNote::first();
        $this->title = $note->title;
        $this->message = $note->message;
        $this->name = $note->name;
        $this->designation = $note->designation;
        $this->quoted_text = $note->quoted_text;
    }
    public function render()
    {
        return view('livewire.pages.home-welcome')->layout('layouts.app');
    }
}
