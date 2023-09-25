<div>
    <form wire:submit.prevent="register" class="">
        <div>
            <textarea wire:model="content" cols="30" rows="5"></textarea>
            <div>@error('body')<span style="color:red">{{ $message }}</span>@enderror</div>
        </div>
        <div>
            <input type="submit" value="送信する">
        </div>
    </form>
</div>
