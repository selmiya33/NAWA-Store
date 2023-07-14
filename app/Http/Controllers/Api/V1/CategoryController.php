<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except('index','show');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Category::with('products')->paginate();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->store("uploads/categories", ['disk' => 'public']);
            $data['image'] = $path;
        }

        $category = Category::create($data);
        return $category;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Category::with('products')->findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'name' => 'sometimes|required|string',
            'image' => 'sometimes|required|image|dimensions:min_width=400,min_height=300|max:500'

        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->store("uploads/categories", ['disk' => 'public']);
            $data['image'] = $path;
        }

        $old_image = $category->image;
        $category->update($data);

        if ($old_image && $old_image != $category->image) {
            Storage::disk('public')->delete($old_image);
        }

        return [
            'message' => 'updated category--',
            'category' => $category
        ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return [
            'message'=> 'category deleted'
        ];
    }
}
