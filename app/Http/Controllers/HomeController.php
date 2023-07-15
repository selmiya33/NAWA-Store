<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Review;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //

    public function index()
    {
        $products = Product::active()
            ->with('category')
            ->take(3)
            ->latest()
            ->get();

        $categories = Category::all();

        $topViews = Review::with('product')
            ->where('rating', '>=', 4)
            ->paginate(3);


        return view('shop.home', [
            "categories" => $categories,
            'topViews' => $topViews,
            'products' =>  $products,
        ]);
    }

    public function about()
    {
        $admins= User::Where('type','LIKE','%admin%')->get();
        return view('shop.about',['admins'=>$admins]);
    }
}
