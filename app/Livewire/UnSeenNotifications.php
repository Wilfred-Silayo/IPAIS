<?php

namespace App\Livewire;

use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class UnSeenNotifications extends Component
{
    public $unseen;

    #[On('new-notification')]
    public function render()
    {
        $this->unseen = Notification::where('receiver_id',Auth::user()->username)
        ->where('is_seen',0)->count();
        return view('livewire.un-seen-notifications');
    }
}
