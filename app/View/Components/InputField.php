<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InputField extends Component
{
    /**
     * Create a new component instance.
     */
    public $type;
    public $placeholder;
    public $prefixIcon;
    public $input;
    public $text;

    public function __construct($text,$placeholder,$input,$prefixIcon,$type)
    {
        $this->text=$text;
        $this->input=$input;
        $this->placeholder=$placeholder;
        $this->prefixIcon=$prefixIcon;
        $this->type=$type;

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.input-field',[
            "text"=>$this->text,
            "type"=>$this->type,
            "placeholder"=>$this->placeholder,
            "prefixIcon"=>$this->prefixIcon,
            "input"=>$this->input

        ]);
    }
}
