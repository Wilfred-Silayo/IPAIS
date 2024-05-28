<div class="mx-1 mt-2 rounded pt-1 mb-3 vh-75 ">

    <!-- Display Conversations -->
    <div class="overflow-auto" style="max-height: 60vh;">
        @foreach($conversation as $message)
        @if($message->sender_id === Auth::user()->username )
        <div class="d-flex justfy-content-between mb-1">
            <div class="rw col-3"></div>
            <div class=" bg-success offset-2 col-7 mb-1 rounded p-2">
                <p class="card-text text-white">{{ $message->content }}</p>
                <p class=" text-end text-white text-small">{{ $message->created_at->diffForHumans() }}</p>
            </div>
        </div>
        @else
        <div class="d-flex justify-content-between">
            <div class="bg-secondary  rounded p-2 col-7 mb-1">
                <p class="card-text text-white">{{ $message->content }}</p>
                <p class="text-end text-white text-small">{{ $message->created_at->diffForHumans() }}</p>
            </div>
            <div class="rw col-3"></div>
        </div>
        @endif
        @endforeach
    </div>
    <!-- Textarea -->
    <form wire:submit.prevent="save" class="position-absolute bottom-0 mb-4 w-50">
        <input type="hidden" name='receiver_id' wire:model="receiver_id">
        <input type="hidden" name='sender_id' wire:model="sender_id">
        <textarea name="content" class="form-control" rows="3" wire:model.live="content"
            placeholder="Enter your message..."></textarea>
        @error('receiver_id')
        <div class="text-danger">{{ __('Please choose user to start conversation') }}</div>
        @enderror
        @error('content')
        <div class="text-danger">{{ $message }}</div>
        @enderror
        <button type="submit" class="btn btn-primary float-end">Send</button>
    </form>
</div>