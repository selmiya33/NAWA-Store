<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('Admin.categories.index',[
            'title'=> 'categories',
            'categories' => $categories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('Admin.categories.create',['category' => new Category()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        //.
        // $category = new Category();
        // $category->name = $request->input('name');
        // $category->save();
        $category = Category::create($request->validated());

        return redirect()
                ->route('categories.index')
                ->with('success',"Category  added");
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
    public function edit(Category $category)
    {
        //string $id
        // $category = Category::findOrFail($id);
        return view('Admin.categories.edit',['category'=> $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $category)
    {
        //
        // $category = Category::findOrFail($id);
        // $category->name = $request->input('name');
        // $category->save();
        $category->update($request->validated());

        return redirect()->route('categories.index')
                     ->with('success',"Category {{$category->name}} updated");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //string $id
        // $category = Category::findOrFail($id);
        // Category::destroy($id);

        $category->delete();
        return redirect()->route('categories.index')->with('success',"Category {{$category->name}}deleted");
    }
}
