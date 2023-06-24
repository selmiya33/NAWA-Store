<?php

namespace App\View\Components;

use Closure;
use App\Models\Product;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class TrendingProducts extends Component
{
    /**
     * Create a new component instance.
     */
    public $products;
    public $title;
    public function __construct($title ="Trending Product",$count="8")
    {
        //
        $this->title=$title;
        $this->products = Product::withoutGlobalscope('owner')
        ->latest('updated_at')
        ->take($count) // ===limit(8)
        ->get();

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.trending-products');
    }
}
