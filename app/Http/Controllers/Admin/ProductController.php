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
        $products = Product::LeftJoin('categories','categories.id','=','products.category_id')
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
        $product = new Product();

        return view('admin.products.create',['product' => $product,'categories' => $categories]);
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
        return redirect()
                    ->route('products.index')/*redirect عبارة عن get*/
                    ->with('success',"product {{$product->name_product}} created");//Flash Messages
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
        // $product =Product::where('id','=',$id)->first();//return model or null if not found

        $categories = Category::all();
        $product =Product::findOrFail($id);//return model or null if not found

   
        // $product =Product::find($id);//return model or null if not found
        // if(!$product){
        //     // return redirect()->route('products.index');
        //     abort(404);
        // }

            // dd($product);
        return view('Admin.products.edit',['product'=>$product, 'categories'=>$categories]);
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $product =Product::findOrFail($id);//return model or null if not found
        $product->name_product = $request->input('name');
        $product->slug = $request->input('slug');
        $product->price = $request->input('price');
        $product->comper_price = $request->input('compare_price');
        $product->description = $request->input('description');
        $product->category_id = $request->input('category_name');

        $product->save();
        //prg : post redirect get
        return redirect()
                ->route('products.index')
                ->with('success',"product {{$product->name_product}} updated");//Flash Messages
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $product =Product::findOrFail($id);
        $product->delete();
        // Product::destroy($id);

        return redirect()
                ->route('products.index')
                ->with('success',"product {{$product->name_product}} deleted");//Flash Messages
    }
}
