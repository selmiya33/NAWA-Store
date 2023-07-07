<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Http\Requests\ProductRequest;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    public function __construct(Request $request)
    {
        if ($request->method() == "GET") {

            $categories = Category::all();
            View::share([
                'categories' => $categories,
                'status_options' => Product::statusOpations(),
            ]);
        }

    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        // $products = Product::LeftJoin('categories', 'categories.id', '=', 'products.category_id')
        //     ->select([
        //         'products.*',
        //         'categories.name as category_name',
        //     ])
        $products = Product::
            // ->whereNull('deleted_at')
            // ->onlyTrashed()
            // ->withTrashed()
            withoutGlobalScope('owner')
            ->with('category')
            // ->withoutGlobalScopes()
            // ->active()
            // -> status('draft')
            ->filter($request->query())
            ->paginate(3) //simplepaginate(3)
            ->withQueryString();

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
        return view('admin.products.create', [
            'product' => new Product(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $data = $request->validated();
        // $data['slug'] = Str::slug();

        if ($request->hasFile('image')) {
            $file = $request->file('image'); //return uploadedfile object
            $path = $file->store('uploads/images', 'public');
            $data['image'] = $path;
        }
        $data['user_id'] = Auth::user()->id;

        $product = Product::create($data);

        if ($request->hasFile('gallery')) {
            //array of uploadfile
            foreach ($request->file('gallery') as $file) {
                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $file->store('uploads/subImages', ['disk' => 'public'])
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
        $gallery = ProductImage::where('product_id', '=', $product->id)->get();

        return view('admin.products.edit', [
            'product' => $product,
            'gallery' => $gallery,
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
            $file = $request->file('image'); //return uploadedfile object
            $path = $file->store('uploads/images', ['disk' => 'public']);
            $data['image'] = $path;
        }

        $old_image = $product->image;
        $product->update($data);

        if ($old_image && $old_image != $product->image) {
            Storage::disk('public')->delete($old_image);
        }

        if ($request->hasFile('gallery')) {
            //array of uploadfile
            foreach ($request->file('gallery') as $file) {
                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $file->store('uploads/subImages', ['disk' => 'public'])
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
        return redirect()
            ->route('products.index')
            ->with('success', "product {{$product->name_product}} deleted"); //Flash Messages
    }

    public function trashed()
    {
        $products = Product::onlyTrashed()->paginate(3);
        return view('admin.products.trashed', ['products' => $products]);
    }

    public function restore($id)
    {
        $product = Product::onlyTrashed()->findOrFail($id);
        $product->restore(); //بتحذف التاريخ من عمود soft deleted
        return redirect()
            ->route('products.index')
            ->with('success', "product {$product->name_product} restord"); //Flash Messages
    }

    public function forceDelete($id)
    {
        $product = Product::onlyTrashed()->findOrFail($id);

        $product->forceDelete();

        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        return redirect()
            ->route('products.index')
            ->with('success', "product {{$product->name_product}} Deleted forever!"); //Flash Messages
    }
}
