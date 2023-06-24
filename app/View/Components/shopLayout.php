<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class shopLayout extends Component
{
    /**
     * Create a new component instance.
     */
    public $title;
    public $showbreadcrumb;
    public function __construct($title,$showbreadcrumb = true)
    {
        //
        $this->title = $title;
        $this->showbreadcrumb = $showbreadcrumb;

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('layouts.shop');
    }
}