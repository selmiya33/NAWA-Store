<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Storage;

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
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $file =$request->file('image');//return uploadedfile object
            $path = $file->store('uploads/images','public');
            $data['image'] =$path;
        }

        $product = Product::create($data);
        
        if($request->hasFile('gallery')){
            //array of uploadfile
            foreach ($request->file('gallery') as $file) {
                ProductImage::create([
                    'product_id'=> $product->id,
                    'image'=>$file->store('uploads/subImages',['disk'=>'public'])
                ]);
            }
        }
        
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
        $gallery = ProductImage::where('product_id','=',$product->id)->get();

        return view('Admin.products.edit', [
            'product' => $product,
            'categories' => $categories,
            'status_options' => Product::statusOpations(),
            'gallery'=>$gallery,
        ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product)
    {
        $product->update($request->validated());

        $data = $request->validated();
        if ($request->hasFile('image')) {
            $file =$request->file('image');//return uploadedfile object
            $path = $file->store('uploads/images',['disk'=>'public']);
            $data['image'] =$path;
        }

        $old_image = $product->image;
        $product->update($data);

        if($old_image && $old_image != $product->image){
            Storage::disk('public')->delete($old_image);
        }

        if($request->hasFile('gallery')){
            //array of uploadfile
            foreach ($request->file('gallery') as $file) {
                ProductImage::create([
                    'product_id'=> $product->id,
                    'image'=>$file->store('uploads/subImages',['disk'=>'public'])
                ]);
            }
        }

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

        if($product->image){
            Storage::disk('public')->delete($product->image);
        }
        return redirect()
            ->route('products.index')
            ->with('success', "product {{$product->name_product}} deleted"); //Flash Messages
    }

}