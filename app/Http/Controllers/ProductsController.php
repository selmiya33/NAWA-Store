<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    //
    public function index()
    {
    }

    public function show($slug)
    {
        $product = Product::active()->withoutGlobalscope('owner')->where('slug', '=', $slug)->firstOrFail();
        $gallery = ProductImage::where('product_id', '=', $product->id)->get();
        return view('shop.Products.show', ["product" => $product ,"gallery"=>$gallery]);
    }

    public function grid()
    {
        $products = Product::withoutGlobalscope('owner')->active()->inRandomOrder()->paginate(9);

        return view("shop.products.grids",["products" => $products]);
    }
}
