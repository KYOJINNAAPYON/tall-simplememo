<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;
use Livewire\WithPagination;

class CreatePost extends Component
{
    use withPagination;

    public $content = '';
    public $sortField = 'id';
    public $sortDirection = 'asc';

    public function sortBy($field){
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        }else {
            $this->sortDirection = 'asc';
        }
        $this->sortField = $field;
    }

    public function render()
    {
        return view('livewire.create-post',[
            'posts' => Post::orderBy($this->sortField, $this->sortDirection)->get(),
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
