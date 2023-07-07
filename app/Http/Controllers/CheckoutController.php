<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderLine;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Symfony\Component\Intl\Countries;
use function Symfony\Component\String\b;

class CheckoutController extends Controller
{
    //

    public function create()
    {
        $countries = Countries::getNames('en');
        return view('shop.checkhout',["countries" =>$countries]);
    }

    public function store(Request $request)
    {


        $data = $request->validate([
            'customer_first_name' => 'required',
            'customer_lasst_name' => 'required',
            'customer_email' => 'required',
            'customer_phone' => 'nullable',
            'customer_address' => 'required',
            'customer_province' => 'nullable',
            'customer_postal_code' => 'nullable',
            'customer_code_country' => 'required|string|size:2',
            'customer_city' => 'required',
        ]);

        $data['user_id'] = Auth::id();
        $data['status'] = 'pending';
        $data['payment_status'] = 'pending';
        $data['currency'] = 'USD';
        $data['total'] = 0;

        $cookie_id = $request->cookie('cart_id');
        $cart = Cart::where('cookie_id', '=', $cookie_id)->with('product')->get();

        $total = $cart->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        $data['total'] = $total;

        DB::beginTransaction();
        try {


            $order = Order::create($data);

            foreach ($cart as $item) {
                OrderLine::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price,
                    'product_name' => $item->product->name_product,

                ]);
            }
            //delete cart item
            Cart::where('cookie_id', '=', $cookie_id)->delete();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return back()
                ->withInput()
                ->withErrors([
                    'error'=> $e->getMessage()
                ])
                ->with('error', $e->getMessage());
        }
        return redirect()->route('checkout.success');
    }


    public function thank(){
        return view('shop.thankyoy');
    }
}
