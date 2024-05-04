<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class UpdateField extends Component
{
    public $input;
    public $text;
    public $value;
    public $type;

    /**
     * Create a new component instance.
     */
    public function __construct($input, $value, $text, $type)
    {
        $this->input=$input;
        $this->value=$value;
        $this->text=$text;
        $this->type=$type;

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.update-field',[
            "input"=>$this->input,
            "value"=>$this->value,
            "text"=>$this->text,
            "type"=>$this->type,
        ]);
    }
}
