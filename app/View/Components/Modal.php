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
    public $modal;

    /**
     * Create a new component instance.
     */
    public function __construct($body, $title, $routeName, $modal)
    {
        $this->body=$body;
        $this->title=$title;
        $this->modal=$modal;
        $this->routeName=$routeName;

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.modal',[
        "body"=>$this->body,"title"=>$this->title,"routeName"=>$this->routeName,"modal"=>$this->modal]);
    }
}