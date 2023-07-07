<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use NumberFormatter;

class CartController extends Controller
{
    //

    public function index(Request $request)
    {
        $cookie_id = $request->cookie('cart_id');
        $cart = Cart::where('cookie_id','=',$cookie_id)->with('product')->get();

        $total = $cart->sum(function($item){
                return $item->product->price * $item->quantity;
        });

        // $total = 0;
        // foreach ($cart as $item) {
        //     $total += $item->product->price * $item->quantity;
        // }



        $formatted = new NumberFormatter('en', NumberFormatter::CURRENCY);

        return view('shop.cart',['cart'=>$cart ,'total' => $formatted->formatCurrency($total,'USD') ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => ['required', 'integer', 'exists:products,id'],
            'quantity' => [ 'nullable','integer', 'min:1', 'max:99'],

        ]);

        $cookie_id = $request->cookie('cart_id');

        if (!$cookie_id)
        {
            $cookie_id = Str::uuid();
            Cookie::queue('cart_id', $cookie_id, 60 * 24 * 7);
        }

        $item = Cart::where('cookie_id', '=', $cookie_id)
            ->where('product_id', '=', $request->input('product_id'))->first();

        if ($item)
         {
            $item->increment('quantity', $request->input('quantity',1));
        } else
         {
            Cart::create([
                'cookie_id' => $cookie_id,
                'user_id' => Auth::id(),
                'product_id' => $request->input('product_id'),
                'quantity' => $request->input('quantity'),

            ]);
        }

        return back()->with('success', 'product added to cart');
    }
    public function destroy()
    {
    }
}
