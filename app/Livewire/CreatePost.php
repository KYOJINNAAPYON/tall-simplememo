<?php

namespace App\Livewire;

use Livewire\WithPagination;
use Livewire\Attributes\Rule;
use Livewire\Component;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
class CreatePost extends Component
{
    use WithPagination;
    
    public Post $post;
    public $postId;
    public $search = '';
    public $sortField = 'id';
    public $sortDirection = 'desc';
    public bool $showPost = false;
    
    #[Rule('min:3', message: '文字が短すぎます。')] 
    #[Rule('required', message: '文字を入力してください。')]
    public $content = '';

    protected $listeners = [
        'refresh' => '$refresh',
        'delete-post' => 'deletePost',
        'update-post' => 'Post',
    ];

    public function render()
    {
        if( $this->search!="" ){
            return view('livewire.create-post',[
                'posts' => Post::where('content', 'like', '%'.$this->search.'%')
                ->where('user_id','=', Auth::user()->id)
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate(5)
            ]);
        }else{
            return view('livewire.create-post',[
                'posts' => Post::where('user_id','=', Auth::user()->id)
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate(5)
            ]);
        }
    }

    public function register()
    {
        $this->validate();
        Post::create([
            'content' => $this->content,
            'user_id' => Auth::id(),
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
        return $this->redirect('/');
    }

    public function editPost(Post $post)
    {
        $this->showPost = true;

        $this->post = $post;
        $this->content = $post->content;

        // dd($post);
    }

    public function update()
    {
        $this->validate();
        $this->post->update([
            'content' => $this->content,
        ]);

        $this->showPost = false;
        $this->content = '';

        session()->flash('message', '投稿を修正しました。');
        return $this->redirect('/');
    }

    public function return()
    {
        $this->showPost = false;
        $this->content = '';
    }
}