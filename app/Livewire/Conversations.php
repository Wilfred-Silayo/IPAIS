<?php

namespace App\Livewire;

use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class Conversations extends Component
{
    public $username = '';

    public $content='';

    public $receiver_id='';

    public $sender_id='';


    protected $rules = [
        'content' => 'required|min:6|max:300',
        'receiver_id'=>'required',
        'sender_id'=>'required',
    ];

    
    #[On('user-selected')]
    public function userSelected($username)
    {
        $this->username = $username;
        $this->receiver_id = $username; 
        $this->sender_id = Auth::user()->username; 
    }

    

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function save()
    {
        $this->validate();

        Notification::create([
            'content' => $this->content,
            'receiver_id' => $this->receiver_id,
            'sender_id' => $this->sender_id,
        ]);

        $this->dispatch('new-notification');

        $this->reset(['content']); 
    }

    public function render()
    {
        $username=$this->username;
        return view('livewire.conversations',[
            'conversation'=>Notification::where(function ($query) use ($username) {
                $query->where('sender_id', $username)
                    ->where('receiver_id', Auth::user()->username)
                    ->where('deleted_by_receiver', false);
            })
            ->orWhere(function ($query) use ($username) {
                $query->where('sender_id', Auth::user()->username)
                    ->where('receiver_id', $username)
                    ->where('deleted_by_sender', false);
            })
            ->orderBy('created_at')
            ->get()
        ]);
    }
}
