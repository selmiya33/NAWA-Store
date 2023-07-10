<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Product;
use Illuminate\Support\Str;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:sanctum')->except('index','show');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        return Product::with('category', 'user', 'gallery')
            ->filter($request->query())
            ->paginate(5)
            ->withQueryString();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {

        $user = $request->user('sanctum');
        if(!$user->tokenCan('product.create')){
            return response([
                'message' => 'Forbidden'
            ],403);
        }
        $data = $request->validated();
        // $data['slug'] = Str::slug();

        if ($request->hasFile('image')) {
            $file = $request->file('image'); //return uploadedfile object
            $path = $file->store('uploads/images', 'public');
            $data['image'] = $path;
        }
        $data['user_id'] = Auth::id();

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
        return $product;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        return Product::with('category', 'user', 'gallery')->findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $user = $request->user('sanctum');
        if(!$user->tokenCan('product.update')){
            return response([
                'message' => 'Forbidden'
            ],403);
        }
        $data = $request->validate([
            'category_id' => 'sometimes|required',
            'name_product' => 'sometimes|required',
            'slug' => 'sometimes|required',
            'price' => 'sometimes|required|min:0',
            'status' => 'sometimes|required',
        ]);
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

        return [
            'message' => 'product updated',
            'product' => $product
        ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Product $product)
    {

        $user = $request->user('sanctum');
        if(!$user->tokenCan('product.update')){
            return response([
                'message' => 'Forbidden'
            ],403);
        }

        $product->delete();

        return [
            'message'=> 'product deleted'
        ];
    }
}
