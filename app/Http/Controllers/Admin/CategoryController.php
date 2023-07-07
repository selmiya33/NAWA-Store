<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::withoutGlobalscope('owner')->withCount('products')->paginate(3);
        return view('Admin.categories.index', [
            'title' => 'categories',
            'categories' => $categories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('Admin.categories.create', ['category' => new Category()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->store("uploads/categories", ['disk'=>'public']);
            $data['image'] = $path;
        }

        Category::create($data);

        return redirect()
            ->route('categories.index')
            ->with('success', "Category  added");
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
        return view('Admin.categories.edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->store("uploads/categories", ['disk'=>'public']);
            $data['image'] = $path;
        }

        $old_image = $category->image;
        $category->update($data);

        if($old_image && $old_image != $category->image){
            Storage::disk('public')->delete($old_image);
        }

        return redirect()->route('categories.index')
            ->with('success', "Category {{$category->name}} updated");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        if($category->image){
            Storage::disk('public')->delete($category->image);
        }

        return redirect()->route('categories.index')->with('success', "Category {{$category->name}}deleted");
    }
}
