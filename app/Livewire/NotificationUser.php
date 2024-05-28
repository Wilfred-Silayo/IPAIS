<?php

namespace App\Livewire;

use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class NotificationUser extends Component
{
    public $user;
    public $active;
    public $unSeenCount;

    protected $listeners = ['new-notification' => '$refresh'];

    #[On('user-selected')]
    public function userSelected($username)
    {
        $this->active = $username;

        Notification::where('sender_id', $username)
            ->where('receiver_id', Auth::user()->username)
            ->where('deleted_by_receiver', false)
            ->update(['is_seen' => true]);

            $this->dispatch('new-notification');
       
    }

    #[On('new-notification')]
    public function render()
    {
        $this->unSeenCount=Notification::where('sender_id',$this->user->username)
             ->where('is_seen',0)
             ->where('receiver_id',Auth::user()->username)->count();
        return view('livewire.notification-user');
    }

}