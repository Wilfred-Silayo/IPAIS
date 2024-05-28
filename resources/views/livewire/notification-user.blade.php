<div class="row mt-2 cursor-pointer {{$active==$user->username ? 'bg-white':''}}" wire:click="$dispatch('user-selected', {username:'{{ $user->username }}'})">
    <div class="col-md-2">
        <img src="{{ asset('storage/profile_images/'.$user->profile_image) }}" class="rounded-circle" width="50" alt="">
    </div>
    <div class="col-md-8 ms-0">
        <div class="row d-inline">
            <span class="fw-bold">{{ $user->first_name }} {{ $user->last_name }}</span> -
            <span class="text-primary">{{ $user->role }}</span>
        </div>
        <p class="text-truncate">{{ $user->email }}</p>
    </div>
    <div class="col-md-2">
        <span class='badge bg-danger ps-1'>{{ $unSeenCount }}</span>
    </div>
</div>
