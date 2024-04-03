<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class UsersList extends Component
{
    /**
     * Create a new component instance.
     */
    public $user_type;
    public $route;
    public $users;

    public function __construct( $users, $user_type, $route)
    {
        $this->user_type=$user_type;
        $this->route=$route;
        $this->users=$users;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.users-list',
        [$this->users, $this->user_type,$this->route]);
    }
}