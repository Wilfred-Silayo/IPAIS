<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SearchUser extends Component
{
    public $users;
    public $search = '';
 
    public function render()
    {
        $this->users = User::where('first_name', 'like', '%' . $this->search . '%')
        ->orWhere('last_name', 'like', '%' . $this->search . '%')
        ->orWhere('email', 'like', '%' . $this->search . '%')
        ->with(['notifications' => function ($query) {
            $query->where('is_seen', 0)->latest();
        }])
        ->get();

        return view('livewire.search-user', [
        'users' => $this->users,
        ]);
    }
    
}
