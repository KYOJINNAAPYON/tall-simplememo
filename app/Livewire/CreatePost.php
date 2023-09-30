<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;

class CreatePost extends Component
{
    public $content = '';

    public function render()
    {
        return view('livewire.create-post',[
            'posts' => Post::all(),
        ]);
    }

    protected $validationAttributes = [
        'content' => 'メモ'
    ];

    public function register()
    {
        $validated = $this->validate([ 
            'content' => 'required|min:3',
        ]);

        Post::create($validated);

        return redirect()->to('/');
    }
}
