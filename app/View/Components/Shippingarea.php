<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Shippingarea extends Component
{

    public $division;
    /**
     * Create a new component instance.
     *
     * @return void
     */
   
    public function __construct($division)
    {
        //
        $this->division=$division;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.shippingarea');
    }
}
