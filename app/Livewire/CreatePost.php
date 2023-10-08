<?php

namespace App\Livewire;

use Livewire\WithPagination;
use Livewire\Attributes\Rule;
use Livewire\Component;
use App\Models\Post;
class CreatePost extends Component
{
    use WithPagination;
    
    public $postId;
    public $word;
    public $search = '';
    public $sortField = 'id';
    public $sortDirection = 'desc';
    
    #[Rule('required', message: '文字を入力してください。')]
    #[Rule('min:3', message: 'メモが短すぎます。')] 
    public $content = '';

    protected $listeners = [
        'delete-post' => 'deletePost',
    ];

    public function render()
    {
        if( $this->search!="" ){
            return view('livewire.create-post',[
                'posts' => Post::where('content', 'like', '%'.$this->search.'%')
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate(3),
            ]);
        }else{
            return view('livewire.create-post',[
                'posts' => Post::orderBy($this->sortField, $this->sortDirection)
                ->paginate(3),
            ]);
        }
    }

    public function register()
    {
        $this->validate();
        Post::create([
            'content' => $this->content,
        ]);

        session()->flash('message', '投稿が完了しました。');
        
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

        session()->flash('message', '投稿を削除しました。');
    }

}