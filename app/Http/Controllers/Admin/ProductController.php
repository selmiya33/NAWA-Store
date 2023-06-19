<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $products = Product::LeftJoin('categories', 'categories.id', '=', 'products.category_id')
            ->select([
                'products.*',
                'categories.name as category_name',
            ])
            ->get();

        return view('admin.products.index', [
            'title' => 'products item',
            'products' => $products,
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categories = Category::all();

        return view('admin.products.create', [
            'product' => new Product(),
            'categories' => $categories,
            'status_options' => Product::statusOpations(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $product = Product::create($request->validated());
        // $product->status = $request->input('status', 'active');
        return redirect()
            ->route('products.index') 
            ->with('success', "product {{$product->name_product}} created"); 
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();

        return view('Admin.products.edit', [
            'product' => $product,
            'categories' => $categories,
            'status_options' => Product::statusOpations()
        ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, string $id)
    {

        $product = Product::findOrFail($id);
        $product->update($request->validated());

        return redirect()
            ->route('products.index')
            ->with('success', "product {{$product->name_product}} updated");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()
            ->route('products.index')
            ->with('success', "product {{$product->name_product}} deleted"); //Flash Messages
    }

}