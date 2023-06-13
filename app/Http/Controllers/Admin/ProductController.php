<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //select products.* ,categories.name as category_name from products  -----insert join categories on categories.id = products.catagory_id
        // $products = DB::table('products')->get(''); //return collection object = array
        // $products = DB::table('products')
        //                 ->Join('catagories','catagories.id','=','products.category_id')
        //                 ->select(
        //                     'products.*',
        //                     'catagories.name as category_name',
        //                 )
        //                 ->get();//dd()
        // // dd($products);
        // return view('admin.products.index',[
        //     'title'=> 'products item',
        //     'products'=> $products,
        // ]);

        /////////////mvc categories
        $products = Product::Join('categories','categories.id','=','products.category_id')
                                ->select([
                                    'products.*',
                                    'categories.name as category_name'
                                       ])
                               ->get();    

        return view('admin.products.index',[
                'title'=> 'products item',
                'products'=> $products,
                ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categories = Category::all();

        return view('admin.products.create',['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $product = new Product();
        $product->name_product = $request->input('name');
        $product->slug = $request->input('slug');
        $product->price = $request->input('price');
        $product->comper_price = $request->input('compare_price');
        $product->description = $request->input('description');
        $product->category_id = $request->input('category_name');



        $product->save();

        //prg : post redirect get
        return redirect()->route('products.index');//redirect عبارة عن get

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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
