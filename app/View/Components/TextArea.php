<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TextArea extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public $input, public $text, public $placeholder)
    {
        $this->text=$text;
        $this->input=$input;
        $this->placeholder=$placeholder;

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.text-area',[
            "input"=>$this->input,
            "text"=>$this->text,
            "placeholder"=>$this->placeholder,

        ]);
    }
}
