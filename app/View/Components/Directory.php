<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Directory extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $directory;
    public function __construct($directory)
    {
        $this->directory = $directory;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.directory');
    }
}
