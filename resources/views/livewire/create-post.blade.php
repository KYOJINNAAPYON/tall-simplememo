<div>
    <x-slot name="header">
    </x-slot>

    <div class="mb-4">
        <form wire:submit.prevent="register" class="">
        <div>
            <div>新規投稿</div>
            <input wire:model="form.content" type="text"></input>
            <div>@error('form.content')<span style="color:red">{{ $message }}</span>@enderror</div>
        </div>
        <button>
            <input type="submit" value="投稿">
        </button>
    </form>
    </div>

    <hr>

    <div>
        <div>メモ一覧</div>
        <div sortable wire:click="sortBy('id')">ID</div>
        @foreach($posts as $post)
        <div>{{ $post->id }}</div>
        <div>{{ $post->content }}</div>
        <div>{{ $post->created_at }}</div>
        <div>{{ $post->updated_at }}</div>
        <button wire:click="edit-post">編集</button>
        <button onclick="confirm('本当に削除してもよろしいですか？') && 
        Livewire.dispatch('delete-post',{ postId: {{$post->id}} })">削除</button>
        @endforeach
    </div>
    
</div>
