<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;
use App\Livewire\Forms\PostForm;

class CreatePost extends Component
{
    public PostForm $form;
    public $postId;
    
    public $sortField = 'id';
    public $sortDirection = 'asc';

    protected $listeners = [
        'delete-post' => 'deletePost',
    ];

    public function mount()
    {
        $this->posts = Post::all();
    }

    public function render()
    {
        return view('livewire.create-post',[
            'posts' => Post::orderBy($this->sortField, $this->sortDirection)->get(),
        ]);
    }

    public function register()
    {
        $this->validate();
        $this->form->store();

        return $this->redirect('/');
    }

    public function sortBy($field){
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        }else {
            $this->sortDirection = 'asc';
        }
        $this->sortField = $field;
    }

    public function deletePost($postId)
    {
        Post::whereId($postId)->first()->delete();
    }

}