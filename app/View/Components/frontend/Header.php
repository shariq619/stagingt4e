<?php

namespace App\View\Components\frontend;


use Illuminate\View\Component;

class Header extends Component
{
    public $categories;
    public $locations;

    public function __construct($categories, $locations)
    {
        $this->categories = $categories;
        $this->locations = $locations;
    }

    public function render()
    {
        return view('components.frontend.header');
    }
}
