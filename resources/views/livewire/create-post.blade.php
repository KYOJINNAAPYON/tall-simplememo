<div class="container mx-auto px-4">
    <x-slot name="header">
    </x-slot>

    @if(!$showPost)
    <div class="mb-10">
        <form wire:submit.prevent="register">
        <div>
            <div class="py-4">新規投稿</div>
            <input wire:model.blur="content" type="text" class="rounded-lg">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border rounded">投稿</button>
            <div>@error('content')<span style="color:red">{{ $message }}</span>@enderror</div>
            <div>@if (session()->has('message'))
                    <div class="alert alert-success text-blue-700">
                    {{ session('message') }}
                    </div>
                @endif
            </div>
        </div>
        </form>
    </div>

    <hr>

    <table class="table-fixed mt-10">
        <div class="py-4">メモ一覧</div>
            <form>
                <input type="text" placeholder="キーワード検索" wire:model.live="search" id="search" class="rounded-lg">
            </form>
        <div class="p-3">
            <div class="overflow-x-auto">
                <table class="table-auto w-full">
                    <thead class="text-xs font-semibold">
                    <tr>
                    <th sortable wire:click="sortBy('id')" class="p-2 whitespace-nowrap text-center">ID ▽</th>
                    <th sortable wire:click="sortBy('content')" class="p-2 whitespace-nowrap text-center">メモ内容 ▽</th>
                    <th sortable wire:click="sortBy('created_at')" class="p-2 whitespace-nowrap text-center">作成日時 ▽</th>
                    <th sortable wire:click="sortBy('updated_at')" class="p-2 whitespace-nowrap text-center">更新日時 ▽</th>
                    <th class="p-2 whitespace-nowrap text-center"></th>
                    <th class="p-2 whitespace-nowrap text-center"></th>
                    </tr>
                    </thead>
                    
                    @foreach($posts as $post)
        
                    <tbody class="text-sm divide-y divide-gray-100">
                    <tr>
                    <td class="p-2 whitespace-nowrap text-center">{{ $post->id }}</td>
                    <td class="p-2 whitespace-nowrap text-center">{{ $post->content }}</td>
                    <td class="p-2 whitespace-nowrap text-center">{{ $post->created_at }}</td>
                    <td class="p-2 whitespace-nowrap text-center">{{ $post->updated_at }}</td>
                    <td class="p-2 whitespace-nowrap text-center">
                        <button type="button" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded" 
                        wire:click="editPost({ postId: {{ $post->id }}})">編集</button>
                    </td>
                    <td class="p-2 whitespace-nowrap">
                        <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="confirm('本当に削除してもよろしいですか？') && 
                        Livewire.dispatch('delete-post',{ postId: {{$post->id}} })">削除</button>
                    </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="my-10">{{ $posts->links() }}</div>
            </div>
        </div>

    @else

        <div class="container my-auto flex justify-center">
            <div class="mb-10">
            <form>
                <div>
                    <div class="py-4 mt-8 text-center">No.{{ $post->id }}メモ編集</div>
                        <input wire:model="content" type="text" class="rounded-lg my-4">
                        <div>@error('content')<span style="color:red">{{ $message }}</span>@enderror</div>
                        <div>@if (session()->has('message'))
                        <div class="alert alert-success text-blue-700">
                        {{ session('message') }}
                        </div>
                        @endif
                        </div>
                        <div class="flex justify-between">
                        <div>
                        <button class="btn bg-orange-500 hover:bg-orange-700 text-white font-bold py-2 px-4 border rounded" href="route('')">戻る</button>
                        </div>
                        <div>
                        <button wire:click.prevent="update()" class="btn bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border rounded">確定</button>
                        </div>
                    </div>
                </div>
            </form>
            </div>
        </div>
    @endif
    </table>
</div>
