<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $product = $this->route('product',new Product);
        $id = $product? $product->id : 0;

        return [
            'name_product'=>'nullable|required|max:255|min:3',
            'slug'=> "required|unique:products,slug,{$id}",
            'category_id'=> 'nullable|int|exists:categories,id',
            'description'=> 'nullable|string',
            'short_description'=> 'nullable|string|max:500',
            'price'=>'required|numeric|min:0',
            'status'=>'required',
            'comper_price'=> 'nullable|numeric|min:0,gt:price',
            // 'image'=>'file:=|mimetypes:image/png,image/jpg',
            // 'image'=>'nullable|file|mimes:png,jpg',
            'image'=> 'nullable|image|dimensions:min_width=400,min_height=300|max:500',//kilobayte
            'gallery','nullable|array',
            'gallery.*' => 'image'

        ];
    }

    
    public function messages():array{
        
        return[
            'required' => ':attribute this field is required!!',
            'unique' => 'the value already exists',
            'name_product.required'=> 'the product name is required!!',
        ];
    }
}
