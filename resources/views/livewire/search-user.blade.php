<div>
    <input wire:model.live="search" type="text" class="form-control" placeholder="Search users..."/>

    @if(!empty($users))
        @foreach($users as $user)
            @if($user->username !== Auth::user()->username)
            <livewire:notification-user :user='$user'>
            @endif
        @endforeach
   @endif
</div>