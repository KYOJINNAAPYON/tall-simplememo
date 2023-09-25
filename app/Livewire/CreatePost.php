<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;

class CreatePost extends Component
{
    public $title;
    public $content;

    public function render()
    {
        return view('livewire.create-post');
    }

    protected $rules = [
        'content' => ['required'],
    ];

    public function register()
    {
        $data = $this->validate();

        Post::create($data);

        $this->content = '';
    }
}
