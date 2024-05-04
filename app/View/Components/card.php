<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class card extends Component
{
    public $header;
    public $body;
    public $route;
    /**
     * Create a new component instance.
     */
    public function __construct($header, $body, $route)
    {
        $this->header=$header;
        $this->body=$body;
        $this->route=$route;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.card',[
            "header"=>$this->header,
            "body"=>$this->body,
            "route"=>$this->route,
        ]);
    }
}
