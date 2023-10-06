<div>
    <x-slot name="header">
    </x-slot>

    <div class="mb-4">
        <form wire:submit.prevent="register" class="">
        <div>
            <div>新規投稿</div>
            <textarea wire:model="content"></textarea>
            <div>@error('content')<span style="color:red">{{ $message }}</span>@enderror</div>
        </div>
        <button>
            <input type="submit" value="投稿">
        </button>
    </form>
    </div>

    <hr>

    <div>
        <div>メモ一覧</div>
        @foreach($posts as $post)
        <div sortable wire:click="sortBy('id')">ID</div>
        <div>{{ $post->id }}</div>
        <div>{{ $post->content }}</div>
        <div>{{ $post->created_at }}</div>
        <div>{{ $post->updated_at }}</div>
        <div wire:click="edit{{ $post->id }}">編集</div>
        <button wire:click="delete('{{$post->id}}')">削除</button>
        @endforeach
    </div>
    
</div>
