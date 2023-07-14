<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Review;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function show($slug)
    {
        $product = Product::active()
            ->withAvg('reviews', 'rating')
            ->where('slug', '=', $slug)
            ->firstOrFail();
        $gallery = ProductImage::where('product_id', '=', $product->id)->get();
        $reviews = Review::latest()
            ->where('product_id', '=', $product->id)
            ->get();

        return view('shop.products.show', ["product" => $product, "gallery" => $gallery, "reviews" => $reviews]);
    }

    public function grid(Request $request)
    {
        $products = Product::active()
            ->inRandomOrder()
            ->filter($request->query())
            ->when($request->input('categories', []) ?? false, function ($query, array $value) {
                return $query->whereIn('category_id',  $value);
            })
            ->paginate(9);

        $categories = Category::withCount('products')->get();

        return view("shop.products.grids", [
            "products" => $products,
            "categories" => $categories
        ]);
    }
}
