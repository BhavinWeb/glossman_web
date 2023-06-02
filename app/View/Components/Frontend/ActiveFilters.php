<?php

namespace App\View\Components\frontend;

use Illuminate\View\Component;

class ActiveFilters extends Component
{
    public $closeFunction;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($closeFunction)
    {
        $this->closeFunction = $closeFunction;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.frontend.active-filters');
    }
}
