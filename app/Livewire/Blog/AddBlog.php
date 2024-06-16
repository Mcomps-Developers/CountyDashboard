<?php

namespace App\Livewire\Blog;

use Livewire\Component;
use Livewire\WithFileUploads;

class AddBlog extends Component
{
    use WithFileUploads;
    public $speech_content;
    public $title;
    public $photo;
    public $publishing_date;
public $tags;
    public $rules = [
        'speech_content' => 'required',
        'title' => 'required',
        'photo' => 'mimes:png,jpg,jpeg|max:5120',
    ];

    public function updated($fields)
    {
        $this->validateOnly($fields);

    }
    public function addSpeech()
    {
        $this->validate();

    }
    public function render()
    {
        return view('livewire.blog.add-blog')->layout('layouts.app');
    }
}
