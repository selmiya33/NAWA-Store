<?php

namespace App\View\Components;

use App\Models\Account;
use App\Models\Cart;
use App\Models\Category;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\View\Component;

class ShopLayout extends Component
{
    /**
     * Create a new component instance.
     */
    public $title;
    public $showbreadcrumb;
    public $categories;
    public $accounts;
    public $cart;
    public $AppsMobiles;
    public function __construct(Request $request, $title, $showbreadcrumb = true)
    {

        $this->title = $title;
        $this->showbreadcrumb = $showbreadcrumb;

        $this->categories = Category::limit(5)
            ->inRandomOrder()
            ->get();

        $this->accounts = Account::all();


        $cookie_id = $request->cookie('cart_id');
        $this->cart = Cart::where('cookie_id', '=', $cookie_id)->with('product')->get();
        $this->AppsMobiles = Account::where('platform', 'LIKE', '%play%')->orwhere('platform', 'LIKE', '%store%')->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('layouts.shop');
    }
}
