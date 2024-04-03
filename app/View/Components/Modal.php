<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Modal extends Component
{
    public $body;
    public $title;
    public $routeName;

    /**
     * Create a new component instance.
     */
    public function __construct($body, $title, $routeName)
    {
        $this->body=$body;
        $this->title=$title;
        $this->routeName=$routeName;

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.modal',[
        "body"=>$this->body,"title"=>$this->title,"routeName"=>$this->routeName]);
    }
}